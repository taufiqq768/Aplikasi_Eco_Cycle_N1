<div>
    <div class="custom-loader-wrapper flex-center" wire:loading.flex>
        <div class="custom-loader"></div>
    </div>
    <x-page-title title="Harga Standart">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
            <li class="breadcrumb-item ">Harga Standart</li>
        </ol>
    </x-page-title>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h5 class="my-2">Manajemen Harga Standart</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex mb-3 justify-content-end">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreateHarga">+
                            Tambah
                            Data</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-secondary">
                                <tr class="text-center">
                                    <th>Tahun</th>
                                    <th>Kategori</th>
                                    <th>Harga (Rp/Kg)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($masterHarga as $harga)
                                    <tr class="text-center">
                                        <td>{{ $harga->tahun }}</td>
                                        <td>{{ $harga->kategori }}</td>
                                        <td>{{ $harga->harga_per_kg }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-warning"
                                                @click="editData('{{ $harga->tahun }}', '{{ $harga->kategori }}', '{{ $harga->harga_per_kg }}')">Edit</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <livewire:master.modal.modal-create-master-harga />
    <script>
        function editData(tahun, kategori, harga) {
            Livewire.dispatch('editData', {
                tahun: tahun,
                kategori: kategori,
                harga: harga
            });
        }
    </script>
@endpush
