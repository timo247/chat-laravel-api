<?php

namespace App\Http\Controllers;

use App\Http\Requests\messageRequest;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Throwable;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = DB::table('messages')->get();
        return($messages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $contenuMessageJson = $request->json()->all();

        // dd($contenuMessageJson);
        // $input = $request->input();
        // $message = new Message();

        // $user = auth()->user();
        // $userId=$user->id;

        // $message->contenu = $input["contenu"];
        // $message->user_id = $userId;
        // $message->created_at = Carbon::now()->toDateTimeString();
        // $message->created_at = Carbon::now()->toDateTimeString();
        // $message->save();

        // return $this->modelsToJson($message);
        //dd($request);
        

        try
        {
            Message::create($request->all());
            return response()->json(['succes' => 'messafe créée avec succes'], 200);
        } catch  (Throwable $th){
            return response()->json(['echec' => $request], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
