<?php

$smdir = __DIR__ . "/../../img/shipment/";
if (!is_dir($smdir)) {
    mkdir($smdir, 0755, true);
}

$errors = [];
$success = "";

$table = 'shipment';

if (isset($_POST['delete']) && $_GET['p'] === 'shipment') {
    $smid = $_POST['smid'];
    $criteria = "smid = $smid";

    $smData = dbSelect($table, '*', $criteria);
    $row = mysqli_fetch_array($smData);

    if (!$row) {
        die("Error: Shipment ID not found in database.");
    }

    $filePath = $smdir . $row['smimage'];
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    if (dbDelete($table, $criteria)) {
        $alertMessage = "Shipment deleted successfully!";
        $alertType = "success";
    } else {
        $alertMessage = "Error deleting Shipment.";
        $alertType = "danger";
    }
}

if (isset($_POST['update']) && $_GET['p'] === 'shipment') {
    $smid = $_POST['smid'];
    $criteria = "smid = $smid";
    $smData = dbSelect($table, '*', $criteria);
    $row = mysqli_fetch_array($smData);

    if (!$row) {
        die("Error: Shipment ID not found in database.");
    }

    $fileName = $row['smimage']; // Default to existing image

    // Handle Image Upload
    if (!empty($_FILES['smimage']['tmp_name'])) {
        $fileTmp = $_FILES['smimage']['tmp_name'];
        $fileType = mime_content_type($fileTmp);
        $allowTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/webp'];

        if (!in_array($fileType, $allowTypes)) {
            $errors[] = "Please choose only jpeg, png, gif, jpg, or webp.";
        } else {
            $fileName = $row['smimage'];

            // Delete old image before 
            if (file_exists($smdir . $fileName)) {
                unlink($smdir . $fileName);
            }

            $fileName = $_FILES['smimage']['name'];
            $finalPath = $smdir . $fileName;
            if (!move_uploaded_file($fileTmp, $finalPath)) {
                $errors[] = "Can't upload file!";
            } else {
                $success = "File: " . $fileName . " uploaded successfully.";
            }
        }
    }

    $data = [
        'smname' => $_POST['smname'],
        'smdescription' => $_POST['smdescription'],
        'smprice' => $_POST['smprice'],
        'smimage' => $fileName
    ];

    if (dbUpdate($table, $data, $criteria)) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle me-2">Shipment updated successfully!</i>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } else {
    ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle me-2">Error updating Shipment in the database.</i> <?php implode('<br>', $errors); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
<?php
    }
}
?>