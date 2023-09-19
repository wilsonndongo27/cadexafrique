@extends('analytics/template')

@section('contenu')
<div class="container-fluid">
    <h1 class="mt-4">Analytics</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Gestion de la Bannière du site</li>
    </ol>
    <table id="articles-table" class="table shadow-card">
        <thead style="margin-left:5px">
            <tr style="font-size: 14px;">
                <th title="">{{ __('Images') }}</th>
                <th title="">{{ __('Titres') }}</th>
                <th title="">{{ __('Description') }}</th>
                <th title="">{{ __('Types de liens') }}</th>
                <th title="">{{ __('Date de création') }}</th>
                <th title="" style="width:3px;"> > </th>
                <span class="counter"> Total Slide <span class="badgecount">{{ count($allslide)}}</span></span>
                <a href="#" id="AddSlideImage" data-toggle="tooltip" title="Ajouter une image">
                    <span class="plusadd"> <i class="fa fa-plus-circle" ></i></span>
                </a>
            </tr>
        </thead>
        <tbody style="font-size: 14px;">
        @if ($allslide ?? '')
            @foreach ($allslide as $item)
                <tr>
                    <td>
                        <img class="zoom" style="border-radius: 20px;" src="{{ asset('storage/'.$item->photo) }}" alt="{{$item->photo}}" alt="" />
                    </td>
                    <td style="color: #888;">{{ $item->title }}</td>
                    <td style="color: #888;">{!! Str::limit(html_entity_decode($item->description), 150) !!}</td>
                    <td style="color: #888;"> {{ $item->type }}</td>
                    <td style="color: #888;">{{ $item->created_at }}</td>
                    <td>
                        <div class="dropdown">
                            <button class="dropbtn"><p style="font-size: 13px; margin-top:-10px;">Options</p></button>
                            <div class="dropdown-content">
                              <a href="{{ route ('homeDetailBanniere', $item->id) }}" >Détails</a>
                              <a href="Javascript:void()" id="updateslide"
                                data-slideid="{{ $item->id }}"
                                data-title="{{ $item->title }}"
                                data-labeldesc="{{ $item->labelDesc }}"
                                data-description="{{ $item->description }}"
                                data-typeslide="{{ $item->type }}"
                                data-photo="{{ asset('storage/'.$item->photo) }}"
                              >Update</a>
                              <a href="JavaScript:void()" id="deletemodal"
                                data-idslide="{{ $item->id }}"
                              >Delete</a>
                            </div>
                          </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr >
                <td colspan="7" class="text-primary text-center" >
                    <p style="font-size: 14px; margin-top:50px; color:#888">Votre bannière est vide!</p>
                </td>
            </tr>
        @endif
        </tbody>
    </table>

    <!-- modale de creation d'une banniere -->
    <div id="AddSlideModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px;font-size:18px; font-weight:bold">{{ __('Ajouter une image') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="createform" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmission()" action="{{ route ('create-slide') }}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="creator" value="{{ auth()->user()->id }}"/>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Titre de l\'image') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="title" name="title" style="border-radius:5px" required placeholder="titre de l'image" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Label de la description') }}</p>
                                <div class="form-group label-floating" style="widthtextarea: 100%;">
                                    <input class="form-control"  name="labelDesc" style="border-radius:5px" required placeholder="Veuillez saisir le label de la description" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label style="color: #888">{{ __('Description')}}</label>
                            <div class="editor" style="height:40vh">
                            </div>
                            <input class="form-control post-content" name="description" type="hidden"/>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Selectionner le type de lien') }}</p>
                                <select name="type" class="form-group label-floating" style="width: 100%; height:40px">
                                    <option>No selected section</option>
                                        <option value="1">Type 1</option>
                                        <option value="2">Type 2</option>
                                        <option value="3">Type 3</option>
                                        <option value="4">Type 4</option>
                                </select>
                            </div>
                        </div>
                        <hr>

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

    <!-- Modale pour mettre a jour un slide -->
    <div id="UpdateSlide" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px;font-size:18px; font-weight:bold">{{ __('Mise à jour du Slide') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="updateform" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmissionUpdate()" action="{{ route ('update-slide')}}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="slide_id" id="slide_id"/>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Mise à jour du titre') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="titleslide" name="title" style="border-radius:5px"  placeholder="title of the message" />
                                    <hr>
                                </div>
                            </div>
                        </div>


                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Label de la description') }}</p>
                                <div class="form-group label-floating" style="widthtextarea: 100%;">
                                    <input class="form-control" id="labeldescslide"  name="labelDesc" style="border-radius:5px" required placeholder="modifier le label de la description" />
                                    <hr>
                                </div>
                            </div> 
                        </div>
                        
                        <div class="form-group">
                            <label style="color: #888">{{ __('Description')}}</label>
                            <div class="editorupdate" style="height:40vh">
                            </div>
                            <input class="form-control post-content-update" name="description" type="hidden"/>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Selectionner le type de lien') }}</p>
                                <select name="type" class="form-group label-floating" style="width: 100%; height:40px">
                                    <option id="typeslide">No selected section</option>
                                        <option value="1">Type 1</option>
                                        <option value="2">Type 2</option>
                                        <option value="3">Type 3</option>
                                        <option value="4">Type 4</option>
                                </select>
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

    <!-- modale pour supprimer un slide -->
    <div id="DeleteSlideImage" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px; font-size:18px; font-weight:bold">{{ __('Supprimer le slide') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="delete_form" lpformnum="1"  method="post"  enctype="multipart/form-data" action="{{ route ('delete-slide')}}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="currentslide" id="idslide" />
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>{{  __('Voulez vous vraiment suprimer ce slide ?') }}</p>
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

