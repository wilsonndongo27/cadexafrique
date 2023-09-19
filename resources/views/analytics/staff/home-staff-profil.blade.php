@extends('analytics/template')
@section('contenu')
<div class="container-fluid">
    <h1 class="mt-4">Analytics</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Gestion des profils</li>
    </ol>
    <table id="staff-profil-table" class="table shadow-card">
        <thead style="margin-left:5px">
            <tr style="font-size: 14px;">
                <th title="">{{ __('Intitulé du poste') }}</th>
                <th title="Auteur de de la création du profil">{{ __('Créer par :') }}</th>
                <th title="">{{ __('Date de création') }}</th>
                <th title="">{{ __('Status') }}</th>
                <th title="" style="width:3px;"> > </th>
                <span class="counter"> Total des profils <span class="badgecount">{{ count($allprofil)}}</span></span>
                <a href="#" id="AddProfil" data-toggle="tooltip" title="Ajouter un profil">
                    <span class="plusadd"> <i class="fa fa-plus-circle" ></i></span>
                </a>
            </tr>
        </thead>
        <tbody style="font-size: 14px;">
        @if ($allprofil ?? '')
            @foreach ($allprofil as $item)
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
                                @if($item->status == 0)
                                    <a href="JavaScript:void()" id="changestatusprofil"
                                        data-staffid="{{ $item->id }}"
                                        data-url="{{ route('change-profil-status')}}"
                                        data-csrf="{{ csrf_token() }}">
                                    <i class="fa fa-check-circle" style="margin-right: 3px;"></i><span id="textstatus"> Activer</span></a>
                                @else
                                    <a href="JavaScript:void()" id="changestatusstaff"
                                        data-staffid="{{ $item->id }}"
                                        data-url="{{ route('change-profil-status')}}"
                                        data-csrf="{{ csrf_token() }}">
                                    <i class="fa fa-ban" style="margin-right: 3px;"></i> <span id="textstatus">Deactiver</span></a>
                                @endif
                                <a href="#">
                                    <i class="fa fa-info" style="margin-right: 3px;"></i>
                                    Détail
                                </a>
                                <a href="Javascript:void()" id="updateProfil"
                                    data-name="{{ $item->name }}"
                                    data-profilid="{{ $item->id }}"
                                ><i class="fa fa-edit" style="margin-right: 3px;"></i> Modifier</a>
                                <a href="JavaScript:void()" id="deleteprofilmodal"
                                    data-profilid="{{ $item->id }}"
                                ><i class="fa fa-trash" style="margin-right: 3px;"></i> Supprimer</a>
                            </div>
                          </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr >
                <td colspan="7" class="text-primary text-center" >
                    <p style="font-size: 14px; margin-top:50px; color:#888">Aucun profil enregistrer!</p>
                </td>
            </tr>
        @endif
        </tbody>
    </table>

    <!-- modale de creation d'un staff -->
    <div id="AddprofilModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px;font-size:18px; font-weight:bold">{{ __('Ajouter un profil') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="createform" lpformnum="1"  method="post" enctype="multipart/form-data" action="{{ route ('create-profil-staff') }}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="creator" value="{{ auth()->user()->id }}"/>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Nom du profil') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" name="name" style="border-radius:5px" required placeholder="Nom" />
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

    <!-- Modale pour mettre les informations des staff -->
    <div id="UpdateProfilModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px;font-size:18px; font-weight:bold">{{ __('Mise à jour') }}
                    </h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="updateform" lpformnum="1"  method="post" enctype="multipart/form-data" action="{{ route ('update-profil-staff')}}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" id="profil_id" name="profil_id" />
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Nom du profil') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="profilnameid" name="name" style="border-radius:5px" required placeholder="Nom" />
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

    <!-- modale pour supprimer le profil -->
    <div id="DeleteProfil" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px; font-size:18px; font-weight:bold">{{ __('Supprimer ce profil') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="delete_form" lpformnum="1"  method="post" enctype="multipart/form-data" action="{{ route ('delete-profil-staff')}}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="currentprofil" id="idprofil" />
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>{{  __('Voulez vous vraiment suprimer ce profil ?') }}</p>
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

