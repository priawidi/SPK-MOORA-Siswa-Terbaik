<?php if ($role == 1) {
    $this->extend('layouts/admin');
} else if ($role == 2) {
    $this->extend('layouts/guru');
} else if ($role == 3) {
    $this->extend('layouts/siswa');
} ?>
<?= $this->section('content') ?>

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



<div class="row p-3">
    <!-- Import link -->
    <div class="col-md-12 head">
        <div class="float-end">
            <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm1');"><i class="plus"></i> Import Data Kelas 7</a>
        </div>
    </div>
    <!-- Excel file upload form -->
    <div class="col-md-12" id="importFrm1" style="display: none;">
        <form class="row g-3" action="/savexls/<?php echo 7 ?>" method="post" enctype="multipart/form-data">
            <div class="col-auto">

                <label for="fileInput" class="visually-hidden">File Excel Kelas 7</label>
                <input type="file" class="form-control" name="fileexcel" id="file1" required accept=".xls, .xlsx" />
            </div>
            <div class="col-auto">
                <input type="submit" class="btn btn-primary mb-3" name="importSubmit" value="Import">
            </div>
        </form>
    </div>
</div>



<?= $this->endSection() ?>
</div>