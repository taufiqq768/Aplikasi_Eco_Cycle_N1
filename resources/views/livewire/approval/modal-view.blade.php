@use(Carbon\Carbon)
<div>
    <div wire:ignore.self class="modal fade" id="modalViewApproval">
        <div class="modal-dialog  modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    @if ($datas)
                        <h5 class="modal-title">Rincian Data Bulan
                            {{ Carbon::createFromDate($datas[0]->tanggal)->locale('id')->translatedFormat('F Y') }}<br>
                            {{ $datas[0]->nama_unit }}
                        </h5>
                    @endif
                    </h5>
                    <button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal">
                        <i class="mdi mdi-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div wire:loading>
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    &nbsp;Loading...
                                </div>

                            </div>
                            @if ($datas)
                                @foreach ($datas as $key => $data)
                                    <h5 class="text-center mt-5">
                                        Produksi
                                    </h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="text-center align-middle">
                                                    <th class="bg-primary-subtle">TBS Olah</th>
                                                    <th class="bg-primary-subtle">Produksi Cangkang</th>
                                                    <th class="bg-primary-subtle">Produksi Fiber</th>
                                                    <th class="bg-primary-subtle">Produksi Tankos</th>
                                                    <th class="bg-primary-subtle">Produksi Abu Janjang</th>
                                                    <th class="bg-primary-subtle">Produksi Solid</th>
                                                    <th class="bg-primary-subtle">Produksi POME Oil</th>
                                                    <th class="bg-primary-subtle">Produksi PKM</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="text-center">
                                                    <td>@thousands($data->tbs_olah)</td>
                                                    <td>@thousands($data->produksi_cangkang)</td>
                                                    <td>@thousands($data->produksi_fiber)</td>
                                                    <td>@thousands($data->produksi_tankos)</td>
                                                    <td>@thousands($data->produksi_abu_janjang)</td>
                                                    <td>@thousands($data->produksi_solid)</td>
                                                    <td>@thousands($data->produksi_pome_oil)</td>
                                                    <td>@thousands($data->produksi_pkm)</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    @if ($data->uuid_cangkang)
                                        <h5 class="text-center mt-5">
                                            Cangkang
                                        </h5>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="text-center align-middle">
                                                        <th class="bg-primary-subtle">Produksi Cangkang</th>
                                                        <th class="bg-primary-subtle">Digunakan untuk bahan bakar PKS
                                                        </th>
                                                        <th class="bg-primary-subtle">Dikirim ke Pabrik Teh</th>
                                                        <th class="bg-primary-subtle">Dikirim ke Pabrik Karet</th>
                                                        <th class="bg-primary-subtle">Dikirim ke Pabrik Gula</th>
                                                        <th class="bg-primary-subtle">Dikirim ke Bibitan Kelapa Sawit
                                                        </th>
                                                        <th class="bg-primary-subtle">Dikirim ke PKS Lain</th>
                                                        <th class="bg-primary-subtle">Diterima Dari PKS Lain</th>
                                                        <th class="bg-primary-subtle">Dijual</th>
                                                        <th class="bg-primary-subtle">Harga Jual Rata-rata</th>
                                                        <th class="bg-primary-subtle">Volume Keperluan Lain</th>
                                                        <th class="bg-primary-subtle">Keterangan Keperluan Lain</th>
                                                        <th class="bg-primary-subtle">Keterangan DO Pending</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="text-center">
                                                        <td>@thousands($data->produksi_cangkang)</td>
                                                        <td>@thousands($data->cangkang_digunakan_u_bahan_bakar)</td>
                                                        <td>@thousands($data->cangkang_dikirim_ke_pabrik_teh)</td>
                                                        <td>@thousands($data->cangkang_dikirim_ke_pabrik_karet)</td>
                                                        <td>@thousands($data->cangkang_dikirim_ke_pabrik_gula)</td>
                                                        <td>@thousands($data->cangkang_dikirim_ke_bibitan_kelapa_sawit)</td>
                                                        <td>@thousands($data->cangkang_dikirim_ke_pks_lain)</td>
                                                        <td>@thousands($data->cangkang_diterima_dari_pks_lain)</td>
                                                        <td>@thousands($data->cangkang_dijual)</td>
                                                        <td>@thousands($data->cangkang_harga_jual_rata_rata)</td>
                                                        <td>@thousands($data->cangkang_volume_keperluan_lain)</td>
                                                        <td>{{ $data->cangkang_keterangan_keperluan_lain }}</td>
                                                        <td>{{ $data->cangkang_keterangan_do_pending }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif

                                    @if ($data->uuid_fiber)
                                        <h5 class="text-center mt-5">
                                            Fiber
                                        </h5>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="text-center align-middle">
                                                        <th class="bg-primary-subtle">Produksi Fiber</th>
                                                        <th class="bg-primary-subtle">Digunakan untuk bahan bakar PKS
                                                        </th>
                                                        <th class="bg-primary-subtle">Dikirim ke Pabrik Teh</th>
                                                        <th class="bg-primary-subtle">Dikirim ke Pabrik Karet</th>
                                                        <th class="bg-primary-subtle">Dikirim ke Pabrik Gula</th>
                                                        <th class="bg-primary-subtle">Dikirim ke Bibitan Kelapa Sawit
                                                        </th>
                                                        <th class="bg-primary-subtle">Dikirim ke PKS Lain</th>
                                                        <th class="bg-primary-subtle">Diterima Dari PKS Lain</th>
                                                        <th class="bg-primary-subtle">Dijual</th>
                                                        <th class="bg-primary-subtle">Harga Jual Rata-rata</th>
                                                        <th class="bg-primary-subtle">Volume Keperluan Lain</th>
                                                        <th class="bg-primary-subtle">Keterangan Keperluan Lain</th>
                                                        <th class="bg-primary-subtle">Keterangan DO Pending</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="text-center">
                                                        <td>@thousands($data->produksi_fiber)</td>
                                                        <td>@thousands($data->fiber_digunakan_u_bahan_bakar)</td>
                                                        <td>@thousands($data->fiber_dikirim_ke_pabrik_teh)</td>
                                                        <td>@thousands($data->fiber_dikirim_ke_pabrik_karet)</td>
                                                        <td>@thousands($data->fiber_dikirim_ke_pabrik_gula)</td>
                                                        <td>@thousands($data->fiber_dikirim_ke_bibitan_kelapa_sawit)</td>
                                                        <td>@thousands($data->fiber_dikirim_ke_pks_lain)</td>
                                                        <td>@thousands($data->fiber_diterima_dari_pks_lain)</td>
                                                        <td>@thousands($data->fiber_dijual)</td>
                                                        <td>@thousands($data->fiber_harga_jual_rata_rata)</td>
                                                        <td>@thousands($data->fiber_volume_keperluan_lain)</td>
                                                        <td>{{ $data->fiber_keterangan_keperluan_lain }}</td>
                                                        <td>{{ $data->fiber_keterangan_do_pending }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif

                                    @if ($data->uuid_tankos)
                                        <h5 class="text-center mt-5">
                                            Tandan Kosong
                                        </h5>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="text-center align-middle">
                                                        <th class="bg-primary-subtle">Produksi Tankos</th>
                                                        <th class="bg-primary-subtle">Digunakan Sbg Pupuk Organik
                                                        </th>
                                                        <th class="bg-primary-subtle">Digunakan untuk PLTBm</th>
                                                        <th class="bg-primary-subtle">Dikembalikan ke Pemasok</th>
                                                        <th class="bg-primary-subtle">Dibakar di Tungku Bakar</th>
                                                        <th class="bg-primary-subtle">Diterima Dari PKS Lain</th>
                                                        <th class="bg-primary-subtle">Dijual</th>
                                                        <th class="bg-primary-subtle">Harga Jual Rata-rata</th>
                                                        <th class="bg-primary-subtle">Volume Keperluan Lain</th>
                                                        <th class="bg-primary-subtle">Keterangan Keperluan Lain</th>
                                                        <th class="bg-primary-subtle">Keterangan DO Pending</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="text-center align-middle">
                                                        <td>@thousands($data->produksi_tankos)</td>
                                                        <td>@thousands($data->tankos_digunakan_sbg_pupuk_organik)</td>
                                                        <td>@thousands($data->tankos_digunakan_u_pltbm)</td>
                                                        <td>@thousands($data->tankos_dikembalikan_ke_pemasok)</td>
                                                        <td>@thousands($data->tankos_dibakar_di_tungku_bakar)</td>
                                                        <td>@thousands($data->tankos_diterima_dari_pks_lain)</td>
                                                        <td>@thousands($data->tankos_dijual)</td>
                                                        <td>@thousands($data->tankos_harga_jual_rata_rata)</td>
                                                        <td>@thousands($data->tankos_volume_keperluan_lain)</td>
                                                        <td>{{ $data->tankos_keterangan_keperluan_lain }}</td>
                                                        <td>{{ $data->tankos_keterangan_do_pending }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif

                                    @if ($data->uuid_abu_janjang)
                                        <h5 class="text-center mt-5">
                                            Abu Janjang
                                        </h5>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="text-center align-middle">
                                                        <th class="bg-primary-subtle">Produksi Abu Janjang</th>
                                                        <th class="bg-primary-subtle">Tankos Dibakar</th>
                                                        <th class="bg-primary-subtle">Digunakan Sbg Pupuk Organik</th>
                                                        <th class="bg-primary-subtle">Diterima Dari PKS Lain</th>
                                                        <th class="bg-primary-subtle">Dijual</th>
                                                        <th class="bg-primary-subtle">Harga Jual Rata-rata</th>
                                                        <th class="bg-primary-subtle">Volume Keperluan Lain</th>
                                                        <th class="bg-primary-subtle">Keterangan Keperluan Lain</th>
                                                        <th class="bg-primary-subtle">Keterangan DO Pending</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="text-center">
                                                        <td>@thousands($data->produksi_abu_janjang)</td>
                                                        <td>@thousands($data->abu_janjang_tankos_dibakar)</td>
                                                        <td>@thousands($data->abu_janjang_digunakan_sbg_pupuk_organik)</td>
                                                        <td>@thousands($data->abu_janjang_diterima_dari_pks_lain)</td>
                                                        <td>@thousands($data->abu_janjang_dijual)</td>
                                                        <td>@thousands($data->abu_janjang_harga_jual_rata_rata)</td>
                                                        <td>@thousands($data->abu_janjang_volume_keperluan_lain)</td>
                                                        <td>{{ $data->abu_janjang_keterangan_keperluan_lain }}</td>
                                                        <td>{{ $data->abu_janjang_keterangan_do_pending }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif

                                    @if ($data->uuid_solid)
                                        <h5 class="text-center mt-5">
                                            Solid
                                        </h5>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th class="bg-primary-subtle">Produksi Solid</th>
                                                        <th class="bg-primary-subtle">Digunakan Sbg Pupuk Organik
                                                        </th>
                                                        <th class="bg-primary-subtle">Diterima Dari PKS Lain</th>
                                                        <th class="bg-primary-subtle">Dijual</th>
                                                        <th class="bg-primary-subtle">Harga Jual Rata-rata</th>
                                                        <th class="bg-primary-subtle">Volume Keperluan Lain</th>
                                                        <th class="bg-primary-subtle">Keterangan Keperluan Lain</th>
                                                        <th class="bg-primary-subtle">Keterangan DO Pending</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="text-center">
                                                        <td>@thousands($data->produksi_solid)</td>
                                                        <td>@thousands($data->solid_digunakan_sbg_pupuk_organik)</td>
                                                        <td>@thousands($data->solid_diterima_dari_pks_lain)</td>
                                                        <td>@thousands($data->solid_dijual)</td>
                                                        <td>@thousands($data->solid_harga_jual_rata_rata)</td>
                                                        <td>@thousands($data->solid_volume_keperluan_lain)</td>
                                                        <td>{{ $data->solid_keterangan_keperluan_lain }}</td>
                                                        <td>{{ $data->solid_keterangan_do_pending }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif

                                    @if ($data->uuid_pome)
                                        <h5 class="text-center mt-5">
                                            POME
                                        </h5>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="text-center align-middle">
                                                        <th class="bg-primary-subtle">Produksi Pome</th>
                                                        <th class="bg-primary-subtle">Digunakan Sbg Biogas PKS</th>
                                                        <th class="bg-primary-subtle">Dikirim ke Kebun utk Land
                                                            Aplikasi</th>
                                                        <th class="bg-primary-subtle">Dibuang ke Aliran Sungai</th>
                                                        <th class="bg-primary-subtle">Potensi Pome Oil</th>
                                                        <th class="bg-primary-subtle">Pome Oil Dikutip</th>
                                                        <th class="bg-primary-subtle">Pome Oil Terkutip Diolah Kembali
                                                        </th>
                                                        <th class="bg-primary-subtle">Pome Oil Terkutip Dikirim PKS
                                                            Lain</th>
                                                        <th class="bg-primary-subtle">Pome Oil Terkutip Dijual</th>
                                                        <th class="bg-primary-subtle">Harga Jual Rata-rata</th>
                                                        <th class="bg-primary-subtle">Volume Keperluan Lain</th>
                                                        <th class="bg-primary-subtle">Keterangan Keperluan Lain</th>
                                                        <th class="bg-primary-subtle">Diterima dari PKS Lain</th>
                                                        <th class="bg-primary-subtle">Keterangan DO Pending</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="text-center">
                                                        <td>@thousands($data->produksi_pome_oil)</td>
                                                        <td>@thousands($data->pome_digunakan_biogas_pks)</td>
                                                        <td>@thousands($data->pome_dikirim_kebun_u_land_aplikasi)</td>
                                                        <td>@thousands($data->pome_dibuang_ke_aliran_sungai)</td>
                                                        <td>@thousands($data->pome_potensi_pome_oil)</td>
                                                        <td>@thousands($data->pome_pome_oil_dikutip)</td>
                                                        <td>@thousands($data->pome_pome_oil_terkutip_diolah_kembali)</td>
                                                        <td>@thousands($data->pome_pome_oil_terkutip_dikirim_pks_lain)</td>
                                                        <td>@thousands($data->pome_pome_oil_terkutip_dijual)</td>
                                                        <td>@thousands($data->pome_harga_jual_rata_rata)</td>
                                                        <td>@thousands($data->pome_volume_keperluan_lain)</td>
                                                        <td>{{ $data->pome_keterangan_keperluan_lain }}</td>
                                                        <td>@thousands($data->pome_diterima_dari_pks_lain)</td>
                                                        <td>{{ $data->pome_keterangan_do_pending }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif

                                    @if ($data->uuid_pkm)
                                        <h5 class="text-center mt-5">
                                            PKM
                                        </h5>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th class="bg-primary-subtle">Inti Diolah</th>
                                                        <th class="bg-primary-subtle">Dijual</th>
                                                        <th class="bg-primary-subtle">Harga Jual Rata-rata</th>
                                                        <th class="bg-primary-subtle">Diterima Dari PKS Lain</th>
                                                        <th class="bg-primary-subtle">Volume Keperluan Lain</th>
                                                        <th class="bg-primary-subtle">Keterangan Keperluan Lain</th>
                                                        <th class="bg-primary-subtle">Keterangan DO Pending</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="text-center">
                                                        <td>@thousands($data->pkm_inti_diolah)</td>
                                                        <td>@thousands($data->pkm_dijual)</td>
                                                        <td>@thousands($data->pkm_harga_jual_rata_rata)</td>
                                                        <td>@thousands($data->pkm_diterima_dari_pks_lain)</td>
                                                        <td>@thousands($data->pkm_volume_keperluan_lain)</td>
                                                        <td>{{ $data->pkm_keterangan_keperluan_lain }}</td>
                                                        <td>{{ $data->pkm_keterangan_do_pending }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                @endforeach
                                <hr style="margin-top: 250px">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
