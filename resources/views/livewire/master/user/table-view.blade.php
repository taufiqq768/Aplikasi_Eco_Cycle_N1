<div>
    <table class="table table-hover table-bordered" id="tableUser">
        <thead>
            <tr class="text-center">
                <th class="bg-light">NIK SAP</th>
                <th class="bg-light">Nama</th>
                <th class="bg-light">Role</th>
                <th class="bg-light">Unit Kerja</th>
                <th class="bg-light">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($listUser as $user)
                <tr>
                    <td class="text-center">{{ $user->nik_sap }}</td>
                    <td>{{ $user->nama }}</td>
                    <td class="text-center">{{ $user->role }}</td>
                    <td class="text-center">{{ $user->kode_unit }}</td>
                    <td></td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum Ada Data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
