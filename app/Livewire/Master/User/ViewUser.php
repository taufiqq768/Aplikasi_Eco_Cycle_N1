<?php

namespace App\Livewire\Master\User;

use App\KodeUnitEnum;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
class ViewUser extends Component
{
    public function render()
    {
        $listUser = User::all();
        $user = $listUser->where('nik_sap', '3000160')->first();

        // $this->js('$("#tableUser").DataTable();');
        $this->dispatch('initDataTable');
        return view('livewire.master.user.view-user', [
            'listUser' => $listUser
        ]);
    }

    #[On('refreshTable')]
    public function refreshTable()
    {
        $this->render();
    }

    public function delete($nik_sap)
    {
        $user = User::where('nik_sap', $nik_sap)->first();
        $user->delete();
        $this->render();
    }

    public function getData()
    {
        $users = User::query()
            ->leftJoin('m_unit', 'm_unit.kode', '=', 'users.kode_unit')
            ->get();

        $columns = [
            'nik_sap',
            'nama',
            'role',
            'nama_unit',
            'unit_penugasan',
        ];

        $totalData = User::count();

        $json_data = [
            "recordsTotal" => intval($totalData),
            "data" => $users
        ];

        return response()->json($json_data);
    }

}
