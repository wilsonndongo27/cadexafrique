<?php

namespace App\Http\Controllers;

use App\Models\Solution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\CategorieSolutions;

class SolutionController extends Controller
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
    public function index()
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $allsolution = Solution::all()->sortByDesc('id');
            $allcategorie = CategorieSolutions::all()->sortByDesc('id');
            return view('analytics.solution.solution', compact('allsolution', 'allcategorie'));
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
    public function store(Request $request)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            #controle de validation des elements
            $this->validate($request,[
                'categorie' => 'required',
                'creator' => 'required',
                'name'=>'required',
                'priority'=>'required',
                'labelDesc'=>'required',
                'description'=>'required',
                'photo' => 'required',
            ]);
            $admin = $request->input('creator');
            $categorie = $request->input('categorie');
            $name = $request->input('name');
            $priority = $request->input('priority');
            $label = $request->input('labelDesc');
            $description = $request->input('description');
            $photo = $request->file('photo');

            #enregistrement de l'image
            $extension = $photo->getClientOriginalExtension();
            Storage::disk('public')->put($photo->getFilename().'.'.$extension,  File::get($photo));

            $time = \Carbon\Carbon::now()->toDateTimeString();
            $data=array(
                'creator'=>$admin,
                'categorie' => $categorie,
                'name'=>$name,
                'priority'=>$priority,
                'labelDesc' => $label,
                'description'=>$description,
                'photo'=>$photo->getFilename().'.'.$extension,
                'created_at' => $time,
                'updated_at' => $time);
            DB::table('solutions')->insert($data);

            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solution $solution)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'solution_id' => 'required',
            ]);
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $solution_id = $request->input('solution_id');
            $name = $request->input('name');
            $priority = $request->input('priority');
            $label = $request->input('labelDesc');
            $description = $request->input('description');
            $categorie = $request->input('categorie');
            $photo = $request->file('photo');

            /**get the current service  */
            $currentSolution = Solution::where('id', $solution_id)->first();

            #enregistrement de l'image
            if($photo != null){
                //code for remove old file
                Storage::disk('public')->delete($currentSolution->photo);

                //upload new file
                $extension = $photo->getClientOriginalExtension();
                Storage::disk('public')->put($photo->getFilename().'.'.$extension,  File::get($photo));

                $currentSolution->photo = $photo->getFilename().".".$extension;
            }

            $currentSolution->name = $name;
            $currentSolution->priority = $priority;
            $currentSolution->labelDesc = $label;
            $currentSolution->description = $description;
            $currentSolution->categorie = $categorie;
            $currentSolution->updated_at = $time;
            $currentSolution->save();
            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solution $solution, Request $request)
    {
        if($this->can_access() ==  true || $this->can_access_admin() == true){
            $solution_id = $request->input('currentsolution');
            Solution::findOrFail($solution_id)->delete();
            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }
    }
}
