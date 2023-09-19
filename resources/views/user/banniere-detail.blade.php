@extends('user/template')

@section('content')
  <section class="heading-page header-text" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
            <h2>{{$banniere->labelDesc}}</h2>
            <h6>{{$banniere->title}}</h6>
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
                  <div class="date">
                    <h6>{{$banniere->created_at->isoFormat('dddd')}} <span>{{$banniere->created_at->isoFormat('D')}}</span></h6>
                  </div>
                  <a href="#"><img src="/storage/{{$banniere->photo}}" alt=""></a>
                </div>
                <div class="down-content">
                  <a href="#"><h4>{{$banniere->title}}</h4></a>
                  <p class="description"><br>
                    {!! html_entity_decode($banniere->description) !!}
                  </p>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="share">
                        <h5>Partager sur :</h5>
                        <ul>
                          <li><a href="#">Facebook</a>,</li>
                          <li><a href="#">Twitter</a>,</li>
                          <li><a href="#">Linkedin</a></li>
                        </ul>
                        <ul class="datadetail">
                            <li> <h6>{{$banniere->created_at->diffForHumans()}}</h6></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="main-button-red">
                <a href="/"> <i class="fa fa-arrow-left"></i> revenir à la page d'accueil </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
