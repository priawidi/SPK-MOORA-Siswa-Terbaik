<!-- Begin Page Content -->
<?php if ($role == 1) {
    $this->extend('layouts/admin');
} else if ($role == 2) {
    $this->extend('layouts/guru');
} else if ($role == 3) {
    $this->extend('layouts/siswa');
} ?>

<?= $this->section('content') ?>


<div class="container-fluid">


    <div class="row">
        <div class="col-lg-6">

            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Siswa</h6>
                </div>
                <div class="card-body">
                    <form action="<?php echo site_url('editsiswa/' . $siswa['id_siswa']); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group row">
                            <label for="nama_siswa" class="col-lg-3 col-form-label">Nama *</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?php echo $siswa['nama_siswa']; ?>" autofocus>
                                <input type="hidden" name="id_siswa" id="id_siswa" value="<?php echo $siswa['id_siswa']; ?>">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nis" class="col-lg-3 col-form-label">NIS *</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="nis" name="nis" value="<?php echo $siswa['nis']; ?>" autofocus>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kelas" class="col-lg-3 col-form-label">Kelas *</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="kelas" name="kelas" value="<?php echo $siswa['kelas']; ?>" autofocus>

                            </div>
                        </div>

                        <?php $i = 1;

                        foreach ($nilai_siswa as $krit) :
                        ?>

                            <div class="form-group row">
                                <label for="nama_kriteria" class="col-lg-3 col-form-label"><?php echo $krit['nama_kriteria'] . "*" ?></label>
                                <div class="col-lg-9">
                                    <input type="text" min="0" max="100" class="form-control" name="nilai<?php echo $i; ?>" value="<?php echo $krit['nilai']; ?>">

                                    <input type="hidden" name="fk_id_kriteria" value="<?php echo $krit['id_kriteria']; ?>">
                                </div>
                            </div>



                        <?php $i++;
                        endforeach;
                        ?>


                        <small style="color: red;">*harus diisi</small>
                        <div class="d-flex mt-4">
                            <a href="<?php echo site_url(); ?>detailsiswa/<?php echo $siswa['id_siswa']; ?>" class="btn btn-secondary ml-auto">Kembali</a>
                            <button type="submit" class="btn btn-primary ml-3">Edit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>


</div>
<!-- /.container-fluid -->
<?= $this->endSection() ?>
</div>

<!-- End of Main Content -->