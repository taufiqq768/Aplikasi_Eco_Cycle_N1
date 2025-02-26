<?php

namespace App\Livewire\Master\User;

use App\Enum\UserRoleEnum;
use App\Helpers\JsHelpers;
use App\Models\User;
use Livewire\Component;

class ModalEdit extends Component
{
    public $nik;
    public $nama;
    public $kode_unit;
    public $role;
    public function render()
    {
        $listRole = [];
        foreach (UserRoleEnum::cases() as $key => $value) {
            $listRole[$value->name] = $value->value;
        }
        return view('livewire.master.user.modal-edit', compact('listRole'));
    }

    public function save()
    {
        $validate = $this->validate([
            'nik' => 'required',
            'role' => 'required',
        ]);

        User::where('nik_sap', $this->nik)
            ->update([
                'role' => $this->role,
            ]);

        $this->render();
        JsHelpers::closeModal($this, 'modalEditUser');
        $this->dispatch('refreshTable');
    }
}
