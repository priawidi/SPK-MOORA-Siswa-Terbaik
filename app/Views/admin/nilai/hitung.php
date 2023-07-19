<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Keterangan Kriteria</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-sm display" id="table1" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Kriteria</th>
                            <th>Kode Kriteria</th>
                            <th>Bobot Kriteria</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($kriteria as $krit) : ?>
                            <tr>
                                <td><?php echo $krit->nama_kriteria ?></td>
                                <td>C<?php echo $krit->id_kriteria ?></td>
                                <td><?php echo $krit->bobot_nilai ?></td>
                            <tr>
                            <?php
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Menentukan Nilai Alternatif</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-sm display" id="table1" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Alternatif</th>
                            <?php foreach ($kriteria as $val) : ?>
                                <th>C<?php echo $val->id_kriteria ?></th>
                            <?php endforeach ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($siswa as $ns) : ?>
                            <tr>
                                <td><?php echo $ns['nama_siswa'] ?></td>

                                <?php
                                foreach ($nilai_siswa as $nsa) :
                                    if ($ns['id_siswa'] == $nsa['fk_id_siswa']) : ?>
                                        <td> <?php echo $nsa['nilai'] ?></td>
                                <?php endif;
                                endforeach; ?>

                            <tr>
                            <?php
                        endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Melakukan SQRT</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-sm display" id="table2" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Kriteria</th>
                            <th>Hasil Nilai SQRT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($sqrt as $key => $value) : ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo "C" . $key; ?></td>
                                <td><?php echo $value; ?></td>

                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Melakukan Normalisasi Matriks</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-sm display" id="table2" width="100%" cellspacing="0">
                    <thead>

                        <tr>
                            <th>No</th>
                            <th>Kode Kriteria</th>
                            <?php foreach ($alternatif as $val) : ?>
                                <th><?php echo $val->nama_siswa ?></th>
                            <?php endforeach ?>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($normalisasi as $key => $value) : ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo "C" . $key; ?></td>
                                <?php foreach ($value as $k => $v) : ?>
                                    <td><?php echo $value[$k]; ?></td>
                                <?php endforeach ?>

                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Menghitung Nilai Matriks Ternormalisasi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-sm display" id="table2" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <?php foreach ($kriteria as $val) : ?>
                                <th>C<?php echo $val->id_kriteria ?></th>
                            <?php endforeach ?>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($ternormalisasi as $key => $value) :
                            $db = \Config\Database::connect();
                            $sis = $db->table('siswa')->getWhere(['id_siswa' => $key])->getResult(); ?>

                            <tr>
                                <td><?php echo $no++; ?></td>

                                <td><?php echo $sis[0]->nama_siswa ?></td>

                                <?php foreach ($value as $k => $v) : ?>
                                    <td><?php echo $value[$k]; ?></td>
                                <?php endforeach; ?>

                            </tr>

                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Melakukan Nilai Optimasi Setiap Alternatif </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-sm display" id="table3" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Alternatif</th>
                            <th>Nilai Maximum</th>
                            <th>Nilai Minimum</th>
                            <th>Nilai Yi = (Max - Min)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($tabel_yi as $key => $value) :
                            $db = \Config\Database::connect();
                            $sis = $db->table('siswa')->getWhere(['id_siswa' => $key])->getResult(); ?>

                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $sis[0]->nama_siswa ?></td>
                                <td><?php echo $max[$key]; ?></td>
                                <td><?php echo $min[$key]; ?></td>
                                <td><?php echo $value; ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Menentukan Ranking Setiap Alternatif</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-sm display" id="table4" width="100%" cellspacing="0">
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

                        <?php foreach ($sorted_rank_data as $key => $value) :

                        ?>

                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $nilai_siswa[$key]['nama_siswa'] ?></td>
                                <td><?php echo $value['value']; ?></td>
                                <td><?php echo $value['rank']; ?></td>
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