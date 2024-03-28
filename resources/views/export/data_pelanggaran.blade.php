<table>
    <thead>
        <tr>

            <th
                style="font-family: calibri; font-size: 16px; text-align: center; border: 1px solid black; background-color: yellow;">
                No</th>
            <th
                style="font-family: calibri; font-size: 16px; text-align: center; border: 1px solid black; background-color: yellow;">
                Nama</th>
            <th
                style="font-family: calibri; font-size: 16px; text-align: center; border: 1px solid black; background-color: yellow;">
                Kelas</th>
            <th
                style="font-family: calibri; font-size: 16px; text-align: center; border: 1px solid black; background-color: yellow;">
                Pelanggaran</th>
            <th
                style="font-family: calibri; font-size: 16px; text-align: center; border: 1px solid black; background-color: yellow;">
                Keterangan</th>
            <th
                style="font-family: calibri; font-size: 16px; text-align: center; border: 1px solid black; background-color: yellow;">
                Poin</th>
            <th
                style="font-family: calibri; font-size: 16px; text-align: center; border: 1px solid black; background-color: yellow;">
                Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1 @endphp
        @foreach ($filteredSiswa as $item)
            <tr>
                <td style="border: 1px solid black;">{{ $no++ }}</td>
                <td style="border: 1px solid black;">{{ $item->siswa->nama }}</td>
                <td style="border: 1px solid black;">{{ $item->kelas->nama_kelas }}</td>
                <td style="border: 1px solid black;">{{ $item->pelanggaran->nama_pelanggaran }}</td>
                <td style="border: 1px solid black;">{{ $item->keterangan }}</td>
                <td style="border: 1px solid black;">{{ $item->pelanggaran->poin }}</td>
                <td style="border: 1px solid black;">{{ $item->tanggal }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
