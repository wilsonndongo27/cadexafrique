@extends('analytics/template')
@section('contenu')
<!-- Include Quill stylesheet -->
<link href="./admindashboard/css/quill.snow.css" rel="stylesheet"/>

<div class="container-fluid">
    <h1 class="mt-4">Analytics</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Gestion des services</li>
    </ol>
    <table id="articles-table" class="table shadow-card">
        <thead style="margin-left:5px">
            <tr style="font-size: 14px;">
                <th title="Image du service">{{ __('Photos de coverture') }}</th>
                <th title="Intitulé du service">{{ __('Intitulés') }}</th>
                <th title="Description du service">{{ __('Descriptions') }}</th>
                <th title="Le créateur du service">{{ __('Auteurs') }}</th>
                <th title="Date de création du service">{{ __('Date de création') }}</th>
                <th title="" style="width:3px;"> > </th>
                <span class="counter"> Total Services <span class="badgecount">{{ count($allservice)}}</span></span>
                <a href="#" id="AddService" data-toggle="tooltip" title="Ajouter un service">
                    <span class="plusadd"> <i class="fa fa-plus-circle" ></i></span>
                </a>
            </tr>
        </thead>
        <tbody style="font-size: 14px;">
        @if ($allservice ?? '')
            @foreach ($allservice as $item)
                <tr>
                    <td>
                        <img class="zoom" style="border-radius: 20px;" src="{{ asset('storage/'.$item->cover) }}" alt="{{$item->cover}}" alt="" />
                    </td>
                    <td style="color: #888;">{{ $item->title }}</td>
                    <td style="color: #888;">{!! Str::limit(html_entity_decode($item->description), 150) !!}</td>
                    <td style="color: #888;">{{ $item->creator }}</td>
                    <td style="color: #888;">{{ $item->created_at }}</td>
                    <td>
                        <div class="dropdown">
                            <button class="dropbtn"><p style="font-size: 13px; margin-top:-10px;">Options</p></button>
                            <div class="dropdown-content">
                              <a href="{{ route ('homeDetailArticle', $item->id) }}" >Détails</a>
                              <a href="Javascript:void()" id="updateservice"
                                data-serviceid="{{ $item->id }}"
                                data-title="{{ $item->title }}"
                                data-label="{{ $item->labelDesc }}"
                                data-description="{{ $item->description }}"
                                data-photo="{{ asset('storage/'.$item->cover) }}"
                              >Modifier</a>
                              <a href="JavaScript:void()" id="deleteservicemodal"
                                data-idservice="{{ $item->id }}"
                              >Supprimer</a>
                            </div>
                          </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr >
                <td colspan="7" class="text-primary text-center" >
                    <p style="font-size: 14px; margin-top:50px; color:#888">Pas de service enregistrer pour l'instant!</p>
                </td>
            </tr>
        @endif
        </tbody>
    </table>

    <!-- modale de creation d'un service -->
    <div id="AddServiceModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                      <h4 class="modal-title" style="margin-left: 11px;font-size:18px; font-weight:bold">{{ __('Ajouter un service') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="createform" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmission()" action="{{ route ('create-service') }}" onclick="ServiceSubmission()">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="creator" value="{{ auth()->user()->id }}"/>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Intitulé du service') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="title" name="title" style="border-radius:5px" required placeholder="Intitulé du service" />
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
                                <p style="color: #888">{{ __('Choisir le niveau de priorité') }}</p>
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

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Choisissez une image de présentation du service') }}</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <input type="file" class="form-control" id="photo" name="cover" style="border-radius:5px" required  />
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

    <!-- Modale pour mettre a jour un service -->
    <div id="UpdateServiceModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px;font-size:18px; font-weight:bold">{{ __('Mise à jour du Service') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="updateform" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmissionUpdate()" action="{{ route ('update-service')}}" onclick="ServiceSubmissionUpdate()">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="service_id" id="service_id"/>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Mise à jour du titre') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="titleservice" name="title" style="border-radius:5px"  placeholder="title of the message" />
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Label de la description') }}</p>
                                <div class="form-group label-floating" style="widthtextarea: 100%;">
                                    <input class="form-control" id="labelDescService"  name="labelDesc" style="border-radius:5px" required placeholder="label de la description" />
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

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{ __('Mise à jour de l\'image') }}</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <img id="phototoupdate" class="showimagetoupdate" />
                                    <input type="file"  class="form-control" id="hideinputimage" name="cover" style="border-radius:5px"/>
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

    <!-- modale pour supprimer un service -->
    <div id="DeleteService" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px; font-size:18px; font-weight:bold">{{ __('Supprimer le service') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="delete_form" lpformnum="1"  method="post" enctype="multipart/form-data" action="{{ route ('delete-service')}}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="currentservice" id="idservice" />
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>{{  __('Voulez vous vraiment suprimer ce service ?') }}</p>
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

