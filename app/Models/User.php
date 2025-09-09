<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles , HasUuids;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
   
    public function notifikasi(){
        return $this->HasMany(Notifikasi::class);
    }
    public function getStatusVerifikasiAttribute(){
        $result = ($this->statusKonfirmasi) ? $this->statusKonfirmasi->status : '';
        return $result;
    }
   
    public function getRealAvatarAttribute(){
       return $this->attributes['avatar'];
    }
    public function getAvatarAttribute(){
        if($this->attributes['avatar'] != null){
            return $this->attributes['avatar'];
        }else{
            $data = $this->roles->first()->name;
            if($data == 'farmasi'){
                return  'profile/avatar-perawat.png';
            }elseif($data == 'medis'){
                return  'profile/avatar-bidan.png';
            }elseif($data == 'dokter'){
                return  'profile/avatar-dokter.png';
            }elseif($data == 'penunjang_medis'){
                return  'profile/avatar-penunjang_medis.png';
            }elseif($data == 'penunjang_laundry'){
                return  'profile/avatar-laundry.jpg';
            }elseif($data == 'penunjang_sanitasi_limbah'){
                return  'profile/avatar-limbah.jpg';
            }elseif($data == 'umum'){
                return  'profile/avatar-umum.jpg';
            }elseif($data == 'admin'){
                return  'profile/avatar-admin.png';
            }elseif($data == 'super_admin'){
                return  'profile/avatar-super-admin.jpg';
            }else{
                return  'profile/avatar-dokter.png';
            }
        }
    }

   


    protected $guarded = ['id'];

 
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function setPasswordAttribute($password){
        $this->attributes['password'] = Hash::make($password);
    }
    public function routeNotificationForMail($notification)
    {
        return $this->email;
    }
}
