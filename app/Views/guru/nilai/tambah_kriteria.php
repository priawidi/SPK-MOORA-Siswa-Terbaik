<?= $this->extend('layouts/guru') ?>
<?= $this->section('content') ?>
<!-- Begin Page Content -->


<div class="container-fluid">


    <div class="row">
        <div class="col-lg-6">

            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Kriteria</h6>
                </div>
                <div class="card-body">
                    <form action="<?php echo site_url('addkriteria'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group row">
                            <label for="nama_kriteria" class="col-lg-3 col-form-label">Kriteria *</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria" autofocus><?php echo set_value('nama_kriteria'); ?>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kode_kriteria" class="col-lg-3 col-form-label">Kode Kriteria *</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="kode_kriteria" name="kode_kriteria" autofocus><?php echo set_value('kode_kriteria'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis_nilai" class="col-lg-3 col-form-label">Jenis Nilai *</label>
                            <div class="col-lg-9">
                                <select class="form-control" id="jenis_nilai" name="jenis_nilai">
                                    <option value="1">Benefit</option>
                                    <option value="0">Cost</option>
                                </select>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bobot_nilai" class="col-lg-3 col-form-label">Bobot Nilai *</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="bobot_nilai" name="bobot_nilai" value="<?php echo set_value('bobot_nilai'); ?>" placeholder="Masukkan Bilangan Bobot">

                            </div>
                        </div>

                        <small style="color: red;">*harus diisi</small>
                        <div class="d-flex mt-4">
                            <a href="<?php echo site_url('kriteria'); ?>" class="btn btn-secondary ml-auto">Kembali</a>
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