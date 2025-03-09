<?php
$table = 'products';
$criteria = "proid = $id";
$prodata = dbSelect($table, "*", $criteria);

if (!$prodata) {
    $pro_name = '';
    $pro_catname = '';
    $pro_description = '';
    $pro_image = '';
} else {
    $row = mysqli_fetch_array($prodata);

    $proid = $row['proid'];
    $pro_name = $row['pro_name'];
    $pro_catname = $row['pro_catname'];
    $pro_description = $row['pro_description'];
    $pro_image = $row['pro_image'];
}
?>

<!-- Update Product Form -->
<div class="col-sm-12 col-xl-12 p-4">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Update Product</h6>
        <form action="index.php?p=products" method="post" enctype="multipart/form-data">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" value="<?= $proid ?>" name="proid" required id="floatingInput" placeholder="Product ID">
                <label for="floatingInput">Product ID</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" value="<?= $pro_name ?>" name="pro_name" required id="floatingInput" placeholder="Product Name">
                <label for="floatingInput">Product Name</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" id="floatingSelect" name="pro_catname" required>
                    <option value="<?= $pro_catname ?>" selected><?= $pro_catname ?></option>
                    <?php foreach ($catdata as $catrow) { ?>
                        <option value="<?= $catrow['catname'] ?>"><?= $catrow['catname'] ?></option>
                    <?php } ?>
                </select>
                <label for="floatingSelect">Product Category</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" value="<?= $pro_description ?>" name="pro_description" id="floatingPassword" placeholder="Product Description">
                <label for="floatingInput">Product Description</label>
            </div>
            <div class="form-floating mb-3">
                <input type="file" name="pro_image" accept="image/*" class="form-control" id="inputBigImage" placeholder="Product Image">
            </div>
            <br>
            <label>Current Image: <img src="./img/pro/<?php echo $pro_image; ?>" width="200" alt="Current Image"> </label>
            <br>
            <button type="submit" name="update" class="btn btn-outline-success m-2">Update</button>
        </form>
    </div>
</div>