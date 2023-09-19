<?php

namespace App\Http\Controllers;

use App\Models\InfosSolutions;
use App\Models\Solution;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class InfosSolutionsController extends Controller
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
    public function index(Request $request, $id)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $current_user = Auth::user();
            $currentsolution = Solution::where('id', $id)->first();
            $alldetailservice =DB::table('infos_solutions')->where('solution_id', $currentsolution->id)->get()->toArray();
            $finaldatadetail = array();
            foreach ($alldetailservice as $item) {
                $creator = User::where('id', $item->user_id)->first();
                $data = [
                    'id' => $item->id,
                    'title' => $item->title,
                    'description' => $item->description,
                    'creator' => $creator->name,
                    'cover' => $item->cover,
                    'created_at' => $item->created_at,
                ];
                $object = json_decode(json_encode($data), FALSE);
                array_push($finaldatadetail, $object);
            }
            return view('analytics.solution.plusinfosolution', compact('finaldatadetail'))->with('solution', $currentsolution);
        }else{
            return view('analytics.401');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            #controle de validation des elements
            $this->validate($request,[
                'creator' => 'required',
                'solution_detail_id' => 'required',
                'title'=>'required',
                'description'=>'required',
                'cover' => 'required',
            ]);
            $admin = $request->input('creator');
            $solution = $request->input('solution_detail_id');
            $title = $request->input('title');
            $description = $request->input('description');
            $cover = $request->file('cover');

            #enregistrement de l'image
            $extension = $cover->getClientOriginalExtension();
            Storage::disk('public')->put($cover->getFilename().'.'.$extension,  File::get($cover));

            $time = \Carbon\Carbon::now()->toDateTimeString();

            $newdetail = new InfosSolutions();
            $newdetail->user_id = $admin;
            $newdetail->solution_id = $solution;
            $newdetail->title = $title;
            $newdetail->description = $description;
            $newdetail->cover = $cover->getFilename().'.'.$extension;
            $newdetail->created_at = $time;
            $newdetail->updated_at = $time;
            $newdetail->save();
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InfosSolutions  $infosSolutions
     * @return \Illuminate\Http\Response
     */
    public function show(InfosSolutions $infosSolutions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InfosSolutions  $infosSolutions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InfosSolutions $infosSolutions)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'detail_solution_id' => 'required',
            ]);
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $detail_solution_id = $request->input('detail_solution_id');
            $title = $request->input('title');
            $description = $request->input('description');
            $cover = $request->file('cover');

            /**get the current solution  */
            $currentDetail = InfosSolutions::where('id', $detail_solution_id)->first();

            #enregistrement de l'image
            if($cover != null){
                //code for remove old file
                Storage::disk('public')->delete($currentDetail->cover);

                //upload new file
                $extension = $cover->getClientOriginalExtension();
                Storage::disk('public')->put($cover->getFilename().'.'.$extension,  File::get($cover));

                $currentDetail->cover = $cover->getFilename().".".$extension;
            }

            $currentDetail->title = $title;
            $currentDetail->description = $description;
            $currentDetail->updated_at = $time;
            $currentDetail->save();
            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InfosSolutions  $infosSolutions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,InfosSolutions $infosSolutions)
    {
        if($this->can_access() ==  true || $this->can_access_admin() == true){
            $detail_solution_id = $request->input('currentsolutiondetail');
            DB::delete('DELETE FROM infos_solutions WHERE id = ?', [$detail_solution_id]);
            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }
    }
}
