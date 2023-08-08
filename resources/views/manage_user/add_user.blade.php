@extends('templates/default')

@section('content')
<!-- Page Heading -->
<div class="page-heading d-flex justify-content-between mx-4 mb-2">
    <h1 class="h3 mb-2 text-gray-800">Management User</h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah User</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form action="{{route('user.add')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input name="name" type="text"
                        class="form-control @error('name') is-invalid @enderror" 
                        value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="text"
                        class="form-control @error('email') is-invalid @enderror" 
                        value="{{ old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="roles[]" class="form-control @error('roles') is-invalid @enderror" multiple>
                        <option value="">Pilih Role</option>
                        @foreach ($roles as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('roles')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror" 
                        value="{{ old('password') }}">
                    @error('password')
                    <div class="invalid-feedback">{{ $messages }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between mx-2">
                    <a class="btn btn-info" href="manage_user"> Kembali </a>
                    <button class="btn btn-success" type="submit">+ Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->
@endsection
