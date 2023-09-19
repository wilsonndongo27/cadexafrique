@extends('user/template')

@section('content')
  <section class="heading-page header-text" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
            <h2>BIBLIOGRAPHIE</h2>
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
              <div class="meeting-single-item row">
                <div class="thumb col-lg-4">
                  <a href="#"><img src="/storage/{{$staff->photo}}" alt=""></a>
                  <h4 class="namestaff">{{$staff->last_name}} {{$staff->first_name}}</h4>
                  <p class="poststaff">{{$poste->name}}</p>
                </div>
                <div class="down-content col-lg-8">
                    <p class="description">
                      {!! html_entity_decode($staff->freetext1) !!}
                    </p>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="main-button-red" onclick="Allstaff()">
                <a href="#"> <i class="fa fa-arrow-left"></i> Notre équipes </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
