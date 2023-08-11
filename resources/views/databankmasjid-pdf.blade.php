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

<h1>Data Profil Masjid Al-Muqarabbin</h1>

<table id="customers">
  <tr>
    <th>No</th>
    <th>BANK</th>
    <th>Nomor Rekening</th>
    <th>A.N Rekening</th>
  </tr> 

  @foreach($data as $index => $item)                                    
  <tr>
    <td>{{ $index + 1 }}</td>
    <td>
        <div class="fw-bold">{{ $item->nama_bank }}</div>
    </td>
    <td>{{ $item->nomor_rekening }}</td>
    <td>{{ $item->nama_rekening }}</td>                                  
  </tr>
  @endforeach
</table>

</body>
</html>
