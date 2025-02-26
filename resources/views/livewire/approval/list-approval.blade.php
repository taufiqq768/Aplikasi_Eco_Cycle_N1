@use(Carbon\Carbon)
<div>
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="card">
                <div class="card-header mb-3 mt-1">
                    <h5>Daftar Approval Data Pengisian</h5>
                </div>
                <div class="card-body">
                    <div class="rich-list rich-list-bordered rich-list-action">
                        @forelse ($listProduksi as $produksi)
                            <div class="rich-list-item">
                                <div class="rich-list-prepend">
                                    @if ($produksi->status_approval)
                                        <div class="avatar avatar-xs avatar-label-success">
                                            <div class=""><i class="fas fa-check"></i></div>
                                        </div>
                                    @else
                                        <div class="avatar avatar-xs avatar-label-warning">
                                            <div class=""><i class="fas fa-bell"></i></div>
                                        </div>
                                    @endif
                                </div>
                                <div class="rich-list-content">
                                    <h4 class="rich-list-title mb-1">Pengisian Data
                                        {{ Carbon::parse($produksi->tanggal)->locale('id')->translatedFormat('F Y') }}
                                    </h4>
                                    <p class="rich-list-subtitle mb-0">Dibuat:
                                        {{ Carbon::parse($produksi->created_at)->locale('id')->translatedFormat('d F Y') }}
                                    </p>
                                    @if ($produksi->status_approval)
                                        <p class="rich-list-subtitle mb-0">Disetujui:
                                            {{ Carbon::parse($produksi->created_at)->locale('id')->translatedFormat('d F Y') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="rich-list-append">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-label-secondary btn-icon"
                                            data-bs-toggle="dropdown"><i class="fa fa-ellipsis-h fs-12"></i></button>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated">
                                            <a class="dropdown-item" @click="openModal('{{ $produksi->uuid }}')">
                                                <div class="dropdown-icon"><i class="fa fa-eye"></i></div>
                                                <span class="dropdown-content">Preview</span>
                                            </a>

                                            @if (!$produksi->status_approval)
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" @click="approve('{{ $produksi->uuid }}')">
                                                    <div class="dropdown-icon"><i class="fa fa-check"></i></div>
                                                    <span class="dropdown-content">Approve</span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">Belum Ada Pengisian Data</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <livewire:approval.modal-view />
    <script>
        function openModal(id) {
            $('#modalViewApproval').modal('show')
            Livewire.dispatch('openModal', {
                id: id
            })
        }

        function approve(id) {
            Livewire.dispatch('approve', {
                id: id
            })
        }
    </script>
@endpush
