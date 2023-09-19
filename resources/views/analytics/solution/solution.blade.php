@extends('analytics/template')
@section('contenu')
<div class="container-fluid">
    <h1 class="mt-4">Analytics</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Gestion des produits</li>
    </ol>
    <table id="articles-table" class="table shadow-card">
        <thead style="margin-left:5px">
            <tr style="font-size: 14px;">
                <th title="">{{ __('Images') }}</th>
                <th title="">{{ __('Catégories') }}</th>
                <th title="">{{ __('Titre') }}</th>
                <th title="">{{ __('Description') }}</th>
                <th title="">{{ __('Date de création') }}</th>
                <th title="">{{ __('Status') }}</th>
                <th title="" style="width:3px;"> > </th>
                <span class="counter"> Total des produits <span class="badgecount">{{ count($allsolution)}}</span></span>
                <a href="#" id="AddSol" data-toggle="tooltip" title="Ajouter une solution">
                    <span class="plusadd"> <i class="fa fa-plus-circle" ></i></span>
                </a>
            </tr>
        </thead>
        <tbody style="font-size: 14px;">
        @if ($allsolution ?? '')
            @foreach ($allsolution as $item)
                <tr>
                    <td>
                        <img class="zoom" style="border-radius: 20px;" src="{{ asset('storage/'.$item->photo) }}" alt="{{$item->photo}}" alt="" />
                    </td>
                    <td style="color: #888;">{{ $item->categorie }}</td>
                    <td style="color: #888;">{{ Str::limit($item->name, 30)  }}</td>
                    <td style="color: #888;">{!! Str::limit(html_entity_decode($item->description), 150) !!}</td>
                    <td style="color: #888;">{{ $item->created_at }}</td>
                    @if($item->status == 0)
                    <td style="color: #F07000;">Inacive</td>
                    @else
                    <td style="color: #F07000;">active</td>
                    @endif
                    <td>
                        <div class="dropdown">
                            <button class="dropbtn"><p style="font-size: 13px; margin-top:-10px;">Options</p></button>
                            <div class="dropdown-content">
                              <a href="{{ route ('homeDetailSolution', $item->id )}}"><i class="fa fa-info-circle" style="margin-right: 3px;"></i>Détails</a>
                              <a href="Javascript:void()" id="updatesolution"
                                data-idsolution="{{ $item->id }}"
                                data-name="{{ $item->name }}"
                                data-label="{{ $item->labelDesc }}"
                                data-description="{{ $item->description }}"
                                data-categorie="{{ $item->categorie }}"
                                data-photo="{{ asset('storage/'.$item->photo) }}"
                              ><i class="fa fa-edit" style="margin-right: 3px;"></i>Modifier</a>
                              <a href="JavaScript:void()" id="deletesolutionmodal"
                                data-idsolution="{{ $item->id }}"
                              ><i class="fa fa-trash" style="margin-right: 3px;"></i>Supprimer</a>
                            </div>
                          </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr >
                <td colspan="7" class="text-primary text-center" >
                    <p style="font-size: 14px; margin-top:50px; color:#888">Liste des produits vide!</p>
                </td>
            </tr>
        @endif
        </tbody>
    </table>

       <!-- modale de creation d'une solutipn -->
       <div id="AddSolModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px;font-size:18px; font-weight:bold">{{ __('Ajouter un produits') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="createform" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmission()" action="{{ route ('create-solution') }}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="creator" value="{{ auth()->user()->id }}"/>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Titre de la solution') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="name" name="name" style="border-radius:5px" required placeholder="titre du produit" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Label de la description') }}</p>
                                <div class="form-group label-floating" style="widthtextarea: 100%;">
                                    <input class="form-control"  name="labelDesc" style="border-radius:5px" required placeholder="label de la description" />
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

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Mettre à jour la priorité') }}</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <select name="categorie" id="" class="form-control">
                                        @if ($allcategorie ?? "")
                                            @foreach ( $allcategorie as $item )
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        @else
                                        @endif
                                    </select>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Choisir le niveau de priorité') }}</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <select name="priority" id="" class="form-control">
                                        <option value="1">Nouveaux</option>
                                        <option value="2">Importants</option>
                                        <option value="3">Attractifs</option>
                                        <option value="4">Futures</option>
                                    </select>
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Entrer l\'image') }}</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <input type="file" class="form-control" id="photo" name="photo" style="border-radius:5px" required  />
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

    <!-- Modale pour mettre a jour une solution -->
    <div id="UpdateSolutionModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px;font-size:18px; font-weight:bold">{{ __('Mise à jour ') }}
                        <span id="namesolutiontitle"></span>
                    </h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="updateform" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmissionUpdate()" action="{{ route ('update-solution')}}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="solution_id" id="solution_id"/>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Modifier le titre de la solution') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="namesolution" name="name" style="border-radius:5px"  placeholder="name of the categorie" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Modifier le label de la description') }}</p>
                                <div class="form-group label-floating" style="widthtextarea: 100%;">
                                    <input class="form-control" id="idlabel" name="labelDesc" style="border-radius:5px" required placeholder="label de la description" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label style="color: #888" for="exampleFormControlTextarea1">{{ __('Modidier la description')}}</label>
                            <div class="editorupdate" style="height:40vh">
                            </div>
                            <input class="form-control post-content-update" name="description" type="hidden"/>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Mettre à jour la priorité') }}</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <select name="priority" id="" class="form-control">
                                        <option value="1">Choisir un niveau</option>
                                        <option value="1">Nouveaux</option>
                                        <option value="2">Importants</option>
                                        <option value="3">Attractifs</option>
                                        <option value="4">Futures</option>
                                    </select>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Mettre à jour la priorité') }}</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <select name="categorie" id="" class="form-control">
                                        <option value="1">Choisir une autre catégorie</option>
                                        @if ($categorie ?? "")
                                            @foreach ( $categorie as $item )
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        @else
                                        @endif
                                    </select>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Mise à jour de l\'image') }}</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <img id="phototoupdate" class="showimagetoupdate" />
                                    <input type="file"  class="form-control" id="hideinputimage" name="photo" style="border-radius:5px"  />
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

    <!-- modale pour supprimer les solutions -->
    <div id="DeleteSolution" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px; font-size:18px; font-weight:bold">{{ __('Supprimer ce service') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="delete_form" lpformnum="1"  method="post" enctype="multipart/form-data" action="{{ route ('delete-solution')}}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="currentsolution" id="idsolutiondelete" />
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>{{  __('Voulez vous vraiment suprimer ce produits ?') }}</p>
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

