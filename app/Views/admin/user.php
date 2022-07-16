<?php $this->extend('template/index'); ?>

<?php $this->section('konten'); ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>User</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">User</a></li>
                    <li class="breadcrumb-item active">Daftar User</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data User</h3>
        <div class="card-tools">
            <a href="/User/tambah" class="btn btn-primary btn-sm">
                <i class="fas fa-plus mr-2"></i>Tambah User
            </a>
        </div>
    </div>

    <!-- /.card-header -->
    <div class="card-body">
        <div class="flash-data" data-flash="<?= session()->getFlashdata('pesan'); ?>"></div>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama User</th>
                    <th>Email</th>
                    <th>Foto</th>
                    <th>Level</th>
                    <th>Departemen</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($user as $value) : ?>

                    <tr>
                        <td width="80px"><?= $no++; ?></td>
                        <td><?= $value['nama_user']; ?></td>
                        <td><?= $value['email']; ?></td>
                        <td><img src="<?= base_url('assets/dist/img/' . $value['foto_user']); ?>" alt="foto user" width="80px"></td>
                        <?php if ($value['level'] == "1") : ?>
                            <td>Admin</td>
                        <?php else : ?>
                            <td>User</td>
                        <?php endif; ?>
                        <td><?= $value['nama_dep']; ?></td>
                        <td>
                            <a href="/User/ubah/<?= $value['id_user']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-danger btn-sm" data-target="#hapususer<?= $value['id_user']; ?>" data-toggle="modal"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
<!-- modal hapus -->
<?php foreach ($user as $value) : ?>
    <div class="modal fade" id="hapususer<?= $value['id_user']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/User/hapus/<?= $value['id_user']; ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <p class="text-capitalize">Apakah User <?= $value['nama_user']; ?> Akan Dihapus??</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>
<!-- /.modal -->
<?php $this->endsection(); ?>