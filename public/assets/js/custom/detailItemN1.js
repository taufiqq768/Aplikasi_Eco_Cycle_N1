function updateChartDataN1(bulan, tahun, tipe) {
    var chartLineColumnColors = getChartColorsArray("pattern_chart");
    var chartLineColumnColors2 = getChartColorsArray("chart_penjualan");

    requestAnimationFrame(() => {
        $.ajax({
            url: "/api/data-detail-chart-sd-n1/" + bulan + "/" + tahun + "/" + tipe,
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
            url: "/api/data-detail-chart-bi-n1/" + bulan + "/" + tahun + "/" + tipe,
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
                url: '/api/data-scatter-n1/' + bulan + '/' + tahun + '/' + tipe,
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
                url: '/api/data-scatter-bi-n1/' + bulan + '/' + tahun + '/' + tipe,
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


    if (tipe === 'tea_waste') {
        if ($.fn.dataTable.isDataTable('#tableTeawaste')) {
            // If it exists, get the DataTable instance
            var table = $('#tableTeawaste').DataTable();

            // Update the AJAX source
            
            table.ajax.url('/api/data-item-detail-n1/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } else {
            $('#tableTeawaste').DataTable({
                "responsive": false,
                "scrollX": false,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail-n1/' + bulan + '/' + tahun + "/" + tipe,
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
                    "data": "produksi_tea_waste",
                    "name": "produksi_tea_waste",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_tea_waste / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan",
                    "name": "digunakan",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return (row.produksi_tea_waste - row.digunakan)
                            .toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "dikirim",
                    "name": "dikirim",
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
                    "data": "stok_tea_waste",
                    "name": "stok_tea_waste",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "diterima",
                    "name": "diterima",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "sisa_stok_akhir",
                    "name": "sisa_stok_akhir",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },

                // {
                //     "data": "persen_ekses_mucilage",
                //     "name": "persen_ekses_mucilage",
                //     "render": function (data, type, row) {
                //         return row.persen_ekses_mucilage.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // },
                // {
                //     "data": "material_balance",
                //     "name": "material_balance",
                //     "render": function (data, type, row) {
                //         return row.material_balance.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // }
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

        if ($.fn.dataTable.isDataTable('#tableTeawasteBi')) {
            // If it exists, get the DataTable instance
            var table = $('#tableTeawasteBi').DataTable();

            // Update the AJAX source
            
            table.ajax.url('/api/data-item-detail-bi-n1/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } else {
            $('#tableTeawasteBi').DataTable({
                "responsive": true,
                "scrollX": false,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail-bi-n1/' + bulan + '/' + tahun + "/" + tipe,
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
                    "data": "produksi_tea_waste",
                    "name": "produksi_tea_waste",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_tea_waste / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan",
                    "name": "digunakan",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return (row.produksi_tea_waste - row.digunakan)
                            .toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "dikirim",
                    "name": "dikirim",
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
                    "data": "diterima",
                    "name": "diterima",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "stok_tea_waste",
                    "name": "stok_tea_waste",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                // {
                //     "data": "persen_ekses_mucilage",
                //     "name": "persen_ekses_mucilage",
                //     "render": function (data, type, row) {
                //         return row.persen_ekses_mucilage.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // },
                // {
                //     "data": "material_balance",
                //     "name": "material_balance",
                //     "render": function (data, type, row) {
                //         return row.material_balance.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // }
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
    }

    if (tipe === 'abu_he') {
        if ($.fn.dataTable.isDataTable('#tableAbuhe')) {
            // If it exists, get the DataTable instance
            var table = $('#tableAbuhe').DataTable();

            // Update the AJAX source
            
            table.ajax.url('/api/data-item-detail-n1/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } else {
            $('#tableAbuhe').DataTable({
                "responsive": false,
                "scrollX": false,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail-n1/' + bulan + '/' + tahun + "/" + tipe,
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
                    "data": "produksi_abu_he",
                    "name": "produksi_abu_he",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_abu_he / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan",
                    "name": "digunakan",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_tea_waste / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "dikirim",
                    "name": "dikirim",
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
                    "data": "stok_abu_he",
                    "name": "stok_abu_he",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "sisa_stok_akhir",
                    "name": "sisa_stok_akhir",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },

                // {
                //     "data": "persen_ekses_mucilage",
                //     "name": "persen_ekses_mucilage",
                //     "render": function (data, type, row) {
                //         return row.persen_ekses_mucilage.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // },
                // {
                //     "data": "material_balance",
                //     "name": "material_balance",
                //     "render": function (data, type, row) {
                //         return row.material_balance.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // }
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

        if ($.fn.dataTable.isDataTable('#tableAbuheBi')) {
            // If it exists, get the DataTable instance
            var table = $('#tableAbuheBi').DataTable();

            // Update the AJAX source
            
            table.ajax.url('/api/data-item-detail-bi-n1/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } else {
            $('#tableAbuheBi').DataTable({
                "responsive": true,
                "scrollX": false,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail-bi-n1/' + bulan + '/' + tahun + "/" + tipe,
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
                    "data": "produksi_abu_he",
                    "name": "produksi_abu_he",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_abu_he / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan",
                    "name": "digunakan",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return (row.produksi_abu_he - row.digunakan)
                            .toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "dikirim",
                    "name": "dikirim",
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
                    "data": "stok_abu_he",
                    "name": "stok_abu_he",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                // {
                //     "data": "persen_ekses_mucilage",
                //     "name": "persen_ekses_mucilage",
                //     "render": function (data, type, row) {
                //         return row.persen_ekses_mucilage.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // },
                // {
                //     "data": "material_balance",
                //     "name": "material_balance",
                //     "render": function (data, type, row) {
                //         return row.material_balance.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // }
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
    }


    else if (tipe === 'limbah_serum') {
        if ($.fn.dataTable.isDataTable('#tableLimbahserum')) {
            // If it exists, get the DataTable instance
            var table = $('#tableLimbahserum').DataTable();

            // Update the AJAX source
            
            table.ajax.url('/api/data-item-detail-n1/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } else {
            $('#tableLimbahserum').DataTable({
                "responsive": false,
                "scrollX": false,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail-n1/' + bulan + '/' + tahun + "/" + tipe,
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
                    "data": "produksi_limbah_serum",
                    "name": "produksi_limbah_serum",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "digunakan",
                    "name": "digunakan",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_limbah_serum / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "dikirim",
                    "name": "dikirim",
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
                    "data": "stok_limbah_serum",
                    "name": "stok_limbah_serum",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "sisa_stok_akhir",
                    "name": "sisa_stok_akhir",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },

                // {
                //     "data": "persen_ekses_mucilage",
                //     "name": "persen_ekses_mucilage",
                //     "render": function (data, type, row) {
                //         return row.persen_ekses_mucilage.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // },
                // {
                //     "data": "material_balance",
                //     "name": "material_balance",
                //     "render": function (data, type, row) {
                //         return row.material_balance.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // }
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

        if ($.fn.dataTable.isDataTable('#tableLimbahserumBi')) {
            // If it exists, get the DataTable instance
            var table = $('#tableLimbahserumBi').DataTable();

            // Update the AJAX source
            
            table.ajax.url('/api/data-item-detail-bi-n1/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } else {
            $('#tableLimbahserumBi').DataTable({
                "responsive": true,
                "scrollX": false,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail-bi-n1/' + bulan + '/' + tahun + "/" + tipe,
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
                    "data": "produksi_limbah_serum",
                    "name": "produksi_limbah_serum",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_limbah_serum / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan",
                    "name": "digunakan",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return (row.produksi_limbah_serum - row.digunakan)
                            .toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "dikirim",
                    "name": "dikirim",
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
                    "data": "stok_limbah_serum",
                    "name": "stok_limbah_serum",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                // {
                //     "data": "persen_ekses_mucilage",
                //     "name": "persen_ekses_mucilage",
                //     "render": function (data, type, row) {
                //         return row.persen_ekses_mucilage.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // },
                // {
                //     "data": "material_balance",
                //     "name": "material_balance",
                //     "render": function (data, type, row) {
                //         return row.material_balance.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // }
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
    }

    else if (tipe === 'tunggul_karet') {
        if ($.fn.dataTable.isDataTable('#tableTunggulkaret')) {
            // If it exists, get the DataTable instance
            var table = $('#tableTunggulkaret').DataTable();

            // Update the AJAX source
            
            table.ajax.url('/api/data-item-detail-n1/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } else {
            $('#tableTunggulkaret').DataTable({
                "responsive": false,
                "scrollX": false,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail-n1/' + bulan + '/' + tahun + "/" + tipe,
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
                    "data": "produksi_tunggul_karet",
                    "name": "produksi_tunggul_karet",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_tunggul_karet / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan",
                    "name": "digunakan",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_tunggul_karet / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "dikirim",
                    "name": "dikirim",
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
                    "data": "stok_tunggul_karet",
                    "name": "stok_tunggul_karet",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "sisa_stok_akhir",
                    "name": "sisa_stok_akhir",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },

                // {
                //     "data": "persen_ekses_mucilage",
                //     "name": "persen_ekses_mucilage",
                //     "render": function (data, type, row) {
                //         return row.persen_ekses_mucilage.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // },
                // {
                //     "data": "material_balance",
                //     "name": "material_balance",
                //     "render": function (data, type, row) {
                //         return row.material_balance.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // }
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

        if ($.fn.dataTable.isDataTable('#tableTunggulkaretBi')) {
            // If it exists, get the DataTable instance
            var table = $('#tableTunggulkaretBi').DataTable();

            // Update the AJAX source
            
            table.ajax.url('/api/data-item-detail-bi-n1/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } else {
            $('#tableTunggulkaretBi').DataTable({
                "responsive": true,
                "scrollX": false,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail-bi-n1/' + bulan + '/' + tahun + "/" + tipe,
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
                    "data": "produksi_tunggul_karet",
                    "name": "produksi_tunggul_karet",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_tunggul_karet / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan",
                    "name": "digunakan",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return (row.produksi_tunggul_karet - row.digunakan)
                            .toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "dikirim",
                    "name": "dikirim",
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
                    "data": "stok_tunggul_karet",
                    "name": "stok_tunggul_karet",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                // {
                //     "data": "persen_ekses_mucilage",
                //     "name": "persen_ekses_mucilage",
                //     "render": function (data, type, row) {
                //         return row.persen_ekses_mucilage.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // },
                // {
                //     "data": "material_balance",
                //     "name": "material_balance",
                //     "render": function (data, type, row) {
                //         return row.material_balance.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // }
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
    }

    else if (tipe === 'abu') {
        if ($.fn.dataTable.isDataTable('#tableAbu')) {
            // If it exists, get the DataTable instance
            var table = $('#tableAbu').DataTable();

            // Update the AJAX source
            
            table.ajax.url('/api/data-item-detail-n1/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } else {
            $('#tableAbu').DataTable({
                "responsive": false,
                "scrollX": false,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail-n1/' + bulan + '/' + tahun + "/" + tipe,
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
                    "data": "produksi_abu",
                    "name": "produksi_abu",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_abu / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan",
                    "name": "digunakan",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_abu / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "dikirim",
                    "name": "dikirim",
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
                    "data": "stok_abu",
                    "name": "stok_abu",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "sisa_stok_akhir",
                    "name": "sisa_stok_akhir",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },

                // {
                //     "data": "persen_ekses_mucilage",
                //     "name": "persen_ekses_mucilage",
                //     "render": function (data, type, row) {
                //         return row.persen_ekses_mucilage.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // },
                // {
                //     "data": "material_balance",
                //     "name": "material_balance",
                //     "render": function (data, type, row) {
                //         return row.material_balance.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // }
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

        if ($.fn.dataTable.isDataTable('#tableAbuBi')) {
            // If it exists, get the DataTable instance
            var table = $('#tableAbuBi').DataTable();

            // Update the AJAX source
            
            table.ajax.url('/api/data-item-detail-bi-n1/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } else {
            $('#tableAbuBi').DataTable({
                "responsive": true,
                "scrollX": false,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail-bi-n1/' + bulan + '/' + tahun + "/" + tipe,
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
                    "data": "produksi_abu",
                    "name": "produksi_abu",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_abu / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan",
                    "name": "digunakan",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return (row.produksi_abu - row.digunakan)
                            .toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "dikirim",
                    "name": "dikirim",
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
                    "data": "stok_abu",
                    "name": "stok_abu",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                // {
                //     "data": "persen_ekses_mucilage",
                //     "name": "persen_ekses_mucilage",
                //     "render": function (data, type, row) {
                //         return row.persen_ekses_mucilage.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // },
                // {
                //     "data": "material_balance",
                //     "name": "material_balance",
                //     "render": function (data, type, row) {
                //         return row.material_balance.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // }
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
    }

    else if (tipe === 'ranting') {
        if ($.fn.dataTable.isDataTable('#tableRanting')) {
            // If it exists, get the DataTable instance
            var table = $('#tableRanting').DataTable();

            // Update the AJAX source
            
            table.ajax.url('/api/data-item-detail-n1/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } 
        else {
            $('#tableRanting').DataTable({
                "responsive": false,
                "scrollX": false,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail-n1/' + bulan + '/' + tahun + "/" + tipe,
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
                    "data": "produksi_ranting",
                    "name": "produksi_ranting",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_ranting / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan",
                    "name": "digunakan",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_ranting / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "dikirim",
                    "name": "dikirim",
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
                    "data": "stok_ranting",
                    "name": "stok_ranting",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "sisa_stok_akhir",
                    "name": "sisa_stok_akhir",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },

                // {
                //     "data": "persen_ekses_mucilage",
                //     "name": "persen_ekses_mucilage",
                //     "render": function (data, type, row) {
                //         return row.persen_ekses_mucilage.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // },
                // {
                //     "data": "material_balance",
                //     "name": "material_balance",
                //     "render": function (data, type, row) {
                //         return row.material_balance.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // }
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

        if ($.fn.dataTable.isDataTable('#tableRantingBi')) {
            // If it exists, get the DataTable instance
            var table = $('#tableRantingBi').DataTable();

            // Update the AJAX source
            
            table.ajax.url('/api/data-item-detail-bi-n1/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } else {
            $('#tableRantingBi').DataTable({
                "responsive": true,
                "scrollX": false,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail-bi-n1/' + bulan + '/' + tahun + "/" + tipe,
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
                    "data": "produksi_ranting",
                    "name": "produksi_ranting",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_ranting / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan",
                    "name": "digunakan",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return (row.produksi_ranting - row.digunakan)
                            .toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "dikirim",
                    "name": "dikirim",
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
                    "data": "stok_ranting",
                    "name": "stok_ranting",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                // {
                //     "data": "persen_ekses_mucilage",
                //     "name": "persen_ekses_mucilage",
                //     "render": function (data, type, row) {
                //         return row.persen_ekses_mucilage.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // },
                // {
                //     "data": "material_balance",
                //     "name": "material_balance",
                //     "render": function (data, type, row) {
                //         return row.material_balance.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // }
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
    }

    else if (tipe === 'batang_kayu') {
        if ($.fn.dataTable.isDataTable('#tableBatangkayu')) {
            // If it exists, get the DataTable instance
            var table = $('#tableBatangkayu').DataTable();

            // Update the AJAX source
            
            table.ajax.url('/api/data-item-detail-n1/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } else {
            $('#tableBatangkayu').DataTable({
                "responsive": false,
                "scrollX": false,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail-n1/' + bulan + '/' + tahun + "/" + tipe,
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
                    "data": "produksi_batang_kayu",
                    "name": "produksi_batang_kayu",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_batang_kayu / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan",
                    "name": "digunakan",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_batang_kayu / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "dikirim",
                    "name": "dikirim",
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
                    "data": "stok_batang_kayu",
                    "name": "stok_batang_kayu",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "sisa_stok_akhir",
                    "name": "sisa_stok_akhir",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },

                // {
                //     "data": "persen_ekses_mucilage",
                //     "name": "persen_ekses_mucilage",
                //     "render": function (data, type, row) {
                //         return row.persen_ekses_mucilage.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // },
                // {
                //     "data": "material_balance",
                //     "name": "material_balance",
                //     "render": function (data, type, row) {
                //         return row.material_balance.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // }
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

        if ($.fn.dataTable.isDataTable('#tableBatangkayuBi')) {
            // If it exists, get the DataTable instance
            var table = $('#tableBatangkayuBi').DataTable();

            // Update the AJAX source
            
            table.ajax.url('/api/data-item-detail-bi-n1/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } else {
            $('#tableBatangkayuBi').DataTable({
                "responsive": true,
                "scrollX": false,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail-bi-n1/' + bulan + '/' + tahun + "/" + tipe,
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
                    "data": "produksi_batang_kayu",
                    "name": "produksi_batang_kayu",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_batang_kayu / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan",
                    "name": "digunakan",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return (row.produksi_batang_kayu - row.digunakan)
                            .toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "dikirim",
                    "name": "dikirim",
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
                    "data": "stok_batang_kayu",
                    "name": "stok_batang_kayu",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                // {
                //     "data": "persen_ekses_mucilage",
                //     "name": "persen_ekses_mucilage",
                //     "render": function (data, type, row) {
                //         return row.persen_ekses_mucilage.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // },
                // {
                //     "data": "material_balance",
                //     "name": "material_balance",
                //     "render": function (data, type, row) {
                //         return row.material_balance.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // }
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
    }


    else if (tipe === 'kulit_buah') {
        if ($.fn.dataTable.isDataTable('#tableKulitbuah')) {
            // If it exists, get the DataTable instance
            var table = $('#tableKulitbuah').DataTable();

            // Update the AJAX source
            
            table.ajax.url('/api/data-item-detail-n1/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } else {
            $('#tableKulitbuah').DataTable({
                "responsive": false,
                "scrollX": false,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail-n1/' + bulan + '/' + tahun + "/" + tipe,
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
                    "data": "produksi_kulit_buah",
                    "name": "produksi_kulit_buah",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_kulit_buah / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan",
                    "name": "digunakan",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_kulit_buah / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "dikirim",
                    "name": "dikirim",
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
                    "data": "stok_kulit_buah",
                    "name": "stok_kulit_buah",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "sisa_stok_akhir",
                    "name": "sisa_stok_akhir",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },

                // {
                //     "data": "persen_ekses_mucilage",
                //     "name": "persen_ekses_mucilage",
                //     "render": function (data, type, row) {
                //         return row.persen_ekses_mucilage.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // },
                // {
                //     "data": "material_balance",
                //     "name": "material_balance",
                //     "render": function (data, type, row) {
                //         return row.material_balance.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // }
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

        if ($.fn.dataTable.isDataTable('#tableKulitbuahBi')) {
            // If it exists, get the DataTable instance
            var table = $('#tableKulitbuahBi').DataTable();

            // Update the AJAX source
            
            table.ajax.url('/api/data-item-detail-bi-n1/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } else {
            $('#tableKulitbuahBi').DataTable({
                "responsive": true,
                "scrollX": false,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail-bi-n1/' + bulan + '/' + tahun + "/" + tipe,
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
                    "data": "produksi_kulit_buah",
                    "name": "produksi_kulit_buah",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_kulit_buah / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan",
                    "name": "digunakan",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return (row.produksi_kulit_buah - row.digunakan)
                            .toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "dikirim",
                    "name": "dikirim",
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
                    "data": "stok_kulit_buah",
                    "name": "stok_kulit_buah",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                // {
                //     "data": "persen_ekses_mucilage",
                //     "name": "persen_ekses_mucilage",
                //     "render": function (data, type, row) {
                //         return row.persen_ekses_mucilage.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // },
                // {
                //     "data": "material_balance",
                //     "name": "material_balance",
                //     "render": function (data, type, row) {
                //         return row.material_balance.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // }
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
    }


    else if (tipe === 'husk_skin') {
        if ($.fn.dataTable.isDataTable('#tableHuskskin')) {
            // If it exists, get the DataTable instance
            var table = $('#tableHuskskin').DataTable();

            // Update the AJAX source
            
            table.ajax.url('/api/data-item-detail-n1/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } else {
            $('#tableHuskskin').DataTable({
                "responsive": false,
                "scrollX": false,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail-n1/' + bulan + '/' + tahun + "/" + tipe,
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
                    "data": "produksi_husk_skin",
                    "name": "produksi_husk_skin",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_husk_skin / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan",
                    "name": "digunakan",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_husk_skin / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "dikirim",
                    "name": "dikirim",
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
                    "data": "stok_husk_skin",
                    "name": "stok_husk_skin",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "sisa_stok_akhir",
                    "name": "sisa_stok_akhir",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },

                // {
                //     "data": "persen_ekses_mucilage",
                //     "name": "persen_ekses_mucilage",
                //     "render": function (data, type, row) {
                //         return row.persen_ekses_mucilage.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // },
                // {
                //     "data": "material_balance",
                //     "name": "material_balance",
                //     "render": function (data, type, row) {
                //         return row.material_balance.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // }
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

        if ($.fn.dataTable.isDataTable('#tableHuskskinBi')) {
            // If it exists, get the DataTable instance
            var table = $('#tableHuskskinBi').DataTable();

            // Update the AJAX source
            
            table.ajax.url('/api/data-item-detail-bi-n1/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } else {
            $('#tableHuskskinBi').DataTable({
                "responsive": true,
                "scrollX": false,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail-bi-n1/' + bulan + '/' + tahun + "/" + tipe,
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
                    "data": "produksi_husk_skin",
                    "name": "produksi_husk_skin",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_husk_skin / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan",
                    "name": "digunakan",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return (row.produksi_husk_skin - row.digunakan)
                            .toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "dikirim",
                    "name": "dikirim",
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
                    "data": "stok_husk_skin",
                    "name": "stok_husk_skin",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                // {
                //     "data": "persen_ekses_mucilage",
                //     "name": "persen_ekses_mucilage",
                //     "render": function (data, type, row) {
                //         return row.persen_ekses_mucilage.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // },
                // {
                //     "data": "material_balance",
                //     "name": "material_balance",
                //     "render": function (data, type, row) {
                //         return row.material_balance.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // }
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
    }


    else if (tipe === 'mucilage') {
        if ($.fn.dataTable.isDataTable('#tableMucilage')) {
            // If it exists, get the DataTable instance
            var table = $('#tableMucilage').DataTable();

            // Update the AJAX source
            
            table.ajax.url('/api/data-item-detail-n1/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } 
        else {
            $('#tableMucilage').DataTable({
                "responsive": false,
                "scrollX": false,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail-n1/' + bulan + '/' + tahun + "/" + tipe,
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
                    "data": "produksi_mucilage",
                    "name": "produksi_mucilage",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_mucilage / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan",
                    "name": "digunakan",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return (row.produksi_mucilage - row.digunakan)
                            .toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "dikirim",
                    "name": "dikirim",
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
                    "data": "stok_mucilage",
                    "name": "stok_mucilage",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": "sisa_stok_akhir",
                    "name": "sisa_stok_akhir",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },

                // {
                //     "data": "persen_ekses_mucilage",
                //     "name": "persen_ekses_mucilage",
                //     "render": function (data, type, row) {
                //         return row.persen_ekses_mucilage.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // },
                // {
                //     "data": "material_balance",
                //     "name": "material_balance",
                //     "render": function (data, type, row) {
                //         return row.material_balance.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // }
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

        if ($.fn.dataTable.isDataTable('#tableMucilageBi')) {
            // If it exists, get the DataTable instance
            var table = $('#tableMucilageBi').DataTable();

            // Update the AJAX source
            
            table.ajax.url('/api/data-item-detail-bi-n1/' + bulan + '/' + tahun + "/" + tipe).load(); // .load() to refresh data
        } else {
            $('#tableMucilageBi').DataTable({
                "responsive": true,
                "scrollX": false,
                fixedColumns: {
                    leftColumns: 2
                },
                "autoWidth": false,
                "processing": false,
                deferLoading: 57,
                "serverSide": false,
                "order": [],
                "ajax": {
                    "url": '/api/data-item-detail-bi-n1/' + bulan + '/' + tahun + "/" + tipe,
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
                    "data": "produksi_mucilage",
                    "name": "produksi_mucilage",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return ((row.produksi_mucilage / row.tbs_olah) * 100).toFixed(2).replace('.', ',') +
                            '%';
                    },
                    "class": "align-middle",
                },
                {
                    "data": "digunakan",
                    "name": "digunakan",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return (row.produksi_mucilage - row.digunakan)
                            .toLocaleString();
                    },
                    "class": "align-middle",
                },
                {
                    "data": "dikirim",
                    "name": "dikirim",
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
                    "data": "stok_mucilage",
                    "name": "stok_mucilage",
                    "render": $.fn.dataTable.render.number('.', ',', 0),
                    "class": "align-middle",
                },
                // {
                //     "data": "persen_ekses_mucilage",
                //     "name": "persen_ekses_mucilage",
                //     "render": function (data, type, row) {
                //         return row.persen_ekses_mucilage.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // },
                // {
                //     "data": "material_balance",
                //     "name": "material_balance",
                //     "render": function (data, type, row) {
                //         return row.material_balance.toFixed(2).replace('.', ',') + '%';
                //     },
                //     "class": "align-middle",
                // }
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
    }


   
}

