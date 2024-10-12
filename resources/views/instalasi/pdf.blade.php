<div>
    <style>
       table, th, td {
       border: 1px solid black;
       border-collapse: collapse;
       }

    </style>
    <h3 style="text-align: center">Laporan Instalasi dari {{ $start_date }} sampai {{ $end_date }}</h3>


    <table style="width: 100%">
        <tr>
            <th>No</th>
            <th>No Instalasi</th>
            <th>Nama Paket</th>
            <th>Nomor Internet</th>
            <th>Harga</th>
            <th>Layanan</th>
            <th>Status</th>
        </tr>
        @foreach ($instalasi as $key=>$row)

        <tr>
            <td>{{ ++$key }}</td>
            <td>{{ $row->kode_instalasi }}</td>
            <td>{{ $row->nama_paket }}</td>
            <td>{{ $row->nomor_internet }}</td>
            <td>{{ $row->harga_paket }}</td>
            <td>{{ $row->layanan }}</td>
            <td>{{ $row->status }}</td>
        </tr>
        @endforeach
    </table>

    <html-separator />


    <html-separator />
</div>
