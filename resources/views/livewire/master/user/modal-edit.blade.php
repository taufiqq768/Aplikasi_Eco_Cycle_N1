@use(App\Enum\UserRoleEnum)
<div class="modal fade" id="modalEditUser" wire:ignore.self x-data="{ data: {} }"
    x-on:edit-data.window="data = $event.detail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Role Pengguna</h5>
                <button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal">
                    <i class="mdi mdi-close"></i>
                </button>
            </div>
            <form wire:submit='save'>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="nik">NIK SAP</label>
                        <input class="form-control" id="nik" type="text"
                            x-on:edit-data.window="$wire.set('nik', data.nik_sap)" readonly wire:model='nik'
                            name="nik">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="nik">Nama</label>
                        <input class="form-control" id="nama" type="text"
                            x-on:edit-data.window="$wire.set('nama', data.nama)" readonly wire:model='nama'
                            name="nama">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="unit">Unit</label>
                        <input class="form-control" id="kode_unit" type="text" readonly wire:model='kode_unit'
                            x-on:edit-data.window="$wire.set('kode_unit', data.kode_unit)" readonly
                            wire:model='kode_unit'>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="unit">Role</label>
                        <select class="form-select" wire:model='role'
                            x-on:edit-data.window="$wire.set('role', data.role)">
                            <option value=""></option>
                            @foreach ($listRole as $key => $role)
                                <option value="{{ $key }}">{{ $role }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
