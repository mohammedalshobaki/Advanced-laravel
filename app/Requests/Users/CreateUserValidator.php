<?php
namespace App\Requests\Users;

use App\Requests\BaseRequestApi;

class CreateUserValidator extends BaseRequestApi {

    public function rules(): array
    {

        return [
            'email'=> 'required|min:5|email|unique:users,email',
            'password' => 'required|min:5|max:12|confirmed'
        ];
    }

    public function authorized(): bool{
        return false;
    }
}
