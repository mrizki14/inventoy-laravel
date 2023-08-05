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
    <div class="card-header py-3 justify-content-between">
        <h6 class="font-weight-bold text-primary mt-2 ml-2">Stock Barang</h6>
        <div class="d-flex">
            <form action="{{route('s')}}" method="GET" class="d-none d-sm-inline-block form-inline mr-auto my-2 my-md-0 mw-100 ">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control border-0 small mr-3" name="search" placeholder="Search for..." value="{{isset($search) ? $search : ''}}"/>
                        {{-- <select name="role[]" class="form-control mr-3">
                            <option value="">Pilih Role</option>
                            @foreach ($roles as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select> --}}
                        <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>                
            <div>
                @can('barang-create')
                    
                <a class="btn btn-success" href="kode_barang_add">+ Tambah</a>
                @endcan
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
                        {{-- @if(auth()->user()->can('barang edit') && auth()->user()->can('barang hapus')) --}}
                        <th>Aksi</th>
                        {{-- @endif --}}
                      
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($barangs as $barang)
                    <tr>
                        <td class="number">{{ $no++ }}.</td>
                        <td class="text-uppercase">{{ $barang->kode_barang }}</td>
                        <td class="text-capitalize">{{ $barang->nama_barang }}</td>
                        <td class="text-capitalize">{{ $barang->categories->nama_kategori}}</td>
                        <td class="text-capitalize">{{ $barang->jumlah_barang }}</td>
                        {{-- @if(auth()->user()->can('barang edit') || auth()->user()->can('barang hapus')) --}}
                        <td>
                            <div>
                               
                                <a href="/edit_kode_barang/{{ $barang->id }}" class="btn btn-primary">Edit</a>                                  
                                <a href="/delete_kode_barang/{{ $barang->id }}" class="btn btn-danger">Hapus</a>
                               
                        
                            
                                    
                               
                            </div>
                        </td>
                        {{-- @endif --}}
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
