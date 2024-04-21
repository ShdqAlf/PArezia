@extends('components.home', ['title' => 'Dashboard Admin'])

@section('content')
    <div class="page-title">
        <h3>Kelola User</h3>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="col-auto" style="margin-bottom:30px;">
                            <button class=" btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahPengguna">Tambah
                                Pengguna</button>
                        </div>
                        <div class="modal fade" id="tambahPengguna" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Pengguna</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.kelolauser.tambah-pengguna') }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row mb-3">
                                                <label for="inputEmail3" class="col-sm-4 col-form-label">Email</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" name="email"
                                                        placeholder="Masukkan Email">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputPassword3" class="col-sm-4 col-form-label">Password</label>
                                                <div class="col-sm-7">
                                                    <input type="password" name="password" class="form-control"
                                                        placeholder="Masukkan Password" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputPassword3" class="col-sm-4 col-form-label">Ulangi
                                                    Password</label>
                                                <div class="col-sm-7">
                                                    <input type="password" name="ulangi_password" class="form-control"
                                                        placeholder="Ulangi Password" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-4 col-form-label">Role</label>
                                                <div class="col-sm-7">
                                                    <select class="form-select" aria-label="Default select example"
                                                        name="role">
                                                        <option selected>Pilih Role</option>
                                                        <option value="Admin">Admin</option>
                                                        <option value="Staff">Staff</option>
                                                        <option value="Pimpinan">Pimpinan</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-success">Tambahkan Pengguna</button>
                                        </div>
                                    </form><!-- End Horizontal Form -->
                                </div>
                            </div>
                        </div><!-- End Basic Modal-->
                        <div class="table-responsive">
                            <table id="kelolauser" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $user)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>
                                                <button class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $user->id }}">Edit</button>
                                                <form action="{{ route('admin.kelolauser.hapus-pengguna', $user) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @foreach ($users as $user)
        <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Pengguna</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.kelolauser.edit', $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $user->email }}">
                            </div>
                            <div class="mb-3">
                                <label for="pasword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" id="role" name="role">
                                    <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="Staff" {{ $user->role == 'Staff' ? 'selected' : '' }}>Staff</option>
                                    <option value="Pimpinan" {{ $user->role == 'Pimpinan' ? 'selected' : '' }}>Pimpinan
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#kelolauser');
    </script>
@endsection
