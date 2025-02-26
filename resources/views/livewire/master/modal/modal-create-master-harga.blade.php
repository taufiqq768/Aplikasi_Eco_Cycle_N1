@use(App\Enum\UserRoleEnum)
@use(App\Enum\KategoriTransaksiEnum)
<div class="modal fade" id="modalCreateHarga" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Harga</h5>
                <button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal">
                    <i class="mdi mdi-close"></i>
                </button>
            </div>
            <form wire:submit='save'>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Tahun</label>
                        <select name="" id="tahun" wire:model='tahunSelected' class="form-control" required>
                            <option value=""></option>
                            @foreach ($rentangTahun as $tahun)
                                <option value="{{ $tahun }}">{{ $tahun }}</option>
                            @endforeach
                        </select>
                        @error('tahunSelected')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Kategori</label>
                        <select name="" id="kategori" class="form-control" wire:model='kategori' required>
                            <option value=""></option>
                            @foreach ($kategoriTransaksi as $kategori)
                                <option value="{{ $kategori->value }}">{{ $kategori->value }}</option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Harga (Rp/Kg)</label>
                        <input type="number" name="" id="" class="form-control" wire:model='harga'
                            required>
                        @error('harga')
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

@push('js')
    <script>
        function setDataModal(tahun, kategori, harga) {
            $('#modalCreateHarga').modal('show');
        }
    </script>
@endpush
