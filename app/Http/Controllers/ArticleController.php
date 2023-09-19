<?php

namespace App\Http\Controllers;
use App\Models\Articles;
use App\Models\Service;
use App\Models\CategorieArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ArticleController extends Controller
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

    /**afficher la page de gestion des services */
    public function homeArticle(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $allArticle = DB::table('articles')->orderBy('id', 'DESC')->get()->toArray();
            $allarticle = array();
            foreach ($allArticle as $item) {
                $creator = User::where('id', $item->user_id)->first();
                $data = [
                    'id' => $item->id,
                    'title' => $item->title,
                    'labelDesc' => $item->labelDesc,
                    'description' => $item->description,
                    'creator' => $creator->name,
                    'status' => $item->status,
                    'photo' => $item->photo,
                    'created_at' => $item->created_at,
                ];
                $object = json_decode(json_encode($data), FALSE);
                array_push($allarticle, $object);
            }
            $allservice = Service::get(['id', 'title']);
            $allcategorie = CategorieArticle::all();
            return view('analytics.customisation.article', compact('allarticle', 'allservice', 'allcategorie'));
        }else{
            return view('analytics.401');
        }
    }


    /**Creer les articles */
    public function createArticle(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            #controle de validation des elements

            $this->validate($request,[
                'creator' => 'required',
                'title'=>'required',
                'priority'=>'required',
                'labelDesc' => 'required',
                'description'=>'required',
                'categorie' => 'required',
                'photo' => 'required',
            ]);

            $admin = $request->input('creator');
            $title = $request->input('title');
            $priority = $request->input('priority');
            $label = $request->input('labelDesc');
            $categorie = $request->input('categorie');
            $description = $request->input('description');
            $photo = $request->file('photo');
            $listservice = $request->input("services");

            #enregistrement de l'image
            $extension = $photo->getClientOriginalExtension();
            Storage::disk('public')->put($photo->getFilename().'.'.$extension,  File::get($photo));

            $time = \Carbon\Carbon::now()->toDateTimeString();

            $article = new Articles();
            $article->user_id = $admin;
            $article->title = $title;
            $article->priority = $priority;
            $article->categorie_id = $categorie;
            $article->labelDesc = $label;
            $article->description = $description;
            $article->photo = $photo->getFilename().'.'.$extension;
            $article->created_at = $time;

            $article->save();

            foreach ($listservice as $key) {
                $article->services()->attach($key);
            }

            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }

    }

    /**************************Mise a jour des articles **************************** */
    public function UpdateArticle(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'article_id' => 'required',
            ]);
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $article_id = $request->input('article_id');
            $title = $request->input('title');
            $priority = $request->input('priority');
            $label = $request->input('labelDesc');
            $description = $request->input('description');
            $photo = $request->file('photo');

            /**get the current article  */
            $currentArticle = Articles::where('id', $article_id)->first();

            #enregistrement de l'image
            if($photo != null){
                //code for remove old file
                Storage::disk('public')->delete($currentArticle->photo);

                //upload new file
                $extension = $photo->getClientOriginalExtension();
                Storage::disk('public')->put($photo->getFilename().'.'.$extension,  File::get($photo));

                $currentArticle->photo = $photo->getFilename().".".$extension;
            }

            $currentArticle->title = $title;
            $currentArticle->labelDesc = $label;
            $currentArticle->priority = $priority;
            $currentArticle->description = $description;
            $currentArticle->updated_at = $time;
            $currentArticle->save();
            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }


    }

    /***************suppression des slides *************** */
    public function deleteArticle(Request $request){
        if($this->can_access() ==  true || $this->can_access_admin() == true){
            $article_id = $request->input('currentarticle');
            DB::delete('DELETE FROM articles WHERE id = ?', [$article_id]);
            DB::delete('DELETE FROM articles_service WHERE articles_id = ?', [$article_id]);
            return response()->json(['message'=>'L\'opération a Réussi!', 'etat'=>'1']);
        }else{
            return view('analytics.401');
        }
    }

    /**************************Mise a jour du  status d'un article poster sur le site (Bloquer ou Débloquer) **************************** */
      public function UpdateStatusArticle(Request $request){
        if($this->can_access() == true){
            $article_id = $request->input('currentarticle');
            $status = $request->input('statusvalue');
            /**get the current article object */
            $article = DB::table('articles')->where('id', $article_id)->first();
            if($status == 1){
                $article->status = 0;
            }else{
                $article->status = 1;
            }
            $article->save();
            $newstatus = $article->status;
            return response()->json([
                'message' => 'L\opération a réussi!',
                'status' => $newstatus,
                'etat' => '1'
            ]);
        }else{
            return response()->json([
                'message' => 'Seul le super administrateur peut modifier le status!',
                'etat' => '2'
            ]);
        }
    }
}
