function initDataTableUser() {
    // Cek apakah DataTable sudah terinisialisasi
    if ($.fn.DataTable.isDataTable('#tableUser')) {
        // Jika sudah diinisialisasi, hancurkan terlebih dahulu
        $('#tableUser').DataTable().destroy();
    }

    // Inisialisasi ulang DataTable
    $('#tableUser').DataTable({
        "language": {
            "paginate": {
                "previous": "<i class='mdi mdi-chevron-left'>",
                "next": "<i class='mdi mdi-chevron-right'>"
            }
        },
        "drawCallback": function () {
            $('.dataTables_paginate > .pagination').addClass('pagination');
        }
    });
}
