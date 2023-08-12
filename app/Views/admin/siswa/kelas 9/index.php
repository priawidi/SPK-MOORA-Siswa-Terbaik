<?php if ($role == 1) {
    $this->extend('layouts/admin');
} else if ($role == 2) {
    $this->extend('layouts/guru');
} ?>
<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 mr-4">List Siswa Kelas 9</h1>
        <!-- Show/hide Excel file upload form -->
        <script>
            function formToggle(ID) {
                var element = document.getElementById(ID);
                if (element.style.display === "none") {
                    element.style.display = "block";
                } else {
                    element.style.display = "none";
                }
            }
        </script>




        <!-- Import link -->
        <div class="col-sm">
            <div class="float-end">
                <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm1');"><i class="plus"></i> Import Data Kelas 9</a>
            </div>
        </div>
        <!-- Excel file upload form -->
        <div class="col-sm-8" id="importFrm1" style="display: none;">
            <form class="row" action="/savexls" method="post" enctype="multipart/form-data">
                <div class="col-auto">

                    <input type="file" class="form-control" name="fileexcel" id="file1" required accept=".xls, .xlsx" />
                </div>
                <div class="col-sm">
                    <input type="submit" class="btn btn-primary mb-3" name="importSubmit" value="Import">
                </div>
            </form>
        </div>

    </div>

    <?php if (session()->getFlashdata('danger_alert')) : ?>
        <div class="alert alert-dismissible alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo session()->getFlashdata('danger_alert'); ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success_alert')) : ?>
        <div class="alert alert-dismissible alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo session()->getFlashdata('success_alert'); ?>
        </div>
    <?php endif; ?>

    <!-- DataTales Example -->
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
                                <td><?php echo $sis['kode_kelas'] ?></td>
                                <td>
                                    <a class="badge badge-secondary" href="<?php echo site_url(); ?>detailsiswa/<?php echo $sis['id_siswa']; ?>">
                                        Detail
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