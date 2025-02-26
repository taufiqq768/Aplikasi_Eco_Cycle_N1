<?php

namespace App\Livewire\Master\User;

use App\Enum\UserRoleEnum;
use App\Helpers\JsHelpers;
use App\KodeUnitEnum;
use App\Models\MasterUnit;
use App\Models\User;
use DB;
use Livewire\Component;

class ModalCreate extends Component
{
    public $data;
    public $nik;
    public $kode_unit;
    public $role;
    public $nama;
    public $unit;
    public $isExist;
    public function render()
    {
        $listRole = [];
        foreach (UserRoleEnum::cases() as $key => $value) {
            $listRole[$value->name] = $value->value;
        }
        return view('livewire.master.user.modal-create', compact('listRole'));
    }

    public function cari()
    {
        $this->reset('nama');
        $this->reset('kode_unit');
        $this->reset('unit');
        $data = DB::connection('sqlsrv')->table('HR_M_EMPLOYEE')->where('NIK_SAP', $this->nik)->first();
        if ($data) {
            $namaUnit = MasterUnit::where('kode', $data->PERSONNEL_SUB_AREA_SAP)->first();
            $this->nama = $data->NAMA;
            $this->kode_unit = $data->PERSONNEL_SUB_AREA_SAP;
            $this->unit = $namaUnit ? $namaUnit->nama_unit : 'Bukan Unit';
            $this->data = $data;
        }
    }

    public function save()
    {
        $validate = $this->validate([
            'nik' => 'required',
            'role' => 'required',
            'unit' => 'required',
            'kode_unit' => 'required',
            'nama' => 'required',
        ]);

        User::create([
            'nik_sap' => $this->nik,
            'role' => $this->role,
            'kode_unit' => $this->kode_unit,
            'nama' => $this->nama,
        ]);

        $this->resetData();
        JsHelpers::closeModal($this, 'modalUser');
        $this->dispatch('refreshTable');
        $this->render();
    }

    public function resetData()
    {
        $this->reset('nik');
        $this->reset('kode_unit');
        $this->reset('role');
        $this->reset('nama');
        $this->reset('unit');
        $this->reset('data');
    }
}
