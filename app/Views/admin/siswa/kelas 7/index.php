<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 mr-4">List Siswa</h1>

        <a class="btn btn-primary" href="<?php echo site_url('addsiswa/7'); ?>">Tambah</a>
    </div>

    <!-- DataTables Example -->
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
                        <?php foreach ($grade as $sis) : ?>

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

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?= $this->endSection() ?>
</div>

<!-- End of Main Content -->