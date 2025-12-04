@extends('layouts.app')
@section('content')
<div class="container mt-5" style="max-width: 600px">
    <h2 class="mb-4">Make a Donation Proposal</h2>
    <form action="{{ route('proposal.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Biodata User otomatis terisi -->
        <div class="form-group">
            <label>Nama Pengaju</label>
            <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
        </div>
        <div class="form-group">
            <label>Nama Kegiatan</label>
            <input type="text" name="activity_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Target Pencapaian (Rp)</label>
            <input type="number" name="target_amount" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Upload Proposal (PDF/Word/Foto)</label>
            <input type="file" name="file" class="form-control-file" required>
        </div>
        
        <!-- Pencetan PROPOSE -->
        <button class="btn btn-warning btn-block text-white">PROPOSE</button>
    </form>
</div>
@endsection