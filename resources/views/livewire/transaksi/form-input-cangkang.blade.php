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
                <div class="col-6 mt-3" x-data="{ value: @entangle('produksi_cangkang') }">
                    <label for="produksi_cangkang">Jumlah Produksi Cangkang (Kg)</label>
                    <input type="text" name="produksi_cangkang" id="produksi_cangkang" value="@thousands($produksi_cangkang)"
                        class="form-control form-control-lg" readonly>
                </div>
                <div class="col-6 mt-3" x-data="{ value: @entangle('digunakan_u_bahan_bakar') }">
                    <label for="bahan_bakar">Digunakan Untuk Bahan Bakar (Kg)</label>
                    <input type="text" name="bahan_bakar" id="bahan_bakar" class="form-control form-control-lg"
                        wire:model='digunakan_u_bahan_bakar' x-mask:dynamic="$money($input, ',')">
                </div>
                <div class="col-6 mt-3" x-data="{ value: @entangle('dikirim_ke_pabrik_teh') }">
                    <label for="dikirim_ke_pabrik_teh">Dikirim ke Pabrik Teh (Kg)</label>
                    <input type="text" name="dikirim_ke_pabrik_teh" id="dikirim_ke_pabrik_teh"
                        class="form-control form-control-lg" wire:model='dikirim_ke_pabrik_teh'
                        x-mask:dynamic="$money($input, ',')">
                </div>
                <div class="col-6 mt-3" x-data="{ value: @entangle('dikirim_ke_pabrik_karet') }">
                    <label for="dikirim_ke_pabrik_karet">Dikirim ke Pabrik Karet (Kg)</label>
                    <input type="text" name="dikirim_ke_pabrik_karet" id="dikirim_ke_pabrik_karet"
                        class="form-control form-control-lg" wire:model='dikirim_ke_pabrik_karet'
                        x-mask:dynamic="$money($input, ',')">
                </div>
                <div class="col-6 mt-3" x-data="{ value: @entangle('dikirim_ke_pabrik_gula') }">
                    <label for="dikirim_ke_pabrik_gula">Dikirim ke Pabrik Gula (Kg)</label>
                    <input type="text" name="dikirim_ke_pabrik_gula" id="dikirim_ke_pabrik_gula"
                        class="form-control form-control-lg" wire:model='dikirim_ke_pabrik_gula'
                        x-mask:dynamic="$money($input, ',')">
                </div>
                <div class="col-6 mt-3" x-data="{ value: @entangle('dikirim_ke_bibitan_kelapa_sawit') }">
                    <label for="dikirim_ke_bibitan_kelapa_sawit">Dikirim ke Bibitan Kelapa Sawit (Kg)</label>
                    <input type="text" name="dikirim_ke_bibitan_kelapa_sawit" id="dikirim_ke_bibitan_kelapa_sawit"
                        class="form-control form-control-lg" wire:model='dikirim_ke_bibitan_kelapa_sawit'
                        x-mask:dynamic="$money($input, ',')">
                </div>
                <div class="col-6 mt-3" x-data="{ value: @entangle('dikirim_ke_pks_lain') }">
                    <label for="dikirim_ke_pks_lain">Dikirim ke PKS Lain (Kg)</label>
                    <input type="text" name="dikirim_ke_pks_lain" id="dikirim_ke_pks_lain"
                        class="form-control form-control-lg" wire:model='dikirim_ke_pks_lain'
                        x-mask:dynamic="$money($input, ',')">
                </div>
                <div class="col-6 mt-3" x-data="{ value: @entangle('dijual') }">
                    <label for="dijual">Dijual (Kg)</label>
                    <input type="text" name="dijual" id="dijual" class="form-control form-control-lg"
                        wire:model='dijual' x-mask:dynamic="$money($input, ',')">
                </div>
                <div class="col-6 mt-3" x-data="{ value: @entangle('diterima_dari_pks_lain') }">
                    <label for="diterima_dari_pks_lain">Diterima dari PKS Lain (Kg)</label>
                    <input type="text" name="diterima_dari_pks_lain" id="diterima_dari_pks_lain"
                        class="form-control form-control-lg" wire:model='diterima_dari_pks_lain'
                        x-mask:dynamic="$money($input, ',')">
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
                    <label for="keterangan_do_pending">Keterangan DO Pending</label>
                    <input type="text" name="keterangan_do_pending" id="keterangan_do_pending"
                        class="form-control form-control-lg" wire:model='keterangan_do_pending'>
                </div>
                <div class="col-6 mt-3">
                    <label for="keterangan_keperluan_lain">Keterangan Keperluan Lain</label>
                    <input type="text" name="keterangan_keperluan_lain" id="keterangan_keperluan_lain"
                        class="form-control form-control-lg" wire:model='keterangan_keperluan_lain'>
                </div>
                <hr class="mt-3">
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
                    @if ($id_data_cangkang)
                        <div class="d-flex justify-content-start mt-2">
                            <img src="{{ asset('storage/' . $dataCangkang->nama_file) }}" alt="Preview Gambar"
                                style="max-height: 300px; max-width: 300px;">
                        </div>
                    @endif
                @endif

                @error('photo')
                    <span class="error">{{ $message }}</span>
                @enderror
                @if ($isPeriodeOpen)
                    @if ($id_data_cangkang)
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
