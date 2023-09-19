@extends('user/template')
 
@section('banner')
 <!-- ***** Main Banner Area Start ***** -->
 <div class="swiper-container">
    <div class="swiper-wrapper">

        @if ($allbanniere ?? "")
            @foreach ($allbanniere as $banniere)
                <div class="swiper-slide">
                    <div class="slide-inner" style="background-image:url({{ asset ('/storage/'.$banniere->photo)}})" onclick="DetailBanniere(this)" banniereid="{{$banniere->id}}">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="header-text titlebanner">
                                      <h2>{{ Str::limit($banniere->title, 100 , '...') }}</h2>
                                      <div class="div-dec"></div>
                                      {{-- <p>{!! Str::limit(html_entity_decode($banniere->description), 200, '...') !!}</p>  --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="swiper-button-next swiper-button-white"></div>
    <div class="swiper-button-prev swiper-button-white"></div>
  </div>
  <!-- ***** Main Banner Area End ***** -->
@endsection
@section('content')
  <section class="our-facts card" id="aboutabout">
    <div class="container">
      <div>
        <div class="col-lg-12 blocktitleabout">
          <h2>A Propos de Nous</h2>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-6">
            <div class="count-area-content new-students">
              <div class="count-title">Qui sommes nous ?</div>
              <p>{{$entreprise->vision}}</p>
            </div>
          </div>
          <div class="col-lg-6" id="missionup">
            <div class="count-area-content blockobjectif">
              <div class="count-title">Nos Missions</div>
              <p>
                <span class="hideobjectif">
                  @foreach(explode(';', Str::limit($entreprise->objectifs, 250, '...')) as $objectif)
                    - {{$objectif}} <br><br>
                  @endforeach
                </span>
                <span class="showobjectif">
                  @foreach(explode(';', $entreprise->objectifs) as $objectif)
                    - {{$objectif}} <br><br>
                  @endforeach
                </span>
                <a href="#missionup" class="plusobjectif buttonshow" onclick="toggleObjectifAll()">Voir plus <i class="fa fa-plus-circle"></i></a>
                <a href="#missionup" class="plusobjectif buttonhide" onclick="toggleObjectifHide()">Réduire <i class="fa fa-minus-circle"></i></a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <section class="apply-now" id="apply" style="background-image: url('{{asset('images/apply-bg.jpg')}}')">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center">
          <div class="row">
            <div class="col-lg-12">
              <div class="item">
                <h3>Nos Services et Produits  </h3>
                <p>Nous vous offrons des services professionnels pour mettre en avant votre rentabilité sur le marché internationnal</p>
                <div class="main-button-red">
                  <div><a href="#" onclick="AllService()"><i class="fa fa-arrow-right"></i> Voir plus</a></div>
              </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="accordions is-first-expanded">
            @if ($allservice ?? "")
                @foreach ($allservice as $service)
                    <article class="accordion last-accordion">
                        <div class="accordion-head">
                            <span><a href="javascript:void()" onclick="DetailService(this)" serviceid="{{$service->id}}">{{$service->title}}</a></span>
                            <span class="icon">
                                <i class="icon fa fa-chevron-right"></i>
                            </span>
                        </div>
                        <div class="accordion-body">
                            <div class="content">
                                <p>{!! strip_tags($service->description) !!}</p>
                            </div>
                        </div>
                    </article>
                @endforeach
            @else
            @endif
        </div>
        </div>
      </div>
    </div>
  </section>

  <section class="our-courses" id="courses">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h2>La Revue du CADEX</h2>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="owl-courses-item owl-carousel"> 
            @if ($allarticle ?? "")
                @foreach ($allarticle as $article)
                    <div class="item itemproduct card" onclick="DetailArticle(this)" articleid="{{$article->id}}">
                        <img src="{{asset('/storage/'.$article->photo)}}" alt="">
                        <div class="down-content">
                            <div class="down-content">
                              <a href="#"><h4>{{Str::limit($article->title, 20,'...')}}</h4></a>
                          </div>
                          <div class="datenews">
                              <h6>Publier, {{$article->created_at->diffForHumans()}}</h6>
                          </div>
                        </div>
                    </div>
                @endforeach
            @else
            @endif
          </div>
          <div class="main-button-red allactu">
            <div onclick="AllActuality()"><a href="#"><i class="fa fa-arrow-right"></i> Voir plus </a></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
@endsection
