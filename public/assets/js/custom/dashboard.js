var chartLineColumnColors = getChartColorsArray("line_column_chart");
if (chartLineColumnColors) {
    var options = {
        series: [{
            name: 'Stok',
            type: 'column',
            data: [440, 505, 414, 671, 227, 413, 201, 352, 752, 320, 257, 160]
        }, {
            name: 'Penjualan',
            type: 'line',
            data: [230, 420, 350, 270, 430, 220, 170, 310, 220, 220, 120, 16]
        }],
        chart: {
            height: 350,
            type: 'line',
            toolbar: {
                show: false,
            }
        },
        stroke: {
            width: [0, 4]
        },
        title: {
            text: 'Data Penjualan & Stok',
            style: {
                fontWeight: 500,
            },
        },
        dataLabels: {
            enabled: true,
            enabledOnSeries: [1]
        },
        labels: ['01 Jan 2001', '02 Jan 2001', '03 Jan 2001', '04 Jan 2001', '05 Jan 2001', '06 Jan 2001',
            '07 Jan 2001', '08 Jan 2001', '09 Jan 2001', '10 Jan 2001', '11 Jan 2001', '12 Jan 2001'
        ],
        xaxis: {
            type: 'datetime'
        },
        yaxis: [{
            title: {
                text: 'Stok',
                style: {
                    fontWeight: 500,
                },
            },

        }, {
            opposite: true,
            title: {
                text: 'Penjualan',
                style: {
                    fontWeight: 500,
                },
            }
        }],
        colors: chartLineColumnColors
    };

    var chart = new ApexCharts(document.querySelector("#line_column_chart"), options);
    chart.render();
}