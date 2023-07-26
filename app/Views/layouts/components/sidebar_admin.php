<ul class="navbar-nav bg-gradient sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: seagreen;">

    <?php
    $session = session();

    ?>
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/<?php echo $session->get('username') ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SPK Siswa Terbaik </div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/<?php echo $session->get('username') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        User
    </div>



    <!-- Nav Item - Tables -->

    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('user') ?> ">
            <i class="fas fa-fw fa-users"></i>
            <span>Manajemen User</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Siswa
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-fw fa-cog"></i>
            <span>Data Siswa</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Siswa Kelas :</h6>
                <a class="collapse-item" href="<?php echo site_url('datasiswa/' . 7) ?>">Kelas 7</a>
                <a class="collapse-item" href="<?php echo site_url('datasiswa/' . 8) ?>">Kelas 8</a>
                <a class="collapse-item" href="<?php echo site_url('datasiswa/' . 9) ?>">Kelas 9</a>

            </div>
        </div>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('nilaisiswa') ?>">
            <i class="fas fa-fw fa-table"></i>
            <span>Nilai Siswa</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Perhitungan
    </div>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('kriteria') ?>">
            <i class="fas fa-fw fa-table"></i>
            <span>Kriteria</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Perhitungan</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Hasil Perhitungan Kelas :</h6>
                <a class="collapse-item" href="<?php echo site_url('hasilhitung/' . 7) ?>">Kelas 7</a>
                <a class="collapse-item" href="<?php echo site_url('hasilhitung/' . 8) ?>">Kelas 8</a>
                <a class="collapse-item" href="<?php echo site_url('hasilhitung/' . 9) ?>">Kelas 9</a>

            </div>
        </div>
    </li>


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-fw fa-cog"></i>
            <span>Hasil Ranking</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Hasil Ranking Kelas :</h6>
                <a class="collapse-item" href="<?php echo site_url('ranking/' . 7) ?>">Kelas 7</a>
                <a class="collapse-item" href="<?php echo site_url('ranking/' . 8) ?>">Kelas 8</a>
                <a class="collapse-item" href="<?php echo site_url('ranking/' . 9) ?>">Kelas 9</a>

            </div>
        </div>
    </li>







    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>