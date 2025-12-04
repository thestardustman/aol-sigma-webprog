@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white">
                    <h4>Settings</h4>
                </div>
                <div class="card-body">
                    <form>
                        <!-- Form Dummy -->
                        <div class="form-group">
                            <label>Change Name</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group">
                            <label>Change Phone</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->phone }}">
                        </div>
                        <div class="form-group">
                            <label>Change Address</label>
                            <textarea class="form-control">{{ Auth::user()->address }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control" placeholder="Leave empty if not changing">
                        </div>
                        
                        <div class="alert alert-info mt-3">
                            Fitur update data sedang dalam pengembangan.
                        </div>

                        <button type="button" class="btn btn-success">Save Changes</button>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection