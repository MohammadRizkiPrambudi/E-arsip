<?php $this->extend('template/index') ?>

<?php $this->Section('konten'); ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Dashboard</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Home</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $kategori; ?></h3>
                <p>Kategori</p>
            </div>
            <div class="icon">
                <i class="fas fa-tag"></i>
            </div>
            <a href="/Kategori" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $dep; ?></h3>
                <p>Departemen</p>
            </div>
            <div class="icon">
                <i class="fas fa-hospital"></i>
            </div>
            <a href="/Departemen" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $user; ?></h3>
                <p>User</p>
            </div>
            <div class="icon">
                <i class="fas fa-user"></i>
            </div>
            <a href="/User" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= $arsip; ?></h3>
                <p>Arsip</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-arsip"></i>
            </div>
            <a href="/Arsip" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>