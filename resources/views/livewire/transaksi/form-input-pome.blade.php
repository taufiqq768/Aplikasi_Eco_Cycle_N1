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
                    <label for="produksi_pome_oil">Produksi Pome Oil (M3)</label>
                    <input type="text" name="produksi_pome_oil" id="produksi_pome_oil"
                        class="form-control form-control-lg" value="@thousands($produksi_pome_oil)" readonly>
                </div>
                <div class="col-6 mt-3" x-data="{ value: @entangle('digunakan_biogas_pks') }">
                    <label for="digunakan_biogas_pks">Digunakan Untuk Biogas PKS (M3)</label>
                    <input type="text" name="digunakan_biogas_pks" id="digunakan_biogas_pks"
                        class="form-control form-control-lg" wire:model='digunakan_biogas_pks'
                        x-mask:dynamic="$money($input, ',')">
                </div>
                <div class="col-6 mt-3" x-data="{ value: @entangle('dikirim_kebun_u_land_aplikasi') }">
                    <label for="dikirim_kebun_u_land_aplikasi">Dikirim Kebun U Land Aplikasi (M3)</label>
                    <input type="text" name="dikirim_kebun_u_land_aplikasi" id="dikirim_kebun_u_land_aplikasi"
                        class="form-control form-control-lg" wire:model='dikirim_kebun_u_land_aplikasi'
                        x-mask:dynamic="$money($input, ',')">
                </div>
                <div class="col-6 mt-3" x-data="{ value: @entangle('dibuang_ke_aliran_sungai') }">
                    <label for="dibuang_ke_aliran_sungai">Dibuang ke Aliran Sungai (M3)</label>
                    <input type="text" name="dibuang_ke_aliran_sungai" id="dibuang_ke_aliran_sungai"
                        class="form-control form-control-lg" wire:model='dibuang_ke_aliran_sungai'
                        x-mask:dynamic="$money($input, ',')">
                </div>
                <div class="col-6 mt-3" x-data="{ value: @entangle('potensi_pome_oil') }">
                    <label for="potensi_pome_oil">Potensi Pome Oil (Kg)</label>
                    <input type="text" name="potensi_pome_oil" id="potensi_pome_oil"
                        class="form-control form-control-lg" wire:model='potensi_pome_oil'
                        x-mask:dynamic="$money($input, ',')">
                </div>
                <div class="col-6 mt-3" x-data="{ value: @entangle('pome_oil_dikutip') }">
                    <label for="pome_oil_dikutip">Pome Oil Dikutip (Kg)</label>
                    <input type="text" name="pome_oil_dikutip" id="pome_oil_dikutip"
                        class="form-control form-control-lg" wire:model='pome_oil_dikutip'
                        x-mask:dynamic="$money($input, ',')">
                </div>
                <div class="col-6 mt-3" x-data="{ value: @entangle('pome_oil_terkutip_diolah_kembali') }">
                    <label for="pome_oil_terkutip_diolah_kembali">Pome Oil Terkutip Diolah Kembali (Kg)</label>
                    <input type="text" name="pome_oil_terkutip_diolah_kembali" id="pome_oil_terkutip_diolah_kembali"
                        class="form-control form-control-lg" wire:model='pome_oil_terkutip_diolah_kembali'
                        x-mask:dynamic="$money($input, ',')">
                </div>
                <div class="col-6 mt-3" x-data="{ value: @entangle('pome_oil_terkutip_dikirim_pks_lain') }">
                    <label for="pome_oil_terkutip_dikirim_pks_lain">Pome Oil Terkutip Dikirim PKS Lain (Kg)</label>
                    <input type="text" name="pome_oil_terkutip_dikirim_pks_lain"
                        id="pome_oil_terkutip_dikirim_pks_lain" class="form-control form-control-lg"
                        wire:model='pome_oil_terkutip_dikirim_pks_lain' x-mask:dynamic="$money($input, ',')">
                </div>
                <div class="col-6 mt-3" x-data="{ value: @entangle('pome_oil_terkutip_dijual') }">
                    <label for="pome_oil_terkutip_dijual">Pome Oil Terkutip Dijual (Kg)</label>
                    <input type="text" name="pome_oil_terkutip_dijual" id="pome_oil_terkutip_dijual"
                        class="form-control form-control-lg" wire:model='pome_oil_terkutip_dijual'
                        x-mask:dynamic="$money($input, ',')">
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
                <div class="col-12 mt-3">
                    <label for="photo">Upload Gambar / Update Gambar</label>
                    <input type="file" id="photo" wire:model="photo" accept="image/*">
                </div>

                @if ($photo)
                    <div class="d-flex justify-content-start mt-2">
                        <img src="{{ $photo->temporaryUrl() }}" alt="Preview Gambar"
                            style="max-height: 300px; max-width: 300px;">
                    </div>
                @else
                    @if ($id_data_pome_oil)
                        <div class="d-flex justify-content-start mt-2">
                            <img src="{{ asset('storage/' . $dataPomeOil->nama_file) }}" alt="Preview Gambar"
                                style="max-height: 300px; max-width: 300px;">
                        </div>
                    @endif
                @endif

                @error('photo')
                    <span class="error">{{ $message }}</span>
                @enderror
                @if ($isPeriodeOpen)
                    @if ($id_data_pome_oil)
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
