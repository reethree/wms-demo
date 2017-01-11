<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DefaultController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function voiceCallback(Request $request)
    {
//        <prompt>You entered is: <value expr="post_id" /> , , </prompt>
//        <prompt>Thank you for contacting us.<break time="2s"/>Welcome to rukamen.com.<break time="3s"/> please enter id ads that you see.</prompt>
//        <audio src="http://www.freesfx.co.uk/rx2/mp3s/9/10778_1380921485.mp3"/>
        $caller_id = $request['nexmo_caller_id'];
        $cid = ($caller_id != '') ? $caller_id : "9999";
//        $cid = (isset($request->nexmo_caller_id)) ? $request->nexmo_caller_id : "9999";
        echo '<?xml version="1.0" encoding="UTF-8"?>
            <vxml version = "2.1">
                <form id="welcome">
                    <field name="post_id" type="number">
                        <prompt>
                            <audio src="'.url('uploads/audio/test.mp3').'"/>
                        </prompt>    
                        <noinput>
                            <prompt>To better assist you, we need to know what computer you\'re using.</prompt>
                            <reprompt />
                        </noinput>
                        <noinput count="2">
                            <prompt>I didn\'t hear anything, perhaps there is an issue with the connection, or your phone is muted.</prompt>
                            <reprompt />
                        </noinput>
                        <error>
                            <prompt>Sorry, something unexpected happened. Please call again.</prompt>
                            <exit />
                        </error>
                      
                    </field>
                    <filled>
                        <prompt>Thank you, we\'ll get you specific contact.</prompt>
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
        
        if(file_exists(public_path('uploads/'.$number.'.mp3'))){
//            $post = \App\Model\Post::find($postmeta->post_id);
            $prompt = '<prompt>You\'re advertising number :<break time="2s"/> '.$p_id.'<break time="2s"/>.</prompt><audio src="'.url('uploads/' . $number . '.mp3').'"/>';
        }else{
            $prompt = '<prompt>You\'re advertising number :<break time="2s"/> '.$p_id.'<break time="2s"/>. Sorry, something unexpected happened. Please call again.</prompt>';
        }
 
//        493051
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
