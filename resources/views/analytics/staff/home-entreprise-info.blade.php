@extends('analytics/template')
@section('contenu')
<div class="container-fluid">
    <h1 class="mt-4">Analytics</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Gestion des information de l'entreprise</li>
        <li class="EditInfosEntreprise">
            <a href="#"
            id="UpdateInfos"
            @if ($entreprise ?? '')
                data-name="{{$entreprise->name}}"
                data-email1="{{$entreprise->email1}}"
                data-email2="{{$entreprise->email2}}"
                data-adresse1="{{$entreprise->adresse1}}"
                data-adresse2="{{$entreprise->adresse2}}"
                data-telephone1="{{$entreprise->telephone1}}"
                data-telephone2="{{$entreprise->telephone2}}"
                data-activity="{{$entreprise->activity}}"
                data-vision="{{$entreprise->vision}}"
                data-mission="{{$entreprise->mission}}"
                data-objectifs="{{$entreprise->objectifs}}"
                data-contexte="{{$entreprise->contexte}}"
                data-maplink="{{$entreprise->mapLink}}"
                data-logo="{{$entreprise->logo}}"
                data-cover="{{$entreprise->cover}}"
            @endif
            data-toggle="tooltip"
            title="Modifier">
                <span class="plusadd"> <i class="fa fa-edit" ></i></span>
            </a>
        </li>
    </ol>
    <table class="table shadow-card">
        @if ($entreprise ?? '')
            <tr>
                <td class="text-primary text-left" >
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-xs-12 BlockInfo">
                            <p style="font-size: 17px; margin-top:50px; color:#888">Nom : <span class="valuetextent">{{$entreprise->name}}</span></p>
                        </div>
                        <div class="col-lg-6 col-md-12 col-xs-12">
                            <p style="font-size: 17px; margin-top:50px; color:#888; width: 45%;">Email : <span class="valuetextent">{{$entreprise->email1}}</span></p>
                        </div>
                    </div>
                </td>
            </tr>
            <tr >
                <td colspan="12" class="text-primary text-left">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-xs-12 BlockInfo">
                            <p style="font-size: 17px; margin-top:50px; color:#888">Activité : <span class="valuetextent">{{$entreprise->activity}}</span></p>
                        </div>
                        <div class="col-lg-6 col-md-12 col-xs-12">
                            <p style="font-size: 17px; margin-top:50px; color:#888; width: 45%;">Contexte : <span class="valuetextent">{{$entreprise->contexte}}</span></p>
                        </div>
                    </div>
                </td>
            </tr>
            <tr >
                <td colspan="12" class="text-primary text-left">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-xs-12 BlockInfo">
                            <p style="font-size: 17px; margin-top:50px; color:#888">Vision : <span class="valuetextent">{{$entreprise->vision}}</span></p>
                        </div>
                        <div class="col-lg-6 col-md-12 col-xs-12">
                            <p style="font-size: 17px; margin-top:50px; color:#888; width: 45%;">Mission : <span class="valuetextent">{{$entreprise->mission}}</span></p>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="12" class="text-primary text-left">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-xs-12 BlockInfo">
                            <p style="font-size: 17px; margin-top:50px; color:#888">Objectifs : <span class="valuetextent">{{$entreprise->objectifs}}</span></p>
                        </div>
                        <div class="col-lg-6 col-md-12 col-xs-12">
                            <p style="font-size: 17px; margin-top:50px; color:#888; width: 45%;" class="valuetextent">Map : {{Str::limit($entreprise->mapLink, 100, '...')}}</p>
                        </div>
                    </div>
                </td>
            </tr>
            <tr >
                <td colspan="12" class="text-primary text-left" >
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-xs-12 BlockInfo">
                            <p style="font-size: 17px; margin-top:50px; color:#888">Adresse Principale : <span class="valuetextent">{{$entreprise->adresse1}}</span></p>
                        </div>
                        <div class="col-lg-6 col-md-12 col-xs-12 BlockInfo">
                            <p style="font-size: 17px; margin-top:50px; color:#888">Adresse secondaire : <span class="valuetextent">{{$entreprise->adresse2}}</span></p>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="12" class="text-primary text-left">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-xs-12">
                            <p style="font-size: 17px; margin-top:50px; color:#888; width: 45%;font-size: 17px; margin-top:50px; color:#888">Email secondaire : <span class="valuetextent">{{$entreprise->email2}}</span></p>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="12" class="text-primary text-left">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-xs-12">
                            <p style="font-size: 17px; margin-top:50px; color:#888; width: 45%;">Téléphone Principale : <span class="valuetextent">{{$entreprise->telephone1}}</span></p>
                        </div>
                        <div class="col-lg-6 col-md-12 col-xs-12 BlockInfo">
                            <p style="font-size: 17px; margin-top:50px; color:#888">Téléphone secondaire : <span class="valuetextent">{{$entreprise->telephone2}}</span></p>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="12" class="text-primary text-left">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-xs-12 BlockInfo">
                            <p style="font-size: 17px; margin-top:50px; color:#888">Logo de l'entreprise</p>
                            <img width="200px" height="200px" src="{{ asset ('/storage/'.$entreprise->logo) }}" alt="">
                        </div>
                        <div class="col-lg-6 col-md-12 col-xs-12">
                            @if ($entreprise->cover ?? '')
                                <p style="font-size: 17px; margin-top:50px; color:#888">Photo de couverture de l'entreprise</p>
                                <img width="400px" height="200px" src="{{ asset ('/storage/'.$entreprise->cover) }}" alt="">
                            @else
                                <p style="font-size: 17px; margin-top:50px; color:#888">Aucune photo de couverture enregistrer!</p>
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
        @else
            <tr >
                <td colspan="12" class="text-primary text-center" >
                    <a href="#" class="btn btn-primary" id="AddInfosEntreprise" style="font-size: 17px; margin-top:5px; color:#fff">
                        Aucune information enregistrer, veuillez cliquer ici pour enregistrer!
                    </a>
                </td>
            </tr>
        @endif
    </table>

    <!-- modale de add infos entreprise -->
    <div id="AddEntrepriseModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px;font-size:18px; font-weight:bold">{{ __('Ajouter les informations de l\'entreprise') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="" lpformnum="1"  method="post" enctype="multipart/form-data" action="{{ route ('create-entreprise') }}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="creator" value="{{ auth()->user()->id }}"/>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Nom de l\'entreprise') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" name="name" style="border-radius:5px" required placeholder="Nom" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Contexte l\'entreprise') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" name="contexte" style="border-radius:5px" required placeholder="Contexte" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Activité de l\'entreprise') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" name="activity" style="border-radius:5px" required placeholder="Activité" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('La vision de l\'entreprise') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <textarea class="form-control" name="vision"  required rows="6" placeholder="La vision de l'entreprise"></textarea>
                                    <hr>
                                </div>
                            </div>
                        </div>


                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Mission de l\'entreprise') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <textarea class="form-control" name="mission"  required rows="6" placeholder="La mission de l'entreprise"></textarea>
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Objectifs de l\'entreprise') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <textarea class="form-control" name="objectifs"  required rows="12" placeholder="Les Objectifs"></textarea>
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Adresse principale de l\'entreprise') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" name="adresse1" style="border-radius:5px" required placeholder="Adresse obligatoire" />
                                    <hr>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Adresse secondaire de l\'entreprise') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" name="adresse2" style="border-radius:5px" placeholder="Adresse Optionnel" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Numéro de téléphone principal de l\'entreprise') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" name="telephone1" style="border-radius:5px" required placeholder="Téléphone Obligatoire" />
                                    <hr>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Numéro de téléphone secondaire de l\'entreprise') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" name="telephone2" style="border-radius:5px" placeholder="Téléphone Optionnel" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Adresse email principal de l\'entreprise') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" name="email1" style="border-radius:5px" required placeholder="Email Obligatoire" />
                                    <hr>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Adresse email secondaire de l\'entreprise') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" name="email2" style="border-radius:5px" placeholder="Email Optionnel" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Adresse google map de l\'entreprise') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" name="mapLink" style="border-radius:5px" required placeholder="Map" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-6 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Logo de l\'entreprise') }}</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <input type="file" class="form-control" id="logo" name="logo" style="border-radius:5px" required  />
                                    <hr>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Photo de couverture de l\'entreprise (Optionnel)') }}</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <input type="file" class="form-control" id="cover" name="cover" style="border-radius:5px"  />
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

    <!-- Modale pour mettre les informations de l'entreprise -->
    <div id="UpdateEntInfosModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px;font-size:18px; font-weight:bold">{{ __('Mise à jour de ') }}
                        <span id="nameentreprise"></span>
                    </h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="updateform" lpformnum="1"  method="post" enctype="multipart/form-data" action="{{ route ('update-entreprise')}}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Nom de l\'entreprise') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="nameid" name="name" style="border-radius:5px" placeholder="Nom" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Contexte l\'entreprise') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="contexteid" name="contexte" style="border-radius:5px" placeholder="Contexte" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Activité de l\'entreprise') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="activityid" name="activity" style="border-radius:5px" placeholder="Activité" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('La vision de l\'entreprise') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <textarea class="form-control" id="visionid" name="vision"  rows="6" placeholder="La vision de l'entreprise"></textarea>
                                    <hr>
                                </div>
                            </div>
                        </div>


                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Mission de l\'entreprise') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <textarea class="form-control" id="missionid" name="mission"  rows="6" placeholder="La mission de l'entreprise"></textarea>
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Objectifs de l\'entreprise') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <textarea class="form-control" id="objectifsid" name="objectifs"  rows="12" placeholder="Les Objectifs"></textarea>
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Adresse principale de l\'entreprise') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="adresse1id" name="adresse1" style="border-radius:5px" placeholder="Adresse obligatoire" />
                                    <hr>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Adresse secondaire de l\'entreprise') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="adresse2id" name="adresse2" style="border-radius:5px" placeholder="Adresse Optionnel" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Numéro de téléphone principal de l\'entreprise') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="telephone1id" name="telephone1" style="border-radius:5px" placeholder="Téléphone Obligatoire" />
                                    <hr>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Numéro de téléphone secondaire de l\'entreprise') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="telephone2id" name="telephone2" style="border-radius:5px" placeholder="Téléphone Optionnel" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Adresse email principal de l\'entreprise') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="email1id" name="email1" style="border-radius:5px" placeholder="Email Obligatoire" />
                                    <hr>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Adresse email secondaire de l\'entreprise') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="email2id" name="email2" style="border-radius:5px" placeholder="Email Optionnel" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Adresse google map de l\'entreprise') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="maplinkid" name="mapLink" style="border-radius:5px" placeholder="Map" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-6 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Logo de l\'entreprise') }}</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <input type="file" id="logoupdateid" class="form-control" id="logo" name="logo" style="border-radius:5px"  />
                                    <hr>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Photo de couverture de l\'entreprise (Optionnel)') }}</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <input type="file" id="coverupdateid" class="form-control" id="cover" name="cover" style="border-radius:5px"  />
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
</div>
@endsection

