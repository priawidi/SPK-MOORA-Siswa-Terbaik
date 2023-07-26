<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<?php
// Get status message 
if (!empty($_GET['status'])) {
    switch ($_GET['status']) {
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Member data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Something went wrong, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid Excel file.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}
?>


<head>
    <meta charset="utf-8">
    <title>Import Excel File Data with PHP</title>

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
</head>

<body>

    <!-- Display status message -->
    <?php if (!empty($statusMsg)) { ?>
        <div class="col-xs-12 p-3">
            <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
        </div>
    <?php } ?>

    <div class="row p-3">
        <!-- Import link -->
        <div class="col-md-12 head">
            <div class="float-end">
                <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importForm');"><i class="plus"></i> Import Data Kelas 7</a>
            </div>
        </div>

        <button type="button" class="btn btn-success btn-lg" style="display: none" id="importForm">

            <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm1');"><i class="plus"></i> Import Data Kelas 7</a>

        </button>
        <!-- Excel file upload form -->
        <div class="col-md-12" id="importFrm1" style="display: none;">

            <form class="row g-3" action="/savexls/<?php echo "7" ?>" method="post" enctype="multipart/form-data">
                <div class="col-auto">

                    <label for="fileInput" class="visually-hidden">File Excel Kelas 7A</label>
                    <input type="file" class="form-control" name="fileexcel" id="file1" required accept=".xls, .xlsx" />
                </div>
                <div class="col-auto">
                    <input type="submit" class="btn btn-primary mb-3" name="importSubmit" value="Import">
                </div>
            </form>
        </div>


    </div>


</body>


<?= $this->endSection() ?>
</div>