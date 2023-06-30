<?php
namespace App\Requests\Users;

use App\Requests\BaseRequestApi;

class LoginValidator extends BaseRequestApi {

    public function rules(): array
    {

        return [
            'email'=> 'required|min:5|email',
            'password' => 'required|min:5|max:12'
        ];
    }

    public function authorized(): bool{
        return false;
    }
}
