@extends('admin.template')

@section('content')
<div class="container">
    <h2>Edit Pengguna</h2>

    <form action="{{ route('admin.pengguna.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" value="{{ old('nama', $user->nama) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="kontak" class="form-label">Kontak</label>
            <input type="text" name="kontak" id="kontak" value="{{ old('kontak', $user->kontak) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-select">
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="member" {{ $user->role == 'member' ? 'selected' : '' }}>Member</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.pengguna.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
