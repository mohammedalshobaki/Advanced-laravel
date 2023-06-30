<?php

namespace App\Http\Controllers\Api;

use App\Requests\Users\CreateUserValidator;
use App\Requests\Users\LoginValidator;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class RegisterController extends BaseController{

    public $userService;
    public function  __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(CreateUserValidator $CreateUserValidator)
    {
        if(!empty($CreateUserValidator->getErrors())){
            return  response()->json($CreateUserValidator->getErrors(), 406);
        }


        $user = $this->userService->createUser($CreateUserValidator->request()->all());
        $message['user'] = $user;
        $message['token'] = $user->createToken('MyAdvanced')->plainTextToken;
        return $this->sendResponse($message);
    }

    public function login(LoginValidator $LoginValidator)
    {
        if(!empty($LoginValidator->getErrors())){
            return  response()->json($LoginValidator->getErrors(), 406);
        }

        $request = $LoginValidator->request();

        if(Auth::attempt(['email'=> $request->email, 'password'=> $request->password]))
        {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyAdvanced')->plainTextToken;
            $success['name'] = $user->name;

            return $this->sendResponse($success);
        }else
        {
            return $this->sendResponse('Unauthorized','fail', 401);
        }
    }
}
