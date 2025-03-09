<?php

$catdir = __DIR__ . "/../../img/cat/";
if (!is_dir($catdir)) {
    mkdir($catdir, 0755, true);
}
$errors = [];
$success = "";


if (isset($_POST['update']) && $_GET['p'] ===  'category') {
    $table = 'category';
    $criteria = 'catid = ' . $_POST['catid'];
    $catdata = dbSelect($table, '*', $criteria);
    $row = mysqli_fetch_array($catdata);

    $fileName = "";
    if (!$row) {
        die("Error: Slide ID not found in database.");
    }

    if (empty($_FILES['catimage']['tmp_name'])) $fileName = $row['catimage'];
    else {
        $fileName = $_FILES['catimage']['name'];
        $fileTmp = $_FILES['catimage']['tmp_name'];
        $fileType = mime_content_type($fileTmp);
        $allowTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/webp'];
        if (!in_array($fileType, $allowTypes)) {
            $errors[] = "Please choose only jpeg png gif jpg webp.";
        } else {
            $fincatdir = $catdir . $fileName;
            if (file_exists($fincatdir)) {
                unlink($fincatdir); // Overwrite existing file
            }
            if (!move_uploaded_file($fileTmp, $fincatdir)) {
                $errors[] = "Can't upload files!";
            } else {
                $success = "File : " . $fileName . " uploaded successfully.";
            }
        }
    }

    $data =
        [
            'catid' => $_POST['catid'],
            'catname' => $_POST['catname'],
            'catdescription' => $_POST['catdescription'],
            'catimage' => $fileName
        ];
    if (dbUpdate($table, $data, $criteria)) {
        $alertMessage = "Category updated successfully!"; ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle me-2"></i>
            <?php echo $alertMessage; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    } else {
        $errors[] = "Error updating Category in the database.";
        $alertType = "danger";
        $alertMessage = implode('<br>', $errors); ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle me-2"></i>
            <?php echo $alertMessage; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
<?php
    }
}
?>