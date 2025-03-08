<?php 

$uploadDir = __DIR__ . '/../../img/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Handle slideshow form submission
if (isset($_POST['insert']) && $p === 'slideshow') { 
    $fileName = "";
    $sucORerr = 1;

    if (empty($_FILES['ssimage']['name'])) { 
        $errors[] = 'Please select an image.';
        $sucORerr = 0;
    } else {
        $fileName = $_FILES['ssimage']['name'];
        $fileTmp = $_FILES['ssimage']['tmp_name'];
        $fileSize = $_FILES['ssimage']['size'];
        $fileError = $_FILES['ssimage']['error'];

        if ($fileError !== UPLOAD_ERR_OK) {
            $errors[] = "Error uploading file $fileName.";
            $sucORerr = 0;
        }

        if ($fileSize > 2 * 1024 * 1024) {
            $errors[] = "$fileName exceeds 2MB size limit.";
            $sucORerr = 0;
        }

        // Validate file type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $fileTmp);
        finfo_close($finfo);
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/webp'];

        if (!in_array($mime, $allowedTypes)) {
            $errors[] = "$fileName is not a valid image (JPEG, PNG, GIF, JPG, WEBP).";
            $sucORerr = 0;
        }

        $dest = $uploadDir . $fileName;

        // Move the file (overwrite if exists)
        if (move_uploaded_file($fileTmp, $dest)) {
            $success = "File uploaded successfully: $fileName.";
        } else {
            $errors[] = "Failed to upload $fileName.";
            $sucORerr = 0;
        }
    }

    if ($sucORerr && isset($_POST['title']) && isset($_POST['subtitle'])) { 
        $table = "slideshow";
        $data = [
            "title" => $_POST['title'],
            "subtitle" => $_POST['subtitle'],
            "link" => $_POST['link'],
            "ssorder" => $_POST['ssorder'],
            "ssimage" => $fileName,
            "ssenable" => $_POST['ssenable'],
        ];

        // Use dbInsert() to insert data
        if (dbInsert($table, $data)) {
            $alertType = "success";
            $alertMessage = "Slide added successfully!";
        } else {
            $alertType = "danger";
            $alertMessage = "Error adding slide.";
        }
    } else {
        $alertType = "danger";
        $alertMessage = implode('<br>', $errors);
    }
?>

<div class="col-sm-12 col-xl-12">
    <div class="bg-secondary rounded h-100 p-4">
        <?php if (isset($alertType) && isset($alertMessage)): ?>
            <div class="alert alert-<?php echo $alertType; ?> alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-circle me-2"></i><?php echo $alertMessage . " " . ($sucORerr == 0 ? implode('<br>', $errors) : $success); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
} else {
    $alertType = "danger";
    $alertMessage = "Error adding slide.";
}
?>
