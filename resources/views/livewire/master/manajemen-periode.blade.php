<div>
    <x-page-title title="Periode">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
            <li class="breadcrumb-item ">Periode</li>
        </ol>
    </x-page-title>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Batas Tanggal Pengisian Saat Ini</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <h6>Tanggal Buka Pengisian: {{ $data->tanggal_buka }}</h6>
                            <div class="d-flex justify-content-start align-items-center">
                                <div>
                                    <h6 class="pe-3 mb-0">Tanggal Tutup Pengisian: </h6>
                                </div>
                                <div>
                                    <select class="form-control" wire:model='tanggal_tutup'>
                                        @for ($i = 1; $i <= 31; $i++)
                                            <option value="{{ $i }}"
                                                {{ $data->tanggal_tutup == $i ? 'selected' : '' }}>{{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <button type="button" wire:click='changeTanggal' class="btn btn-primary">Ubah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
