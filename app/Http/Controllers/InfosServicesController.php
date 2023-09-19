<?php

namespace App\Http\Controllers;

use App\Models\InfosServices;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class InfosServicesController extends Controller
{
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
    public function index(Request $request, $id)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $current_user = Auth::user();
            $currentservice = Service::where('id', $id)->first();
            $alldetailservice = DB::table('infos_services')->where('service_id', $currentservice->id)->get()->toArray();
            $finaldatadetail = array();
            foreach ($alldetailservice as $item) {
                $creator = User::where('id', $item->user_id)->first();
                $data = [
                    'id' => $item->id,
                    'title' => $item->title,
                    'description' => $item->description,
                    'creator' => $creator->name,
                    'cover' => $item->cover,
                    'created_at' => $item->created_at,
                ];
                $object = json_decode(json_encode($data), FALSE);
                array_push($finaldatadetail, $object);
            }
            return view('analytics.customisation.plusinfoservice', compact('finaldatadetail'))->with('service', $currentservice);
        }else{
            return view('analytics.401');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            #controle de validation des elements
            $this->validate($request,[
                'creator' => 'required',
                'service_detail_id' => 'required',
                'title'=>'required',
                'description'=>'required',
                'cover' => 'required',
            ]);
            $admin = $request->input('creator');
            $service = $request->input('service_detail_id');
            $title = $request->input('title');
            $description = $request->input('description');
            $cover = $request->file('cover');

            #enregistrement de l'image
            $extension = $cover->getClientOriginalExtension();
            Storage::disk('public')->put($cover->getFilename().'.'.$extension,  File::get($cover));

            $time = \Carbon\Carbon::now()->toDateTimeString();

            $newdetail = new InfosServices();
            $newdetail->user_id = $admin;
            $newdetail->service_id = $service;
            $newdetail->title = $title;
            $newdetail->description = $description;
            $newdetail->cover = $cover->getFilename().'.'.$extension;
            $newdetail->created_at = $time;
            $newdetail->updated_at = $time;
            $newdetail->save();
            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InfosServices  $infosServices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InfosServices $infosServices)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'detail_service_id' => 'required',
            ]);
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $detail_service_id = $request->input('detail_service_id');
            $title = $request->input('title');
            $description = $request->input('description');
            $cover = $request->file('cover');

            /**get the current service  */
            $currentDetail = InfosServices::where('id', $detail_service_id)->first();

            #enregistrement de l'image
            if($cover != null){
                //code for remove old file
                Storage::disk('public')->delete($currentDetail->cover);

                //upload new file
                $extension = $cover->getClientOriginalExtension();
                Storage::disk('public')->put($cover->getFilename().'.'.$extension,  File::get($cover));

                $currentDetail->cover = $cover->getFilename().".".$extension;
            }

            $currentDetail->title = $title;
            $currentDetail->description = $description;
            $currentDetail->updated_at = $time;
            $currentDetail->save();
            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InfosServices  $infosServices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, InfosServices $infosServices)
    {
        if($this->can_access() ==  true || $this->can_access_admin() == true){
            $detail_article_id = $request->input('currentservicedetail');
            DB::delete('DELETE FROM infos_services WHERE id = ?', [$detail_article_id]);
            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }
    }
}
