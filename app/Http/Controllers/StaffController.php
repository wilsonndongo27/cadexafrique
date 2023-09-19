<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\StaffInfos;
use App\Models\InfosEntreprise;
use App\Models\StaffProfil;

use Illuminate\Http\Request;

class StaffController extends Controller
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
    public function StaffIndex()
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $current_user = Auth::user();
            $allprofil = StaffProfil::where('status', 1)->get();
            $datastaff = StaffInfos::select("*")
                                ->orderBy('id')
                                ->get();
            $allstaff = array();
            foreach ($datastaff as $item) {
                $creator = User::where('id', $item->user_id)->first();
                $poste = StaffProfil::where('id', $item->poste)->first();
                $data = [
                    'id' => $item->id,
                    'first_name' => $item->first_name,
                    'last_name' => $item->last_name,
                    'telephone' => $item->telephone,
                    'adresse' => $item->adresse,
                    'email' => $item->email,
                    'poste' => $poste->name,
                    'posteid' => $poste->id,
                    'photo' => $item->photo,
                    'status' => $item->status,
                    'creator' => $creator->name,
                    'freetext1' => $item->freetext1,
                    'created_at' => $item->created_at,
                ];
                $object = json_decode(json_encode($data), FALSE);
                array_push($allstaff, $object);
            }
            return view('analytics.staff.home-staff', compact('allstaff', 'allprofil'));
        }else{
            return view('analytics.401');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStaff(Request $request)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){

            #controle de validation des elements
            $this->validate($request,[
                'creator' => 'required',
                'first_name'=>'required',
                'last_name'=>'required',
                'telephone'=>'required',
                'adresse'=>'required',
                'email'=>'required',
                'photo'=>'required',
                'poste'=>'required'
            ]);

            $admin = $request->input('creator');
            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $telephone = $request->input('telephone');
            $adresse = $request->input('adresse');
            $email = $request->input('email');
            $poste = $request->input('poste');
            $photo = $request->file('photo');
            $freetext1 = $request->input('freetext1');

            #enregistrement de l'image
            $extension = $photo->getClientOriginalExtension();
            Storage::disk('public')->put($photo->getFilename().'.'.$extension,  File::get($photo));


            $time = \Carbon\Carbon::now()->toDateTimeString();

            $newstaff = new StaffInfos();
            $newstaff->user_id = $admin;
            $newstaff->first_name = $first_name;
            $newstaff->last_name = $last_name;
            $newstaff->telephone = $telephone;
            $newstaff->adresse = $adresse;
            $newstaff->email = $email;
            $newstaff->poste = $poste;
            $newstaff->freetext1 = $freetext1;
            $newstaff->photo = $photo->getFilename().'.'.$extension;
            $newstaff->created_at = $time;
            $newstaff->updated_at = $time;
            $newstaff->save();

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
    public function UpdateStaff(Request $request)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'staff_id' => 'required',
            ]);

            $staff_id = $request->input('staff_id');
            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $telephone = $request->input('telephone');
            $adresse = $request->input('adresse');
            $email = $request->input('email');
            $poste = $request->input('poste');
            $photo = $request->file('photo');
            $freetext1 = $request->input('freetext1');
            $time = \Carbon\Carbon::now()->toDateTimeString();


            $updatestaff = StaffInfos::where('id', $staff_id)->first();

            #mise de jour de l'image
            if($photo != null){
                //code for remove old file
                Storage::disk('public')->delete($updatestaff->photo);

                //upload new file
                $extension = $photo->getClientOriginalExtension();
                Storage::disk('public')->put($photo->getFilename().'.'.$extension,  File::get($photo));

                $updatestaff->photo = $photo->getFilename().".".$extension;
            }

            $updatestaff->first_name = $first_name;
            $updatestaff->last_name = $last_name;
            $updatestaff->telephone = $telephone;
            $updatestaff->adresse = $adresse;
            $updatestaff->email = $email;
            $updatestaff->poste = $poste;
            $updatestaff->freetext1 = $freetext1;
            $updatestaff->updated_at = $time;
            $updatestaff->save();

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
    public function changeStaff(Request $request)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'idstaff' => 'required',
            ]);
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $staff_id = $request->input('idstaff');

            /**get the current menu  */
            $currentStaff = StaffInfos::where('id', $staff_id)->first();
            if($currentStaff->status == 1){
                $currentStaff->status = 0;
            }else{
                $currentStaff->status = 1;
            }
            $newstatus = $currentStaff->save();
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
    public function deleteStaff(Request $request)
    {
        if($this->can_access() ==  true || $this->can_access_admin() == true){
            $staff_id = $request->input('currentstaff');
            StaffInfos::findOrFail($staff_id)->delete();
            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function EntrepriseIndex()
    {
        if($this->can_access() == true || $this->can_access_admin() == true){

            $dataentreprise = "";

            if(InfosEntreprise::where("id", 1)->first() !== ''){
                $dataentreprise = InfosEntreprise::where("id", 1)->first();
            }

            return view('analytics.staff.home-entreprise-info')->with("entreprise", $dataentreprise);
        }else{
            return view('analytics.401');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createEntreprise(Request $request)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){

            #controle de validation des elements
            $this->validate($request,[
                'creator' => 'required',
                'name'=>'required',
                'contexte'=>'required',
                'activity'=>'required',
                'vision'=>'required',
                'mission'=>'required',
                'objectifs'=>'required',
                'adresse1'=>'required',
                'telephone1'=>'required',
                'email1'=>'required',
                'mapLink'=>'required',
                'logo'=>'required'
            ]);

            $admin = $request->input('creator');
            $name = $request->input('name');
            $contexte = $request->input('contexte');
            $activity = $request->input('activity');
            $vision = $request->input('vision');
            $mission = $request->input('mission');
            $objectifs = $request->input('objectifs');
            $adresse1 = $request->input('adresse1');
            $adresse2 = $request->input('adresse2');
            $telephone1 = $request->input('telephone1');
            $telephone2 = $request->input('telephone2');
            $email1 = $request->input('email1');
            $email2 = $request->input('email2');
            $mapLink = $request->input('mapLink');
            $logo = $request->file('logo');
            $cover = $request->file('cover');

            #enregistrement du logo
            $extensionlogo = $logo->getClientOriginalExtension();
            Storage::disk('public')->put($logo->getFilename().'.'.$extensionlogo,  File::get($logo));

            $time = \Carbon\Carbon::now()->toDateTimeString();

            $newinfoent = new InfosEntreprise();

            #enregistrement de la photo de couverture
            if($cover != null){
                $extensioncover = $cover->getClientOriginalExtension();
                Storage::disk('public')->put($cover->getFilename().'.'.$extensioncover,  File::get($cover));
                $newinfoent->cover = $cover->getFilename().'.'.$extensioncover;
            }


            $newinfoent->user_id = $admin;
            $newinfoent->name = $name;
            $newinfoent->contexte = $contexte;
            $newinfoent->activity = $activity;
            $newinfoent->vision = $vision;
            $newinfoent->mission = $mission;
            $newinfoent->objectifs = $objectifs;
            $newinfoent->adresse1 = $adresse1;
            $newinfoent->adresse2 = $adresse2;
            $newinfoent->telephone1 = $telephone1;
            $newinfoent->telephone2 = $telephone2;
            $newinfoent->email1 = $email1;
            $newinfoent->email2 = $email2;
            $newinfoent->mapLink = $mapLink;
            $newinfoent->logo = $logo->getFilename().'.'.$extensionlogo;
            $newinfoent->created_at = $time;
            $newinfoent->updated_at = $time;
            $newinfoent->save();

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
    public function UpdateEntreprise(Request $request)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){

            $name = $request->input('name');
            $contexte = $request->input('contexte');
            $activity = $request->input('activity');
            $vision = $request->input('vision');
            $mission = $request->input('mission');
            $objectifs = $request->input('objectifs');
            $adresse1 = $request->input('adresse1');
            $adresse2 = $request->input('adresse2');
            $telephone1 = $request->input('telephone1');
            $telephone2 = $request->input('telephone2');
            $email1 = $request->input('email1');
            $email2 = $request->input('email2');
            $mapLink = $request->input('mapLink');
            $logo = $request->file('logo');
            $cover = $request->file('cover');

            $time = \Carbon\Carbon::now()->toDateTimeString();


            $updateentreprise = InfosEntreprise::where('id', 1)->first();

            $time = \Carbon\Carbon::now()->toDateTimeString();

            #enregistrement du logo
            if($logo != null){
                //code for remove old file
                Storage::disk('public')->delete($updateentreprise->logo);

                $extensionlogo = $logo->getClientOriginalExtension();
                Storage::disk('public')->put($logo->getFilename().'.'.$extensionlogo,  File::get($logo));
                $updateentreprise->logo = $logo->getFilename().'.'.$extensionlogo;
            }

            #enregistrement de la photo de couverture
            if($cover != null){
                //code for remove old file
                Storage::disk('public')->delete($updateentreprise->cover);

                $extensioncover = $cover->getClientOriginalExtension();
                Storage::disk('public')->put($cover->getFilename().'.'.$extensioncover,  File::get($cover));
                $updateentreprise->cover = $cover->getFilename().'.'.$extensioncover;
            }

            $updateentreprise->name = $name;
            $updateentreprise->contexte = $contexte; 
            $updateentreprise->activity = $activity;
            $updateentreprise->vision = $vision;
            $updateentreprise->mission = $mission;
            $updateentreprise->objectifs = $objectifs;
            $updateentreprise->adresse1 = $adresse1;
            $updateentreprise->adresse2 = $adresse2;
            $updateentreprise->telephone1 = $telephone1;
            $updateentreprise->telephone2 = $telephone2;
            $updateentreprise->email1 = $email1;
            $updateentreprise->email2 = $email2;
            $updateentreprise->mapLink = $mapLink;
            $updateentreprise->updated_at = $time;
            $updateentreprise->save();

            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }
    }

}
