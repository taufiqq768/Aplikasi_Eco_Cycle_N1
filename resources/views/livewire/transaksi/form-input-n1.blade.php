 <div>
    <div class="custom-loader-wrapper flex-center" wire:loading.flex wire:target='setData'>
        <div class="custom-loader"></div>
    </div>
    <x-page-title title="Transaksi">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
            <li class="breadcrumb-item ">Transaksi</li>
        </ol>
    </x-page-title>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card shadow-lg"
                style="background: url('{{ asset('assets/images/3d assets/Pattern2.png') }}'); background-position: center; background-repeat: no-repeat; background-size: cover; overflow: visible;">
                <div class="bg-overlay bg-primary-subtle rounded"></div>
                <div class="card-body position-relative">
                    <div class="row align-items-center">
                        <div class="col-8 col-lg-7">
                            <h4 class="fs-16 mb-1">Form Pengisian Data Limbah PTPN 1</h4>
                            <p class="text-muted mb-0">Silahkan Pilih Jenis Transaksi Terlebih Dahulu</p>
                            <div class="d-flex">
                                <div class="me-2 mt-4">
                                    <input type="text" class="form-control" placeholder="Periode"
                                        wire:model="periode" id="datepicker-1" autocomplete="off" />
                                </div>
                                <div class="me-2 mt-4">
                                    <select name="jenis" id="jenis" class="form-select">
                                        <option value="" selected>Jenis Transaksi</option>
                                        @foreach ($jenisList as $list)
                                            <option value="{{ $list->value }}">{{ $list->value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="me-2 mt-4" wire:ignore.self>
                                    <select name="unit" id="unit" class="form-select select2">
                                        <option value="" selected>Pilih Pabrik&nbsp;&nbsp;</option>
                                        @foreach ($allUnit as $unitItem)
                                            <option value="{{ $unitItem->kode_unit }}">{{ $unitItem->nama_unit }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button class="btn btn-primary mt-4" type="button" @click='setData'>
                                    <span><i class="fas fa-search"></i></span> Cari
                                </button>
                            </div>
                        </div>
                        <div class="col-4 col-lg-5 position-relative d-sm-block d-none">
                            <img src="{{ asset('assets/images/3d assets/Form Icon 3D 2.png') }}" alt=""
                                class="position-absolute" style="height: 20vh; right: 0; top: -11vh; z-index: 1;">
                        </div>
                        <div class="col-4 col-lg-5 position-relative d-sm-none d-block">
                            <img src="{{ asset('assets/images/3d assets/Form Icon 3D 2.png') }}" alt=""
                                class="position-absolute" style="height: 15vh; right: -5vh; top: -8vh; z-index: 1;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <livewire:transaksi.form-input-container-n1/>

    </div>
</div>

@push('js')
    <script>
        let tanggal;
        let jenis;
        let unit;
        let select2Initialized = false;
        Livewire.on('jsInit', function() {
            $("#datepicker-1").datepicker({
                format: "mm/yyyy",
                startView: "months",
                minViewMode: "months",
                autoclose: true,
                startDate: '-1m',
                endDate: '-1m'
            }).on('changeDate', function(e) {
                var dateValue = $(this).val();
                // @this.set('tempPeriode', dateValue);
                tanggal = dateValue;
            });

            $('.select2').select2({
                dropdownAutoWidth: true
            }).on('change', function(e) {
                // let selectedValue = $(this).val();
                // Livewire.dispatch('selectChanged', {
                //     'value': selectedValue
                // });
                unit = $(this).val();
            });
            // $('.select2').select2({
            //     dropdownAutoWidth: true,
            // }).on('change', function(e) {
            //     let selectedValue = $(this).val();
            //     Livewire.dispatch('selectChanged', {
            //         'value': selectedValue
            //     });
            // });
        });

        function setData() {
            jenis = $('#jenis').val();
            if (jenis && tanggal && unit) {
                Livewire.dispatch('setData', {
                    'tanggal': tanggal,
                    'jenis': jenis,
                    'unit': unit
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Silahkan pilih Periode/Jenis/Unit terlebih dahulu',
                });
            }
        }
    </script>
@endpush
