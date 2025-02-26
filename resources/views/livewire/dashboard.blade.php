@use(Carbon\Carbon)
@use(App\Enum\UserRoleEnum)
<div>
    <x-page-title title="Dashboard">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
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
                        aria-selected="true" role="tab">Data Limbah Sawit s.d BI</a>
                    <a class="nav-item nav-link" id="nav4-tab" data-bs-toggle="tab" href="#nav4" aria-selected="true"
                        role="tab">Data Limbah Sawit BI</a>
                    <a class="nav-item nav-link" id="nav2-profile-tab" data-bs-toggle="tab" href="#nav2-profile"
                        aria-selected="false" tabindex="-1" role="tab">Data Pemaiakan Sumber Daya</a>
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
                                                data-colors='["--bs-primary", "--bs-success", "--bs-warning", "--bs-danger", "--bs-info", "--bs-pink", "--bs-secondary"]'
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
                                                data-colors='["--bs-primary", "--bs-success", "--bs-warning", "--bs-danger", "--bs-info", "--bs-secondary", "--bs-pink"]'
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
                                                        <th class="bg-primary-subtle" colspan="7">Stok (Ton)</th>
                                                    </tr>
                                                    <tr class="text-center">
                                                        <th class="bg-primary-subtle">Cangkang</th>
                                                        <th class="bg-primary-subtle">Fiber</th>
                                                        <th class="bg-primary-subtle">Tankos</th>
                                                        <th class="bg-primary-subtle">Abu Janjang</th>
                                                        <th class="bg-primary-subtle">Solid Decanter</th>
                                                        <th class="bg-primary-subtle">POME</th>
                                                        <th class="bg-primary-subtle">PKM</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($dataStock as $key => $stok)
                                                        <tr class="text-center">
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $stok->nama }}</td>
                                                            <td>@ton($stok->sisa_cangkang)</td>
                                                            <td>@ton($stok->sisa_fiber)</td>
                                                            <td>@ton($stok->sisa_tankos)</td>
                                                            <td>@ton($stok->sisa_abu_janjang)</td>
                                                            <td>@ton($stok->sisa_solid)</td>
                                                            <td>@ton($stok->sisa_pome_oil)</td>
                                                            <td>@ton($stok->sisa_pkm)</td>
                                                        </tr>
                                                    @endforeach
                                                    <tr class="text-center">
                                                        <th class="bg-primary-subtle" colspan="2">Total</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->sisaAllCangkang)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->sisaAllFiber)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->sisaAllTankos)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->sisaAllAbuJanjang)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->sisaAllSolid)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->sisaAllPomeOil)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->sisaAllPkm)</th>
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
                                                        <th colspan="8" class="bg-primary-subtle">Pendapatan (Rp)
                                                        </th>
                                                    </tr>
                                                    <tr class="text-center align-middle">
                                                        <th class="bg-primary-subtle">Cangkang</th>
                                                        <th class="bg-primary-subtle">Fiber</th>
                                                        <th class="bg-primary-subtle">Tankos</th>
                                                        <th class="bg-primary-subtle">Abu Janjang</th>
                                                        <th class="bg-primary-subtle">Solid Decanter</th>
                                                        <th class="bg-primary-subtle">POME</th>
                                                        <th class="bg-primary-subtle">PKM</th>
                                                        <th class="bg-primary-subtle">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $subTotalCangkang = 0;
                                                        $subTotalFiber = 0;
                                                        $subTotalTankos = 0;
                                                        $subTotalAbuJanjang = 0;
                                                        $subTotalSolid = 0;
                                                        $subTotalPomeOil = 0;
                                                        $subTotalPkm = 0;
                                                        $subTotalAll = 0;
                                                        $isKso = 0;
                                                    @endphp
                                                    @foreach ($dataStock as $key => $pendapatan)
                                                        @php
                                                            $subTotalCangkang += $pendapatan->pendapatan_cangkang;
                                                            $subTotalFiber += $pendapatan->pendapatan_fiber;
                                                            $subTotalTankos += $pendapatan->pendapatan_tankos;
                                                            $subTotalAbuJanjang += $pendapatan->pendapatan_abu_janjang;
                                                            $subTotalSolid += $pendapatan->pendapatan_solid;
                                                            $subTotalPomeOil += $pendapatan->pendapatan_pome_oil;
                                                            $subTotalPkm += $pendapatan->pendapatan_pkm;
                                                            $subTotalAll +=
                                                                $pendapatan->pendapatan_cangkang +
                                                                $pendapatan->pendapatan_fiber +
                                                                $pendapatan->pendapatan_tankos +
                                                                $pendapatan->pendapatan_abu_janjang +
                                                                $pendapatan->pendapatan_solid +
                                                                $pendapatan->pendapatan_pome_oil +
                                                                $pendapatan->pendapatan_pkm;
                                                        @endphp
                                                        @if (in_array(auth()->user()->role, [
                                                                UserRoleEnum::SUPER_ADMIN,
                                                                UserRoleEnum::ADMIN_SUB_HOLDING,
                                                                UserRoleEnum::ADMIN_HOLDING,
                                                            ]))
                                                            @if ($isKso != $pendapatan->kso)
                                                                <tr class="text-center">
                                                                    <th class="bg-primary-subtle" colspan="2">Total
                                                                        Non
                                                                        KSO</th>
                                                                    <th class="bg-primary-subtle">@thousands($subTotalCangkang)
                                                                    </th>
                                                                    <th class="bg-primary-subtle">@thousands($subTotalFiber)
                                                                    </th>
                                                                    <th class="bg-primary-subtle">@thousands($subTotalTankos)
                                                                    </th>
                                                                    <th class="bg-primary-subtle">@thousands($subTotalAbuJanjang)
                                                                    </th>
                                                                    <th class="bg-primary-subtle">@thousands($subTotalSolid)
                                                                    </th>
                                                                    <th class="bg-primary-subtle">@thousands($subTotalPomeOil)
                                                                    </th>
                                                                    <th class="bg-primary-subtle">@thousands($subTotalPkm)
                                                                    </th>
                                                                    <th class="bg-primary-subtle">@thousands($subTotalAll)
                                                                    </th>
                                                                </tr>
                                                                @php
                                                                    $subTotalCangkang = 0;
                                                                    $subTotalFiber = 0;
                                                                    $subTotalTankos = 0;
                                                                    $subTotalAbuJanjang = 0;
                                                                    $subTotalSolid = 0;
                                                                    $subTotalPomeOil = 0;
                                                                    $subTotalPkm = 0;
                                                                    $subTotalAll = 0;

                                                                    $isKso = $pendapatan->kso;
                                                                @endphp
                                                            @endif
                                                        @endif
                                                        <tr class="text-center">
                                                            <td>{{ $key + 1 }}</td>
                                                            <td class="text-start text-nowrap">
                                                                {{ $pendapatan->nama }}
                                                            </td>
                                                            <td>@thousands($pendapatan->pendapatan_cangkang)</td>
                                                            <td>@thousands($pendapatan->pendapatan_fiber)</td>
                                                            <td>@thousands($pendapatan->pendapatan_tankos)</td>
                                                            <td>@thousands($pendapatan->pendapatan_abu_janjang)</td>
                                                            <td>@thousands($pendapatan->pendapatan_solid)</td>
                                                            <td>@thousands($pendapatan->pendapatan_pome_oil)</td>
                                                            <td>@thousands($pendapatan->pendapatan_pkm)</td>
                                                            <td>@thousands($pendapatan->pendapatan_cangkang + $pendapatan->pendapatan_fiber + $pendapatan->pendapatan_tankos + $pendapatan->pendapatan_abu_janjang + $pendapatan->pendapatan_solid + $pendapatan->pendapatan_pome_oil + $pendapatan->pendapatan_pkm)</td>
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
                                                                    <th class="bg-primary-subtle">@thousands($subTotalCangkang)
                                                                    </th>
                                                                    <th class="bg-primary-subtle">@thousands($subTotalFiber)
                                                                    </th>
                                                                    <th class="bg-primary-subtle">@thousands($subTotalTankos)
                                                                    </th>
                                                                    <th class="bg-primary-subtle">@thousands($subTotalAbuJanjang)
                                                                    </th>
                                                                    <th class="bg-primary-subtle">@thousands($subTotalSolid)
                                                                    </th>
                                                                    <th class="bg-primary-subtle">@thousands($subTotalPomeOil)
                                                                    </th>
                                                                    <th class="bg-primary-subtle">@thousands($subTotalPkm)
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
                                                        <th class="bg-primary-subtle">@thousands($dataStock->pendapatanCangkang)</th>
                                                        <th class="bg-primary-subtle">@thousands($dataStock->pendapatanFiber)</th>
                                                        <th class="bg-primary-subtle">@thousands($dataStock->pendapatanTankos)</th>
                                                        <th class="bg-primary-subtle">@thousands($dataStock->pendapatanAbuJanjang)</th>
                                                        <th class="bg-primary-subtle">@thousands($dataStock->pendapatanSolid)</th>
                                                        <th class="bg-primary-subtle">@thousands($dataStock->pendapatanPomeOil)</th>
                                                        <th class="bg-primary-subtle">@thousands($dataStock->pendapatanPkm)</th>
                                                        <th class="bg-primary-subtle">@thousands($dataStock->pendapatanCangkang + $dataStock->pendapatanFiber + $dataStock->pendapatanTankos + $dataStock->pendapatanAbuJanjang + $dataStock->pendapatanSolid + $dataStock->pendapatanPomeOil + $dataStock->pendapatanPkm)</th>
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
                                                        <th colspan="8" class="bg-primary-subtle">Penjualan (Ton)
                                                        </th>
                                                    </tr>
                                                    <tr class="text-center align-middle">
                                                        <th class="bg-primary-subtle">Cangkang</th>
                                                        <th class="bg-primary-subtle">Fiber</th>
                                                        <th class="bg-primary-subtle">Tankos</th>
                                                        <th class="bg-primary-subtle">Abu Janjang</th>
                                                        <th class="bg-primary-subtle">Solid Decanter</th>
                                                        <th class="bg-primary-subtle">POME</th>
                                                        <th class="bg-primary-subtle">PKM</th>
                                                        <th class="bg-primary-subtle">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($dataStock as $key => $penjualan)
                                                        <tr class="text-center">
                                                            <td>{{ $key + 1 }}</td>
                                                            <td class="text-start text-nowrap">{{ $penjualan->nama }}
                                                            </td>
                                                            <td>@ton($penjualan->penjualan_cangkang)</td>
                                                            <td>@ton($penjualan->penjualan_fiber)</td>
                                                            <td>@ton($penjualan->penjualan_tankos)</td>
                                                            <td>@ton($penjualan->penjualan_abu_janjang)</td>
                                                            <td>@ton($penjualan->penjualan_solid)</td>
                                                            <td>@ton($penjualan->penjualan_pome_oil)</td>
                                                            <td>@ton($penjualan->penjualan_pkm)</td>
                                                            <td>@ton($penjualan->penjualan_cangkang + $penjualan->penjualan_fiber + $penjualan->penjualan_tankos + $penjualan->penjualan_abu_janjang + $penjualan->penjualan_solid + $penjualan->penjualan_pome_oil + $penjualan->penjualan_pkm)</td>
                                                        </tr>
                                                    @endforeach
                                                    <tr class="text-center">
                                                        <th class="bg-primary-subtle" colspan="2">Total</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->totalPenjualanCangkang)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->totalPenjualanFiber)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->totalPenjualanTankos)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->totalPenjualanAbuJanjang)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->totalPenjualanSolid)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->totalPenjualanPomeOil)</th>
                                                        <th class="bg-primary-subtle">@ton($dataStock->totalPenjualanPkm)</th>
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
                                                        <th colspan="8" class="bg-primary-subtle">Harga Rata-rata
                                                            (Rp/Kg)
                                                        </th>
                                                    </tr>
                                                    <tr class="text-center align-middle">
                                                        <th class="bg-primary-subtle">Cangkang</th>
                                                        <th class="bg-primary-subtle">Fiber</th>
                                                        <th class="bg-primary-subtle">Tankos</th>
                                                        <th class="bg-primary-subtle">Abu Janjang</th>
                                                        <th class="bg-primary-subtle">Solid Decanter</th>
                                                        <th class="bg-primary-subtle">POME</th>
                                                        <th class="bg-primary-subtle">PKM</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($dataStock as $key => $harga)
                                                        <tr class="text-center">
                                                            <td>{{ $key + 1 }}</td>
                                                            <td class="text-start text-nowrap">{{ $harga->nama }}
                                                            </td>
                                                            <td>@comma($harga->penjualan_cangkang ? $harga->pendapatan_cangkang / $harga->penjualan_cangkang : 0)</td>
                                                            <td>@comma($harga->penjualan_fiber ? $harga->pendapatan_fiber / $harga->penjualan_fiber : 0)</td>
                                                            <td>@comma($harga->penjualan_tankos ? $harga->pendapatan_tankos / $harga->penjualan_tankos : 0)</td>
                                                            <td>@comma($harga->penjualan_abu_janjang ? $harga->pendapatan_abu_janjang / $harga->penjualan_abu_janjang : 0)</td>
                                                            <td>@comma($harga->penjualan_solid ? $harga->pendapatan_solid / $harga->penjualan_solid : 0)</td>
                                                            <td>@comma($harga->penjualan_pome_oil ? $harga->pendapatan_pome_oil / $harga->penjualan_pome_oil : 0)</td>
                                                            <td>@comma($harga->penjualan_pkm ? $harga->pendapatan_pkm / $harga->penjualan_pkm : 0)</td>

                                                        </tr>
                                                    @endforeach
                                                    <tr class="text-center">
                                                        <th class="bg-primary-subtle" colspan="2">Total</th>
                                                        <th class="bg-primary-subtle">@comma($dataStock->totalHargaRataCangkang)</th>
                                                        <th class="bg-primary-subtle">@comma($dataStock->totalHargaRataFiber)</th>
                                                        <th class="bg-primary-subtle">@comma($dataStock->totalHargaRataTankos)</th>
                                                        <th class="bg-primary-subtle">@comma($dataStock->totalHargaRataAbuJanjang)</th>
                                                        <th class="bg-primary-subtle">@comma($dataStock->totalHargaRataSolid)</th>
                                                        <th class="bg-primary-subtle">@comma($dataStock->totalHargaRataPomeOil)</th>
                                                        <th class="bg-primary-subtle">@comma($dataStock->totalHargaRataPkm)</th>
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
                    url: "/api/dashboard-data-penjualan/" + bulan + "/" + tahun,
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
                        url: "/api/data-stok-chart-pie/" + bulan + "/" + tahun,
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
                            url: "api/data-region-stok-chart/" + bulan + "/" + tahun,
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
                                url: "api/data-produksi-digunakan-chart/" + bulan +
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
                                                // },
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
