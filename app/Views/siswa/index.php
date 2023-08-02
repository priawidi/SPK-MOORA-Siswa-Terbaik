<?= $this->extend('layouts/siswa') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-primary text-uppercase mb-1">
                                Peringkat 1 Kelas 7
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php foreach ($sorted_rank_data7 as $key => $value) :
                                ?>
                                    <?php if ($value['rank7'] == 1) : ?>
                                        <?php echo $siswa7[$key]['nama_siswa'] ?>
                                <?php endif;
                                endforeach ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-success text-uppercase mb-1">
                                Peringkat 1 Kelas 8
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php foreach ($sorted_rank_data8 as $key => $value) :
                                ?>
                                    <?php if ($value['rank8'] == 1) : ?>
                                        <?php echo $siswa8[$key]['nama_siswa'] ?>
                                <?php endif;
                                endforeach ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-info text-uppercase mb-1">
                                Peringkat 1 Kelas 9
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        <?php foreach ($sorted_rank_data9 as $key => $value) :
                                        ?>
                                            <?php if ($value['rank9'] == 1) : ?>
                                                <?php echo $siswa9[$key]['nama_siswa'] ?>
                                        <?php endif;
                                        endforeach ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Content Row -->
</div>
<?= $this->endSection() ?>