<?php

namespace App\Http\Livewire\User\PengajuanKerusakan;

use App\Models\pengajuankerusakan;
use Livewire\Component;

class UserPengajuanKerusakanDetail extends Component
{   
    public $pengajuan;
    public function mount($id){
        $this->pengajuan = pengajuankerusakan::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.user.pengajuan-kerusakan.user-pengajuan-kerusakan-detail');
    }
}
