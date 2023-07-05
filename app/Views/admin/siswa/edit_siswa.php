<!-- Begin Page Content -->
<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>


<div class="container-fluid">


    <div class="row">
        <div class="col-lg-6">
            <?php $validation =  \Config\Services::validation(); ?>
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Siswa</h6>
                </div>
                <div class="card-body">
                    <form action="<?php echo site_url('editsiswa/' . $siswa['id_siswa']); ?>" method="post">
                        <div class="form-group row">
                            <label for="nama_siswa" class="col-lg-3 col-form-label">Nama *</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?php echo $siswa['nama_siswa']; ?>" autofocus>
                                <?php echo $validation->getError('nama_siswa'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nis" class="col-lg-3 col-form-label">NIS *</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="nis" name="nis" value="<?php echo $siswa['nis']; ?>" autofocus>
                                <?php echo $validation->getError('nis'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kelas" class="col-lg-3 col-form-label">Kelas *</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="kelas" name="kelas" value="<?php echo $siswa['kelas']; ?>" autofocus>
                                <?php echo $validation->getError('kelas'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis_kelamin" class="col-lg-3 col-form-label">Jenis Kelamin *</label>
                            <div class="col-lg-9">
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                    <?php if ($siswa['jenis_kelamin'] == "Laki-laki") : ?>
                                        <option value="Laki-laki" selected>Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    <?php else : ?>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan" selected>Perempuan</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-lg-3 col-form-label">Alamat *</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $siswa['alamat']; ?>" autofocus>
                                <?php echo $validation->getError('alamat'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_telepon" class="col-lg-3 col-form-label">No.Telepon *</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="<?php echo $siswa['no_telepon']; ?>" autofocus>
                                <?php echo $validation->getError('no_telepon'); ?>
                            </div>
                        </div>

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