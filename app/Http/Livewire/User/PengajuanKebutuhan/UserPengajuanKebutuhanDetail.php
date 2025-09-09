<?php

namespace App\Http\Livewire\User\PengajuanKebutuhan;

use App\Models\pengajuankebutuhan;
use Livewire\Component;

class UserPengajuanKebutuhanDetail extends Component
{   
    public $pengajuan;
    public function mount($id){
        $this->pengajuan = pengajuankebutuhan::find($id);
    }
    public function render()
    {
        return view('livewire.user.pengajuan-kebutuhan.user-pengajuan-kebutuhan-detail');
    }
}
