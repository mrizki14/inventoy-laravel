@extends('templates/default')


@section('content')
                    <!-- Page Heading -->
                    <div class="page-heading d-flex justify-content-between mx-4 mb-2">
                        <h1 class="h3 mb-2 text-gray-800">Kategori</h1>
                    </div>
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                    @endif

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 justify-content-between">
                            <h6 class="font-weight-bold text-primary mt-2 ml-2">Kategori Barang</h6>
                            <div class="d-flex">
                                <form action="" method="GET" class="d-none d-sm-inline-block form-inline mr-auto my-2 my-md-0 mw-100 ">
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
                                    <a class="btn btn-success" href="kategori_add">+ Tambah</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($categories as $category)    
                                        <tr>
                                            <td class="number">{{ $no++ }}.</td>
                                            <td class="text-capitalize">{{ $category->nama_kategori }}</td>
                                            <td>
                                                <div>
                                                    <a href="/edit_kategori_barang/{{ $category->id }}" class="btn btn-primary">Edit</a>
                                                    <a href="/delete_category/{{ $category->id }}" class="btn btn-danger">Hapus</a>
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