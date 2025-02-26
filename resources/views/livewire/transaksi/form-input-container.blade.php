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
                                                    <th>Produksi</th>
                                                    <th>Cangkang</th>
                                                    <th>Fiber</th>
                                                    <th>Tankos</th>
                                                    <th>Abu Janjang</th>
                                                    <th>Solid</th>
                                                    <th>POME Oil</th>
                                                    <th>Abu Boiler</th>
                                                    <th>PKM</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="text-center">
                                                    <td class="w-25">{{ $dataMonitoring->nama_unit }}</td>
                                                    <td
                                                        style="{{ $dataMonitoring->id_produksi ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}">
                                                    </td>
                                                    <td
                                                        style="{{ $dataMonitoring->id_cangkang ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}">
                                                    </td>
                                                    <td
                                                        style="{{ $dataMonitoring->id_fiber ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}">
                                                    </td>
                                                    <td
                                                        style="{{ $dataMonitoring->id_tankos ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}">
                                                    </td>
                                                    <td
                                                        style="{{ $dataMonitoring->id_abu_janjang ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}">
                                                    </td>
                                                    <td
                                                        style="{{ $dataMonitoring->id_solid ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}">
                                                    </td>
                                                    <td
                                                        style="{{ $dataMonitoring->id_pome_oil ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}">
                                                    </td>
                                                    <td
                                                        style="{{ $dataMonitoring->id_abu_boiler ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}">
                                                    </td>
                                                    <td
                                                        style="{{ $dataMonitoring->id_pkm ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}">
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
                    @if ($jenis && $jenis == 'Produksi')
                        <livewire:transaksi.form-input-produksi :periode="$tanggal" :unit="$unit" />
                    @elseif ($jenis && $jenis == 'Cangkang')
                        <livewire:transaksi.form-input-cangkang :periode="$tanggal" :unit="$unit" />
                    @elseif ($jenis && $jenis == 'Fiber')
                        <livewire:transaksi.form-input-fiber :periode="$tanggal" :unit="$unit" />
                    @elseif ($jenis && $jenis == 'Tankos')
                        <livewire:transaksi.form-input-tankos :periode="$tanggal" :unit="$unit" />
                    @elseif ($jenis && $jenis == 'Abu Janjang')
                        <livewire:transaksi.form-input-abu-janjang :periode="$tanggal" :unit="$unit" />
                    @elseif($jenis && $jenis == 'Solid')
                        <livewire:transaksi.form-input-solid :periode="$tanggal" :unit="$unit" />
                    @elseif($jenis && $jenis == 'Pome Oil')
                        <livewire:transaksi.form-input-pome :periode="$tanggal" :unit="$unit" />
                    @elseif ($jenis && $jenis == 'PKM')
                        <livewire:transaksi.form-input-pkm :periode="$tanggal" :unit="$unit" />
                    @elseif ($jenis && $jenis == 'Abu Boiler')
                        <livewire:transaksi.form-input-abu-boiler :periode="$tanggal" :unit="$unit" />
                    @elseif ($jenis && $jenis == 'N1-Produksi')
                        <livewire:transaksi.form-input-produksi-n1 :periode="$tanggal" :unit="$unit" />
                    @elseif ($jenis && $jenis == 'N1-Teh-Tea Waste')
                        <livewire:transaksi.form-input-tea-waste :periode="$tanggal" :unit="$unit" />
                    @elseif ($jenis && $jenis == 'N1-Karet-Limbah Serum')
                        <livewire:transaksi.form-input-limbah-serum :periode="$tanggal" :unit="$unit" />    
                    @elseif ($jenis && $jenis == 'N1-Karet-Tunggul Karet')
                        <livewire:transaksi.form-input-tunggul-karet :periode="$tanggal" :unit="$unit" />    
                    @elseif ($jenis && $jenis == 'N1-Karet-Abu')
                        <livewire:transaksi.form-input-abu :periode="$tanggal" :unit="$unit" />    
                    @elseif ($jenis && $jenis == 'N1-Karet-Ranting')
                        <livewire:transaksi.form-input-ranting :periode="$tanggal" :unit="$unit" />    
                    @elseif ($jenis && $jenis == 'N1-Kopi-Kulit Buah')
                        <livewire:transaksi.form-input-ranting :periode="$tanggal" :unit="$unit" />    
                    @elseif ($jenis && $jenis == 'N1-Kopi-Husk Skin')
                        <livewire:transaksi.form-input-ranting :periode="$tanggal" :unit="$unit" />    
                    @elseif ($jenis && $jenis == 'N1-Kopi-Mucilage')
                        <livewire:transaksi.form-input-ranting :periode="$tanggal" :unit="$unit" />    

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
