@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card-std p-4 text-center" style="position: sticky; top: 100px; z-index: 10;">
                        <!-- Profile Photo -->
                        <div class="position-relative d-inline-block mb-3">
                            @if($user->profile_photo)
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" 
                                     class="rounded-circle shadow" 
                                     style="width: 100px; height: 100px; object-fit: cover;"
                                     alt="Profile Photo">
                            @else
                                <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center shadow" 
                                     style="width: 100px; height: 100px; font-size: 2.5rem;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                            
                            <!-- Camera icon for upload -->
                            <button type="button" class="btn btn-sm btn-light rounded-circle position-absolute shadow-sm" 
                                    style="bottom: 0; right: 0; width: 32px; height: 32px; padding: 0;"
                                    data-bs-toggle="modal" data-bs-target="#photoModal">
                                <i class="bi bi-camera-fill text-primary"></i>
                            </button>
                        </div>
                        
                        <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                        <p class="text-muted small mb-3">{{ $user->email }}</p>
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between small mb-1">
                                <span class="text-muted">Kelengkapan Profil</span>
                                <span class="fw-bold text-primary">{{ $user->getProfileCompletionPercentage() }}%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-primary" style="width: {{ $user->getProfileCompletionPercentage() }}%"></div>
                            </div>
                        </div>

                        @if($user->isKycVerified())
                            <span class="badge bg-success px-3 py-2"><i class="bi bi-patch-check-fill me-1"></i>Terverifikasi</span>
                        @elseif($user->isKycPending())
                            <span class="badge bg-warning text-dark px-3 py-2"><i class="bi bi-hourglass-split me-1"></i>Menunggu Verifikasi</span>
                        @else
                            <span class="badge bg-secondary px-3 py-2"><i class="bi bi-shield-exclamation me-1"></i>Belum Terverifikasi</span>
                        @endif

                        <div class="mt-4">
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-pill w-100">
                                <i class="bi bi-pencil me-2"></i>Edit Profil
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card-std p-4 mb-4">
                        <h5 class="fw-bold text-primary mb-4"><i class="bi bi-person-badge me-2"></i>Informasi Pribadi</h5>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <small class="text-muted fw-bold d-block">Nomor Telepon</small>
                                <span class="fs-6">{{ $user->phone ?: '-' }}</span>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted fw-bold d-block">Jenis Kelamin</small>
                                <span class="fs-6">{{ $user->gender ?: '-' }}</span>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted fw-bold d-block">Tempat Lahir</small>
                                <span class="fs-6">{{ $user->birth_place ?: '-' }}</span>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted fw-bold d-block">Tanggal Lahir</small>
                                <span class="fs-6">{{ $user->birth_date ? \Carbon\Carbon::parse($user->birth_date)->format('d M Y') : '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-std p-4 mb-4">
                        <h5 class="fw-bold text-primary mb-4"><i class="bi bi-geo-alt me-2"></i>Alamat</h5>
                        
                        <div class="row g-3">
                            <div class="col-12">
                                <small class="text-muted fw-bold d-block">Alamat Lengkap</small>
                                <span class="fs-6">{{ $user->address ?: '-' }}</span>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted fw-bold d-block">Kota</small>
                                <span class="fs-6">{{ $user->city ?: '-' }}</span>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted fw-bold d-block">Provinsi</small>
                                <span class="fs-6">{{ $user->province ?: '-' }}</span>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted fw-bold d-block">Negara</small>
                                <span class="fs-6">{{ $user->country ?: '-' }}</span>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted fw-bold d-block">Kode Pos</small>
                                <span class="fs-6">{{ $user->zip_code ?: '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-std p-4">
                        <h5 class="fw-bold text-primary mb-4"><i class="bi bi-heart me-2"></i>Riwayat Donasi</h5>
                        
                        @if($donations->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Campaign</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($donations as $donation)
                                    <tr>
                                        <td class="small">{{ $donation->created_at->format('d M Y') }}</td>
                                        <td class="small">{{ $donation->campaign ? $donation->campaign->title : 'Donasi Umum' }}</td>
                                        <td class="fw-bold text-success">Rp {{ number_format($donation->amount) }}</td>
                                        <td>
                                            @if($donation->status === 'successful')
                                                <span class="badge bg-success">Berhasil</span>
                                            @else
                                                <span class="badge bg-danger">Gagal</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-1 d-block mb-2 opacity-25"></i>
                            <p class="mb-0">Belum ada riwayat donasi</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Photo Upload Modal -->
<div class="modal fade" id="photoModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 overflow-hidden">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold"><i class="bi bi-camera me-2"></i>Upload Foto Profil</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('profile.photo') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <div id="photoPreview" class="mb-3">
                            @if($user->profile_photo)
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" 
                                     class="rounded-circle" 
                                     style="width: 150px; height: 150px; object-fit: cover;"
                                     id="previewImg">
                            @else
                                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" 
                                     style="width: 150px; height: 150px;" id="previewPlaceholder">
                                    <i class="bi bi-person-fill text-muted" style="font-size: 4rem;"></i>
                                </div>
                                <img src="" class="rounded-circle d-none" 
                                     style="width: 150px; height: 150px; object-fit: cover;" 
                                     id="previewImg">
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Pilih Foto</label>
                        <input type="file" name="profile_photo" id="photoInput" class="form-control" accept="image/*" required>
                        <small class="text-muted">JPG, PNG, atau GIF. Maksimal 2MB.</small>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary btn-pill" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-pill">
                        <i class="bi bi-upload me-2"></i>Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('photoInput')?.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('previewImg');
            const placeholder = document.getElementById('previewPlaceholder');
            if (preview) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            }
            if (placeholder) {
                placeholder.classList.add('d-none');
            }
        }
        reader.readAsDataURL(file);
    }
});
</script>
@endsection