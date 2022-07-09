<?php

namespace App\Http\Controllers;

use App\Models\Chatbot;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ChatbotController extends Controller
{
    public function __construct()
    {
        $this->chat_bot_management_data = Chatbot::findOrFail(1);
        $this->message = new Message();
        $this->message->user_id = 1;
        $this->message->created_at = Carbon::now()->addSeconds(2);
        $this->message->contenu = "un problème dans le chat est survenu.";
    }

    public function sendBotMessage()
    {
        if ($this->chat_bot_management_data->user_desactivation == true) {
           // echo ("chatbot inactif");
        } else {
            //echo ("sent: " . $this->message->contenu . "\n");
            $this->message->save();
        }
    }

    public function firstActivateChatbot()
    {
        $this->chat_bot_management_data->update(["last_initialization" => Carbon::now(), "last_activation" => Carbon::now(), "user_desactivation" => false]);
        $this->message->contenu = "Je suis Amelia, le bot de la messagerie. Il semblerait que nous soyons les seul.es en ligne. Souhaitez-vous discuter avec moi ? Ecrivez ce que vous souhaitez et je répondrai comme je peux. Si vous souhaitez que j'arrête de parler, envoyez !stop";
    }

    public function reActivateChatbot()
    {

        $this->message->contenu = "Il semblerait que vous souhaitez encore parler avec moi ? Je vous écoute. Envoyez !stop pour me désactiver.";
        $this->sendBotMessage();
        $this->chat_bot_management_data->update(["last_activation" => Carbon::now(), "user_desactivation" => false, "user_reactivation" => true]);
    }

    public function desactivateChatbot()
    {
        $this->message->contenu = "Je me désactive. Envoyez !chatbot si vous souhaitez à nouveau m'activer.";
        $this->sendBotMessage();
        $this->chat_bot_management_data->update(["user_desactivation" => true, "user_reactivation" => false, "last_activation" => Carbon::now()]);
    }

    public function resetChatbot()
    {
        $this->chat_bot_management_data->update(["user_desactivation" => false, "user_reactivation" => false, "last_activation" => Carbon::now()]);
    }


    public function pickRandomQuote()
    {
        $nb_citations = DB::table('citations')->count();
        $id_citation = random_int(1, $nb_citations);
        $citation = DB::table('citations')->where('id', '=', $id_citation)->first();
        $this->message->contenu = $citation->contenu;
    }

    public function checkUsersInteractions()
    {
        $messages = DB::table('messages')->where('created_at', '>=', $this->chat_bot_management_data->last_activation)->get();

        if ($messages[0] != null) {
            foreach ($messages as $message) {
                if ($message->contenu == "!stop") {
                    if ($this->chat_bot_management_data->user_desactivation != true) {
                        $this->desactivateChatbot();
                        //echo ("on désctive mtn");
                    }
                } else if ($message->contenu == "!chatbot") {
                    if ($this->chat_bot_management_data->user_reactivation != true) {
                        $this->reActivateChatbot();
                        $this->sendBotMessage();
                        return;
                    }
                }
            }
            $this->pickRandomQuote();
            $this->sendBotMessage();
        }
    }

    public function useBot()
    {
        $user_controller = new Controller;
        $user = $user_controller->retrieveUserFromCookieToken();
        $nb_connected_users = DB::table('users')->where('online', '=', true)->count();


        if($nb_connected_users <= 1){
            $this->resetChatbot();
        }
        if ($nb_connected_users == 2) {
            if ($this->chat_bot_management_data->last_initialization <= $user->last_connection) {
                $this->firstActivateChatbot();
                $this->sendBotMessage();
                return;
            } else {
                $this->checkUsersInteractions();
                return;
            }
        }
    }
}
