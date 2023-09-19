<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SupportAPIController extends Controller
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
    public function createTicket(Request $request)
    {
        $rules = array (
            'name' => 'required',
            'email' => 'required',
            'telephone' => 'required',
            'interest' => 'required',
        );
        $token = $request->input('token');
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json(['message' => 'Echec de l\opération vérifier votre formulaire']);
        }else{
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $data=array(
                'name'=>$request->input('name'), 
                'email'=>$request->input('email'), 
                'telephone'=>$request->input('telephone'),
                'interest'=>$request->input('interest'),
                'created_at' => $time);
            DB::table('support')->insert($data);
            return response()->json([
                'message' => 'Opération effectuer avec succès!',
                'token' => $token,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
