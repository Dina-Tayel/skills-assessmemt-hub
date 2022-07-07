<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{

    public function register(Request $request)
    {
        $student_role=Role::where('name','student')->first();
        $validator=Validator::make($request->all(),[
            'name' => 'required|string|max:225',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed',
            'password_confirmation'=>'required|string|same:password',
        ]);
        if($validator->fails())
        {
            return $this->sendError('Validation Error',$validator->errors());
        }
       $data['user']=User::create($request->except( ['password'] ) + ['password'=>Hash::make($request->password),'role_id'=>$student_role->id]);
       $data['token']= $data['user']->createToken('Skills Hub')->plainTextToken;
       return $this->sendResponse('user registered successfully',$data);
    }

    public function login(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        if($validator->fails())
        {
            return $this->sendError('Validation Error',$validator->errors());
        }
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            $token=Auth::user()->createToken('skillsHub');
            return $this->sendResponse('user login successfully',$token->plainTextToken);
        } else{
            return $this->sendError('Unauthorized.', ['error'=>'credentials are not correct']);
        }
    }

    public function logout(Request $request)
    {
        if ($request->user()) {
            // auth('sanctum')->user()->tokens()->delete();
            $request->user()->tokens()->delete();
            return response()->json("Successfully logged out");
        }
        return response()->json("Unauthenticated user");
    }

}
