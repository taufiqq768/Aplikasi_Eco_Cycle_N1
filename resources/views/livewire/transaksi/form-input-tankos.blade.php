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
                    <label for="tbs_olah">TBS Olah (Kg)</label>
                    <input type="text" name="tbs_olah" id="tbs_olah" class="form-control form-control-lg"
                        value="@thousands($tbs_olah)" readonly>
                </div>
                <div class="col-6 mt-3">
                    <label for="produksi_tankos">Produksi Tankos (Kg)</label>
                    <input type="text" name="produksi_tankos" id="produksi_tankos"
                        class="form-control form-control-lg" value="@thousands($produksi_tankos)" readonly>
                </div>
                <div class="col-6 mt-3" x-data="{ value: @entangle('digunakan_sbg_pupuk_organik') }">
                    <label for="digunakan_sbg_pupuk_organik">Digunakan Sebagai Pupuk Organik (Kg)</label>
                    <input type="text" name="digunakan_sbg_pupuk_organik" id="digunakan_sbg_pupuk_organik"
                        class="form-control form-control-lg" wire:model='digunakan_sbg_pupuk_organik'
                        x-mask:dynamic="$money($input, ',')">
                </div>
                <div class="col-6 mt-3" x-data="{ value: @entangle('digunakan_u_pltbm') }">
                    <label for="digunakan_u_pltbm">Digunakan untuk PLTBM (Kg)</label>
                    <input type="text" name="digunakan_u_pltbm" id="digunakan_u_pltbm"
                        class="form-control form-control-lg" wire:model='digunakan_u_pltbm'
                        x-mask:dynamic="$money($input, ',')">
                </div>
                <div class="col-6 mt-3" x-data="{ value: @entangle('dikembalikan_ke_pemasok') }">
                    <label for="dikembalikan_ke_pemasok">Dikembalikan ke Pemasok (Kg)</label>
                    <input type="text" name="dikembalikan_ke_pemasok" id="dikembalikan_ke_pemasok"
                        class="form-control form-control-lg" wire:model='dikembalikan_ke_pemasok'
                        x-mask:dynamic="$money($input, ',')">
                </div>
                <div class="col-6 mt-3" x-data="{ value: @entangle('dibakar_di_tungku_bakar') }">
                    <label for="dibakar_di_tungku_bakar">Dibakar di Tungku Bakar (Kg)</label>
                    <input type="text" name="dibakar_di_tungku_bakar" id="dibakar_di_tungku_bakar"
                        class="form-control form-control-lg" wire:model='dibakar_di_tungku_bakar'
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
                <div class="col-6 mt-3" x-data="{ value: @entangle('diterima_dari_pks_lain') }">
                    <label for="diterima_dari_pks_lain">Diterima dari PKS Lain (Kg)</label>
                    <input type="text" name="diterima_dari_pks_lain" id="diterima_dari_pks_lain"
                        class="form-control form-control-lg" wire:model='diterima_dari_pks_lain'
                        x-mask:dynamic="$money($input, ',')">
                </div>
                <div class="col-6 mt-3" x-data="{ value: @entangle('volume_keperluan_lain') }">
                    <label for="volume_keperluan_lain">Volume Keperluan Lain (Kg)</label>
                    <input type="text" name="volume_keperluan_lain" id="volume_keperluan_lain"
                        class="form-control form-control-lg" wire:model='volume_keperluan_lain'
                        x-mask:dynamic="$money($input, ',')">
                </div>
                <div class="col-6 mt-3">
                    <label for="keterangan_do_pending">Keterangan DO Pending</label>
                    <input type="text" name="keterangan_do_pending" id="keterangan_do_pending"
                        class="form-control form-control-lg" wire:model='keterangan_do_pending'>
                </div>
                <div class="col-6 mt-3">
                    <label for="keterangan_keperluan_lain">Keterangan Keperluan Lain</label>
                    <input type="text" name="keterangan_keperluan_lain" id="keterangan_keperluan_lain"
                        class="form-control form-control-lg" wire:model='keterangan_keperluan_lain'>
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
                    @if ($id_data_tankos)
                        <div class="d-flex justify-content-start mt-2">
                            <img src="{{ asset('storage/' . $dataTankos->nama_file) }}" alt="Preview Gambar"
                                style="max-height: 300px; max-width: 300px;">
                        </div>
                    @endif
                @endif

                @error('photo')
                    <span class="error">{{ $message }}</span>
                @enderror
                @if ($isPeriodeOpen)
                    @if ($id_data_tankos)
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
