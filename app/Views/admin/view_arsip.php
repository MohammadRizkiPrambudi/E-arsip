<?php $this->extend('template/index') ?>

<?php $this->Section('konten'); ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Arsip</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/Arsip">Arsip</a></li>
                    <li class="breadcrumb-item active">View Arsip</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Arsip</h3>
        <div class="card-tools">
            <a href="/Arsip" class="btn btn-success btn-sm">
                <i class="fas fa-angle-left mr-1"></i>Kembali
            </a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-borderless">
                <tr>
                    <th>No Arsip</th>
                    <td>: <?= $arsip['no_arsip']; ?></td>
                    <th>Tanggal Upload</th>
                    <td>: <?= $arsip['tgl_upload']; ?></td>
                </tr>
                <tr>
                    <th>Nama Arsip</th>
                    <td>: <?= $arsip['nama_arsip']; ?></td>
                    <th>Nama User</th>
                    <td>: <?= $arsip['nama_user']; ?></td>
                </tr>
                <tr>
                    <th>Nama Departemen</th>
                    <td>: <?= $arsip['nama_dep']; ?></td>
                </tr>
                <tr>

                </tr>
            </table>
        </div>
    </div>
    <!-- /.card-body -->
</div>
<iframe src="/assets/arsip/<?= $arsip['file_arsip']; ?>" frameborder="0" width="100%" height="700">
</iframe>
<!-- /.card -->
<?= $this->endSection(); ?>