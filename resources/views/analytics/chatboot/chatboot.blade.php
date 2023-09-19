@extends('analytics/template')


@section('contenu')
    <div class="container-fluid">
        <h1 class="mt-4">Analytics</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Chatboot Manager</li>
        </ol>
        <div class="container">
            <div class="messaging">
                <input type="hidden" id="customerId" value="{{ auth()->user()->id  }}" />
                <div class="inbox_msg shadow-card" id="messengingBox">
                </div>
            </div>
        </div>
    </div>
@endsection