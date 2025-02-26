<?php

namespace App\Livewire\Approval;

use App\Models\TransaksiProduksi;
use DB;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalView extends Component
{
    public $id;
    public $datas;
    public function render()
    {
        return view('livewire.approval.modal-view');
    }

    #[On('openModal')]
    public function openModal($id)
    {
        // $this->js('$("#modalViewApproval").modal("show");');
        $this->id = $id;
        $data = DB::select('CALL eco_cycle.SP_GET_VIEW_DATA_APPROVAL(?)', [$id]);
        $this->datas = $data;
    }

}
