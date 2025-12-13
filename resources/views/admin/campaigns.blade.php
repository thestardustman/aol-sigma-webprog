@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Campaigns</h4>
        <p class="text-muted small mb-0">All approved campaigns (from proposals)</p>
    </div>
</div>

<!-- Search & Filter -->
<div class="card-admin p-3 mb-4">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-6">
            <label class="form-label text-muted small mb-1">Search</label>
            <input type="text" name="search" class="form-control form-control-sm" 
                   placeholder="Search by title or community..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary btn-sm w-100">
                <i class="bi bi-search me-1"></i> Search
            </button>
        </div>
    </form>
</div>

<!-- Campaigns List -->
<div class="campaigns-list">
    @forelse($campaigns as $campaign)
    <div class="list-item" onclick="toggleDetail('campaign-{{ $campaign->id }}')">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <span class="fw-bold">{{ $campaign->title }}</span>
                <span class="text-muted small ms-2">by {{ $campaign->community_name }}</span>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="text-success fw-bold small">Rp {{ number_format($campaign->target ?? 0) }}</span>
                <span class="text-muted small">{{ $campaign->created_at->format('d M Y') }}</span>
                <span class="badge badge-approved"><i class="bi bi-check-circle me-1"></i>Live</span>
                <a href="{{ route('admin.campaigns.detail', $campaign->id) }}" class="btn btn-sm btn-outline-primary" onclick="event.stopPropagation();">
                    <i class="bi bi-eye"></i> View
                </a>
                <i class="bi bi-chevron-down text-muted small"></i>
            </div>
        </div>
    </div>
    
    <!-- Expandable Detail -->
    <div class="list-item-detail" id="detail-campaign-{{ $campaign->id }}">
        <div class="row g-3">
            <div class="col-md-8">
                <h6 class="text-primary fw-bold small mb-2">Campaign Details</h6>
                <table class="table table-sm small mb-0">
                    <tr><td class="text-muted" width="120">Title</td><td>{{ $campaign->title }}</td></tr>
                    <tr><td class="text-muted">Community</td><td>{{ $campaign->community_name }}</td></tr>
                    <tr><td class="text-muted">Target</td><td class="text-success fw-bold">Rp {{ number_format($campaign->target ?? 0) }}</td></tr>
                    <tr><td class="text-muted">Collected</td><td>Rp {{ number_format($campaign->collected ?? 0) }}</td></tr>
                    <tr><td class="text-muted">Date</td><td>{{ $campaign->date ?? '-' }}</td></tr>
                    <tr><td class="text-muted">Description</td><td>{{ $campaign->description ?? '-' }}</td></tr>
                </table>
            </div>
            <div class="col-md-4">
                @if($campaign->img)
                    <h6 class="text-primary fw-bold small mb-2">Image</h6>
                    <img src="{{ asset('storage/' . $campaign->img) }}" class="img-fluid rounded" style="max-height: 150px;">
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="text-center text-muted py-5">
        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
        <p>No campaigns yet. Approve proposals to create campaigns!</p>
    </div>
    @endforelse
</div>

<!-- Pagination -->
<div class="mt-3">
    {{ $campaigns->withQueryString()->links() }}
</div>
@endsection
