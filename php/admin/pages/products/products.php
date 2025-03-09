<?php
$table1 = "products";
$table = "category";
$onCondition = "products.pro_catname = category.catname";

$joinprocat = dbInnerJoin($table1, $table, $onCondition);
$joinrow = mysqli_fetch_array($joinprocat);

$catdata = dbSelect($table);
$catrow = mysqli_fetch_array($catdata);
if (isset($_POST['edit']) && $p === "products") {
    $id = $_POST['id'];
    include './pages/products/productsupdate.php';
}
else {


?>

<div class="col-sm-12 col-xl-12 p-4">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Add Products</h6>
        <form action="index.php?p=products" method="post" enctype="multipart/form-data">
            <div class="form-floating mb-3">
                <input type="text" name="pro_name" class="form-control" id="floatingInput"
                    placeholder="Products Name" required>
                <label for="floatingInput">Products Name</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" id="floatingSelect"
                    aria-label="Floating label select example" name="catname" required>
                    <option selected>Open this select menu</option>
                    <?php foreach ($catdata as $index => $catrow) { ?>

                        <option value="<?= $catrow['catname'] ?>"><?= $catrow['catname'] ?></option>

                    <?php } ?>
                </select>
                <label for="floatingSelect">Products Category</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="pro_description" class="form-control" id="floatingInput"
                    placeholder="Products Description">
                <label for="floatingInput">Products Description</label>
            </div>
            <div class="form-floating mb-3">
                <input type="file" name="pro_image" accept="image/*" required class="form-control" id="floatingInput"
                    placeholder="Products image">
                <label for="floatingInput">Products image</label>
            </div>
            <button type="submit" name="insert" class="btn btn-outline-success m-2">Insert</button>
        </form>
    </div>
</div>
<!-- Display All Categories -->
<div class="col-sm-12 col-xl-12 p-4">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">All Products</h6>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Products Name</th>
                    <th scope="col">Products Category</th>
                    <th scope="col">Products Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($joinprocat as $index => $joinrow) { ?>
                    <tr>
                        <th scope="row"><?php echo $index + 1; ?></th>
                        <td><?= $joinrow['pro_name']; ?></td>
                        <td><?= $joinrow['pro_catname']; ?></td>
                        <td>
                            <img src="./img/pro/<?= $joinrow['pro_image']; ?>" width="200" alt="<?= $joinrow['pro_name']; ?>">
                        </td>
                        <td>
                            <!-- Edit Form -->
                            <form action="index.php?p=products" method="post" style="display: inline;" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $joinrow['proid']; ?>">
                                <button type="submit" name="edit" class="btn btn-outline-success m-2">Edit</button>
                            </form>
                            <!-- Delete Form -->
                            <form action="index.php?p=products" method="post" style="display: inline;" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $joinrow['proid']; ?>">
                                <button type="submit" name="delete" class="btn btn-outline-danger m-2">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php
}
?>