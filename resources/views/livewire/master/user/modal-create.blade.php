@use(App\Enum\UserRoleEnum)
<div class="modal fade " id="modalUser" wire:ignore.self>
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambahkan Role Pengguna</h5>
                <button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal">
                    <i class="mdi mdi-close"></i>
                </button>
            </div>
            <form wire:submit='save'>
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row d-flex align-items-center">
                            <div class="col-10">
                                <label class="form-label" for="nik">NIK SAP</label>
                                <input class="form-control" id="nik" type="text" wire:model='nik'
                                    {{ $data ? 'readonly' : '' }}>
                                @error('nik')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <small class="form-text">Masukan NIK SAP Karyawan</small>
                            </div>
                            <div class="col-2">
                                @if ($data)
                                    <button type="button" class="btn btn-danger mt-2" wire:click='resetData'
                                        wire:loading.remove>
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger mt-2" wire:loading wire:target='reset'>
                                        <div class="spinner-grow spinner-grow-sm text-white">
                                        </div>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-primary mt-2" wire:click='cari'
                                        wire:loading.remove>
                                        <i class="fa fa-search"></i> Cari
                                    </button>
                                    <button type="button" class="btn btn-primary mt-2" wire:loading wire:target='cari'>
                                        <div class="spinner-grow spinner-grow-sm text-white">
                                        </div>
                                    </button>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="nama">Nama</label>
                        <input class="form-control" id="nama" type="text" readonly wire:model='nama'
                            name="nama">
                        @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="unit">Unit</label>
                        <input class="form-control" id="kode_unit" type="hidden" readonly wire:model='kode_unit'>
                        <input class="form-control" id="unit" type="text" readonly wire:model='unit'>
                        @error('unit')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @if ($data)

                        <div class="mb-3">
                            <label class="form-label" for="unit">Role</label>
                            <select class="form-select" wire:model='role'>
                                <option value=""></option>
                                @foreach ($listRole as $key => $role)
                                    <option value="{{ $key }}">{{ $role }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    @if ($data)
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    @endif
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
