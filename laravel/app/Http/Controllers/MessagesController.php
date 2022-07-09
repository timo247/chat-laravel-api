<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessagesController extends Controller
{
    public function __construct()
    {
        //$this->middleware('chat_bot')->only('addMessage');
    }

    public function showMessages()
    {

        $user = $this->retrieveUserFromCookieToken();
        //Update user last activity
        $user->touch();

        //Disconnect all afk users
        $usersController = new UsersController();
        $usersController->disconnectAllIntactiveUsers();

        if ($user->online == true) {
            //Get and return messages
            $messages_time_range = Carbon::createFromDate($user->last_connection);
            $messages = DB::Table('messages')->where('created_at', '>=', $messages_time_range)->where('created_at', '<=', Carbon::now())->orderBy('created_at', 'desc')->limit(10)->get();

            $messages_to_return = [];
            foreach ($messages as $message) {
                $formated_message = [];
                $formated_message["message"] = $message->contenu;
                $formated_message["created_at"] = Carbon::createFromDate($message->created_at)->format('H:i');
                    //$message->created_at->format('H:i');
                $formated_message["id"] = $message->id;

                $corresponding_user = User::findOrFail($message->user_id);
                $formated_message["username"] = $corresponding_user->nom;
                $formated_message["user_id"] = $corresponding_user->id;

                array_push($messages_to_return, $formated_message);
            }
            
            //Remise dans l'autre ordre, pour que la query concerne les derniers messages mais qu'ils soient servis dans l'ordre
            $messages_to_return = array_reverse($messages_to_return);

            //echo('nom user '. $user->nom. ' user_last_connection '.$user->last_connection. 'time range '. $messages_time_range);
            return response()->json(['success' => true, 'message' => 'fetched messages', 'data' => $messages_to_return], 200);
        } else {
            return response()->json(["status" => "fail", "message" => "user disconnected"], 200);
        }
    }

    public function addMessage(Request $request)
    {

        $user = $this->retrieveUserFromCookieToken();

        if ($user == null) {
            return response()->json(["status" => "failure", "message" => "unauthenticated"]);
        } else if ($user->online == true) {
            $message = new Message();
            $message->user_id = $user->id;
            $message->contenu = $request->msg;
            $message->created_at = Carbon::now();
            $message->updated_at = Carbon::now();
            $message->save();

            $chatbot_controller = new ChatbotController;
            $chatbot_controller->useBot();
            //echo($request->message);
            return response()->json(["status" => "success", "message" => "message added", "data" => $message], 200);
        } else {
            return response()->json(["status" => "fail", "message" => "user disconnected"], 200);
        }
    }
}
