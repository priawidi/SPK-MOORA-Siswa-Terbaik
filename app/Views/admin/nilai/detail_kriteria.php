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
                    <h6 class="m-0 font-weight-bold text-primary">Detail Kriteria</h6>
                </div>
                <div class="card-body">

                    <form>
                        <div class="form-group row">
                            <label for="nama_kriteria" class="col-lg-3 col-form-label">Nama Kriteria</label>
                            <div class="col-lg-9">
                                <a type="text" class="form-control" id="nama_kriteria" name="nama_kriteria"><?php echo $kriteria['nama_kriteria']; ?></a>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kode_kriteria" class="col-lg-3 col-form-label">Kode</label>
                            <div class="col-lg-9">
                                <a type="text" class="form-control" id="kode_kriteria" name="kode_kriteria"><?php echo $kriteria['kode_kriteria']; ?></a>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis_nilai" class="col-lg-3 col-form-label">Jenis Nilai</label>
                            <div class="col-lg-9">
                                <a type="text" class="form-control" id="jenis_nilai" name="jenis_nilai"> <?php echo $kriteria['jenis_nilai']; ?></a>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bobot_nilai" class="col-lg-3 col-form-label">Bobot Nilai</label>
                            <div class="col-lg-9">
                                <a type="text" class="form-control" id="bobot_nilai" name="bobot_nilai"> <?php echo $kriteria['bobot_nilai']; ?></a>

                            </div>
                        </div>
                        <div class="d-flex mt-4">
                            <a href="<?php echo site_url('kriteria'); ?>" class="btn btn-secondary ml-auto">Kembali</a>

                            <button data-toggle="modal" data-target="#deleteModal" type="button" class="btn btn-danger ml-3">
                                Hapus
                            </button>

                            <button data-toggle="modal" data-target="#editModal" type="button" class="btn btn-primary ml-3">
                                Edit
                            </button>
                        </div>

                    </form>


                    <!-- Delete Modal-->
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">Pilih hapus untuk melanjutkan.</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <a href="<?php echo site_url() . 'deletekriteria/' . $kriteria['id_kriteria']; ?>" class=" btn btn-danger">Hapus</a>


                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Modal-->
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">Pilih edit untuk melanjutkan.</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <a class="btn btn-primary" href="<?php echo site_url('editkriteria/' . $kriteria['id_kriteria']) ?>">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>


</div>

<!-- /.container-fluid -->
<?= $this->endSection() ?>
</div>