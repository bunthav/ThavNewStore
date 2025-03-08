<?php
$catdir = __DIR__ . "/../../img/cat/";
if (!is_dir($catdir)) {
    mkdir($catdir, 0755, true);
}

$errors = [];
$sucORerr = 1;
$success = '';

if (isset($_POST['insert']) && $_GET['p'] === 'category') {
    $catname = $_POST['catname'];
    $catdescription = $_POST['catdescription'];

    if (empty($_FILES['catimage']['tmp_name'])) {
        $errors[] = "Please select one image.";
        $sucORerr = 0;
    } else {
        $imgname = $_FILES['catimage']['name'];
        $imgtmp = $_FILES['catimage']['tmp_name'];
        $fileType = mime_content_type($imgtmp);
        $allowTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/webp'];
        // if want to use in_array(whatUWant,findInWhat)
        if (in_array($fileType, $allowTypes)) {
            $fincatdir = $catdir . $imgname;
            // Move the file (overwrite if exists)
            if (move_uploaded_file($imgtmp, $fincatdir)) {
                $success = "File uploaded successfully: $imgname.";
            } else {
                $errors[] = "Failed to upload $imgname.";
                $sucORerr = 0;
            }
        } else {
            $errors[] = "Invalid file type. Please upload JPEG, PNG, GIF, JPG, or WEBP files.";
            $sucORerr = 0;
        }
    }

    if ($sucORerr) {
        $table = "category";
        $data = [
            'catname' => $catname,
            'catdescription' => $catdescription,
            'catimage' => $imgname
        ];

        if (dbInsert($table, $data)) {
            $alertType = "success";
            $alertMessage = "Category added successfully!";
        } else {
            $errors[] = "Error adding Category to the database.";
            $alertType = "danger";
            $alertMessage = implode('<br>', $errors);
        }
    } else {
        $alertType = "danger";
        $alertMessage = implode('<br>', $errors);
    }
}
?>


<?php if (isset($alertType) && isset($alertMessage)): ?>
    <div class="alert alert-<?php echo $alertType; ?> alert-dismissible fade show" role="alert">
        <i class="fa fa-exclamation-circle me-2"></i>
        <?php echo $alertMessage; ?>
        <?php if ($sucORerr == 0): ?>
            <br><?php echo implode('<br>', $errors); ?>
        <?php else: ?>
            <br><?php echo $success; ?>
        <?php endif; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>