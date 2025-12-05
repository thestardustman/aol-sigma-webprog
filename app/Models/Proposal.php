<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable = [
        'id_user', 
        'nama_aktivitas',
        'tanggal_aktivitas',
        'alamat_aktivitas', 
        'target_dana', 
        'nama_pic',
        'tempat_lahir_pic',
        'tanggal_lahir_pic',
        'alamat_pic',
        'kota_pic',
        'provinsi_pic',
        'negara_pic',
        'kode_zip_pic',
        'gender_pic',
        'file_proposal',
];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
