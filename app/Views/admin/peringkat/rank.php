<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 mr-4">Ranking Kelas 7</h1>
    </div>

    <!-- DataTables Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable7" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Alternatif</th>
                            <th>Nilai Optimasi</th>
                            <th>Ranking</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php $key = 1; ?>

                        <?php foreach ($sorted_rank_data7 as $key => $value) :

                        ?>

                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $siswa7[$key]['nama_siswa'] ?></td>
                                <td><?php echo $value['value7']; ?></td>
                                <td><?php echo $value['rank7']; ?></td>
                            </tr>
                        <?php endforeach ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 mr-4">Ranking Kelas 8</h1>
    </div>
    <!-- DataTables Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable8" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Alternatif</th>
                            <th>Nilai Optimasi</th>
                            <th>Ranking</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php $key = 1; ?>

                        <?php foreach ($sorted_rank_data8 as $key => $value) :

                        ?>

                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $siswa8[$key]['nama_siswa'] ?></td>
                                <td><?php echo $value['value8']; ?></td>
                                <td><?php echo $value['rank8']; ?></td>
                            </tr>
                        <?php endforeach ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 mr-4">Ranking Kelas 9</h1>
    </div>

    <!-- DataTables Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable9" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Alternatif</th>
                            <th>Nilai Optimasi</th>
                            <th>Ranking</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php $key = 1; ?>

                        <?php foreach ($sorted_rank_data9 as $key => $value) :
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $siswa9[$key]['nama_siswa'] ?></td>
                                <td><?php echo $value['value9']; ?></td>
                                <td><?php echo $value['rank9']; ?></td>
                            </tr>
                        <?php endforeach ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->
<?= $this->endSection() ?>
</div>