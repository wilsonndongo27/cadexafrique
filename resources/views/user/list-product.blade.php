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
                @if ($allproduct ?? "")
                    @foreach ($allproduct as $product)
                        <div class="col-lg-4 templatemo-item-col all" productid="{{$product->id}}" onclick="DetailProduct(this)">
                            <div class="meeting-item">
                                <div class="thumb">
                                <a href="#"><img src="{{ asset ('/storage/'.$product->photo)}}" alt=""></a>
                                </div>
                                <div class="down-content">
                                <a href="#"><h4>{{$product->title}}</h4></a>
                                <p>{!! Str::limit(strip_tags($product->description), 50,'...') !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                @endif
              </div>
            </div>
            @if ($allproduct->isEmpty())
                <div class="blockempty col-lg-12"><h4>Aucune produits disponible!</h4></div>
            @else
            @endif
            <div class="paginationblock col-lg-12">
                {{ $allproduct->links() }}
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

