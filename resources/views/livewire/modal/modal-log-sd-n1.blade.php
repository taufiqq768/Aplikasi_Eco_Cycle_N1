@use('Carbon\Carbon')
<div wire:ignore.self class="modal fade" id="modalLogSdN1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Riwayat Perubahan {{ $log?->first()->nama_unit }}</h5><button type="button"
                    class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i
                        class="mdi mdi-close"></i></button>
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
                        @if ($log)
                            @foreach ($log as $logItem)
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
                                                <p class="mb-0">Nilai Sebelum: {{ $logItem->jumlah_sebelum }}</p>
                                                <p class="mb-0">Nilai Sesudah: {{ $logItem->jumlah_sesudah }}</p>
                                            @endif
                                            <p class="mb-0">Tanggal Update:
                                                {{ Carbon::createFromDate($logItem->created_at)->locale('id')->translatedFormat('d F Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
