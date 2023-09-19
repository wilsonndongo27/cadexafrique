<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Banniere;

class CustomController extends Controller
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

    public function homeCustom(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $allslide = DB::table('bannieres')->orderBy('id', 'DESC')->get()->toArray();
            return view('analytics.customisation.banniere', compact('allslide'));
        }else{
            return view('analytics.401');
        }
    }

    /**Creer les slides pour la baniere su site */

    public function createSlide(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            #controle de validation des elements
            $this->validate($request,[
                'creator' => 'required',
                'title'=>'required',
                'labelDesc'=>'required',
                'description'=>'required',
                'type'=>'required',
                'photo' => 'required',
            ]);

            $admin = $request->input('creator');
            $title = $request->input('title');
            $labeldesc = $request->input('labelDesc');
            $description = $request->input('description');
            $type = $request->input('type');
            $photo = $request->file('photo');

            #enregistrement de l'image
            $extension = $photo->getClientOriginalExtension();
            Storage::disk('public')->put($photo->getFilename().'.'.$extension,  File::get($photo));

            $time = \Carbon\Carbon::now()->toDateTimeString();
            $data=array(
                'user_id'=>$admin,
                'title'=>$title,
                'labelDesc'=>$labeldesc,
                'description'=>$description,
                'type'=>$type,
                'photo'=>$photo->getFilename().'.'.$extension,
                'created_at' => $time,
                'updated_at' => $time);
            DB::table('bannieres')->insert($data);

            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }

    }

    /**************************Mise a jour des slides **************************** */
    public function UpdateSlide(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'slide_id' => 'required',
            ]);
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $slide_id = $request->input('slide_id');
            $title = $request->input('title');
            $labeldesc = $request->input('labelDesc');
            $description = $request->input('description');
            $type = $request->input('type');
            $photo = $request->file('photo');

            #enregistrement de l'image
            if($photo != null){
                $extension = $photo->getClientOriginalExtension();
                Storage::disk('public')->put($photo->getFilename().'.'.$extension,  File::get($photo));

                DB::update('update bannieres set title = ?, labelDesc = ?, description = ?, type = ?, photo = ?, updated_at = ?  where id = ?',
                    [
                        $title,
                        $labeldesc,
                        $description,
                        $type,
                        $photo->getFilename().".".$extension,
                        $time,
                        $slide_id
                    ]
                );
            }else{
                DB::update('update bannieres set title = ?, labelDesc = ?, description = ?, type = ?, updated_at = ?  where id = ?',
                    [
                        $title,
                        $labeldesc,
                        $description,
                        $type,
                        $time,
                        $slide_id
                    ]
                );
            }
            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }


    }

    /***************suppression des slides *************** */
    public function deleteSlide(Request $request){
        if($this->can_access() ==  true || $this->can_access_admin() == true){
            $slide_id = $request->input('currentslide');
            DB::delete('DELETE FROM bannieres WHERE id = ?', [$slide_id]);
            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }
    }
}
