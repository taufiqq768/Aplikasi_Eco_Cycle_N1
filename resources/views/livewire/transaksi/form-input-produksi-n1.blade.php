@push('css')
    <style>
        label {
            font-weight: bold !important;
            font-size: 14px !important;
        }
    </style>
@endpush

<div>
    <div class="custom-loader-wrapper flex-center" wire:loading.flex>
        <div class="custom-loader"></div>
    </div>
    @if (!$isPeriodeOpen)
        <div class="alert alert-danger" role="alert">
            Periode Pengisian Data Belum Dibuka
        </div>
    @endif
    <form wire:submit.prevent='submit' class="form" enctype="multipart/form-data">
        <div class="row mt-4">
        
            <!-- TBS Olah -->
            <div class="col-6 mt-3" x-data="{ value: @entangle('tbs') }">
                <label for="tbs">Produksi diolah (Kg)</label>
                <input type="text" name="tbs" id="tbs" class="form-control form-control-lg" x-model="value"
                    x-mask:dynamic="$money($input, ',')">
            </div>

            <div class="col-6 mt-3" >
            </div>

        </div>
        
<!-- PTPN1 -->
        <div class="row mt-4">
        
            <!-- Produksi Tea Waste -->
            <div class="col-6 mt-3" x-data="{ value: @entangle('tea_waste') }">
                <label for="tea_waste">Produksi Tea Waste (Kg)</label>
                <input type="text" name="tea_waste" id="tea_waste" class="form-control form-control-lg" x-model="value"
                    x-mask:dynamic="$money($input, ',')">
            </div>

            <!-- Produksi Abu HE -->
            <div class="col-6 mt-3" x-data="{ value: @entangle('abu_he') }">
                <label for="abu_he">Produksi Abu HE (Kg)</label>
                <input type="text" name="abu_he" id="abu_he" class="form-control form-control-lg" x-model="value"
                    x-mask:dynamic="$money($input, ',')">
            </div>

            <div class="col-6 mt-3" >
            </div>
        </div>
        <div class="row mt-4">
            <!-- Produksi Tunggul Karet -->
            <div class="col-6 mt-3" x-data="{ value: @entangle('tunggul_karet') }">
                <label for="tunggul_karet">Produksi Tunggul Karet (Kg)</label>
                <input type="text" name="tunggul_karet" id="tunggul_karet" class="form-control form-control-lg" x-model="value"
                    x-mask:dynamic="$money($input, ',')">
            </div>

            <!-- Produksi Limbah Serum -->
            <div class="col-6 mt-3" x-data="{ value: @entangle('limbah_serum') }">
                <label for="limbah_serum">Produksi Limbah Serum (Kg)</label>
                <input type="text" name="limbah_serum" id="limbah_serum" class="form-control form-control-lg" x-model="value"
                    x-mask:dynamic="$money($input, ',')">
            </div>

            <!-- Produksi Abu -->
            <div class="col-6 mt-3" x-data="{ value: @entangle('abu') }">
                <label for="abu">Produksi Abu (Kg)</label>
                <input type="text" name="abu" id="abu" class="form-control form-control-lg" x-model="value"
                    x-mask:dynamic="$money($input, ',')">
            </div>

            <!-- Produksi Ranting -->
            <div class="col-6 mt-3" x-data="{ value: @entangle('ranting') }">
                <label for="ranting">Produksi Ranting (Kg)</label>
                <input type="text" name="ranting" id="ranting" class="form-control form-control-lg" x-model="value"
                    x-mask:dynamic="$money($input, ',')">
            </div>

            <!-- Produksi Batang kayu -->
            <div class="col-6 mt-3" x-data="{ value: @entangle('batang_kayu') }">
                <label for="batang_kayu">Produksi Batang Kayu (Kg)</label>
                <input type="text" name="batang_kayu" id="batang_kayu" class="form-control form-control-lg" x-model="value"
                    x-mask:dynamic="$money($input, ',')">
            </div>            

        </div>
        <div class="row mt-4">        
            <!-- Produksi Kulit Buah -->
            <div class="col-6 mt-3" x-data="{ value: @entangle('kulit_buah') }">
                <label for="kulit_buah">Produksi Kulit Buah (Kg)</label>
                <input type="text" name="kulit_buah" id="kulit_buah" class="form-control form-control-lg" x-model="value"
                    x-mask:dynamic="$money($input, ',')">
            </div>            

            <!-- Produksi Husk Skin -->
            <div class="col-6 mt-3" x-data="{ value: @entangle('husk_skin') }">
                <label for="husk_skin">Produksi Husk Skin (Kg)</label>
                <input type="text" name="husk_skin" id="husk_skin" class="form-control form-control-lg" x-model="value"
                    x-mask:dynamic="$money($input, ',')">
            </div>            

            <!-- Produksi Mucilage -->
            <div class="col-6 mt-3" x-data="{ value: @entangle('mucilage') }">
                <label for="mucilage">Produksi Mucilage (Kg)</label>
                <input type="text" name="mucilage" id="mucilage" class="form-control form-control-lg" x-model="value"
                    x-mask:dynamic="$money($input, ',')">
            </div>            

            <div class="col-6 mt-3" >
            </div>

            <!-- Upload Gambar -->
            <div class="col-6 mt-3">
                <label for="photo">Upload Gambar / Update Gambar</label>
                <input type="file" id="photo" wire:model="photo" accept="image/*">
            </div>
        </div>
        <div class="row mt-4">        

            @if ($photo)
                <div class="d-flex justify-content-start mt-2">
                    <img src="{{ $photo->temporaryUrl() }}" alt="Preview Gambar"
                        style="max-height: 300px; max-width: 300px;">
                </div>
            @else
                @if ($dataProduksi)
                    <div class="d-flex justify-content-start mt-2">
                        <img src="{{ asset('storage/' . $dataProduksi->nama_file) }}" alt="Preview Gambar"
                            style="max-height: 300px; max-width: 300px;">
                    </div>
                @endif
            @endif

            @error('photo')
                <span class="error">{{ $message }}</span>
            @enderror
            @if ($isPeriodeOpen)
                @if ($dataProduksi)
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
</div>
