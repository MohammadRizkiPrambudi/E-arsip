<?php $this->extend('template/index'); ?>

<?= $this->section('konten'); ?>


<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Tambah User</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">User</a></li>
                    <li class="breadcrumb-item active">Tambah User</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah Data User</h3>
        <div class="card-tools">
            <a href="/User" class="btn btn-success btn-sm">
                <i class="fas fa-angle-left mr-1"></i> Kembali
            </a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form method="post" action="/User/simpan" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="form-group row">
                <label for="nama_user" class="col-sm-2 col-form-label">Nama User</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validasi->hasError('nama_user')) ? 'is-invalid' : ''; ?>" id="nama_user" name="nama_user" value="<?= old('nama_user'); ?>" placeholder="Nama User">
                    <div class="invalid-feedback">
                        <?= $validasi->getError('nama_user') ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validasi->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= old('email'); ?>" placeholder="Email">
                    <div class="invalid-feedback">
                        <?= $validasi->getError('email') ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control <?= ($validasi->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" value="<?= old('password'); ?>" placeholder="Password">
                    <div class="invalid-feedback">
                        <?= $validasi->getError('password') ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="level" class="col-sm-2 col-form-label">Level</label>
                <div class="col-sm-10">
                    <select name="level" id="level" class="custom-select <?= ($validasi->hasError('level')) ? 'is-invalid' : ''; ?>">
                        <option selected disabled>--Silahkan Pilih---</option>
                        <option value="1">Admin</option>
                        <option value="2">User</option>
                    </select>
                    <div class=" invalid-feedback">
                        <?= $validasi->getError('level'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="foto_user" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                    <img src="/assets/dist/img/default.png" class="sampul img-preview mb-2">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input <?= ($validasi->hasError('foto_user')) ? 'is-invalid' : ''; ?>" id="foto_user" name="foto_user" onchange="previewGambar()">
                        <div class="invalid-feedback">
                            <?= $validasi->getError('foto_user'); ?>
                        </div>
                        <label class="custom-file-label" for="foto_user">Pilih Gambar</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="departemen" class="col-sm-2 col-form-label">Departemen</label>
                <div class="col-sm-10">
                    <select class="custom-select <?= ($validasi->hasError('id_dep')) ? 'is-invalid' : ''; ?>" name="id_dep" id="id_dep">
                        <option selected disabled>--Silahkan Pilih---</option>
                        <?php foreach ($departemen as $value) : ?>
                            <option value=" <?= $value['id_dep']; ?>"><?= $value['nama_dep']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validasi->getError('id_dep'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-form-label col-sm-2 ml-2"></label>
                <button type="submit" class="btn btn-info mr-2 btn-sm">Simpan</button>
                <button type="reset" class="btn btn-danger btn-sm">Hapus</button>
            </div>
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<?= $this->endsection(); ?>