<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CompteAdminController extends Controller
{
    /**Controlleur d'acces super administrateur */
    public function can_access(){
        if(Auth::check() && Auth::user()->is_superadmin == 1){
            return true;
        }else{
            return false;
        }
    }

    /**Verification si l'email existe dans le system ou pas */
    public function Check_email_exist($data){
        $user = DB::table('users')->where('email', $data)->first();
        if($user === null){
            return false;
        }else{
            return true;
        }
    }

    /*********************Gestion des administrateurs ************************** */
    /**Home admins */
    public function HomeAdmins(){
        if($this->can_access() == true){
            $alladmins = DB::table('users')->orderBy('id', 'DESC')->where('is_admin', '1')->get()->toArray();
            return view('analytics.compte.compteadmins', compact('alladmins'));
        }else{
            return view('analytics.401');
        }  
    }

    /**Create admins */
    public function CreateAdmin(Request $request){
        if($this->can_access() == true){
            /**Controle de validation des inputs */
            $rules = array(
                'name' => 'required',
                'email' => 'required',
                'telephone' => 'required',
                'password' => 'required',
            );

            $validator = Validator::make($request->all(), $rules);

            /**initialisation des variables */
            $name = $request->input('name');
            $email = $request->input('email');
            $telephone = $request->input('telephone');
            $password = $request->input('password');
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $token = Str::random(80);
            $file = $request->file('photo');

            if( $request->hasFile('photo')){
                $extension = strtolower($file->getClientOriginalExtension());
                $filename = $file->getClientOriginalName();
            }else{
                $extension = '';
                $filename = '';
            }

            if($validator->fails()){
                return response()->json([
                    'message' => 'Une erreur dans le formulaire',
                    'etat' => '2'
                ]);
            }else if($this->Check_email_exist($request->input('email')) == true){
                return response()->json([
                    'message' => 'Cette adresse email existe déjà.',
                    'etat' => '2'
                ]);
            }else{
                /**Enregistrement de la photo */
                Storage::disk('public')->put($filename.'.'.$extension, File::get($file));
    
                /**Sauvegarde des donnees */
                $admin = new User();
                $admin->name = $name;
                $admin->email = $email;
                $admin->telephone = $telephone;
                $admin->password = Hash::make($password);
                $admin->api_token = hash('sha256', $token);
                $admin->pp = $filename.'.'.$extension;
                $admin->is_admin = '1';
                $admin->created_at = $time;
                $admin->save();
            }
            return response()->json([
                'message' => 'L\'opération a réussi!',
                'etat' => '1'
            ]);
        }else{
            return view('analytics.401');
        }
    }

    /**************************Mise a jour des articles **************************** */
    public function UpdateAdmin(Request $request){
        if($this->can_access() == true){
            $this->validate($request,[
                'currentadmin' => 'required',
            ]);
            $admin_id = $request->input('currentadmin');
            $name = $request->input('name');
            $email = $request->input('email');
            $telephone = $request->input('telephone');
            $password = $request->input('password');
            $file = $request->file('photo');
            /**get the current admin object */
            $admin = User::where('id', $admin_id)->first();
            if( $request->hasFile('photo')){
                $extension = strtolower($file->getClientOriginalExtension());
                $filename = $file->getClientOriginalName();

                Storage::disk('public')->put($filename.'.'.$extension,  File::get($file));
                if($name !== '' || $name !== null){
                    $admin->name = $name;
                }
                if($email !== '' || $email !== null){
                    $admin->email = $email;
                }
                if($telephone !== '' || $telephone !== null){
                    $admin->telephone = $telephone;
                }
                if($password !== '' || $password !== null){
                    $admin->password = Hash::make($password);
                }
                $admin->pp = $filename.'.'.$extension;
                $admin->save();
            }else{
                if($name !== '' || $name !== null){
                    $admin->name = $name;
                }
                if($email !== '' || $email !== null){
                    $admin->email = $email;
                }
                if($telephone !== '' || $telephone !== null){
                    $admin->telephone = $telephone;
                }
                if($password !== '' || $password !== null){
                    $admin->password = Hash::make($password);
                }
                $admin->save();
            }
            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }
        

    }

    /***************suppression des slides *************** */
    public function deleteAdmin(Request $request){
        if($this->can_access() ==  true){
            $admin_id = $request->input('currentadmin');
            DB::delete('DELETE FROM users WHERE id = ?', [$admin_id]);
            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }
    }

    /**************************Mise a jour du  status d'un asministrateur (Bloquer ou Débloquer) **************************** */
    public function UpdateStatusAdmin(Request $request){
        if($this->can_access() == true){
            $admin_id = $request->input('currentadmin');
            $status = $request->input('statusvalue');
            /**get the current admin object */
            $admin = User::where('id', $admin_id)->first();
            if($status == 1){
                $admin->actif = 0;
            }else{
                $admin->actif = 1;
            }
            $admin->save();
            $newstatus = $admin->actif;
            return response()->json([
                'message' => 'L\opération a réussi!',
                'status' => $newstatus,
                'etat' => '1'
            ]);
        }else{
            return view('analytics.401');
        }
    }

}
