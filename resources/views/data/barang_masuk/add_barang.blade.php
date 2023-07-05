@extends('templates/default')

@section('content')
<!-- Page Heading -->
<div class="page-heading d-flex justify-content-between mx-4 mb-2">
    <h1 class="h3 mb-2 text-gray-800">Tambah Barang Masuk</h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Barang</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form action="{{route('add_barang')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="codes">Kode Barang</label>
                    <select name="codes_id" class="form-control  @error('codes_id') is-invalid @enderror">
                        <option value="">Pilih Code Barang</option>
                        @foreach ($codes as $item)
                        <option value="{{ $item->id }}">{{ $item->kode_barang }}</option>
                        @endforeach
                    </select>
                    @error('codes_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tanggal masuk">Tanggal Masuk</label>
                    <input name="tgl_masuk" type="date"
                        class="form-control @error('tgl_masuk') is-invalid @enderror" 
                        value="{{ old('tgl_masuk') }}">
                    @error('tgl_masuk')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jumlah barang">Jumlah Barang</label>
                    <input name="qty" type="text"
                        class="form-control @error('qty') is-invalid @enderror" 
                        value="{{ old('qty') }}">
                    @error('qty')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between mx-2">
                    <a class="btn btn-info" href="barang_masuk"> Kembali </a>
                    <button class="btn btn-success" type="submit">+ Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->
@endsection
