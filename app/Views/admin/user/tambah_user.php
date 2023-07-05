<!-- Begin Page Content -->
<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">


    <div class="row">
        <div class="col-lg-6">

            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah User</h6>
                </div>
                <div class="card-body">
                    <form action="<?php echo site_url('adduser'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group row">
                            <label for="username" class="col-lg-3 col-form-label">Username *</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="username" name="username" autofocus><?php echo set_value('username'); ?></input>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-lg-3 col-form-label">Password *</label>
                            <div class="col-lg-9">
                                <input type="password" class="form-control" id="password" name="password"><?php echo set_value('password'); ?></input>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-lg-3 col-form-label">Role *</label>
                            <div class="col-lg-9">
                                <select class="form-control" id="role" name="role">
                                    <option value="2">Guru</option>
                                    <option value="3">Siswa</option>
                                </select>
                            </div>
                        </div>
                        <small style="color: red;">*harus diisi</small>
                        <div class="d-flex mt-4">
                            <a href="<?php echo site_url('user'); ?>" class="btn btn-secondary ml-auto">Kembali</a>
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