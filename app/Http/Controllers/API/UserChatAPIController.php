<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Broadcast;
use App\Events\MessageSend;

class UserChatAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUserChat(Request $request)
    {
        $user = User::where('email', '=', $request->input('email'))->first();
        if ($user === null) {
            $rules = array (
                'name' => 'required',
                'email' => 'required',  
                'phone' => 'required',
            );
            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()){
                return response()->json(['message' => 'Echec de l\opération vérifier votre formulaire']);
            }else{
                $user = new User();
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->telephone = $request->input('phone');

                // 
                $user->save();
                $user2 = new User();
                return response()->json([
                    'status'=> true,
                    'message' => 'Opération effectuer avec succès!',
                    'infosUserChat' => $user,
                ]);
            }
        }else{
            $message = ChatMessage::where('user_id', $user)
            ->orderBy('id', 'DESC')
            ->take('10')
            ->get();
            return response()->json([
                'status'=> true,
                'infosUserChat' => $user,
                'messages' => $message,
            ]);
        }
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function fetchMessages()
    {
        return ChatMessage::with('user')->get();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendMessage(Request $request)
    {
        $message = new ChatMessage();
        $message->user_id = $request->user_id;
        $message->customer_id = $request->customer_id;
        $message->owner_id = $request->owner_id;
        $message->message = $request->message;
        $message->message_rep = $request->message_rep;
        $message->save();

        if($request->customer_id == $request->owner_id){
            $user = User::where('id', $request->customer_id)->get();
        }else{
            $user = User::where('id', $request->user_id)->get();
        }

        $all_message_client = ChatMessage::where('user_id', $request->user_id)->get()->toArray();

		broadcast(new MessageSend($user, $message))->toOthers();

        return response()->json(['status' => true, 'current_message' => $message, 'all_message_client' => $all_message_client]);
    }

 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
