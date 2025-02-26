<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/self/recycle 1.png') }}">


    <!-- dark layout js -->
    <script src="{{ asset('assets/js/pages/layout.js') }}"></script>

    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- simplebar css -->
    <link href="{{ asset('assets/libs/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}">
    <script src="{{ asset('assets/js/custom/detailItem.js') }}"></script>

    <title>{{ $title ?? 'Eco Cycle' }}</title>

    <style>
        .rotate {
            animation: rotate 2s linear infinite;
            transform-origin: center;
        }

        @keyframes rotate {
            100% {
                transform: rotate(360deg);
            }
        }

        .custom-loader-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            display: flex;
            /* Memastikan display tetap flex */
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            z-index: 9999;
        }

        .custom-loader {
            width: 50px;
            height: 50px;
            display: grid;
            color: #40c46c;
            background: radial-gradient(farthest-side, currentColor calc(100% - 6px), #0000 calc(100% - 5px) 0);
            -webkit-mask: radial-gradient(farthest-side, #0000 calc(100% - 13px), #000 calc(100% - 12px));
            border-radius: 50%;
            animation: s9 2s infinite linear;
        }

        .custom-loader::before,
        .custom-loader::after {
            content: "";
            grid-area: 1/1;
            background:
                linear-gradient(currentColor 0 0) center,
                linear-gradient(currentColor 0 0) center;
            background-size: 100% 10px, 10px 100%;
            background-repeat: no-repeat;
        }

        .custom-loader::after {
            transform: rotate(45deg);
        }

        @keyframes s9 {
            100% {
                transform: rotate(1turn)
            }
        }

        ::-webkit-scrollbar {
            width: 10px;
            /* Lebar untuk scrollbar vertikal */
            height: 6px;
            /* Tinggi untuk scrollbar horizontal */
        }

        /* Gaya track scrollbar */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        /* Gaya thumb scrollbar */
        ::-webkit-scrollbar-thumb {
            background: #aeaeae89;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #aeaeae;
        }

        /* Khusus untuk elemen dengan scroll horizontal */
        .scroll-container {
            overflow-x: auto;
            overflow-y: hidden;
            white-space: nowrap;
        }

        .red-custom {
            background-color: #ff1e1e;
        }

        .green-custom {
            background-color: #0eff01;
        }
    </style>
    @livewireStyles
    @stack('css')
    {{-- Script Taruh di sini --}}
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>

    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>

    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
    <script>
        const namaBulan = {
            '01': 'Januari',
            '02': 'Februari',
            '03': 'Maret',
            '04': 'April',
            '05': 'Mei',
            '06': 'Juni',
            '07': 'Juli',
            '08': 'Agustus',
            '09': 'September',
            '10': 'Oktober',
            '11': 'November',
            '12': 'Desember',
        };
    </script>
    @livewireScripts

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $("#side-menu").metisMenu();
            $('#sidebar-btn').on('click', function(event) {
                event.preventDefault();
                $('body').toggleClass('sidebar-enable');
                if ($(window).width() >= 992) {
                    $('body').toggleClass('sidebar-collpsed');
                } else {
                    $('body').removeClass('sidebar-collpsed');
                }
            });

            $(document).on('click', '#light-dark-mode', function() {
                var bodyElem = document.documentElement;

                if (bodyElem.hasAttribute("data-bs-theme") && bodyElem.getAttribute("data-bs-theme") ===
                    "dark") {
                    bodyElem.setAttribute('data-bs-theme', 'light');
                    sessionStorage.setItem("data-layout-mode", "light");
                } else {
                    bodyElem.setAttribute('data-bs-theme', 'dark');
                    sessionStorage.setItem("data-layout-mode", "dark");
                }
            });
        });
    </script>
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">


        <!-- Start topbar -->
        <header id="page-topbar">

            <!-- Logo -->

            <!-- Start Navbar-Brand -->
            @persist('player')
                <x-navbar-brand></x-navbar-brand>
            @endpersist
            <!-- End navbar brand -->


        </header>
        <!-- End topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        @persist('sidebar')
            <x-sidebar></x-sidebar>
        @endpersist
        <!-- Left Sidebar End -->


        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    {{ $slot }}

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer d-flex pt-2" x-data="{
                theme: document.documentElement.getAttribute('data-bs-theme') || 'light',
                get imageSrc() {
                    return this.theme === 'dark' ?
                        '{{ asset('assets/images/self/eco cycle 1.png') }}' :
                        '{{ asset('assets/images/self/eco cycle dark mode.png') }}';
                },
                init() {
                    this.updateImage();
                    const observer = new MutationObserver(() => this.updateImage());
                    observer.observe(document.documentElement, { attributes: true, attributeFilter: ['data-bs-theme'] });
                },
                updateImage() {
                    this.theme = document.documentElement.getAttribute('data-bs-theme') || 'light';
                }
            }">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-6" style="color: var(--bs-emphasis-color);">
                            2024 © PT Perkebunan Nusantara III (Persero).
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                <span>
                                    <img :src="imageSrc" alt="Icon" height="35">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>


        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <div class="custom-setting bg-primary pe-0 d-flex flex-column rounded-start">
        <button type="button" class="btn btn-wide border-0 text-white fs-20 avatar-sm rounded-end-0"
            id="light-dark-mode">
            <i class="mdi mdi-brightness-7 align-middle"></i>
            <i class="mdi mdi-white-balance-sunny align-middle"></i>
        </button>
        {{-- <button type="button" class="btn btn-wide border-0 text-white fs-20 avatar-sm" data-toggle="fullscreen">
            <i class="mdi mdi-arrow-expand-all align-middle"></i>
        </button>
        <button type="button" class="btn btn-wide border-0 text-white fs-16 avatar-sm" id="layout-dir-btn">
            <span>RTL</span>
        </button> --}}
    </div>
    <script src="{{ asset('assets/js/manajemen-user.js') }}"></script>


    <script>
        var n = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-label-info btn-wide mx-1",
                denyButton: "btn btn-label-secondary btn-wide mx-1",
                cancelButton: "btn btn-label-danger btn-wide mx-1"
            },
            buttonsStyling: !1,
            // focusConfirm: !1,

        });

        function setConfirm(listener) {
            n.fire({
                title: "Apakah Anda Yakin?",
                text: "Anda akan melakukan submit pada form ini.",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Simpan!",
                cancelButtonText: "Batal"
            }).then(function(t) {
                if (t.isConfirmed) {
                    Livewire.dispatch(listener);
                }
            })
        }

        function confirmEdit(listener) {
            n.fire({
                title: "Apakah Anda Yakin Untuk Menyimpan Edit?",
                text: "Anda akan melakukan edit pada form ini.",
                icon: "warning",
                input: 'text',
                inputPlaceholder: "Masukkan keterangan",
                inputValidator: (value) => {
                    if (!value) {
                        return "Keterangan wajib diisi!";
                    }
                },
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Simpan Edit!",
                cancelButtonText: "Batal"
            }).then(function(t) {
                if (t.isConfirmed) {
                    const keterangan = t.value;
                    Livewire.dispatch(listener, {
                        keterangan: keterangan
                    });
                }
            })
        }

        function berhasil() {
            n.fire("Berhasil!", "Data anda berhasil disimpan", "success")
        }

        function gagal(error) {
            n.fire("Gagal!", error, "error")
        }

        function formatCurrency(value) {
            if (!value) return value;
            value = value.replace(/\D/g, ''); // Hapus karakter non-digit
            return value.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Tambahkan pemisah ribuan
        }

        function getChartColorsArray(chartId) {
            if (document.getElementById(chartId) !== null) {
                var colors = document.getElementById(chartId).getAttribute("data-colors");
                colors = JSON.parse(colors);
                return colors.map(function(value) {
                    var newValue = value.replace(" ", "");
                    if (newValue.indexOf(",") === -1) {
                        var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
                        if (color) return color;
                        else return newValue;;
                    } else {
                        var val = value.split(',');
                        if (val.length == 2) {
                            var rgbaColor = getComputedStyle(document.documentElement).getPropertyValue(val[0]);
                            rgbaColor = "rgba(" + rgbaColor + "," + val[1] + ")";
                            return rgbaColor;
                        } else {
                            return newValue;
                        }
                    }
                });
            }
        }
    </script>
    @stack('js')
</body>

</html>
