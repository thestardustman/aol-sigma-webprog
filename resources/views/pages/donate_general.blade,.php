@extends('layouts.app')
@section('content')
<div class="container mt-5 text-center" style="max-width: 500px">
    <h2>General Donation</h2>
    <form action="{{ route('donate.general') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Masukkan Nominal (Rp)</label>
            <input type="number" name="amount" class="form-control" required>
        </div>
        <button class="btn btn-primary btn-block">BAYAR</button>
    </form>
</div>
@endsection