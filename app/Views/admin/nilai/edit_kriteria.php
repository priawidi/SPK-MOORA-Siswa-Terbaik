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
                    <h6 class="m-0 font-weight-bold text-primary">Edit Kriteria</h6>
                </div>
                <div class="card-body">
                    <form action="<?php echo site_url('editkriteria/' . $kriteria['id_kriteria']); ?>" method="post">
                        <div class="form-group row">
                            <label for="nama_kriteria" class="col-lg-3 col-form-label">Nama Kriteria*</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria" value="<?php echo $kriteria['nama_kriteria']; ?>" autofocus>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kode_kriteria" class="col-lg-3 col-form-label">Kode Kriteria *</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="kode_kriteria" name="kode_kriteria" value="<?php echo $kriteria['kode_kriteria']; ?>" autofocus>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis_nilai" class="col-lg-3 col-form-label">Jenis Nilai *</label>
                            <div class="col-lg-9">
                                <select class="form-control" id="jenis_nilai" name="jenis_nilai">
                                    <?php if ($kriteria['jenis_nilai'] == "1") : ?>

                                        <option value="1" selected>Benefit</option>
                                        <option value="0">Cost</option>
                                    <?php else : ?>
                                        <option value="1">Benefit</option>
                                        <option value="0" selected>Cost</option>
                                    <?php endif; ?>
                                </select>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bobot_nilai" class="col-lg-3 col-form-label">Bobot Nilai *</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="bobot_nilai" name="bobot_nilai" value="<?php echo $kriteria['bobot_nilai']; ?>" autofocus>

                            </div>
                        </div>


                        <small style="color: red;">*harus diisi</small>
                        <div class="d-flex mt-4">
                            <a href="<?php echo site_url(); ?>detailkriteria/<?php echo $kriteria['id_kriteria']; ?>" class="btn btn-secondary ml-auto">Kembali</a>
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