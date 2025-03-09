<?php

$catdir = __DIR__ . "/../../img/cat/";
if (!is_dir($catdir)) {
    mkdir($catdir, 0755, true);
}

$errors = [];
$success = "";

$table = 'category';

if (isset($_POST['delete']) && $_GET['p'] === 'category') {
    $catid = $_POST['id'];
    $criteria = "catid = $catid";

    $catData = dbSelect($table, '*', $criteria);
    $row = mysqli_fetch_array($catData);

    if (!$row) {
        die("Error: Category ID not found in database.");
    }

    $filePath = $catdir . $row['catimage'];
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    if (dbDelete($table, $criteria)) {
        $alertMessage = "Category deleted successfully!";
        $alertType = "success";
    } else {
        $alertMessage = "Error deleting category.";
        $alertType = "danger";
    }
}

if (isset($_POST['update']) && $_GET['p'] === 'category') {
    $catid = $_POST['catid'];
    $criteria = "catid = $catid";
    $catData = dbSelect($table, '*', $criteria);
    $row = mysqli_fetch_array($catData);

    if (!$row) {
        die("Error: Category ID not found in database.");
    }

    $fileName = $row['catimage']; // Default to existing image

    // Handle Image Upload
    if (!empty($_FILES['catimage']['tmp_name'])) {
        $fileTmp = $_FILES['catimage']['tmp_name'];
        $fileType = mime_content_type($fileTmp);
        $allowTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/webp'];

        if (!in_array($fileType, $allowTypes)) {
            $errors[] = "Please choose only jpeg, png, gif, jpg, or webp.";
        } else {
            $fileName = $_FILES['catimage']['name'];
            $finalPath = $catdir . $fileName;

            // Delete old image before 
            if (file_exists($finalPath)) {
                unlink($finalPath);
            }

            if (!move_uploaded_file($fileTmp, $finalPath)) {
                $errors[] = "Can't upload file!";
            } else {
                $success = "File: " . $fileName . " uploaded successfully.";
            }
        }
    }

    $data = [
        'catname' => $_POST['catname'],
        'catdescription' => $_POST['catdescription'],
        'catimage' => $fileName
    ];

    if (dbUpdate($table, $data, $criteria)) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle me-2">Category updated successfully!</i>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } else {
    ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle me-2">Error updating category in the database.</i> <?php implode('<br>', $errors); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    }
}
?>