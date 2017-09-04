<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;

class DefaultController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
//    public function getFlatFile()
//    {
//       
//        $sparator_header = array(
//            'HDR0111IS', 
//        );
//        
//        $sparator_detail = array(
//            'DTL02SNM01', //Shipper Name
//            'DTL02SNA01', //Shipper Address,
//            'DTL02CNM01', //Consignee Name,
//            'DTL02CNA01', //Consignee Address
//            'DTL02NNM01', //Notify Name,
//            'DTL02NNA01', //Notify Address,
//            'DTL02SMR01', //Marking.....
//            'DTL02HSC01', //
//            'DTL02DES01', //Uraian
//            'DTL02DES02', //Uraian2
//            'DTL02DES03', //Uraian3
//            'DTL02DES04', //Uraian4
//            'DTL02DES05', //Uraian5
//            'DTL02DES06', //Uraian6
//            'CNT010000', //No.Container,
////            'DTL0101I', //No.POS
//        );
//        
//        $resplace_detail = array(
//            '|SHIPPER^', //Shipper Name
//            '|SHIPPER_ADDRESS^', //Shipper Address,
//            '|CONSIGNEE^', //Consignee Name,
//            '|CONSIGNEE_ADDRESS^', //Consignee Address
//            '|NOTIFYPARTY^', //Notify Name,
//            '|NOTIFYPARTY_ADDRESS^', //Notify Address,
//            '|MARKING^', //Marking.....
//            '|DTL02HSC01^', //
//            '|DESCOFGOODS^', //Uraian
//            '|DESCOFGOODS^', //Uraian2
//            '|DESCOFGOODS^', //Uraian3
//            '|DESCOFGOODS^', //Uraian4
//            '|DESCOFGOODS^', //Uraian5
//            '|DESCOFGOODS^', //Uraian6
//            '|NOCONTAINER^', // No.Container,
////            '|NO_POS^', //No.POS
//        );
//        
//        $flat = \File::get(public_path('flat_file/1702S.txt'));
//        $datas = explode('DTL0101I', $flat);
//        
//        $results = array();
//        $dataFinals = array();
//        
//        $i = 0;
//        
//        foreach ($datas as $data):
//            if($i == 0){
//                $data = str_replace($sparator_header, '|^', $data); 
//            }else{
//                $data = str_replace($sparator_detail, $resplace_detail, $data); 
//                $dataExplode = explode('|',$data);   
//                
//                $results[] = $dataExplode;
//            }
//            $i++;
//        endforeach;
//        
//        foreach($results as $value):  
//            $desc = '';
//            foreach ($value as $v):
//                $val = explode('^', $v); 
//                if(is_array($val) && count($val) > 1):
//                    if($val[0] == 'DESCOFGOODS'){
//                        $desc .= $val[1];
//                        $dataval[$val[0]] = trim($desc);
//                    }else{
//                        $dataval[$val[0]] = trim($val[1]);
//                    }
//                else:
//                    $dataval['HEADER'] = trim($val[0]);
//                endif;
//                
//            endforeach;
//            
//            $dataFinals[] = $dataval;              
//        endforeach;
//        
////        print_r($dataFinals);
//        
//        return json_encode($dataFinals);
//        
//    }
//    
//    public function updateSor($type, $value)
//    {
//        $sor = \App\Models\SorYor::where('type', 'sor')->first();
//        if($type == 'stripping'):
//            $k_trisi = $sor->kapasitas_awal + $value;
//        elseif($type == 'release'):
//            $k_trisi = $sor->kapasitas_awal - $value;
//        endif;
//        
//        $k_kosong = $sor->kapasitas_default - $k_trisi;
//        
//        $sor = ($k_trisi / $sor->kapasitas_default) * (100/100);
//        
//        return $sor;
//    }
//    
//    public function updateYor($type, $value)
//    {
//        $yor = \App\Models\SorYor::where('type', 'yor')->first();
//        if($type == 'gatein'):
//            $k_trisi = $yor->kapasitas_awal + $value;
//        elseif($type == 'release'):
//            $k_trisi = $yor->kapasitas_awal - $value;
//        endif;
//        
//        $k_kosong = $yor->kapasitas_default - $k_trisi;
//        
//        $yor = ($k_trisi / $yor->kapasitas_default) * (100/100);
//        
//        return $yor;
//    }
    
    public function voiceCallback(Request $request)
    {
//        <prompt>You entered is: <value expr="post_id" /> , , </prompt>
//                                <noinput>
//                            <prompt>Please enter advertising number for specific contact.</prompt>
//                            <reprompt />
//                        </noinput>
//                        <noinput count="2">
//                            <prompt>Please enter advertising number.</prompt>
//                            <reprompt />
//                        </noinput>
//        <prompt>Thank you for contacting us.<break time="2s"/>Welcome to rukamen.com.<break time="3s"/> please enter id ads that you see.</prompt>
//        <audio src="http://www.freesfx.co.uk/rx2/mp3s/9/10778_1380921485.mp3"/>
        $caller_id = $request['nexmo_caller_id'];
        $cid = ($caller_id != '') ? $caller_id : "9999";
//        $cid = (isset($request->nexmo_caller_id)) ? $request->nexmo_caller_id : "9999";
//        493051
        echo '<?xml version="1.0" encoding="UTF-8"?>
            <vxml version = "2.1">               
                <form id="main">
                
                    <block name="Initial_1" cond="true" expr="">
                        <audio src="'.asset('uploads/selamatdatang.wav').'"/>
                        <prompt><break /></prompt>
                    </block>
                    
                    <field cond="true" name="post_id" type="digits?minlength=5;maxlength=5" expr="">  
                        <prompt bargein="false"> 
                            <audio src="'.asset('uploads/masukannomor.wav').'"/> 
                            <break />
                        </prompt> 
                        
                        <noinput cond="true">
                            <prompt bargein="false"> 
                                <audio src="'.asset('uploads/masukannomor.wav').'"/>
                            </prompt> 
                            <reprompt />
                        </noinput>
                        
                        <noinput cond="true" count="2">
                            <prompt bargein="false"> 
                                <audio src="'.asset('uploads/masukannomor.wav').'"/>
                            </prompt> 
                            <reprompt />
                        </noinput>
                        
                        <error>
                            <prompt bargein="false">
                                <audio src="'.asset('uploads/mohonmaaf.wav').'"/>
                            </prompt>
                            <exit />
                        </error> 
                        
                        <help>
                            <prompt bargein="false">
                                <audio src="'.asset('uploads/masukannomor.wav').'"/>
                            </prompt>
                            <reprompt/>
                        </help>        
  
                    </field>
                    <filled namelist="post_id">
                        <if cond="post_id!=\'\'">
                            <audio src="'.asset('uploads/terimakasih.wav').'"/>
                        </if>
                        <submit next="'.route('call-voice-callback-response', $cid).'" method="get" namelist="post_id"/>
                    </filled>
                </form>
            </vxml>';        
    }
    
    public function voiceCallbackResponse(Request $request, $cid)
    {
        $post_id = $request['post_id'];
        $number = ($post_id != '') ? $post_id : "9999";
        
//        $log = new \App\Model\CallLog;
//        $log->caller_id = $cid;
//        $log->post_id = $number;
//        $log->save();
        
        $p = str_split($number);
        $p_id = implode(', ', $p);
        
//        $c = str_split($cid);
//        $c_id = implode(', ', $c);
        
        
        
//        $postmeta = \App\Model\Postmeta::where(array('meta_key' => 'post_number', 'meta_value' => $number))->first();
        
        if(file_exists('uploads/'.$number.'.wav')){
//            $post = \App\Model\Post::find($postmeta->post_id);
            $prompt = '<audio src="'.asset('uploads/'.$number.'.wav').'"/>';
        }else{
            $prompt = '<audio src="'.asset('uploads/mohonmaaf.wav').'"/>';
        }
 
//        493051
//        Sewa Apartemen Ambassade Residences Jakarta Selatan - 1 BR 33m2 Furnished
//        if($post){
//            $audio = url('uploads/audio/' . $number . '.wav');
//            $prompt = '<audio src="'.$audio.'"/>';    
//        }
        
        echo '<?xml version="1.0" encoding="UTF-8"?>
            <vxml version="2.1">
                <form>
                    <block>
                        '.$prompt.'
                    </block>
                </form>
            </vxml>';
        
//            <vxml version="2.1">
//                <form>
//                    <block>
//                        <prompt>You phone number is :<break time="2s"/> '.$c_id.'<break time="3s"/> and your post id :<break time="2s"/> '.$p_id.'</prompt>
//                    </block>
//                </form>
//            </vxml>
    }
    
}
