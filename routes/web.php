<?php

use App\Enum\UserRoleEnum;
use App\Http\Controllers\DashboardApiController;
use App\Http\Controllers\DashboardApiController_N1;
use App\Http\Middleware\AccessForRole;
use App\Livewire\Approval\ListApproval;
use App\Livewire\Dashboard;
use App\Livewire\DashboardN1;
use App\Livewire\FormPeriodeSumberDaya;
use App\Livewire\Login;
use App\Livewire\Master\MasterHargaNormal;
use App\Livewire\Master\MasterHargaNormalN1;
use App\Livewire\Master\User\ViewUser;
use Illuminate\Support\Facades\Route;


Route::get('/', Login::class)->name('login')->middleware('guest');
Route::get('logout', [Login::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard.index');
    Route::get('dashboard-n1', DashboardN1::class)->name('dashboard-n1.index');
    // Route::get('wasteptpn1', App\LiveWire\TeaWaste::class)->name('waste-ptpn1.index');

    Route::group(['prefix' => 'master'], function () {
        Route::middleware(AccessForRole::with([
            'roles' => UserRoleEnum::ADMIN_HOLDING->name,
        ]))->group(function () {
            Route::get('manajemen-user', ViewUser::class)->name('manajemen-user.view');
            Route::get('listUser', [ViewUser::class, 'getData'])->name('manajemen-user.list');

            Route::get('/manajemen-periode', App\Livewire\Master\ManajemenPeriode::class)->name('manajemen-periode.index');

            Route::get('/manajemen-harga-normal', MasterHargaNormal::class)->name('manajemen-harga-normal.index');

            Route::get('/manajemen-harga-normal-n1', MasterHargaNormalN1::class)->name('manajemen-harga-normal-n1.index');

        });
    });


    Route::group(['prefix' => 'transaksi'], function () {
        Route::get('stok', App\Livewire\Transaksi\Stok\ViewData::class)->name('stok.view');
        Route::get('stokn1', App\Livewire\Transaksi\Stokn1\ViewData::class)->name('stokn1.view');
        Route::get('listStok', [App\Livewire\Transaksi\Stok\ViewData::class, 'getData'])->name('stok.list');
        Route::get('listStokN1', [App\Livewire\Transaksi\Stokn1\ViewData::class, 'getData'])->name('stokn1.list');

        Route::group(['prefix' => 'cangkang'], function () {
            Route::get('/', App\Livewire\Transaksi\Cangkang\View::class)->name('cangkang.view');
            Route::get('/dataCangkang/{bulan}/{tahun}', [App\Livewire\Transaksi\Cangkang\View::class, 'getCangkang'])->name('cangkang.api.get');
            Route::get('/cangkangChart/{bulan}/{tahun}', [App\Livewire\Transaksi\Cangkang\View::class, 'getChartCangkangSd'])->name('chartCangkang.api.get');
        });

        Route::group(['prefix' => 'fiber'], function () {
            Route::get('/', App\Livewire\Transaksi\Fiber\ViewData::class)->name('fiber.view');
        });
        Route::group(['prefix' => 'tankos'], function () {
            Route::get('/', App\Livewire\Transaksi\Tankos\ViewData::class)->name('tankos.view');
        });
        Route::group(['prefix' => 'abu-janjang'], function () {
            Route::get('/', App\Livewire\Transaksi\Abujanjang\ViewData::class)->name('abu-janjang.view');
        });
        Route::group(['prefix' => 'solid'], function () {
            Route::get('/', App\Livewire\Transaksi\Solid\ViewData::class)->name('solid.view');
        });
        Route::group(['prefix' => 'pome'], function () {
            Route::get('/', App\Livewire\Transaksi\Pome\ViewData::class)->name('pome.view');
        });
        Route::group(['prefix' => 'pkm'], function () {
            Route::get('/', App\Livewire\Transaksi\Pkm\ViewData::class)->name('pkm.view');
        });
        Route::group(['prefix' => 'abu-boiler'], function () {
            Route::get('/', App\Livewire\Transaksi\Abuboiler\ViewData::class)->name('abu-boiler.view');
        });
        // PTPN1
        Route::group(['prefix' => 'tea-waste'], function () {
            Route::get('/', App\Livewire\Transaksi\Teawaste\ViewData::class)->name('tea-waste.view');
        });
        Route::group(['prefix' => 'limbah-serum'], function () {
            Route::get('/', App\Livewire\Transaksi\Limbahserum\ViewData::class)->name('limbah-serum.view');
        });
        Route::group(['prefix' => 'tunggul-karet'], function () {
            Route::get('/', App\Livewire\Transaksi\Tunggulkaret\ViewData::class)->name('tunggul-karet.view');
        });
        Route::group(['prefix' => 'abu'], function () {
            Route::get('/', App\Livewire\Transaksi\Abu\ViewData::class)->name('abu.view');
        });
        Route::group(['prefix' => 'abu-he'], function () {
            Route::get('/', App\Livewire\Transaksi\Abuhe\ViewData::class)->name('abu-he.view');
        });
        Route::group(['prefix' => 'ranting'], function () {
            Route::get('/', App\Livewire\Transaksi\Ranting\ViewData::class)->name('ranting.view');
        });
        Route::group(['prefix' => 'batang-kayu'], function () {
            Route::get('/', App\Livewire\Transaksi\Batangkayu\ViewData::class)->name('batang-kayu.view');
        });
        Route::group(['prefix' => 'kulit-buah'], function () {
            Route::get('/', App\Livewire\Transaksi\Kulitbuah\ViewData::class)->name('kulit-buah.view');
        });
        Route::group(['prefix' => 'husk-skin'], function () {
            Route::get('/', App\Livewire\Transaksi\Huskskin\ViewData::class)->name('husk-skin.view');
        });
        Route::group(['prefix' => 'mucilage'], function () {
            Route::get('/', App\Livewire\Transaksi\Mucilage\ViewData::class)->name('mucilage.view');
        });

        Route::middleware(AccessForRole::with([
            'roles' => [
                UserRoleEnum::ADMIN_HOLDING->name,
                UserRoleEnum::ADMIN_REGIONAL->name,
                UserRoleEnum::ADMIN_UNIT->name,
            ],
        ]))->group(function () {
            Route::get('insert-form', App\Livewire\Transaksi\FormInput::class)->name('input-form');
            Route::get('insert-form-n1', App\Livewire\Transaksi\FormInputN1::class)->name('input-form-n1');
        });
        
    });

    Route::middleware(AccessForRole::with([
        'roles' => [
            UserRoleEnum::APPROVER_UNIT->name
        ],
    ]))->group(function () {
        Route::group(['prefix' => 'approval'], function () {
            Route::get('list-approval', ListApproval::class)->name('list-approval');
        });
    });


    Route::group(['prefix' => 'data-sumber-daya'], function () {
        Route::get('/', FormPeriodeSumberDaya::class)->name('form-periode-sumber-daya');
    });

    Route::group(['prefix' => 'monitoring'], function () {
        Route::get('/monitoring-pengisian', App\Livewire\Monitoring\MonitoringPengisian::class)->name('monitoring-pengisian.view');
        Route::get('/monitoring-pengisian-n1', App\Livewire\Monitoring\MonitoringPengisianN1::class)->name('monitoring-pengisian-n1.view');
    });

    Route::group(['prefix' => 'api'], function () {
        Route::get('dashboard-data-penjualan/{bulan}/{tahun}', [DashboardApiController::class, 'dashboardDataPenjualan'])->name('api.dashboardDataPenjualan');
        Route::get('data-stok-chart-pie/{bulan}/{tahun}', [DashboardApiController::class, 'dataStokChartPie'])->name('api.dataStokChartPie');
        Route::get('data-region-stok-chart/{bulan}/{tahun}', [DashboardApiController::class, 'dataRegionStokChart'])->name('api.dataRegionStokChart');
        Route::get('data-produksi-digunakan-chart/{bulan}/{tahun}', [DashboardApiController::class, 'dataProduksiDigunakanChart'])->name('api.dataProduksiDigunakanChart');
        Route::get('data-scatter/{bulan}/{tahun}/{tipe}', [DashboardApiController::class, 'dataScatter'])->name('api.dataScatter');
        Route::get('data-scatter-bi/{bulan}/{tahun}/{tipe}', [DashboardApiController::class, 'dataScatterBi'])->name('api.dataScatterBi');


        Route::get('data-detail-chart-sd/{bulan}/{tahun}/{tipe}', [DashboardApiController::class, 'getDetailChartSd'])->name('api.dataDetailChartSd');
        Route::get('data-detail-chart-bi/{bulan}/{tahun}/{tipe}', [DashboardApiController::class, 'getDetailChartBi'])->name('api.dataDetailChartBi');
        Route::get('data-item-detail/{bulan}/{tahun}/{tipe}', [DashboardApiController::class, 'getDataItemDetail'])->name('api.dataItemDetail');
        Route::get('data-item-detail-bi/{bulan}/{tahun}/{tipe}', [DashboardApiController::class, 'getDataItemDetailBi'])->name('api.getDataItemDetailBi');


        Route::get('dashboard-data-penjualan-n1/{bulan}/{tahun}', [DashboardApiController_N1::class, 'dashboardDataPenjualan_N1'])->name('api.dashboardDataPenjualan_N1');
        Route::get('data-stok-chart-pie-n1/{bulan}/{tahun}', [DashboardApiController_N1::class, 'dataStokChartPie_N1'])->name('api.dataStokChartPie_N1');
        Route::get('data-region-stok-chart-n1/{bulan}/{tahun}', [DashboardApiController_N1::class, 'dataRegionStokChart_N1'])->name('api.dataRegionStokChart_N1');
        Route::get('data-produksi-digunakan-chart-n1/{bulan}/{tahun}', [DashboardApiController_N1::class, 'dataProduksiDigunakanChart_N1'])->name('api.dataProduksiDigunakanChart_N1');
        Route::get('data-scatter-n1/{bulan}/{tahun}/{tipe}', [DashboardApiController_N1::class, 'dataScatter_N1'])->name('api.dataScatter_N1');
        Route::get('data-scatter-bi-n1/{bulan}/{tahun}/{tipe}', [DashboardApiController_N1::class, 'dataScatterBi_N1'])->name('api.dataScatterBi_N1');


        Route::get('data-detail-chart-sd-n1/{bulan}/{tahun}/{tipe}', [DashboardApiController_N1::class, 'getDetailChartSd_N1'])->name('api.dataDetailChartSd_N1');
        Route::get('data-detail-chart-bi-n1/{bulan}/{tahun}/{tipe}', [DashboardApiController_N1::class, 'getDetailChartBi_N1'])->name('api.dataDetailChartBi_N1');
        Route::get('data-item-detail-n1/{bulan}/{tahun}/{tipe}', [DashboardApiController_N1::class, 'getDataItemDetail_N1'])->name('api.dataItemDetail_N1');
        Route::get('data-item-detail-bi-n1/{bulan}/{tahun}/{tipe}', [DashboardApiController_N1::class, 'getDataItemDetailBi_N1'])->name('api.getDataItemDetailBi_N1');
                                                                                                        
    });
});

