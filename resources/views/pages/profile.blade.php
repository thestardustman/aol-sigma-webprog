@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4>My Profile</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Full Name</div>
                        <div class="col-md-8">: {{ Auth::user()->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Email Address</div>
                        <div class="col-md-8">: {{ Auth::user()->email }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Phone Number</div>
                        <div class="col-md-8">: {{ Auth::user()->phone }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Address</div>
                        <div class="col-md-8">: {{ Auth::user()->address }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Member Since</div>
                        <div class="col-md-8">: {{ Auth::user()->created_at->format('d M Y') }}</div>
                    </div>

                    <hr>
                    <a href="{{ route('settings') }}" class="btn btn-warning text-white">Edit Profile</a>
                    <a href="{{ route('home') }}" class="btn btn-secondary">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection