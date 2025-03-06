@use('Carbon\Carbon')
<div>
    @if ($dataMonitoring)
        <div class="col-xl-12 mb-3" wire:key='{{ rand() }}'>
            <div class="accordion accordion-flush" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true"
                            aria-controls="panelsStayOpen-collapseTwo">
                            <i class=" fas fa-bookmark me-2 align-middle"></i>Monitoring Pengisian
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse show">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr class="text-center">
                                                    <th></th>
                                                    <th>N1-Produksi</th>
                                                    <th>N1-Teh-Tea Waste</th>
                                                    <th>N1-Teh-Abu HE</th>
                                                    <th>N1-Karet-Limbah Serum</th>
                                                    <th>N1-Karet-Tunggul Karet</th>
                                                    <th>N1-Karet-Abu</th>
                                                    <th>N1-Karet-Ranting</th>
                                                    <th>N1-Karet-Batang Kayu</th>
                                                    <th>N1-Karet-Rubber Trap</th>
                                                    <th>N1-Kopi-Kulit Buah</th>
                                                    <th>N1-Kopi-Husk Skin</th>
                                                    <th>N1-Kopi-Mucilage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="text-center">
                                                    <td class="w-25">{{ $dataMonitoring->nama_unit }}</td>
                                                    <td
                                                        style="{{ $dataMonitoring->id_produksi_n1 ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}">
                                                    </td>
                                                    <td
                                                        style="{{ $dataMonitoring->id_tea_waste ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}">
                                                    </td>
                                                    <td
                                                        style="{{ $dataMonitoring->id_abu_he ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}">
                                                    </td>
                                                    <td
                                                        style="{{ $dataMonitoring->id_limbah_serum ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}">
                                                    </td>
                                                    <td
                                                        style="{{ $dataMonitoring->id_tunggul_karet ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}">
                                                    </td>
                                                    <td
                                                        style="{{ $dataMonitoring->id_abu ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}">
                                                    </td>
                                                    <td
                                                        style="{{ $dataMonitoring->id_ranting ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}">
                                                    </td>
                                                    <td
                                                        style="{{ $dataMonitoring->id_batang_kayu ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}">
                                                    </td>
                                                    <td
                                                        style="{{ $dataMonitoring->id_rubber_trap ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}">
                                                    </td>
                                                    <td
                                                        style="{{ $dataMonitoring->id_kulit_buah ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}">
                                                    </td>
                                                    <td
                                                        style="{{ $dataMonitoring->id_husk_skin ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}">
                                                    </td>
                                                    <td
                                                        style="{{ $dataMonitoring->id_mucilage ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}">
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr class="text-center">
                                                    <th></th>
                                                    <th>Air</th>
                                                    <th>Listrik</th>
                                                    <th>BBM</th>
                                                    <th>Pelumas</th>
                                                    <th>Limbah Padat</th>
                                                    <th>Limbah B3</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="text-center">
                                                    <td class="w-25">{{ $dataMonitoring->nama_unit }}</td>
                                                    <td style="{{ 'background-color: #ff1e1e' }}">
                                                    </td>
                                                    <td style="{{ 'background-color: #ff1e1e' }}">
                                                    </td>
                                                    <td style="{{ 'background-color: #ff1e1e' }}">
                                                    </td>
                                                    <td style="{{ 'background-color: #ff1e1e' }}">
                                                    </td>
                                                    <td style="{{ 'background-color: #ff1e1e' }}">
                                                    </td>
                                                    <td style="{{ 'background-color: #ff1e1e' }}">
                                                    </td>
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
        </div>
    @endif

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div>
                    <div class="custom-loader-wrapper flex-center" wire:loading.flex>
                        <div class="custom-loader"></div>
                    </div>
                    @if ($unit)
                        <h5 class="text-center">Pengisian Data {{ $jenis }}
                            <br>{{ $namaUnit->nama_unit }}<br>Periode:
                            {{ Carbon::createFromFormat('m', $bulan)->locale('id')->translatedFormat('F') }}
                            {{ $tahun }}
                        </h5>
                    @else
                        <h5 class="text-center">Silahkan Pilih Periode dan Jenis Transaksi Terlebih Dahulu</h5>
                    @endif
                    @if ($jenis && $jenis == 'N1-Produksi')
                        <livewire:transaksi.form-input-produksi-n1 :periode="$tanggal" :unit="$unit" />
                    @elseif ($jenis && $jenis == 'N1-Teh-Tea Waste')
                        <livewire:transaksi.form-input-tea-waste :periode="$tanggal" :unit="$unit" />
                    @elseif ($jenis && $jenis == 'N1-Teh-Abu HE')
                        <livewire:transaksi.form-input-abu-he :periode="$tanggal" :unit="$unit" />
                    @elseif ($jenis && $jenis == 'N1-Karet-Limbah Serum')
                        <livewire:transaksi.form-input-limbah-serum :periode="$tanggal" :unit="$unit" />    
                    @elseif ($jenis && $jenis == 'N1-Karet-Tunggul Karet')
                        <livewire:transaksi.form-input-tunggul-karet :periode="$tanggal" :unit="$unit" />    
                    @elseif ($jenis && $jenis == 'N1-Karet-Abu')
                        <livewire:transaksi.form-input-abu :periode="$tanggal" :unit="$unit" />    
                    @elseif ($jenis && $jenis == 'N1-Karet-Ranting')
                        <livewire:transaksi.form-input-ranting :periode="$tanggal" :unit="$unit" />    
                    @elseif ($jenis && $jenis == 'N1-Karet-Batang Kayu')
                        <livewire:transaksi.form-input-batang-kayu :periode="$tanggal" :unit="$unit" />    
                    @elseif ($jenis && $jenis == 'N1-Karet-Rubber Trap')
                        <livewire:transaksi.form-input-rubber-trap :periode="$tanggal" :unit="$unit" />    
                    @elseif ($jenis && $jenis == 'N1-Kopi-Kulit Buah')
                        <livewire:transaksi.form-input-kulit-buah :periode="$tanggal" :unit="$unit" />    
                    @elseif ($jenis && $jenis == 'N1-Kopi-Husk Skin')
                        <livewire:transaksi.form-input-husk-skin :periode="$tanggal" :unit="$unit" />    
                    @elseif ($jenis && $jenis == 'N1-Kopi-Mucilage')
                        <livewire:transaksi.form-input-mucilage :periode="$tanggal" :unit="$unit" />    

                    @elseif($jenis)
                        {{-- <livewire:transaksi.form-input-air :periode="$tanggal" :unit="$unit" :jenis="$jenis" /> --}}
                        <div class="alert alert-label-warning text-center row mt-5">
                            <div class="col">
                                <h5 class="text-center mb-0">Belum Tersedia</h5>
                            </div>
                        </div>
                    @endif
                    {{-- <div class="row">
        <div class="col">
            <h5 class="text-center">Form Pengisian<br> Produksi {{ $unit->nama_unit }}
                Bulan
                {{ $bulan }} Tahun
                {{ $tahun }}</h5>
        </div>
    </div>
    @if ($jenis == 'Produksi')
        <livewire:transaksi.form-input-produksi :periode="$periode" :unit="$unitSelected" />
    @elseif($jenis == 'Cangkang')
        <livewire:transaksi.form-input-cangkang :periode="$periode" :unit="$unitSelected" />
    @elseif ($jenis == 'N1-Produksi')
        <livewire:transaksi.form-input-produksi-n1 :periode="$periode" :unit="$unitSelected" />

    @endif --}}
                </div>
            </div>
        </div>
    </div>
</div>
