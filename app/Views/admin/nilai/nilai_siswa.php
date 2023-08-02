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
        <h1 class="h3 mb-0 text-gray-800 mr-4">Nilai Siswa</h1>

    </div>
    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <?php
                            foreach ($kriteria as $krit) : ?>
                                <th><?php echo $krit['nama_kriteria'] ?></th>
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
                                    if ($ns['id_siswa'] == $nsa['fk_id_siswa']) : ?>
                                        <td> <?php echo $nsa['nilai'] ?></td>
                                <?php endif;
                                endforeach; ?>
                                <td>
                                    <a class="badge badge-secondary" href="<?php echo site_url('detailsiswa/' . $ns['id_siswa']); ?>">
                                        Detail
                                    </a>
                                </td>
                            </tr>
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