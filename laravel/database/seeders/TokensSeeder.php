<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;


class TokensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $amelia_bot_user = User::findOrFail(1);
        $amelia_bot_user->createToken('amelia_bot_token');
    }

}
