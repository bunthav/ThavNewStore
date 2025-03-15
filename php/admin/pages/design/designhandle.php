<?php
$design = dbSelect("design", "*", "id = 1");
$Rowdesign = mysqli_fetch_array($design);

$errors = [];
$success = "";


if (isset($_POST['update']) && $_GET['p'] === 'design') {
    $data = [
        'track_order' => $_POST['track_order'],
        'cart' => $_POST['cart'],
        'faq' => $_POST['faq'],
        'intro' => $_POST['intro'],
        'facebook' => $_POST['facebook'],
        'github' => $_POST['github']
    ];

    $uploadDir = __DIR__ . "/../../img/icons/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/webp'];

    if (!empty($_FILES['big_profile']['tmp_name'])) {
    // Generate a unique token for the file name
    $uniqueToken = bin2hex(random_bytes(16)); // 16 bytes = 32-character token
    $fileExtension = pathinfo($_FILES['big_profile']['name'], PATHINFO_EXTENSION);
    $fileName = $uniqueToken . ($fileExtension ? '.' . $fileExtension : ''); // Add extension if available

    $fileTmp = $_FILES['big_profile']['tmp_name'];
    $fileType = mime_content_type($fileTmp);

    if (in_array($fileType, $allowedTypes)) {
        $filePath = $uploadDir . $fileName;

        // Check and delete existing file
        if (!empty($Rowdesign['big_profile']) && file_exists($uploadDir . $Rowdesign['big_profile'])) {
            unlink($uploadDir . $Rowdesign['big_profile']);
        }

        move_uploaded_file($fileTmp, $filePath);
        $data['big_profile'] = $fileName;
    } else {
        $errors[] = "Invalid big profile image format.";
    }
}

if (!empty($_FILES['small_profile']['tmp_name'])) {
    // Generate a unique token for the file name
    $uniqueToken = bin2hex(random_bytes(16)); // 16 bytes = 32-character token
    $fileExtension = pathinfo($_FILES['small_profile']['name'], PATHINFO_EXTENSION);
    $fileName = $uniqueToken . ($fileExtension ? '.' . $fileExtension : ''); // Add extension if available

    $fileTmp = $_FILES['small_profile']['tmp_name'];
    $fileType = mime_content_type($fileTmp);

    if (in_array($fileType, $allowedTypes)) {
        $filePath = $uploadDir . $fileName;

        // Check and delete existing file
        if (!empty($Rowdesign['small_profile']) && file_exists($uploadDir . $Rowdesign['small_profile'])) {
            unlink($uploadDir . $Rowdesign['small_profile']);
        }

        move_uploaded_file($fileTmp, $filePath);
        $data['small_profile'] = $fileName;
    } else {
        $errors[] = "Invalid small profile image format.";
    }
}


    // Update database if no errors
    if (empty($errors)) {
        if (dbUpdate("design", $data, "id = 1")) {
            $success = "Design updated successfully!";
        } else {
            $errors[] = "Failed to update design.";
        }
    }
}
?>