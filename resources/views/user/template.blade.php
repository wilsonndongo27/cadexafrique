<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="CADEX (Centre de Recherches et de Promotion du Commerce Extérieur en Afrique)">
    <meta name="description" content="Le Centre de Recherches et de Promotion du Commerce 
                                Extérieur en Afrique (CADEX) est un « think thank » indépendant reconnu sous le N°W783012206, 
                                dont les activités sont essentiellement tournées vers les travaux en matière douanières et des 
                                changes ainsi que d’autres réglementations 
                                du commerce extérieur dans les Etats et regroupements d’Etats africains.">
    <meta name="keywords" content="CADEX, Cadex, cadex, Centre, Commerce, Afrique, Finance, échenge, Commerce Extérieur">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('images/logo-cadex.jpg')}}" style="border-radius: 100%;">
    <title id="titlepage">cadex</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('user/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset ('admindashboard/css/quill.snow.css')}}" />


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{asset('user/assets/css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('user/assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('user/assets/css/swiper.min.css')}}">
    <link rel="stylesheet" href="{{asset('user/assets/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('user/assets/css/flex-slider.css')}}">
    <link rel="stylesheet" href="{{asset('user/assets/css/owl.css')}}">
    <link rel="stylesheet" href="{{asset('user/assets/css/lightbox.css')}}">
    <link rel="stylesheet" href="{{asset('user/assets/css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('user/assets/css/main.css')}}">
<!--

TemplateMo 569 Edu Meeting

https://templatemo.com/tm-569-edu-meeting

-->
  </head>

<body>
  <!-- Sub Header -->
  <div class="sub-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-sm-8">
          <div class="left-content">
            <p> <u></u> </p>
          </div>
        </div>
        <div class="col-lg-4 col-sm-4">
          <div class="right-icons">
            <ul>
              <li id="google_translate_element"><a href="#"><i class="fa fa-traductor"></i></a></li>
              <li><a href="mailto:{{$entreprise->email1}}"> Contactez-nous <i class="fa fa-envelope"></i></a></li>
              <li><a  href="https://cm.linkedin.com/company/centre-de-recherches-et-de-promotion-du-commerce-ext%C3%A9rieur-en-afrique-cadex?trk=public_profile_experience-item_profile-section-card_subtitle-click" target="_blank">| <span class="headertextint">Nous suivre</span> <i class="fa fa-linkedin"></i></a></li>
              <li><a onclick="redirectWhatsapp()"><i class="fa fa-whatsapp"></i></a></li>
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class=""></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <nav class="main-nav">
                      <!-- ***** Logo Start ***** -->
                      <a href="/" class="logo">
                        <img class="logohome" src="{{asset('/storage/'.$entreprise->logo)}}" alt="">
                      </a>
                      <!-- ***** Logo End ***** -->
                      <!-- ***** Menu Start ***** -->
                      <ul class="nav">
                                @if ($menus ?? "")
                                    @foreach ($menus as $menu)
                                        @if ($menu->position == "1")
                                            <li class="has-sub homeitem" >
                                                <a href="javascript:void(0)" onclick="HomePage()" >{{$menu->name}}</a>
                                                <ul class="sub-menu">
                                                    @if ($menu->sub ?? '')
                                                        @foreach ($menu->sub as $sub)
                                                            @if ($sub->parent_id == $menu->id)
                                                                <li class="has-sub-sub">
                                                                    @if ($sub->subsub ?? '')
                                                                        <a class="subsubmenubtn" href="#"> {{$sub->name}}</a>
                                                                    @else
                                                                        @if ($sub->rubrique == "1")                                                                            
                                                                            <a href="#" onclick="AllActuality(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                        @elseif ($sub->rubrique == "2")            
                                                                            <a href="#" onclick="AllService(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                        @elseif ($sub->rubrique == "3")            
                                                                            <a href="#" onclick="AllProduct(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                        @elseif ($sub->rubrique == "4")            
                                                                            <a href="#" onclick="Allstaff()"><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                        @else
                                                                            <a href="#" menuid="{{$sub->id}}" onclick="ContentSousMenu(this)"><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                        @endif                                                                
                                                                    @endif
                                                                    <ul class="submenu" >
                                                                        @foreach ($sub->subsub as $subsub)
                                                                            @if ($subsub->sub_parent_id == $sub->id)
                                                                                @if ($subsub->rubrique == "1")                                                                            
                                                                                    <a href="#" onclick="AllActuality(this)" menuid='{{$subsub->id}}'><i class="fa fa-sign-in"></i> {{$subsub->name}}</a>
                                                                                @elseif ($subsub->rubrique == "2")            
                                                                                    <a href="#" onclick="AllService(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$subsub->name}}</a>
                                                                                @elseif ($subsub->rubrique == "3")            
                                                                                    <a href="#" onclick="AllProduct(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$subsub->name}}</a>
                                                                                @elseif ($subsub->rubrique == "4")            
                                                                                    <a href="#" onclick="Allstaff()"><i class="fa fa-sign-in"></i> {{$subsub->name}}</a>
                                                                                @else
                                                                                    <li><a class="dropdown-item" href="#" menuid="{{$subsub->id}}" onclick="ContentSousSousMenu(this)"><i class="fa fa-user"></i> {{$subsub->name}}</a></li>
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                    </ul>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach
                                @endif
                                @if ($menus ?? "")
                                    @foreach ($menus as $menu)
                                        @if ($menu->position == "2")
                                            <li class="has-sub" >
                                                <a href="javascript:void(0)">{{$menu->name}}</a>
                                                <ul class="sub-menu">
                                                    @if ($menu->sub ?? '')
                                                        @foreach ($menu->sub as $sub)
                                                            @if ($sub->parent_id == $menu->id)
                                                                <li class="has-sub-sub">
                                                                    @if ($sub->subsub ?? '')
                                                                        <a class="subsubmenubtn" href="#"> {{$sub->name}}</a>
                                                                    @else
                                                                        @if ($sub->rubrique == "1")                                                                            
                                                                            <a href="#" onclick="AllActuality(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                        @elseif ($sub->rubrique == "2")            
                                                                            <a href="#" onclick="AllService(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                        @elseif ($sub->rubrique == "3")            
                                                                            <a href="#" onclick="AllProduct(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                        @elseif ($sub->rubrique == "4")            
                                                                            <a href="#" onclick="Allstaff()"><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                        @else
                                                                            <a href="#" menuid="{{$sub->id}}" onclick="ContentSousMenu(this)"><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                        @endif                                                                
                                                                    @endif
                                                                    <ul class="submenu" >
                                                                        @foreach ($sub->subsub as $subsub)
                                                                            @if ($subsub->sub_parent_id == $sub->id)
                                                                                @if ($subsub->rubrique == "1")                                                                            
                                                                                    <a href="#" onclick="AllActuality(this)" menuid='{{$subsub->id}}'><i class="fa fa-sign-in"></i> {{$subsub->name}}</a>
                                                                                @elseif ($subsub->rubrique == "2")            
                                                                                    <a href="#" onclick="AllService(this)" menuid='{{$subsub->id}}'><i class="fa fa-sign-in"></i> {{$subsub->name}}</a>
                                                                                @elseif ($subsub->rubrique == "3")            
                                                                                    <a href="#" onclick="AllProduct(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$subsub->name}}</a>
                                                                                @elseif ($subsub->rubrique == "4")            
                                                                                    <a href="#" onclick="Allstaff()"><i class="fa fa-sign-in"></i> {{$subsub->name}}</a>
                                                                                @else
                                                                                    <li><a class="dropdown-item" href="#" menuid="{{$subsub->id}}" onclick="ContentSousSousMenu(this)"><i class="fa fa-user"></i> {{$subsub->name}}</a></li>
                                                                                @endif   
                                                                            @endif
                                                                        @endforeach
                                                                    </ul>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach
                                @endif

                                @if ($menus ?? "")
                                    @foreach ($menus as $menu)
                                        @if ($menu->position == "3")
                                            <li class="has-sub" >
                                                <a href="javascript:void(0)">{{$menu->name}}</a>
                                                <ul class="sub-menu">
                                                    @if ($menu->sub ?? '')
                                                        @foreach ($menu->sub as $sub)
                                                            @if ($sub->parent_id == $menu->id)
                                                                <li class="has-sub-sub">
                                                                    @if ($sub->subsub ?? '')
                                                                        <a class="subsubmenubtn" href="#"> {{$sub->name}}</a>
                                                                    @else
                                                                        @if ($sub->rubrique == "1")                                                                            
                                                                            <a href="#" onclick="AllActuality(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                        @elseif ($sub->rubrique == "2")            
                                                                            <a href="#" onclick="AllService(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                        @elseif ($sub->rubrique == "3")            
                                                                            <a href="#" onclick="AllProduct(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                        @elseif ($sub->rubrique == "4")            
                                                                            <a href="#" onclick="Allstaff()"><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                        @else
                                                                            <a href="#" menuid="{{$sub->id}}" onclick="ContentSousMenu(this)"><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                        @endif                                                                 
                                                                    @endif
                                                                    <ul class="submenu" >
                                                                        @foreach ($sub->subsub as $subsub)
                                                                            @if ($subsub->sub_parent_id == $sub->id)
                                                                                @if ($subsub->rubrique == "1")                                                                            
                                                                                    <a href="#" onclick="AllActuality(this)" menuid='{{$subsub->id}}'><i class="fa fa-sign-in"></i> {{$subsub->name}}</a>
                                                                                @elseif ($subsub->rubrique == "2")            
                                                                                    <a href="#" onclick="AllService(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$subsub->name}}</a>
                                                                                @elseif ($subsub->rubrique == "3")            
                                                                                    <a href="#" onclick="AllProduct(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$subsub->name}}</a>
                                                                                @elseif ($subsub->rubrique == "4")            
                                                                                    <a href="#" onclick="Allstaff()"><i class="fa fa-sign-in"></i> {{$subsub->name}}</a>
                                                                                @else
                                                                                    <li><a class="dropdown-item" href="#" menuid="{{$subsub->id}}" onclick="ContentSousSousMenu(this)"><i class="fa fa-user"></i> {{$subsub->name}}</a></li>
                                                                                @endif                                                                             
                                                                            @endif
                                                                        @endforeach
                                                                    </ul>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach
                                @endif

                                @if ($menus ?? "")
                                    @foreach ($menus as $menu)
                                        @if ($menu->position == "4")
                                            <li class="has-sub" >
                                                <a href="javascript:void(0)" >{{$menu->name}}</a>
                                                <ul class="sub-menu">
                                                    @if ($menu->sub ?? '')
                                                        @foreach ($menu->sub as $sub)
                                                            @if ($sub->parent_id == $menu->id)
                                                                <li class="has-sub-sub">
                                                                    @if ($sub->subsub ?? '')
                                                                        <a class="subsubmenubtn" href="#"> {{$sub->name}}</a>
                                                                    @else
                                                                        @if ($sub->rubrique == "1")                                                                            
                                                                            <a href="#" onclick="AllActuality(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                        @elseif ($sub->rubrique == "2")            
                                                                            <a href="#" onclick="AllService(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                        @elseif ($sub->rubrique == "3")            
                                                                            <a href="#" onclick="AllProduct(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                        @elseif ($sub->rubrique == "4")            
                                                                            <a href="#" onclick="Allstaff()"><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                        @else
                                                                            <a href="#" menuid="{{$sub->id}}" onclick="ContentSousMenu(this)"><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                        @endif 
                                                                    @endif
                                                                    <ul class="submenu" >
                                                                        @foreach ($sub->subsub as $subsub)
                                                                            @if ($subsub->sub_parent_id == $sub->id)
                                                                                @if ($subsub->rubrique == "1")                                                                            
                                                                                    <a href="#" onclick="AllActuality(this)" menuid='{{$subsub->id}}'><i class="fa fa-sign-in"></i> {{$subsub->name}}</a>
                                                                                @elseif ($subsub->rubrique == "2")            
                                                                                    <a href="#" onclick="AllService(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$subsub->name}}</a>
                                                                                @elseif ($subsub->rubrique == "3")            
                                                                                    <a href="#" onclick="AllProduct(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$subsub->name}}</a>
                                                                                @elseif ($subsub->rubrique == "4")            
                                                                                    <a href="#" onclick="Allstaff()"><i class="fa fa-sign-in"></i> {{$subsub->name}}</a>
                                                                                @else
                                                                                    <li><a class="dropdown-item" href="#" menuid="{{$subsub->id}}" onclick="ContentSousSousMenu(this)"><i class="fa fa-user"></i> {{$subsub->name}}</a></li>
                                                                                @endif 
                                                                            @endif
                                                                        @endforeach
                                                                    </ul>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach
                                @endif

                                @if ($menus ?? "")
                                @foreach ($menus as $menu)
                                    @if ($menu->position == "5")
                                        <li class="has-sub" >
                                            <a href="javascript:void(0)" >{{$menu->name}}</a>
                                            <ul class="sub-menu">
                                                @if ($menu->sub ?? '')
                                                    @foreach ($menu->sub as $sub)
                                                        @if ($sub->parent_id == $menu->id)
                                                            <li class="has-sub-sub">
                                                                @if ($sub->subsub ?? '')
                                                                    <a class="subsubmenubtn" href="#"> {{$sub->name}}</a>
                                                                @else
                                                                    @if ($sub->rubrique == "1")                                                                            
                                                                        <a href="#" onclick="AllActuality(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                    @elseif ($sub->rubrique == "2")            
                                                                        <a href="#" onclick="AllService(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                    @elseif ($sub->rubrique == "3")            
                                                                        <a href="#" onclick="AllProduct(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                    @elseif ($sub->rubrique == "4")            
                                                                        <a href="#" onclick="Allstaff()"><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                    @else
                                                                        <a href="#" menuid="{{$sub->id}}" onclick="ContentSousMenu(this)"><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                    @endif                                                               
                                                                @endif
                                                                <ul class="submenu" >
                                                                    @foreach ($sub->subsub as $subsub)
                                                                        @if ($subsub->sub_parent_id == $sub->id)
                                                                            @if ($subsub->rubrique == "1")                                                                            
                                                                                <a href="#" onclick="AllActuality(this)" menuid='{{$subsub->id}}'><i class="fa fa-sign-in"></i> {{$subsub->name}}</a>
                                                                            @elseif ($subsub->rubrique == "2")            
                                                                                <a href="#" onclick="AllService(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$subsub->name}}</a>
                                                                            @elseif ($subsub->rubrique == "3")            
                                                                                <a href="#" onclick="AllProduct(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$subsub->name}}</a>
                                                                            @elseif ($subsub->rubrique == "4")            
                                                                                <a href="#" onclick="Allstaff()"><i class="fa fa-sign-in"></i> {{$subsub->name}}</a>
                                                                            @else
                                                                                <li><a class="dropdown-item" href="#" menuid="{{$subsub->id}}" onclick="ContentSousSousMenu(this)"><i class="fa fa-user"></i> {{$subsub->name}}</a></li>
                                                                            @endif 
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </li>
                                    @endif
                                @endforeach
                            @endif

                            @if ($menus ?? "")
                                @foreach ($menus as $menu)
                                    @if ($menu->position == "6")
                                        <li class="has-sub" >
                                            <a href="javascript:void(0)" onclick="AboutUs()">{{$menu->name}}</a>
                                            <ul class="sub-menu">
                                                @if ($menu->sub ?? '')
                                                    @foreach ($menu->sub as $sub)
                                                        @if ($sub->parent_id == $menu->id)
                                                            <li class="has-sub-sub">
                                                                @if ($sub->subsub ?? '')
                                                                    <a class="subsubmenubtn" href="#"> {{$sub->name}}</a>
                                                                @else
                                                                    @if ($sub->rubrique == "1")                                                                            
                                                                        <a href="#" onclick="AllActuality(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                    @elseif ($sub->rubrique == "2")            
                                                                        <a href="#" onclick="AllService(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                    @elseif ($sub->rubrique == "3")            
                                                                        <a href="#" onclick="AllProduct(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                    @elseif ($sub->rubrique == "4")            
                                                                        <a href="#" onclick="Allstaff()"><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                    @else
                                                                        <a href="#" menuid="{{$sub->id}}" onclick="ContentSousMenu(this)"><i class="fa fa-sign-in"></i> {{$sub->name}}</a>
                                                                    @endif                                                                  
                                                                @endif
                                                                <ul class="submenu" >
                                                                    @foreach ($sub->subsub as $subsub)
                                                                        @if ($subsub->sub_parent_id == $sub->id)
                                                                            @if ($subsub->rubrique == "1")                                                                            
                                                                                <a href="#" onclick="AllActuality(this)" menuid='{{$subsub->id}}'><i class="fa fa-sign-in"></i> {{$subsub->name}}</a>
                                                                            @elseif ($subsub->rubrique == "2")            
                                                                                <a href="#" onclick="AllService(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$subsub->name}}</a>
                                                                            @elseif ($subsub->rubrique == "3")            
                                                                                <a href="#" onclick="AllProduct(this)" menuid='{{$sub->id}}'><i class="fa fa-sign-in"></i> {{$subsub->name}}</a>
                                                                            @elseif ($subsub->rubrique == "4")            
                                                                                <a href="#" onclick="Allstaff()"><i class="fa fa-sign-in"></i> {{$subsub->name}}</a>
                                                                            @else
                                                                                <li><a class="dropdown-item" href="#" menuid="{{$subsub->id}}" onclick="ContentSousSousMenu(this)"><i class="fa fa-user"></i> {{$subsub->name}}</a></li>
                                                                            @endif                                                                        
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </li>
                                    @endif
                                @endforeach
                            @endif

                            <!--
                            <li class="has-sub">
                                <a href="javascript:void(0)"><i class="fa fa-user"></i> Profil</a>
                                <ul class="sub-menu">
                                    <li><a href="#" onclick="SignIn()"> <i class="fa fa-sign-in"></i> Connexion</a></li>
                                    <li><a href="#" onclick="SignUp()"> <i class="fa fa-user-plus"></i> Rejoignez-nous</a></li>
                                </ul>
                            </li>
                            -->
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>

                      <!-- ***** Menu End ***** -->
                  </nav>
              </div>
          </div>
      </div>
  </header>
  <!-- ***** Header Area End ***** -->

  <!-- ***** Main Banner Area Start ***** -->
  <div class="banner-block">
    @yield('banner')
  </div>
  <!-- ***** Main Banner Area End ***** -->


  <div class="corecontent">
    @yield('content')
  </div>

  <!--Loader page modal -->
  <div class="modal fade" id="globalloader" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered loaderblock justify-content-center" role="document">
        <span class="fa fa-spinner fa-spin fa-3x"></span>
    </div>
  </div>

  @include("user.loginuser")

  @include("user.signupuser")


  <div class="classwhatsapp">
    <button onclick="redirectWhatsapp()"><i class="fa fa-whatsapp"></i></button>
  </div>

  <section>
    <div class="footer container">
        <p>
            <h4 class="title text-center">Contacts</h4>
            <address class="row">
                <div class="col-lg-4">
                    <p><i class="fa fa-map-marker iconfooter"></i> <br>
                        {{$entreprise->adresse1}} <br>
                        @foreach(explode(',', $entreprise->adresse2) as $adresse2)
                            {{$adresse2}} <br>
                        @endforeach
                    </p>
                </div>
                <div class="col-lg-4">
                    <p><i class="fa fa-phone iconfooter"></i> <br>
                        {{$entreprise->telephone1}} <br>
                        @foreach(explode(',', $entreprise->telephone2) as $telephone2)
                            {{$telephone2}} <br>
                        @endforeach
                    </p>
                </div>
                <div class="col-lg-4">  
                    <p><i class="fa fa-envelope iconfooter"></i> <br>
                        {{$entreprise->email1}} <br>
                        @foreach(explode(',', $entreprise->email2) as $email2)
                            @if ($email2)
                                {{$email2}} <br>
                            @endif
                        @endforeach
                    </p>
                </div>
            </address>
        </p>
    </div>
  </section>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="{{asset('user/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('user/vendor/bootstrap/js/bootstrap.min.js')}}"></script>

    <script src="{{asset('user/assets/js/main.js')}}"></script>
    <script src="{{asset('user/assets/js/isotope.min.js')}}"></script>
    <script src="{{asset('user/assets/js/owl-carousel.js')}}"></script>
    <script src="{{asset('user/assets/js/lightbox.js')}}"></script>
    <script src="{{asset('user/assets/js/tabs.js')}}"></script>
    <script src="{{asset('user/assets/js/slick-slider.js')}}"></script>
    <script src="{{asset('user/assets/js/swiper.min.js')}}"></script>
    <script src="{{asset('user/assets/js/custom.js')}}"></script>
	<script src="{{asset("user/assets/js/toastr.min.js")}}"></script>  
    <script src="{{ asset('admindashboard/js/quill.js')}}"></script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script>
        //according to loftblog tut
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
          var
          direction = section.replace(/#/, ''),
          reqSection = $('.section').filter('[data-section="' + direction + '"]'),
          reqSectionPos = reqSection.offset().top - 0;

          if (isAnimate) {
            $('body, html').animate({
              scrollTop: reqSectionPos },
            800);
          } else {
            $('body, html').scrollTop(reqSectionPos);
          }

        };

        var checkSection = function checkSection() {
          $('.section').each(function () {
            var
            $this = $(this),
            topEdge = $this.offset().top - 80,
            bottomEdge = topEdge + $this.height(),
            wScroll = $(window).scrollTop();
            if (topEdge < wScroll && bottomEdge > wScroll) {
              var
              currentId = $this.data('section'),
              reqLink = $('a').filter('[href*=\\#' + currentId + ']');
              reqLink.closest('li').addClass('active').
              siblings().removeClass('active');
            }
          });
        };

        $('.main-menu, .responsive-menu, .scroll-to-section').on('click', 'a', function (e) {
          e.preventDefault();
          showSection($(this).attr('href'), true);
        });

        $(window).scroll(function () {
          checkSection();
        });
    </script>
    <script>
        var interleaveOffset = 0.5;
        var swiperOptions = {
            loop: true,
            speed: 1000,
            autoplay: true,
            grabCursor: true,
            watchSlidesProgress: true,
            mousewheelControl: true,
            keyboardControl: true,
            navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
            },
            on: {
            progress: function() {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                var slideProgress = swiper.slides[i].progress;
                var innerOffset = swiper.width * interleaveOffset;
                var innerTranslate = slideProgress * innerOffset;
                swiper.slides[i].querySelector(".slide-inner").style.transform =
                    "translate3d(" + innerTranslate + "px, 0, 0)";
                }
            },
            touchStart: function() {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                swiper.slides[i].style.transition = "";
                }
            },
            setTransition: function(speed) {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                swiper.slides[i].style.transition = speed + "ms";
                swiper.slides[i].querySelector(".slide-inner").style.transition =
                    speed + "ms";
                }
            }
            }
        };

        var swiper = new Swiper(".swiper-container", swiperOptions);
    </script>
</body>

</body>
</html>
