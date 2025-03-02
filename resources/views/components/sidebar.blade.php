@use(App\Enum\UserRoleEnum)
<div class="sidebar-left">

    <div data-simplebar class="h-100">

        <!--- Sidebar-menu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="left-menu list-unstyled" id="side-menu">
                <!-- <li>
                    <a href="{{ route('dashboard.index') }}" class="" wire:navigate>
                        <i class="fas fa-desktop"></i>
                        <span>Dashboard</span>
                    </a>
                </li> -->
                <li>
                    <a href="{{ route('dashboard-n1.index') }}" class="" wire:navigate>
                        <i class="fas fa-desktop"></i>
                        <span>Dashboard N1</span>
                    </a>
                </li>

                <!-- <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="fa fa-store-alt"></i>
                        <span>Data Stok</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('cangkang.view') }}" wire:navigate>
                                <i class="mdi mdi-checkbox-blank-circle align-middle"></i>
                                Cangkang
                            </a>
                        </li>
                        <li><a href="{{ route('fiber.view') }}" wire:navigate>
                                <i class="mdi mdi-checkbox-blank-circle align-middle"></i>
                                Fiber
                            </a>
                        </li>
                        <li><a href="{{ route('tankos.view') }}" wire:navigate>
                                <i class="mdi mdi-checkbox-blank-circle align-middle"></i>
                                Tandan Kosong
                            </a>
                        </li>
                        <li><a href="{{ route('abu-janjang.view') }}" wire:navigate>
                                <i class="mdi mdi-checkbox-blank-circle align-middle"></i>
                                Abu Janjang
                            </a>
                        </li>
                        <li><a href="{{ route('solid.view') }}" wire:navigate>
                                <i class="mdi mdi-checkbox-blank-circle align-middle"></i>
                                Solid
                            </a>
                        </li>
                        <li><a href="{{ route('pome.view') }}" wire:navigate>
                                <i class="mdi mdi-checkbox-blank-circle align-middle"></i>
                                POME
                            </a>
                        </li>
                        <li><a href="{{ route('abu-boiler.view') }}" wire:navigate>
                                <i class="mdi mdi-checkbox-blank-circle align-middle"></i>
                                Abu Boiler
                            </a>
                        </li>
                        <li><a href="{{ route('pkm.view') }}" wire:navigate>
                                <i class="mdi mdi-checkbox-blank-circle align-middle"></i>
                                PKM
                            </a>
                        </li>
                    </ul>
                </li> -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="fa fa-store-alt"></i>
                        <span>Data Stok N1</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('tea-waste.view') }}" wire:navigate>
                                <i class="mdi mdi-checkbox-blank-circle align-middle"></i>
                                N1-Teh-Tea Waste
                            </a>
                        </li>
                        <li><a href="{{ route('abu-he.view') }}" wire:navigate>
                                <i class="mdi mdi-checkbox-blank-circle align-middle"></i>
                                N1-Teh-Abu HE
                            </a>
                        </li>
                        <li><a href="{{ route('limbah-serum.view') }}" wire:navigate>
                                <i class="mdi mdi-checkbox-blank-circle align-middle"></i>
                                N1-Karet-Limbah Serum
                            </a>
                        </li>
                        <li><a href="{{ route('tunggul-karet.view') }}" wire:navigate>
                                <i class="mdi mdi-checkbox-blank-circle align-middle"></i>
                                N1-Karet-Tunggul Karet
                            </a>
                        </li>
                        <li><a href="{{ route('abu.view') }}" wire:navigate>
                                <i class="mdi mdi-checkbox-blank-circle align-middle"></i>
                                N1-Karet-Abu
                            </a>
                        </li>
                        <li><a href="{{ route('ranting.view') }}" wire:navigate>
                                <i class="mdi mdi-checkbox-blank-circle align-middle"></i>
                                N1-Karet-Ranting
                            </a>
                        </li>
                        <li><a href="{{ route('batang-kayu.view') }}" wire:navigate>
                                <i class="mdi mdi-checkbox-blank-circle align-middle"></i>
                                N1-Karet-Batang Kayu
                            </a>
                        </li>
                        <li><a href="{{ route('kulit-buah.view') }}" wire:navigate>
                                <i class="mdi mdi-checkbox-blank-circle align-middle"></i>
                                N1-Kopi-Kulit Buah
                            </a>
                        </li>
                        <li><a href="{{ route('husk-skin.view') }}" wire:navigate>
                                <i class="mdi mdi-checkbox-blank-circle align-middle"></i>
                                N1-Kopi-Husk Skin
                            </a>
                        </li>
                        <li><a href="{{ route('mucilage.view') }}" wire:navigate>
                                <i class="mdi mdi-checkbox-blank-circle align-middle"></i>
                                N1-Kopi-Mucilage
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="fab fa-wpforms"></i>
                        <span>Form Penginputan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('input-form') }}" class="" wire:navigate>
                                <i class="mdi mdi-checkbox-blank-circle align-middle"></i>
                                Limbah Sawit
                            </a>
                        </li>
                        <li><a href="{{ route('form-periode-sumber-daya') }}" wire:navigate>
                                <i class="mdi mdi-checkbox-blank-circle align-middle"></i>
                                Pemakaian Sumber Daya
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <!-- @can('access_for', [UserRoleEnum::SUPER_ADMIN->name, UserRoleEnum::ADMIN_REGIONAL->name,
                    UserRoleEnum::ADMIN_UNIT->name])
                    <li>
                        <a href="{{ route('input-form') }}" class="" wire:navigate>
                            <i class=" fab fa-wpforms"></i>
                            <span>Form Penginputan</span>
                        </a>
                    </li>
                @endcan -->
                @can('access_for', [UserRoleEnum::SUPER_ADMIN->name, UserRoleEnum::ADMIN_REGIONAL->name,
                    UserRoleEnum::ADMIN_UNIT->name])
                    <li>
                        <a href="{{ route('input-form-n1') }}" class="" wire:navigate>
                            <i class=" fab fa-wpforms"></i>
                            <span>Form Penginputan N1</span>
                        </a>
                    </li>
                @endcan
                @can('access_for', [UserRoleEnum::APPROVER_UNIT->name])
                    <li>
                        <a href="{{ route('list-approval') }}" class="" wire:navigate>
                            <i class="fas fa-check-circle"></i>
                            <span>Approval</span>
                        </a>
                    </li>
                @endcan
                <!-- <li>
                    <a href="{{ route('monitoring-pengisian.view') }}" class="" wire:navigate>
                        <i class="fas fa-file-alt"></i>
                        <span>Monitoring Pengisian</span>
                    </a>
                </li> -->
                <li>
                    <a href="{{ route('monitoring-pengisian-n1.view') }}" class="" wire:navigate>
                        <i class="fas fa-file-alt"></i>
                        <span>Monitoring Pengisian N1</span>
                    </a>
                </li>

                @can('access_for', [UserRoleEnum::SUPER_ADMIN->name, UserRoleEnum::ADMIN_HOLDING->name,
                    UserRoleEnum::ADMIN_UNIT->name])
                    <li class="menu-title">Admin Area</li>
                    <li>
                        <a href="{{ route('manajemen-user.view') }}" class="" wire:navigate>
                            <i class="fas fa-users"></i>
                            <span>Manajemen User</span>
                        </a>
                    </li>
                @endcan

                @can('access_for', [UserRoleEnum::ADMIN_HOLDING->name])
                    <!-- <li>
                        <a href="{{ route('stok.view') }}" class="" wire:navigate>
                            <i class="fas fa-database"></i>
                            <span>Stock Awal Tahun</span>
                        </a>
                    </li> -->
                    <li>
                        <a href="{{ route('stokn1.view') }}" class="" wire:navigate>
                            <i class="fas fa-database"></i>
                            <span>Stock Awal Tahun N1</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('manajemen-periode.index') }}" class="" wire:navigate>
                            <i class=" fas fa-calendar-check"></i>
                            <span>Manajemen Periode</span>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="{{ route('manajemen-harga-normal.index') }}" class="" wire:navigate>
                            <i class=" fas fa-money-check"></i>
                            <span>Manajemen Harga Normal</span>
                        </a>
                    </li> -->
                    <li>
                        <a href="{{ route('manajemen-harga-normal-n1.index') }}" class="" wire:navigate>
                            <i class=" fas fa-money-check"></i>
                            <span>Manaj. Harga Normal N1</span>
                        </a>
                    </li>
                   
                @endcan

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<script src="{{ asset('assets/js/app.js') }}"></script>
