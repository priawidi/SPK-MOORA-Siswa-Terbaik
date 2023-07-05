<!-- Begin Page Content -->
<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>


<div class="container-fluid">


    <div class="row">
        <div class="col-lg-6">

            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Siswa</h6>
                </div>
                <div class="card-body">
                    <form action="<?php echo site_url('addsiswa'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group row">
                            <label for="nama_siswa" class="col-lg-3 col-form-label">Nama *</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" autofocus><?php echo set_value('nama_siswa'); ?></input>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nis" class="col-lg-3 col-form-label">NIS *</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="nis" name="nis" autofocus><?php echo set_value('nis'); ?></input>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kelas" class="col-lg-3 col-form-label">Kelas *</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="kelas" name="kelas" autofocus><?php echo set_value('kelas'); ?></input>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis_kelamin" class="col-lg-3 col-form-label">Jenis Kelamin *</label>
                            <div class="col-lg-9">
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-lg-3 col-form-label">Alamat *</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="alamat" name="alamat" autofocus><?php echo set_value('alamat'); ?></input>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_telepon" class="col-lg-3 col-form-label">No Telepon *</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="no_telepon" name="no_telepon" autofocus><?php echo set_value('no_telepon'); ?></input>

                            </div>
                        </div>


                        <small style="color: red;">*harus diisi</small>
                        <div class="d-flex mt-4">
                            <a href="<?php echo site_url('user'); ?>" class="btn btn-secondary ml-auto">Kembali</a>
                            <button type="submit" class="btn btn-primary ml-3">Tambah</button>
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