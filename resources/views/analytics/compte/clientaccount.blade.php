@extends('analytics/template')
@section('contenu')
<div class="container-fluid">
    <h1 class="mt-4">Analytics</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Gestion des comptes des clients</li>
    </ol>
    <table id="articles-table" class="table shadow-card">
        <thead style="margin-left:5px">
            <tr style="font-size: 14px;">
                <th title="">{{ __('Photo de profil') }}</th>
                <th title="">{{ __('Noms') }}</th>
                <th title="">{{ __('Emails') }}</th>
                <th title="">{{ __('Téléphones') }}</th>
                <th title="">{{ __('Status') }}</th>
                <th title="" style="width:3px;"> > </th>
                <span class="counter"> Total des comptes <span class="badgecount">{{ count($allclientaccount) }}</span></span>
                <a href="#" id="AddClientAccount" data-toggle="tooltip" title="Ajouter un compte">
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
        @if ($allclientaccount ?? '')
            @foreach ($allclientaccount as $item)
                <tr>
                    <td>
                        <a href="Javascript:void()" id="detailmodal"
                            data-name="{{ $item->name }}"
                            data-email="{{ $item->email }}"
                            data-telephone="{{ $item->telephone }}"
                            data-status="{{ $item->actif }}"
                            data-photo="{{ asset('storage/'.$item->pp) }}"
                        >
                            <img class="zoom"  style="border-radius: 100%;" src="{{ asset('storage/'.$item->pp) }}" alt="{{$item->pp}}" alt="" />
                        </a>
                    </td>
                    <td style="color: #888;">{{ $item->name }}</td>
                    <td style="color: #888;">{{ $item->email }}</td>
                    <td style="color: #888;">{{ $item->telephone }}</td>
                    @if($item->actif == 1)
                        <td style="color: #092e67;" class="blockbutton">
                            <a href="JavaScript:void()" id="changestatus"
                                data-statusvalue="{{ $item->actif }}"
                                data-currentadmin="{{ $item->id }}"
                                data-url="{{ route ('status-admin')}}"
                                data-csrf="{{ csrf_token() }}">
                                <label class="switch">
                                    <input type="checkbox" checked >
                                    <span class="slider round"></span>
                                </label>
                            </a>
                        </td>
                    @else
                        <td style="color:#092e67;" class="blockbutton">
                            <a href="JavaScript:void()" id="changestatus"
                                data-valuestatus="{{ $item->actif }}"
                                data-currentadmin="{{ $item->id }}"
                                data-url="{{ route ('status-admin')}}"
                                data-csrf="{{ csrf_token() }}">
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider round"></span>
                                </label>
                            </a>
                        </td>
                    @endif
                    <td>
                        <div class="dropdown">
                            <button class="dropbtn"><p style="font-size: 13px; margin-top:-10px;">Options</p></button>
                            <div class="dropdown-content">
                              <a href="Javascript:void()" id="updateclientaccount"
                                data-accountid="{{ $item->id }}"
                              ><i class="fa fa-edit" style="margin-right: 3px;"></i>Modifier</a>
                              <a href="JavaScript:void()" id="deleteadminmodal"
                                data-idadmin="{{ $item->id }}"
                              ><i class="fa fa-trash" style="margin-right: 3px;"></i>Supprimer</a>
                            </div>
                          </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr >
                <td colspan="7" class="text-primary text-center" >
                    <p style="font-size: 14px; margin-top:50px; color:#888">Aucun compte créer pour l'instant!</p>
                </td>
            </tr>
        @endif
        </tbody>
    </table>

    <!-- modale ajouter un compte client -->
    <div id="AddClientAccountModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg"  role="document">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="width: 50px; height:50px; border-radius:5px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px;font-size:18px; font-weight:bold">{{ __('Ajouter un compte') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="createform" lpformnum="1"  method="post" enctype="multipart/form-data" action="">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Nom du client') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control"  name="first_name" style="border-radius:5px" required placeholder="inserer le nom" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Prenom du client') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control"  name="last_name" style="border-radius:5px" required placeholder="inserer le prenom" />
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-4 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Adresse email') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input type="email" autocomplete="off" class="form-control" name="email" style="border-radius:5px" required placeholder="email du client" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Numéro de téléphone') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input type="number" class="form-control"  name="telephone" style="border-radius:5px" required placeholder="numéro de téléphone du client" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Date de naissance') }}</p>
                                <div class="form-group row">
                                    <div class="col-10">
                                        <input class="form-control" type="date" name="datenaissance" value="1999-08-19" id="example-date-input">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Pays') }}</p>
                                <div class="input-group">
                                    <select class="custom-select" id="inputGroupSelect04">
                                        <option selected>Choisir le pays...</option>
                                        <option value="1">Cameroun</option>
                                        <option value="2">Gabon</option>
                                        <option value="2">Nigéria</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Ville') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <div class="input-group">
                                        <select class="custom-select" id="inputGroupSelect04">
                                            <option selected>Choisir la ville...</option>
                                            <option value="1">Douala</option>
                                            <option value="2">Yaoundé</option>
                                            <option value="3">Kribi</option>
                                            <option value="3">Bafoussam</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-3 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Photo recto de la CNI') }}</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <a href="JavaScript:void()" id="uploadcnirecto" class="btn btn-primary uploadbtn"><span id="titleuploadcnirecto">Choisir l'image</span></a>
                                    <input type="file" onchange="PhotoRecto(this.value)" style="display: none;" id="photo_cni_recto" class="form-control"  name="photo_recto" style="border-radius:5px" required  />
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Photo verso de la CNI') }}</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <a href="JavaScript:void()" id="uploadcniverso" class="btn btn-primary uploadbtn"><span id="titleuploadcniverso">Choisir l'image</span></a>
                                    <input type="file" class="form-control" onchange="PhotoVerso(this.value)" style="display: none;" id="photo_cni_verso"   name="photo_verso" style="border-radius:5px" required  />
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Importer la signature') }}</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <a href="JavaScript:void()" id="uploadsignature" class="btn btn-primary uploadbtn"><span id="titleuploadsignature">Choisir l'image</span></a>
                                    <input type="file" style="display: none;" class="form-control" id="photo_signature" onchange="PhotoSignature(this.value)"  name="photo_signature" style="border-radius:5px" required  />
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Plan de localisation') }}</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <a href="JavaScript:void()" id="uploadlocalisation" class="btn btn-primary uploadbtn"><span id="titleuploadlocalisation">Choisir l'image</span></a>
                                    <input type="file"  onchange="PhotoLocalisation(this.value)" style="display: none;" class="form-control" id="photo_localisation"  name="photo_planlocalisation" style="border-radius:5px" required  />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" data-dismiss="modal" aria-label="Close" aria-hidden="true" class="btn btn-bg-secondary">{{ __('Annuler') }}</button>
                        <button type="submit" id="buttomcreate" class="btn btn-primary newBtn">{{ __('Sauvegarder') }}</button>
                        <div class="alert-danger"  id="errorformcreate"></div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- end popup -->

    <!-- Modale pour mettre a jour les informations des comptes -->
    <div id="UpdateAccountClientModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="width: 50px; height:50px; border-radius:5px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px;font-size:18px; font-weight:bold">{{ __('Mise à jour de l\'administrateur') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="updateform" lpformnum="1"  method="post" enctype="multipart/form-data" action="{{ route ('update-admin')}}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="currentadmin" id="admin_id"/>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Modifier le nom') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="nameadmin" name="name" style="border-radius:5px" required placeholder="nom de l'administrateur" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Modifier l\'adresse email') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input type="email" id="adminemail" autocomplete="off" class="form-control" id="title" name="email" style="border-radius:5px" required placeholder="email de l'administrateur" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Modifier le numéro de téléphone') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input type="number" id="admintelephone" class="form-control" name="telephone" style="border-radius:5px" required placeholder="numéro de téléphone de l'administrateur" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class=" mb-1" for="inputPassword">{{ _('Insérer le nouveau mot de passe')}}</label>
                            <div class="input-group" id="show_hide_password">
                                <input class="form-control py-4"  id="inputPassword" autocomplete="off" style="font-size:14px"  type="password" name="password" required  placeholder="Enter password" />
                                <div class="input-group-addon">
                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Mise à jour de la photo de profil') }}</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <img id="phototoupdateadmin" class="showimagetoupdate" />
                                    <input type="file"  class="form-control" id="hideinputimage" name="photo" style="border-radius:5px"  />
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" data-dismiss="modal" aria-label="Close" aria-hidden="true" class="btn btn-bg-secondary">{{ __('Annuler') }}</button>
                        <button type="submit" id="buttonupdate" class="btn btn-primary newBtn">{{ __('Sauvegarder') }}</button>
                        <div class="alert-danger"  id="errorupdate"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end popup -->

    <!-- modale pour supprimer les administrateurs -->
    <div id="DeleteAdmin" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="width: 50px; height:50px; border-radius:5px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px; font-size:18px; font-weight:bold">{{ __('Supprimer l\'administrateur choisi') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="delete_form" lpformnum="1"  method="post" enctype="multipart/form-data" action="{{ route ('delete-admin')}}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="currentadmin" id="idadmin" />
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>{{  __('Voulez vous vraiment suprimer cette administrateur ?') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" data-dismiss="modal" aria-label="Close" aria-hidden="true" class="btn btn-bg-secondary">{{ __('Annuler') }}</button>
                        <button type="submit" id="buttondelete" class="btn btn-primary newBtn">{{ __('Supprimer') }}</button>
                        <div class="alert-danger"  id="errorformdelete"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end popup -->

    <!-- pop detail des informations sur un administrateur -->
    <div class="modal fade" id="DetailAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <img style="width: 50px; height:50px; border-radius:5px; margin-top:-10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" id="myModalLabel">Plus d'information sur <span class="name-admin"></span></h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <center>
                        <img id="photo-admin" style="border-radius: 100%;" name="aboutme" width="140" height="140" border="0" class="img-circle">
                        <h3 class="media-heading">
                            <span class="name-admin"></span>
                            <i class="fa fa-globe-africa statusactif"></i>
                        </h3>
                    </center>
                    <hr>
                    <center>
                        <p class="text-left"><strong>Email : </strong>
                            <span id="admin-email"></span>
                        </p>
                        <hr>
                        <p class="text-left"><strong>Téléphone : </strong>
                            <span id="admin-telephone"></span>
                        </p>
                    </center>
                </div>
                <div class="modal-footer">
                    <center>
                        <button type="button" class="btn btn-default" data-dismiss="modal" >
                            <span style="color: #a5aac1;">Revenir à la liste</span>
                        </button>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <!-- end popup -->

</div>

@endsection

