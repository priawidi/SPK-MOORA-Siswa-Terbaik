<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>


<?php if ($role['role'] == 1) : ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800 mr-4">List User</h1>
            <a class="btn btn-primary" href="<?php echo site_url('adduser') ?>">Tambah</a>
        </div>

        <?php if (session()->getFlashdata('danger_alert')) : ?>
            <div class=" alert alert-dismissible alert-danger" role="alert">
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

        <!-- DataTables Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td><?php echo $user['username'] ?></td>
                                    <td><?php echo $user['role'] ?></td>
                                    <td>
                                        <a class="badge badge-secondary" href="<?php echo site_url(); ?>detailuser/<?php echo $user['id']; ?>">
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
<?php endif; ?>
<?= $this->endSection() ?>
</div>

<!-- End of Main Content -->