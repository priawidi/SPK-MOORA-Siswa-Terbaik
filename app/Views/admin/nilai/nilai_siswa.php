<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 mr-4">List Siswa</h1>
        <a class="btn btn-primary" href="<?php echo site_url('addnilaisiswa'); ?>">Tambah</a>
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
                            <th>Kelas</th>
                            <?php
                            foreach ($nilai_siswa as $ns) : ?>
                                <th><?php echo $ns['nama_kriteria'] ?></th>
                            <?php endforeach; ?>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        foreach ($siswa as $ns) : ?>
                            <tr>
                                <td><?php echo $ns['nama_siswa'] ?></td>
                                <td><?php echo $ns['kelas'] ?></td>
                                <?php
                                foreach ($nilai_siswa as $nsa) :
                                    if ($ns['id_siswa'] == $nsa['fk_id_siswa']) :
                                ?>
                                        <td> <?php echo $nsa['nilai'] ?></td>
                                <?php endif;
                                endforeach; ?>
                                <?php if ($ns['id_siswa'] == $nsa['fk_id_siswa']) :
                                ?>
                                    <td>
                                        <a class="badge badge-secondary" href="<?php echo site_url(); ?>detailnilaisiswa/<?php echo $nsa['fk_id_siswa'] ?>">
                                            Detail
                                        </a>
                                    </td>
                                <?php
                                endif; ?>
                            <tr>
                            <?php
                        endforeach; ?>
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