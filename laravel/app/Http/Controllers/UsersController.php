<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class UsersController extends Controller
{

    public function disconnectAllIntactiveUsers()
    {
        //Disconnecte tous les utilisateurs sauf le bot
        $dateSub5Mins = Carbon::now()->subMinutes(5);
        $afkUsers = DB::table('users')->where('updated_at', '<=', $dateSub5Mins)->where('id', '!=', 1)->update(['online' => false]);
        $unApropriateUsers =  DB::Table('users')->where('updated_at', '=', null)->update(['online' => false]);
    }

    public function getOnlineUsers()
    {
        $this->disconnectAllIntactiveUsers();
        $online_users = DB::table('users')->where('online', '=', true)->get();
        return response()->json(['success' => true,  'message' => "online users fetched", "data" => $online_users->toArray()], 200);
    }


    public function connectUser(Request $request)
    {
        if($request->user == null){
            return response()->json(["success" => false, "message" => "username undefined"]);
        }
        $existing_user = User::where('nom', 'like', $request->user)->first();
        if ($existing_user == null) {
            $user = new User();
            $user->nom = $request->user;
            $user->last_connection = Carbon::now();
            $user->online = true;
            $user->updated_at = Carbon::now();
            $user->save();
            $token = $user->createToken('token');

            return response()->json(['success' => true, 'message' => 'user created', 'data' => $user->toArray(), 'token' => $token->plainTextToken], 200)
                ->withCookie(cookie('token', $token->plainTextToken, 60 * 24));
        } else {
            $existing_user->update(["online" => true]);
            $deleted_tokens = $existing_user->tokens()->delete();
            $token = $existing_user->createToken('token');

            return response()->json(['success' => true, 'message' => 'user retrieved', 'data' => $existing_user->toArray(), 'token' => $token->plainTextToken], 200)
                ->withCookie(cookie('token', $token->plainTextToken, 60 * 24));
        }
    }

    public function disconnectUser(){
        $user = $this->retrieveUserFromCookieToken();
        if($user == null){
            return response()->json(["success" => false, "message" => "unauthenticated"]);
        } else {
            $user->tokens()->delete();
            $deleted_cookie = Cookie::forget('token');
            $user->update(["online" => false, "last_connection" => Carbon::now()]);
            $user->save();
            //echo($user. "\n");
            return response()->json(["success" => true, "message" => "user disconnected", "data" => $user], 200);
        }
    }

    public function checkUserConnectionState(){
        $user = $this->retrieveUserFromCookieToken();
        if($user == null || $user->online == false){
            return response()->json(["success" => true, "message" => "user is not connected", "data" => ["online" => false, "user" => null]], 200);
        } else {
            return response()->json(["success" => true, "message" => "user connected", "data" => ["online" => true, "user" => $user]], 200);
        }
    }
}
