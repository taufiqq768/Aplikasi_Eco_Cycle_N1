<div>
    <div class="custom-loader-wrapper flex-center" wire:loading.flex>
        <div class="custom-loader"></div>
    </div>
    <x-page-title title="Manajemen User">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item">Admin Area</li>
            <li class="breadcrumb-item active">Manajemen User</li>
        </ol>
    </x-page-title>

    <div class="row mt-3">
        <div class="col-10 order-sm-2 col-xl-4 order-1">
            <div class="card shadow-lg"
                style="background: url({{ asset('assets/images/widgets-shape2.png') }}); background-position: center; background-repeat: no-repeat; background-size: cover;">
                <div class="bg-overlay bg-light-subtle rounded"></div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-7">
                            <h4 class="fs-16 mb-1">This is card </h4>
                            <p class="text-muted mb-0">Fill the info here</p>
                            <button class="btn btn-primary mt-4">Up Button</button>
                        </div>
                        <div class="col-5">
                            <img src="{{ asset('assets/images/dashboard/upgarde-1.png') }}" alt=""
                                class="img-fluid" style="height: 126px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-8 order-2 order-lg-1">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-lg"
                        style="background: url('{{ asset('assets/images/dashboard/dashboard-shape-3.png') }}'); background-position: center; background-repeat: no-repeat; background-size: cover; overflow: visible;">
                        {{-- <div class="bg-overlay bg-primary-subtle rounded"></div> --}}
                        <div class="card-body position-relative">
                            <div class="row align-items-center">
                                <div class="col-8 col-lg-7">
                                    <h4 class="fs-16 mb-1">Manajemen User</h4>
                                    <p class="text-muted mb-0">Berikan User Role Untuk Mengakses Eco Cycle</p>
                                    <button class="btn btn-primary mt-4" data-bs-toggle="modal"
                                        data-bs-target="#modalUser">+ Assign Role</button>
                                </div>
                                <div class="col-4 col-lg-5 position-relative d-sm-block d-none">
                                    <img src="{{ asset('assets/images/self/3D Icon/User 3D Icon.png') }}" alt=""
                                        class="position-absolute"
                                        style="height: 20vh; right: 0; top: -11vh; z-index: 1;">
                                </div>
                                <div class="col-4 col-lg-5 position-relative d-sm-none d-block">
                                    <img src="{{ asset('assets/images/self/3D Icon/User 3D Icon.png') }}" alt=""
                                        class="position-absolute"
                                        style="height: 15vh; right: -5vh; top: -8vh; z-index: 1;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-lg">
                        <div class="card-body" wire:ignore>
                            <table class="table table-hover table-bordered" id="tableUser">
                                <thead>
                                    <tr class="text-center">
                                        <th class="bg-light">NIK SAP</th>
                                        <th class="bg-light">Nama</th>
                                        <th class="bg-light">Role</th>
                                        <th class="bg-light">Unit Kerja</th>
                                        <th class="bg-light">Unit Penugasan</th>
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
    <livewire:master.user.modal-create />
    <livewire:master.user.modal-edit />
    <script>
        Livewire.on('initDataTable', function() {
            if ($.fn.DataTable.isDataTable('#tableUser')) {
                $('#tableUser').DataTable().ajax.reload(null, false);
            } else {
                $('#tableUser').DataTable({
                    "responsive": true,
                    "autoWidth": false,
                    "processing": true,
                    deferLoading: 57,
                    "serverSide": false,
                    "ajax": {
                        "url": "{{ route('manajemen-user.list') }}",
                        "type": "GET"
                    },
                    "columns": [{
                            "data": "nik_sap"
                        },
                        {
                            "data": "nama"
                        },
                        {
                            "data": "role"
                        },
                        {
                            "data": "nama_unit"
                        },
                        {
                            "data": "unit_penugasan"
                        },
                        {
                            data: null,
                            render: function(data, type, row) {
                                return `
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div class="me-2">
                                        <button data-bs-toggle="modal" data-bs-target="#modalEditUser" @click="$dispatch('edit-data', { nik_sap: '${row.nik_sap}', nama: '${row.nama}', role: '${row.role}', kode_unit: '${row.kode_unit}' })" class="btn btn-sm btn-primary">Edit</button>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-danger" wire:click="delete('${row.nik_sap}')" wire:confirm="Apakah anda yakin menghapus role: ${row.nama}?">Delete</button>
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
