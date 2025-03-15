<?php

$prodir = __DIR__ . "/../../img/pro/";
if (!is_dir($prodir)) {
    mkdir($prodir, 0755, true);
}

$errors = [];
$success = "";

if (isset($_POST['update']) && $_GET['p'] === 'products') {
    $table = 'products';
    $criteria = 'proid = ' . $_POST['proid'];
    $productData = dbSelect($table, '*', $criteria);
    $row = mysqli_fetch_array($productData);

    $fileName = "";
    if (!$row) {
        die("Error: Product ID not found in database.");
    }

    // Image Handling
    if (empty($_FILES['pro_image']['tmp_name'])) {
        $fileName = $row['pro_image'];
    } else {
        $fileTmp = $_FILES['pro_image']['tmp_name'];
        $fileType = mime_content_type($fileTmp);
        $allowTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/webp'];

        if (!in_array($fileType, $allowTypes)) {
            $errors[] = "Please choose only jpeg, png, gif, jpg, or webp.";
        } else {
            
            if (file_exists($prodir . $row['pro_image'])) {
                unlink($prodir . $row['pro_image']); 
            }

            $fileName = $_FILES['pro_image']['name'];
            $finalProDir = $prodir . $fileName;
            if (!move_uploaded_file($fileTmp, $finalProDir)) {
                $errors[] = "Can't upload file!";
            } else {
                $success = "File: " . $fileName . " uploaded successfully.";
            }
        }
    }

    $data = [
        'proid'          => $_POST['proid'],
        'pro_name'       => $_POST['pro_name'],
        'pro_description'=> $_POST['pro_description'],
        'pro_catname'    => $_POST['pro_catname'],
        'pro_image'      => $fileName
    ];

    if (dbUpdate($table, $data, $criteria)) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle me-2"></i>
                Product updated successfully!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    } else {
        $errors[] = "Error updating product in the database.";
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-circle me-2"></i>
                ' . implode('<br>', $errors) . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
}

if (isset($_POST['delete']) && $_GET['p'] === 'products') {
    $table = 'products';
    $proid = $_POST['id'];
    $criteria = 'proid = ' . $proid;

    $productData = dbSelect($table, '*', $criteria);
    $row = mysqli_fetch_array($productData);

    if (!$row) {
        die("Error: Product ID not found.");
    }

    $filePath = $prodir . $row['pro_image'];
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    if (dbDelete($table, $criteria)) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle me-2"></i>
                Product deleted successfully!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-circle me-2"></i>
                Error deleting product.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
}

?>
