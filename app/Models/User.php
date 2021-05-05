<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Vote;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'isVerified',
        'role',
        'status',
        'two_factor_code',
        'two_factor_expires_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime:M-d-Y',
        'two_factor_expires_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // public function nominee()
    // {
    //     return $this->belongsTo(Nominee::class, 'user_id', 'id');
    // }

    public function nomination()
    {
        return $this->hasOne(Nominee::class, 'user_id', 'id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'voter_id', 'id');
    }

    public function generateTwoFactorCode()
    {
        $otp = rand(100000, 999999);
        $this->timestamps = false;
        $this->password = Hash::make($otp);
        $this->two_factor_code = $otp;
        $this->two_factor_expires_at = now()->addMinutes(20);
        $this->save();
    }

    public function resetTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }
}
