@extends('layouts.app')
@section('content')
<div class="container mt-5 text-center" style="max-width: 500px">
    <h2>Donate to: {{ $campaign->activity_name }}</h2>
    <form action="{{ url('/campaigns/'.$campaign->id.'/pay') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nominal (Rp)</label>
            <input type="number" name="amount" class="form-control" required>
        </div>
        <button class="btn btn-success btn-block">BAYAR</button>
    </form>
</div>
@endsection