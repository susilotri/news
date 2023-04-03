<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\Response;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

use function PHPUnit\Framework\returnSelf;

class UserController extends Controller
{

    public function login(Request $request)
    {
       $validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required',
        ]);
        if($validator->fails()){
            return response(['status' => false, 'message' => $validator->errors()], 400);
        }
        try{
            $user = User::where('email', $request->email)->first();
            if(!$user)  return response(['status' => false, 'message' => 'User Not Found'], 404);
            if(Hash::check($request->password, $user->password)):
                $token = $user->createToken($user->name)->accessToken;
                return response(['status' => true, 'message' => ['token' => $token]], 200);
            else:
                return response(['status' => false, 'message' => 'Wrong Password']);
            endif;
        }catch(Exception $e){
            return response(['status' => false, 'message' => $e->getMessage()], $e->getCode());
        }

    }
}
