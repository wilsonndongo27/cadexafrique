<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use App\Models\User;

use function React\Promise\Stream\first;

class ServiceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

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

    public function homeService(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $current_user = Auth::user();
            $dataservice = DB::table('service')->orderBy('id', 'DESC')->get()->toArray();
            $allservice = array();
            foreach ($dataservice as $item) {
                $creator = User::where('id', $item->user_id)->first();
                $data = [
                    'id' => $item->id,
                    'title' => $item->title,
                    'labelDesc' => $item->labelDesc,
                    'description' => $item->description,
                    'creator' => $creator->name,
                    'cover' => $item->cover,
                    'created_at' => $item->created_at,
                ];
                $object = json_decode(json_encode($data), FALSE);
                array_push($allservice, $object);
            }
            return view('analytics.customisation.service', compact('allservice'));
        }else{
            return view('analytics.401');
        }
    }

    /**Creer des services */
    public function CreateService(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            #controle de validation des elements
            $this->validate($request,[
                'creator' => 'required',
                'title'=>'required',
                'priority' => 'required',
                'labelDesc' => 'required',
                'description'=>'required',
                'cover' => 'required',
            ]);
            $admin = $request->input('creator');
            $title = $request->input('title');
            $priority = $request->input('priority');
            $label = $request->input('labelDesc');
            $description = $request->input('description');
            $cover = $request->file('cover');

            #enregistrement de l'image
            $extension = $cover->getClientOriginalExtension();
            Storage::disk('public')->put($cover->getFilename().'.'.$extension,  File::get($cover));

            $time = \Carbon\Carbon::now()->toDateTimeString();
            $data=array(
                'user_id'=>$admin,
                'title'=>$title,
                'priority'=>$priority,
                'labelDesc' => $label,
                'description'=>$description,
                'cover'=>$cover->getFilename().'.'.$extension,
                'created_at' => $time,
                'updated_at' => $time);
            DB::table('service')->insert($data);

            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }

    }

    /**************************Mise a jour des slides **************************** */
    public function UpdateService(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'service_id' => 'required',
            ]);
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $service_id = $request->input('service_id');
            $title = $request->input('title');
            $priority = $request->input('priority');
            $label = $request->input('labelDesc');
            $description = $request->input('description');
            $cover = $request->file('cover');

            /**get the current service  */
            $currentService = Service::where('id', $service_id)->first();

            #enregistrement de l'image
            if($cover != null){
                //code for remove old file
                Storage::disk('public')->delete($currentService->cover);

                //upload new file
                $extension = $cover->getClientOriginalExtension();
                Storage::disk('public')->put($cover->getFilename().'.'.$extension,  File::get($cover));

                $currentService->cover = $cover->getFilename().".".$extension;
            }

            $currentService->title = $title;
            $currentService->priority = $priority;
            $currentService->labelDesc = $label;
            $currentService->description = $description;
            $currentService->updated_at = $time;
            $currentService->save();
            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }


    }

    /***************suppression des slides *************** */
    public function DeleteService(Request $request){
        if($this->can_access() ==  true || $this->can_access_admin() == true){
            $service_id = $request->input('currentservice');
            DB::delete('DELETE FROM service WHERE id = ?', [$service_id]);
            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }
    }
}
