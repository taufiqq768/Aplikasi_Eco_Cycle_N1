@use(Carbon\Carbon)
@use(App\Enum\UserRoleEnum)
<div>
    <x-page-title title="Dashboard">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard-n1.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </x-page-title>


    <div class="row">
        <div class="col-12 mt-3">
            <div class="card shadow-lg"
                style="background: url('{{ asset('assets/images/3d assets/Pattern2.png') }}'); background-position: center; background-repeat: no-repeat; background-size: cover; overflow: visible;">
                <div class="bg-overlay bg-primary-subtle rounded"></div>
                <div class="card-body position-relative">
                    <div class="row align-items-center">
                        <div class="col-8 col-lg-7" wire:ignore>
                            <h4 class="fs-16 mb-1">Dashboard Eco Cycle</h4>
                            <p class="text-muted mb-0" id="tanggal">Periode
                                {{ Carbon::createFromDate($tahun, $bulan, 1)->locale('id')->translatedFormat('F Y') }}
                            </p>
                            <div class="col-lg-3">
                                <div class=" mt-4">
                                    <input type="text" class="form-control" placeholder="Periode"
                                        wire:model="periode" id="datepicker-1" autocomplete="off" />
                                </div>

                            </div>
                        </div>
                        <div class="col-4 col-lg-5 position-relative d-sm-block d-none">
                            <img src="{{ asset('assets/images/3d assets/Perkebunan Nusantara white.png') }}"
                                alt="" class="position-absolute"
                                style="max-height: 20vh; right: 0; top: -10vh; z-index: 1;">
                        </div>
                        <div class="col-4 col-lg-5 position-relative d-sm-none d-block">
                            <img src="{{ asset('assets/images/3d assets/Perkebunan Nusantara white.png') }}"
                                alt="" class="position-absolute"
                                style="max-height: 15vh; right: -5vh; top: -8vh; z-index: 1;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="mb-3">
                <div class="nav nav-pills" id="nav2-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav2-home-tab" data-bs-toggle="tab" href="#nav2-home"
                        aria-selected="true" role="tab">Data Limbah PTPN 1 s.d BI</a>
                    <a class="nav-item nav-link" id="nav4-tab" data-bs-toggle="tab" href="#nav4" aria-selected="true"
                        role="tab">Data Limbah PTPN 1 BI</a>
                    <a class="nav-item nav-link" id="nav2-profile-tab" data-bs-toggle="tab" href="#nav2-profile"
                        aria-selected="false" tabindex="-1" role="tab">Data Pemakaian Sumber Daya</a>
                </div>
            </div>
            <div class="tab-content" id="nav2-tabContent">
                <div class="tab-pane fade show active" id="nav2-home" role="tabpanel" aria-labelledby="#nav2-home-tab">
                    <div class="row">
                        <div class="col-xxl-9">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body" style="min-height: 200px">
                                        <div class="placeholder-glow" id="ph-chart1">
                                            <div class="placeholder col-4 mb-1"></div>
                                            <div class="placeholder col-6 mb-1"></div>
                                            <div class="placeholder col-12 mb-1"></div>
                                            <div class="placeholder col-12 py-5"></div>
                                        </div>
                                        <div id="line_column_chart" data-colors='[ "#7FFF7F", "#228B22",  "#004d00"]'
                                            wire:ignore class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body" style="min-height: 200px">
                                        <div class="placeholder-glow" id="ph-chart2">
                                            <div class="placeholder col-12 mb-1"></div>
                                            <div class="placeholder col-12 mb-1"></div>
                                            <div class="placeholder col-12 py-5"></div>
                                        </div>
                                        <div id="column_chart_stok"
                                            data-colors='["#E0FFE0", "#7FFF7F", "#228B22", "#004d00"]'
                                            class="apex-charts" dir="ltr" wire:ignore></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-xxl-3">
                            <div class="row">
                                <div class="col-xxl-12 col-xl-6 order-1">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="placeholder-glow" id="ph-piechart">
                                                <div class="placeholder col-12 mb-1"></div>
                                                <div class="placeholder col-12 py-5"></div>
                                            </div>
                                            <div id="pattern_chart"
                                                    data-colors='["#81ce00", "#90EE90", "#ADD8E6", "#ffcc00", "#ff66cc", "#663399", "#ff6600", "#66cc99", "#f1f7a9", "#3399ff"]'
                                                    class="apex-charts" dir="ltr" wire:ignore></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xxl-12 col-xl-6 order-1">
                                    <div class="card">
                                        <div class="card-body px-0">
                                            <div class="placeholder-glow px-3" id="ph-barchart">
                                                <div class="placeholder col-12 mb-1"></div>
                                                <div class="placeholder col-12 py-5"></div>
                                            </div>
                                            <div id="stacked_bar_100"
                                                    data-colors='["#81ce00", "#00fff0", "#90EE90", "#ffcc00", "#ff66cc", "#663399", "#ff6600", "#66cc99", "#f1f7a9", "#3399ff"]'
                                                    class="apex-charts" dir="ltr" wire:ignore></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0"> <span><i class="fas fa-warehouse"></i></span> Rekap
                                            Stok
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered"
                                                style="border: 0.5px solid rgba(128, 128, 128, 0.3);">
                                                <thead>
                                                    <tr class="text-center align-middle">
                                                        <th class="bg-primary-subtle" rowspan="2">#</th>
                                                        <th class="bg-primary-subtle" rowspan="2">Regional</th>
                                                        <th class="bg-primary-subtle" colspan="10">Stok (Ton)</th>
                                                    </tr>
                                                    <tr class="text-center">
                                                        <th class="bg-primary-subtle">Tea Waste</th>
                                                        <th class="bg-primary-subtle">Abu HE</th>
                                                        <th class="bg-primary-subtle">Limbah Serum</th>
                                                        <th class="bg-primary-subtle">Tunggul Karet</th>
                                                        <th class="bg-primary-subtle">Abu</th>
                                                        <th class="bg-primary-subtle">Ranting</th>
                                                        <th class="bg-primary-subtle">Batang Kayu</th>
                                                        <th class="bg-primary-subtle">Kulit Buah</th>
                                                        <th class="bg-primary-subtle">Husk Skin</th>
                                                        <th class="bg-primary-subtle">Mucilage</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($dataStock as $key => $stok)
                                                        <tr class="text-center">
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $stok->nama }}</td>
                                                            <td>@ton($stok->sisa_tea_waste)</td>
                                                            <td>@ton($stok->sisa_abu_he)</td>
                                                            <td>@ton($stok->sisa_limbah_serum)</td>
                                                            <td>@ton($stok->sisa_tunggul_karet)</td>
                                                            <td>@ton($stok->sisa_abu)</td>
                                                            <td>@ton($stok->sisa_ranting)</td>
                                                            <td>@ton($stok->sisa_batang_kayu)</td>
                                                            <td>@ton($stok->sisa_kulit_buah)</td>
                                                            <td>@ton($stok->sisa_husk_skin)</td>
                                                            <td>@ton($stok->sisa_mucilage)</td>
                                                        </tr>
                                                    @endforeach
                                                    <tr class="text-center">
                                                        <th class="bg-primary-subtle" colspan="2">Total</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->sisaAllTeaWaste)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->sisaAllAbuHe)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->sisaAllLimbahSerum)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->sisaAllTunggulKaret)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->sisaAllAbu)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->sisaAllRanting)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->sisaAllBatangKayu)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->sisaAllKulitBuah)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->sisaAllHuskSkin)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->sisaAllMucilage)</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0"> <span><i class="fas fa-coins"></i></span> Rekap
                                            Pendapatan
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered" id="tablePendapatan"
                                                style="border: 0.5px solid rgba(128, 128, 128, 0.3);">
                                                <thead>
                                                    <tr class="text-center align-middle">
                                                        <th rowspan="2" class="bg-primary-subtle">#</th>
                                                        <th rowspan="2" class="bg-primary-subtle">Regional</th>
                                                        <th colspan="11" class="bg-primary-subtle">Pendapatan (Rp)
                                                        </th>
                                                    </tr>
                                                    <tr class="text-center align-middle">
                                                        <th class="bg-primary-subtle">Tea Waste</th>
                                                        <th class="bg-primary-subtle">Abu HE</th>
                                                        <th class="bg-primary-subtle">Limbah Serum</th>
                                                        <th class="bg-primary-subtle">Tunggul Karet</th>
                                                        <th class="bg-primary-subtle">Abu</th>
                                                        <th class="bg-primary-subtle">Ranting</th>
                                                        <th class="bg-primary-subtle">Batang Kayu</th>
                                                        <th class="bg-primary-subtle">Kulit Buah</th>
                                                        <th class="bg-primary-subtle">Husk Skin</th>
                                                        <th class="bg-primary-subtle">Mucilage</th>
                                                        <th class="bg-primary-subtle">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $subTotalTeaWaste = 0;
                                                        $subTotalAbuHe = 0;
                                                        $subTotalLimbahSerum = 0;
                                                        $subTotalTunggulKaret = 0;
                                                        $subTotalAbu = 0;
                                                        $subTotalRanting = 0;
                                                        $subTotalBatangKayu = 0;
                                                        $subTotalKulitBuah = 0;
                                                        $subTotalHuskSkin = 0;
                                                        $subTotalMucilage = 0;
                                                        $subTotalAll = 0;

                                                    @endphp
                                                    @foreach ($dataStock as $key => $pendapatan)
                                                        @php
                                                            $subTotalTeaWaste += $pendapatan->pendapatan_tea_waste;
                                                            $subTotalAbuHe += $pendapatan->pendapatan_abu_he;
                                                            $subTotalLimbahSerum += $pendapatan->pendapatan_limbah_serum;
                                                            $subTotalTunggulKaret += $pendapatan->pendapatan_tunggul_karet;
                                                            $subTotalAbu += $pendapatan->pendapatan_abu;
                                                            $subTotalRanting += $pendapatan->pendapatan_ranting;
                                                            $subTotalBatangKayu += $pendapatan->pendapatan_batang_kayu;
                                                            $subTotalKulitBuah += $pendapatan->pendapatan_kulit_buah;
                                                            $subTotalHuskSkin += $pendapatan->pendapatan_husk_skin;
                                                            $subTotalMucilage += $pendapatan->pendapatan_mucilage;
                                                            $subTotalAll +=
                                                                $pendapatan->pendapatan_tea_waste 
                                                                + $pendapatan->pendapatan_abu_he 
                                                                + $pendapatan->pendapatan_limbah_serum 
                                                                + $pendapatan->pendapatan_tunggul_karet 
                                                                + $pendapatan->pendapatan_abu 
                                                                + $pendapatan->pendapatan_ranting 
                                                                + $pendapatan->pendapatan_batang_kayu 
                                                                + $pendapatan->pendapatan_kulit_buah 
                                                                + $pendapatan->pendapatan_husk_skin 
                                                                + $pendapatan->pendapatan_mucilage;
                                                        @endphp
                                                        <tr class="text-center">
                                                            <td>{{ $key + 1 }}</td>
                                                            <td class="text-start text-nowrap">
                                                                {{ $pendapatan->nama }}
                                                            </td>
                                                            <td>@thousands($pendapatan->pendapatan_tea_waste)</td>
                                                            <td>@thousands($pendapatan->pendapatan_abu_he)</td>
                                                            <td>@thousands($pendapatan->pendapatan_limbah_serum)</td>
                                                            <td>@thousands($pendapatan->pendapatan_tunggul_karet)</td>
                                                            <td>@thousands($pendapatan->pendapatan_abu)</td>
                                                            <td>@thousands($pendapatan->pendapatan_ranting)</td>
                                                            <td>@thousands($pendapatan->pendapatan_batang_kayu)</td>
                                                            <td>@thousands($pendapatan->pendapatan_kulit_buah)</td>
                                                            <td>@thousands($pendapatan->pendapatan_husk_skin)</td>
                                                            <td>@thousands($pendapatan->pendapatan_mucilage)</td>
                                                            <td>@thousands($pendapatan->pendapatan_tea_waste 
                                                                + $pendapatan->pendapatan_tea_waste
                                                                + $pendapatan->pendapatan_abu_he
                                                                + $pendapatan->pendapatan_limbah_serum
                                                                + $pendapatan->pendapatan_tunggul_karet
                                                                + $pendapatan->pendapatan_abu
                                                                + $pendapatan->pendapatan_ranting
                                                                + $pendapatan->pendapatan_batang_kayu
                                                                + $pendapatan->pendapatan_kulit_buah
                                                                + $pendapatan->pendapatan_husk_skin
                                                                + $pendapatan->pendapatan_mucilage)</td>
                                                        </tr>
                                                        @if (in_array(auth()->user()->role, [
                                                                UserRoleEnum::SUPER_ADMIN,
                                                                UserRoleEnum::ADMIN_SUB_HOLDING,
                                                                UserRoleEnum::ADMIN_HOLDING,
                                                            ]))
                                                            @if ($loop->last)
                                                                <tr class="text-center">
                                                                    <th class="bg-primary-subtle" colspan="2">Total
                                                                        KSO
                                                                    </th>
                                                                    <th class="bg-primary-subtle">@thousands($subTotalTeaWaste)
                                                                    </th>
                                                                    <th class="bg-primary-subtle">@thousands($subTotalAbuHe)
                                                                    </th>
                                                                    <th class="bg-primary-subtle">@thousands($subTotalLimbahSerum)
                                                                    </th>
                                                                    <th class="bg-primary-subtle">@thousands($subTotalTunggulKaret)
                                                                    </th>
                                                                    <th class="bg-primary-subtle">@thousands($subTotalAbu)
                                                                    </th>
                                                                    <th class="bg-primary-subtle">@thousands($subTotalRanting)
                                                                    </th>
                                                                    <th class="bg-primary-subtle">@thousands($subTotalBatangKayu)
                                                                    </th>
                                                                    <th class="bg-primary-subtle">@thousands($subTotalKulitBuah)
                                                                    </th>
                                                                    <th class="bg-primary-subtle">@thousands($subTotalHuskSkin)
                                                                    </th>
                                                                    <th class="bg-primary-subtle">@thousands($subTotalMucilage)
                                                                    </th>
                                                                    <th class="bg-primary-subtle">@thousands($subTotalAll)
                                                                    </th>
                                                                </tr>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                    <tr class="text-center">
                                                        @if (in_array(auth()->user()->role, [
                                                                UserRoleEnum::SUPER_ADMIN,
                                                                UserRoleEnum::ADMIN_SUB_HOLDING,
                                                                UserRoleEnum::ADMIN_HOLDING,
                                                            ]))
                                                            <th class="bg-primary-subtle" colspan="2">Total Non KSO
                                                                +
                                                                KSO</th>
                                                        @else
                                                            <th class="bg-primary-subtle" colspan="2">Total</th>
                                                        @endif
                                                        <th class="bg-primary-subtle">@thousands($dataStock->pendapatanTeaWaste)</th>
                                                        <th class="bg-primary-subtle">@thousands($dataStock->pendapatanAbuHe)</th>
                                                        <th class="bg-primary-subtle">@thousands($dataStock->pendapatanLimbahSerum)</th>
                                                        <th class="bg-primary-subtle">@thousands($dataStock->pendapatanTunggulKaret)</th>
                                                        <th class="bg-primary-subtle">@thousands($dataStock->pendapatanAbu)</th>
                                                        <th class="bg-primary-subtle">@thousands($dataStock->pendapatanRanting)</th>
                                                        <th class="bg-primary-subtle">@thousands($dataStock->pendapatanBatangKayu)</th>
                                                        <th class="bg-primary-subtle">@thousands($dataStock->pendapatanKulitBuah)</th>
                                                        <th class="bg-primary-subtle">@thousands($dataStock->pendapatanHuskSkin)</th>
                                                        <th class="bg-primary-subtle">@thousands($dataStock->pendapatanMucilage)</th>    
                                                        <th class="bg-primary-subtle">@thousands($dataStock->pendapatanTeaWaste 
                                                            + $dataStock->pendapatanAbuHe 
                                                            + $dataStock->pendapatanLimbahSerum 
                                                            + $dataStock->pendapatanTunggulKaret 
                                                            + $dataStock->pendapatanAbu 
                                                            + $dataStock->pendapatanRanting
                                                            + $dataStock->pendapatanBatangKayu 
                                                            + $dataStock->pendapatanKulitBuah
                                                            + $dataStock->pendapatanHuskSkin
                                                            + $dataStock->pendapatanMucilage
                                                            )</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0"> <span><i class="fas fa-shopping-cart"></i></span> Rekap
                                            Penjualan
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered" id="tablePendapatan"
                                                style="border: 0.5px solid rgba(128, 128, 128, 0.3);">
                                                <thead>
                                                    <tr class="text-center align-middle">
                                                        <th rowspan="2" class="bg-primary-subtle">#</th>
                                                        <th rowspan="2" class="bg-primary-subtle">Regional</th>
                                                        <th colspan="11" class="bg-primary-subtle">Penjualan (Ton)
                                                        </th>
                                                    </tr>
                                                    <tr class="text-center align-middle">
                                                        <th class="bg-primary-subtle">Tea Waste</th>
                                                        <th class="bg-primary-subtle">Abu HE</th>
                                                        <th class="bg-primary-subtle">Limbah Serum</th>
                                                        <th class="bg-primary-subtle">Tunggul Karet</th>
                                                        <th class="bg-primary-subtle">Abu</th>
                                                        <th class="bg-primary-subtle">Ranting</th>
                                                        <th class="bg-primary-subtle">Batang Kayu</th>
                                                        <th class="bg-primary-subtle">Kulit Buah</th>
                                                        <th class="bg-primary-subtle">Husk Skin</th>
                                                        <th class="bg-primary-subtle">Mucilage</th>
                                                        <th class="bg-primary-subtle">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($dataStock as $key => $penjualan)
                                                        <tr class="text-center">
                                                            <td>{{ $key + 1 }}</td>
                                                            <td class="text-start text-nowrap">{{ $penjualan->nama }}
                                                            </td>
                                                            <td>@ton($penjualan->penjualan_tea_waste)</td>
                                                            <td>@ton($penjualan->penjualan_abu_he)</td>
                                                            <td>@ton($penjualan->penjualan_limbah_serum)</td>
                                                            <td>@ton($penjualan->penjualan_tunggul_karet)</td>
                                                            <td>@ton($penjualan->penjualan_abu)</td>
                                                            <td>@ton($penjualan->penjualan_ranting)</td>
                                                            <td>@ton($penjualan->penjualan_batang_kayu)</td>
                                                            <td>@ton($penjualan->penjualan_kulit_buah)</td>
                                                            <td>@ton($penjualan->penjualan_husk_skin)</td>
                                                            <td>@ton($penjualan->penjualan_mucilage)</td>
                                                            <td>@ton($penjualan->penjualan_tea_waste
                                                                + $penjualan->penjualan_abu_he
                                                                + $penjualan->penjualan_limbah_serum
                                                                + $penjualan->penjualan_tunggul_karet
                                                                + $penjualan->penjualan_abu
                                                                + $penjualan->penjualan_ranting
                                                                + $penjualan->penjualan_batang_kayu
                                                                + $penjualan->penjualan_kulit_buah
                                                                + $penjualan->penjualan_husk_skin
                                                                + $penjualan->penjualan_mucilage
                                                                )</td>
                                                        </tr>
                                                    @endforeach
                                                    <tr class="text-center">
                                                        <th class="bg-primary-subtle" colspan="2">Total</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->totalPenjualanTeaWaste)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->totalPenjualanAbuHe)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->totalPenjualanLimbahSerum)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->totalPenjualanTunggulKaret)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->totalPenjualanAbu)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->totalPenjualanRanting)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->totalPenjualanBatangKayu)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->totalPenjualanKulitBuah)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->totalPenjualanHuskSkin)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->totalPenjualanMucilage)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->totalPenjualan)</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0"> <span><i class="fas fa-shopping-cart"></i></span> Rekap
                                            Harga
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered" id="tablePendapatan"
                                                style="border: 0.5px solid rgba(128, 128, 128, 0.3);">
                                                <thead>
                                                    <tr class="text-center align-middle">
                                                        <th rowspan="2" class="bg-primary-subtle">#</th>
                                                        <th rowspan="2" class="bg-primary-subtle">Regional</th>
                                                        <th colspan="10" class="bg-primary-subtle">Harga Rata-rata
                                                            (Rp/Kg)
                                                        </th>
                                                    </tr>
                                                    <tr class="text-center align-middle">
                                                    <th class="bg-primary-subtle">Tea Waste</th>
                                                        <th class="bg-primary-subtle">Abu HE</th>
                                                        <th class="bg-primary-subtle">Limbah Serum</th>
                                                        <th class="bg-primary-subtle">Tunggul Karet</th>
                                                        <th class="bg-primary-subtle">Abu</th>
                                                        <th class="bg-primary-subtle">Ranting</th>
                                                        <th class="bg-primary-subtle">Batang Kayu</th>
                                                        <th class="bg-primary-subtle">Kulit Buah</th>
                                                        <th class="bg-primary-subtle">Husk Skin</th>
                                                        <th class="bg-primary-subtle">Mucilage</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($dataStock as $key => $harga)
                                                        <tr class="text-center">
                                                            <td>{{ $key + 1 }}</td>
                                                            <td class="text-start text-nowrap">{{ $harga->nama }}
                                                            </td>
                                                            <td>@comma($harga->penjualan_tea_waste ? $harga->pendapatan_tea_waste / $harga->penjualan_tea_waste : 0)</td>
                                                            <td>@comma($harga->penjualan_abu_he ? $harga->pendapatan_abu_he / $harga->penjualan_abu_he : 0)</td>
                                                            <td>@comma($harga->penjualan_limbah_serum ? $harga->pendapatan_limbah_serum / $harga->penjualan_limbah_serum : 0)</td>
                                                            <td>@comma($harga->penjualan_tunggul_karet ? $harga->pendapatan_tunggul_karet / $harga->penjualan_tunggul_karet : 0)</td>
                                                            <td>@comma($harga->penjualan_abu ? $harga->pendapatan_abu / $harga->penjualan_abu : 0)</td>
                                                            <td>@comma($harga->penjualan_ranting ? $harga->pendapatan_ranting / $harga->penjualan_ranting : 0)</td>
                                                            <td>@comma($harga->penjualan_batang_kayu ? $harga->pendapatan_batang_kayu / $harga->penjualan_batang_kayu : 0)</td>
                                                            <td>@comma($harga->penjualan_kulit_buah ? $harga->pendapatan_kulit_buah / $harga->penjualan_kulit_buah : 0)</td>
                                                            <td>@comma($harga->penjualan_husk_skin ? $harga->pendapatan_husk_skin / $harga->penjualan_husk_skin : 0)</td>
                                                            <td>@comma($harga->penjualan_mucilage ? $harga->pendapatan_mucilage / $harga->penjualan_mucilage : 0)</td>
                                                        </tr>
                                                    @endforeach
                                                    <tr class="text-center">
                                                        <th class="bg-primary-subtle" colspan="2">Total</th>
                                                        <th class="bg-primary-subtle">@comma($dataStock->totalHargaRataTeaWaste)</th>
                                                        <th class="bg-primary-subtle">@comma($dataStock->totalHargaRataAbuHe)</th>
                                                        <th class="bg-primary-subtle">@comma($dataStock->totalHargaRataLimbahSerum)</th>
                                                        <th class="bg-primary-subtle">@comma($dataStock->totalHargaRataTunggulKaret)</th>
                                                        <th class="bg-primary-subtle">@comma($dataStock->totalHargaRataAbu)</th>
                                                        <th class="bg-primary-subtle">@comma($dataStock->totalHargaRataRanting)</th>
                                                        <th class="bg-primary-subtle">@comma($dataStock->totalHargaRataBatangKayu)</th>
                                                        <th class="bg-primary-subtle">@comma($dataStock->totalHargaRataKulitBuah)</th>
                                                        <th class="bg-primary-subtle">@comma($dataStock->totalHargaRataHuskSkin)</th>
                                                        <th class="bg-primary-subtle">@comma($dataStock->totalHargaRataMucilage)</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav2-profile" role="tabpanel" aria-labelledby="#nav2-profile-tab">
                    <div class="row">
                        <div class="col-xxl-9">
                            <div class="card">
                                <div class="card-body" style="min-height: 20vh">
                                    <div class="placeholder-glow" id="ph-chart-sumber-daya">
                                        <div class="placeholder col-4 mb-1"></div>
                                        <div class="placeholder col-6 mb-1"></div>
                                        <div class="placeholder col-12 mb-1"></div>
                                        <div class="placeholder col-12 py-5"></div>
                                    </div>
                                    <div id="line_chart_sumber_daya" data-colors='[ "#7FFF7F", "#228B22",  "#004d00"]'
                                        wire:ignore class="apex-charts" dir="ltr"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav4" role="tabpanel" aria-labelledby="#nav4-tab">
                    <div class="row">
                        <div class="col-xxl-9">
                            <div class="card">
                                <div class="card-body" style="min-height: 20vh">
                                    <h5>On Development...</h5>
                                    <div class="placeholder-glow" id="ph-chart-sumber-daya">
                                        <div class="placeholder col-4 mb-1"></div>
                                        <div class="placeholder col-6 mb-1"></div>
                                        <div class="placeholder col-12 mb-1"></div>
                                        <div class="placeholder col-12 py-5"></div>
                                    </div>
                                    <div id="line_chart_sumber_daya" data-colors='[ "#7FFF7F", "#228B22",  "#004d00"]'
                                        wire:ignore class="apex-charts" dir="ltr"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    {{-- <script src="assets/js/pages/dashboard.init.js"></script> --}}
    {{-- <script src="{{ asset('assets/js/custom/dashboard.js') }}"></script> --}}
    <script>
        var chart = null;
        var chart2 = null;
        var chart3 = null;
        var chartStok = null;
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
            $('#tanggal').text('Periode ' + namaBulan[bulan] + " " + tahun);
            Livewire.dispatch('reload', {
                bulan: bulan,
                tahun: tahun
            })
            initChart(bulan, tahun);
        });
        initChart({{ $bulan }}, {{ $tahun }});

        // Livewire.on('initChartJs', function() {})

        // ------chart pertama------
        function initChart(bulan, tahun) {
            requestAnimationFrame(() => {
                $.ajax({
                    url: "/api/dashboard-data-penjualan-n1/" + bulan + "/" + tahun,
                    type: "GET",
                    success: function(data) {
                        $('#ph-chart1').hide();
                        var chartLineColumnColors = getChartColorsArray("line_column_chart");
                        if (chartLineColumnColors) {
                            const dataPenjualan = data.dataPenjualan;
                            const dataPendapatan = data.dataPendapatan;
                            const hargaRataRata = dataPenjualan.map((penjualan, index) => {
                                const pendapatan = dataPendapatan[index];
                                return pendapatan && penjualan ? (pendapatan / penjualan) : 0;
                            });
                            const hargaNormal = data.hargaNormal
                            const dataPenjualanTon = dataPenjualan.map((penjualan) => penjualan ?
                                penjualan / 1000 :
                                0);
                            const dataPendapatanJuta = dataPendapatan.map((pendapatan) => pendapatan ?
                                pendapatan / 1000000 :
                                0);

                            var options = {
                                series: [{
                                        name: 'Penjualan (Ton)',
                                        type: 'column',
                                        data: dataPenjualanTon,
                                    },
                                    {
                                        name: 'Pendapatan',
                                        type: 'column',
                                        data: dataPendapatanJuta,
                                    },
                                    {
                                        name: 'Harga Rata-rata (Rp/Kg)',
                                        type: 'line',
                                        data: hargaRataRata,
                                    }
                                ],
                                chart: {
                                    height: 350,
                                    type: 'line',
                                    toolbar: {
                                        show: false,
                                    },

                                },
                                stroke: {
                                    width: [0, 0, 3]
                                },
                                grid: {
                                    xaxis: {
                                        lines: {
                                            show: false
                                        }
                                    }
                                },
                                title: {
                                    text: 'Data Penjualan, Pendapatan & Harga Rata-rata',
                                    style: {
                                        fontWeight: 500,
                                    },
                                },
                                dataLabels: {
                                    enabled: true,
                                    offsetY: -10,
                                    enabledOnSeries: [2],
                                    formatter: function(value) {
                                        return new Intl.NumberFormat('id-ID', {
                                            style: 'currency',
                                            currency: 'IDR'
                                        }).format(value); // Format dengan Rupiah
                                    }
                                },
                                labels: data.labels,
                                yaxis: [{
                                        title: {
                                            text: 'Penjualan (Ton)',
                                            style: {
                                                fontWeight: 500,
                                            },
                                        },
                                        labels: {
                                            formatter: function(value) {
                                                return new Intl.NumberFormat('id-ID')
                                                    .format(value);
                                            }
                                        },
                                    },
                                    {
                                        opposite: true,
                                        title: {
                                            text: 'Pendapatan (Juta)',
                                            style: {
                                                fontWeight: 500,
                                            },
                                        },
                                        labels: {
                                            formatter: function(value) {
                                                return new Intl.NumberFormat('id-ID', {
                                                    style: 'currency',
                                                    currency: 'IDR'
                                                }).format(value);
                                            }
                                        },
                                    }
                                ],
                                colors: chartLineColumnColors,
                                tooltip: {
                                    enabled: true, // Aktifkan tooltip
                                    shared: true, // Tooltip akan muncul untuk semua seri saat hover
                                    intersect: false, // Tooltip muncul meskipun titik tidak dihover langsung
                                    y: {
                                        formatter: function(value, {
                                            seriesIndex,
                                            dataPointIndex,
                                            w
                                        }) {
                                            const label = w.globals.labels[dataPointIndex];
                                            const formattedValue = new Intl.NumberFormat(
                                                'id-ID').format(value);
                                            if (seriesIndex === 0) {
                                                return `${formattedValue} Ton`;
                                            } else if (seriesIndex === 1) {
                                                return `${formattedValue} Juta`;
                                            } else if (seriesIndex === 2) {
                                                return `Rp ${formattedValue}`;
                                            }
                                        }
                                    },
                                    custom: function({
                                        series,
                                        seriesIndex,
                                        dataPointIndex,
                                        w
                                    }) {
                                        const label = w.globals.labels[
                                            dataPointIndex]; // Label data
                                        const value = series[seriesIndex][
                                            dataPointIndex
                                        ]; // Nilai data
                                        const formattedValue = new Intl.NumberFormat('id-ID')
                                            .format(value); // Format angka
                                        let unit = '';
                                        let pendapatan = dataPendapatanJuta[dataPointIndex];
                                        let penjualan = dataPenjualanTon[dataPointIndex];
                                        let rataRata = hargaRataRata[dataPointIndex];
                                        let kategori = data.labels[dataPointIndex];
                                        let normal = hargaNormal[dataPointIndex];

                                        // Tentukan unit berdasarkan seriesIndex
                                        if (seriesIndex === 0) {
                                            unit = `${formattedValue} Ton`;
                                        } else if (seriesIndex === 1) {
                                            unit = `${formattedValue} Juta`;
                                        } else if (seriesIndex === 2) {
                                            unit = `Rp ${formattedValue}`;
                                        }

                                        // Return custom HTML tooltip
                                        return `
                                        <div class="card mb-0">
                                            <div class="card-header mb-0 pb-2 ps-2" style="background-color: #28332b; color: white;">
                                                <h6 class="mb-0">${kategori}</h6>
                                            </div>
                                            <div class="card-body pb-0 pt-2 px-2 mb-0" style="font-size: 12px">
                                                <p style="display: flex; align-items: center; gap: 8px;">
                                                <span style="width: 12px; height: 12px; background-color: #a3fc8d; border-radius: 50%; display: inline-block;"></span>
                                                Penjualan: <span style="color: #a3fc8d;"><strong>${new Intl.NumberFormat('id-ID').format(penjualan)} Ton</strong></span>
                                                </p>
                                                <p style="display: flex; align-items: center; gap: 8px;">
                                                <span style="width: 12px; height: 12px; background-color: #478933; border-radius: 50%; display: inline-block;"></span>
                                                Pendapatan: <span style="color: #478933;"><strong>${new Intl.NumberFormat('id-ID').format(pendapatan)} Juta</strong></span>
                                                </p>
                                                <p style="display: flex; align-items: center; gap: 8px;">
                                                <span style="width: 12px; height: 12px; background-color: #204c10; border-radius: 50%; display: inline-block;"></span>
                                                Harga Rata-rata: <span style="color: #204c10;"><strong>${new Intl.NumberFormat('id-ID').format(rataRata)} Rp/Kg</strong></span>
                                                </p>
                                                <p style="display: flex; align-items: center; gap: 8px;">
                                                <span style="width: 12px; height: 12px; background-color: #286d29; border-radius: 50%; display: inline-block;"></span>
                                                Harga Normal: <span style="color: #286d29;"><strong>${new Intl.NumberFormat('id-ID').format(normal)} Rp/Kg</strong></span>
                                                </p>
                                            </div>
                                            </div>
                                        
                                        `;
                                    }

                                }

                            };
                            if (chart) {
                                chart.updateOptions(options);
                            } else {
                                chart = new ApexCharts(document.querySelector("#line_column_chart"),
                                    options);
                                chart.render();
                            }
                        }
                    }
                });
                requestAnimationFrame(() => {
                    $.ajax({
                        url: "/api/data-stok-chart-pie-n1/" + bulan + "/" + tahun,
                        type: "GET",
                        success: function(data) {
                            $('#ph-piechart').hide();
                            var chartPiePatternColors = getChartColorsArray("pattern_chart");
                            if (chartPiePatternColors) {
                                var options2 = {
                                    series: data.dataStokChart,
                                    chart: {
                                        height: 300,
                                        type: 'donut',
                                        dropShadow: {
                                            enabled: true,
                                            color: '#111',
                                            top: -1,
                                            left: 3,
                                            blur: 3,
                                            opacity: 0.2
                                        },
                                    },
                                    stroke: {
                                        width: 0,
                                    },
                                    plotOptions: {
                                        pie: {
                                            donut: {
                                                labels: {
                                                    show: true,
                                                    total: {
                                                        showAlways: true,
                                                        show: true,
                                                        formatter: function(w) {
                                                            return new Intl
                                                                .NumberFormat('id-ID')
                                                                .format(
                                                                    w.globals
                                                                    .seriesTotals
                                                                    .reduce((a, b) =>
                                                                        a +
                                                                        b, 0)
                                                                );
                                                        }
                                                    },
                                                }
                                            }
                                        }
                                    },
                                    labels: data.labels,
                                    dataLabels: {
                                        dropShadow: {
                                            blur: 3,
                                            opacity: 0.8
                                        }
                                    },
                                    fill: {
                                        type: 'pie',
                                        opacity: 1,
                                        pattern: {
                                            enabled: true,
                                            style: ['verticalLines', 'squares',
                                                'horizontalLines', 'circles',
                                                'slantedLines'
                                            ],
                                        },
                                    },
                                    states: {
                                        hover: {
                                            filter: 'none'
                                        }
                                    },
                                    theme: {
                                        palette: 'palette2'
                                    },
                                    title: {
                                        text: "Stok",
                                        style: {
                                            fontWeight: 500,
                                        },
                                    },
                                    legend: {
                                        position: 'bottom'
                                    },
                                    colors: chartPiePatternColors,
                                    tooltip: {
                                        y: {
                                            formatter: function(value) {
                                                return new Intl.NumberFormat('id-ID')
                                                    .format(value);
                                            }
                                        }
                                    }
                                };

                                if (chart2) {
                                    chart2.updateOptions(options2);
                                } else {
                                    chart2 = new ApexCharts(document.querySelector(
                                        "#pattern_chart"), options2);
                                    chart2.render();
                                }
                            }
                        }
                    });
                    requestAnimationFrame(() => {
                        $.ajax({
                            url: "api/data-region-stok-chart-n1/" + bulan + "/" + tahun,
                            type: "GET",
                            success: function(data) {
                                $('#ph-barchart').hide();
                                var chartStackedBar100Colors = getChartColorsArray(
                                    "stacked_bar_100");
                                if (chartStackedBar100Colors) {
                                    var options3 = {
                                        series: data.dataRegionStockChart,
                                        chart: {
                                            type: 'bar',
                                            height: 350,
                                            stacked: true,
                                            stackType: '100%',
                                            toolbar: {
                                                show: false,
                                            }
                                        },
                                        plotOptions: {
                                            bar: {
                                                horizontal: true,
                                            },
                                        },
                                        stroke: {
                                            width: 1,
                                            colors: ['#fff']
                                        },
                                        title: {
                                            text: 'Persentase Stok',
                                            style: {
                                                fontWeight: 500,
                                            },
                                        },
                                        xaxis: {
                                            categories: data.labels,
                                        },
                                        tooltip: {
                                            y: {
                                                formatter: function(val) {
                                                    return new Intl
                                                        .NumberFormat('id-ID')
                                                        .format(val) + " Ton";
                                                }
                                            }
                                        },
                                        fill: {
                                            opacity: 1

                                        },
                                        legend: {
                                            position: 'top',
                                            horizontalAlign: 'left',
                                            offsetX: 40
                                        },
                                        colors: chartStackedBar100Colors
                                    };

                                    if (chart3) {
                                        chart3.updateOptions(options3);
                                    } else {
                                        chart3 = new ApexCharts(document.querySelector(
                                            "#stacked_bar_100"), options3);
                                        chart3.render();
                                    }
                                }
                            }
                        })
                        requestAnimationFrame(() => {
                            $.ajax({
                                url: "api/data-produksi-digunakan-chart-n1/" + bulan +
                                    "/" + tahun,
                                type: "GET",
                                success: function(data) {
                                    $('#ph-chart2').hide();
                                    const dataDigunakan = data.digunakan;
                                    const dataProduksi = data.diproduksi;
                                    const labels = data.labels;
                                    const stokSaatIni = data.stokSaatIni;
                                    const dijual = data.dijual;

                                    const digunakanDalamTon = dataDigunakan.map(
                                        (digunakan) => digunakan ?
                                        digunakan / 1000 :
                                        0);
                                    const dataProduksiDalamTon = dataProduksi
                                        .map(
                                            (produksi) => produksi ?
                                            produksi / 1000 :
                                            0);
                                    const dataDijualDalamTon = dijual.map(
                                        (dijual) => dijual ?
                                        dijual / 1000 :
                                        0);

                                    const stokSaatIniDalamTon = stokSaatIni.map(
                                        (stok) => stok ?
                                        stok / 1000 :
                                        0);

                                    var chartColumnColors = getChartColorsArray(
                                        "column_chart_stok");
                                    if (chartColumnColors) {
                                        var optionsStok = {
                                            series: [{
                                                    name: 'Produksi',
                                                    type: 'column',
                                                    data: dataProduksiDalamTon,
                                                },
                                                {
                                                    name: 'Digunakan',
                                                    type: 'column',
                                                    data: digunakanDalamTon,
                                                },
                                                {
                                                    name: 'Dijual',
                                                    type: 'column',
                                                    data: dataDijualDalamTon,
                                                },
                                                {
                                                    name: 'Stok Saat Ini',
                                                    type: 'line',
                                                    data: stokSaatIniDalamTon,
                                                },
                                            ],
                                            chart: {
                                                height: 350,
                                                type: 'line',
                                                toolbar: {
                                                    show: false
                                                },
                                            },
                                            stroke: {
                                                width: [0, 0, 0, 3]
                                            },
                                            grid: {
                                                xaxis: {
                                                    lines: {
                                                        show: false
                                                    }
                                                }
                                            },
                                            title: {
                                                text: 'Data Produksi, Digunakan & Stok',
                                                style: {
                                                    fontWeight: 500
                                                },
                                            },
                                            dataLabels: {
                                                enabled: true,
                                                enabledOnSeries: [
                                                    3
                                                ],
                                                formatter: function(value) {
                                                    return new Intl
                                                        .NumberFormat(
                                                            'id-ID')
                                                        .format(value);
                                                },
                                                offsetY: -10,
                                            },
                                            labels: labels,
                                            yaxis: [{
                                                    title: {
                                                        text: 'Produksi (Ton)',
                                                        style: {
                                                            fontWeight: 500
                                                        },
                                                    },
                                                    labels: {
                                                        formatter: function(
                                                            value) {
                                                            return new Intl
                                                                .NumberFormat(
                                                                    'id-ID'
                                                                )
                                                                .format(
                                                                    value
                                                                );
                                                        }
                                                    },
                                                },
                                                // {
                                                //     opposite: true,
                                                //     title: {
                                                //         text: 'Stok Saat Ini (Ton)',
                                                //         style: {
                                                //             fontWeight: 500
                                                //         },
                                                //     },
                                                //     labels: {
                                                //         formatter: function(
                                                //             value) {
                                                //             return new Intl
                                                //                 .NumberFormat(
                                                //                     'id-ID'
                                                //                 )
                                                //                 .format(
                                                //                     value
                                                //                 );
                                                //         }
                                                //     },
                                            ],
                                            colors: chartColumnColors
                                        };


                                        if (chartStok) {
                                            chartStok.updateOptions(
                                                optionsStok);
                                        } else {
                                            chartStok = new ApexCharts(document
                                                .querySelector(
                                                    "#column_chart_stok"),
                                                optionsStok);
                                            chartStok.render();
                                        }
                                    }
                                }
                            })
                        });
                    });
                });
            });



        }
    </script>
@endpush
