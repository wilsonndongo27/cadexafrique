<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Menus;
use App\Models\SubMenus;
use App\Models\SubSubMenus;
use App\Models\OrderDetailModel;

use Illuminate\Http\Request;

class MenusController extends Controller
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
    public function Menuindex()
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $current_user = Auth::user();
            $datamenus = Menus::select("*")
                                ->orderBy('id')
                                ->get();
            $allmenus = array();
            foreach ($datamenus as $item) {
                $creator = User::where('id', $item->user_id)->first();
                $data = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'position' => $item->position,
                    'status' => $item->status,
                    'creator' => $creator->name,
                    'created_at' => $item->created_at,
                ];
                $object = json_decode(json_encode($data), FALSE);
                array_push($allmenus, $object);
            }
            return view('analytics.menus.home-menus', compact('allmenus'));
        }else{
            return view('analytics.401');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createMenu(Request $request)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){

            #controle de validation des elements
            $this->validate($request,[
                'creator' => 'required',
                'name'=>'required',
                'position' => 'required'
            ]);

            $admin = $request->input('creator');
            $name = $request->input('name');
            $position = $request->input('position');

            $time = \Carbon\Carbon::now()->toDateTimeString();
            $data=array(
                'user_id'=>$admin,
                'name'=>$name,
                'position'=>$position,
                'created_at' => $time,
                'updated_at' => $time);
            DB::table('menuses')->insert($data);

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
    public function UpdateMenu(Request $request)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'menu_id' => 'required',
            ]);
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $menu_id = $request->input('menu_id');
            $name = $request->input('name');
            $position = $request->input('position');

            /**get the current menu  */
            $currentMenu = Menus::where('id', $menu_id)->first();

            $currentMenu->name = $name;
            $currentMenu->position = $position;
            $currentMenu->updated_at = $time;
            $currentMenu->save();
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
    public function changeStatusMenu(Request $request)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'idmenu' => 'required',
            ]);
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $menu_id = $request->input('idmenu');

            /**get the current menu  */
            $currentMenu = Menus::where('id', $menu_id)->first();
            if($currentMenu->status == 1){
                $currentMenu->status = 0;
            }else{
                $currentMenu->status = 1;
            }
            $newstatus = $currentMenu->save();
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
    public function deleteMenu(Request $request)
    {
        if($this->can_access() ==  true || $this->can_access_admin() == true){
            $menu_id = $request->input('currentmenu');
            Menus::findOrFail($menu_id)->delete();
            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401'); 
        }
    }


    /**  GESTION DES SOUS MENUS*/

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function SubMenuindex($id)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $current_user = Auth::user();
            $currentparent = Menus::where("id", $id)->first();
            $datamenus = SubMenus::where("parent_id", $id)
                                ->orderBy('id')
                                ->get();
            $allmenus = array();

            $is_submenu_affected = 0;

            foreach ($datamenus as $item) {
                $contenu = array();
                $creator = User::where('id', $item->user_id)->first();
                $allcontent = OrderDetailModel::where("menu_id", $item->id)
                                ->where("niveau", 2)
                                ->get();
  
                $subsubmenu = SubSubMenus::where("sub_parent_id", $item->id)->get();
                foreach ($subsubmenu as $subsub) {
                    if($subsub->rubrique == 0 || $subsub->rubrique == ""){
                        $is_submenu_affected = 0;
                    }else{
                        $is_submenu_affected = 1;
                    }
                }

                foreach ($allcontent as $itemcont) {
                    $datacontent = [
                        'id' => $itemcont->id,
                        'title' => $itemcont->title,
                        'libelle' => $itemcont->libelle,
                        'description' => $itemcont->description,
                        'image' => $itemcont->image
                    ];

                    $objectmenucontent = json_decode(json_encode($datacontent), FALSE);
                    array_push($contenu, $objectmenucontent);
                }

                $data = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'position' => $item->position,
                    'rubrique' => $item->rubrique,
                    'is_submenu_affected' => $is_submenu_affected,
                    'status' => $item->status,
                    'creator' => $creator->name,
                    'created_at' => $item->created_at,
                    'menucontent' => $contenu
                ];
                $object = json_decode(json_encode($data), FALSE);
                array_push($allmenus, $object);
            }
            return view('analytics.menus.home-sous-menus', compact('allmenus'))->with('parent', $currentparent);
        }else{
            return view('analytics.401');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createSubMenu(Request $request)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){

            #controle de validation des elements
            $this->validate($request,[
                'creator' => 'required',
                'name'=>'required',
                'position' => 'required'
            ]);

            $admin = $request->input('creator');
            $name = $request->input('name');
            $position = $request->input('position');
            $parent = $request->input('parent_id');
 
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $newsubmenu = new SubMenus();
            $newsubmenu->user_id = $admin;
            $newsubmenu->parent_id = $parent;
            $newsubmenu->name = $name;
            $newsubmenu->position = $position;
            $newsubmenu->created_at = $time;
            $newsubmenu->updated_at = $time;
            $newsubmenu->save();

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
    public function UpdateSubMenu(Request $request)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'menu_id' => 'required',
            ]);
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $menu_id = $request->input('menu_id');
            $name = $request->input('name');
            $position = $request->input('position');

            /**get the current menu  */
            $currentMenu = SubMenus::where('id', $menu_id)->first();

            $currentMenu->name = $name;
            $currentMenu->position = $position;
            $currentMenu->updated_at = $time;
            $currentMenu->save();
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
    public function changeStatusSubMenu(Request $request)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'idmenu' => 'required',
            ]);
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $menu_id = $request->input('idmenu');

            /**get the current menu  */
            $currentMenu = SubMenus::where('id', $menu_id)->first();
            if($currentMenu->status == 1){
                $currentMenu->status = 0;
            }else{
                $currentMenu->status = 1;
            }
            $newstatus = $currentMenu->save();
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
    public function deleteSubMenu(Request $request)
    {
        if($this->can_access() ==  true || $this->can_access_admin() == true){
            $menu_id = $request->input('currentmenu');
            SubMenus::findOrFail($menu_id)->delete();
            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }
    }


    /**GESTION DES SOUS SOUS MENUS */


      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function SubSubMenuindex($id)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $current_user = Auth::user();
            $currentparent = SubMenus::where("id", $id)->first();
            $datamenus = SubSubMenus::where("sub_parent_id", $id)
                                ->orderBy('id')
                                ->get();
            $allmenus = array();
            foreach ($datamenus as $item) {
                $contenu = array();
                $creator = User::where('id', $item->user_id)->first();
                $allcontent = OrderDetailModel::where("menu_id", $item->id)
                    ->where("niveau", 3)
                    ->get();
                foreach ($allcontent as $itemcont) {
                    $datacontent = [
                        'id' => $itemcont->id,
                        'title' => $itemcont->title,
                        'libelle' => $itemcont->libelle,
                        'description' => $itemcont->description,
                        'image' => $itemcont->image
                    ];

                    $objectmenucontent = json_decode(json_encode($datacontent), FALSE);
                    array_push($contenu, $objectmenucontent);
                }

                $data = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'position' => $item->position,
                    'rubrique' => $item->rubrique,
                    'status' => $item->status,
                    'creator' => $creator->name,
                    'created_at' => $item->created_at,
                    'menucontent' => $contenu
                ];
                $object = json_decode(json_encode($data), FALSE);
                array_push($allmenus, $object);
            }

            return view('analytics.menus.home-sous-sous-menus', compact('allmenus'))->with("currentparent", $currentparent);
        }else{
            return view('analytics.401');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createSubSubMenu(Request $request)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){

            #controle de validation des elements
            $this->validate($request,[
                'creator' => 'required',
                'name'=>'required',
                'position' => 'required'
            ]);

            $admin = $request->input('creator');
            $name = $request->input('name');
            $position = $request->input('position');
            $subsubparent = $request->input('sub_parent_id');

            $time = \Carbon\Carbon::now()->toDateTimeString();

            $newsubsubmenu = new SubSubMenus();
            $newsubsubmenu->user_id = $admin;
            $newsubsubmenu->sub_parent_id = $subsubparent;
            $newsubsubmenu->name = $name;
            $newsubsubmenu->position = $position;
            $newsubsubmenu->created_at = $time;
            $newsubsubmenu->updated_at = $time;
            $newsubsubmenu->save();

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
    public function UpdateSubSubMenu(Request $request)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'menu_id' => 'required',
            ]);
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $menu_id = $request->input('menu_id');
            $name = $request->input('name');
            $position = $request->input('position');

            /**get the current menu  */
            $currentSubMenu = SubSubMenus::where('id', $menu_id)->first();

            $currentSubMenu->name = $name;
            $currentSubMenu->position = $position;
            $currentSubMenu->updated_at = $time;
            $currentSubMenu->save();
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
    public function changeStatusSubSubMenu(Request $request)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'idmenu' => 'required',
            ]);
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $menu_id = $request->input('idmenu');

            /**get the current menu  */
            $currentMenu = SubSubMenus::where('id', $menu_id)->first();
            if($currentMenu->status == 1){
                $currentMenu->status = 0;
            }else{
                $currentMenu->status = 1;
            }
            $newstatus = $currentMenu->save();
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
    public function deleteSubSubMenu(Request $request)
    {
        if($this->can_access() ==  true || $this->can_access_admin() == true){
            $menu_id = $request->input('currentmenu');
            SubSubMenus::findOrFail($menu_id)->delete();
            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }
    }


    /**AFFECTATION DES RUBRIQUES AU MENUS */
        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function affectedRubriqueSubSubMenu(Request $request)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'menu_id' => 'required',
            ]);
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $menu_id = $request->input('menu_id');
            $rubrique = $request->input('rubrique');

            $is_affected_to_sub = false;
            $is_affected_to_parent = false;

            $all_parent = SubMenus::all();
            $all_sub = SubSubMenus::all();

            foreach ($all_parent as $value) {
                if($value->rubrique == $rubrique){
                    $is_affected_to_parent = true;
                }else{
                    $is_affected_to_parent = false;
                }
            }

            foreach ($all_sub as $value) {
                if($value->rubrique == $rubrique){
                    $is_affected_to_sub = true;
                }else{
                    $is_affected_to_sub = false;
                }
            }

            /**get the current menu  */
            $currentMenu = SubSubMenus::where('id', $menu_id)->first();

            if($is_affected_to_sub == true){   
                return response()->json(['message'=>'Cette Rubrique est déjà affecter à un sous sous menu!', 'etat'=>'2']);
            }else if($is_affected_to_parent == true){
                return response()->json(['message'=>'Cette Rubrique est déjà affecter à un sous menu!', 'etat'=>'2']);
            }else{
                $currentMenu->rubrique = $rubrique;
                $currentMenu->updated_at = $time;
                $currentMenu->save();
                return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
            }

        }else{
            return view('analytics.401');
        }
    }

    public function affectedRubriqueSubMenu(Request $request)
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'menu_id' => 'required',
            ]);
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $menu_id = $request->input('menu_id');
            $rubrique = $request->input('rubrique');

            $is_affected_to_sub = false;
            $is_affected_to_parent = false;

            $all_parent = SubMenus::all();
            $all_sub = SubSubMenus::all();

            foreach ($all_parent as $value) {
                if($value->rubrique == $rubrique){
                    $is_affected_to_parent = true;
                }else{
                    $is_affected_to_parent = false;
                }
            }

            foreach ($all_sub as $value) {
                if($value->rubrique == $rubrique){
                    $is_affected_to_sub = true;
                }else{
                    $is_affected_to_sub = false;
                }
            }

            /**get the current menu  */
            $currentMenu = SubMenus::where('id', $menu_id)->first();

            if($is_affected_to_sub == true){   
                return response()->json(['message'=>'Cette Rubrique est déjà affecter à un sous sous menu!', 'etat'=>'2']);
            }else if($is_affected_to_parent == true){
                return response()->json(['message'=>'Cette Rubrique est déjà affecter à un sous menu!', 'etat'=>'2']);
            }else{
                $currentMenu->rubrique = $rubrique;
                $currentMenu->updated_at = $time;
                $currentMenu->save();
                return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
            }

        }else{
            return view('analytics.401');
        }
    }



}
