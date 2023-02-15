<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use Hash;

class AuthController extends BaseController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:55',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        if($validator->fails()){
           // return response(['error' => $validator->errors()]);
           return $this->sendError('Validation Error', ['error'=>$validator->errors()]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

       // $accessToken = $user->createToken('authToken')->accessToken;
       // return response([ 'user' => $user, 'access_token' => $accessToken]);
       $success['access_token'] =  $user->createToken('authToken')->accessToken; 
       $success['user'] =  $user;
       return $this->sendResponse($success, 'User login successfully.');
    }

    public function login(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error', ['error'=>$validator->errors()]);
           //return response(['error' => $validator->errors()]);
        }

        if (!auth()->attempt($data)) {
            return $this->sendError('Unauthorised Error', ['error'=> 'Login credentials are invaild']);
           // return response(['message' => 'Login credentials are invaild']);
        }

        $user = auth()->user(); 
        //$accessToken = $user->createToken('authToken')->accessToken;
        
        $success['access_token'] =  $user->createToken('authToken')->accessToken; 
        $success['name'] =  $user->name;
        return $this->sendResponse($success, 'User login successfully.');

       // return response(['access_token' => $accessToken]);

    }
}