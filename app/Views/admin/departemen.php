<?php $this->extend('template/index'); ?>

<?php $this->section('konten'); ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Departemen</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Departemen</a></li>
                    <li class="breadcrumb-item active">Daftar Departemen</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Departemen</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahdep">
                <i class="fas fa-plus mr-2"></i>Tambah Departemen
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="flash-data" data-flash="<?= session()->getFlashdata('pesan'); ?>"></div>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Departemen</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($departemen as $value) : ?>
                    <tr>
                        <td width="80px"><?= $no++; ?></td>
                        <td><?= $value['nama_dep']; ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm " data-target="#editdep<?= $value['id_dep']; ?>" data-toggle="modal"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm " data-target="#hapusdep<?= $value['id_dep']; ?>" data-toggle="modal"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<!-- modal tambah -->
<div class="modal fade" id="tambahdep">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Departemen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/Departemen/tambah" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="departemen">Departemen</label>
                        <input type="text" name="nama_departemen" id="departemen" class="form-control" autocomplete="off" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- modal edit -->
<?php foreach ($departemen as $value) : ?>
    <div class="modal fade" id="editdep<?= $value['id_dep']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Departemen</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/Departemen/edit" method="post">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <input type="hidden" name="id_dep" id="id_dep" value="<?= $value['id_dep']; ?>">
                        <div class="form-group">
                            <label for="departemen">Departemen</label>
                            <input type="text" name="nama_departemen" id="departemen" class="form-control" autocomplete="off" required value="<?= $value['nama_dep']; ?>">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>
<!-- /.modal -->

<!-- modal hapus -->
<?php foreach ($departemen as $value) : ?>
    <div class="modal fade" id="hapusdep<?= $value['id_dep']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Departemen</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/Departemen/hapus" method="post">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <input type="hidden" name="id_dep" id="id_dep" value="<?= $value['id_dep']; ?>">
                        <p>Apakah Data <?= $value['nama_dep']; ?> Akan Dihapus</p>
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