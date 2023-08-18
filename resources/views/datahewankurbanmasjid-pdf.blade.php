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

<h1>Data Kurban Masjid Al-Muqarabbin</h1>

<table id="customers">
  <tr>
    <td>Nomor</td>
    <td>Hewan</td>
    <td>Iuran</td>
    <td>Harga</td>
    <td>Biaya Operasional</td>
  </tr> 

  @foreach($data as $index => $item)                                    
  <tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $item->hewan }}</td>
    <td>{{ formatRupiah($item->iuran_perorang) }}</td>
    <td>{{ formatRupiah($item->harga) }}</td>
    <td>{{ formatRupiah($item->biaya_operasional) }}</td>                                
  </tr>
  @endforeach
</table>

</body>
</html>
