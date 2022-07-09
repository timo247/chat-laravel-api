<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function retrieveUserFromCookieToken()
    {
        $token_string = Cookie::get('token');
        $token_id = explode('|', $token_string)[0];
        $token = PersonalAccessToken::where('id', '=', $token_id)->first();

        if ($token != null) {
            $user = $token->tokenable;
            return $user;
        } else {
            return null;
        }
    }
}
