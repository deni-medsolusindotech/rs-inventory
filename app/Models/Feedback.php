<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['tujuan','dari'];
    public function tujuan(){
        return $this->belongsTo(User::class,'to');
    }
    public function dari(){
        return $this->belongsTo(User::class,'from');
    }
    public function getWaktuAttribute(){

        if ($this->created_at->isToday()) {
             return $this->created_at->format('H:i'); // Format waktu jam dan menit
        } else {
             return $this->created_at->format('d F'); // Format tanggal ('d F')
        }

    }
    public function getWaktuDuaAttribute()
    {
        $createdDate = Carbon::parse($this->created_at);
        $currentDate = Carbon::now();

        if ($createdDate->diffInDays($currentDate) > 7) {
            return $createdDate->format('d F');
        } else {
            return $createdDate->diffForHumans();
        }
    }
}
