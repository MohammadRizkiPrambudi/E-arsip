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
                    <li class="breadcrumb-item active">Daftar Arsip</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Arsip</h3>
        <div class="card-tools">
            <a href="/Arsip/tambah" class="btn btn-primary btn-sm">
                <i class="fas fa-plus mr-2"></i>Tambah Arsip
            </a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="flash-data" data-flash="<?= session()->getFlashdata('pesan'); ?>"></div>
        <div class="table-responsive">
            <table id="arsip" class="table table-bordered table-striped" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>No Arsip</th>
                        <th>Nama Arsip</th>
                        <th>Deskripsi</th>
                        <th>File Arsip</th>
                        <th>Tanggal Upload</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->



<!-- modal hapus-->
<?php foreach ($arsip as $value) : ?>
    <div class="modal fade" id="hapusarsip<?= $value['id_arsip']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Arsip</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/Arsip/hapus/<?= $value['id_arsip']; ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <p class="text-capitalize">Apakah Arsip <?= $value['nama_arsip']; ?> Akan Dihapus??</p>
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

<script src="<?= base_url(); ?>/assets/plugins/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#arsip').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/Arsip/list_arsip',
            order: [],
            columns: [{
                    data: 'no',
                    orderable: false
                },
                {
                    data: 'nama_kategori'
                },
                {
                    data: 'no_arsip'
                },
                {
                    data: 'nama_arsip'
                },
                {
                    data: 'deskripsi'
                },
                {
                    data: 'view',
                    orderable: false
                },
                {
                    data: 'tgl_upload'

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