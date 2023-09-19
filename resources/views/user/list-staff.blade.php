@extends('user/template')

@section('content')
  <section class="heading-page header-text" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2>Notre équipes</h2>
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
              <div class="row grid staffgrid">
                @if ($allstaff ?? "")
                    @foreach ($allstaff as $staff)
                        <div class="col-lg-4 templatemo-item-col" staffid="{{$staff->id}}" onclick="staffDetail(this)">
                            <div class="meeting-item">
                                <div class="thumb">
                                <a href="#"><img src="{{ asset ('/storage/'.$staff->photo)}}" alt=""></a>
                                </div>
                                <div class="down-content">
                                <a href="#">
                                  <h4>{{$staff->last_name}} {{$staff->first_name}}</h4>
                                </a>
                                    <p class="poststaff">{{$staff->poste}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                @endif
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
    </div>
  </section>
@endsection

