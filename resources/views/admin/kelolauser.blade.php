@extends('components.home', ['title'=>'Dashboard Admin'])

@section('content')
<div class="page-title">
    <h3>Kelola User</h3>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-auto" style="margin-bottom:30px;">
                        <button class=" btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahPengguna">Tambah Pengguna</button>
                    </div>
                    <div class="modal fade" id="tambahPengguna" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Pengguna</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('kelolauser.tambah-pengguna') }}" method="post">
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Email</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" name="email" placeholder="Masukkan Email">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputPassword3" class="col-sm-4 col-form-label">Password</label>
                                            <div class="col-sm-7">
                                                <input type="password" name="password" class="form-control" placeholder="Masukkan Password" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputPassword3" class="col-sm-4 col-form-label">Ulangi Password</label>
                                            <div class="col-sm-7">
                                                <input type="password" name="ulangi_password" class="form-control" placeholder="Ulangi Password" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-4 col-form-label">Role</label>
                                            <div class="col-sm-7">
                                                <select class="form-select" aria-label="Default select example" name="role">
                                                    <option selected>Pilih Role</option>
                                                    <option value="Admin">Admin</option>
                                                    <option value="Staff">Staff</option>
                                                    <option value="Pimpinan">Pimpinan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-success">Tambahkan Pengguna</button>
                                    </div>
                                </form><!-- End Horizontal Form -->
                            </div>
                        </div>
                    </div><!-- End Basic Modal-->
                    <div class="table-responsive">
                        <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>admin@gmail.com</td>
                                    <td>Admin</td>
                                    <td>
                                        <button class="btn btn-warning">Edit</button>
                                        <button class="btn btn-danger">Hapus</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection