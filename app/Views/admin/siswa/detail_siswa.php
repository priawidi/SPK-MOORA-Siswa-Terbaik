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
                    <h6 class="m-0 font-weight-bold text-primary">Detail Siswa</h6>
                </div>
                <div class="card-body">

                    <form>
                        <div class="form-group row">
                            <label for="nama_siswa" class="col-lg-3 col-form-label">Nama</label>
                            <div class="col-lg-9">
                                <a type="text" class="form-control" id="nama_siswa" name="nama_siswa"><?php echo $siswa['nama_siswa']; ?></a>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nis" class="col-lg-3 col-form-label">NIS</label>
                            <div class="col-lg-9">
                                <a type="text" class="form-control" id="nis" name="nis"><?php echo $siswa['nis']; ?></a>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kelas" class="col-lg-3 col-form-label">Kelas</label>
                            <div class="col-lg-9">
                                <a type="text" class="form-control" id="kelas" name="kelas"><?php echo $siswa['kelas']; ?></a>

                            </div>
                        </div>

                        <?php $i = 1;
                        foreach ($nilai_siswa as $krit) : ?>

                            <div class="form-group row">
                                <label for="nama_kriteria" class="col-lg-3 col-form-label"><?php echo $krit['nama_kriteria'] ?></label>
                                <div class="col-lg-9">
                                    <a type="text" min="0" max="100" class="form-control" name="nilai<?php echo $i; ?>"><?php echo $krit['nilai']; ?></a>

                                    <input type="hidden" name="fk_id_kriteria" value="<?php echo $krit['id_kriteria']; ?>">
                                </div>
                            </div>



                        <?php $i++;
                        endforeach; ?>
                        <div class="d-flex mt-4">
                            <a href="<?php echo site_url('datasiswa/' . $siswa['kelas']); ?>" class="btn btn-secondary ml-auto">Kembali</a>
                            <button data-toggle="modal" data-target="#deleteModal" type="button" class="btn btn-danger ml-3">
                                Hapus
                            </button>

                            <button data-toggle="modal" data-target="#editModal" type="button" class="btn btn-primary ml-3">
                                Edit Data
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
                                    <a href="<?php echo site_url() . 'deletesiswa/' . $siswa['id_siswa']; ?>" class=" btn btn-danger">Hapus</a>


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
                                    <a class="btn btn-primary" href="<?php echo site_url('editsiswa/' . $siswa['id_siswa']) ?>">Edit</a>
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