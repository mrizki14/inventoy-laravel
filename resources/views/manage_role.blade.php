@extends('templates/default')


@section('content')
                    <!-- Page Heading -->
                    <div class="page-heading d-flex justify-content-between mx-4 mb-2">
                        <h1 class="h3 mb-2 text-gray-800">Data Role</h1>
                        <a class="btn btn-success" href="{{url('role/add')}}">+ Tambah</a>
                    </div>
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                    @endif

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Role</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Role</th>
                                            <th>Aksi</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1 + (($roles->currentPage() -1 ) * $roles->perPage());
                                        @endphp
                                        @foreach ($roles as $role)    
                                        <tr>
                                            <td class="number">{{ $no++ }}.</td>
                                            <td class="text-capitalize">{{ $role->name}}</td>
                                            <td>
                                                <div>
                                                    <a href="/role/edit/{{ $role->id }}" class="btn btn-primary">Edit</a>
                                                    <a href="/role/delete/{{ $role->id }}" onclick="return confirm('Apa kamu yakin')" class="btn btn-danger">Hapus</a>
                                                </div>
                                            </td>
                                        </tr>
                     
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                                {{ $roles->links() }}
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
@endsection