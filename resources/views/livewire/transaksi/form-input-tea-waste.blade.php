<div>
    <div class="custom-loader-wrapper flex-center" wire:loading.flex>
        <div class="custom-loader"></div>
    </div>
    @if (!$isPeriodeOpen)
        <div class="alert alert-danger" role="alert">
            Periode Pengisian Data Belum Dibuka
        </div>
    @endif
    @if ($isAllowed)
        <form wire:submit='submit' class="form" enctype="multipart/form-data" wire:key='{{ rand() }}'>
            <div class="row mt-4">
                <div class="col-6 mt-3">
                    <label for="tbs_olah">Produksi Teh diolah (Kg)</label>
                    <input type="text" name="tbs_olah" id="tbs_olah" class="form-control form-control-lg"
                        value="@thousands($tbs_olah)" readonly>
                </div>
                <div class="col-6 mt-3">
                    <label for="produksi_teawaste">Produksi Teawaste (Kg)</label>
                    <input type="text" name="produksi_teawaste" id="produksi_teawaste"
                        class="form-control form-control-lg" value="@thousands($produksi_teawaste)" readonly>
                </div>
                <div class="col-6 mt-3" x-data="{ value: @entangle('digunakan') }">
                    <label for="digunakan">Digunakan untuk (Kg)</label>
                    <input type="text" name="digunakan" id="digunakan"
                        class="form-control form-control-lg" wire:model='digunakan'
                        x-mask:dynamic="$money($input, ',')">
                </div>
                <div class="col-6 mt-3" x-data="{ value: @entangle('dikirim') }">
                    <label for="dikirim">Dikirim ke Pabrik Lain (Kg)</label>
                    <input type="text" name="dikirim" id="dikirim"
                        class="form-control form-control-lg" wire:model='dikirim'
                        x-mask:dynamic="$money($input, ',')">
                </div>
                <div class="col-6 mt-3" x-data="{ value: @entangle('dijual') }">
                    <label for="dijual">Dijual (Kg)</label>
                    <input type="text" name="dijual" id="dijual" class="form-control form-control-lg"
                        wire:model='dijual' x-mask:dynamic="$money($input, ',')">
                </div>
                <div class="col-6 mt-3" x-data="{ value: @entangle('harga_jual_rata_rata') }">
                    <label for="harga_jual_rata_rata">Harga Jual Rata-Rata (Rp/Kg)</label>
                    <input type="text" name="harga_jual_rata_rata" id="harga_jual_rata_rata"
                        class="form-control form-control-lg" wire:model='harga_jual_rata_rata'
                        x-mask:dynamic="$money($input, ',')">
                </div>
                <div class="col-6 mt-3" x-data="{ value: @entangle('volume_keperluan_lain') }">
                    <label for="volume_keperluan_lain">Volume Keperluan Lain (Kg)</label>
                    <input type="text" name="volume_keperluan_lain" id="volume_keperluan_lain"
                        class="form-control form-control-lg" wire:model='volume_keperluan_lain'
                        x-mask:dynamic="$money($input, ',')">
                </div>
                <div class="col-6 mt-3">
                    <label for="keterangan_keperluan_lain">Keterangan Keperluan Lain</label>
                    <input type="text" name="keterangan_keperluan_lain" id="keterangan_keperluan_lain"
                        class="form-control form-control-lg" wire:model='keterangan_keperluan_lain'>
                </div>
                <div class="col-6 mt-3" x-data="{ value: @entangle('diterima') }">
                    <label for="diterima">Diterima (Kg)</label>
                    <input type="text" name="diterima" id="diterima" class="form-control form-control-lg"
                        wire:model='diterima' x-mask:dynamic="$money($input, ',')">
                </div>
                <div class="col-6 mt-3">
                    <label for="photo">Upload Gambar / Update Gambar</label>
                    <input type="file" id="photo" wire:model="photo" accept="image/*">
                </div>

                @if ($photo)
                    <div class="d-flex justify-content-start mt-2">
                        <img src="{{ $photo->temporaryUrl() }}" alt="Preview Gambar"
                            style="max-height: 300px; max-width: 300px;">
                    </div>
                @else
                    @if ($id_data_teawaste)
                        <div class="d-flex justify-content-start mt-2">
                            <img src="{{ asset('storage/' . $dataTeawaste->nama_file) }}" alt="Preview Gambar"
                                style="max-height: 300px; max-width: 300px;">
                        </div>
                    @endif
                @endif

                @error('photo')
                    <span class="error">{{ $message }}</span>
                @enderror
                @if ($isPeriodeOpen)
                    @if ($id_data_teawaste)
                        <div class="col-12 mt-4 text-right d-flex justify-content-end">
                            <button type="button" class="btn btn-lg btn-warning text-dark"
                                @click="confirmEdit('saveEdit')">Edit</button>
                        </div>
                    @else
                        <div class="col-12 mt-4 text-right d-flex justify-content-end">
                            <button type="button" class="btn btn-lg btn-primary"
                                @click="setConfirm('confirm')">Submit</button>
                        </div>
                    @endif
                @endif
            </div>
        </form>
    @else
        <div class="alert alert-danger" role="alert">
            Silahkan Mengisi Data Produksi Terlebih Dahulu
        </div>
    @endif
</div>

