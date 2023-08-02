<?php if ($role == 1) {
    $this->extend('layouts/admin');
} else if ($role == 2) {
    $this->extend('layouts/guru');
} else if ($role == 3) {
    $this->extend('layouts/siswa');
} ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 mr-4">Kriteria</h1>
        <a class="btn btn-primary" href="<?php echo site_url('/addkriteria'); ?>">Tambah</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Kriteria</th>
                            <th>Kode </th>
                            <th>Jenis Nilai</th>
                            <th>Bobot</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($kriteria as $val) : ?>

                            <tr>
                                <td><?php echo $val['nama_kriteria'] ?></td>
                                <td><?php echo $val['kode_kriteria'] ?></td>
                                <td><?php echo $val['jenis_nilai'] ?></td>
                                <td><?php echo $val['bobot_nilai'] ?></td>
                                <td>

                                    <a class="badge badge-secondary" href="<?php echo site_url(); ?>detailkriteria/<?php echo $val['id_kriteria']; ?>">
                                        Detail
                                    </a>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>
</div>