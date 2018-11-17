<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($result , $message){
        $response = [
            'success'=>true,
            'data'=>$result,
            'message'=>$message
        ];

        return response()->json($response , 200);
    }

    public function sendErrorResponse($error , $errorMessage=[],$code = 400){
        $response = [
            'success'=>false,
            'data'=>'',
            'message'=>$error,
            // 'code'=> $code
        ];

        if (! empty($errorMessage)) {

            $response['data'] = $errorMessage;
            
        }

        return response()->json($response , $code);
    }

}
