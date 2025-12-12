<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone', 
        'address',
        'birth_date',
        'birth_place',
        'city',
        'province',
        'country',
        'zip_code',
        'gender',
        'profile_photo',
        'ktp_number',
        'ktp_photo',
        'selfie_photo',
        'kyc_status',
        'kyc_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'kyc_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isKycVerified(): bool
    {
        return $this->kyc_status === 'approved';
    }

    public function isKycPending(): bool
    {
        return $this->kyc_status === 'pending';
    }

    public function getProfileCompletionPercentage(): int
    {
        $fields = ['phone', 'address', 'city', 'province', 'country', 'zip_code', 'birth_date', 'gender'];
        $filled = 0;
        
        foreach ($fields as $field) {
            if (!empty($this->$field)) {
                $filled++;
            }
        }
        
        $base = ($filled / count($fields)) * 70;
        
        if ($this->isKycVerified()) {
            $base += 30;
        } elseif ($this->isKycPending()) {
            $base += 15;
        }
        
        return (int) min($base, 100);
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
