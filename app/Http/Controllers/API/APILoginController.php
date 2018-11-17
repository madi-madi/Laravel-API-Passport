<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use JWTFactory;
use JWTAuth;
Use Validator;
use Auth;

class APILoginController extends Controller
{
    public function loginUser(Request $request)
    {
        $validator =  Validator::make($request->all(),[
        'email'=> 'required|string|email|max:255',
        'password'=> 'required|string|min:6|max:10',
        ]);

        if ($validator->fails()) {
        # code...
        return response()->json($validator->errors());
        }

        $credentials = $request->only('email','password');
        try{
            if (! $token=JWTAuth::attempt($credentials)) {
                # code...
        return response()->json(['error'=>'Invalid username or password'],[401]);
    
            }
        }catch(JWTException $e){
        return response()->json(['error'=>'Could not Create token'],[500]);

        }

        return response()->json(compact('token'));

    }
}
