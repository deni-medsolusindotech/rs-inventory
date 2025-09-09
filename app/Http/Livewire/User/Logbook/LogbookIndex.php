<?php

namespace App\Http\Livewire\User\LogBook;

use App\Models\LogbookPerawat;
use Livewire\Component;
use Livewire\WithPagination;

class LogbookIndex extends Component
{   use WithPagination;
    public $logbooks,$bukuperawat;
    public function mount(){
        $this->logbooks = LogbookPerawat::where('user_id',auth()->user()->id)->latest()->get();
        $data = $this->logbooks;
        $collection = collect($data);
        $groupedCollection = $collection->groupBy(function ($item) {
            return $item->created_at . '-' . $item->kegiatan_id;
        });

        $groupedCollection->each(function ($group) {
            $totalKegiatan = $group->count();
            $group->each(function ($item) use ($totalKegiatan) {
                $item->jumlah_kegiatan = $totalKegiatan;
            });
        });
        $groupedCollection->each(function ($group) {
            // Jika jumlah elemen dalam grup lebih dari 1
            if ($group->count() > 1) {
                // Hapus salah satu elemen dalam grup
                $group->splice(1);
            }
        });
       $this->bukuperawat = $groupedCollection;                
    }
    public function render()
    {
        return view('livewire.user.logbook.logbook-index');
    }
}
