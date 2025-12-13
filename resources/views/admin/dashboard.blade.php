@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold mb-1">Dashboard</h4>
    <p class="text-muted small mb-0">Overview of SemutHitam admin panel</p>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-value">{{ $stats['total_users'] }}</div>
            <div class="stat-label"><i class="bi bi-people me-1"></i> Total Users</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-value text-warning">{{ $stats['pending_kyc'] }}</div>
            <div class="stat-label"><i class="bi bi-hourglass-split me-1"></i> Pending KYC</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-value text-info">{{ $stats['pending_proposals'] }}</div>
            <div class="stat-label"><i class="bi bi-megaphone me-1"></i> Pending Proposals</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-value text-success">{{ $stats['approved_users'] }}</div>
            <div class="stat-label"><i class="bi bi-patch-check me-1"></i> Verified Users</div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card-admin p-4">
            <h6 class="fw-bold mb-3"><i class="bi bi-lightning me-2"></i>Quick Actions</h6>
            <div class="d-grid gap-2">
                <a href="{{ route('admin.approvals') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-check-circle me-2"></i>Review Pending Approvals
                </a>
                <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-people me-2"></i>Manage Users
                </a>
                <a href="{{ route('admin.campaigns') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-megaphone me-2"></i>Manage Proposals
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card-admin p-4">
            <h6 class="fw-bold mb-3"><i class="bi bi-clock-history me-2"></i>Recent Activity</h6>
            @php
                $recentLogs = \App\Models\ApprovalLog::with('admin')->orderBy('created_at', 'desc')->take(5)->get();
            @endphp
            @forelse($recentLogs as $log)
                <div class="d-flex align-items-center mb-2 pb-2 border-bottom">
                    <span class="badge {{ $log->action === 'approved' ? 'badge-approved' : 'badge-rejected' }} me-2">
                        {{ ucfirst($log->action) }}
                    </span>
                    <span class="small">{{ ucfirst($log->target_type) }} #{{ $log->target_id }}</span>
                    <span class="text-muted small ms-auto">{{ $log->created_at->diffForHumans() }}</span>
                </div>
            @empty
                <p class="text-muted small mb-0">No recent activity</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
