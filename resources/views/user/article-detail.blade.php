@extends('user/template')

@section('content')
  <section class="heading-page header-text" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
            <h2>{{$article->labelDesc}}</h2>
            <h6>{{$article->title}}</h6>
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
                    <h6>{{$article->created_at->isoFormat('dddd')}} <span>{{$article->created_at->isoFormat('D')}}</span></h6>
                  </div>
                  <a href="#"><img src="/storage/{{$article->photo}}" alt=""></a>
                </div>
                <div class="down-content">
                  <a href="#">
                    <h4>{{$article->title}}</h4><br><br>
                  </a>
                  <p class="description">
                      {!! html_entity_decode($article->description) !!}
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
                            <li> <h6>{{$article->created_at->diffForHumans()}}</h6></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="main-button-red" onclick="HomePage()">
                <a href="#"> <i class="fa fa-arrow-left"></i> Revenir à l'accueil </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
