<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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

class CompteUserController extends Controller
{
    /**Home user */
      /**Verificateur d'accès utilisateur  */
      public function can_access(){
        if(Auth::check()){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Authenticate the user
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::once($credentials)){
            Auth::login(Auth::user());
            $datauser = Auth::user();
            return response()->json([
                'message'=>'Connexion réussi!',
                'status'=>'200']);
        }else {
            return response()->json(['message'=>'Mot de passe ou Email incorrect!', 'status'=>'500']);
        }


    }



    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->to('home');
    }


    /**Create User */
    public function SignUpUser(Request $request){
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
                $user = new User();
                $user->name = $name;
                $user->email = $email;
                $user->telephone = $telephone;
                $user->password = Hash::make($password);
                $user->api_token = hash('sha256', $token);
                $user->pp = $filename.'.'.$extension;
                $user->is_admin = '0';
                $user->is_superadmin = '0';
                $user->created_at = $time;
                $user->save();
            }
            return response()->json([
                'message' => 'L\'opération a réussi!',
                'status' => '200'
            ]);
        }else{
            return response()->json([
                'message' => 'Une erreur est survenue contacter l\'useristrateur',
                'status' => '500'
            ]);
        }
    }

    /**************************Mise a jour des articles **************************** */
    public function UpdateUer(Request $request){
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
    public function deleteUser(Request $request){
        if($this->can_access() ==  true){
            $admin_id = $request->input('currentadmin');
            DB::delete('DELETE FROM users WHERE id = ?', [$admin_id]);
            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }
    }

    /**************************Mise a jour du  status d'un asministrateur (Bloquer ou Débloquer) **************************** */
    public function UpdateStatusUser(Request $request){
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
