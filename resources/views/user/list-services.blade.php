@extends('user/template')

@section('content')
  <section class="heading-page header-text" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2>{{$currentmenu->name}}</h2> 
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
              <div class="row grid">
                @if ($allservice ?? "")
                    @foreach ($allservice as $new)
                        <div class="col-lg-4 templatemo-item-col all" serviceid="{{$new->id}}" onclick="DetailService(this)">
                            <div class="meeting-item">
                                <div class="thumb">
                                <a href="#"><img src="{{ asset ('/storage/'.$new->cover)}}" alt=""></a>
                                </div>
                                <div class="down-content">
                                <a href="#"><h4>{{$new->title}}</h4></a>
                                <p>{!! Str::limit(strip_tags($new->description), 50,'...') !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                @endif
              </div>
            </div>
            @if ($allservice->isEmpty())
                <div class="blockempty col-lg-12"><h4>Aucun service disponible!</h4></div>
            @else
            @endif
            <div class="paginationblock col-lg-12">
                {{ $allservice->links() }}
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

