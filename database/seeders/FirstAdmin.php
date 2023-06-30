<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FirstAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create($this->firstAdmin());
    }

    private function firstAdmin()
    {
        return
        [
            'name'=> 'mohammed',
            'email'=> 'mohammed.alshobaki96@gmail.com',
            'password'=> Hash::make('pass@123'),
            'email_verified_at'=> Carbon::now()
        ];
    }
}
