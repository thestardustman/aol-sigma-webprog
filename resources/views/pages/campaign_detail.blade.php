@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <!-- Detail Kiri -->
        <div class="col-md-8">
            <img src="{{ $campaign->image }}" class="img-fluid mb-3">
            <h2>{{ $campaign->activity_name }}</h2>
            <p class="text-muted">Komunitas: {{ $campaign->community_name }} | Tanggal: {{ $campaign->date }}</p>
            <p>{{ $campaign->description }}</p>
            
            <hr>
            <h4>DONATE TO THIS CAMPAIGN</h4>
            <a href="{{ route('campaigns.pay', $campaign->id) }}" class="btn btn-success btn-lg">DONATE</a>
        </div>

        <!-- Top Donater Kanan -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-dark text-white">TOP 10 DONATERS</div>
                <ul class="list-group list-group-flush">
                    @forelse($topDonaters as $donor)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $donor->user->name }}</span>
                            <span class="font-weight-bold">Rp {{ number_format($donor->amount) }}</span>
                        </li>
                    @empty
                        <li class="list-group-item">Belum ada donasi.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection