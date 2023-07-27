<!-- Begin Page Content -->
<?= $this->extend('layouts/guru') ?>

<?= $this->section('content') ?>


<div class="container-fluid">


    <div class="row">
        <div class="col-lg-6">
            <?php $validation =  \Config\Services::validation(); ?>
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Kriteria</h6>
                </div>
                <div class="card-body">
                    <img class="card-img-top" src="img.png" alt="Card image">
                    <h4 class="card-title">Nama Kriteria : <?php echo $kriteria['nama_kriteria']; ?></h4>
                    <h5 class="card-title">Kode : <?php echo $kriteria['kode_kriteria']; ?></h5>
                    <h5 class="card-title">Jenis Nilai : <?php echo $kriteria['jenis_nilai']; ?></h5>
                    <h5 class="card-title">Bobot Nilai : <?php echo $kriteria['bobot_nilai']; ?></h5>


                    <div class="d-flex mt-4">
                        <a href="<?php echo site_url('kriteria'); ?>" class="btn btn-secondary ml-auto">Kembali</a>

                        <button data-toggle="modal" data-target="#deleteModal" type="button" class="btn btn-danger ml-3">
                            Hapus
                        </button>

                        <button data-toggle="modal" data-target="#editModal" type="button" class="btn btn-primary ml-3">
                            Edit
                        </button>
                    </div>



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