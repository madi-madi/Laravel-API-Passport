<?php

namespace App\Http\Controllers\ِAPI;
// use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;

use Illuminate\Http\Request;
use App\User;
Use Validator;
use Response;

class APIRegisterController extends BaseController
{
    public function registerUser(Request $request)
    {
        $input = $request->all();
        return $input;
        $validator =  Validator::make($input,[
        'name'=> 'required',
        'email'=> 'required|string|email|max:255|unique:users',
        'password'=> 'required|string|min:6|max:10',
        'c_password'=>'required|string|min:6|max:10|same:password',

        ]);

        if ($validator->fails()) {
        # code...
        return response()->json($validator->errors());
        }

       $user = User::create([
        'name'=> $input['name'],
        'email'=> $input['email'],
        'password'=> bcrypt($input['password']),
        ]);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;
        return $this->sendResponse($success,'User created successfully');

        // $user = User::first();
    }
}
