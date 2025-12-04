@extends('layouts.app')
@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Komunitas</h2>
    <div class="row">
        @foreach($campaigns as $camp)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ $camp->image }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5>{{ $camp->activity_name }}</h5>
                    <p class="text-muted">{{ $camp->community_name }} | {{ $camp->date }}</p>
                    <a href="{{ route('campaigns.show', $camp->id) }}" class="btn btn-info btn-block">Lihat Detail</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection