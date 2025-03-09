<?php
$table = "category";
$catdata = dbSelect($table);

if (isset($_POST['edit']) && $p === "category") {
    $id = $_POST['id'];
    include './pages/category/categoryupdate.php';
} elseif (isset($_POST['delete']) && $p === "category") {
    $id = $_POST['id'];
    $criteria = "catid = $id";
    if (dbDelete($table, $criteria)) {
        echo '<div class="alert alert-success">Slide deleted successfully!</div>'; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
<?php
    } else {
        $alertType = "danger";
        $alertMessage = "Error deleting category.";
    }
    //  Display Alert Messages 
    if (isset($alertType) && isset($alertMessage)): ?>
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary rounded h-100 p-4">
                <div class="alert alert-<?php echo $alertType; ?> alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle me-2"></i><?php echo $alertMessage; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    <?php
    endif;
} else {


?>


    <!-- Add Category Form -->
    <div class="col-sm-12 col-xl-12 p-4">
        <div class="bg-secondary rounded h-100 p-4">
            <h6 class="mb-4">Add Category</h6>
            <form action="index.php?p=category" method="post" enctype="multipart/form-data">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="catname" required id="floatingInput" placeholder="Name of category">
                    <label for="floatingInput">Name of category</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="catdescription" required id="floatingPassword" placeholder="Password">
                    <label for="floatingInput">Category description</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="file" name="catimage" required accept="image/*" class="form-control" id="inputBigImage" placeholder="Category image">
                    <label for="floatingInput">Category image</label>
                </div>
                <button type="submit" name="insert" class="btn btn-outline-success m-2">Insert</button>
            </form>
        </div>
    </div>

    <!-- Display All Categories -->
    <div class="col-sm-12 col-xl-12 p-4">
        <div class="bg-secondary rounded h-100 p-4">
            <h6 class="mb-4">All Categories</h6>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category Title</th>
                        <th scope="col">Category Description</th>
                        <th scope="col">Category Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($catdata as $index => $row) { ?>
                        <tr>
                            <th scope="row"><?php echo $index + 1; ?></th>
                            <td><?= $row['catname']; ?></td>
                            <td><?= $row['catdescription']; ?></td>
                            <td>
                                <img src="./img/cat/<?= $row['catimage']; ?>" width="200" alt="<?= $row['catname']; ?>">
                            </td>
                            <td>
                                <!-- Edit Form -->
                                <form action="index.php?p=category" method="post" style="display: inline;">
                                    <input type="hidden" name="id" value="<?= $row['catid']; ?>">
                                    <button type="submit" name="edit" class="btn btn-outline-success m-2">Edit</button>
                                </form>
                                <!-- Delete Form -->
                                <form action="index.php?p=category" method="post" style="display: inline;">
                                    <input type="hidden" name="id" value="<?= $row['catid']; ?>">
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