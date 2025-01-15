<?php
include_once("controller/Import/cImport.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['file'])) {
        $cImport = new cImport();
        $importResult = $cImport->ImportController($_FILES['file']['tmp_name']);

        if ($importResult == 1) {
            // Redirect back to vImport.php with success message
            header("Location: vImport.php?message=success");
        } else {
            // Redirect back to vImport.php with error message
            header("Location: vImport.php?message=error");
        }
    }
}