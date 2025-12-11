@extends('layouts.app')
@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="text-center">
        <div class="mb-3 text-info"><i class="bi bi-file-earmark-check-fill" style="font-size: 5rem;"></i></div>
        <h1 class="display-4 fw-bold text-info">{{ __('messages.proposed_title') }}</h1>
        <p class="lead">{{ __('messages.proposed_msg') }}</p>
        <a href="{{ route('home') }}" class="btn btn-primary btn-lg rounded-pill px-5 mt-4">{{ __('messages.got_it') }}</a>
    </div>
</div>
@endsection