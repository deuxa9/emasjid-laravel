<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #13acdf;
  color: white;
}
</style>
</head>
<body>

<h1>Data Kas Masjid Al-Muqarabbin</h1>

<table id="customers">
  <tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Di Input Oleh</th>
    <th>Kategori</th>
    <th>Keterangan</th>
    <th>Pemasukan</th>
    <th>Pengeluaran</th>
  </tr> 

  @foreach($data as $index => $item)                                    
  <tr>
    <td>{{ $index + 1 }}</td>
    <td>{{ $item->tanggal->translatedFormat('d-m-Y') }}</td>
    <td>{{ $item->createdBy->name }}</td>
    <td>{{ $item->kategori ?? 'umum' }}</td>
    <td>{{ $item->keterangan }}</td>
    <td class="text-end">
        {{ $item->jenis == 'masuk' ? formatRupiah($item->jumlah) : '-'  }}
    </td>
    <td class="text-end">
        {{ $item->jenis == 'keluar' ? formatRupiah($item->jumlah) : '-'  }}
    </td>                                    
  </tr>
  @endforeach
</table>

</body>
</html>
