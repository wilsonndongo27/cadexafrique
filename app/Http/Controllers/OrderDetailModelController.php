<?php

namespace App\Http\Controllers;

use App\Models\OrderDetailModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class OrderDetailModelController extends Controller
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

    /**Creer les details des sous sous menus */
    public function createOther(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            #controle de validation des elements
            $this->validate($request,[
                'creator' => 'required',
                'title'=>'required',
                'libelle' => 'required',
                'description' => 'required',
                'image' => 'required',
            ]);

            $newdetail = new OrderDetailModel();

            $admin = $request->input('creator');
            $menu = $request->input('menu_id');
            $title = $request->input('title');
            $libelle = $request->input('libelle');
            $description = $request->input('description');
            $image = $request->file('image');

            #enregistrement de l'image
            $extension = $image->getClientOriginalExtension();
            Storage::disk('public')->put($image->getFilename().'.'.$extension,  File::get($image));

            $time = \Carbon\Carbon::now()->toDateTimeString();

            $newdetail->creator = $admin;
            $newdetail->menu_id = $menu;
            $newdetail->title = $title;
            $newdetail->libelle = $libelle;
            $newdetail->description = $description;
            $newdetail->image = $image->getFilename().'.'.$extension;
            $newdetail->niveau = '3';
            $newdetail->created_at = $time;
            $newdetail->updated_at = $time;
            $newdetail->save();

            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }

    }

    /**************************Mise a jour des contenus des sous sous **************************** */
    public function UpdateOther(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'content_id' => 'required',
            ]);

            $time = \Carbon\Carbon::now()->toDateTimeString();
            $content_id = $request->input('content_id');
            $title = $request->input('title');
            $libelle = $request->input('libelle');
            $description = $request->input('description');
            $image = $request->file('image');

            /**get the current contenu  */
            $currentContent = OrderDetailModel::where('id', $content_id)->first();

            #enregistrement de l'image
            if($image != null){
                //code for remove old file
                Storage::disk('public')->delete($currentContent->image);

                //upload new file
                $extension = $image->getClientOriginalExtension();
                Storage::disk('public')->put($image->getFilename().'.'.$extension,  File::get($image));

                $currentContent->image = $image->getFilename().".".$extension;
            }

            $currentContent->title = $title;
            $currentContent->libelle = $libelle;
            $currentContent->description = $description;
            $currentContent->updated_at = $time;
            $currentContent->save();
            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }


    }

    /***************suppression des contenus des sous sous *************** */
    public function deleteOther(Request $request){
        if($this->can_access() ==  true || $this->can_access_admin() == true){
            $content_id = $request->input('currentcontent');
            $currentcontent = OrderDetailModel::where('id',  $content_id)->first();
            $currentcontent->delete();
            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }
    }


    /**GSESTION DES CONTENUS DES SOUS MENUS */

    /**Creer les details des sous menus */
    public function createSubContenu(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            #controle de validation des elements
            $this->validate($request,[
                'creator' => 'required',
                'title'=>'required',
                'libelle' => 'required',
                'description' => 'required',
                'image' => 'required',
            ]);

            $newdetail = new OrderDetailModel();

            $admin = $request->input('creator');
            $menu = $request->input('menu_id');
            $title = $request->input('title');
            $libelle = $request->input('libelle');
            $description = $request->input('description');
            $image = $request->file('image');

            #enregistrement de l'image
            $extension = $image->getClientOriginalExtension();
            Storage::disk('public')->put($image->getFilename().'.'.$extension,  File::get($image));

            $time = \Carbon\Carbon::now()->toDateTimeString();

            $newdetail->creator = $admin;
            $newdetail->menu_id = $menu;
            $newdetail->title = $title;
            $newdetail->libelle = $libelle;
            $newdetail->description = $description;
            $newdetail->image = $image->getFilename().'.'.$extension;
            $newdetail->niveau = '2';
            $newdetail->created_at = $time;
            $newdetail->updated_at = $time;
            $newdetail->save();

            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }

    }

    /**************************Mise a jour des contenus des sous **************************** */
    public function UpdateSubContenu(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'content_id' => 'required',
            ]);
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $content_id = $request->input('content_id');
            $title = $request->input('title');
            $libelle = $request->input('libelle');
            $description = $request->input('description');
            $image = $request->file('image');

            /**get the current contenu  */
            $currentContent = OrderDetailModel::where('id', $content_id)->first();

            #enregistrement de l'image
            if($image != null){
                //code for remove old file
                Storage::disk('public')->delete($currentContent->image);

                //upload new file
                $extension = $image->getClientOriginalExtension();
                Storage::disk('public')->put($image->getFilename().'.'.$extension,  File::get($image));

                $currentContent->image = $image->getFilename().".".$extension;
            }

            $currentContent->title = $title;
            $currentContent->libelle = $libelle;
            $currentContent->description = $description;
            $currentContent->updated_at = $time;
            $currentContent->save();
            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }


    }

    /***************suppression des contenus des menus *************** */
    public function deleteSubContenu(Request $request){
        if($this->can_access() ==  true || $this->can_access_admin() == true){
            $content_id = $request->input('currentcontent');
            $currentcontent = OrderDetailModel::where('id',  $content_id)->first();
            $currentcontent->delete();
            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }
    }

}
