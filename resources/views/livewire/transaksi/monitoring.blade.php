<div>
    <div class="table-responsive">
        <table class="table table-sm table-bordered">
            <thead>
                <tr class="text-center">
                    <th>Unit</th>
                    <th>Kategori</th>
                    @foreach ($bulanList as $bulan)
                        <th>{{ $bulan }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($allUnit as $unit)
                    <tr class="text-center align-middle">
                        <td rowspan="9">{{ $unit->nama_unit }}</td>
                        <td>Produksi</td>
                        @foreach ($bulanList as $bulan)
                            <td></td>
                        @endforeach
                    </tr>
                    @foreach ($jenisList as $jenis)
                        <tr class="text-center">
                            <td>{{ $jenis->value }}</td>
                            @foreach ($bulanList as $bulan)
                                <td></td>
                            @endforeach
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
