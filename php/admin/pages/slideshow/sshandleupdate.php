<?php
$uploadDir = __DIR__ . '/../../img/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

if (isset($_POST['update']) && $_GET['p'] === 'slideshow') { 
    $sucORerr = 1;
    $ssid = $_POST['ssid'];
    $table = "slideshow";
    $criteria = "ssid = " . $ssid;
    
    $result = dbSelect($table, "*", $criteria);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        die("Error: Slide ID not found in database.");
    }

    $fileName = (!empty($_FILES['ssimage']['name'])) ? $_FILES['ssimage']['name'] : $row['ssimage'];

    if (!empty($_FILES['ssimage']['name'])) {
        $fileTmp = $_FILES['ssimage']['tmp_name'];
        $fileSize = $_FILES['ssimage']['size'];
        $fileError = $_FILES['ssimage']['error'];
        
        if ($fileError !== UPLOAD_ERR_OK) {
            die("Error uploading file.");
        }

        if ($fileSize > 2 * 1024 * 1024) {
            die("Error: File size exceeds 2MB.");
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $fileTmp);
        finfo_close($finfo);
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/webp'];
        if (!in_array($mime, $allowedTypes)) {
            die("Error: Invalid image format.");
        }

        $dest = $uploadDir . $fileName;
        if (file_exists($dest)) {
            unlink($dest); // Overwrite existing file
        }

        move_uploaded_file($fileTmp, $dest);
    }

    $data = [
        "title" => $_POST['title'],
        "subtitle" => $_POST['subtitle'],
        "link" => $_POST['link'],
        "ssorder" => $_POST['ssorder'],
        "ssimage" => $fileName,
        "ssenable" => $_POST['ssenable'],
    ];

    if (dbUpdate($table, $data, $criteria)) {
        echo '<div class="alert alert-success">Slide updated successfully!</div>'; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <?php
    } else {
        die("Error updating database.");
    }
}
?>
