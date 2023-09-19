@extends('user/template')

@section('content')
  <section class="heading-page header-text" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2>{{$categorie->name}}</h2>
          <h6></h6>
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
              <div class="filters">
                <ul>
                  <li data-filter="*"  class="active">Nouveaux</li>
                  <li data-filter=".soon">Futures</li>
                  <li data-filter=".imp">Importants</li>
                  <li data-filter=".att">Attractifs</li>
                </ul>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="row grid">
                @if ($allarticlenew ?? "")
                    @foreach ($allarticlenew as $new)
                        <div class="col-lg-4 templatemo-item-col all" articleid="{{$new->id}}" onclick="DetailArticle(this)">
                            <div class="meeting-item">
                                <div class="thumb">
                                <a href="#"><img src="{{ asset ('/storage/'.$new->photo)}}" alt=""></a>
                                </div>
                                <div class="down-content">
                                <a href="#"><h4>{{$new->title}}</h4></a>
                                <p>{!! Str::limit($new->description, 50,'...') !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="blockempty"><h4>Aucune actualité disponible dans cette catégorie.</h4></div>
                @endif
                @if ($allarticlesoon ?? "")
                    @foreach ($allarticlesoon as $soon)
                        <div class="col-lg-4 templatemo-item-col all soon" articleid="{{$soon->id}}" onclick="DetailArticle(this)">
                            <div class="meeting-item">
                                <div class="thumb">
                                <a href="#"><img src="{{ asset ('/storage/'.$soon->photo)}}" alt=""></a>
                                </div>
                                <div class="down-content">
                                <a href="#"><h4>{{$soon->title}}</h4></a>
                                <p>{!! Str::limit($soon->description, 50,'...') !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                @endif
                @if ($allarticleimportant ?? "")
                    @foreach ($allarticleimportant as $important)
                        <div class="col-lg-4 templatemo-item-col all imp" articleid="{{$important->id}}" onclick="DetailArticle(this)">
                            <div class="meeting-item">
                                <div class="thumb">
                                <a href="#"><img src="{{ asset ('/storage/'.$important->photo)}}" alt=""></a>
                                </div>
                                <div class="down-content">
                                <a href="#"><h4>{{$important->title}}</h4></a>
                                <p>{{$important->description}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                @endif
                @if ($allarticleattractif ?? "")
                    @foreach ($allarticleattractif as $attractif)
                        <div class="col-lg-4 templatemo-item-col all att" articleid="{{$attractif->id}}" onclick="DetailArticle(this)">
                            <div class="meeting-item">
                                <div class="thumb">
                                <a href="#"><img src="{{ asset ('/storage/'.$attractif->photo)}}" alt=""></a>
                                </div>
                                <div class="down-content">
                                <a href="#"><h4>{{$attractif->title}}</h4></a>
                                <p>{{$attractif->description}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                @endif
              </div>
            </div>
            @if ($allarticlenew->isEmpty())
                <div class="blockempty col-lg-12"><h4>Aucune actualité disponible dans cette catégorie.</h4></div>
            @else
            @endif
            <div class="paginationblock col-lg-12">
                {{ $allarticlenew->links() }}
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
    </div>
  </section>
@endsection

