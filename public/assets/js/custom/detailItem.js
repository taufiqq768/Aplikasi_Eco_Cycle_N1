function updateChartData(bulan, tahun, tipe) {
    var chartLineColumnColors = getChartColorsArray("pattern_chart");
    var chartLineColumnColors2 = getChartColorsArray("chart_penjualan");

    requestAnimationFrame(() => {
        $.ajax({
            url: "/api/data-detail-chart-sd/" + bulan + "/" + tahun + "/" + tipe,
            type: "GET",
            success: function (response) {
                $('.phChart').hide();
                const labels = response.labels;
                const produksi = response.diproduksi;
                const digunakan = response.digunakan;
                const dijual = response.dijual;
                const pendapatan = response.pendapatan;
                const hargaRataRata = response.hargaRataRata;
                const selisih = produksi.map((stok, index) => stok - digunakan[index] - dijual[
                    index]);

                const options2 = {
                    chart: {
                        height: 350,
                        type: 'line',
                        toolbar: {
                            show: false,
                        }
                    },
                    title: {
                        text: 'Data Produksi, Digunakan, Dijual, & Sisa',
                        style: {
                            fontWeight: 500,
                        },
                    },
                    series: [{
                        name: 'Produksi',
                        type: 'column',
                        data: produksi
                    },
                    {
                        name: 'Digunakan',
                        type: 'column',
                        data: digunakan
                    },
                    {
                        name: 'Dijual',
                        type: 'column',
                        data: dijual
                    },
                    {
                        name: 'Sisa',
                        type: 'line',
                        data: selisih
                    },
                    ],
                    stroke: {
                        width: [0, 0, 0, 3]
                    },
                    labels: labels,
                    xaxis: {
                        categories: labels,
                    },
                    yaxis: [{
                        title: {
                            text: 'Produksi & Digunakan'
                        },
                        labels: {
                            formatter: function (value) {
                                return new Intl.NumberFormat('id-ID').format(
                                    value);
                            }
                        }
                    },
                    {
                        opposite: true,
                        title: {
                            text: 'Sisa'
                        },
                        labels: {
                            formatter: function (value) {
                                return new Intl.NumberFormat('id-ID').format(
                                    value);
                            }
                        }
                    }
                    ],
                    dataLabels: {
                        enabled: true,
                        enabledOnSeries: [3],
                        formatter: function (value) {
                            return new Intl.NumberFormat('id-ID').format(value);
                        },
                        offsetY: -10,
                    },
                    colors: ["#E0FFE0", "#7FFF7F", "#228B22", "#004d00"],
                };

                const optionsPenjualan = {
                    chart: {
                        height: 350,
                        type: 'line',
                        toolbar: {
                            show: false,
                        }
                    },
                    title: {
                        text: 'Data Penjualan, Pendapatan, & Harga Jual Rata-Rata',
                        style: {
                            fontWeight: 500,
                        },
                    },
                    series: [{
                        name: 'Penjualan',
                        type: 'column',
                        data: dijual
                    },
                    {
                        name: 'Pendapatan',
                        type: 'column',
                        data: pendapatan
                    },
                    {
                        name: 'Harga Jual Rata-Rata',
                        type: 'line',
                        data: hargaRataRata,
                    },
                    ],
                    stroke: {
                        width: [0, 0, 3]
                    },
                    labels: labels,
                    xaxis: {
                        categories: labels,
                    },
                    yaxis: [{
                        title: {
                            text: 'Penjualan'
                        },
                        min: 0,
                        labels: {
                            formatter: function (value) {
                                return new Intl.NumberFormat('id-ID').format(
                                    value);
                            }
                        }
                    },
                    {
                        opposite: true,
                        title: {
                            text: 'Pendapatan'
                        },
                        labels: {
                            formatter: function (value) {
                                return new Intl.NumberFormat('id-ID').format(
                                    value);
                            }
                        }
                    }
                    ],
                    dataLabels: {
                        enabled: true,
                        enabledOnSeries: [2],
                        formatter: function (value) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                        },
                        offsetY: -10,
                    },
                    colors: ["#7FFF7F", "#228B22", "#004d00"],
                };

                if (chart2) {
                    chart2.updateSeries(options2.series);
                } else {
                    chart2 = new ApexCharts(document.querySelector("#pattern_chart"), options2);
                    chart2.render();
                }
                if (chartPenjualan) {
                    chartPenjualan.updateSeries(optionsPenjualan.series);
                } else {
                    chartPenjualan = new ApexCharts(document.querySelector("#chart_penjualan"),
                        optionsPenjualan);
                    chartPenjualan.render();
                }
            },
            error: function (xhr) {
                console.error("Error fetching chart data:", xhr.responseText);
            }
        });

        $.ajax({
            url: "/api/data-detail-chart-bi/" + bulan + "/" + tahun + "/" + tipe,
            type: "GET",
            success: function (response) {
                $('.phChart').hide();
                const labels = response.labels;
                const produksi = response.diproduksi;
                const digunakan = response.digunakan;
                const dijual = response.dijual;
                const pendapatan = response.pendapatan;
                const hargaRataRata = response.hargaRataRata;
                const selisih = produksi.map((stok, index) => stok - digunakan[index] - dijual[
                    index]);

                const options2Bi = {
                    chart: {
                        height: 350,
                        type: 'line',
                        toolbar: {
                            show: false,
                        }
                    },
                    title: {
                        text: 'Data Produksi, Digunakan, Dijual, & Sisa',
                        style: {
                            fontWeight: 500,
                        },
                    },
                    series: [{
                        name: 'Produksi',
                        type: 'column',
                        data: produksi
                    },
                    {
                        name: 'Digunakan',
                        type: 'column',
                        data: digunakan
                    },
                    {
                        name: 'Dijual',
                        type: 'column',
                        data: dijual
                    },
                    {
                        name: 'Sisa',
                        type: 'line',
                        data: selisih
                    },
                    ],
                    stroke: {
                        width: [0, 0, 0, 3]
                    },
                    labels: labels,
                    xaxis: {
                        categories: labels,
                    },
                    yaxis: [{
                        title: {
                            text: 'Produksi & Digunakan'
                        },
                        labels: {
                            formatter: function (value) {
                                return new Intl.NumberFormat('id-ID').format(
                                    value);
                            }
                        }
                    },
                    {
                        opposite: true,
                        title: {
                            text: 'Sisa'
                        },
                        labels: {
                            formatter: function (value) {
                                return new Intl.NumberFormat('id-ID').format(
                                    value);
                            }
                        }
                    }
                    ],
                    dataLabels: {
                        enabled: true,
                        enabledOnSeries: [3],
                        formatter: function (value) {
                            return new Intl.NumberFormat('id-ID').format(value);
                        },
                        offsetY: -10,
                    },
                    colors: ["#E0FFE0", "#7FFF7F", "#228B22", "#004d00"],
                };

                const optionsPenjualanBi = {
                    chart: {
                        height: 350,
                        type: 'line',
                        toolbar: {
                            show: false,
                        }
                    },
                    title: {
                        text: 'Data Penjualan, Pendapatan, & Harga Jual Rata-Rata',
                        style: {
                            fontWeight: 500,
                        },
                    },
                    series: [{
                        name: 'Penjualan',
                        type: 'column',
                        data: dijual
                    },
                    {
                        name: 'Pendapatan',
                        type: 'column',
                        data: pendapatan
                    },
                    {
                        name: 'Harga Jual Rata-Rata',
                        type: 'line',
                        data: hargaRataRata,
                    },
                    ],
                    stroke: {
                        width: [0, 0, 3]
                    },
                    labels: labels,
                    xaxis: {
                        categories: labels,
                    },
                    yaxis: [{
                        title: {
                            text: 'Penjualan'
                        },
                        min: 0,
                        labels: {
                            formatter: function (value) {
                                return new Intl.NumberFormat('id-ID').format(
                                    value);
                            }
                        }
                    },
                    {
                        opposite: true,
                        title: {
                            text: 'Pendapatan'
                        },
                        labels: {
                            formatter: function (value) {
                                return new Intl.NumberFormat('id-ID').format(
                                    value);
                            }
                        }
                    }
                    ],
                    dataLabels: {
                        enabled: true,
                        enabledOnSeries: [2],
                        formatter: function (value) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                        },
                        offsetY: -10,
                    },
                    colors: ["#7FFF7F", "#228B22", "#004d00"],
                };

                if (chart2Bi) {
                    chart2Bi.updateSeries(options2Bi.series);
                } else {
                    chart2Bi = new ApexCharts(document.querySelector("#pattern_chart_bi"), options2Bi);
                    chart2Bi.render();
                }
                if (chartPenjualanBi) {
                    chartPenjualanBi.updateSeries(optionsPenjualanBi.series);
                } else {
                    chartPenjualanBi = new ApexCharts(document.querySelector("#chart_penjualan_bi"),
                        optionsPenjualanBi);
                    chartPenjualanBi.render();
                }
            },
            error: function (xhr) {
                console.error("Error fetching chart data:", xhr.responseText);
            }
        });

        requestAnimationFrame(() => {
            $.ajax({
                url: '/api/data-scatter/' + bulan + '/' + tahun + '/' + tipe,
                type: 'GET',
                success: function (response) {
                    $('.phScatter').hide();
                    var chartScatterBasicColors = getChartColorsArray("basic_scatter");
                    if (chartScatterBasicColors) {

                        var dataSeries = [];
                        var annotations = [];

                        var optionsScatter = {
                            series: [{
                                name: "Unit",
                                data: response.dataSeries,
                            }],
                            chart: {
                                height: 350,
                                type: 'scatter',
                                zoom: {
                                    enabled: true,
                                    type: 'xy'
                                },
                                toolbar: {
                                    show: false
                                }
                            },
                            xaxis: {
                                tickAmount: 10,
                                title: {
                                    text: 'Produksi'
                                },
                                labels: {
                                    formatter: function (val) {
                                        return parseFloat(val).toLocaleString(
                                            'id-ID', {
                                            minimumFractionDigits: 1,
                                            maximumFractionDigits: 1
                                        });
                                    }
                                }
                            },
                            yaxis: {
                                tickAmount: 10,
                                title: {
                                    text: 'Penjualan'
                                },
                                labels: {
                                    formatter: function (val) {
                                        return parseFloat(val).toLocaleString(
                                            'id-ID', {
                                            minimumFractionDigits: 1,
                                            maximumFractionDigits: 1
                                        });
                                    }
                                }
                            },
                            colors: ['#00FF00'], // Set point color to green
                            tooltip: {
                                shared: false,
                                custom: function ({
                                    seriesIndex,
                                    dataPointIndex,
                                    w
                                }) {
                                    let data = w.config.series[seriesIndex]
                                        .data[
                                        dataPointIndex]
                                        .customData;
                                    return `<div style="padding:5px;">
                                <strong>${data.name}</strong><br>
                                Produksi: ${parseFloat(data.produksi).toLocaleString('id-ID')}<br>
                                Penjualan: ${parseFloat(data.penjualan).toLocaleString('id-ID')}
                                </div>`;
                                }
                            },
                            markers: {
                                size: 6,
                                strokeColors: '#00FF00',
                                fillOpacity: 1,
                                strokeWidth: 2,
                                hover: {
                                    size: 8
                                }
                            },
                            annotations: {
                                points: response.annotations
                            }
                        };

                        if (chartScatter) {
                            chartScatter.updateSeries(optionsScatter.series);
                        } else {
                            chartScatter = new ApexCharts(document.querySelector(
                                "#basic_scatter"),
                                optionsScatter);
                            chartScatter.render();
                        }
                    }
                },
                error: function (xhr) {
                    console.error("Error fetching chart data:", xhr.responseText);
                }
            })

            $.ajax({
                url: '/api/data-scatter-bi/' + bulan + '/' + tahun + '/' + tipe,
                type: 'GET',
                success: function (response) {
                    $('.phScatter').hide();
                    var chartScatterBasicColors = getChartColorsArray("basic_scatter");
                    if (chartScatterBasicColors) {

                        var dataSeries = [];
                        var annotations = [];

                        var optionsScatterBi = {
                            series: [{
                                name: "Unit",
                                data: response.dataSeries,
                            }],
                            chart: {
                                height: 350,
                                type: 'scatter',
                                zoom: {
                                    enabled: true,
                                    type: 'xy'
                                },
                                toolbar: {
                                    show: false
                                }
                            },
                            xaxis: {
                                tickAmount: 10,
                                title: {
                                    text: 'Produksi'
                                },
                                labels: {
                                    formatter: function (val) {
                                        return parseFloat(val).toLocaleString(
                                            'id-ID', {
                                            minimumFractionDigits: 1,
                                            maximumFractionDigits: 1
                                        });
                                    }
                                }
                            },
                            yaxis: {
                                tickAmount: 10,
                                title: {
                                    text: 'Penjualan'
                                },
                                labels: {
                                    formatter: function (val) {
                                        return parseFloat(val).toLocaleString(
                                            'id-ID', {
                                            minimumFractionDigits: 1,
                                            maximumFractionDigits: 1
                                        });
                                    }
                                }
                            },
                            colors: ['#00FF00'], // Set point color to green
                            tooltip: {
                                shared: false,
                                custom: function ({
                                    seriesIndex,
                                    dataPointIndex,
                                    w
                                }) {
                                    let data = w.config.series[seriesIndex]
                                        .data[
                                        dataPointIndex]
                                        .customData;
                                    return `<div style="padding:5px;">
                                <strong>${data.name}</strong><br>
                                Produksi: ${parseFloat(data.produksi).toLocaleString('id-ID')}<br>
                                Penjualan: ${parseFloat(data.penjualan).toLocaleString('id-ID')}
                                </div>`;
                                }
                            },
                            markers: {
                                size: 6,
                                strokeColors: '#00FF00',
                                fillOpacity: 1,
                                strokeWidth: 2,
                                hover: {
                                    size: 8
                                }
                            },
                            annotations: {
                                points: response.annotations
                            }
                        };

                        if (chartScatterBi) {
                            chartScatterBi.updateSeries(optionsScatterBi.series);
                        } else {
                            chartScatterBi = new ApexCharts(document.querySelector(
                                "#basic_scatter_bi"),
                                optionsScatterBi);
                            chartScatterBi.render();
                        }
                    }
                },
                error: function (xhr) {
                    console.error("Error fetching chart data:", xhr.responseText);
                }
            })
        });
    });

    if (tipe === 'cangkang') {
        if ($.fn.dataTable.isDataTable('#tableCangkang')) {
            // If it exists, get the DataTable instance
            var table = $('#tableCangkang').DataTable();

            // Update the AJAX source
            table.ajax.url('/api/data-item-detail/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } else {
            $('#tableCangkang').DataTable({
                "responsive": false,
                "scrollX": true,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail/' + bulan + '/' + tahun + "/" + tipe,
                    "type": "GET"
                },
                "columns": [{
                    "data": "region",
                    "name": "region",
                    "class": "text-nowrap align-middle"
                },
                {
                    "data": "nama_unit",
                    "name": "nama_unit",
                    class: 'text-nowrap align-middle',
                    render: function (data, type, row) {
                        if (row.has_log) {
                            return `${row.nama_unit} <a href="#" @click="openModal('${row.kode_unit}', '${bulan}', '${tahun}')"><span class="badge badge-sm badge-warning badge-circle"> <i class="fas fa-info"></i> </span></a>`;
                        }
                        return row.nama_unit;
                    }
                },
                {
                    "data": "tbs_olah",
                    "name": "tbs_olah",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "produksi_cangkang",
                    "name": "produksi_cangkang",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_cangkang / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan_u_bahan_bakar",
                    "name": "digunakan_u_bahan_bakar",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return (row.produksi_cangkang - row.digunakan_u_bahan_bakar)
                            .toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "sisa_stok_akhir",
                    "name": "sisa_stok_akhir",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "dikirim_ke_pabrik_teh",
                    "name": "dikirim_ke_pabrik_teh",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "dikirim_ke_pabrik_karet",
                    "name": "dikirim_ke_pabrik_karet",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "dikirim_ke_pabrik_gula",
                    "name": "dikirim_ke_pabrik_gula",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "dikirim_ke_bibitan_kelapa_sawit",
                    "name": "dikirim_ke_bibitan_kelapa_sawit",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "dikirim_ke_pks_lain",
                    "name": "dikirim_ke_pks_lain",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "volume_keperluan_lain",
                    "name": "volume_keperluan_lain",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "keterangan_keperluan_lain",
                    "name": "keterangan_keperluan_lain",
                    "class": "align-middle",
                },
                {
                    "data": "dijual",
                    "name": "dijual",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "harga_jual_rata_rata",
                    "name": "harga_jual_rata_rata",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "name": "pendapatan",
                    "render": function (row) {
                        return (row.dijual * row.harga_jual_rata_rata).toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "stok_cangkang",
                    "name": "stok_cangkang",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "diterima_dari_pks_lain",
                    "name": "diterima_dari_pks_lain",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "persen_ekses_cangkang",
                    "name": "persen_ekses_cangkang",
                    "render": function (data, type, row) {
                        return row.persen_ekses_cangkang.toFixed(2).replace('.', ',') + '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "material_balance",
                    "name": "material_balance",
                    "render": function (data, type, row) {
                        return row.material_balance.toFixed(2).replace('.', ',') + '%';
                    },
                    "class": "align-middle",
                }
                ],
                "language": {
                    "paginate": {
                        "previous": "<i class='mdi mdi-chevron-left'></i>",
                        "next": "<i class='mdi mdi-chevron-right'></i>"
                    }
                },
                "drawCallback": function () {
                    $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                }
            });
        }

        if ($.fn.dataTable.isDataTable('#tableCangkangBi')) {
            // If it exists, get the DataTable instance
            var table = $('#tableCangkangBi').DataTable();

            // Update the AJAX source
            table.ajax.url('/api/data-item-detail-bi/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } else {
            $('#tableCangkangBi').DataTable({
                "responsive": false,
                "scrollX": true,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail-bi/' + bulan + '/' + tahun + "/" + tipe,
                    "type": "GET"
                },
                "columns": [{
                    "data": "region",
                    "name": "region",
                    "class": "text-nowrap align-middle"
                },
                {
                    "data": "nama_unit",
                    "name": "nama_unit",
                    class: 'text-nowrap align-middle',
                    render: function (data, type, row) {
                        if (row.has_log) {
                            return `${row.nama_unit} <a href="#" @click="openModal('${row.kode_unit}', '${bulan}', '${tahun}')"><span class="badge badge-sm badge-warning badge-circle"> <i class="fas fa-info"></i> </span></a>`;
                        }
                        return row.nama_unit;
                    }
                },
                {
                    "data": "tbs_olah",
                    "name": "tbs_olah",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "produksi_cangkang",
                    "name": "produksi_cangkang",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_cangkang / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan_u_bahan_bakar",
                    "name": "digunakan_u_bahan_bakar",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return (row.produksi_cangkang - row.digunakan_u_bahan_bakar)
                            .toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "dikirim_ke_pabrik_teh",
                    "name": "dikirim_ke_pabrik_teh",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "dikirim_ke_pabrik_karet",
                    "name": "dikirim_ke_pabrik_karet",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "dikirim_ke_pabrik_gula",
                    "name": "dikirim_ke_pabrik_gula",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "dikirim_ke_bibitan_kelapa_sawit",
                    "name": "dikirim_ke_bibitan_kelapa_sawit",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "dikirim_ke_pks_lain",
                    "name": "dikirim_ke_pks_lain",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "volume_keperluan_lain",
                    "name": "volume_keperluan_lain",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "keterangan_keperluan_lain",
                    "name": "keterangan_keperluan_lain",
                    "class": "align-middle",
                },
                {
                    "data": "dijual",
                    "name": "dijual",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "harga_jual_rata_rata",
                    "name": "harga_jual_rata_rata",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "name": "pendapatan",
                    "render": function (row) {
                        return (row.dijual * row.harga_jual_rata_rata).toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "stok_cangkang",
                    "name": "stok_cangkang",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "diterima_dari_pks_lain",
                    "name": "diterima_dari_pks_lain",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "persen_ekses_cangkang",
                    "name": "persen_ekses_cangkang",
                    "render": function (data, type, row) {
                        return row.persen_ekses_cangkang.toFixed(2).replace('.', ',') + '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "material_balance",
                    "name": "material_balance",
                    "render": function (data, type, row) {
                        return row.material_balance.toFixed(2).replace('.', ',') + '%';
                    },
                    "class": "align-middle",
                }
                ],
                "language": {
                    "paginate": {
                        "previous": "<i class='mdi mdi-chevron-left'></i>",
                        "next": "<i class='mdi mdi-chevron-right'></i>"
                    }
                },
                "drawCallback": function () {
                    $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                }
            });
        }
    } else if (tipe === 'fiber') {
        if ($.fn.dataTable.isDataTable('#tableFiber')) {
            var table = $('#tableFiber').DataTable();

            table.ajax.url('/api/data-item-detail/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } else {
            $('#tableFiber').DataTable({
                "responsive": false,
                "scrollX": true,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail/' + bulan + '/' + tahun + "/" + tipe,
                    "type": "GET"
                },
                "columns": [{
                    "data": "region",
                    "name": "region",
                    "class": "text-nowrap align-middle"
                },
                {
                    "data": "nama_unit",
                    "name": "nama_unit",
                    class: 'text-nowrap align-middle',
                    render: function (data, type, row) {
                        if (row.has_log) {
                            return `${data} <a href="#" @click="openModal('${row.kode_unit}', '${bulan}', '${tahun}')"><span class="badge badge-sm badge-warning badge-circle"> <i class="fas fa-info"></i> </span></a>`;
                        }
                        return data;
                    }
                },
                {
                    "data": "tbs_olah",
                    "name": "tbs_olah",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "produksi_fiber",
                    "name": "produksi_fiber",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_fiber / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan_u_bahan_bakar",
                    "name": "digunakan_u_bahan_bakar",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return (row.produksi_fiber - row.digunakan_u_bahan_bakar)
                            .toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "sisa_stok_akhir",
                    "name": "sisa_stok_akhir",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "dikirim_ke_pabrik_teh",
                    "name": "dikirim_ke_pabrik_teh",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "dikirim_ke_pabrik_karet",
                    "name": "dikirim_ke_pabrik_karet",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "dikirim_ke_pabrik_gula",
                    "name": "dikirim_ke_pabrik_gula",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "dikirim_ke_bibitan_kelapa_sawit",
                    "name": "dikirim_ke_bibitan_kelapa_sawit",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "dikirim_ke_pks_lain",
                    "name": "dikirim_ke_pks_lain",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "volume_keperluan_lain",
                    "name": "volume_keperluan_lain",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "keterangan_keperluan_lain",
                    "name": "keterangan_keperluan_lain",
                    "class": "align-middle",
                },
                {
                    "data": "dijual",
                    "name": "dijual",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "harga_jual_rata_rata",
                    "name": "harga_jual_rata_rata",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "name": "pendapatan",
                    "render": function (data, type, row) {
                        return (row.dijual * row.harga_jual_rata_rata).toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "stok_fiber",
                    "name": "stok_fiber",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "diterima_dari_pks_lain",
                    "name": "diterima_dari_pks_lain",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "persen_ekses_fiber",
                    "name": "persen_ekses_fiber",
                    "render": function (data, type, row) {
                        return row.persen_ekses_fiber.toFixed(2).replace('.', ',') + '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "material_balance",
                    "name": "material_balance",
                    "render": function (data, type, row) {
                        return row.material_balance.toFixed(2).replace('.', ',') + '%';
                    },
                    "class": "align-middle",
                }
                ],
                "language": {
                    "paginate": {
                        "previous": "<i class='mdi mdi-chevron-left'></i>",
                        "next": "<i class='mdi mdi-chevron-right'></i>"
                    }
                },
                "drawCallback": function () {
                    $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                }
            });
        }

        if ($.fn.dataTable.isDataTable('#tableFiberBi')) {
            var table = $('#tableFiberBi').DataTable();

            table.ajax.url('/api/data-item-detail-bi/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } else {
            $('#tableFiberBi').DataTable({
                "responsive": false,
                "scrollX": true,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail/' + bulan + '/' + tahun + "/" + tipe,
                    "type": "GET"
                },
                "columns": [{
                    "data": "region",
                    "name": "region",
                    "class": "text-nowrap align-middle"
                },
                {
                    "data": "nama_unit",
                    "name": "nama_unit",
                    class: 'text-nowrap align-middle',
                    render: function (data, type, row) {
                        if (row.has_log) {
                            return `${data} <a href="#" @click="openModal('${row.kode_unit}', '${bulan}', '${tahun}')"><span class="badge badge-sm badge-warning badge-circle"> <i class="fas fa-info"></i> </span></a>`;
                        }
                        return data;
                    }
                },
                {
                    "data": "tbs_olah",
                    "name": "tbs_olah",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "produksi_fiber",
                    "name": "produksi_fiber",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_fiber / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan_u_bahan_bakar",
                    "name": "digunakan_u_bahan_bakar",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return (row.produksi_fiber - row.digunakan_u_bahan_bakar)
                            .toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "dikirim_ke_pabrik_teh",
                    "name": "dikirim_ke_pabrik_teh",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "dikirim_ke_pabrik_karet",
                    "name": "dikirim_ke_pabrik_karet",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "dikirim_ke_pabrik_gula",
                    "name": "dikirim_ke_pabrik_gula",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "dikirim_ke_bibitan_kelapa_sawit",
                    "name": "dikirim_ke_bibitan_kelapa_sawit",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "dikirim_ke_pks_lain",
                    "name": "dikirim_ke_pks_lain",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "volume_keperluan_lain",
                    "name": "volume_keperluan_lain",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "keterangan_keperluan_lain",
                    "name": "keterangan_keperluan_lain",
                    "class": "align-middle",
                },
                {
                    "data": "dijual",
                    "name": "dijual",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "harga_jual_rata_rata",
                    "name": "harga_jual_rata_rata",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "name": "pendapatan",
                    "render": function (data, type, row) {
                        return (row.dijual * row.harga_jual_rata_rata).toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "stok_fiber",
                    "name": "stok_fiber",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "diterima_dari_pks_lain",
                    "name": "diterima_dari_pks_lain",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "persen_ekses_fiber",
                    "name": "persen_ekses_fiber",
                    "render": function (data, type, row) {
                        return row.persen_ekses_fiber.toFixed(2).replace('.', ',') + '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "material_balance",
                    "name": "material_balance",
                    "render": function (data, type, row) {
                        return row.material_balance.toFixed(2).replace('.', ',') + '%';
                    },
                    "class": "align-middle",
                }
                ],
                "language": {
                    "paginate": {
                        "previous": "<i class='mdi mdi-chevron-left'></i>",
                        "next": "<i class='mdi mdi-chevron-right'></i>"
                    }
                },
                "drawCallback": function () {
                    $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                }
            });
        }
    } else if (tipe == 'tankos') {
        if ($.fn.dataTable.isDataTable('#tableTankos')) {
            var table = $('#tableTankos').DataTable();

            table.ajax.url('/api/data-item-detail/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } else {
            $('#tableTankos').DataTable({
                "responsive": false,
                "scrollX": true,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail/' + bulan + '/' + tahun + "/" + tipe,
                    "type": "GET"
                },
                "columns": [{
                    "data": "region",
                    "name": "region",
                    "class": "text-nowrap align-middle"
                },
                {
                    "data": "nama_unit",
                    "name": "nama_unit",
                    class: 'text-nowrap align-middle',
                    render: function (data, type, row) {
                        if (row.has_log) {
                            return `${data} <a href="#" @click="openModal('${row.kode_unit}', '${bulan}', '${tahun}')"><span class="badge badge-sm badge-warning badge-circle"> <i class="fas fa-info"></i> </span></a>`;
                        }
                        return data;
                    }
                },
                {
                    "data": "tbs_olah",
                    "name": "tbs_olah",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "produksi_tankos",
                    "name": "produksi_tankos",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_tankos / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan_sbg_pupuk_organik",
                    "name": "digunakan_sbg_pupuk_organik",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "digunakan_u_pltbm",
                    "name": "digunakan_u_pltbm",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "dikembalikan_ke_pemasok",
                    "name": "dikembalikan_ke_pemasok",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return (row.produksi_tankos - row.digunakan_sbg_pupuk_organik)
                            .toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "dibakar_di_tungku_bakar",
                    "name": "dibakar_di_tungku_bakar",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "volume_keperluan_lain",
                    "name": "volume_keperluan_lain",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "keterangan_keperluan_lain",
                    "name": "keterangan_keperluan_lain",
                    "class": "align-middle",
                },
                {
                    "data": "dijual",
                    "name": "dijual",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "harga_jual_rata_rata",
                    "name": "harga_jual_rata_rata",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "name": "pendapatan",
                    "render": function (data, type, row) {
                        return (row.dijual * row.harga_jual_rata_rata).toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "stok_tankos",
                    "name": "stok_tankos",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "sisa_stok_akhir",
                    "name": "sisa_stok_akhir",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                }],
                "language": {
                    "paginate": {
                        "previous": "<i class='mdi mdi-chevron-left'></i>",
                        "next": "<i class='mdi mdi-chevron-right'></i>"
                    }
                },
                "drawCallback": function () {
                    $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                }
            });
        }

        if ($.fn.dataTable.isDataTable('#tableTankosBi')) {
            var table = $('#tableTankosBi').DataTable();

            table.ajax.url('/api/data-item-detail-bi/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } else {
            $('#tableTankosBi').DataTable({
                "responsive": false,
                "scrollX": true,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail-bi/' + bulan + '/' + tahun + "/" + tipe,
                    "type": "GET"
                },
                "columns": [{
                    "data": "region",
                    "name": "region",
                    "class": "text-nowrap align-middle"
                },
                {
                    "data": "nama_unit",
                    "name": "nama_unit",
                    class: 'text-nowrap align-middle',
                    render: function (data, type, row) {
                        if (row.has_log) {
                            return `${data} <a href="#" @click="openModal('${row.kode_unit}', '${bulan}', '${tahun}')"><span class="badge badge-sm badge-warning badge-circle"> <i class="fas fa-info"></i> </span></a>`;
                        }
                        return data;
                    }
                },
                {
                    "data": "tbs_olah",
                    "name": "tbs_olah",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "produksi_tankos",
                    "name": "produksi_tankos",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_tankos / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan_sbg_pupuk_organik",
                    "name": "digunakan_sbg_pupuk_organik",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "digunakan_u_pltbm",
                    "name": "digunakan_u_pltbm",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "dikembalikan_ke_pemasok",
                    "name": "dikembalikan_ke_pemasok",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return (row.produksi_tankos - row.digunakan_sbg_pupuk_organik)
                            .toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "dibakar_di_tungku_bakar",
                    "name": "dibakar_di_tungku_bakar",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "volume_keperluan_lain",
                    "name": "volume_keperluan_lain",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "keterangan_keperluan_lain",
                    "name": "keterangan_keperluan_lain",
                    "class": "align-middle",
                },
                {
                    "data": "dijual",
                    "name": "dijual",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "harga_jual_rata_rata",
                    "name": "harga_jual_rata_rata",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "name": "pendapatan",
                    "render": function (data, type, row) {
                        return (row.dijual * row.harga_jual_rata_rata).toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "stok_tankos",
                    "name": "stok_tankos",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                }],
                "language": {
                    "paginate": {
                        "previous": "<i class='mdi mdi-chevron-left'></i>",
                        "next": "<i class='mdi mdi-chevron-right'></i>"
                    }
                },
                "drawCallback": function () {
                    $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                }
            });
        }
    } else if (tipe == 'abu_janjang') {
        if ($.fn.dataTable.isDataTable('#tableAbuJanjang')) {
            var table = $('#tableAbuJanjang').DataTable();

            table.ajax.url('/api/data-item-detail/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } else {
            $('#tableAbuJanjang').DataTable({
                "responsive": false,
                "scrollX": true,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail/' + bulan + '/' + tahun + "/" + tipe,
                    "type": "GET"
                },
                "columns": [{
                    "data": "region",
                    "name": "region",
                    "class": "text-nowrap align-middle"
                },
                {
                    "data": "nama_unit",
                    "name": "nama_unit",
                    class: 'text-nowrap align-middle',
                    render: function (data, type, row) {
                        if (row.has_log) {
                            return `${data} <a href="#" @click="openModal('${row.kode_unit}', '${bulan}', '${tahun}')"><span class="badge badge-sm badge-warning badge-circle"> <i class="fas fa-info"></i> </span></a>`;
                        }
                        return data;
                    }
                },
                {
                    "data": "tbs_olah",
                    "name": "tbs_olah",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "tankos_dibakar",
                    "name": "tankos_dibakar",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "produksi_abu_janjang",
                    "name": "produksi_abu_janjang",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (row) {
                        return ((row.produksi_abu_janjang / row.tankos_dibakar) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan_sbg_pupuk_organik",
                    "name": "digunakan_sbg_pupuk_organik",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },

                {
                    "data": null,
                    "render": function (row) {
                        return (row.produksi_abu_janjang - row.digunakan_sbg_pupuk_organik)
                            .toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "volume_keperluan_lain",
                    "name": "volume_keperluan_lain",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "keterangan_keperluan_lain",
                    "name": "keterangan_keperluan_lain",
                    "class": "align-middle",
                },
                {
                    "data": "dijual",
                    "name": "dijual",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "harga_jual_rata_rata",
                    "name": "harga_jual_rata_rata",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "name": "pendapatan",
                    "render": function (data, type, row) {
                        return (row.dijual * row.harga_jual_rata_rata).toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "stok_abu_janjang",
                    "name": "stok_abu_janjang",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "sisa_stok_akhir",
                    "name": "sisa_stok_akhir",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                }],
                "language": {
                    "paginate": {
                        "previous": "<i class='mdi mdi-chevron-left'></i>",
                        "next": "<i class='mdi mdi-chevron-right'></i>"
                    }
                },
                "drawCallback": function () {
                    $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                }
            });
        }

        if ($.fn.dataTable.isDataTable('#tableAbuJanjangBi')) {
            var table = $('#tableAbuJanjangBi').DataTable();

            table.ajax.url('/api/data-item-detail-bi/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } else {
            $('#tableAbuJanjangBi').DataTable({
                "responsive": false,
                "scrollX": true,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail-bi/' + bulan + '/' + tahun + "/" + tipe,
                    "type": "GET"
                },
                "columns": [{
                    "data": "region",
                    "name": "region",
                    "class": "text-nowrap align-middle"
                },
                {
                    "data": "nama_unit",
                    "name": "nama_unit",
                    class: 'text-nowrap align-middle',
                    render: function (data, type, row) {
                        if (row.has_log) {
                            return `${data} <a href="#" @click="openModal('${row.kode_unit}', '${bulan}', '${tahun}')"><span class="badge badge-sm badge-warning badge-circle"> <i class="fas fa-info"></i> </span></a>`;
                        }
                        return data;
                    }
                },
                {
                    "data": "tbs_olah",
                    "name": "tbs_olah",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "tankos_dibakar",
                    "name": "tankos_dibakar",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "produksi_abu_janjang",
                    "name": "produksi_abu_janjang",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (row) {
                        return ((row.produksi_abu_janjang / row.tankos_dibakar) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan_sbg_pupuk_organik",
                    "name": "digunakan_sbg_pupuk_organik",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },

                {
                    "data": null,
                    "render": function (row) {
                        return (row.produksi_abu_janjang - row.digunakan_sbg_pupuk_organik)
                            .toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "volume_keperluan_lain",
                    "name": "volume_keperluan_lain",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "keterangan_keperluan_lain",
                    "name": "keterangan_keperluan_lain",
                    "class": "align-middle",
                },
                {
                    "data": "dijual",
                    "name": "dijual",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "harga_jual_rata_rata",
                    "name": "harga_jual_rata_rata",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "name": "pendapatan",
                    "render": function (data, type, row) {
                        return (row.dijual * row.harga_jual_rata_rata).toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "stok_abu_janjang",
                    "name": "stok_abu_janjang",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                }],
                "language": {
                    "paginate": {
                        "previous": "<i class='mdi mdi-chevron-left'></i>",
                        "next": "<i class='mdi mdi-chevron-right'></i>"
                    }
                },
                "drawCallback": function () {
                    $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                }
            });
        }
    } else if (tipe == 'solid') {
        if ($.fn.dataTable.isDataTable('#tableSolid')) {
            var table = $('#tableSolid').DataTable();

            table.ajax.url('/api/data-item-detail/' + bulan + '/' + tahun + "/" + tipe).load();
        } else {
            $('#tableSolid').DataTable({
                "responsive": false,
                "scrollX": true,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail/' + bulan + '/' + tahun + "/" + tipe,
                    "type": "GET"
                },
                "columns": [{
                    "data": "region",
                    "name": "region",
                    "class": "text-nowrap align-middle"
                },
                {
                    "data": "nama_unit",
                    "name": "nama_unit",
                    class: 'text-nowrap align-middle',
                    render: function (data, type, row) {
                        if (row.has_log) {
                            return `${data} <a href="#" @click="openModal('${row.kode_unit}', '${bulan}', '${tahun}')"><span class="badge badge-sm badge-warning badge-circle"> <i class="fas fa-info"></i> </span></a>`;
                        }
                        return data;
                    }
                },
                {
                    "data": "tbs_olah",
                    "name": "tbs_olah",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "produksi_solid",
                    "name": "produksi_solid",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_solid / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan_sbg_pupuk_organik",
                    "name": "digunakan_sbg_pupuk_organik",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "volume_keperluan_lain",
                    "name": "volume_keperluan_lain",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "keterangan_keperluan_lain",
                    "name": "keterangan_keperluan_lain",
                    "class": "align-middle",
                },
                {
                    "data": "dijual",
                    "name": "dijual",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "harga_jual_rata_rata",
                    "name": "harga_jual_rata_rata",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "name": "pendapatan",
                    "render": function (data, type, row) {
                        return (row.dijual * row.harga_jual_rata_rata).toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "stok_solid",
                    "name": "stok_solid",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "sisa_stok_akhir",
                    "name": "sisa_stok_akhir",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                }],
                "language": {
                    "paginate": {
                        "previous": "<i class='mdi mdi-chevron-left'></i>",
                        "next": "<i class='mdi mdi-chevron-right'></i>"
                    }
                },
                "drawCallback": function () {
                    $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                }
            });
        }

        if ($.fn.dataTable.isDataTable('#tableSolidBi')) {
            var table = $('#tableSolidBi').DataTable();

            table.ajax.url('/api/data-item-detail-bi/' + bulan + '/' + tahun + "/" + tipe).load();
        } else {
            $('#tableSolidBi').DataTable({
                "responsive": false,
                "scrollX": true,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail-bi/' + bulan + '/' + tahun + "/" + tipe,
                    "type": "GET"
                },
                "columns": [{
                    "data": "region",
                    "name": "region",
                    "class": "text-nowrap align-middle"
                },
                {
                    "data": "nama_unit",
                    "name": "nama_unit",
                    class: 'text-nowrap align-middle',
                    render: function (data, type, row) {
                        if (row.has_log) {
                            return `${data} <a href="#" @click="openModal('${row.kode_unit}', '${bulan}', '${tahun}')"><span class="badge badge-sm badge-warning badge-circle"> <i class="fas fa-info"></i> </span></a>`;
                        }
                        return data;
                    }
                },
                {
                    "data": "tbs_olah",
                    "name": "tbs_olah",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "produksi_solid",
                    "name": "produksi_solid",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_solid / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan_sbg_pupuk_organik",
                    "name": "digunakan_sbg_pupuk_organik",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "volume_keperluan_lain",
                    "name": "volume_keperluan_lain",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "keterangan_keperluan_lain",
                    "name": "keterangan_keperluan_lain",
                    "class": "align-middle",
                },
                {
                    "data": "dijual",
                    "name": "dijual",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "harga_jual_rata_rata",
                    "name": "harga_jual_rata_rata",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "name": "pendapatan",
                    "render": function (data, type, row) {
                        return (row.dijual * row.harga_jual_rata_rata).toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "stok_solid",
                    "name": "stok_solid",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                }],
                "language": {
                    "paginate": {
                        "previous": "<i class='mdi mdi-chevron-left'></i>",
                        "next": "<i class='mdi mdi-chevron-right'></i>"
                    }
                },
                "drawCallback": function () {
                    $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                }
            });
        }
    } else if (tipe == 'pome') {
        if ($.fn.dataTable.isDataTable('#tablePome')) {
            var table = $('#tablePome').DataTable();

            table.ajax.url('/api/data-item-detail/' + bulan + '/' + tahun + "/" + tipe).load();
        } else {
            $('#tablePome').DataTable({
                "responsive": false,
                "scrollX": true,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail/' + bulan + '/' + tahun + "/" + tipe,
                    "type": "GET",
                },
                "columns": [{
                    "data": "region",
                    "name": "region",
                    "class": "text-nowrap align-middle"
                },
                {
                    "data": "nama_unit",
                    "name": "nama_unit",
                    class: 'text-nowrap align-middle',
                    render: function (data, type, row) {
                        if (row.has_log) {
                            return `${data} <a href="#" @click="openModal('${row.kode_unit}', '${bulan}', '${tahun}')"><span class="badge badge-sm badge-warning badge-circle"> <i class="fas fa-info"></i> </span></a>`;
                        }
                        return data;
                    }
                },
                {
                    "data": "tbs_olah",
                    "name": "tbs_olah",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "produksi_pome_oil",
                    "name": "produksi_pome_oil",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    render: function (data, type, row) {
                        return ((row.produksi_pome_oil / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan_biogas_pks",
                    "name": "digunakan_biogas_pks",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "dikirim_kebun_u_land_aplikasi",
                    "name": "dikirim_kebun_u_land_aplikasi",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "dibuang_ke_aliran_sungai",
                    "name": "dibuang_ke_aliran_sungai",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "potensi_pome_oil",
                    "name": "potensi_pome_oil",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "name": "persen_potensi_pome_oil",
                    render: function (data, type, row) {
                        return ((row.potensi_pome_oil / row.produksi_pome_oil) / 100).toFixed(2).replace('.', ',') + '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "pome_oil_dikutip",
                    "name": "pome_oil_dikutip",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "pome_oil_terkutip_diolah_kembali",
                    "name": "pome_oil_terkutip_diolah_kembali",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "pome_oil_terkutip_dikirim_pks_lain",
                    "name": "pome_oil_terkutip_dikirim_pks_lain",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "pome_oil_terkutip_dijual",
                    "name": "pome_oil_terkutip_dijual",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },

                {
                    "data": "harga_jual_rata_rata",
                    "name": "harga_jual_rata_rata",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "name": "pendapatan",
                    "render": function (data, type, row) {
                        return (row.pome_oil_terkutip_dijual * row.harga_jual_rata_rata).toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "stok_pome_oil",
                    "name": "stok_pome_oil",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "sisa_stok_akhir",
                    "name": "sisa_stok_akhir",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                }
                ],
                "language": {
                    "paginate": {
                        "previous": "<i class='mdi mdi-chevron-left'></i>",
                        "next": "<i class='mdi mdi-chevron-right'></i>"
                    }
                },
                "drawCallback": function () {
                    $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                }
            });
        }

        if ($.fn.dataTable.isDataTable('#tablePomeBi')) {
            var table = $('#tablePomeBi').DataTable();

            table.ajax.url('/api/data-item-detail-bi/' + bulan + '/' + tahun + "/" + tipe).load();
        } else {
            $('#tablePomeBi').DataTable({
                "responsive": false,
                "scrollX": true,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail-bi/' + bulan + '/' + tahun + "/" + tipe,
                    "type": "GET",
                },
                "columns": [{
                    "data": "region",
                    "name": "region",
                    "class": "text-nowrap align-middle"
                },
                {
                    "data": "nama_unit",
                    "name": "nama_unit",
                    class: 'text-nowrap align-middle',
                    render: function (data, type, row) {
                        if (row.has_log) {
                            return `${data} <a href="#" @click="openModal('${row.kode_unit}', '${bulan}', '${tahun}')"><span class="badge badge-sm badge-warning badge-circle"> <i class="fas fa-info"></i> </span></a>`;
                        }
                        return data;
                    }
                },
                {
                    "data": "tbs_olah",
                    "name": "tbs_olah",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "produksi_pome_oil",
                    "name": "produksi_pome_oil",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    render: function (data, type, row) {
                        return ((row.produksi_pome_oil / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan_biogas_pks",
                    "name": "digunakan_biogas_pks",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "dikirim_kebun_u_land_aplikasi",
                    "name": "dikirim_kebun_u_land_aplikasi",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "dibuang_ke_aliran_sungai",
                    "name": "dibuang_ke_aliran_sungai",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "potensi_pome_oil",
                    "name": "potensi_pome_oil",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "name": "persen_potensi_pome_oil",
                    render: function (data, type, row) {
                        return ((row.potensi_pome_oil / row.produksi_pome_oil) / 100).toFixed(2).replace('.', ',') + '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "pome_oil_dikutip",
                    "name": "pome_oil_dikutip",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "pome_oil_terkutip_diolah_kembali",
                    "name": "pome_oil_terkutip_diolah_kembali",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "pome_oil_terkutip_dikirim_pks_lain",
                    "name": "pome_oil_terkutip_dikirim_pks_lain",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "pome_oil_terkutip_dijual",
                    "name": "pome_oil_terkutip_dijual",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },

                {
                    "data": "harga_jual_rata_rata",
                    "name": "harga_jual_rata_rata",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "name": "pendapatan",
                    "render": function (data, type, row) {
                        return (row.pome_oil_terkutip_dijual * row.harga_jual_rata_rata).toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "stok_pome_oil",
                    "name": "stok_pome_oil",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                }],
                "language": {
                    "paginate": {
                        "previous": "<i class='mdi mdi-chevron-left'></i>",
                        "next": "<i class='mdi mdi-chevron-right'></i>"
                    }
                },
                "drawCallback": function () {
                    $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                }
            });
        }
    } else if (tipe == 'pkm') {
        if ($.fn.dataTable.isDataTable('#tablePkm')) {
            var table = $('#tablePkm').DataTable();

            table.ajax.url('/api/data-item-detail/' + bulan + '/' + tahun + "/" + tipe).load();
        } else {
            $('#tablePkm').DataTable({
                "responsive": false,
                "scrollX": true,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail/' + bulan + '/' + tahun + "/" + tipe,
                    "type": "GET"
                },
                "columns": [{
                    "data": "region",
                    "name": "region",
                    "class": "text-nowrap align-middle"
                },
                {
                    "data": "nama_unit",
                    "name": "nama_unit",
                    class: 'text-nowrap align-middle',
                    render: function (data, type, row) {
                        if (row.has_log) {
                            return `${data} <a href="#" @click="openModal('${row.kode_unit}', '${bulan}', '${tahun}')"><span class="badge badge-sm badge-warning badge-circle"> <i class="fas fa-info"></i> </span></a>`;
                        }
                        return data;
                    }
                },
                {
                    "data": "inti_diolah",
                    "name": "inti_diolah",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "produksi_pkm",
                    "name": "produksi_pkm",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_pkm / row.inti_diolah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "dijual",
                    "name": "dijual",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "harga_jual_rata_rata",
                    "name": "harga_jual_rata_rata",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "name": "pendapatan",
                    "render": function (data, type, row) {
                        return (row.dijual * row.harga_jual_rata_rata).toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "stok_pkm",
                    "name": "stok_pkm",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "sisa_stok_akhir",
                    "name": "sisa_stok_akhir",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                }],
                "language": {
                    "paginate": {
                        "previous": "<i class='mdi mdi-chevron-left'></i>",
                        "next": "<i class='mdi mdi-chevron-right'></i>"
                    }
                },
                "drawCallback": function () {
                    $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                }
            });
        }

        if ($.fn.dataTable.isDataTable('#tablePkmBi')) {
            var table = $('#tablePkmBi').DataTable();

            table.ajax.url('/api/data-item-detail-bi/' + bulan + '/' + tahun + "/" + tipe).load();
        } else {
            $('#tablePkmBi').DataTable({
                "responsive": false,
                "scrollX": true,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail-bi/' + bulan + '/' + tahun + "/" + tipe,
                    "type": "GET"
                },
                "columns": [{
                    "data": "region",
                    "name": "region",
                    "class": "text-nowrap align-middle"
                },
                {
                    "data": "nama_unit",
                    "name": "nama_unit",
                    class: 'text-nowrap align-middle',
                    render: function (data, type, row) {
                        if (row.has_log) {
                            return `${data} <a href="#" @click="openModal('${row.kode_unit}', '${bulan}', '${tahun}')"><span class="badge badge-sm badge-warning badge-circle"> <i class="fas fa-info"></i> </span></a>`;
                        }
                        return data;
                    }
                },
                {
                    "data": "inti_diolah",
                    "name": "inti_diolah",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "produksi_pkm",
                    "name": "produksi_pkm",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_pkm / row.inti_diolah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "dijual",
                    "name": "dijual",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "harga_jual_rata_rata",
                    "name": "harga_jual_rata_rata",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "name": "pendapatan",
                    "render": function (data, type, row) {
                        return (row.dijual * row.harga_jual_rata_rata).toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "stok_pkm",
                    "name": "stok_pkm",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                }],
                "language": {
                    "paginate": {
                        "previous": "<i class='mdi mdi-chevron-left'></i>",
                        "next": "<i class='mdi mdi-chevron-right'></i>"
                    }
                },
                "drawCallback": function () {
                    $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                }
            });
        }
    } else if (tipe == 'abu_boiler') {
        if ($.fn.dataTable.isDataTable('#tableAbuBoiler')) {
            var table = $('#tableAbuBoiler').DataTable();

            table.ajax.url('/api/data-item-detail/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } else {
            $('#tableAbuBoiler').DataTable({
                "responsive": false,
                "scrollX": true,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail/' + bulan + '/' + tahun + "/" + tipe,
                    "type": "GET"
                },
                "columns": [{
                    "data": "region",
                    "name": "region",
                    "class": "text-nowrap align-middle"
                },
                {
                    "data": "nama_unit",
                    "name": "nama_unit",
                    class: 'text-nowrap align-middle',
                    render: function (data, type, row) {
                        if (row.has_log) {
                            return `${data} <a href="#" @click="openModal('${row.kode_unit}', '${bulan}', '${tahun}')"><span class="badge badge-sm badge-warning badge-circle"> <i class="fas fa-info"></i> </span></a>`;
                        }
                        return data;
                    }
                },
                {
                    "data": "tbs_olah",
                    "name": "tbs_olah",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "tankos_dibakar",
                    "name": "tankos_dibakar",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "produksi_abu_janjang",
                    "name": "produksi_abu_janjang",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (row) {
                        return ((row.tankos_dibakar / row.produksi_abu_janjang) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan_sbg_pupuk_organik",
                    "name": "digunakan_sbg_pupuk_organik",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },

                {
                    "data": null,
                    "render": function (row) {
                        return (row.produksi_abu_janjang - row.digunakan_sbg_pupuk_organik)
                            .toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "volume_keperluan_lain",
                    "name": "volume_keperluan_lain",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "keterangan_keperluan_lain",
                    "name": "keterangan_keperluan_lain",
                    "class": "align-middle",
                },
                {
                    "data": "dijual",
                    "name": "dijual",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "harga_jual_rata_rata",
                    "name": "harga_jual_rata_rata",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "name": "pendapatan",
                    "render": function (data, type, row) {
                        return (row.dijual * row.harga_jual_rata_rata).toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "stok_abu_janjang",
                    "name": "stok_abu_janjang",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "sisa_stok_akhir",
                    "name": "sisa_stok_akhir",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                }],
                "language": {
                    "paginate": {
                        "previous": "<i class='mdi mdi-chevron-left'></i>",
                        "next": "<i class='mdi mdi-chevron-right'></i>"
                    }
                },
                "drawCallback": function () {
                    $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                }
            });
        }

        if ($.fn.dataTable.isDataTable('#tableAbuBoilerBi')) {
            var table = $('#tableAbuBoilerBi').DataTable();

            table.ajax.url('/api/data-item-detail-bi/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } else {
            $('#tableAbuBoilerBi').DataTable({
                "responsive": false,
                "scrollX": true,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail-bi/' + bulan + '/' + tahun + "/" + tipe,
                    "type": "GET"
                },
                "columns": [{
                    "data": "region",
                    "name": "region",
                    "class": "text-nowrap align-middle"
                },
                {
                    "data": "nama_unit",
                    "name": "nama_unit",
                    class: 'text-nowrap align-middle',
                    render: function (data, type, row) {
                        if (row.has_log) {
                            return `${data} <a href="#" @click="openModal('${row.kode_unit}', '${bulan}', '${tahun}')"><span class="badge badge-sm badge-warning badge-circle"> <i class="fas fa-info"></i> </span></a>`;
                        }
                        return data;
                    }
                },
                {
                    "data": "tbs_olah",
                    "name": "tbs_olah",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "tankos_dibakar",
                    "name": "tankos_dibakar",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "produksi_abu_janjang",
                    "name": "produksi_abu_janjang",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (row) {
                        return ((row.tankos_dibakar / row.produksi_abu_janjang) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan_sbg_pupuk_organik",
                    "name": "digunakan_sbg_pupuk_organik",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },

                {
                    "data": null,
                    "render": function (row) {
                        return (row.produksi_abu_janjang - row.digunakan_sbg_pupuk_organik)
                            .toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "volume_keperluan_lain",
                    "name": "volume_keperluan_lain",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "keterangan_keperluan_lain",
                    "name": "keterangan_keperluan_lain",
                    "class": "align-middle",
                },
                {
                    "data": "dijual",
                    "name": "dijual",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "harga_jual_rata_rata",
                    "name": "harga_jual_rata_rata",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "name": "pendapatan",
                    "render": function (data, type, row) {
                        return (row.dijual * row.harga_jual_rata_rata).toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "stok_abu_janjang",
                    "name": "stok_abu_janjang",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "sisa_stok_akhir",
                    "name": "sisa_stok_akhir",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                }],
                "language": {
                    "paginate": {
                        "previous": "<i class='mdi mdi-chevron-left'></i>",
                        "next": "<i class='mdi mdi-chevron-right'></i>"
                    }
                },
                "drawCallback": function () {
                    $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                }
            });
        }
    }
}