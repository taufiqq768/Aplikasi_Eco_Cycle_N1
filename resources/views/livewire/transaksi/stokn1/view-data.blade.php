<div>
    <div class="custom-loader-wrapper flex-center" wire:loading.flex>
        <div class="custom-loader"></div>
    </div>
    <x-page-title title="Stok">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item">Transaksi</li>
            <li class="breadcrumb-item active">Stok</li>
        </ol>
    </x-page-title>

    <div class="row mt-3">
        {{-- <div class="col-12 order-sm-2 col-xl-3 order-1">
            <div class="card shadow-lg"
                style="background: url({{ asset('assets/images/widgets-shape2.png') }}); background-position: center; background-repeat: no-repeat; background-size: cover;">
                <div class="bg-overlay bg-light-subtle rounded"></div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-7">
                            <h4 class="fs-16 mb-1">Need more idea? </h4>
                            <p class="text-muted mb-0">Upgrade to pro max for added benefits.</p>
                            <button class="btn btn-primary mt-4">Upgarde Now</button>
                        </div>
                        <div class="col-5">
                            <img src="{{ asset('assets/images/dashboard/upgarde-1.png') }}" alt=""
                                class="img-fluid" style="height: 126px;">
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-12 col-xl-12 order-2 order-lg-1">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-lg"
                        style="background: url('{{ asset('assets/images/dashboard/dashboard-shape-3.png') }}'); background-position: center; background-repeat: no-repeat; background-size: cover; overflow: visible;">
                        {{-- <div class="bg-overlay bg-light-subtle rounded"></div> --}}
                        <div class="card-body position-relative">
                            <div class="row align-items-center">
                                <div class="col-8 col-lg-7">
                                    <h4 class="fs-16 mb-1">Manajemen Stok</h4>
                                    <p class="text-muted mb-0">Stok Per Awal Tahun</p>
                                    <button class="btn btn-primary mt-4" data-bs-toggle="modal"
                                        data-bs-target="#modalCreate">+ Tambah Stok</button>
                                </div>
                                <div class="col-4 col-lg-5 position-relative d-sm-block d-none">
                                    <img src="{{ asset('assets/images/3d assets/tank 3d.png') }}" alt=""
                                        class="position-absolute"
                                        style="height: 20vh; right: 0; top: -11vh; z-index: 1;">
                                </div>
                                <div class="col-4 col-lg-5 position-relative d-sm-none d-block">
                                    <img src="{{ asset('assets/images/3d assets/tank 3d.png') }}" alt=""
                                        class="position-absolute"
                                        style="height: 15vh; right: -5vh; top: -8vh; z-index: 1;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-lg">
                        <div class="card-body" wire:ignore>
                            <table class="table table-hover table-bordered" id="tableStok">
                                <thead>
                                    <tr class="text-center">
                                        <th class="bg-light">Unit</th>
                                        <th class="bg-light">Tahun</th>
                                        <th class="bg-light">N1-Tea Waste</th>
                                        <th class="bg-light">N1-Abu HE</th>
                                        <th class="bg-light">N1-Limbah Serum</th>
                                        <th class="bg-light">N1-Tunggul Karet</th>
                                        <th class="bg-light">N1-Abu</th>
                                        <th class="bg-light">N1-Ranting</th>
                                        <th class="bg-light">N1-Batang Kayu</th>
                                        <th class="bg-light">N1-Rubber Trap</th>
                                        <th class="bg-light">N1-Kulit Buah</th>
                                        <th class="bg-light">N1-Husk Skin</th>
                                        <th class="bg-light">N1-Mucilage</th>
                                        <th class="bg-light">Aksi</th>                                        
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <livewire:transaksi.stokn1.modal-create />
    <script>
        Livewire.on('initDataTable', function() {
            if ($.fn.DataTable.isDataTable('#tableStok')) {
                $('#tableStok').DataTable().ajax.reload(null, false);
            } else {
                $('#tableStok').DataTable({
                    "responsive": true,
                    "autoWidth": false,
                    "processing": true,
                    deferLoading: 57,
                    "serverSide": false,
                    "ajax": {
                        "url": "{{ route('stokn1.list') }}",
                        "type": "GET"
                    },
                    "columns": [{
                            "data": "kode_unit",
                            'class': 'text-center'
                        },
                        {
                            "data": "tahun",
                            'class': 'text-center'
                        },
                        {
                            "data": "stok_tea_waste",
                            'class': 'text-center'
                        },
                        {
                            "data": "stok_abu_he",
                            'class': 'text-center'
                        },
                        {
                            "data": "stok_limbah_serum",
                            'class': 'text-center'
                        },
                        {
                            "data": "stok_tunggul_karet",
                            'class': 'text-center'
                        },
                        {
                            "data": "stok_abu",
                            'class': 'text-center'
                        },
                        {
                            "data": "stok_ranting",
                            'class': 'text-center'
                        },                        
                        {
                            "data": "stok_batang_kayu",
                            'class': 'text-center'
                        },                        
                        {
                            "data": "stok_rubber_trap",
                            'class': 'text-center'
                        },                        
                        {
                            "data": "stok_kulit_buah",
                            'class': 'text-center'
                        },                        
                        {
                            "data": "stok_husk_skin",
                            'class': 'text-center'
                        },                        
                        {
                            "data": "stok_mucilage",
                            'class': 'text-center'
                        },                        

                        {
                            data: null,
                            render: function(data, type, row) {
                                return `
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div class="me-2">
                                        <button data-bs-toggle="modal" data-bs-target="#modalEditUser" class="btn btn-sm btn-primary">Edit</button>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-danger" wire:confirm="Apakah anda yakin menghapus role: ?">Delete</button>
                                    </div>
                                </div>
                                `;
                            }
                        },

                    ],
                    "language": {
                        "paginate": {
                            "previous": "<i class='mdi mdi-chevron-left'>",
                            "next": "<i class='mdi mdi-chevron-right'>"
                        }
                    },
                    "drawCallback": function() {
                        $('.dataTables_paginate > .pagination').addClass('pagination');
                    }
                });
            }
        })
    </script>
@endpush
