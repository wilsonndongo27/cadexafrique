@extends('analytics/template')
@section('contenu')
<div class="container-fluid">
    <h1 class="mt-4">Analytics</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Gestion du personnel</li>
    </ol>
    <table id="articles-table" class="table shadow-card">
        <thead style="margin-left:5px">
            <tr style="font-size: 14px;">
                <th title="">{{ __('Photo') }}</th>
                <th title="">{{ __('Nom') }}</th>
                <th title="">{{ __('Prénom') }}</th>
                <th title="">{{ __('Poste') }}</th>
                <th title="Auteur de de la création du staff">{{ __('Créer par :') }}</th>
                <th title="">{{ __('Date de création') }}</th>
                <th title="">{{ __('Status') }}</th>
                <th title="" style="width:3px;"> > </th>
                <span class="counter"> Total du personnel <span class="badgecount">{{ count($allstaff)}}</span></span>
                <a href="#" id="AddStaff" data-toggle="tooltip" title="Ajouter un staff">
                    <span class="plusadd"> <i class="fa fa-plus-circle" ></i></span>
                </a>
            </tr>
        </thead>
        <tbody style="font-size: 14px;">
        @if ($allstaff ?? '')
            @foreach ($allstaff as $item)
                <tr>
                    <td>
                        <img class="zoom" style="border-radius: 20px;" src="{{ asset('storage/'.$item->photo) }}" alt="{{$item->photo}}" alt="" />
                    </td>
                    <td style="color: #888;">{{ Str::limit($item->first_name, 30)  }}</td>
                    <td style="color: #888;">{{ Str::limit($item->last_name, 30)  }}</td>
                    <td style="color: #888;">{{$item->poste}}</td>
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
                                    <a href="JavaScript:void()" id="changestatusstaff"
                                        data-staffid="{{ $item->id }}"
                                        data-url="{{ route('change-staff-status')}}"
                                        data-csrf="{{ csrf_token() }}">
                                    <i class="fa fa-check-circle" style="margin-right: 3px;"></i><span id="textstatus"> Activer</span></a>
                                @else
                                    <a href="JavaScript:void()" id="changestatusstaff"
                                        data-staffid="{{ $item->id }}"
                                        data-url="{{ route('change-staff-status')}}"
                                        data-csrf="{{ csrf_token() }}">
                                    <i class="fa fa-ban" style="margin-right: 3px;"></i> <span id="textstatus">Deactiver</span></a>
                                @endif
                                <a href="#">
                                    <i class="fa fa-info" style="margin-right: 3px;"></i>
                                    Détail
                                </a>
                                <a href="Javascript:void()" id="updateStaff"
                                    data-first_name="{{ $item->first_name }}"
                                    data-last_name="{{ $item->last_name }}"
                                    data-telephone="{{ $item->telephone }}"
                                    data-adresse="{{ $item->adresse }}"
                                    data-poste="{{ $item->poste }}"
                                    data-posteid="{{ $item->posteid }}"
                                    data-email="{{ $item->email }}"
                                    data-photo="{{ $item->photo }}"
                                    data-freetext1="{{ $item->freetext1 }}"
                                    data-staffid="{{ $item->id }}"
                                ><i class="fa fa-edit" style="margin-right: 3px;"></i> Modifier</a>
                                <a href="JavaScript:void()" id="deletestaffmodal"
                                    data-staffid="{{ $item->id }}"
                                ><i class="fa fa-trash" style="margin-right: 3px;"></i> Supprimer</a>
                            </div>
                          </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr >
                <td colspan="7" class="text-primary text-center" >
                    <p style="font-size: 14px; margin-top:50px; color:#888">Aucun staff enregistrer!</p>
                </td>
            </tr>
        @endif
        </tbody>
    </table>

    <!-- modale de creation d'un staff -->
    <div id="AddStaffModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px;font-size:18px; font-weight:bold">{{ __('Ajouter un membre du personnel') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="createform" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmission()" action="{{ route ('create-staff') }}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="creator" value="{{ auth()->user()->id }}"/>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Nom du staff') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" name="first_name" style="border-radius:5px" required placeholder="Nom" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Prénom du staff') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" name="last_name" style="border-radius:5px" required placeholder="Prénom" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Numéro de téléphone') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" name="telephone" style="border-radius:5px" required placeholder="Téléphone" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Adresse') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" name="adresse" style="border-radius:5px" required placeholder="Adresse" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Adresse Email') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input type="email" class="form-control" name="email" style="border-radius:5px" required placeholder="Email" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Autres informations') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <div class="editor" style="height:40vh">
                                    </div>
                                    <input class="form-control post-content" name="freetext1" type="hidden"/>
                                    <hr>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Choisir le poste') }}</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <select name="poste" id="" class="form-control">
                                        <option selected>Selectionner un profil</option>
                                        @foreach ($allprofil as $profil)
                                            <option value="{{$profil->id}}">{{$profil->name}}</option>
                                        @endforeach
                                    </select>
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Photo du staff') }}</p>
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

    <!-- Modale pour mettre les informations des staff -->
    <div id="UpdateStaffModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px;font-size:18px; font-weight:bold">{{ __('Mise à jour de ') }}
                        <span id="namestaff"></span>
                    </h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="updateform" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmissionUpdate()" action="{{ route ('update-staff')}}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" id="staff_id" name="staff_id" />
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Nom du staff') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="firstnameid" name="first_name" style="border-radius:5px" required placeholder="Nom" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Prénom du staff') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="lastnameid" name="last_name" style="border-radius:5px" required placeholder="Prénom" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Numéro de téléphone') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="telephoneid" name="telephone" style="border-radius:5px" required placeholder="Téléphone" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Adresse') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="adresseid" name="adresse" style="border-radius:5px" required placeholder="Adresse" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Adresse Email') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input type="email" class="form-control" id="emailid" name="email" style="border-radius:5px" required placeholder="Email" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Autres informations') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <div class="editorupdate" style="height:40vh">
                                    </div>
                                    <input class="form-control post-content-update" name="freetext1" type="hidden"/>
                                    <hr>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Choisir le poste') }}</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <select name="poste" id="postid" class="form-control">
                                        @foreach ($allprofil as $profil)
                                            <option value="{{$profil->id}}">{{$profil->name}}</option>
                                        @endforeach
                                    </select>
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Mise à jour de la photo') }}</p>
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
    <div id="DeleteStaff" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px; font-size:18px; font-weight:bold">{{ __('Supprimer ce Staff') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="delete_form" lpformnum="1"  method="post" enctype="multipart/form-data" action="{{ route ('delete-staff')}}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="currentstaff" id="idstaff" />
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>{{  __('Voulez vous vraiment suprimer ce staff ?') }}</p>
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

