<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowDokumen extends Component
{   
    public $file,$ext;
    public $listeners = ['refresh' => 'render','show'];
    public function mount($file){
        $this->file = $file;
        $dok = explode('.',$this->file);
        $this->ext = $dok[count($dok)-1];
    }
    public function show($file){
        $this->file = $file;
        $this->render();
    }
    public function render(){
        $dok = explode('.',$this->file);
        $this->ext = $dok[count($dok)-1];
        return view('components.show-dokumen');
    }
}
