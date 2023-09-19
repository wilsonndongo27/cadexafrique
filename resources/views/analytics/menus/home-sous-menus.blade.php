@extends('analytics/template')
@section('contenu')
<div class="container-fluid">
    <h1 class="mt-4">Analytics</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Gestion des sous menus du menu  <span class="submenutitle"> {{$parent->name}}</span></li>
    </ol>
    <table id="articles-table" class="table shadow-card">
        <thead style="margin-left:5px">
            <tr style="font-size: 14px;">
                <th title="">{{ __('Nom') }}</th>
                <th title="Auteur de de la création sous-menu">{{ __('Créer par :') }}</th>
                <th title="">{{ __('Date de création') }}</th>
                <th title="">{{ __('Status') }}</th>
                <th title="" style="width:3px;"> > </th>
                <span class="counter"> Total des sous menus <span class="badgecount">{{ count($allmenus)}}</span></span>
                <a href="#" id="AddSubMenu" data-toggle="tooltip" title="Ajouter un sous menu">
                    <span class="plusadd"> <i class="fa fa-plus-circle" ></i></span>
                </a>
            </tr>
        </thead>
        <tbody style="font-size: 14px;">
        @if ($allmenus ?? '')
            @foreach ($allmenus as $item)
                <tr>
                    <td style="color: #888;">{{ Str::limit($item->name, 30)  }}</td>
                    <td style="color: #888;">{{ Str::limit($item->creator, 30)  }}</td>
                    <td style="color: #888;">{{ \Carbon\Carbon::parse($item->created_at)->format("Y/m/d H:i:s") }}</td>
                    @if($item->status == 0)
                        <td style="color: #F07000;">Inacive</td>
                    @else
                        <td style="color: #F07000;">active</td>
                    @endif
                    <td>
                        <div class="dropdown">
                            <button class="dropbtn"><p style="font-size: 13px; margin-top:-10px;">Options</p></button>
                            <div class="dropdown-content">
                                @if ($item->menucontent ?? '')
                                    <a href="Javascript:void()" id="ViewContentSubMenu"
                                        @foreach ($item->menucontent as $content) 
                                            data-id="{{$content->id}}"
                                            data-title="{{$content->title}}"
                                            data-libelle="{{$content->libelle}}"
                                            data-description="{{$content->description}}"
                                            data-image="{{ asset('/storage/'.$content->image) }}"
                                        @endforeach
                                    ><i class="fa fa-eye" style="margin-right: 3px;"></i> Contenu</a>

                                    <a href="Javascript:void()" id="UpdateContentSubMenu"
                                        @foreach ($item->menucontent as $content)
                                            data-contenuid="{{$content->id}}"
                                            data-title="{{$content->title}}"
                                            data-libelle="{{$content->libelle}}"
                                            data-description="{{$content->description}}"
                                            data-image="{{ asset('/storage/'.$content->image) }}"
                                        @endforeach
                                    ><i class="fa fa-edit" style="margin-right: 3px;"></i> Editer Contenu</a>
                                @else
                                    @if ($item->is_submenu_affected  == "0")
                                        <a href="Javascript:void()" id="AddRubriqueSubMenu"
                                            data-idsubmenu="{{$item->id}}"
                                            data-name="{{$item->name}}"
                                        ><i class="fa fa-plus-circle" style="margin-right: 3px;"></i> Affecter </a>
                                    @endif

                                    @if ($item->rubrique == 0 && $item->is_submenu_affected == "0" || $item->rubrique == "" && $item->is_submenu_affected  == "0")
                                        <a href="Javascript:void()" id="AddDetailSubMenu"
                                            data-idsubmenu="{{$item->id}}"
                                        ><i class="fa fa-plus-circle" style="margin-right: 3px;"></i> Contenu</a>
                                    @endif

                                @endif

                                @if($item->status == 0)
                                    <a href="JavaScript:void()" id="changestatussubmenu"
                                        data-idsubmenu="{{ $item->id }}"
                                        data-url="{{ route('change-sub-menu-status')}}"
                                        data-csrf="{{ csrf_token() }}">
                                    <i class="fa fa-check-circle" style="margin-right: 3px;"></i><span id="textstatus"> Activer</span></a>
                                @else
                                    <a href="JavaScript:void()" id="changestatussubmenu"
                                        data-idsubmenu="{{ $item->id }}"
                                        data-url="{{ route('change-sub-menu-status')}}"
                                        data-csrf="{{ csrf_token() }}">
                                    <i class="fa fa-ban" style="margin-right: 3px;"></i> <span id="textstatus">Deactiver</span></a>
                                @endif

                                @if ($item->menucontent ?? '')
                                @else
                                    @if ($item->rubrique == 0 || $item->rubrique == "")
                                        <a href="{{ route ('homeSubSubMenu', $item->id )}}">
                                            <i class="fa fa-arrow-circle-right" style="margin-right: 3px;"></i>Sous-menus
                                        </a>
                                    @endif
                                @endif

                                <a href="Javascript:void()" id="updateSubMenu"
                                    data-name="{{ $item->name }}"
                                    data-submenuid="{{ $item->id }}"
                                    data-position="{{ $item->position }}"
                                ><i class="fa fa-edit" style="margin-right: 3px;"></i>Modifier</a>
                                <a href="JavaScript:void()" id="deletesubmenumodal"
                                    data-idsubmenu="{{ $item->id }}"
                                ><i class="fa fa-trash" style="margin-right: 3px;"></i>Supprimer</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr >
                <td colspan="7" class="text-primary text-center" >
                    <p style="font-size: 14px; margin-top:50px; color:#888">Pas de sous menu enregistrer!</p>
                </td>
            </tr>
        @endif
        </tbody>
    </table>

     <!-- Modale pour affecter un sous menu a une rubrique -->
     <div id="AddRubriqueSubMenuModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px;font-size:18px; font-weight:bold">{{ __('Affecter une rubrique à ') }}
                        <span id="subnamemenuaffected"></span>
                    </h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="createform" lpformnum="1"  method="post" enctype="multipart/form-data" action="{{ route ('affect-rubrique-sub')}}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="menu_id" id="sub_menu_affected"/>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Choisir la rubrique à affecter') }}</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <select name="rubrique" id="subrubriqueinfo" class="form-control">
                                        <option selected>Choisir une option</option>
                                        <option value="0">Annuler l'affectation</option>
                                        <option value="1">Articles</option>
                                        <option value="2">Services</option>
                                        <option value="3">Produits</option>
                                        <option value="4">Staff</option>
                                    </select>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" data-dismiss="modal" aria-label="Close" aria-hidden="true" class="btn btn-bg-secondary">{{ __('Annuler') }}</button>
                        <button type="submit" id="buttoncreate" class="btn btn-primary newBtn">{{ __('Affecter') }}</button>
                        <div class="textalert"  id="errorformcreate"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end popup -->

     <!-- modale de creation d'un sous menu -->
     <div id="AddSubMenuModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px;font-size:18px; font-weight:bold">{{ __('Ajouter un sous menu') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="createform" lpformnum="1"  method="post" enctype="multipart/form-data" action="{{ route ('create-sub-menu') }}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="creator" value="{{ auth()->user()->id }}"/>
                        <input type="hidden" name="parent_id" value="{{ $parent->id }}"/>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Nom du sous menu') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="name" name="name" style="border-radius:5px" required placeholder="Nom du sous menu" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Choisir la position') }}</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <select name="position" id="" class="form-control">
                                        <option value="1" selected>Première position</option>
                                        <option value="2">Deuxième position</option>
                                        <option value="3">Troisième position</option>
                                        <option value="4">Quatrième position</option>
                                        <option value="5">Cinquième position</option>
                                        <option value="6">Sixième position</option>
                                    </select>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" data-dismiss="modal" aria-label="Close" aria-hidden="true" class="btn btn-bg-secondary">{{ __('Annuler') }}</button>
                        <button type="submit" id="buttomcreate" class="btn btn-primary newBtn">{{ __('Sauvegarder') }}</button>
                        <div class="textalert"  id="errorformcreate"></div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- end popup -->

    <!-- Modale pour mettre a jour un sous menu -->
    <div id="UpdateSubMenuModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px;font-size:18px; font-weight:bold">{{ __('Mise à jour ') }}
                        <span id="namesubmenu"></span>
                    </h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="updateform" lpformnum="1"  method="post" enctype="multipart/form-data" action="{{ route ('update-sub-menu')}}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="menu_id" id="sub_menu_id_current"/>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Modifier le nom du menu') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="namesubmenuentry" name="name" style="border-radius:5px"  placeholder="nom du sous menu" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Mettre à jour la position') }}</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <select name="position" id="positionupdate" class="form-control">
                                        <option value="1">Première position</option>
                                        <option value="2">Deuxième position</option>
                                        <option value="3">Troisième position</option>
                                        <option value="4">Quatrième position</option>
                                        <option value="5">Cinquième position</option>
                                        <option value="6">Sixième position</option>
                                    </select>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" data-dismiss="modal" aria-label="Close" aria-hidden="true" class="btn btn-bg-secondary">{{ __('Annuler') }}</button>
                        <button type="submit" id="buttonupdate" class="btn btn-primary newBtn">{{ __('Sauvegarder') }}</button>
                        <div class="textalert"  id="errorupdate"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end popup -->

    <!-- modale pour supprimer les sous menus -->
    <div id="DeleteSubMenu" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px; font-size:18px; font-weight:bold">{{ __('Supprimer ce sous menu') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="delete_form" lpformnum="1"  method="post" enctype="multipart/form-data" action="{{ route ('delete-sub-menu')}}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="currentmenu" id="idsubmenu" />
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>{{  __('Voulez vous vraiment suprimer ce sous menu ?') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" data-dismiss="modal" aria-label="Close" aria-hidden="true" class="btn btn-bg-secondary">{{ __('Annuler') }}</button>
                        <button type="submit" id="buttondelete" class="btn btn-primary newBtn">{{ __('Supprimer') }}</button>
                        <div class="textalert"  id="errorformdelete"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end popup -->

    <!-- modale de creation de detail de sous menu -->
    <div id="DetailSubMenuModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px;font-size:18px; font-weight:bold">{{ __('Ajouter le contenu') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="createformsubcontenu" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmission()" action="{{ route ('create-contenu-sub') }}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="creator" value="{{ auth()->user()->id }}"/>
                        <input type="hidden" name="menu_id" id="menu_id_info">
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Titre de l\'image') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="title" name="title" style="border-radius:5px" required placeholder="titre" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Label de la description') }}</p>
                                <div class="form-group label-floating" style="widthtextarea: 100%;">
                                    <input class="form-control"  name="libelle" style="border-radius:5px" required placeholder="Veuillez saisir le label de la description" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label style="color: #888" for="exampleFormControlTextarea1">{{ __('Description')}}</label>
                            <div class="editor" style="height:40vh">
                            </div>
                            <input class="form-control post-content" name="description" type="hidden"/>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Entrer une image') }}</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <input type="file" class="form-control" id="photo" name="image" style="border-radius:5px" required  />
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" data-dismiss="modal" aria-label="Close" aria-hidden="true" class="btn btn-bg-secondary">{{ __('Annuler') }}</button>
                        <button type="submit" id="buttomcreatesubcontenu" class="btn btn-primary newBtn">{{ __('Sauvegarder') }}</button>
                        <div class="textalert"  id="errorformcreatesubcontenu"></div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- end popup -->

    <!-- modal mettre a jour le contenu du sous menu -->
    <div id="UpdateSubContenuModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px;font-size:18px; font-weight:bold">{{ __('Modifier le contenu') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="createformsubcontenu" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmissionUpdate()" action="{{ route ('update-contenu-sub') }}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="content_id" id="contenu_id"> 
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Titre de l\'image') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="titlecontenu" id="title" name="title" style="border-radius:5px" required placeholder="titre" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Label de la description') }}</p>
                                <div class="form-group label-floating" style="widthtextarea: 100%;">
                                    <input class="form-control" id="libellecontenu"  name="libelle" style="border-radius:5px" required placeholder="Veuillez saisir le label de la description" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label style="color: #888" for="exampleFormControlTextarea1">{{ __('Description')}}</label>
                            <div class="editorupdate" style="height:40vh">
                            </div>
                            <input class="form-control post-content-update" name="description" type="hidden"/>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{ __('Mise à jour de l\'image') }}</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <img id="phototoupdatecontenu" class="showimagetoupdate" />
                                    <input type="file"  class="form-control" id="imagetoupdate" name="image" style="border-radius:5px"/>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" data-dismiss="modal" aria-label="Close" aria-hidden="true" class="btn btn-bg-secondary">{{ __('Annuler') }}</button>
                        <button type="submit" id="buttomcreatesubcontenu" class="btn btn-primary newBtn">{{ __('Sauvegarder') }}</button>
                        <div class="textalert"  id="errorformcreatesubcontenu"></div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- end popup -->

    <!-- modale pour visualiser le contenu de sous menu -->
    <div id="ViewContenuSubMenuModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px;font-size:18px; font-weight:bold">{{ __('Visualiser le contenu') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="" lpformnum="1"  method="post" enctype="multipart/form-data">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Titre de l\'image') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <span id="titlecontenuview"></span>
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Label de la description') }}</p>
                                <div class="form-group label-floating" style="widthtextarea: 100%;">
                                    <span id="libellecontenuview"></span>
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label style="color: #888" for="exampleFormControlTextarea1">{{ __('Description')}}</label>
                            <span id="descriptioncontenuview"></span>
                        </div><hr>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Entrer une image') }}</p>
                                <div class="form-group label-floating" style="width: 100%; heigth:400px">
                                    <img id="imagetoupdateview"  src="" alt="">
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- end popup -->

</div>

@endsection

