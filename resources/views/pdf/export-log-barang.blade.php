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
  background-color: #4e73df;
  color: white;
}
</style>
</head>
<body>

<h3 style="text-align: center">Log Data Barang</h3>

<table id="customers">
  <tr>
    <th>No.</th>
    <th>Kode Barang</th>
    <th>Nama Barang</th>
    <th>Stok</th>
    <th>Barang Masuk</th>
    <th>Tanggal Masuk</th>
    <th>Barang Keluar</th>
    <th>Tanggal Keluar</th>
    <th>Stok Akhir</th>
  </tr>
  @php
  $no = 1;
@endphp
@foreach ($barangs as $barang)    
<tr>
  <td class="number">{{ $no++ }}.</td>
  <td class="text-capitalize">{{ $barang->kode_barang}}</td>
  <td class="text-capitalize">{{ $barang->nama_barang }}</td>
  <td class="text-capitalize">{{ $barang->jumlah_barang }}</td>
  <td class="text-capitalize">{{$barang->barangMasuks->implode('qty')}}</td>
  <td class="text-capitalize">{{ $barang->barangMasuks->implode('tgl_masuk')}}</td>
  <td class="text-capitalize">{{$barang->barangKeluars->implode('qty')}}</td>
  <td class="text-capitalize">{{ $barang->barangKeluars->implode('tgl_keluar') }}</td>
  <td class="text-capitalize">{{ $barang->jumlah_barang }}</td>
</tr>
@endforeach
</table>

</body>
</html>


