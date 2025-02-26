@use(App\Enum\JenisDataEnum)
<div class="modal fade" id="modalCreate" wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Stok Awal Tahun</h5>
                <button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal">
                    <i class="mdi mdi-close"></i>
                </button>
            </div>
            <form wire:submit='save'>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6 mb-3" wire:ignore>
                            <label class="form-label" for="unit">Unit Kerja</label>
                            <select name="unit" id="unit" wire:model='unit'>
                                <option value="">Pilih Unit</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->kode_unit }}">{{ $unit->nama_unit }}</option>
                                @endforeach
                            </select>
                            @error('unit')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label" for="tahun">Tahun</label>
                            <select name="tahun" id="tahun" class="form-select" wire:model='tahun'>
                                <option value="">Pilih Tahun</option>
                                @for ($i = 0; $i < 5; $i++)
                                    <option value="{{ date('Y') - $i }}">{{ date('Y') - $i }}</option>
                                @endfor
                            </select>
                            @error('tahun')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label" for="cangkang">Stok Cangkang</label>
                            <input class="form-control" id="cangkang" type="number" step="1" min="0"
                                wire:model='cangkang' name="cangkang">
                            @error('cangkang')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label" for="fiber">Stok Fiber</label>
                            <input class="form-control" id="fiber" type="number" step="1" min="0"
                                wire:model='fiber' name="fiber">
                            @error('fiber')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label" for="tankos">Stok Tankos</label>
                            <input class="form-control" id="tankos" type="number" step="1" min="0"
                                wire:model='tankos' name="tankos">
                            @error('tankos')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label" for="abu_janjang">Stok Abu Janjang</label>
                            <input class="form-control" id="abu_janjang" type="number" step="1" min="0"
                                wire:model='abu_janjang' name="abu_janjang">
                            @error('abu_janjang')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label" for="solid">Stok Solid</label>
                            <input class="form-control" id="solid" type="number" step="1" min="0"
                                wire:model='solid' name="solid">
                            @error('solid')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label" for="pome_oil">Stok Pome Oil</label>
                            <input class="form-control" id="pome_oil" type="number" step="1" min="0"
                                wire:model='pome_oil' name="pome_oil">
                            @error('pome_oil')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label" for="pkm">Stok PKM</label>
                            <input class="form-control" id="pkm" type="number" step="1" min="0"
                                wire:model='pkm' name="pkm">
                            @error('pkm')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- PTPN1 -->
                        <div class="col-6 mb-3">
                            <label class="form-label" for="tea_waste">Stok Tea Waste</label>
                            <input class="form-control" id="tea_waste" type="number" step="1" min="0"
                                wire:model='tea_waste' name="tea_waste">
                            @error('tea_waste')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label" for="limbah_serum">Stok Limbah Serum</label>
                            <input class="form-control" id="limbah_serum" type="number" step="1" min="0"
                                wire:model='limbah_serum' name="limbah_serum">
                            @error('limbah_serum')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label" for="tunggul_karet">Stok Tunggul Karet</label>
                            <input class="form-control" id="tunggul_karet" type="number" step="1" min="0"
                                wire:model='tunggul_karet' name="tunggul_karet">
                            @error('tunggul_karet')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label" for="abu">Stok Abu</label>
                            <input class="form-control" id="abu" type="number" step="1" min="0"
                                wire:model='abu' name="abu">
                            @error('abu')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label" for="ranting">Stok Ranting</label>
                            <input class="form-control" id="ranting" type="number" step="1" min="0"
                                wire:model='ranting' name="ranting">
                            @error('ranting')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label" for="kulit_buah">Stok Kulit Buah</label>
                            <input class="form-control" id="kulit_buah" type="number" step="1" min="0"
                                wire:model='kulit_buah' name="kulit_buah">
                            @error('kulit_buah')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label" for="husk_skin">Stok Husk Skin</label>
                            <input class="form-control" id="husk_skin" type="number" step="1" min="0"
                                wire:model='husk_skin' name="husk_skin">
                            @error('husk_skin')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label" for="mucilage">Stok Mucilage</label>
                            <input class="form-control" id="mucilage" type="number" step="1" min="0"
                                wire:model='mucilage' name="mucilage">
                            @error('mucilage')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

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

@script
    <script>
        $("#unit").select2({
            dropdownAutoWidth: !0,
            dropdownParent: $('#modalCreate')
        }).on('select2:select', function(e) {
            $wire.set('unit', e.target.value);
        });
    </script>
@endscript
