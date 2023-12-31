<?php if ($role == 1) {
    $this->extend('layouts/admin');
} else if ($role == 2) {
    $this->extend('layouts/guru');
} else if ($role == 3) {
    $this->extend('layouts/siswa');
} ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 mr-4">List Siswa</h1>
        <a class="btn btn-primary" href="<?php echo site_url('addsiswa'); ?>">Tambah</a>
    </div>

    <?php if (session()->getFlashdata('danger_alert')) : ?>
        <div class="alert alert-dismissible alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo session()->getFlashdata('danger_alert'); ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success_alert')) : ?>
        <div class="alert alert-dismissible alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo session()->getFlashdata('success_alert'); ?>
        </div>
    <?php endif; ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>Kelas</th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($siswa as $sis) : ?>

                            <tr>
                                <td><?php echo $sis['nama_siswa'] ?></td>
                                <td><?php echo $sis['nis'] ?></td>
                                <td><?php echo $sis['kelas'] ?></td>
                                <td>
                                    <a class="badge badge-secondary" href="<?php echo site_url(); ?>detailsiswa/<?php echo $sis['id_siswa']; ?>">
                                        Detail
                                    </a>
                                    <a class="badge badge-secondary" href="<?php echo site_url('editnilaisiswa/' . $sis['id_siswa']); ?>">
                                        Nilai
                                    </a>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $pager->links('siswa', 'bootstrap_pagination'); ?>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?= $this->endSection() ?>
</div>

<!-- End of Main Content -->