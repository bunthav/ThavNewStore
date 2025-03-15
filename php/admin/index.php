<?php
session_start();

include "./lib/config.php";
include "./lib/fdb.php";

// Page routing
$page = "dashboard.php";
$p = "dashboard";
$dashboard = true;
$insert = "";
$update = "";
$id = "";

if (isset($_GET['p'])) {
    $p = $_GET['p'];
    $id = $_GET['inid'] ?? ''; 

    switch ($p) {
        case "admin":
            $page = "./pages/admin/admin.php";
            $insert = "./pages/admin/adminhandle.php";
            $dashboard = false;
            break;
        case "design":
            $page = "./pages/design/design.php";
            $insert = "./pages/design/designhandle.php";
            $dashboard = false;
            break;
        case "slideshow":
            $page = "./pages/slideshow/slideshow.php";
            $insert = "./pages/slideshow/slideshowhandle.php";
            $update = "./pages/slideshow/sshandleupdate.php";
            $dashboard = false;
            break;
        case "products":
            $page = "./pages/products/products.php";
            $insert = "./pages/products/productshandle.php";
            $update = "./pages/products/productsupdatehandle.php";
            $dashboard = false;
            break;
        case "category":
            $page = "./pages/category/category.php";
            $insert = "./pages/category/categoryhandle.php";
            $update = "./pages/category/categoryupdatehandle.php";
            $dashboard = false;
            break;
        case "orders":
            $page = "./pages/orders/orders.php";
            $insert = "./pages/orders/ordershandle.php";
            $dashboard = false;
            break;
        case "accounts":
            $page = "./pages/cusAccounts/accounts.php";
            $insert = "./pages/cusAccounts/accountshandle.php";
            $dashboard = false;
            break;
        case "test":
            $page = "./test/test.php";
            $insert = "./test/testhandle.php";
            $dashboard = false;
            break;
        default:
            $page = "index.php";
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include "include/head.php" ?>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <?php include "include/sidebar.php" ?>

        <!-- Content Start -->
        <div class="content">

            <?php include "include/header.php" ?>

            <?php if (!$dashboard) {
                if(!empty($update))include "$update"; 
                include "$insert"; 
            } ?>

                

            <?php include "$page"; ?>

            <?php if ($dashboard) include "dashboard.php"; ?>

            <?php include "include/footer.php" ?>

        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <?php include "include/foot.php" ?>
</body>