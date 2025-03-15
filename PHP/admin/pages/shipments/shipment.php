<?php
$table = "shipment";
$smdata = dbSelect($table);

if (isset($_POST['edit']) && $p === "shipment") {
    $smid = $_POST['smid'];
    include './pages/shipments/shipmentupdate.php';
} else {


?>


    <div class="col-sm-12 col-xl-12 p-4">
        <div class="bg-secondary rounded h-100 p-4">
            <h6 class="mb-4">Add Shipment Method</h6>
            <form action="index.php?p=shipment" method="post" enctype="multipart/form-data">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="smname" required id="floatingInput" placeholder="Name of Shipment Method">
                    <label for="floatingInput">Name of Shipment Method</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="smdescription" required id="floatingPassword" placeholder="Shipment Method Description">
                    <label for="floatingInput">Shipment description</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="smprice" required id="floatingPassword" placeholder="Shipment Method price">
                    <label for="floatingInput">Shipment price</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="file" name="smimage" required accept="image/*" class="form-control" id="inputBigImage" placeholder="Shipment Method image">
                    <label for="floatingInput">Shipment image</label>
                </div>
                <button type="submit" name="insert" class="btn btn-outline-success m-2">Insert</button>
            </form>
        </div>
    </div>

    <div class="col-sm-12 col-xl-12 p-4">
        <div class="bg-secondary rounded h-100 p-4">
            <h6 class="mb-4">All Shipment Method</h6>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Shipment Method Name</th>
                        <th scope="col">Shipment Method Description</th>
                        <th scope="col">Shipment Method price($)</th>
                        <th scope="col">Shipment Method Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($smdata as $index => $row) { ?>
                        <tr>
                            <th scope="row"><?php echo $index + 1; ?></th>
                            <td><?= $row['smname']; ?></td>
                            <td><?= $row['smdescription']; ?></td>
                            <td><?= $row['smprice']; ?></td>
                            <td>
                                <img src="./img/shipment/<?= $row['smimage']; ?>" width="200" alt="<?= $row['smname']; ?>">
                            </td>
                            <td>
                                <!-- Edit Form -->
                                <form action="index.php?p=shipment" method="post" style="display: inline;">
                                    <input type="hidden" name="smid" value="<?= $row['smid']; ?>">
                                    <button type="submit" name="edit" class="btn btn-outline-success m-2">Edit</button>
                                </form>
                                <!-- Delete Form -->
                                <form action="index.php?p=shipment" method="post" style="display: inline;">
                                    <input type="hidden" name="smid" value="<?= $row['smid']; ?>">
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