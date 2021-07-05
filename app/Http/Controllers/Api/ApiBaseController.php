<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
class ApiBaseController extends Controller
{
    public function __construct() {

    }

    public function sendResponse($result, $message)
    {
        $response = [
            ‘success’ => true,
            ‘data’ => $result,
            ‘message’ => $message,
        ];
        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            ‘success’ => false,
            ‘message’ => $error,
        ];
        if(!empty($errorMessages)){
            $response[‘data’] = $errorMessages;
        }
        return response()->json($response, $code);
    }

    public function getInvoiceNumber($type, $uid = '')
    {
        $lastno = \DB::table('invoice_number')->where('year', date('Y'))->orderBy('id', 'desc')->first();
        $num = 0;
        if(count($lastno) > 0){
            $num = substr($lastno->id, -5);
        }
        $no_invoice = date('ym').str_pad(intval(($num > 0 ? $num : 0)+1), 5, '0', STR_PAD_LEFT);

        $insert = \DB::table('invoice_number')->insert(
            ['number' => $no_invoice, 'type' => $type, 'year' => date('Y'), 'uid' => (empty($uid) ? \Auth::getUser()->name : $uid)]
        );

        if($insert){
            return $no_invoice;
        }

        return false;
    }
}