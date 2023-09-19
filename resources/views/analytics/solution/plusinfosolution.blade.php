@extends('analytics/template')
@section('contenu')
<!-- Include Quill stylesheet -->
<link href="./admindashboard/css/quill.snow.css" rel="stylesheet"/>

<div class="container-fluid">
    <h1 class="mt-4">Analytics</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Gestion des détails sur  <span class="solutiondetailtitle"> {{$solution->name}}</span></li>
    </ol>
    <table id="articles-table" class="table shadow-card">
        <thead style="margin-left:5px">
            <tr style="font-size: 14px;">
                <th title="Image du service">{{ __('Image') }}</th>
                <th title="Intitulé du service">{{ __('Title') }}</th>
                <th title="Description du service">{{ __('Contenu') }}</th>
                <th title="Le créateur du service">{{ __('Auteurs') }}</th>
                <th title="Date de création du service">{{ __('Date de création') }}</th>
                <th title="" style="width:3px;"> > </th>
                <span class="counter"> Total des détails <span class="badgecount">{{ count($finaldatadetail)}}</span></span>
                <a href="#" id="AddDetailSolution" data-toggle="tooltip" title="Ajouter un détail">
                    <span class="plusadd detailadd"> <i class="fa fa-plus-circle" ></i>Ajouter un détail</span>
                </a>
            </tr>
        </thead>
        <tbody style="font-size: 14px;">
        @if ($finaldatadetail ?? '')
            @foreach ($finaldatadetail as $item)
                <tr>
                    <td>
                        <img class="zoom" style="border-radius: 20px;" src="{{ asset('storage/'.$item->cover) }}" alt="{{$item->cover}}" alt="" />
                    </td>
                    <td style="color: #888;">{{ Str::limit($item->title, 20) }}</td>
                    <td style="color: #888;">{!! Str::limit(html_entity_decode($item->description), 150) !!}</td>
                    <td style="color: #888;">{{ $item->creator }}</td>
                    <td style="color: #888;">{{ $item->created_at }}</td>
                    <td>
                        <div class="dropdown">
                            <button class="dropbtn"><p style="font-size: 13px; margin-top:-10px;">Options</p></button>
                            <div class="dropdown-content">
                              <a href="Javascript:void()" id="updatedetailsolution"
                                data-detailid="{{ $item->id }}"
                                data-title="{{ $item->title }}"
                                data-description="{{ $item->description }}"
                                data-photo="{{ asset('storage/'.$item->cover) }}"
                              ><i class="fa fa-edit" style="margin-right: 3px;"></i>Modifier</a>
                              <a href="JavaScript:void()" id="deletedetailsolution"
                                data-iddetail="{{ $item->id }}"
                              ><i class="fa fa-trash" style="margin-right: 3px;"></i>Supprimer</a>
                            </div>
                          </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr >
                <td colspan="7" class="text-primary text-center" >
                    <p style="font-size: 14px; margin-top:50px; color:#888">Pas de détail enregistrer pour ce produit!</p>
                </td>
            </tr>
        @endif
        </tbody>
    </table>

    <!-- modale de creation du détail -->
    <div id="AddSDetailSolutionModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                      <h4 class="modal-title" style="margin-left: 11px;font-size:18px; font-weight:bold">{{ __('Ajouter un détail pour ce produit') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="createform" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmission()" action="{{ route ('create-detail-solution')}}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="creator" value="{{ auth()->user()->id }}"/>
                        <input type="hidden" name="solution_detail_id" value="{{ $solution->id }}"/>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Titre') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="title" name="title" style="border-radius:5px" required placeholder="Intitulé du détail" />
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
                                <p style="color: #888">{{ __('Choisissez une image de présentation du détail') }}</p>
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

    <!-- Modale pour mettre a jour du detail -->
    <div id="UpdateDetailSolutionModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px;font-size:18px; font-weight:bold">{{ __('Mise à jour du détail') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="updateform" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmissionUpdate()" action="{{ route ('update-detail-solution')}}" >
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="detail_solution_id" id="detail_id"/>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Mise à jour du titre') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="titledetailsolution" name="title" style="border-radius:5px"  placeholder="title of the message" />
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
    <div id="DeleteDetailSolutionModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px; font-size:18px; font-weight:bold">{{ __('Supprimer le détail') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="delete_form" lpformnum="1"  method="post" enctype="multipart/form-data" action="{{ route ('delete-detail-solution')}}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="currentsolutiondetail" id="iddetail" />
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>{{  __('Voulez vous vraiment suprimer ce détail ?') }}</p>
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

