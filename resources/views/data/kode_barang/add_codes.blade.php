@extends('templates/default')

@section('content')
<!-- Page Heading -->
<div class="page-heading d-flex justify-content-between mx-4 mb-2">
    <h1 class="h3 mb-2 text-gray-800">Kode Barang</h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Kode Barang</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form action="kode_barang" method="POST">
                @csrf
                <div class="form-group">
                    <label for="kode">Kode Barang</label>
                    <input name="kode_barang" type="text"
                        class="form-control @error('kode_barang') is-invalid @enderror" id="kode" placeholder="ABC01"
                        value="{{ old('kode_barang') }}">
                    @error('kode_barang')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nama">Nama Barang</label>
                    <input name="nama_barang" type="text"
                        class="form-control @error('nama_barang') is-invalid @enderror" id="nama" placeholder="Kursi"
                        value="{{ old('nama_barang') }}">
                    @error('nama_barang')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah Barang</label>
                    <input name="jumlah_barang" type="text"
                        class="form-control @error('jumlah_barang') is-invalid @enderror" id="jumlah" placeholder="0"
                        value="{{ old('jumlah_barang') }}">
                    @error('jumlah_barang')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="harga">Harga Barang</label>
                    <input name="harga" type="text" class="form-control" id="harga" placeholder="1000000">
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select name="id_categories" class="form-control @error('id_categories') is-invalid @enderror">
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategori as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                        @endforeach
                    </select>
                    @error('id_categories')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    
                </div>
                <div class="d-flex justify-content-between mx-2">
                    <a class="btn btn-info" href="kode_barang"> Kembali </a>
                    <button class="btn btn-success" href="kode_barang_add" type="submit">+ Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->
@endsection
