<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{

    public function sendResponse($message,$result='')
    {
        $response=[
            'success'=>true,
            'data'=>$result,
            'message'=>$message,
        ];
        return response()->json($response,200);
    }

    public function sendError($message,$errors=[],$code=200)
    {
        $response=[
            'success'=>false,
            'message'=>$message,
        ];
        if( ! empty($errors) )
        {

            $response['data']=$errors;
        }
        return response()->json($response,$code);
    }
}
