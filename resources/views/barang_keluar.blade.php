@extends('templates/default')


@section('content')
                    <!-- Page Heading -->
                    <div class="page-heading d-flex justify-content-between mx-4 mb-2">
                        <h1 class="h3 mb-2 text-gray-800">Barang Keluar</h1>
                        <a class="btn btn-success" href="tambah_barang_keluar">+ Tambah</a>
                    </div>
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                    @endif

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Barang Keluar</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode Barang</th>
                                            <th>Kategori Barang</th>
                                            <th>Nama barang</th>
                                            <th>Tanggal keluar</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($barang as $row)    
                                        <tr>
                                            <td class="number">{{ $no++ }}.</td>
                                            <td class="text-capitalize">{{ $row->codes->kode_barang??null}}</td>
                                            <td class="text-capitalize">{{ $row->codes->categories->nama_kategori??null}}</td>
                                            <td class="text-capitalize">{{ $row->codes->nama_barang??null}}</td>
                                            <td class="text-capitalize">{{ $row->tgl_keluar }}</td>
                                            {{-- <td class="text-capitalize">{{ $row->codes_id }}</td> --}}
                                            <td class="text-capitalize">{{ $row->qty }}</td>
                                            {{-- <td class="text-capitalize">{{ $barang->qty }}</td> --}}
                                            <td>
                                                <div>
                                                    <a href="/edit_barang_keluar/{{ $row->id }}" class="btn btn-primary">Edit</a>
                                                    <a href="/delete_barang_keluar/{{ $row->id }}" class="btn btn-danger">Hapus</a>
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