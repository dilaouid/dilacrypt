<?php

require ('bin/config.php');
require ('bin/process.php');

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>dilacrypt v0.1</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aldrich">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <h1>dilacrypt v0.1</h1>
    <div class="row no-gutters justify-content-center">
        <div class="col-auto col-md-7 col-lg-6 col-xl-5" id="boxform">
            <form action="" enctype="multipart/form-data" method="post">
                <div class="form-group text-center">
                    <button class="btn btn-success btn-lg" data-bs-hover-animate="pulse" id="importFileStyleBtn" type="button">Import file</button>
                    <input class="d-none" type="file" id="importFile" name="file" required>
                </div>
                <div class="form-group text-center d-none" id="filenameGrp">
                    <label><strong id="filename">Filename</strong></label>
                </div>
                <div class="form-group text-center">
                    <div class="custom-control custom-control-inline custom-radio">
                        <input class="custom-control-input" type="radio" id="formCheck-2" name="mode" value="ENCRYPT" checked>
                        <label class="custom-control-label selectRadio" for="formCheck-2">Encrypt</label>
                    </div>
                    <div class="custom-control custom-control-inline custom-radio">
                        <input class="custom-control-input" type="radio" id="formCheck-1" name="mode" value="DECRYPT">
                        <label class="custom-control-label" for="formCheck-1">Decrypt</label>
                    </div>
                </div>

                <div class="form-group">
                    <input class="form-control keyvalue" type="text" name="key" placeholder="Enter your key here" required>
                </div>
                <div class="form-group d-none" id="selectExt">
                    <select class="custom-select custom-select-sm" id="ext" name="extension">
                    <?php
                        for($i=0;$i<count(EXTENSIONS);$i++){
                            echo "<option value=".EXTENSIONS[$i].">".EXTENSIONS[$i]."</option>";
                        }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-outline-info btn-block btn-sm" type="submit" name="submit" id="process" disabled>Process</button>
                </div>
            </form>
        </div>
    </div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/bs-init.js"></script>
<script src="assets/js/script.js"></script>

</html>
