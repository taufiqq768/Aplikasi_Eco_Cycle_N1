<?php

namespace App\Livewire\Master\User;

use Livewire\Component;

class TableView extends Component
{
    public $listUser;

    public function mount($listUser)
    {
        $this->listUser = $listUser;
    }
    public function render()
    {
        return view('livewire.master.user.table-view');
    }
}
