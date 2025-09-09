<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;
    protected $table = 'notifikasi';
    protected $guarded = ['id'];
    public function getWaktuAttribute()
    {
        $createdDate = Carbon::parse($this->created_at);
        $currentDate = Carbon::now();

        if ($createdDate->diffInDays($currentDate) > 7) {
            return $createdDate->format('d F');
        } else {
            return $createdDate->diffForHumans();
        }
    }
    public function getWaktuDuaAttribute()
    {
        $createdDate = Carbon::parse($this->created_at);
        $currentDate = Carbon::now();

        if ($createdDate->diffInDays($currentDate) != 0) {
            return $createdDate->format('d F');
        } else {
            return $createdDate->format('H:i');
        }
    }
}
