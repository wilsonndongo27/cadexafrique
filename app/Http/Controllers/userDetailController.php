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
use App\Models\StaffProfil;

class userDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ServiceDetail($id)
    {
        $entreprise = InfosEntreprise::where("id", 1)->first();
        $allproduct = Solution::where('status', 1)
        ->orderBy('id')
        ->get();
        $allservice = Service::latest()->limit(5)->get();

        $service = Service::where("id", $id)->first();
        $menus = (new HomeController)->MenuLoader();

        return view("user.service-details", compact("allservice", "allproduct", "menus"))
        ->with("service",$service)
        ->with("entreprise",$entreprise);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ArticleDetail($id)
    {
        $entreprise = InfosEntreprise::where("id", 1)->first();
        $allproduct = Solution::where('status', 1)
            ->orderBy('id')
            ->get();
        $allservice = Service::latest()->limit(5)->get();
        $article = Articles::where("id", $id)->first();
        $menus = (new HomeController)->MenuLoader();

        return view("user.article-detail", compact("allservice", "allproduct", "menus"))
        ->with("article",$article)
        ->with("entreprise",$entreprise);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ProductDetail($id)
    {
        $entreprise = InfosEntreprise::where("id", 1)->first();
        $allproduct = Solution::where('status', 1)
            ->orderBy('id')
            ->get();
        $allservice = Service::latest()->limit(5)->get();
        $product = Solution::where('status', 1)
            ->where("id", $id)
            ->first();
        $menus = (new HomeController)->MenuLoader();

        return view("user.product-detail", compact("allservice", "allproduct", "menus"))
        ->with("product",$product)
        ->with("entreprise",$entreprise);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function BanniereDetail($id)
    {
        $entreprise = InfosEntreprise::where("id", 1)->first();
        $allproduct = Solution::where('status', 1)
            ->orderBy('id')
            ->get();
        $allservice = Service::latest()->limit(5)->get();

        $banniere = Banniere::where("id", $id)
            ->first();

        $menus = (new HomeController)->MenuLoader();

        return view("user.banniere-detail", compact("allservice", "allproduct", "menus"))
        ->with("banniere",$banniere)
        ->with("entreprise",$entreprise);
    }

    /**MAnage Staff Front End  */
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function staffDetail($id)
    {
        $menus = (new HomeController)->MenuLoader();
        $entreprise = InfosEntreprise::where("id", 1)->first();
        $staff = StaffInfos::where("id", $id)->first();
        $poste = StaffProfil::where('id', $staff->poste)->first();
        return view('user.staff-profil-detail', compact("menus"))
        ->with("staff", $staff)
        ->with("entreprise",$entreprise)
        ->with("poste", $poste);
    }


}
