@use('Carbon\Carbon')
<div wire:ignore.self class="modal fade" id="modalMonitoring">
    <div class="modal-dialog  modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail </h5><button type="button" class="btn btn-sm btn-label-danger btn-icon"
                    data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12" wire:loading>
                        <p>Loading...</p>
                        <h5 class="card-title placeholder-glow">
                            <span class="placeholder col-12"></span>
                            <span class="placeholder col-12"></span>
                        </h5>
                    </div>
                    <div class="col-12" wire:loading.remove>
                        <div class="table-responsive">
                            @if ($dataModal && $jenis == 't_cangkang')
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th class="bg-primary-subtle text-center">PKS</th>
                                            <th class="bg-primary-subtle">TBS Olah</th>
                                            <th class="bg-primary-subtle">Produksi Cangkang</th>
                                            <th class="bg-primary-subtle">Digunakan untuk bahan bakar PKS
                                            </th>
                                            <th class="bg-primary-subtle">Dikirim ke Pabrik Teh</th>
                                            <th class="bg-primary-subtle">Dikirim ke Pabrik Karet</th>
                                            <th class="bg-primary-subtle">Dikirim ke Pabrik Gula</th>
                                            <th class="bg-primary-subtle">Dikirim ke Bibitan Kelapa Sawit</th>
                                            <th class="bg-primary-subtle">Dikirim ke PKS Lain</th>
                                            <th class="bg-primary-subtle">Diterima Dari PKS Lain</th>
                                            <th class="bg-primary-subtle">Dijual</th>
                                            <th class="bg-primary-subtle">Harga Jual Rata-rata</th>
                                            <th class="bg-primary-subtle">Volume Keperluan Lain</th>
                                            <th class="bg-primary-subtle">Keterangan Keperluan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataModal as $data)
                                            <tr class="text-center align-middle">
                                                <td class="text-nowrap">{{ $data->nama_unit }}</td>
                                                <td>@thousands($data->tbs_olah)</td>
                                                <td>@thousands($data->produksi_cangkang)</td>
                                                <td>@thousands($data->digunakan_u_bahan_bakar)</td>
                                                <td>@thousands($data->dikirim_ke_pabrik_teh)</td>
                                                <td>@thousands($data->dikirim_ke_pabrik_karet)</td>
                                                <td>@thousands($data->dikirim_ke_pabrik_gula)</td>
                                                <td>@thousands($data->dikirim_ke_bibitan_kelapa_sawit)</td>
                                                <td>@thousands($data->dikirim_ke_pks_lain)</td>
                                                <td>@thousands($data->diterima_dari_pks_lain)</td>
                                                <td>@thousands($data->dijual)</td>
                                                <td>@thousands($data->harga_jual_rata_rata)</td>
                                                <td>@thousands($data->volume_keperluan_lain)</td>
                                                <td>{{ $data->keterangan_keperluan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @elseif($dataModal && $jenis == 't_fiber')
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th class="bg-primary-subtle text-center">PKS</th>
                                            <th class="bg-primary-subtle">TBS Olah</th>
                                            <th class="bg-primary-subtle">Produksi Fiber</th>
                                            <th class="bg-primary-subtle">Digunakan untuk bahan bakar PKS
                                            </th>
                                            <th class="bg-primary-subtle">Dikirim ke Pabrik Teh</th>
                                            <th class="bg-primary-subtle">Dikirim ke Pabrik Karet</th>
                                            <th class="bg-primary-subtle">Dikirim ke Pabrik Gula</th>
                                            <th class="bg-primary-subtle">Dikirim ke Bibitan Kelapa Sawit</th>
                                            <th class="bg-primary-subtle">Dikirim ke PKS Lain</th>
                                            <th class="bg-primary-subtle">Diterima Dari PKS Lain</th>
                                            <th class="bg-primary-subtle">Dijual</th>
                                            <th class="bg-primary-subtle">Harga Jual Rata-rata</th>
                                            <th class="bg-primary-subtle">Volume Keperluan Lain</th>
                                            <th class="bg-primary-subtle">Keterangan Keperluan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataModal as $data)
                                            <tr class="text-center align-middle">
                                                <td class="text-nowrap">{{ $data->nama_unit }}</td>
                                                <td>@thousands($data->tbs_olah)</td>
                                                <td>@thousands($data->produksi_fiber)</td>
                                                <td>@thousands($data->digunakan_u_bahan_bakar)</td>
                                                <td>@thousands($data->dikirim_ke_pabrik_teh)</td>
                                                <td>@thousands($data->dikirim_ke_pabrik_karet)</td>
                                                <td>@thousands($data->dikirim_ke_pabrik_gula)</td>
                                                <td>@thousands($data->dikirim_ke_bibitan_kelapa_sawit)</td>
                                                <td>@thousands($data->dikirim_ke_pks_lain)</td>
                                                <td>@thousands($data->diterima_dari_pks_lain)</td>
                                                <td>@thousands($data->dijual)</td>
                                                <td>@thousands($data->harga_jual_rata_rata)</td>
                                                <td>@thousands($data->volume_keperluan_lain)</td>
                                                <td>{{ $data->keterangan_keperluan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @elseif($dataModal && $jenis == 't_tankos')
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th class="bg-primary-subtle text-center">PKS</th>
                                            <th class="bg-primary-subtle">TBS Olah</th>
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
                                            <th class="bg-primary-subtle">Keterangan Keperluan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataModal as $data)
                                            <tr class="text-center align-middle">
                                                <td class="text-nowrap">{{ $data->nama_unit }}</td>
                                                <td>@thousands($data->tbs_olah)</td>
                                                <td>@thousands($data->produksi_tankos)</td>
                                                <td>@thousands($data->digunakan_sbg_pupuk_organik)</td>
                                                <td>@thousands($data->digunakan_u_pltbm)</td>
                                                <td>@thousands($data->dikembalikan_ke_pemasok)</td>
                                                <td>@thousands($data->dibakar_di_tungku_bakar)</td>
                                                <td>@thousands($data->diterima_dari_pks_lain)</td>
                                                <td>@thousands($data->dijual)</td>
                                                <td>@thousands($data->harga_jual_rata_rata)</td>
                                                <td>@thousands($data->volume_keperluan_lain)</td>
                                                <td>{{ $data->keterangan_keperluan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @elseif($dataModal && $jenis == 't_produksi')
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th class="bg-info text-center">PKS</th>
                                            <th class="bg-info">TBS Olah</th>
                                            <th class="bg-info">Produksi Cangkang</th>
                                            <th class="bg-info">Produksi Fiber</th>
                                            <th class="bg-info">Produksi Tankos</th>
                                            <th class="bg-info">Produksi Abu Janjang</th>
                                            <th class="bg-info">Produksi Solid</th>
                                            <th class="bg-info">Produksi POME Oil</th>
                                            <th class="bg-info">Produksi PKM</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataModal as $data)
                                            <tr class="text-center">
                                                <td>{{ $data->unit }}</td>
                                                <td>@thousands($data->tbs_olah)</td>
                                                <td>@thousands($data->produksi_cangkang)</td>
                                                <td>@thousands($data->produksi_fiber)</td>
                                                <td>@thousands($data->produksi_tankos)</td>
                                                <td>@thousands($data->produksi_abu_janjang)</td>
                                                <td>@thousands($data->produksi_solid)</td>
                                                <td>@thousands($data->produksi_pome_oil)</td>
                                                <td>@thousands($data->produksi_pkm)</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @elseif($dataModal && $jenis == 't_abu_janjang')
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th class="bg-primary-subtle text-center">PKS</th>
                                            <th class="bg-primary-subtle">TBS Olah</th>
                                            <th class="bg-primary-subtle">Produksi Abu Janjang</th>
                                            <th class="bg-primary-subtle">Tankos Dibakar</th>
                                            <th class="bg-primary-subtle">Digunakan Sbg Pupuk Organik</th>
                                            <th class="bg-primary-subtle">Diterima Dari PKS Lain</th>
                                            <th class="bg-primary-subtle">Dijual</th>
                                            <th class="bg-primary-subtle">Harga Jual Rata-rata</th>
                                            <th class="bg-primary-subtle">Volume Keperluan Lain</th>
                                            <th class="bg-primary-subtle">Keterangan Keperluan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataModal as $data)
                                            <tr class="text-center align-middle">
                                                <td class="text-nowrap">{{ $data->nama_unit }}</td>
                                                <td>@thousands($data->tbs_olah)</td>
                                                <td>@thousands($data->produksi_abu_janjang)</td>
                                                <td>@thousands($data->tankos_dibakar)</td>
                                                <td>@thousands($data->digunakan_sbg_pupuk_organik)</td>
                                                <td>@thousands($data->diterima_dari_pks_lain)</td>
                                                <td>@thousands($data->dijual)</td>
                                                <td>@thousands($data->harga_jual_rata_rata)</td>
                                                <td>@thousands($data->volume_keperluan_lain)</td>
                                                <td>{{ $data->keterangan_keperluan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @elseif($dataModal && $jenis == 't_solid')
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th class="bg-primary-subtle text-center">PKS</th>
                                            <th class="bg-primary-subtle">TBS Olah</th>
                                            <th class="bg-primary-subtle">Produksi Solid</th>
                                            <th class="bg-primary-subtle">Digunakan Sbg Pupuk Organik
                                            </th>
                                            <th class="bg-primary-subtle">Diterima Dari PKS Lain</th>
                                            <th class="bg-primary-subtle">Dijual</th>
                                            <th class="bg-primary-subtle">Harga Jual Rata-rata</th>
                                            <th class="bg-primary-subtle">Volume Keperluan Lain</th>
                                            <th class="bg-primary-subtle">Keterangan Keperluan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataModal as $data)
                                            <tr class="text-center align-middle">
                                                <td class="text-nowrap">{{ $data->nama_unit }}</td>
                                                <td>@thousands($data->tbs_olah)</td>
                                                <td>@thousands($data->produksi_solid)</td>
                                                <td>@thousands($data->digunakan_sbg_pupuk_organik)</td>
                                                <td>@thousands($data->diterima_dari_pks_lain)</td>
                                                <td>@thousands($data->dijual)</td>
                                                <td>@thousands($data->harga_jual_rata_rata)</td>
                                                <td>@thousands($data->volume_keperluan_lain)</td>
                                                <td>{{ $data->keterangan_keperluan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @elseif($dataModal && $jenis == 't_pome')
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th class="bg-primary-subtle text-center">PKS</th>
                                            <th class="bg-primary-subtle">TBS Olah</th>
                                            <th class="bg-primary-subtle">Produksi Pome</th>
                                            <th class="bg-primary-subtle">Digunakan Sbg Biogas PKS</th>
                                            <th class="bg-primary-subtle">Dikirim ke Kebun utk Land Aplikasi</th>
                                            <th class="bg-primary-subtle">Dibuang ke Aliran Sungai</th>
                                            <th class="bg-primary-subtle">Potensi Pome Oil</th>
                                            <th class="bg-primary-subtle">Pome Oil Dikutip</th>
                                            <th class="bg-primary-subtle">Pome Oil Terkutip Diolah Kembali</th>
                                            <th class="bg-primary-subtle">Pome Oil Terkutip Dikirim PKS Lain</th>
                                            <th class="bg-primary-subtle">Pome Oil Terkutip Dijual</th>
                                            <th class="bg-primary-subtle">Harga Jual Rata-rata</th>
                                            <th class="bg-primary-subtle">Volume Keperluan Lain</th>
                                            <th class="bg-primary-subtle">Keterangan Keperluan</th>
                                            <th class="bg-primary-subtle">Diterima dari PKS Lain</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataModal as $data)
                                            <tr class="text-center align-middle">
                                                <td class="text-nowrap">{{ $data->nama_unit }}</td>
                                                <td>@thousands($data->tbs_olah)</td>
                                                <td>@thousands($data->produksi_pome_oil)</td>
                                                <td>@thousands($data->digunakan_sbg_biogas_pks)</td>
                                                <td>@thousands($data->dikirim_kebun_u_land_aplikasi)</td>
                                                <td>@thousands($data->dibuang_ke_aliran_sungai)</td>
                                                <td>@thousands($data->potensi_pome_oil)</td>
                                                <td>@thousands($data->pome_oil_dikutip)</td>
                                                <td>@thousands($data->pome_oil_terkutip_diolah_kembali)</td>
                                                <td>@thousands($data->pome_oil_terkutip_dikirim_pks_lain)</td>
                                                <td>@thousands($data->pome_oil_terkutip_dijual)</td>
                                                <td>@thousands($data->harga_jual_rata_rata)</td>
                                                <td>@thousands($data->volume_keperluan_lain)</td>
                                                <td>{{ $data->keterangan_keperluan }}</td>
                                                <td>@thousands($data->diterima_dari_pks_lain)</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @elseif($dataModal && $jenis == 't_pkm')
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th class="bg-primary-subtle text-center">PPIS</th>
                                            <th class="bg-primary-subtle">TBS Olah</th>
                                            <th class="bg-primary-subtle">Inti Diolah</th>
                                            <th class="bg-primary-subtle">Inti Diolah</th>
                                            <th class="bg-primary-subtle">Dijual</th>
                                            <th class="bg-primary-subtle">Harga Jual Rata-rata</th>
                                            <th class="bg-primary-subtle">Diterima Dari PKS Lain</th>
                                            <th class="bg-primary-subtle">Volume Keperluan Lain</th>
                                            <th class="bg-primary-subtle">Keterangan Keperluan Lain</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataModal as $data)
                                            <tr class="text-center align-middle">
                                                <td class="text-nowrap">{{ $data->nama_unit }}</td>
                                                <td>@thousands($data->tbs_olah)</td>
                                                <td>@thousands($data->inti_diolah)</td>
                                                <td>@thousands($data->dijual)</td>
                                                <td>@thousands($data->harga_jual_rata_rata)</td>
                                                <td>@thousands($data->diterima_dari_pks_lain)</td>
                                                <td>@thousands($data->volume_keperluan_lain)</td>
                                                <td>{{ $data->keterangan_keperluan_lain }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            <!-- PTPN1 -->

                            @elseif($dataModal && $jenis == 't_tea_waste')
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th class="bg-primary-subtle text-center">PKS</th>
                                            <th class="bg-primary-subtle">TBS Olah</th>
                                            <th class="bg-primary-subtle">Produksi Tea Waste</th>
                                            <th class="bg-primary-subtle">Digunakan</th>
                                            <th class="bg-primary-subtle">Dikirim</th>
                                            <th class="bg-primary-subtle">Dijual</th>
                                            <th class="bg-primary-subtle">Harga Jual Rata-rata</th>
                                            <th class="bg-primary-subtle">Volume Keperluan Lain</th>
                                            <th class="bg-primary-subtle">Keterangan Keperluan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataModal as $data)
                                            <tr class="text-center align-middle">
                                                <td class="text-nowrap">{{ $data->nama_unit }}</td>
                                                <td>@thousands($data->tbs_olah)</td>
                                                <td>@thousands($data->produksi_teawaste)</td>
                                                <td>@thousands($data->digunakan)</td>
                                                <td>@thousands($data->dikirim)</td>
                                                <td>@thousands($data->dijual)</td>
                                                <td>@thousands($data->harga_jual_rata_rata)</td>
                                                <td>@thousands($data->volume_keperluan_lain)</td>
                                                <td>{{ $data->keterangan_keperluan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            @elseif($dataModal && $jenis == 't_abu_he')
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th class="bg-primary-subtle text-center">PKS</th>
                                            <th class="bg-primary-subtle">TBS Olah</th>
                                            <th class="bg-primary-subtle">Produksi Abu HE</th>
                                            <th class="bg-primary-subtle">Digunakan</th>
                                            <th class="bg-primary-subtle">Dikirim</th>
                                            <th class="bg-primary-subtle">Dijual</th>
                                            <th class="bg-primary-subtle">Harga Jual Rata-rata</th>
                                            <th class="bg-primary-subtle">Volume Keperluan Lain</th>
                                            <th class="bg-primary-subtle">Keterangan Keperluan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataModal as $data)
                                            <tr class="text-center align-middle">
                                                <td class="text-nowrap">{{ $data->nama_unit }}</td>
                                                <td>@thousands($data->tbs_olah)</td>
                                                <td>@thousands($data->produksi_abuhe)</td>
                                                <td>@thousands($data->digunakan)</td>
                                                <td>@thousands($data->dikirim)</td>
                                                <td>@thousands($data->dijual)</td>
                                                <td>@thousands($data->harga_jual_rata_rata)</td>
                                                <td>@thousands($data->volume_keperluan_lain)</td>
                                                <td>{{ $data->keterangan_keperluan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @elseif($dataModal && $jenis == 't_limbah_serum')
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th class="bg-primary-subtle text-center">PKS</th>
                                            <th class="bg-primary-subtle">TBS Olah</th>
                                            <th class="bg-primary-subtle">Produksi Limbah Serum</th>
                                            <th class="bg-primary-subtle">Digunakan</th>
                                            <th class="bg-primary-subtle">Dikirim</th>
                                            <th class="bg-primary-subtle">Dijual</th>
                                            <th class="bg-primary-subtle">Harga Jual Rata-rata</th>
                                            <th class="bg-primary-subtle">Volume Keperluan Lain</th>
                                            <th class="bg-primary-subtle">Keterangan Keperluan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataModal as $data)
                                            <tr class="text-center align-middle">
                                                <td class="text-nowrap">{{ $data->nama_unit }}</td>
                                                <td>@thousands($data->tbs_olah)</td>
                                                <td>@thousands($data->produksi_limbahserum)</td>
                                                <td>@thousands($data->digunakan)</td>
                                                <td>@thousands($data->dikirim)</td>
                                                <td>@thousands($data->dijual)</td>
                                                <td>@thousands($data->harga_jual_rata_rata)</td>
                                                <td>@thousands($data->volume_keperluan_lain)</td>
                                                <td>{{ $data->keterangan_keperluan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @elseif($dataModal && $jenis == 't_tunggul_karet')
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th class="bg-primary-subtle text-center">PKS</th>
                                            <th class="bg-primary-subtle">TBS Olah</th>
                                            <th class="bg-primary-subtle">Produksi Tunggul Karet</th>
                                            <th class="bg-primary-subtle">Digunakan</th>
                                            <th class="bg-primary-subtle">Dikirim</th>
                                            <th class="bg-primary-subtle">Dijual</th>
                                            <th class="bg-primary-subtle">Harga Jual Rata-rata</th>
                                            <th class="bg-primary-subtle">Volume Keperluan Lain</th>
                                            <th class="bg-primary-subtle">Keterangan Keperluan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataModal as $data)
                                            <tr class="text-center align-middle">
                                                <td class="text-nowrap">{{ $data->nama_unit }}</td>
                                                <td>@thousands($data->tbs_olah)</td>
                                                <td>@thousands($data->produksi_tunggulkaret)</td>
                                                <td>@thousands($data->digunakan)</td>
                                                <td>@thousands($data->dikirim)</td>
                                                <td>@thousands($data->dijual)</td>
                                                <td>@thousands($data->harga_jual_rata_rata)</td>
                                                <td>@thousands($data->volume_keperluan_lain)</td>
                                                <td>{{ $data->keterangan_keperluan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @elseif($dataModal && $jenis == 't_abu')
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th class="bg-primary-subtle text-center">PKS</th>
                                            <th class="bg-primary-subtle">TBS Olah</th>
                                            <th class="bg-primary-subtle">Produksi Abu</th>
                                            <th class="bg-primary-subtle">Digunakan</th>
                                            <th class="bg-primary-subtle">Dikirim</th>
                                            <th class="bg-primary-subtle">Dijual</th>
                                            <th class="bg-primary-subtle">Harga Jual Rata-rata</th>
                                            <th class="bg-primary-subtle">Volume Keperluan Lain</th>
                                            <th class="bg-primary-subtle">Keterangan Keperluan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataModal as $data)
                                            <tr class="text-center align-middle">
                                                <td class="text-nowrap">{{ $data->nama_unit }}</td>
                                                <td>@thousands($data->tbs_olah)</td>
                                                <td>@thousands($data->produksi_abu)</td>
                                                <td>@thousands($data->digunakan)</td>
                                                <td>@thousands($data->dikirim)</td>
                                                <td>@thousands($data->dijual)</td>
                                                <td>@thousands($data->harga_jual_rata_rata)</td>
                                                <td>@thousands($data->volume_keperluan_lain)</td>
                                                <td>{{ $data->keterangan_keperluan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @elseif($dataModal && $jenis == 't_ranting')
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th class="bg-primary-subtle text-center">PKS</th>
                                            <th class="bg-primary-subtle">TBS Olah</th>
                                            <th class="bg-primary-subtle">Produksi Ranting</th>
                                            <th class="bg-primary-subtle">Digunakan</th>
                                            <th class="bg-primary-subtle">Dikirim</th>
                                            <th class="bg-primary-subtle">Dijual</th>
                                            <th class="bg-primary-subtle">Harga Jual Rata-rata</th>
                                            <th class="bg-primary-subtle">Volume Keperluan Lain</th>
                                            <th class="bg-primary-subtle">Keterangan Keperluan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataModal as $data)
                                            <tr class="text-center align-middle">
                                                <td class="text-nowrap">{{ $data->nama_unit }}</td>
                                                <td>@thousands($data->tbs_olah)</td>
                                                <td>@thousands($data->produksi_ranting)</td>
                                                <td>@thousands($data->digunakan)</td>
                                                <td>@thousands($data->dikirim)</td>
                                                <td>@thousands($data->dijual)</td>
                                                <td>@thousands($data->harga_jual_rata_rata)</td>
                                                <td>@thousands($data->volume_keperluan_lain)</td>
                                                <td>{{ $data->keterangan_keperluan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            @elseif($dataModal && $jenis == 't_batang_kayu')
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th class="bg-primary-subtle text-center">PKS</th>
                                            <th class="bg-primary-subtle">TBS Olah</th>
                                            <th class="bg-primary-subtle">Produksi Batang Kayu</th>
                                            <th class="bg-primary-subtle">Digunakan</th>
                                            <th class="bg-primary-subtle">Dikirim</th>
                                            <th class="bg-primary-subtle">Dijual</th>
                                            <th class="bg-primary-subtle">Harga Jual Rata-rata</th>
                                            <th class="bg-primary-subtle">Volume Keperluan Lain</th>
                                            <th class="bg-primary-subtle">Keterangan Keperluan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataModal as $data)
                                            <tr class="text-center align-middle">
                                                <td class="text-nowrap">{{ $data->nama_unit }}</td>
                                                <td>@thousands($data->tbs_olah)</td>
                                                <td>@thousands($data->produksi_batangkayu)</td>
                                                <td>@thousands($data->digunakan)</td>
                                                <td>@thousands($data->dikirim)</td>
                                                <td>@thousands($data->dijual)</td>
                                                <td>@thousands($data->harga_jual_rata_rata)</td>
                                                <td>@thousands($data->volume_keperluan_lain)</td>
                                                <td>{{ $data->keterangan_keperluan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            
                            @elseif($dataModal && $jenis == 't_rubber_trap')
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th class="bg-primary-subtle text-center">PKS</th>
                                            <th class="bg-primary-subtle">TBS Olah</th>
                                            <th class="bg-primary-subtle">Produksi Rubber Trap</th>
                                            <th class="bg-primary-subtle">Digunakan</th>
                                            <th class="bg-primary-subtle">Dikirim</th>
                                            <th class="bg-primary-subtle">Dijual</th>
                                            <th class="bg-primary-subtle">Harga Jual Rata-rata</th>
                                            <th class="bg-primary-subtle">Volume Keperluan Lain</th>
                                            <th class="bg-primary-subtle">Keterangan Keperluan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataModal as $data)
                                            <tr class="text-center align-middle">
                                                <td class="text-nowrap">{{ $data->nama_unit }}</td>
                                                <td>@thousands($data->tbs_olah)</td>
                                                <td>@thousands($data->produksi_rubbertrap)</td>
                                                <td>@thousands($data->digunakan)</td>
                                                <td>@thousands($data->dikirim)</td>
                                                <td>@thousands($data->dijual)</td>
                                                <td>@thousands($data->harga_jual_rata_rata)</td>
                                                <td>@thousands($data->volume_keperluan_lain)</td>
                                                <td>{{ $data->keterangan_keperluan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>


                            @elseif($dataModal && $jenis == 't_kulit_buah')
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th class="bg-primary-subtle text-center">PKS</th>
                                            <th class="bg-primary-subtle">TBS Olah</th>
                                            <th class="bg-primary-subtle">Produksi Kulit Buah</th>
                                            <th class="bg-primary-subtle">Digunakan</th>
                                            <th class="bg-primary-subtle">Dikirim</th>
                                            <th class="bg-primary-subtle">Dijual</th>
                                            <th class="bg-primary-subtle">Harga Jual Rata-rata</th>
                                            <th class="bg-primary-subtle">Volume Keperluan Lain</th>
                                            <th class="bg-primary-subtle">Keterangan Keperluan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataModal as $data)
                                            <tr class="text-center align-middle">
                                                <td class="text-nowrap">{{ $data->nama_unit }}</td>
                                                <td>@thousands($data->tbs_olah)</td>
                                                <td>@thousands($data->produksi_kulitbuah)</td>
                                                <td>@thousands($data->digunakan)</td>
                                                <td>@thousands($data->dikirim)</td>
                                                <td>@thousands($data->dijual)</td>
                                                <td>@thousands($data->harga_jual_rata_rata)</td>
                                                <td>@thousands($data->volume_keperluan_lain)</td>
                                                <td>{{ $data->keterangan_keperluan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @elseif($dataModal && $jenis == 't_husk_skin')
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th class="bg-primary-subtle text-center">PKS</th>
                                            <th class="bg-primary-subtle">TBS Olah</th>
                                            <th class="bg-primary-subtle">Produksi Husk Skin</th>
                                            <th class="bg-primary-subtle">Digunakan</th>
                                            <th class="bg-primary-subtle">Dikirim</th>
                                            <th class="bg-primary-subtle">Dijual</th>
                                            <th class="bg-primary-subtle">Harga Jual Rata-rata</th>
                                            <th class="bg-primary-subtle">Volume Keperluan Lain</th>
                                            <th class="bg-primary-subtle">Keterangan Keperluan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataModal as $data)
                                            <tr class="text-center align-middle">
                                                <td class="text-nowrap">{{ $data->nama_unit }}</td>
                                                <td>@thousands($data->tbs_olah)</td>
                                                <td>@thousands($data->produksi_huskskin)</td>
                                                <td>@thousands($data->digunakan)</td>
                                                <td>@thousands($data->dikirim)</td>
                                                <td>@thousands($data->dijual)</td>
                                                <td>@thousands($data->harga_jual_rata_rata)</td>
                                                <td>@thousands($data->volume_keperluan_lain)</td>
                                                <td>{{ $data->keterangan_keperluan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>                                
                            @elseif($dataModal && $jenis == 't_mucilage')
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th class="bg-primary-subtle text-center">PKS</th>
                                            <th class="bg-primary-subtle">TBS Olah</th>
                                            <th class="bg-primary-subtle">Produksi Mucilage</th>
                                            <th class="bg-primary-subtle">Digunakan</th>
                                            <th class="bg-primary-subtle">Dikirim</th>
                                            <th class="bg-primary-subtle">Dijual</th>
                                            <th class="bg-primary-subtle">Harga Jual Rata-rata</th>
                                            <th class="bg-primary-subtle">Volume Keperluan Lain</th>
                                            <th class="bg-primary-subtle">Keterangan Keperluan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataModal as $data)
                                            <tr class="text-center align-middle">
                                                <td class="text-nowrap">{{ $data->nama_unit }}</td>
                                                <td>@thousands($data->tbs_olah)</td>
                                                <td>@thousands($data->produksi_mucilage)</td>
                                                <td>@thousands($data->digunakan)</td>
                                                <td>@thousands($data->dikirim)</td>
                                                <td>@thousands($data->dijual)</td>
                                                <td>@thousands($data->harga_jual_rata_rata)</td>
                                                <td>@thousands($data->volume_keperluan_lain)</td>
                                                <td>{{ $data->keterangan_keperluan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>                                
                        @endif

                        </div>
                        <hr>
                        <div class="col-12 mt-5">
                            <h5 class="alert alert-outline-info">Foto</h5>
                        </div>
                        <div class="col-12 mt-3">
                            @if ($evidence)
                                @forelse ($evidence as $evidenceItem)
                                    <div class="d-flex justify-content-center mt-2">
                                        <a href="{{ asset('storage/' . $evidenceItem->nama_file) }}"
                                            data-lightbox="evidence-gallery" class="">
                                            <img src="{{ asset('storage/' . $evidenceItem->nama_file) }}"
                                                alt="Preview Gambar" style="max-height: 300px; max-width: 300px;">
                                        </a>
                                    </div>
                                @empty
                                    <p class="text-center">Belum Ada Foto</p>
                                @endforelse
                            @endif
                        </div>
                        <div class="col-12  mt-5">
                            <h5 class="alert alert-outline-info">Riwayat Perubahan</h5>
                        </div>
                        <div class="col-6 offset-3 mt-3 mb-5 pb-5">
                            @if ($logTransaksi)
                                @forelse ($logTransaksi as $logItem)
                                    <div class="timeline timeline-timed">
                                        <div class="timeline-item">
                                            <span
                                                class="timeline-time text-nowrap">{{ Carbon::createFromDate($logItem->tanggal)->locale('id')->translatedFormat('F Y') }}</span>
                                            <div class="timeline-pin">
                                                <i class="marker marker-circle text-primary"></i>
                                            </div>
                                            <div class="timeline-content">
                                                <p class="mb-0">
                                                    Perubahan Oleh: <strong>{{ $logItem->nama_user }}
                                                        ({{ $logItem->nik_sap }})
                                                    </strong>
                                                </p>
                                                <p class="mb-0">Keterangan: {{ $logItem->keterangan }}</p>
                                                <p class="mb-0">Kategori: {{ $logItem->kategori_transaksi }}</p>
                                                <p class="mb-0">Jenis: {{ $logItem->jenis_transaksi }}</p>
                                                @if ($logItem->kategori_transaksi != 'photo')
                                                    <p class="mb-0">Nilai Sebelum: {{ $logItem->jumlah_sebelum }}
                                                    </p>
                                                    <p class="mb-0">Nilai Sesudah: {{ $logItem->jumlah_sesudah }}
                                                    </p>
                                                @endif
                                                <p class="mb-0">Tanggal Update:
                                                    {{ Carbon::createFromDate($logItem->created_at)->locale('id')->translatedFormat('d F Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-center">Belum Ada Riwayat Perubahan</p>
                                @endforelse
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
