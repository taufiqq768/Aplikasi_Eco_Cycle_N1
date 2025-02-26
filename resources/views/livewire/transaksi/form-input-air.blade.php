<div>
    <div class="custom-loader-wrapper flex-center" wire:loading.flex>
        <div class="custom-loader"></div>
    </div>
    @if (!$isPeriodeOpen)
        <div class="alert alert-danger" role="alert">
            Periode Pengisian Data Belum Dibuka
        </div>
    @endif
    @if ($jenis == 'Air')
        <form wire:submit='submit' class="form" enctype="multipart/form-data" wire:key='{{ rand() }}'>
            <div class="row mt-4">
                <div class="col-6 mt-3">
                    <label for="pengolahan">Pengolahan</label>
                    <input type="text" name="pengolahan" id="pengolahan" class="form-control form-control-lg"
                        value="@thousands($pengolahan)" readonly>
                </div>
                <div class="col-6 mt-3">
                    <label for="teknik">Teknik</label>
                    <input type="text" name="teknik" id="teknik" class="form-control form-control-lg"
                        value="@thousands($teknik)" readonly>
                </div>
                <div class="col-6 mt-3">
                    <label for="laboratorium">Laboratorium</label>
                    <input type="text" name="laboratorium" id="laboratorium" class="form-control form-control-lg"
                        value="@thousands($laboratorium)" readonly>
                </div>
                <div class="col-6 mt-3">
                    <label for="perumahan">Perumahan</label>
                    <input type="text" name="perumahan" id="perumahan" class="form-control form-control-lg"
                        value="@thousands($perumahan)" readonly>
                </div>
                <div class="col-6 mt-3">
                    <label for="sarana_sosial">Sarana Sosial</label>
                    <input type="text" name="sarana_sosial" id="sarana_sosial" class="form-control form-control-lg"
                        value="@thousands($sarana_sosial)" readonly>
                </div>
                <div class="col-6 mt-3">
                    <label for="lain-lain">Lain-lain</label>
                    <input type="text" name="lain-lain" id="lain-lain" class="form-control form-control-lg"
                        value="@thousands($lain_lain)" readonly>
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
                    @if ($id_data_air)
                        <div class="d-flex justify-content-start mt-2">
                            <img src="{{ asset('storage/' . $dataAir->nama_file) }}" alt="Preview Gambar"
                                style="max-height: 300px; max-width: 300px;">
                        </div>
                    @endif
                @endif

                @error('photo')
                    <span class="error">{{ $message }}</span>
                @enderror
                @if ($isPeriodeOpen)
                    @if ($id_data_air)
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
    @endif
</div>
