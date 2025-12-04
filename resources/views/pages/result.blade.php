@extends('layouts.app')
@section('content')
<div class="container text-center mt-5">
    @if($status == 'successful')
        <h1 class="text-success display-3 font-weight-bold">SUCCESSFUL</h1>
        <p class="lead">Terima kasih atas donasi Anda!</p>
    @else
        <h1 class="text-danger display-3 font-weight-bold">DENIED</h1>
        <p class="lead">Pembayaran gagal, silakan coba lagi.</p>
    @endif

    <!-- Pencetan GOT IT arah home -->
    <a href="{{ route('home') }}" class="btn btn-primary mt-5 btn-lg px-5">GOT IT</a>
</div>
@endsection