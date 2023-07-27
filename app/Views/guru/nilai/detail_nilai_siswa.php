<?= $this->extend('layouts/guru') ?>
<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 mr-4">Nilai Siswa</h1>
        <a class="btn btn-primary" href="<?php echo site_url('addnilaisiswa/' . $siswa['id_siswa']); ?>">Tambah</a>
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
                        <?php if (isset($kriteria) && !empty($kriteria)) { ?>

                            <tr>
                                <th>Nama</th>
                                <?php $i = 1;
                                foreach ($kriteria as $krit) {
                                ?>
                                    <th><?php echo $krit['nama_kriteria'] ?></th>
                                <?php } ?>
                                <th>Action</th>
                            </tr>
                    </thead>
                    <tbody>
                        <?php
                            $x = 0;
                            foreach ($nilai_siswa as $sis) {
                                $i = 1;
                                if ($x == count($siswa)) {
                                    echo ' <tr>';
                                }  ?>

                            <?php if ($x == 0) { ?>
                                <td><?php echo $sis['nama_siswa'] ?></td> <?php } ?>
                            <?php foreach ($kriteria as $krit) {
                                    if ($sis['nilai'] == $krit['nilai']) {
                                        $x++;
                            ?>
                                    <td><?php echo $sis['nilai'] ?></td>
                            <?php  }
                                }
                                if ($x == count($siswa)) {
                                    echo '</tr>';
                                    $x = 0;
                                }
                            ?>
                        <?php $i++;
                            }  ?>
                    <?php } else { ?>

                        <tr>
                            <td align="center"><?php echo $this->lang->line('no_data_found'); ?></td>
                        </tr>
                    <?php } ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?= $this->endSection() ?>
</div>

<!-- End of Main Content -->