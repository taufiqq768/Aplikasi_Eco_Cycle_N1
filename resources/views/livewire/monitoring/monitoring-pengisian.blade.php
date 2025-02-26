@use(Carbon\Carbon)
<div>
    <div class="custom-loader-wrapper flex-center" wire:loading.flex>
        <div class="custom-loader"></div>
    </div>
    <x-page-title title="Monitoring">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
            <li class="breadcrumb-item ">Monitoring</li>
        </ol>
    </x-page-title>

    <div class="row">
        <div class="col-12 mt-3">
            <div class="card shadow-lg"
                style="background: url('{{ asset('assets/images/3d assets/Pattern2.png') }}'); background-position: center; background-repeat: no-repeat; background-size: cover; overflow: visible;">
                <div class="bg-overlay bg-primary-subtle rounded"></div>
                <div class="card-body position-relative">
                    <div class="row align-items-center">
                        <div class="col-8 col-lg-7">
                            <h4 class="fs-16 mb-1">Monitoring Pengisian Data</h4>
                            <p class="text-muted mb-0">Pengisian Data Bulan
                                {{ Carbon::createFromFormat('m', $bulan)->locale('id')->translatedFormat('F') }} Tahun
                                2024</p>
                            <div class="col-lg-3">
                                <div class=" mt-4">
                                    <input type="text" class="form-control" placeholder="Periode" id="datepicker-1"
                                        wire:ignore.self autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="col-4 col-lg-5 position-relative d-sm-block d-none">
                            <img src="{{ asset('assets/images/3d assets/Monitoring 1 3D.png') }}" alt=""
                                class="position-absolute" style="height: 20vh; right: 0; top: -11vh; z-index: 1;">
                        </div>
                        <div class="col-4 col-lg-5 position-relative d-sm-none d-block">
                            <img src="{{ asset('assets/images/3d assets/Monitoring 1 3D.png') }}" alt=""
                                class="position-absolute" style="height: 15vh; right: -5vh; top: -8vh; z-index: 1;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12" wire:key='{{ rand() }}'>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr class="text-center">
                                    <th>Region</th>
                                    <th>Unit</th>
                                    <th>Produksi</th>
                                    <th>Cangkang</th>
                                    <th>Fiber</th>
                                    <th>Tankos</th>
                                    <th>Abu Janjang</th>
                                    <th>Solid</th>
                                    <th>POME</th>
                                    <th>Abu Boiler</th>
                                    <th>PKM</th>
                                    <th>N1-Tea Waste</th>
                                    <th>N1-Limbah Serum</th>
                                    <th>N1-Tunggul Karet</th>
                                    <th>N1-Abu</th>
                                    <th>N1-Ranting</th>
                                    <th>N1-Kulit Buah</th>
                                    <th>N1-Husk Skin</th>
                                    <th>N1-Mucilage</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $reg = '';
                                    $unit = '';
                                @endphp
                                @foreach ($data as $item)
                                    @if ($reg != $item->region)
                                        <tr class="">
                                            <td colspan="11" class=" align-middle bg-light">
                                                <h6 class="text-center my-1">{{ $item->region }}</h6>
                                            </td>
                                        </tr>
                                        @php
                                            $reg = $item->region;
                                        @endphp
                                    @endif
                                    <tr class="text-center align-middle">
                                        <td>
                                            {{ $item->region }}
                                        </td>
                                        @if ($unit == $item->unit)
                                            <td class="text-start">
                                                {{ $item->unit }}&nbsp;
                                                <span class="text-warning"> <i class="fas fa-exclamation-triangle"></i>
                                                </span>
                                            </td>
                                        @else
                                            <td class="text-start">{{ $item->unit }}</td>
                                        @endif
                                        @php
                                            $unit = $item->unit;
                                        @endphp
                                        <td style="{{ $item->id_produksi ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}; padding: 0; height: 100%;"
                                            onmouseover="if('{{ $item->id_produksi }}') this.style.backgroundColor='#0ccf01';"
                                            onmouseout="if('{{ $item->id_produksi }}') this.style.backgroundColor='#0eff01';">
                                            @if ($item->id_produksi)
                                                <button class="btn w-100 "
                                                    @click="showModal('{{ $item->id_produksi }}', 't_produksi')"
                                                    style="border: none; background-color: transparent; padding: 0; margin: 0; height: 100%;">
                                                    <span
                                                        style="visibility: hidden; height: 50px; overflow: hidden">&nbsp;</span>
                                                </button>
                                            @endif
                                        </td>
                                        @if ($item->jenis_unit == 'PPIS')
                                            <td style="background-color: #f0e68c; padding: 0; height: 100%;">
                                            </td>
                                        @else
                                            <td style="{{ $item->id_cangkang ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}; padding: 0; height: 100%;"
                                                onmouseover="if('{{ $item->id_cangkang }}') this.style.backgroundColor='#0ccf01';"
                                                onmouseout="if('{{ $item->id_cangkang }}') this.style.backgroundColor='#0eff01';">
                                                @if ($item->id_cangkang)
                                                    <button class="btn w-100 "
                                                        @click="showModal('{{ $item->id_cangkang }}', 't_cangkang')"
                                                        style="border: none; background-color: transparent; padding: 0; margin: 0; height: 100%;">
                                                        <span
                                                            style="visibility: hidden; height: 50px; overflow: hidden">&nbsp;</span>
                                                    </button>
                                                @endif
                                        @endif
                                        </td>
                                        @if ($item->jenis_unit == 'PPIS')
                                            <td style="background-color: #f0e68c; padding: 0; height: 100%;">
                                            </td>
                                        @else
                                            <td style="{{ $item->id_fiber ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}; padding: 0; height: 100%;"
                                                onmouseover="if('{{ $item->id_fiber }}') this.style.backgroundColor='#0ccf01';"
                                                onmouseout="if('{{ $item->id_fiber }}') this.style.backgroundColor='#0eff01';">
                                                @if ($item->id_fiber)
                                                    <button class="btn w-100 "
                                                        @click="showModal('{{ $item->id_fiber }}', 't_fiber')"
                                                        style="border: none; background-color: transparent; padding: 0; margin: 0; height: 100%;">
                                                        <span
                                                            style="visibility: hidden; height: 50px; overflow: hidden">&nbsp;</span>
                                                    </button>
                                                @endif
                                        @endif
                                        </td>
                                        @if ($item->jenis_unit == 'PPIS')
                                            <td style="background-color: #f0e68c; padding: 0; height: 100%;">
                                            </td>
                                        @else
                                            <td style="{{ $item->id_tankos ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}; padding: 0; height: 100%;"
                                                onmouseover="if('{{ $item->id_tankos }}') this.style.backgroundColor='#0ccf01';"
                                                onmouseout="if('{{ $item->id_tankos }}') this.style.backgroundColor='#0eff01';">
                                                @if ($item->id_tankos)
                                                    <button class="btn w-100 "
                                                        @click="showModal('{{ $item->id_tankos }}', 't_tankos')"
                                                        style="border: none; background-color: transparent; padding: 0; margin: 0; height: 100%;">
                                                        <span
                                                            style="visibility: hidden; height: 50px; overflow: hidden">&nbsp;</span>
                                                    </button>
                                                @endif
                                        @endif
                                        </td>
                                        @if ($item->jenis_unit == 'PPIS')
                                            <td style="background-color: #f0e68c; padding: 0; height: 100%;">
                                            </td>
                                        @else
                                            <td style="{{ $item->id_abu_janjang ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}; padding: 0; height: 100%;"
                                                onmouseover="if('{{ $item->id_abu_janjang }}') this.style.backgroundColor='#0ccf01';"
                                                onmouseout="if('{{ $item->id_abu_janjang }}') this.style.backgroundColor='#0eff01';">
                                                @if ($item->id_abu_janjang)
                                                    <button class="btn w-100 "
                                                        @click="showModal('{{ $item->id_abu_janjang }}', 't_abu_janjang')"
                                                        style="border: none; background-color: transparent; padding: 0; margin: 0; height: 100%;">
                                                        <span
                                                            style="visibility: hidden; height: 50px; overflow: hidden">&nbsp;</span>
                                                    </button>
                                                @endif
                                        @endif
                                        </td>
                                        @if ($item->jenis_unit == 'PPIS')
                                            <td style="background-color: #f0e68c; padding: 0; height: 100%;">
                                            </td>
                                        @else
                                            <td style="{{ $item->id_solid ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}; padding: 0; height: 100%;"
                                                onmouseover="if('{{ $item->id_solid }}') this.style.backgroundColor='#0ccf01';"
                                                onmouseout="if('{{ $item->id_solid }}') this.style.backgroundColor='#0eff01';">
                                                @if ($item->id_solid)
                                                    <button class="btn w-100 "
                                                        @click="showModal('{{ $item->id_solid }}', 't_solid')"
                                                        style="border: none; background-color: transparent; padding: 0; margin: 0; height: 100%;">
                                                        <span
                                                            style="visibility: hidden; height: 50px; overflow: hidden">&nbsp;</span>
                                                    </button>
                                                @endif
                                        @endif
                                        </td>
                                        @if ($item->jenis_unit == 'PPIS')
                                            <td style="background-color: #f0e68c; padding: 0; height: 100%;">
                                            </td>
                                        @else
                                            <td style="{{ $item->id_pome ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}; padding: 0; height: 100%;"
                                                onmouseover="if('{{ $item->id_pome }}') this.style.backgroundColor='#0ccf01';"
                                                onmouseout="if('{{ $item->id_pome }}') this.style.backgroundColor='#0eff01';">
                                                @if ($item->id_pome)
                                                    <button class="btn w-100 "
                                                        @click="showModal('{{ $item->id_pome }}', 't_pome')"
                                                        style="border: none; background-color: transparent; padding: 0; margin: 0; height: 100%;">
                                                        <span
                                                            style="visibility: hidden; height: 50px; overflow: hidden">&nbsp;</span>
                                                    </button>
                                                @endif
                                        @endif
                                        </td>
                                        @if ($item->jenis_unit == 'PPIS')
                                            <td style="background-color: #f0e68c; padding: 0; height: 100%;">
                                            </td>
                                        @else
                                            <td style="{{ $item->id_abu_boiler ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}; padding: 0; height: 100%;"
                                                onmouseover="if('{{ $item->id_abu_boiler }}') this.style.backgroundColor='#0ccf01';"
                                                onmouseout="if('{{ $item->id_abu_boiler }}') this.style.backgroundColor='#0eff01';">
                                                @if ($item->id_abu_boiler)
                                                    <button class="btn w-100 "
                                                        @click="showModal('{{ $item->id_abu_boiler }}', 't_abu_janjang')"
                                                        style="border: none; background-color: transparent; padding: 0; margin: 0; height: 100%;">
                                                        <span
                                                            style="visibility: hidden; height: 50px; overflow: hidden">&nbsp;</span>
                                                    </button>
                                                @endif
                                        @endif
                                        @if ($item->jenis_unit != 'PPIS')
                                            <td style="background-color: #f0e68c; padding: 0; height: 100%;">
                                            </td>
                                        @else
                                            <td style="{{ $item->id_pkm ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}; padding: 0; height: 100%;"
                                                onmouseover="if('{{ $item->id_pkm }}') this.style.backgroundColor='#0ccf01';"
                                                onmouseout="if('{{ $item->id_pkm }}') this.style.backgroundColor='#0eff01';">
                                                @if ($item->id_pkm)
                                                    <button class="btn w-100 "
                                                        @click="showModal('{{ $item->id_pkm }}', 't_pkm')"
                                                        style="border: none; background-color: transparent; padding: 0; margin: 0; height: 100%;">
                                                        <span
                                                            style="visibility: hidden; height: 50px; overflow: hidden">&nbsp;</span>
                                                    </button>
                                                @endif
                                        @endif
                                        <!-- PTPN1 -->
                                        @if ($item->jenis_unit == 'PPIS')
                                            <td style="background-color: #f0e68c; padding: 0; height: 100%;">
                                            </td>
                                        @else
                                            <td style="{{ $item->id_teawaste ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}; padding: 0; height: 100%;"
                                                onmouseover="if('{{ $item->id_teawaste }}') this.style.backgroundColor='#0ccf01';"
                                                onmouseout="if('{{ $item->id_teawaste }}') this.style.backgroundColor='#0eff01';">
                                                @if ($item->id_teawaste)
                                                    <button class="btn w-100 "
                                                        @click="showModal('{{ $item->id_teawaste }}', 't_teawaste')"
                                                        style="border: none; background-color: transparent; padding: 0; margin: 0; height: 100%;">
                                                        <span
                                                            style="visibility: hidden; height: 50px; overflow: hidden">&nbsp;</span>
                                                    </button>
                                                @endif
                                        @endif
                                        @if ($item->jenis_unit == 'PPIS')
                                            <td style="background-color: #f0e68c; padding: 0; height: 100%;">
                                            </td>
                                        @else
                                            <td style="{{ $item->id_limbahserum ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}; padding: 0; height: 100%;"
                                                onmouseover="if('{{ $item->id_limbahserum }}') this.style.backgroundColor='#0ccf01';"
                                                onmouseout="if('{{ $item->id_limbahserum }}') this.style.backgroundColor='#0eff01';">
                                                @if ($item->id_limbahserum)
                                                    <button class="btn w-100 "
                                                        @click="showModal('{{ $item->id_limbahserum }}', 't_limbahserum')"
                                                        style="border: none; background-color: transparent; padding: 0; margin: 0; height: 100%;">
                                                        <span
                                                            style="visibility: hidden; height: 50px; overflow: hidden">&nbsp;</span>
                                                    </button>
                                                @endif
                                        @endif
                                        @if ($item->jenis_unit == 'PPIS')
                                            <td style="background-color: #f0e68c; padding: 0; height: 100%;">
                                            </td>
                                        @else
                                            <td style="{{ $item->id_tunggulkaret ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}; padding: 0; height: 100%;"
                                                onmouseover="if('{{ $item->id_tunggulkaret }}') this.style.backgroundColor='#0ccf01';"
                                                onmouseout="if('{{ $item->id_tunggulkaret }}') this.style.backgroundColor='#0eff01';">
                                                @if ($item->id_tunggulkaret)
                                                    <button class="btn w-100 "
                                                        @click="showModal('{{ $item->id_tunggulkaret }}', 't_tunggulkaret')"
                                                        style="border: none; background-color: transparent; padding: 0; margin: 0; height: 100%;">
                                                        <span
                                                            style="visibility: hidden; height: 50px; overflow: hidden">&nbsp;</span>
                                                    </button>
                                                @endif
                                        @endif                                        
                                        @if ($item->jenis_unit == 'PPIS')
                                            <td style="background-color: #f0e68c; padding: 0; height: 100%;">
                                            </td>
                                        @else
                                            <td style="{{ $item->id_abu ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}; padding: 0; height: 100%;"
                                                onmouseover="if('{{ $item->id_abu }}') this.style.backgroundColor='#0ccf01';"
                                                onmouseout="if('{{ $item->id_abu }}') this.style.backgroundColor='#0eff01';">
                                                @if ($item->id_abu)
                                                    <button class="btn w-100 "
                                                        @click="showModal('{{ $item->id_abu }}', 't_abu')"
                                                        style="border: none; background-color: transparent; padding: 0; margin: 0; height: 100%;">
                                                        <span
                                                            style="visibility: hidden; height: 50px; overflow: hidden">&nbsp;</span>
                                                    </button>
                                                @endif
                                        @endif
                                        @if ($item->jenis_unit == 'PPIS')
                                            <td style="background-color: #f0e68c; padding: 0; height: 100%;">
                                            </td>
                                        @else
                                            <td style="{{ $item->id_ranting ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}; padding: 0; height: 100%;"
                                                onmouseover="if('{{ $item->id_ranting }}') this.style.backgroundColor='#0ccf01';"
                                                onmouseout="if('{{ $item->id_ranting }}') this.style.backgroundColor='#0eff01';">
                                                @if ($item->id_ranting)
                                                    <button class="btn w-100 "
                                                        @click="showModal('{{ $item->id_ranting }}', 't_ranting')"
                                                        style="border: none; background-color: transparent; padding: 0; margin: 0; height: 100%;">
                                                        <span
                                                            style="visibility: hidden; height: 50px; overflow: hidden">&nbsp;</span>
                                                    </button>
                                                @endif
                                        @endif 
                                        @if ($item->jenis_unit == 'PPIS')
                                            <td style="background-color: #f0e68c; padding: 0; height: 100%;">
                                            </td>
                                        @else
                                            <td style="{{ $item->id_kulitbuah ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}; padding: 0; height: 100%;"
                                                onmouseover="if('{{ $item->id_kulitbuah }}') this.style.backgroundColor='#0ccf01';"
                                                onmouseout="if('{{ $item->id_kulitbuah }}') this.style.backgroundColor='#0eff01';">
                                                @if ($item->id_kulitbuah)
                                                    <button class="btn w-100 "
                                                        @click="showModal('{{ $item->id_kulitbuah }}', 't_kulitbuah')"
                                                        style="border: none; background-color: transparent; padding: 0; margin: 0; height: 100%;">
                                                        <span
                                                            style="visibility: hidden; height: 50px; overflow: hidden">&nbsp;</span>
                                                    </button>
                                                @endif
                                        @endif 
                                        @if ($item->jenis_unit == 'PPIS')
                                            <td style="background-color: #f0e68c; padding: 0; height: 100%;">
                                            </td>
                                        @else
                                            <td style="{{ $item->id_huskskin ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}; padding: 0; height: 100%;"
                                                onmouseover="if('{{ $item->id_huskskin }}') this.style.backgroundColor='#0ccf01';"
                                                onmouseout="if('{{ $item->id_huskskin }}') this.style.backgroundColor='#0eff01';">
                                                @if ($item->id_huskskin)
                                                    <button class="btn w-100 "
                                                        @click="showModal('{{ $item->id_huskskin }}', 't_huskskin')"
                                                        style="border: none; background-color: transparent; padding: 0; margin: 0; height: 100%;">
                                                        <span
                                                            style="visibility: hidden; height: 50px; overflow: hidden">&nbsp;</span>
                                                    </button>
                                                @endif
                                        @endif 
                                        @if ($item->jenis_unit == 'PPIS')
                                            <td style="background-color: #f0e68c; padding: 0; height: 100%;">
                                            </td>
                                        @else
                                            <td style="{{ $item->id_mucilage ? 'background-color: #0eff01' : 'background-color: #ff1e1e' }}; padding: 0; height: 100%;"
                                                onmouseover="if('{{ $item->id_mucilage }}') this.style.backgroundColor='#0ccf01';"
                                                onmouseout="if('{{ $item->id_mucilage }}') this.style.backgroundColor='#0eff01';">
                                                @if ($item->id_mucilage)
                                                    <button class="btn w-100 "
                                                        @click="showModal('{{ $item->id_mucilage }}', 't_mucilage')"
                                                        style="border: none; background-color: transparent; padding: 0; margin: 0; height: 100%;">
                                                        <span
                                                            style="visibility: hidden; height: 50px; overflow: hidden">&nbsp;</span>
                                                    </button>
                                                @endif
                                        @endif 

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
    <livewire:monitoring.monitoring-modal />
    <script>
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
            console.log(bulan, tahun);
            Livewire.dispatch('setData', {
                'bulan': bulan,
                'tahun': tahun
            });
        });

        function showModal(id, jenis) {
            $('#modalMonitoring').modal('show');
            Livewire.dispatch('showModal', {
                'id': id,
                'jenis': jenis
            });
        }
    </script>
@endpush
