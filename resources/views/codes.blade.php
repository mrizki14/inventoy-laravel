@extends('templates/default')


@section('content')
<!-- Page Heading -->
<div class="page-heading d-flex justify-content-between mx-4 mb-2">
    <h1 class="h3 mb-2 text-gray-800">Kode Barang</h1>
</div>
@if (session('success'))
<div class="alert alert-success" role="alert">{{ session('success') }}</div>
@endif

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="font-weight-bold text-primary mt-2 ml-2">Data Kode Barang</h6>
        <div class="d-flex">
            
            <div class="btn-group">
                <button class="btn btn-secondary btn-sm dropdown-toggle mr-3" type="button" data-toggle="dropdown" aria-expanded="false">
                  Kategori
                </button>
                <div class="dropdown-menu">
                    @foreach ($kategori as $item)
                        <option class="dropdown-item" name="nama_kategori" selected="{{ isset($_GET['nama_kategori']) && $_GET['nama_kategori'] == 'nama_kategori' }}" value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                        @endforeach
                </div>
              </div>

              <div>
                <a class="btn btn-success" href="kode_barang_add">+ Tambah</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode Barang</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Stock</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($data as $kode)
                    <tr>
                        <td class="number">{{ $no++ }}.</td>
                        <td class="text-uppercase">{{ $kode->kode_barang }}</td>
                        <td class="text-capitalize">{{ $kode->nama_barang }}</td>
                        <td class="text-capitalize">{{ $kode->categories->nama_kategori}}</td>
                        <td class="text-capitalize">{{ $kode->jumlah_barang }}</td>
                        <td>
                            <div>
                                <a href="/edit_kode_barang/{{ $kode->id }}" class="btn btn-primary">Edit</a>
                                <a href="/delete_kode_barang/{{ $kode->id }}" class="btn btn-danger">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->
@endsection
