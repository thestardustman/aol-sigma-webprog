@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Users</h4>
        <p class="text-muted small mb-0">Manage all registered users</p>
    </div>
</div>

<!-- Search & Filter -->
<div class="card-admin p-3 mb-4">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-5">
            <label class="form-label text-muted small mb-1">Search</label>
            <input type="text" name="search" class="form-control form-control-sm" 
                   placeholder="Search by name or email..." value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <label class="form-label text-muted small mb-1">KYC Status</label>
            <select name="status" class="form-select form-select-sm">
                <option value="">All Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary btn-sm w-100">
                <i class="bi bi-search me-1"></i> Filter
            </button>
        </div>
    </form>
</div>

<!-- Users List -->
<div class="users-list">
    @forelse($users as $user)
    <div class="list-item" onclick="toggleDetail({{ $user->id }})">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                @if($user->profile_photo)
                    <img src="{{ asset('storage/' . $user->profile_photo) }}" class="rounded-circle me-2" 
                         style="width: 32px; height: 32px; object-fit: cover;">
                @else
                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-2" 
                         style="width: 32px; height: 32px; font-size: 0.75rem; color: white;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <span class="fw-bold">{{ $user->name }}</span>
                    <span class="text-muted small ms-2">{{ $user->email }}</span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="text-muted small">{{ $user->created_at->format('d M Y') }}</span>
                @if($user->kyc_status === 'approved')
                    <span class="badge badge-approved"><i class="bi bi-patch-check me-1"></i>Verified</span>
                @elseif($user->kyc_status === 'pending')
                    <span class="badge badge-pending"><i class="bi bi-hourglass-split me-1"></i>Pending</span>
                @elseif($user->kyc_status === 'rejected')
                    <span class="badge badge-rejected"><i class="bi bi-x-circle me-1"></i>Rejected</span>
                @else
                    <span class="badge bg-secondary">Not Submitted</span>
                @endif
                <i class="bi bi-chevron-down text-muted small"></i>
            </div>
        </div>
    </div>
    
    <!-- Expandable Detail -->
    <div class="list-item-detail" id="detail-{{ $user->id }}">
        <div class="row g-3">
            <div class="col-md-6">
                <h6 class="text-primary fw-bold small mb-2">Personal Info</h6>
                <table class="table table-sm small mb-0">
                    <tr><td class="text-muted" width="100">Phone</td><td>{{ $user->phone ?: '-' }}</td></tr>
                    <tr><td class="text-muted">Birth</td><td>{{ $user->birth_place ?: '-' }}, {{ $user->birth_date ?: '-' }}</td></tr>
                    <tr><td class="text-muted">Gender</td><td>{{ $user->gender ?: '-' }}</td></tr>
                    <tr><td class="text-muted">Address</td><td>{{ $user->address ?: '-' }}</td></tr>
                    <tr><td class="text-muted">City</td><td>{{ $user->city ?: '-' }}, {{ $user->province ?: '-' }}</td></tr>
                    <tr><td class="text-muted">Profile</td><td>{{ $user->getProfileCompletionPercentage() }}% complete</td></tr>
                </table>
            </div>
            <div class="col-md-6">
                <h6 class="text-primary fw-bold small mb-2">KYC Documents</h6>
                @if($user->ktp_photo)
                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <p class="text-muted small mb-1">KTP Photo</p>
                            <img src="{{ asset('storage/' . $user->ktp_photo) }}" class="img-fluid rounded" style="max-height: 100px;">
                        </div>
                        <div class="col-6">
                            <p class="text-muted small mb-1">Selfie</p>
                            <img src="{{ asset('storage/' . $user->selfie_photo) }}" class="img-fluid rounded" style="max-height: 100px;">
                        </div>
                    </div>
                    <p class="text-muted small mb-0">NIK: {{ $user->ktp_number }}</p>
                @else
                    <p class="text-muted small">No KYC documents uploaded</p>
                @endif
                
                @if($user->kyc_status === 'rejected' && $user->kyc_rejection_reason)
                    <div class="alert alert-danger py-2 small mt-2">
                        <strong>Rejection Reason:</strong> {{ $user->kyc_rejection_reason }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="text-center text-muted py-5">
        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
        <p>No users found</p>
    </div>
    @endforelse
</div>

<!-- Pagination -->
<div class="mt-3">
    {{ $users->withQueryString()->links() }}
</div>
@endsection
