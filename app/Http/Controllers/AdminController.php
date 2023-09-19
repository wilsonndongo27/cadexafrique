<?php
namespace App\Http\Controllers;

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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\Environment\Console;

class AdminController extends Controller
{

    /**Verificateur d'accès superadmin  */
    public function can_access(){
        if(Auth::check() && Auth::user()->is_superadmin == 1){
            return true;
        }else{
            return false;
        }
    }

    public function formLogin(){
        if($this->can_access() == true){
            return redirect('analytics.dashboard');
        }else{
            return view('analytics.login');
        }
    }

    /**
     * Authenticate the admin user
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::once($credentials)){
            Auth::login(Auth::user());
            $datauser = Auth::user();
            return response()->json([
                'message'=>'Connexion réussi!',
                'etat'=>'1']);
        }else {
            return response()->json(['message'=>'Mot de passe ou Email incorrect!', 'etat'=>'2']);
        }


    }



    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->to('admin-cadex');
    }

    /**
     * Where to redirect admin after login.
     *
     * @var string
    */

    protected $redirectTo = RouteServiceProvider::ANALYTICS;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



}
