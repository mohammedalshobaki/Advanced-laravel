<?php

namespace App\Services;

use \App\Models\User;
class UserService{
    public function createUser(array $data): User{
        $data['password'] = \Illuminate\Support\Facades\Hash::make($data['password']);
        return User::create($data);
    }
}
