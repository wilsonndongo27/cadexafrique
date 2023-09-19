<?php

namespace App\Http\Controllers;

use App\Events\WebSocketEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Banniere;
use App\Models\Articles;
use App\Models\Service;
use App\Models\Solution;
use App\Models\CategorieArticle;
use App\Models\User;
use App\Models\InfosEntreprise;
use App\Models\Menus;
use App\Models\SubMenus;
use App\Models\SubSubMenus;


class HomeController extends Controller
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

    public function home()
    {
        $menus = $this->MenuLoader();
        $entreprise = InfosEntreprise::where("id", 1)->first();
        $allproduct = Solution::where('status', 1)
            ->orderBy('id', 'DESC')
            ->limit(10)
            ->get();
        $allservice = Service::latest()->limit(5)->get();
        $allbanniere = Banniere::all();
        $allcategoriearticle = CategorieArticle::all();
        $allarticle = Articles::where('status', 1)
        ->orderBy('id', 'DESC')
        ->take(10)
        ->get();
        return view('user.index' ,compact(
            "allarticle",
            "allservice",
            "allbanniere",
            "allcategoriearticle",
            "allproduct",
            "menus"
        ))->with("entreprise", $entreprise);
    }

    public function redirect(){
        if(Auth::check() && Auth::user()->is_superadmin == 1){
            return redirect('dashboard-gf-sa');
        }else{
            return redirect("home");
        }
    }

    public function homeAjax(){
        $allproduct = Solution::where('status', 1)
            ->orderBy('id')
            ->take(10)
            ->get();
        $allservice = Service::all();
        $allbanniere = Banniere::all();
        $allarticle = Articles::where('status', 1)
            ->orderBy('id')
            ->take(10)
            ->get();
        $allcategoriearticle = CategorieArticle::all();

        return response()->json([
            "status" => 200,
        ]);
    }

    public function About()
    {
        $menus = $this->MenuLoader();
        $entreprise = InfosEntreprise::where("id", 1)->first();
        $allproduct = Solution::where('status', 1)
            ->orderBy('id', 'DESC')
            ->limit(10)
            ->get();
        $allservice = Service::where('status', 1)
        ->orderBy('id', 'DESC')
        ->limit(10)
        ->get();
        return view('user.about' ,compact(
            "allproduct",
            "allservice",
            "menus"
        ))
        ->with('entreprise', $entreprise);
    }
}
