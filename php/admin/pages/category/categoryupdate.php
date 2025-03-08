<?php
$table = 'category';
$criteria = "catid = $id";
$catdata = dbSelect($table, "*", $criteria);

if (!$catdata) {
    $catname = '';
    $catdescription = '';
    $catimage = '';
} else {
    $row = mysqli_fetch_array($catdata);

    $catid = $row['catid'];
    $catname = $row['catname'];
    $catdescription = $row['catdescription'];
    $catimage = $row['catimage'];
}
?>



<!-- Add Category Form -->
<div class="col-sm-12 col-xl-12 p-4">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Update Category</h6>
        <form action="index.php?p=category" method="post" enctype="multipart/form-data">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" value="<?= $catid ?>" name="catid" required id="floatingInput" placeholder="ID of category">
                <label for="floatingInput">ID of category</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" value="<?= $catname ?>" name="catname" required id="floatingInput" placeholder="Name of category">
                <label for="floatingInput">Name of category</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" value="<?= $catdescription ?>" name="catdescription" required id="floatingPassword" placeholder="Password">
                <label for="floatingInput">Category description</label>
            </div>
            <div class="form-floating mb-3">
                <input type="file" name="catimage" required accept="image/*" class="form-control" id="inputBigImage" placeholder="Category image">
            </div>
            <br>
            <label> the current image is : <img src="./img/cat/<?php echo $catimage; ?>" width="200" alt="Current Image"> </label>
            <br>
            <button type="submit" name="update" class="btn btn-outline-success m-2">update</button>
        </form>
    </div>
</div>