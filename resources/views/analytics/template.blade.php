<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content=""/>
        <meta name="author" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{asset('images/logo-cadex.jpg')}}" style="border-radius: 100%;">
        <title>Cadex Analytics</title>
        <link rel="stylesheet" href="{{ asset('admindashboard/css/styles.css')}}" />
        <link href="{{ asset ('admindashboard/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" crossorigin="anonymous" />
        <link href="{{ asset ('admindashboard/css/google-font-css.css')}}" rel="stylesheet">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="{{ asset ('admindashboard/css/bootstrap.min.css')}}">
        <!-- Optional theme -->
        <link rel="stylesheet" href="{{ asset ('admindashboard/css/bootstrap-theme.min.css')}}">

        <link rel="stylesheet" href="{{ asset ('admindashboard/css/bootstrap-select.css')}}" />
        <link rel="stylesheet" href="{{ asset ('admindashboard/css/quill.snow.css')}}" />

        <link rel="stylesheet" href="{{asset('user/assets/css/toastr.min.css')}}">
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ route ('dashboard')}}">
                <div class="container-logo">
                    <img class="logo-global-dashboard" src="{{ asset ("images/CADEXLOGOONLY.png")}}" />
                </div>
            </a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <p class="welcomestyle" id="currentuser">Bienvenu {{ Auth::user()->name }}</p>
            <!-- Navbar global search hide -->
            <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"> </div>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li>
                    <img class="imagepp"  src="{{ asset('images/1.png')}}"/>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Réglages</a>
                        <a class="dropdown-item" href="#">Log des activités</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route ('logout')}}">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu" >
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="{{ route ('homeChart')}}">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-tachometer-alt"></i>
                                </div>
                                Trafic Global
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>

                            <!-- gestion  des administrateurs -->
                            @if(Auth::user()->is_superadmin == 1)
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ManageAdmin" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users-cog"></i></div>
                                    Gestion des admins
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="ManageAdmin" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <a class="nav-link submenudashboard" href="{{ route ('homeAdmin')}}">Comptes admins</a>
                                    <a class="nav-link submenudashboard" href="">Logs des activités</a>
                                </div>
                            @else
                            @endif

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ManageMenus" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                                Gestion des menus
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="ManageMenus" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <a class="nav-link submenudashboard" href="{{ route ('homeMenu')}}">Menus principal</a>
                            </div>

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ManageManager" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-heading"></i></div>
                                Gestion de l'entreprise
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="ManageManager" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <a class="nav-link submenudashboard" href="{{ route ('homeEntreprise')}}">Entreprise Infos</a>
                                <a class="nav-link submenudashboard" href="{{ route ('homeProfil')}}">Gestion des profils</a>
                                <a class="nav-link submenudashboard" href="{{ route ('homeStaff')}}">Gestion du personnel</a>
                            </div>

                            <!-- gestion custmomisation interface -->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Customisation" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-edit"></i></div>
                                Customisation
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="Customisation" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <a class="nav-link submenudashboard" href="{{ route ('homeCustom')}}">Bannières</a>
                                <a class="nav-link submenudashboard" href="{{ route ('homeCategorie')}}">Catégorie des articles</a>
                                <a class="nav-link submenudashboard" href="{{ route ('homeArticle')}}">Articles</a>
                                <a class="nav-link submenudashboard" href="{{ route ('homeService')}}">Services</a>
                            </div>

                            <!-- gestion des solutions interface -->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#solution" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-edit"></i></div>
                                 Produits de l'entreprise
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="solution" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <a class="nav-link submenudashboard" href="{{ route ('homeCategorieSolution')}}">Gestion des catégories des produits</a>
                                <a class="nav-link submenudashboard" href="{{ route ('homeSolution')}}">Gestion des produits</a>
                            </div>

                            <!-- gestion des visiteurs sur le site -->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVisiteur" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Gestion des abonnées
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseVisiteur" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link submenudashboard" href="{{ route('homeAccountClient')}}">Comptes</a>
                                </nav>
                            </div>

                            <!-- gestion de lenvoie des mails aux visiteurs -->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-question-circle"></i></div>
                                Support Client
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <a class="nav-link submenudashboard" href="{{ route ('homeSupport')}}">Gestion des tickets</a>
                            </div>

                            <!-- gestion du de la discussion instantanee avec le chatboot -->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ChatBoot" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-comments"></i></div>
                                Gestion du chatboot
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="ChatBoot" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <a class="nav-link submenudashboard" href="{{ route ('homeChatboot')}}">
                                    Chat instantannée
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Vous êtes connecter en tant que:</div>
                        @if(Auth::user()->is_superadmin == 1)
                            <span style="color: white; font-style:italic;" >Super adminintrateur</span>
                        @else
                            <span style="color: white; font-style:italic;" >Administrateur</span>
                        @endif
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    @yield('contenu')
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Cadex 2022</div>
                            <div>
                                <a href="#">Made By <span>Polyh International</span></a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <script src="{{ asset('admindashboard/js/jquery-3.5.min.js')}}" crossorigin="anonymous"></script>
        <script src="{{ asset ('admindashboard/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset ('admindashboard/js/bootstrap-select.min.js')}}"></script>
        <script src="{{ asset ('admindashboard/js/bootstrap.min.js')}}"></script>
        <script src="https://cdn.tiny.cloud/1/v019vf2cxmdh56o20p1r7blc9kz4j0tyvfm3c05imvls4l8q/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        <script src="{{ asset('admindashboard/js/scripts.js')}}"></script>
        <script src="{{ asset('admindashboard/js/service.js')}}"></script>
        <script src="{{ asset('admindashboard/js/article.js')}}"></script>
        <script src="{{ asset('admindashboard/js/categorie.js')}}"></script>
        <script src="{{ asset('admindashboard/js/categorie_solution.js')}}"></script>
        <script src="{{ asset('admindashboard/js/serviceDetail.js')}}"></script>
        <script src="{{ asset('admindashboard/js/solutionDetail.js')}}"></script>
        <script src="{{ asset('admindashboard/js/banniereDetail.js')}}"></script>
        <script src="{{ asset('admindashboard/js/admin.js')}}"></script>
        <script src="{{ asset('admindashboard/js/staff.js')}}"></script>
        <script src="{{ asset('admindashboard/js/support.js')}}"></script>
        <script src="{{ asset('admindashboard/js/jssolution.js')}}"></script>
        <script src="{{ asset('admindashboard/js/clientaccount.js')}}"></script>
        <script src="{{ asset('admindashboard/js/chart.min.js')}}" crossorigin="anonymous"></script>
        <script src="{{ asset('admindashboard/assets/demo/chart-area-demo.js')}}"></script>
        <script src="{{ asset('admindashboard/assets/demo/chart-bar-demo.js')}}"></script>
        <script src="{{ asset('admindashboard/assets/demo/chart-pie-demo.js')}}"></script>
        <script src="{{ asset('admindashboard/js/datatable.min.js')}}" crossorigin="anonymous"></script>
        <script src="{{ asset('admindashboard/js/datatable-bootstrap4.min.js')}}" crossorigin="anonymous"></script>
        <script src="{{ asset('admindashboard/assets/demo/datatables-demo.js')}}"></script>
	    <script src="{{asset("user/assets/js/toastr.min.js")}}"></script>
        <script src="{{ asset('admindashboard/js/menus.js')}}"></script>
        <script src="{{ asset('admindashboard/js/banniere.js')}}"></script>

        
        <script src="{{ asset('admindashboard/js/quill.js')}}"></script>
        <script src="{{ asset('admindashboard/js/font-awesome-all.min.js')}}" crossorigin="anonymous"></script>

    </body>
</html>
