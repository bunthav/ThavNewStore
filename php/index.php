<?php
	include "./lib/fdb.php";
	include "./lib/config.php";
	include "./lib/oopdb.php";

	$page = "home.php";
	$p = "home";
	$slider = true; 
	$banner = true;
	if(isset($_GET['p'])){
		$p = $_GET['p'];
		switch($p){
			case "products" : 
				$page = "./pages/products.php";
				$slider = false;
				$banner = false;
			break;
			case "contact" : 
				$page = "./pages/contact.php";
				$slider = false;
				$banner = false;
			break;
			case "about" : 
				$page = "./pages/about.php";
				$slider = false;
				$banner = false;
			break;
			case "blog" : 
				$page = "./pages/blog.php";
				$slider = false;
				$banner = false;
			break;
			case "shoping-cart" : 
				$page = "./pages/shoping-cart.php";
				$slider = false;
				$banner = false;
			break;
			default:
                $page = "home.php"; 
            break;
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<style>
		.active {
			color: rgb(0, 0, 0) !important; 
		}
</style>
<?php include "include/head.php"?>
<body class="animsition">
	<?php include "include/header.php" ?>

	<?php if($slider)	include "include/slider.php" ?>

	<?php if($banner)	include "include/banner.php" ?>


	<?php include "$page" ?>


	<?php include "include/footer.php" ?>


	<?php include "include/modal.php" ?>

	<?php include "include/script.php" ?>

</body>
</html>