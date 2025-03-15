<?php
$table = 'shipment';
$criteria = "smid = $smid";
$smdata = dbSelect($table, "*", $criteria);

if (!$smdata) {
    $smname = '';
    $smdescription = '';
    $smprice = '';
    $smimage = '';
} else {
    $row = mysqli_fetch_array($smdata);

    $smid = $row['smid'];
    $smname = $row['smname'];
    $smdescription = $row['smdescription'];
    $smprice = $row['smprice'];
    $smimage = $row['smimage'];
}
?>



<!-- Add Category Form -->
<div class="col-sm-12 col-xl-12 p-4">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Update Shipment Method</h6>
        <form action="index.php?p=shipment" method="post" enctype="multipart/form-data">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" value="<?= $smid ?>" name="smid" required id="floatingInput" placeholder="ID of Shipment Method">
                <label for="floatingInput">ID of Shipment Method</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" value="<?= $smname ?>" name="smname" required id="floatingInput" placeholder="Name of Shipment Method">
                <label for="floatingInput">Name of Shipment Method</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" value="<?= $smdescription ?>" name="smdescription" id="floatingPassword" placeholder="Shipment Method description">
                <label for="floatingInput">Shipment Method description</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" value="<?= $smprice ?>" name="smprice" id="floatingPassword" placeholder="Shipment Method price">
                <label for="floatingInput">Shipment Method price</label>
            </div>
            <div class="form-floating mb-3">
                <input type="file" name="smimage" accept="image/*" class="form-control" id="inputBigImage" placeholder="Shipment Method image">
            </div>
            <br>
            <label> the current image is : <img src="./img/shipment/<?php echo $smimage; ?>" width="200" alt="Current Image"> </label>
            <br>
            <button type="submit" name="update" class="btn btn-outline-success m-2">update</button>
        </form>
    </div>
</div>