<?= $this->extend('layouts/guru') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 mr-4">Kriteria</h1>
        <a class="btn btn-primary" href="<?php echo site_url('/addkriteria'); ?>">Tambah</a>
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