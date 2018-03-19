<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BniEcollectionController as BniEnc;

class PaymentController extends Controller
{
    protected $client_id;
    protected $url;

    public function __construct() {
//        parent::__construct();
//        $this->url = 'https://apibeta.bni-ecollection.com/'; //Demo
        $this->url = 'https://api.bni-ecollection.com/'; //Real
        $this->client_id = '586';
    }
    
    public function index()
    {
//        if ( !$this->access->can('show.payment.index') ) {
//            return view('errors.no-access');
//        }
        
        $data['page_title'] = "BNI E-Collection";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'BNI E-Collection'
            ]
        ];        
        
        return view('payment.index-bni')->with($data);
    }
    
    public function edit($id)
    {
//        if ( !$this->access->can('show.payment.edit') ) {
//            return view('errors.no-access');
//        }
        
        $data['page_title'] = "Edit Billing";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('payment-bni-index'),
                'title' => 'BNI E-Collection'
            ],
            [
                'action' => '',
                'title' => 'Edit Billing'
            ]
        ];        
        
        $data['payment'] = \App\Models\PaymentBni::find($id);
        
        return view('payment.edit-bni')->with($data);
    }
    
    public function createBilling(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'trx_id' => 'required',
            'trx_amount' => 'required',
            'expired' => 'required',
            'customer_name' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $last_id = \App\Models\PaymentBni::select('id')
//                ->whereDate('created_at', date('Y-m-d'))
                ->orderBy('id', 'DESC')
                ->first();
        $regID = str_pad(intval((isset($last_id->id) ? $last_id->id : 0)+1), 6, '0', STR_PAD_LEFT);
        $va_number = '8'.$this->client_id.date('ymd').$regID;
        
        $data_req = array(
            'client_id' => (string)$this->client_id,
            'trx_id' => (string)$request->get('trx_id'),
            'trx_amount' => (string)$request->get('trx_amount'),
            'type' => 'createBilling',
            'billing_type' => 'c',
            'datetime_expired' => date('c', time() + $request->get('expired') * 86400), // billing will be expired in days
            'virtual_account' => (string)$va_number,
            'customer_name' => $request->get('customer_name'),
            'customer_email' => $request->get('customer_email'),
            'customer_phone' => $request->get('customer_phone'),
            'description' => $request->get('description')
        );
        
        $hashed_string = BniEnc::encrypt($data_req);

        $data = array(
            'client_id' => (string)$this->client_id,
            'data' => $hashed_string,
        );
        
//        return json_encode($data);
        
        $response = $this->request_get_content($this->url, json_encode($data));
        $response_json = json_decode($response, true);

        if ($response_json['status'] !== '000') {
            // handling jika gagal
//                var_dump($response_json);
            return back()->with('error', 'Status:'.$response_json['status'].' | '.$response_json['message'])->withInput();
        } else {
            $data_response = BniEnc::decrypt($response_json['data']);
            // $data_response will contains something like this: 
            // array(
            // 	'virtual_account' => 'xxxxx',
            // 	'trx_id' => 'xxx',
            // );

//            var_dump($data_response);
            $data_req['uid'] = \Auth::getUser()->name;
            $data_req['datetime_created'] = date('Y-m-d H:i:s');
            $insert = \App\Models\PaymentBni::insert($data_req);
            
            if($insert){
                return back()->with('success', 'Transaction ID '.$data_response['trx_id'].', billing has been created.')->withInput();
            }
                
            return back()->with('error', 'Cannot insert data to database.')->withInput();
        }
    }
    
    public function inquiryBilling(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'trx_id' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $data_req = array(
            'type' => 'inquiryBilling',
            'client_id' => (string)$this->client_id,
            'trx_id' => (string)$request->get('trx_id'),
        );
        
        $hashed_string = BniEnc::encrypt($data_req);
        
        $data = array(
            'client_id' => (string)$this->client_id,
            'data' => $hashed_string,
        );
        
        $response = $this->request_get_content($this->url, json_encode($data));
        $response_json = json_decode($response, true);

        if ($response_json['status'] !== '000') {
            // handling jika gagal
//                var_dump($response_json);
            return back()->with('error', $response_json['message'])->withInput();
        } else {
            $data_response = BniEnc::decrypt($response_json['data']);

//            var_dump($data_response);

            $data_response['uid'] = \Auth::getUser()->name;
            $data_response['updated_at'] = date('Y-m-d H:i:s');
            $update = \App\Models\PaymentBni::where('trx_id', $data_response['trx_id'])->update($data_response);
            
            if($update){
                return back()->with('success', 'Transaction ID '.$data_response['trx_id'].', billing has been updated.')->withInput();
            }
                
            return back()->with('error', 'Cannot update data to database.')->withInput();
        }
    }
    
    public function updateBilling(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'trx_id' => 'required',
            'trx_amount' => 'required',
            'customer_name' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $data_req = array(
            'client_id' => (string)$this->client_id,
            'trx_id' => (string)$request->get('trx_id'),
            'trx_amount' => (string)$request->get('trx_amount'),
            'type' => 'updateBilling',
            'customer_name' => $request->get('customer_name'),
            'customer_email' => $request->get('customer_email'),
            'customer_phone' => $request->get('customer_phone'),
            'description' => $request->get('description')
        );
        
        if($request->get('expired')){
            $data_req['datetime_expired'] = date('c', time() + $request->get('expired') * 86400);
        }
        
        $hashed_string = BniEnc::encrypt($data_req);

        $data = array(
            'client_id' => (string)$this->client_id,
            'data' => $hashed_string,
        );
        
        $response = $this->request_get_content($this->url, json_encode($data));
        $response_json = json_decode($response, true);

        if ($response_json['status'] !== '000') {
            // handling jika gagal
//                var_dump($response_json);
            return back()->with('error', $response_json['message'])->withInput();
        } else {
            $data_response = BniEnc::decrypt($response_json['data']);
            // $data_response will contains something like this: 
            // array(
            // 	'virtual_account' => 'xxxxx',
            // 	'trx_id' => 'xxx',
            // );

//            var_dump($data_response);
            $data_req['uid'] = \Auth::getUser()->name;
            $data_req['updated_at'] = date('Y-m-d H:i:s');
            $update = \App\Models\PaymentBni::where('trx_id', $data_response['trx_id'])->update($data_req);
            
            if($update){
                return back()->with('success', 'Transaction ID '.$data_response['trx_id'].', billing has been updated.')->withInput();
            }
                
            return back()->with('error', 'Cannot update database or trx_id not found.')->withInput();
        }
    }
    
    public function request_get_content($url, $post) 
    {
//	$usecookie = __DIR__ . "/cookie.txt";
	$header[] = 'Content-Type: application/json';
	$header[] = "Accept-Encoding: gzip, deflate";
	$header[] = "Cache-Control: max-age=0";
	$header[] = "Connection: keep-alive";
	$header[] = "Accept-Language: en-US,en;q=0.8,id;q=0.6";

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_VERBOSE, true);
	// curl_setopt($ch, CURLOPT_NOBODY, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_ENCODING, true);
	curl_setopt($ch, CURLOPT_AUTOREFERER, true);
	curl_setopt($ch, CURLOPT_MAXREDIRS, 5);

	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36");

	if ($post)
	{
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	}

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
             
	$rs = curl_exec($ch);

	if(empty($rs)){
            var_dump($rs, curl_error($ch));
            curl_close($ch);
            return false;
	}
	curl_close($ch);
	return $rs;
    }


    public function bniNotification(Request $request)
    {
        $data = file_get_contents('php://input');

        $data_json = json_decode($data, true);

        if (!$data_json) {
                // handling orang iseng
            return json_encode(array('status' => '999', 'message' => 'Oopss... Something wrong!!!'));
//                echo '{"status":"999","message":"Oopss... Something wrong!!!"}';
        } else {
            if ($data_json['client_id'] === $this->client_id) {
                $data_callback = BniEnc::decrypt($data_json['data']);
                if (!$data_callback) {
                    // handling jika waktu server salah/tdk sesuai atau secret key salah
                    return json_encode(array('status' => '999', 'message' => 'Waktu server tidak sesuai NTP atau secret key salah.'));
//                                echo '{"status":"999","message":"waktu server tidak sesuai NTP atau secret key salah."}';
                } else {
                    // Update Billing
                    $update = \App\Models\PaymentBni::where('trx_id', $data_callback['trx_id'])->update($data_callback);
                    if($update) {
                        return json_encode(array('status' => '000'));
                    }
                    
                    return json_encode(array('status' => '999', 'message' => 'Cannot update database.'));
                    
                }
            }else{
                return json_encode(array('status' => '999', 'message' => 'Invalid Client ID.'));
            }
        }
    }

}
