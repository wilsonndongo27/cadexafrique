@extends('user/template')

@section('content')
  <section class="heading-page header-text" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
            <h2>CONTACTS</h2>
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
                <div id="contact-page" class="container">
                    <div class="bg">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="title text-center">Contactez-<strong>Nous</strong></h4><br>
                                <div id="" class="contact-map">
                                    <iframe src="{{$entreprise->mapLink}}"
                                    width="100%" height="450px" frameborder="0" style="border:0; border-radius: 5px; position: relative; z-index: 2;" allowfullscreen=""></iframe>
                                </div>
                            </div>
                        </div>
                        <div class="row block1contact">
                            <div class="col-sm-8">
                                <div class="form-contact-block">
                                    <h4 class="title text-center">Que pouvons nous faire pour vous ?</h4><br>
                                    <div class="status alert alert-success" style="display: none"></div>
                                    <form id="contactform" class="contact-form-new row" action="{{ route ("news-letter-user")}}" method="post">
                                        @csrf
                                        <div class="form-group col-md-6">
                                            <input type="text" name="name" class="form-control" required="required" placeholder="Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="email" name="email" class="form-control" required="required" placeholder="Email">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <input type="text" name="subject" class="form-control" required="required" placeholder="Objet">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Votre message ici"></textarea>
                                        </div>
                                        <button type="submit" id="newsletterbtn" class="btn btn-primary btncontact">
                                            Envoyer
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="contact-info">
                                    <h4 class="title text-center">Siège social</h4>
                                    <address>
                                        <p>Siège principal : {{$entreprise->adresse1}}</p>
                                        <p>Représentation pays : <br>
                                            @foreach(explode(',', $entreprise->adresse2) as $adresse2)
                                                - {{$adresse2}} <br>
                                            @endforeach
                                        </p>
                                        <!--<p>Adresse : </p>-->
                                        <p>Mobile: <br>
                                            {{$entreprise->telephone1}}
                                            @foreach(explode(',', $entreprise->telephone2) as $telephone2)
                                                {{$telephone2}} <br>
                                            @endforeach
                                        </p>
                                        <!--<p>Fax: </p>-->
                                        <p>Email: <br>
                                            {{$entreprise->email1}}
                                            @foreach(explode(',', $entreprise->email2) as $email2)
                                                {{$email2}} <br>
                                            @endforeach
                                        </p>
                                    </address>
                                    <div class="social-networks">
                                        <h4 class="title text-center">Réseaux sociaux</h4>
                                        <ul>
                                            <li>
                                                <a href="mailto:{{$entreprise->email1}}"><i class="fa fa-envelope"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fa fa-facebook"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fa fa-twitter"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fa fa-youtube"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/#contact-page-->
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
