<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetailModel;
use App\Models\InfosEntreprise;
use App\Models\Menus;
use App\Models\SubMenus;
use App\Models\SubSubMenus;
use App\Http\Controllers\HomeController;

class userMenuContentController extends Controller
{
     /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function MenuLoader()
    {
        $menuandsub = array();
        $menus = Menus::where('status', 1)
            ->orderBy('position', 'ASC')
            ->get();
        foreach ($menus as $itemp) {
            $menusub = array();
            $submenus = SubMenus::where('parent_id', $itemp->id)
                ->where('status', 1)
                ->orderBy('position', 'ASC')
                ->get();
            foreach ($submenus as $itemsp) {
                $menusubsub = array();
                $subsubmenus = SubSubMenus::where('sub_parent_id', $itemsp->id)
                    ->where('status', 1)
                    ->orderBy('position', 'ASC')
                    ->get();
                foreach ($subsubmenus as $itemssp) {
                    $datasubsub = [
                        'id' => $itemssp->id,
                        'name' => $itemssp->name,
                        'sub_parent_id' => $itemssp->sub_parent_id,
                        'rubrique' => $itemssp->rubrique,
                    ];
                    $objectsubsub = json_decode(json_encode($datasubsub), FALSE);
                    array_push($menusubsub, $objectsubsub);
                }

                $datasub = [
                    'id' => $itemsp->id,
                    'parent_id' => $itemsp->parent_id,
                    'name' => $itemsp->name,
                    'subsub' => $menusubsub,
                    'rubrique' => $itemsp->rubrique,
                ];
                $objectsub = json_decode(json_encode($datasub), FALSE);
                array_push($menusub, $objectsub);
            }

            $datamenuandsub = [
                'id' => $itemp->id,
                'position' => $itemp->position,
                'name' => $itemp->name,
                'sub' => $menusub
            ];

            $objectmenusandsub = json_decode(json_encode($datamenuandsub), FALSE);
            array_push($menuandsub, $objectmenusandsub);
        }
        return $menuandsub;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSubSubMenuContent($id)
    {
        $entreprise = InfosEntreprise::where("id", 1)->first();
        $currentmenu = SubSubMenus::where('id', $id)->first();
        $content = OrderDetailModel::where('menu_id', $id)
            ->where('niveau', 3)
            ->first();
        $menus = (new HomeController)->MenuLoader();
        return view('user.menu-content', compact(
            "menus"
        ))
            ->with('contenu', $content)
            ->with("entreprise",$entreprise)
            ->with("currentmenu", $currentmenu);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSubMenuContent($id)
    {
        $entreprise = InfosEntreprise::where("id", 1)->first();
        $currentmenu = SubMenus::where('id', $id)->first();
        $content = OrderDetailModel::where('menu_id', $id)
            ->where('niveau', 2)
            ->first();
        $menus = (new HomeController)->MenuLoader();
        return view('user.menu-content', compact(
            "menus"
        ))
            ->with('contenu', $content)
            ->with("entreprise",$entreprise)
            ->with("currentmenu", $currentmenu);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
