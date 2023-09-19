@extends('analytics/template')


@section('contenu')
    <div class="container-fluid">
        <h1 class="mt-4">Analytics</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">CADEX Analytics</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4 blockanalytics">
                    <div class="card-body">
                        <span class="badgedash">
                            <i class="fa fa-users icondash"></i>
                        </span>
                        Abonnés
                        <div class="numberbadge">
                            <i class="fa fa-user-circle"></i>
                            {{ count($allaccountclient) }}
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('homeAccountClient')}}">Voir détails</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            @if(Auth::user()->is_superadmin)
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4 blockanalytics">
                    <div class="card-body">
                        <span class="badgedash">
                            <i class="fa fa-users-cog icondash"></i>
                        </span>
                        Admins
                        <div class="numberbadge">
                            <i class="fa fa-globe-africa"></i>
                            {{ count($alladmin) }}
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route ('homeAdmin')}}">Voir détails</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            @else
            @endif

            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4 blockanalytics">
                    <div class="card-body">
                        <span class="badgedash">
                            <i class="fa fa-headset icondash"></i>
                        </span>
                        Supports
                        <div class="numberbadge">
                            <i class="fa fa-bell"></i>
                            {{count($allsupport)}}
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route ('homeSupport')}}">Voir détails</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4 blockanalytics">
                    <div class="card-body">
                        <span class="badgedash">
                            <i class="fa fa-database icondash"></i>
                        </span>
                        Médias
                        <div class="numberbadge">
                            <i class="fa fa-server"></i>
                            {{$sizefiles}} Mégabites
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">Voir détails</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area mr-1"></i>
                        Abonnés inscrit par jour
                    </div>
                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar mr-1"></i>
                        Abonnés inscrit par mois
                    </div>
                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
        </div>
    </div>
@endsection
