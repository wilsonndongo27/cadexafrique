@extends('analytics/template')
@section('contenu')

<div class="container-fluid">
    <h1 class="mt-4">Analytics</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Gestion des catégories des produits</li>
    </ol>
    <table id="articles-table" class="table shadow-card">
        <thead style="margin-left:5px">
            <tr style="font-size: 14px;">
                <th title="Nom de la catégorie">{{ __('Intitulé') }}</th>
                <th title="Auteur de de la création de l'article">{{ __('Créer par :') }}</th>
                <th title="Date ou la catégorie a été créé">{{ __('Dates de création') }}</th>
                <th title="" style="width:3px;"> > </th>
                <span class="counter"> Total Catégories <span class="badgecount">{{ count($allcategorienew) }}</span></span>
                <a href="#" id="AddCategorieSolution" data-toggle="tooltip" title="Ajouter une catégorie">
                    <span class="plusadd"> <i class="fa fa-plus-circle" ></i></span>
                </a>
            </tr>
        </thead>
        <tbody style="font-size: 14px;">
            <div class="loader hideloader">
                <div class="snippet" data-title=".dot-pulse">
                    <div class="stage">
                        <div class="dot-pulse"></div>
                    </div>
                </div>
            </div>
        @if ($allcategorienew ?? '')
            @foreach ($allcategorienew as $item)
                <tr>
                    <td style="color: #888;">{{ $item->name }}</td>
                    <td style="color: #888;">{{ $item->creator ?? '' }}</td>
                    <td style="color: #888;">{{ $item->created_at }}</td>
                    <td>
                        <div class="dropdown">
                            <button class="dropbtn"><p style="font-size: 13px; margin-top:-10px;">Options</p></button>
                            <div class="dropdown-content">
                              <a href="Javascript:void()" id="updatecategoriesolution"
                                data-categorieid="{{ $item->id }}"
                                data-name="{{ $item->name }}"
                              >Update</a>
                              <a href="JavaScript:void()" id="deletecategoriesolutionmodal"
                                data-idcategorie="{{ $item->id }}"
                              >Delete</a>
                            </div>
                          </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr >
                <td colspan="7" class="text-primary text-center" >
                    <p style="font-size: 14px; margin-top:50px; color:#888">Aucune catégorie enregistré!</p>
                </td>
            </tr>
        @endif
        </tbody>
    </table>

    <!-- modale de creation des categorie -->
    <div id="AddCategorieSolutionModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px;font-size:18px; font-weight:bold">{{ __('Créer une catégorie') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="createform" lpformnum="1"  method="post" enctype="multipart/form-data" action="{{ route ('create-categorie-solution') }}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="creator" value="{{ Auth::user()->id }}"/>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Intitulé de la catégorie') }}</p>
                                <div class="form-group label-floating" style="widthtextarea: 100%;">
                                    <input class="form-control"  name="name" style="border-radius:5px" required placeholder="Nom de la catégorie" />
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

    <!-- Modale pour mettre a jour la categorie -->
    <div id="UpdateCategorieSolutionModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px;font-size:18px; font-weight:bold">{{ __('Mise à jour de la catégorie') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="updateform" lpformnum="1"  method="post" enctype="multipart/form-data" action="{{ route ('update-categorie-solution')}}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="categorie_id" id="categorie_id"/>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Mise à jour de l\'intituté de la catégorie') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="namecategorie" name="name" style="border-radius:5px"  placeholder="intitulé de la catégorie" />
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

    <!-- modale pour supprimer les categories -->
    <div id="DeleteSolutionCategorie" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px; font-size:18px; font-weight:bold">{{ __('Supprimer la catégorie choisie choisi') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="delete_form" lpformnum="1"  method="post" enctype="multipart/form-data" action="{{ route ('delete-categorie-solution')}}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="currentcategorie" id="idcategorie" />
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>{{  __('Voulez vous vraiment suprimer cette catégorie ?') }}</p>
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

</div>
@endsection

