@extends('layouts.app')
@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="text-center">
        @if($status == 'successful')
            <div class="mb-3 text-success"><i class="bi bi-check-circle-fill" style="font-size: 5rem;"></i></div>
            <h1 class="display-4 fw-bold text-success">{{ __('messages.success') }}</h1>
            <p class="lead">{{ __('messages.success_msg') }}</p>
        @else
            <div class="mb-3 text-danger"><i class="bi bi-x-circle-fill" style="font-size: 5rem;"></i></div>
            <h1 class="display-4 fw-bold text-danger">{{ __('messages.denied') }}</h1>
            <p class="lead">{{ __('messages.denied_msg') }}</p>
        @endif
        <a href="{{ route('home') }}" class="btn btn-primary btn-lg rounded-pill px-5 mt-4">{{ __('messages.got_it') }}</a>
    </div>
</div>
@endsection