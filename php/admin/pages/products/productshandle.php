<?php 

$prodir = __DIR__ . "/../../img/pro/";
if(!is_dir($prodir)){
    mkdir($prodir, 0755, true);
}

$errors = [];
$succes = "";

if(isset($_POST['insert']) && $_GET['p'] === 'products'){
    $imgName = "";
    if(empty($_FILES['pro_image']['tmp_name'])){
        $errors[] = "Please Input 1 image";
    }
    else{
        $imgName = $_FILES['pro_image']['name'];
        $imgTmp = $_FILES['pro_image']['tmp_name'];
        $imgType = mime_content_type($imgTmp);
        $allowTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/webp'];
        if(!in_array($imgType, $allowTypes)){
            $errors[] = "Please use only jpeg png gif jpg webp!";
        }else{
            $finprodir = $prodir . $imgName;
            if(file_exists($finprodir)){
                unlink($finprodir);
            }
            if (!move_uploaded_file($imgTmp, $finprodir)) {
                $errors[] = "Can't upload files!";
            } else {
                $success = "File : " . $imgName . " uploaded successfully.";
            }
        }
        $table = 'products';
        $data = 
        [
            'pro_name' => $_POST['pro_name'],
            'pro_catname' => $_POST['catname'],
            'pro_image' => $imgName,
            'pro_description' => $_POST['pro_description']
        ];
        if(!dbInsert($table, $data)){
            $errors[] = "Can't insert into database";
        }
        else{
            $success = "The product has been update.";
        }
        
    }
}

if (!empty($errors)) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    echo '<i class="fa fa-exclamation-circle me-2"></i>' . implode('<br>', $errors);
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
}

if (!empty($success)) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    echo '<i class="fa fa-exclamation-circle me-2"></i>' . $success;
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
}

?>