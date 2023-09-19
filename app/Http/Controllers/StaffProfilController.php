<?php

namespace App\Http\Controllers;

use App\Models\StaffProfil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\StaffInfos;
use App\Models\InfosEntreprise;
use Illuminate\Http\Request;

class StaffProfilController extends Controller
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
    public function StaffProfilIndex()
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $current_user = Auth::user();
            $dataprofil = StaffProfil::select("*")
                                ->orderBy('id')
                                ->get();
            $allprofil = array();
            foreach ($dataprofil as $item) {
                $creator = User::where('id', $item->user_id)->first();
                $data = [
                    'id' => $item->id,
                    'creator' => $creator->name,
                    'name' => $item->name,
                    'status' => $item->status,
                    'created_at' => $item->created_at,
                ];
                $object = json_decode(json_encode($data), FALSE);
                array_push($allprofil, $object);
            }
            return view('analytics.staff.home-staff-profil', compact('allprofil'));
        }else{
            return view('analytics.401');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createProfilStaff(Request $request)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){

            #controle de validation des elements
            $this->validate($request,[
                'creator' => 'required',
                'name'=>'required',
            ]);

            $admin = $request->input('creator');
            $name = $request->input('name');

            $time = \Carbon\Carbon::now()->toDateTimeString();

            $newprofil = new StaffProfil();
            $newprofil->user_id = $admin;
            $newprofil->name = $name;
            $newprofil->created_at = $time;
            $newprofil->updated_at = $time;
            $newprofil->save();

            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function UpdateProfilStaff(Request $request)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'profil_id' => 'required',
            ]);

            $profil_id = $request->input('profil_id');
            $name = $request->input('name');
            $time = \Carbon\Carbon::now()->toDateTimeString();

            $updateprofil = StaffProfil::where('id', $profil_id)->first();

            $updateprofil->name = $name;
            $updateprofil->updated_at = $time;
            $updateprofil->save();

            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function changeProfilStaffStatus(Request $request)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'idprofil' => 'required',
            ]);
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $profil_id = $request->input('idprofil');

            /**get the current menu  */
            $currentprofil = StaffProfil::where('id', $profil_id)->first();
            if($currentprofil->status == 1){
                $currentprofil->status = 0;
            }else{
                $currentprofil->status = 1;
            }
            $newstatus = $currentprofil->save();
            return response()->json([
                'message'=>'L\'opération a Réussi!', 'etat'=>'1',
                'newstatus' => $newstatus
            ]);
        }else{
            return view('analytics.401');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function deleteProfilStaff(Request $request)
    {
        if($this->can_access() ==  true || $this->can_access_admin() == true){
            $profil_id = $request->input('currentprofil');
            StaffProfil::findOrFail($profil_id)->delete();
            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }
    }
}
