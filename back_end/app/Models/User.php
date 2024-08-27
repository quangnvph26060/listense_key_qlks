<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'ma_phan_quyen'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    protected  $appends = ['role','user_info'];

    public function getRoleAttribute()
    {
        return PhanQuyen::where('id', $this->attributes['ma_phan_quyen'])->first();
    }
    public function  getUserInfoAttribute()
    {
        $user_info = NhanVien::where('ma_nguoi_dung',$this->attributes['id'])->first();
        if(empty($user_info)){
            $user_info = KhachHang::where('ma_nguoi_dung',$this->attributes['id'])->first();
        }
        return $user_info;
    }
}
