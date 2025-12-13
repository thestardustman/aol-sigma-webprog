@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold mb-1">Approval Requests</h4>
    <p class="text-muted small mb-0">Review and process pending approvals</p>
</div>

<!-- Tabs -->
<style>
    .tab-btn { padding: 0.5rem 1.5rem; border-radius: 0.5rem; font-weight: 600; border: none; background: #e5e7eb; color: #6b7280; transition: all 0.2s; cursor: pointer; }
    .tab-btn:hover { background: #d1d5db; color: #374151; }
    .tab-btn.active { background: var(--primary-color); color: white; }
</style>
<ul class="nav mb-4 gap-2" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="tab-btn active" data-bs-toggle="pill" data-bs-target="#users-tab" type="button" role="tab">
            <i class="bi bi-person-badge me-1"></i> User KYC
            @if($pendingUsers->count() > 0)
                <span class="badge bg-danger ms-1">{{ $pendingUsers->count() }}</span>
            @endif
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="tab-btn" data-bs-toggle="pill" data-bs-target="#proposals-tab" type="button" role="tab">
            <i class="bi bi-megaphone me-1"></i> Proposals
            @if($pendingProposals->count() > 0)
                <span class="badge bg-danger ms-1">{{ $pendingProposals->count() }}</span>
            @endif
        </button>
    </li>
</ul>

<div class="tab-content">
    <!-- User KYC Tab -->
    <div class="tab-pane fade show active" id="users-tab">
        @forelse($pendingUsers as $user)
        <div class="list-item" onclick="toggleDetail('user-{{ $user->id }}')">
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
                    <span class="text-muted small">Profile: {{ $user->getProfileCompletionPercentage() }}%</span>
                    <span class="badge badge-pending"><i class="bi bi-hourglass-split me-1"></i>Pending KYC</span>
                    <i class="bi bi-chevron-down text-muted small"></i>
                </div>
            </div>
        </div>
        
        <div class="list-item-detail" id="detail-user-{{ $user->id }}">
            <div class="row g-3">
                <div class="col-md-6">
                    <h6 class="text-primary fw-bold small mb-2">KYC Documents</h6>
                    <p class="small mb-2"><strong>NIK:</strong> {{ $user->ktp_number }}</p>
                    <div class="row g-2">
                        <div class="col-6">
                            <p class="text-muted small mb-1">KTP Photo</p>
                            @if($user->ktp_photo)
                                <img src="{{ asset('storage/' . $user->ktp_photo) }}" class="img-fluid rounded" style="max-height: 120px;">
                            @endif
                        </div>
                        <div class="col-6">
                            <p class="text-muted small mb-1">Selfie with KTP</p>
                            @if($user->selfie_photo)
                                <img src="{{ asset('storage/' . $user->selfie_photo) }}" class="img-fluid rounded" style="max-height: 120px;">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h6 class="text-primary fw-bold small mb-2">Action</h6>
                    
                    <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" class="mb-3">
                        @csrf
                        <div class="mb-2">
                            <input type="text" name="reason" class="form-control form-control-sm" 
                                   placeholder="Reason for approval (internal)" required>
                        </div>
                        <button type="submit" class="btn btn-approve btn-sm">
                            <i class="bi bi-check-lg me-1"></i> Approve
                        </button>
                    </form>
                    
                    <hr class="my-2">
                    
                    <form action="{{ route('admin.users.reject', $user->id) }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <input type="text" name="reason" class="form-control form-control-sm" 
                                   placeholder="Reason for rejection (internal)" required>
                        </div>
                        <div class="mb-2">
                            <textarea name="feedback" class="form-control form-control-sm" 
                                      rows="2" placeholder="Feedback for user..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-reject btn-sm">
                            <i class="bi bi-x-lg me-1"></i> Reject
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center text-muted py-5">
            <i class="bi bi-check-circle fs-1 d-block mb-2 text-success"></i>
            <p>No pending user KYC requests</p>
        </div>
        @endforelse
    </div>

    <!-- Proposals Tab -->
    <div class="tab-pane fade" id="proposals-tab">
        @forelse($pendingProposals as $proposal)
        <div class="list-item" onclick="toggleDetail('proposal-{{ $proposal->id }}')">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="fw-bold">{{ $proposal->activity_name }}</span>
                    <span class="text-muted small ms-2">by {{ $proposal->user->name ?? 'Unknown' }}</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="text-success fw-bold small">Rp {{ number_format($proposal->target_amount) }}</span>
                    <span class="badge badge-pending"><i class="bi bi-hourglass-split me-1"></i>Pending</span>
                    <i class="bi bi-chevron-down text-muted small"></i>
                </div>
            </div>
        </div>
        
        <div class="list-item-detail" id="detail-proposal-{{ $proposal->id }}">
            <div class="row g-3">
                <div class="col-md-6">
                    <h6 class="text-primary fw-bold small mb-2">Proposal Info</h6>
                    <table class="table table-sm small mb-0">
                        <tr><td class="text-muted">Activity</td><td>{{ $proposal->activity_name }}</td></tr>
                        <tr><td class="text-muted">Date</td><td>{{ $proposal->activity_date }}</td></tr>
                        <tr><td class="text-muted">Address</td><td>{{ $proposal->activity_address }}</td></tr>
                        <tr><td class="text-muted">Target</td><td class="text-success">Rp {{ number_format($proposal->target_amount) }}</td></tr>
                        <tr><td class="text-muted">PIC</td><td>{{ $proposal->pic_name }}</td></tr>
                    </table>
                    @if($proposal->proposal_file)
                        <a href="{{ asset('uploads/' . $proposal->proposal_file) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-2">
                            <i class="bi bi-file-earmark-pdf me-1"></i> View Document
                        </a>
                    @endif
                </div>
                <div class="col-md-6">
                    <h6 class="text-primary fw-bold small mb-2">Action</h6>
                    
                    <form action="{{ route('admin.campaigns.approve', $proposal->id) }}" method="POST" class="mb-3">
                        @csrf
                        <div class="mb-2">
                            <input type="text" name="reason" class="form-control form-control-sm" 
                                   placeholder="Reason for approval (internal)" required>
                        </div>
                        <button type="submit" class="btn btn-approve btn-sm">
                            <i class="bi bi-check-lg me-1"></i> Approve
                        </button>
                    </form>
                    
                    <hr class="my-2">
                    
                    <form action="{{ route('admin.campaigns.reject', $proposal->id) }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <input type="text" name="reason" class="form-control form-control-sm" 
                                   placeholder="Reason for rejection (internal)" required>
                        </div>
                        <div class="mb-2">
                            <textarea name="feedback" class="form-control form-control-sm" 
                                      rows="2" placeholder="Feedback for user..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-reject btn-sm">
                            <i class="bi bi-x-lg me-1"></i> Reject
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center text-muted py-5">
            <i class="bi bi-check-circle fs-1 d-block mb-2 text-success"></i>
            <p>No pending proposal requests</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
