@extends('user/template')

@section('content')
  <section class="heading-page header-text" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
            <h2>{{$currentmenu->name}}</h2> 
        </div>
      </div>
    </div>
  </section>

  <section class="meetings-page" id="meetings">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-12">
              <div class="meeting-single-item"> 
                <div class="thumb">
                    @if ($contenu ?? '')
                        <div class="blockheadercontentmenu">
                            <div class="imagecontentmenu col-lg-6">
                                <a href="#"><img src="/storage/{{$contenu->image}}" alt=""></a>
                            </div>
                            <div class="headercontentmenu col-lg-6">
                                <a href="#"><h4>{{$contenu->title}}</h4></a>
                                <p class="libellecontentmenu">{{$contenu->libelle}}</p><br>
                                <div class="down-content menucontentdesc">
                                    <p class="description">
                                        {!! html_entity_decode($contenu->description) !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="blockemptydata card">
                            <h4>Ce menu ne contient aucune information!</h4>
                        </div>
                    @endif
                </div>

              </div>
            </div>
            <div class="col-lg-12">
              <div class="main-button-red">
                <a href="/"> <i class="fa fa-arrow-left"></i> Revenir à l'accueil </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
