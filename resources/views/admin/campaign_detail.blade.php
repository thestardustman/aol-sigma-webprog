@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.campaigns') }}" class="text-decoration-none text-muted small">
        <i class="bi bi-arrow-left me-1"></i> Back to Campaigns
    </a>
    <h4 class="fw-bold mb-1 mt-2">{{ $campaign->title }}</h4>
    <p class="text-muted small mb-0">by {{ $campaign->community_name }}</p>
</div>

<!-- Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-value text-success">Rp {{ number_format($stats['total_collected']) }}</div>
            <div class="stat-label"><i class="bi bi-cash-stack me-1"></i> Total Collected</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-value">Rp {{ number_format($campaign->target ?? 0) }}</div>
            <div class="stat-label"><i class="bi bi-bullseye me-1"></i> Target</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-value text-primary">{{ $stats['total_donors'] }}</div>
            <div class="stat-label"><i class="bi bi-people me-1"></i> Total Donors</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            @php
                $progress = $campaign->target > 0 ? min(100, ($stats['total_collected'] / $campaign->target) * 100) : 0;
            @endphp
            <div class="stat-value text-info">{{ number_format($progress, 1) }}%</div>
            <div class="stat-label"><i class="bi bi-graph-up me-1"></i> Progress</div>
        </div>
    </div>
</div>

<!-- Progress Bar -->
<div class="card-admin p-4 mb-4">
    <h6 class="fw-bold mb-3">Funding Progress</h6>
    <div class="progress" style="height: 25px;">
        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $progress }}%">
            {{ number_format($progress, 1) }}%
        </div>
    </div>
    <div class="d-flex justify-content-between mt-2 small text-muted">
        <span>Rp 0</span>
        <span>Rp {{ number_format($campaign->target ?? 0) }}</span>
    </div>
</div>

<!-- Campaign Info -->
<div class="row g-3 mb-4">
    <div class="col-md-8">
        <div class="card-admin p-4">
            <h6 class="fw-bold mb-3">Campaign Details</h6>
            <table class="table table-sm small mb-0">
                <tr><td class="text-muted" width="120">Title</td><td>{{ $campaign->title }}</td></tr>
                <tr><td class="text-muted">Community</td><td>{{ $campaign->community_name }}</td></tr>
                <tr><td class="text-muted">Date</td><td>{{ $campaign->date ?? '-' }}</td></tr>
                <tr><td class="text-muted">Description</td><td>{{ $campaign->description ?? '-' }}</td></tr>
                <tr><td class="text-muted">Created</td><td>{{ $campaign->created_at->format('d M Y H:i') }}</td></tr>
            </table>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-admin p-4">
            <h6 class="fw-bold mb-3">Donation Summary</h6>
            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted small">Successful</span>
                <span class="badge badge-approved">{{ $stats['successful'] }}</span>
            </div>
            <div class="d-flex justify-content-between">
                <span class="text-muted small">Denied</span>
                <span class="badge badge-rejected">{{ $stats['denied'] }}</span>
            </div>
        </div>
    </div>
</div>

<!-- Donors List -->
<div class="card-admin">
    <div class="p-4 border-bottom">
        <h6 class="fw-bold mb-0"><i class="bi bi-people me-2"></i>Donor List</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0 small">
            <thead class="table-light">
                <tr class="text-muted">
                    <th>Date</th>
                    <th>Donor</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($donations as $donation)
                <tr>
                    <td>{{ $donation->created_at->format('d M Y H:i') }}</td>
                    <td>
                        @if($donation->user)
                            <span class="fw-bold">{{ $donation->user->name }}</span>
                            <span class="text-muted small ms-1">{{ $donation->user->email }}</span>
                        @else
                            <span class="text-muted">Anonymous</span>
                        @endif
                    </td>
                    <td class="fw-bold text-success">Rp {{ number_format($donation->amount) }}</td>
                    <td>
                        @if($donation->status === 'successful')
                            <span class="badge badge-approved">Successful</span>
                        @else
                            <span class="badge badge-rejected">Denied</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">
                        <i class="bi bi-inbox d-block fs-3 mb-2"></i>
                        No donations yet
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
