<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index(Request $request){
        $validator = $this->validate_page($request);
        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 200);
        } else {
            $sendername = $request->input('name');
            $senderemail = $request->input('email');
            $subject = '';
            $message = $request->input('message');

            $message = 'from: '.$sendername.' \r\n'.
                'email :'.$senderemail.' \r\n'.
                'subject: '.$subject.' \r\n'.
                'message: '.$message;

            $from = $senderemail;
            $to = env('WEB_EMAIL');
            $headers = "From:". $from . "\r\n";
            $message = str_replace('\r\n', PHP_EOL, $message);


            ini_set( 'display_errors', 1 );
            error_reporting( E_ALL );

            $success = mail($to,$subject,$message,$headers);

            if ($success) {
                return response()->json(array('success' => true), 200);
            }else{
                return response()->json(array('success' => false), 200);
            }
        }
    }
    private function validate_page($request, $data = null)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        return $validator;

    }

}
