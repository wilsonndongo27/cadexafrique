@extends('analytics/template')
@section('contenu')
<div class="container-fluid">
    <h1 class="mt-4">Analytics</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Gestion des comptes administrateurs</li>
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
                <span class="counter"> Total Administrateurs <span class="badgecount">{{ count($alladmins) }}</span></span>
                <a href="#" id="AddAdmin" data-toggle="tooltip" title="Ajouter un administrateur">
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
        @if ($alladmins ?? '')
            @foreach ($alladmins as $item)
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
                        <td style="color: #89ca98;"><span class="blockbutton-{{$item->id}}">Actif</span></td>
                    @else
                        <td style="color:#666;"><span class="blockbutton-{{$item->id}}">Inactif</span></td>
                    @endif
                    <td>
                        <div class="dropdown">
                            <button class="dropbtn"><p style="font-size: 13px; margin-top:-10px;">Options</p></button>
                            <div class="dropdown-content">
                              <a href="Javascript:void()" id="updateadmin"
                                data-adminid="{{ $item->id }}"
                                data-name="{{ $item->name }}"
                                data-email="{{ $item->email }}"
                                data-telephone="{{ $item->telephone }}"
                                data-status="{{ $item->actif }}"
                                data-photo="{{ asset('storage/'.$item->pp) }}"
                              >Modifier</a>
                              <a href="Javascript:void()" id="changestatus"
                                data-statusvalue="{{ $item->actif }}"
                                data-currentadmin="{{ $item->id }}"
                                data-nameadmin="{{ $item->name }}"
                              >Status</a>
                              <a href="JavaScript:void()" id="deleteadminmodal"
                                data-idadmin="{{ $item->id }}"
                              >Supprimer</a>
                            </div>
                          </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr >
                <td colspan="7" class="text-primary text-center" >
                    <p style="font-size: 14px; margin-top:50px; color:#888">Aucun administrateur enregistré pour l'instant!</p>
                </td>
            </tr>
        @endif
        </tbody>
    </table>

    <!-- modale ajouter un administrateur -->
    <div id="AddAdminModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="width: 50px; height:50px; border-radius:5px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px;font-size:18px; font-weight:bold">{{ __('Ajouter un administrateur') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="createform" lpformnum="1"  method="post" enctype="multipart/form-data" action="{{ route ('create-admin') }}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Nom complet') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control"  name="name" style="border-radius:5px" required placeholder="nom de l'administrateur" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Adresse email') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input type="email" autocomplete="off" class="form-control" name="email" style="border-radius:5px" required placeholder="email de l'administrateur" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Numéro de téléphone') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input type="number" class="form-control"  name="telephone" style="border-radius:5px" required placeholder="numéro de téléphone de l'administrateur" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class=" mb-1" for="inputPassword">{{ _('Créer le mot de passe')}}</label>
                            <div class="input-group" id="show_hide_password">
                                <input class="form-control py-4"  id="inputPassword" autocomplete="off" style="font-size:14px"  type="password" name="password" required  placeholder="Enter password" />
                                <div class="input-group-addon">
                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Photo de profile') }}</p>
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
                        <div class="alert-danger"  id="errorformcreate"></div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- end popup -->

    <!-- Modale pour mettre a jour les informations des administrateurs -->
    <div id="UpdateAdminModal" class="modal fade" role="dialog">
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

     <!-- modale pour changer le status des administrateurs -->
     <div id="AdminStatus" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="width: 50px; height:50px; border-radius:5px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px; font-size:18px; font-weight:bold">{{ __('Modifier le status de') }} <span id="currentnameadmin"></span></h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="changestatusform" lpformnum="1"  method="post" enctype="multipart/form-data" action="{{ route ('status-admin')}}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="currentadmin" id="currentadminid" />
                        <input type="hidden" name="statusvalue" id="statusvalueid" />
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p id="textstatusconfirm" style="color: #da5f5f;font-size: 16px;"></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" data-dismiss="modal" aria-label="Close" aria-hidden="true" class="btn btn-bg-secondary">{{ __('Annuler') }}</button>
                        <button type="submit" id="buttonstatus" class="btn btn-primary newBtn">{{ __('Confirmer') }}</button>
                        <div class="alert-danger"  id="errorformchangerstatus"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end popup -->

</div>

@endsection

