<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Supports;
use App\Models\InfosEntreprise;
use Illuminate\Support\Facades\Validator;

class SupportController extends Controller
{
    /**Controlleur d'acces super administrateur */
    public function can_access(){
        if(Auth::check() && Auth::user()->is_superadmin == 1){
            return true;
        }else{
            return false;
        }
     }

     /**Verificateur d'accès admins  */
    public function can_access_admin(){
        if(Auth::check() && Auth::user()->is_admin == 1){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSupport()
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $current_user = Auth::user();
            $allsupport = DB::table('support')->orderBy('id', 'DESC')->get()->toArray();
            return view('analytics.support.homesupport',
                compact('allsupport'))
                ->with('user_name', $current_user);
        }else{
            return view('analytics.401');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createMail()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function NewsLetterUser(Request $request)
    {

        $rules = array(
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        /**initialisation des variables */
        $name = $request->input('name');
        $email = $request->input('email');
        $message = $request->input('message');
        $interest = $request->input('subject');
        $time = \Carbon\Carbon::now()->toDateTimeString();

        if($validator->fails()){
            return response()->json([
                'message' => 'Une erreur dans le formulaire',
                'status' => '200'
            ]);
        }else{
            /**Sauvegarde des donnees */
            $newsletter = new Supports();
            $newsletter->name = $name;
            $newsletter->email = $email;
            $newsletter->interest = $interest;
            $newsletter->message = $message;
            $newsletter->created_at = $time;
            $newsletter->save();
        }
        return response()->json([
            'message' => 'L\'opération a réussi. Votre message a été envoyé avec succès!',
            'status' => '200'
        ]);
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
    public function destroyTicket(Request $request)
    {
        if($this->can_access() ==  true || $this->can_access_admin() == true){
            $ticket_id = $request->input('currentticket');
            DB::delete('DELETE FROM support WHERE id = ?', [$ticket_id]);
            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }
    }
}
