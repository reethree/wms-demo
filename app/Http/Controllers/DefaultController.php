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
                        <audio src="'.url('uploads/selamatdatang.wav').'"/>
                    </block>
                    
                    <field cond="false" name="post_id" type="digits?minlength=5;maxlength=6" expr="">  
                    
                        <audio src="'.url('uploads/masukannomor.wav').'"/>
                        <prompt><break /></prompt>  
                        
                        <noinput cond="true" count="1">
                            <audio src="'.url('uploads/masukannomor.wav').'"/>
                            <reprompt />
                        </noinput>
                        
                        <noinput cond="true" count="2">
                            <audio src="'.url('uploads/masukannomor.wav').'"/>
                            <reprompt />
                        </noinput>
                        
                        <error>
                            <audio src="'.url('uploads/mohonmaaf.wav').'"/>
                            <exit />
                        </error> 
                        
                        <help>
                            <audio src="'.url('uploads/masukannomor.wav').'"/>
                            <reprompt/>
                        </help>        
  
                    </field>
                    <filled namelist="post_id">
                        <if cond="post_id!=\'false\'">
                            <audio src="'.url('uploads/terimakasih.wav').'"/>
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
        
        if(file_exists(public_path('uploads/'.$number.'.wav'))){
//            $post = \App\Model\Post::find($postmeta->post_id);
            $prompt = '<audio src="'.url('uploads/'.$number.'.wav').'"/>';
        }else{
            $prompt = '<audio src="'.url('uploads/mohonmaaf.wav').'"/>';
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
