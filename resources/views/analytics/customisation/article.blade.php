@extends('analytics/template')
@section('contenu')

<div class="container-fluid">
    <h1 class="mt-4">Analytics</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Gestion des articles</li>
    </ol>
    <table id="articles-table" class="table shadow-card">
        <thead style="margin-left:5px">
            <tr style="font-size: 14px;">
                <th title="">{{ __('Images') }}</th>
                <th title="Titre de l'article">{{ __('Titres') }}</th>
                <th title="Description de l'article">{{ __('Description') }}</th>
                <th title="Auteur de de la création de l'article">{{ __('Créer par :') }}</th>
                <th title="Date ou l'article a été créé">{{ __('Dates de publication') }}</th>
                <th title="Visible ou pas">{{ __('Status') }}</th>
                <th title="" style="width:3px;"> > </th>
                <span class="counter"> Total Articles <span class="badgecount">{{ count($allarticle) }}</span></span>
                <a href="#" id="AddArticle" data-toggle="tooltip" title="Ajouter un article">
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
        @if ($allarticle ?? '')
            @foreach ($allarticle as $item)
                <tr>
                    <td>
                        <img class="zoom" style="border-radius: 20px;" src="{{ asset('storage/'.$item->photo) }}" alt="{{$item->photo}}" alt="" />
                    </td>
                    <td style="color: #888;">{{ $item->title }}</td>
                    <td style="color: #888;">{!! Str::limit($item->description, 150) !!}</td>
                    <td style="color: #888;">{{ $item->creator ?? '' }}</td>
                    <td style="color: #888;">{{ $item->created_at }}</td>
                    @if($item->status == 1)
                        <td style="color: #092e67;" class="blockbutton">
                            <a href="JavaScript:void()" id="changestatusarticle"
                                data-statusvalue="{{ $item->status }}"
                                data-currentarticle="{{ $item->id }}"
                                data-url="{{ route('status-article')}}"
                                data-csrf="{{ csrf_token() }}">
                                <label class="switch">
                                    <input type="checkbox" checked >
                                    <span class="slider round"></span>
                                </label>
                            </a>
                        </td>
                        @else
                        <td style="color:#092e67;" class="blockbutton">
                            <a href="JavaScript:void()" id="changestatusarticle"
                                data-valuestatus="{{ $item->status }}"
                                data-currentarticle="{{ $item->id }}"
                                data-url="{{ route('status-article')}}"
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
                              <a href="Javascript:void()" id="updatearticle"
                                data-articleid="{{ $item->id }}"
                                data-title="{{ $item->title }}"
                                data-label="{{ $item->labelDesc }}"
                                data-description="{{ $item->description }}"
                                data-photo="{{ asset('storage/'.$item->photo) }}"
                              >Update</a>
                              <a href="JavaScript:void()" id="deletearticlemodal"
                                data-idarticle="{{ $item->id }}"
                              >Delete</a>
                            </div>
                          </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr >
                <td colspan="7" class="text-primary text-center" >
                    <p style="font-size: 14px; margin-top:50px; color:#888">Aucun article n'a été enregistré!</p>
                </td>
            </tr>
        @endif
        </tbody>
    </table>

    <!-- modale de creation des articles -->
    <div id="AddArticleModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px;font-size:18px; font-weight:bold">{{ __('Rédiger un article') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="createform" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmission()" action="{{ route ('create-article') }}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="creator" value="{{ Auth::user()->id }}"/>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Titre de l\'article') }}</p>
                                <div class="form-group label-floating" style="widthtextarea: 100%;">
                                    <input class="form-control"  name="title" style="border-radius:5px" required placeholder="titre de l'article" />
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
                        <hr>

                        <div class="form-group" style="margin-bottom:-35px">
                            <label style="color: #888" for="exampleFormControlTextarea1">{{ __('Service correspondant')}}</label>
                            <div class="serviceblock">
                                @if ($allservice ?? '')
                                    @foreach($allservice as $item)
                                        <div class="row serviceitem">
                                            <input  name="{{$item->title}}" onclick="selection(this.value, this.name)"  type="checkbox" value="{{ $item->id }}"/>
                                            <p>{{$item->title}}</p>
                                        </div>
                                    @endforeach
                                @else
                                @endif
                            </div>
                            <select name="services[]" style="visibility: hidden;width:0.1px;height:0.1px;" multiple="multiple">
                                @if ($allservice ?? '')
                                    @foreach($allservice as $item)
                                        <option id="option-service-{{$item->id}}" value="{{$item->id}}" >{{$item->title}}</option>
                                    @endforeach
                                @else
                                @endif
                            </select>
                        </div>
                        <br/><br/>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Choisir la catégorie de l\'article') }}</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <select name="categorie" id="" class="form-control">
                                        @if ($allcategorie ?? '')
                                            @foreach($allcategorie as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        @else
                                        @endif
                                    </select>
                                    <hr>
                                </div>
                            </div>
                        </div>

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

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Entrer l\'image de l\'article') }}</p>
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

    <!-- Modale pour mettre a jour des articles -->
    <div id="UpdateArticleModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px;font-size:18px; font-weight:bold">{{ __('Mise à jour de l\'article') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="updateform" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmissionUpdate()" action="{{ route ('update-article')}}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="article_id" id="article_id"/>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Mise à jour du titre de l\'article') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="titlearticle" name="title" style="border-radius:5px"  placeholder="titre de l'article" />
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Label de la description') }}</p>
                                <div class="form-group label-floating" style="widthtextarea: 100%;">
                                    <input class="form-control" id="labelDescArticle"  name="labelDesc" style="border-radius:5px" required placeholder="label de la description" />
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
                        <hr>

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
                            <div class="col-lg-12 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Mise à jour de l\'image de l\'article') }}</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <img id="phototoupdatearticle" class="showimagetoupdate" />
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

    <!-- modale pour supprimer les articles -->
    <div id="DeleteArticle" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="height:50px; border-radius:5px; margin-left:10px" src="{{asset('images/logo-cadex.jpg')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px; font-size:18px; font-weight:bold">{{ __('Supprimer l\'article choisi') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="delete_form" lpformnum="1"  method="post" enctype="multipart/form-data" action="{{ route ('delete-article')}}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="currentarticle" id="idarticle" />
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>{{  __('Voulez vous vraiment suprimer cette article ?') }}</p>
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

