<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CategorieArticle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class CategorieArticleController extends Controller
{

    /**Controlleur d'acces super administrateur */
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
    public function index()
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $allcategorie = DB::table('categorie_articles')->orderBy('id', 'DESC')->get()->toArray();

            $allcategorienew = array();
            foreach ($allcategorie as $item) {
                $creator = User::where('id', $item->user_id)->first();
                $data = [
                    'id' => $item->id,
                    'creator' => $creator->name,
                    'name' => $item->name,
                    'created_at' => $item->created_at,
                ];
                $object = json_decode(json_encode($data), FALSE);
                array_push($allcategorienew, $object);
            }

            return view('analytics.customisation.categorie_article', compact('allcategorienew', 'allcategorienew'));
        }else{
            return view('analytics.401');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createCategorie(Request $request)
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
            $categorie = new CategorieArticle();
            $categorie->user_id = $admin;
            $categorie->name = $name;
            $categorie->created_at = $time;

            $categorie->save();

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
    public function UpdateCategorie(Request $request)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'categorie_id' => 'required',
            ]);
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $categorie_id = $request->input('categorie_id');
            $name = $request->input('name');

            /**get the current categorie  */
            $currentCategorie = CategorieArticle::where('id', $categorie_id)->first();

            $currentCategorie->title = $title;
            $currentCategorie->updated_at = $time;
            $currentCategorie->save();
            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteCategorie(Request $request)
    {
        if($this->can_access() ==  true || $this->can_access_admin() == true){
            $categorie_id = $request->input('currentcategorie');
            DB::delete('DELETE FROM categorie_articles WHERE id = ?', [$categorie_id]);
            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }
    }
}
