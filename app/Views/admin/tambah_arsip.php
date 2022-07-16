<?php $this->extend('template/index'); ?>

<?= $this->section('konten'); ?>

<?php

helper('text');
$no_arsip = random_string('num', 16);


?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Tambah Arsip</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Arsip</a></li>
                    <li class="breadcrumb-item active">Tambah Arsip</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah Data Arsip</h3>
        <div class="card-tools">
            <a href="/Arsip" class="btn btn-success btn-sm">
                <i class="fas fa-angle-left mr-1"></i> Kembali
            </a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form method="post" action="/Arsip/simpan" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="form-group row">
                <label for="no_arsip" class="col-sm-2 col-form-label">No Arsip</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validasi->hasError('no_arsip')) ? 'is-invalid' : ''; ?>" id="no_arsip" name="no_arsip" value="<?= old('no_arsip', $no_arsip); ?>" placeholder="No arsip" readonly>
                    <div class="invalid-feedback">
                        <?= $validasi->getError('no_arsip'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="nama_arsip" class="col-sm-2 col-form-label">Nama Arsip</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validasi->hasError('nama_arsip')) ? 'is-invalid' : ''; ?>" id="nama_arsip" name="nama_arsip" value="<?= old('nama_arsip'); ?>" placeholder="Nama arsip" autocomplete="off">
                    <div class="invalid-feedback">
                        <?= $validasi->getError('nama_arsip'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="id_kategori" class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-10">
                    <select name="id_kategori" id="id_kategori" class="custom-select <?= ($validasi->hasError('id_kategori')) ? 'is-invalid' : ''; ?>">
                        <option selected disabled>--Silahkan Pilih---</option>
                        <?php foreach ($kategori as $value) : ?>
                            <option value="<?= $value['id_kategori']; ?>"><?= $value['nama_kategori']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class=" invalid-feedback">
                        <?= $validasi->getError('id_kategori'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-10">
                    <textarea class="form-control <?= ($validasi->hasError('deskripsi')) ? 'is-invalid' : ''; ?>" id="deskripsi" name="deskripsi" placeholder="Deskripsi"><?= old('deskripsi'); ?></textarea>
                    <div class="invalid-feedback">
                        <?= $validasi->getError('deskripsi'); ?>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="file_arsip" class="col-sm-2 col-form-label">File Arsip</label>
                <div class="col-sm-10">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input <?= ($validasi->hasError('file_arsip')) ? 'is-invalid' : ''; ?>" id="file_arsip" name="file_arsip" onchange="previewLabel()">
                        <div class="invalid-feedback">
                            <?= $validasi->getError('file_arsip'); ?>
                        </div>
                        <label class="custom-file-label" for="file_arsip">Pilih File .PDF</label>
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