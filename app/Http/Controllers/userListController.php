<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Banniere;
use App\Models\Articles;
use App\Models\Service;
use App\Models\Solution;
use App\Models\CategorieArticle;
use App\Models\User;
use App\Models\InfosEntreprise;
use App\Http\Controllers\HomeController;
use App\Models\StaffInfos;
use App\Models\SubMenus;
use App\Models\SubSubMenus;
use App\Models\StaffProfil;

class userListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function ListService($id)
    {
        $currentmenu = '';
        $entreprise = InfosEntreprise::where("id", 1)->first();
        $allproduct = Solution::where('status', 1)
        ->orderBy('id')
        ->get();

        $allarticle = Solution::where('status', 1)
        ->orderBy('id')
        ->get();

        $allservice = Service::where("status", 1)
        ->paginate(15);

        $menus = (new HomeController)->MenuLoader();

        if(SubSubMenus::where('id', $id)->exists()){
            $currentmenu = SubSubMenus::where('id', $id)->first();
        }else if(SubMenus::where('id', $id)->exists()){
            $currentmenu = SubMenus::where('id', $id)->first();
        }

        return view("user.list-services",
        compact(
            "allservice",
            "allproduct",
            "allarticle",
            "menus"
        ))->with("entreprise",$entreprise)
          ->with('currentmenu', $currentmenu);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ListArticleCategorie($id)
    {
        $entreprise = InfosEntreprise::where("id", 1)->first();
        $allproduct = Solution::where('status', 1)
            ->orderBy('id')
            ->get();
        $allservice = Service::latest()->limit(5)->get();
        $categorie = CategorieArticle::where("id", $id)->first();

        $allarticlenew = Articles::where("categorie_id", $id)
        ->paginate(3);

        $allarticlesoon = Articles::where("categorie_id", $id)
        ->where("priority", 2)
        ->paginate(3);

        $allarticleimportant = Articles::where("categorie_id", $id)
        ->where("priority", 3)
        ->paginate(3);

        $allarticleattractif = Articles::where("categorie_id", $id)
        ->where("priority", 4)
        ->paginate(3);

        $menus = (new HomeController)->MenuLoader();

        return view("user.list-article-categorie",
        compact(
            "allservice",
            "allproduct",
            "allarticlenew",
            "allarticlesoon",
            "allarticleimportant",
            "allarticleattractif",
            "menus"
        ))
        ->with("categorie",$categorie)
        ->with("entreprise",$entreprise);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ListArticle($id)
    {
        $currentmenu = '';
        $entreprise = InfosEntreprise::where("id", 1)->first();
        $allproduct = Solution::where('status', 1)
            ->orderBy('id')
            ->get();

        $allservice = Service::where('status', 1)
            ->orderBy('id')
            ->get();

        $allarticle = Articles::where("status", 1)->paginate(15);

        $menus = (new HomeController)->MenuLoader();

        if(SubSubMenus::where('id', $id)->exists()){
            $currentmenu = SubSubMenus::where('id', $id)->first();
        }else if(SubMenus::where('id', $id)->exists()){
            $currentmenu = SubMenus::where('id', $id)->first();
        }

        return view("user.list-article",
        compact(
            "allservice",
            "allproduct",
            "allarticle",
            "menus"
        ))->with("entreprise",$entreprise)
          ->with('currentmenu', $currentmenu);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ListProduct($id)
    {
        $entreprise = InfosEntreprise::where("id", 1)->first();
        $allservice = Service::where('status', 1)
            ->orderBy('id')
            ->get();

        $allarticle = Solution::where('status', 1)
            ->orderBy('id')
            ->get();

        $allproduct = Solution::where("status", 1)
        ->paginate(15);

        $menus = (new HomeController)->MenuLoader();

        if(SubSubMenus::where('id', $id)->exists()){
            $currentmenu = SubSubMenus::where('id', $id)->first();
        }else if(SubMenus::where('id', $id)->exists()){
            $currentmenu = SubMenus::where('id', $id)->first();
        }

        return view("user.list-product",
        compact(
            "allservice",
            "allarticle",
            "allproduct",
            "menus"
        ))->with("entreprise",$entreprise)
        ->with('currentmenu', $currentmenu);
    }

    
    /**MAnage Staff Front End  */
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ListStaff()
    {
        $entreprise = InfosEntreprise::where("id", 1)->first();
        
        $menus = (new HomeController)->MenuLoader();

        $datastaff = StaffInfos::where("status", 1)
            ->paginate(10);
        $allstaff = array();
        foreach ($datastaff as $item) {
            $creator = User::where('id', $item->user_id)->first();
            $poste = StaffProfil::where('id', $item->poste)->first();
            $data = [
                'id' => $item->id,
                'first_name' => $item->first_name,
                'last_name' => $item->last_name,
                'telephone' => $item->telephone,
                'adresse' => $item->adresse,
                'email' => $item->email,
                'poste' => $poste->name,
                'photo' => $item->photo,
                'status' => $item->status,
                'creator' => $creator->name,
                'freetext1' => $item->freetext1,
                'created_at' => $item->created_at,
            ];
            $object = json_decode(json_encode($data), FALSE);
            array_push($allstaff, $object);
        }
        
        return view('user.list-staff', compact('allstaff', "menus"))
            ->with("entreprise",$entreprise);;
    }



}
