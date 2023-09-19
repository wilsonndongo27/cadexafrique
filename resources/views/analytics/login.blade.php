<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="shortcut icon" href="{{asset('images/logo-cadex.jpg')}}" style="border-radius: 100%;">
        <title>Cadex Analytics</title>
        <link href="{{ asset('admindashboard/css/styles.css') }}" rel="stylesheet" />
    </head>
    <body class="bg-primary formloginadmin">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Connexion</h3></div>
                                    <div class="card-body">
                                        <form id="loginadminform" method="POST" action="{{ route ('login_post_admin')}}">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="email" class="small mb-1">{{ __('Email') }}</label>
                                                    <input name="email" class="form-control py-4" style="font-size:14px"  id="inputEmailAddress" type="email" placeholder="Enter email address" />
                                                </div>
                                                <div class="form-group">
                                                    <label class="small mb-1" for="inputPassword">{{ _('Mot de passe')}}</label>
                                                    <div class="input-group" id="show_hide_password">
                                                        <input class="form-control py-4" id="inputPassword" style="font-size:14px" @error('password') is-invalid @enderror type="password" name="password" required autocomplete="current-password" placeholder="Enter password" />
                                                        <div class="input-group-addon">
                                                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                        </div>
                                                    </div>

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-8" style="margin-right: 14px;">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="remember">
                                                                    {{ __('Remember Me') }}
                                                                </label>
                                                            </div>
                                                        </div><br>
                                                        <div class="form-group  mb-6">
                                                            <div class="col-md-12">
                                                                <button type="submit" id="buttonlogin" class="btn btn-primary">
                                                                    {{ __('Connexion') }}
                                                                </button>
                                                                @if (Route::has('password.request'))
                                                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                                                        {{ __('Forgot Your Password?') }}
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                            </form>
                                    <div class="card-footer text-center">
                                        <div class="textalert" id="errorlogin"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; www.cadexafrique.com 2022</div>
                            <div>
                                <a href="#">Design BY <span class="polyhdesignername"> Polyh Internationnal</span></a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="{{ asset ('admindashboard/js/jquery-3.5.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset ('admindashboard/js/bootstrap4.3.min.js')}}" crossorigin="anonymous"></script>
        <script src="{{ asset ('admindashboard/js/font-awesome-5.13.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('admindashboard/js/scripts.js') }}"></script>
    </body>
</html>
