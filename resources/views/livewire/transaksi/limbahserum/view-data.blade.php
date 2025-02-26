@use('Carbon\Carbon')
<div>
    <x-page-title title="Data Stok">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}" wire:navigate>Home</a></li>
            <li class="breadcrumb-item ">Master Data</li>
            <li class="breadcrumb-item active">Data Stok</li>
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
                            <h4 class="fs-16 mb-1">Limbah Serum</h4>
                            <p class="text-muted mb-0" id="tanggal">Produksi Limbah Serum s.d
                                {{ Carbon::createFromDate($tahun, $bulan, 1)->locale('id')->translatedFormat('F Y') }}
                            </p>
                            <div class="col-lg-3">
                                <div class=" mt-4">
                                    <input type="text" class="form-control" placeholder="Periode" id="datepicker-1"
                                        autocomplete="off" />
                                </div>

                            </div>
                        </div>
                        <div class="col-4 col-lg-5 position-relative d-sm-block d-none">
                            <img src="" alt=""
                                class="position-absolute" style="height: 20vh; right: 0; top: -11vh; z-index: 1;">
                        </div>
                        <div class="col-4 col-lg-5 position-relative d-sm-none d-block">
                            <img src="" alt=""
                                class="position-absolute" style="height: 15vh; right: -5vh; top: -8vh; z-index: 1;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <div class="nav nav-pills" id="nav2-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav2-home-tab" data-bs-toggle="tab" href="#nav2-home"
                        aria-selected="true" role="tab">s.d Bulan Ini</a>
                    <a class="nav-item nav-link" id="nav2-profile-tab" data-bs-toggle="tab" href="#nav2-profile"
                        aria-selected="false" tabindex="-1" role="tab">Bulan Ini</a>
                </div>
            </div>
            <div class="tab-content" id="nav2-tabContent">
                <div class="tab-pane fade show active" id="nav2-home" role="tabpanel" aria-labelledby="#nav2-home-tab">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="placeholder-glow phChart">
                                    <div class="placeholder col-12 mb-1"></div>
                                    <div class="placeholder col-12" style="padding-bottom: 150px"></div>
                                </div>
                                <div id="pattern_chart"
                                    data-colors='["--bs-primary", "--bs-info",  "--bs-warning", "--bs-danger",  "--bs-success"]'
                                    class="apex-chart" wire:ignore>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="placeholder-glow phChart">
                                    <div class="placeholder col-12 mb-1"></div>
                                    <div class="placeholder col-12" style="padding-bottom: 150px"></div>
                                </div>
                                <div id="chart_penjualan"
                                    data-colors='["--bs-primary", "--bs-info", "--bs-danger",  "--bs-warning",  "--bs-success"]'
                                    class="apex-chart" wire:ignore>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="placeholder-glow phScatter">
                                    <div class="placeholder col-12 mb-1"></div>
                                    <div class="placeholder col-12" style="padding-bottom: 150px"></div>
                                </div>
                                <div id="basic_scatter" data-colors='["--bs-primary", "--bs-success", "--bs-warning"]'
                                    class="apex-charts" dir="ltr" wire:ignore></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="card shadow-lg">
                            <div class="card-header">
                                <h5 class="mb-0 tanggal2" id="tanggal2">Sampai Dengan Bulan
                                    {{ Carbon::createFromDate($tahun, $bulan, 1)->locale('id')->translatedFormat('F Y') }}
                                </h5>
                            </div>
                            <div class="card-body" wire:ignore>

                                <table class="table table-hover table-bordered mb-0" id="tableLimbahserum"
                                    style="border: 0.5px solid rgba(128, 128, 128, 0.3); margin-bottom: 0px !important;">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th class="bg-primary-subtle text-center" rowspan="2">Region</th>
                                            <th class="bg-primary-subtle text-center" rowspan="2">Pabrik</th>
                                            <th class="bg-primary-subtle" rowspan="2">Produksi KAret diolah</th>
                                            <th class="bg-primary-subtle" rowspan="2">Produksi Limbah Serum</th>
                                            <th class="bg-primary-subtle" rowspan="2">% Limbah Serum<br>dr Produksi diolah
                                            </th>
                                            <th class="bg-primary-subtle" rowspan="2">Digunakan</th>
                                            <th class="bg-primary-subtle" rowspan="2">Dikirim</th>
                                            <th class="bg-primary-subtle" rowspan="2">Sisa Limbah Serum</th>
                                            <th class="bg-primary-subtle" colspan="2">Digunakan Untuk Keperluan
                                                Lain</th>
                                            <th class="bg-primary-subtle" rowspan="2">Dijual</th>
                                            <th class="bg-primary-subtle" rowspan="2">Harga Jual Rata-rata</th>
                                            <th class="bg-primary-subtle" rowspan="2">Pendapatan</th>
                                            <th class="bg-primary-subtle" rowspan="2">Stok Awal Tahun</th>
                                            <th class="bg-primary-subtle" rowspan="2">Sisa Stok Akhir</th>
                                        </tr>
                                        <tr class="text-center align-middle">
                                            <th class="bg-primary-subtle">Volume</th>
                                            <th class="bg-primary-subtle">Keperluan</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav2-profile" role="tabpanel" aria-labelledby="#nav2-profile-tab">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="placeholder-glow phChart">
                                    <div class="placeholder col-12 mb-1"></div>
                                    <div class="placeholder col-12" style="padding-bottom: 150px"></div>
                                </div>
                                <div id="pattern_chart_bi"
                                    data-colors='["--bs-primary", "--bs-info",  "--bs-warning", "--bs-danger",  "--bs-success"]'
                                    class="apex-chart" wire:ignore>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="placeholder-glow phChart">
                                    <div class="placeholder col-12 mb-1"></div>
                                    <div class="placeholder col-12" style="padding-bottom: 150px"></div>
                                </div>
                                <div id="chart_penjualan_bi"
                                    data-colors='["--bs-primary", "--bs-info", "--bs-danger",  "--bs-warning",  "--bs-success"]'
                                    class="apex-chart" wire:ignore>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="placeholder-glow phScatter">
                                    <div class="placeholder col-12 mb-1"></div>
                                    <div class="placeholder col-12" style="padding-bottom: 150px"></div>
                                </div>
                                <div id="basic_scatter_bi"
                                    data-colors='["--bs-primary", "--bs-success", "--bs-warning"]' class="apex-charts"
                                    dir="ltr" wire:ignore></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="card shadow-lg">
                            <div class="card-header">
                                <h5 class="mb-0 tanggal2" id="tanggal2">Bulan
                                    {{ Carbon::createFromDate($tahun, $bulan, 1)->locale('id')->translatedFormat('F Y') }}
                                </h5>
                            </div>
                            <div class="card-body" wire:ignore>

                                <table class="table table-hover table-bordered mb-0 w-100" id="tableLimbahserumBi"
                                    style="border: 0.5px solid rgba(128, 128, 128, 0.3); margin-bottom: 0px !important; ">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th class="bg-primary-subtle text-center" rowspan="2">Region</th>
                                            <th class="bg-primary-subtle text-center" rowspan="2">Pabrik</th>
                                            <th class="bg-primary-subtle" rowspan="2">Produksi Karet diolah</th>
                                            <th class="bg-primary-subtle" rowspan="2">Produksi Limbah Serum</th>
                                            <th class="bg-primary-subtle" rowspan="2">% Limbah Serum<br>dr Produksi diolah</th>
                                            <th class="bg-primary-subtle" rowspan="2">Digunakan</th>
                                            <th class="bg-primary-subtle" rowspan="2">Dikirim</th>
                                            <th class="bg-primary-subtle" rowspan="2">Sisa Limbah Serum</th>
                                            <th class="bg-primary-subtle" colspan="2">Digunakan Untuk Keperluan Lain</th>
                                            <th class="bg-primary-subtle" rowspan="2">Dijual</th>
                                            <th class="bg-primary-subtle" rowspan="2">Harga Jual Rata-rata</th>
                                            <th class="bg-primary-subtle" rowspan="2">Pendapatan</th>
                                            <th class="bg-primary-subtle" rowspan="2">Stok Awal Tahun</th>
                                        </tr>
                                        <tr class="text-center align-middle">
                                            <th class="bg-primary-subtle">Volume</th>
                                            <th class="bg-primary-subtle">Keperluan</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <livewire:modal.modal-log-sd-n1 />

    <script>
        var chart2 = null;
        var chartScatter = null;
        var chartScatterBi = null;
        var chartPenjualan = null;
        var chart2Bi = null;
        var chartPenjualanBi = null;

        $("#datepicker-1").datepicker({
            format: "mm/yyyy",
            startView: "months",
            minViewMode: "months",
            autoclose: !0
        }).on('changeDate', function(e) {
            var dateValue = $(this).val();
            var [month, year] = dateValue.split('/');
            // @this.set('tempPeriode', dateValue);
            tanggal = dateValue;
            bulan = month;
            tahun = year;
            $('#tanggal').text('Produksi Limbah Serum s.d ' + namaBulan[bulan] + " " + tahun);
            $('.tanggal2').text('Sampai Dengan Bulan ' + namaBulan[bulan] + " " + tahun);
            updateChartDataN1(bulan, tahun, 'limbah_serum');
        });
        updateChartDataN1({{ $bulan }}, {{ $tahun }}, 'limbah_serum');


        function openModal(kode, bulan, tahun) {
            $('#modalLogSdN1').modal('show');
            Livewire.dispatch('openModal', {
                kode: kode,
                bulan: bulan,
                tahun: tahun
            });
        }
    </script>
@endpush
