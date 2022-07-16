<?php $this->extend('template/index') ?>

<?php $this->Section('konten'); ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Kategori</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Kategori</a></li>
                    <li class="breadcrumb-item active">Daftar Kategori</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Kategori</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahkategori">
                <i class="fas fa-plus mr-2"></i>Tambah Kategori
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="flash-data" data-flash="<?= session()->getFlashdata('pesan'); ?>"></div>
        <table id="kategori" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<!-- modal tambah -->
<div class="modal fade" id="tambahkategori">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/Kategori/tambah" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <input type="text" name="nama_kategori" id="kategori" class="form-control" autocomplete="off" required>
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
<?php foreach ($kategori as $value) : ?>
    <div class="modal fade" id="editkategori<?= $value['id_kategori']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/Kategori/edit" method="post">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <input type="hidden" name="id_kategori" value="<?= $value['id_kategori']; ?>">
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <input type="text" name="nama_kategori" id="kategori" class="form-control" autocomplete="off" value="<?= $value['nama_kategori']; ?>">
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

<!-- modal edit -->
<?php foreach ($kategori as $value) : ?>
    <div class="modal fade" id="hapuskategori<?= $value['id_kategori']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/Kategori/hapus/<?= $value['id_kategori']; ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <p class="text-capitalize">Apakah Kategori <?= $value['nama_kategori']; ?> Akan Dihapus??</p>
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

<!-- jQuery -->
<script src="<?= base_url(); ?>/assets/plugins/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#kategori').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/Kategori/list_kategori',
            order: [],
            columns: [{
                    data: 'no',
                    orderable: false
                },
                {
                    data: 'nama_kategori'
                },
                {
                    data: 'aksi',
                    orderable: false
                },
            ]
        });
    });
</script>

<?= $this->endSection(); ?>