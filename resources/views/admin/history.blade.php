@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Approval History</h4>
        <p class="text-muted small mb-0">Complete log of all admin actions</p>
    </div>
</div>

<!-- Filter -->
<div class="card-admin p-3 mb-4">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-4">
            <label class="form-label text-muted small mb-1">Filter by Type</label>
            <select name="type" class="form-select form-select-sm">
                <option value="">All Types</option>
                <option value="user" {{ request('type') == 'user' ? 'selected' : '' }}>User KYC</option>
                <option value="proposal" {{ request('type') == 'proposal' ? 'selected' : '' }}>Proposals</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary btn-sm w-100">
                <i class="bi bi-filter me-1"></i> Filter
            </button>
        </div>
    </form>
</div>

<!-- History Table -->
<div class="card-admin">
    <div class="table-responsive">
        <table class="table table-hover mb-0 small">
            <thead class="table-light">
                <tr class="text-muted">
                    <th>Date</th>
                    <th>Admin</th>
                    <th>Action</th>
                    <th>Target</th>
                    <th>Reason (Internal)</th>
                    <th>Feedback (To User)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td>{{ $log->created_at->format('d M Y H:i') }}</td>
                    <td><span class="fw-bold">{{ $log->admin->name ?? 'Unknown' }}</span></td>
                    <td>
                        <span class="badge {{ $log->action === 'approved' ? 'badge-approved' : 'badge-rejected' }}">
                            {{ ucfirst($log->action) }}
                        </span>
                    </td>
                    <td>
                        @if($log->target_type === 'user')
                            @php $target = \App\Models\User::find($log->target_id); @endphp
                            <span class="badge bg-primary me-1">User</span>
                            {{ $target->name ?? 'Deleted' }}
                        @elseif($log->target_type === 'proposal')
                            @php $target = \App\Models\Proposal::find($log->target_id); @endphp
                            <span class="badge bg-info me-1">Proposal</span>
                            {{ $target->activity_name ?? 'Deleted' }}
                        @else
                            <span class="badge bg-secondary me-1">{{ ucfirst($log->target_type) }}</span>
                            #{{ $log->target_id }}
                        @endif
                    </td>
                    <td class="text-muted">{{ Str::limit($log->reason, 30) }}</td>
                    <td class="text-muted">{{ $log->feedback ? Str::limit($log->feedback, 30) : '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        <i class="bi bi-inbox d-block fs-3 mb-2"></i>
                        No approval history found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
<div class="mt-3">
    {{ $logs->withQueryString()->links() }}
</div>
@endsection
