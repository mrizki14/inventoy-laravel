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
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h6 class="font-weight-bold text-primary mt-2 ml-2">Data Kategori Barang</h6>
                            <div>
                                <a class="btn btn-success" href="kategori_add">+ Tambah</a>
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
                                        @foreach ($data as $row)    
                                        <tr>
                                            <td class="number">{{ $no++ }}.</td>
                                            <td class="text-capitalize">{{ $row->nama_kategori }}</td>
                                            <td>
                                                <div>
                                                    <a href="/edit_kategori_barang/{{ $row->id }}" class="btn btn-primary">Edit</a>
                                                    <a href="/delete_category/{{ $row->id }}" class="btn btn-danger">Hapus</a>
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