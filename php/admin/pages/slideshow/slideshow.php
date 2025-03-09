<?php
$table = "slideshow";
$data = dbSelect($table);
$id = "";
if(isset($_GET['inid'])) {
    $id = $_GET['inid'];
    include "./pages/slideshow/ssupdate.php";
}
elseif(isset($_GET['deid'])) {
    $id = $_GET['deid'];
    $table = "slideshow";
    $criteria = "ssid = $id";
    $result = dbSelect($table, "*", $criteria);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $image = $row['ssimage'];
        $dest = $uploadDir . $image;
        if (file_exists($dest)) {
            unlink($dest);
        }
        $criteria = "ssid = $id";
        $result = dbDelete($table, $criteria);
        if ($result) {
            $success = "Record deleted successfully.";
            echo '<div class="alert alert-success">Slide deleted successfully!</div>';
        } else {
            $errors[] = "Failed to delete record.";
        }
    }
}
else{ ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Slideshow Management</title>
    </head>
    <body>
        <div class="col-sm-12 col-xl-12 p-4">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Add New Slide</h6>

                <form action="index.php?p=slideshow" method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                        <label for="inputTitle" class="col-sm-2 col-form-label d-none">ID</label>
                        <div class="col-sm-10 d-none">
                            <input type="number" placeholder="ID" name="ssid" class="form-control" id="inputTitle">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputTitle" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="Title" name="title" required class="form-control" id="inputTitle">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputSubtitle" class="col-sm-2 col-form-label">Sub Title</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="Subtitle" name="subtitle" required class="form-control" id="inputSubtitle">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputLink" class="col-sm-2 col-form-label">Link</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="Link" name="link" class="form-control" id="inputLink">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputOrder" class="col-sm-2 col-form-label">Slide Order</label>
                        <div class="col-sm-10">
                            <input type="number" placeholder="Order's slide" name="ssorder" required class="form-control" id="inputOrder">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputBigImage" class="col-sm-2 col-form-label">Big image</label>
                        <div class="col-sm-10">
                            <input type="file" name="ssimage" accept="image/*" required class="form-control" id="inputBigImage">
                        </div>
                    </div>
                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Enable slide?</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ssenable" required id="ssenableYes" value="1" checked>
                                <label class="form-check-label" for="ssenableYes">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ssenable" id="ssenableNo" value="0">
                                <label class="form-check-label" for="ssenableNo">
                                    No
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <button type="submit" name="insert" class="btn btn-primary">Insert</button>
                </form>
            </div>
        </div>
        <div class="col-12 p-4">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Slideshow Table</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Subtitle</th>
                                <th scope="col">Link</th>
                                <th scope="col">Slide Order</th>
                                <th scope="col">Big Image</th>
                                <th scope="col">Enable Slide</th>
                                <th scope="col">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($data): ?>
                                
                                <!-- index is just number for count start from 0 -->
                                <?php foreach ($data as $index => $row):?>
                                    <tr>
                                        <th scope="row"><?php echo $index + 1; ?></th>
                                        <td><?php echo $row['title']; ?></td>
                                        <td><?php echo $row['subtitle']; ?></td>
                                        <td><?php echo $row['link']; ?></td>
                                        <td><?php echo $row['ssorder']; ?></td>
                                        <td>
                                            <img src="./img/<?php echo $row['ssimage']; ?>" width="200" alt="<?php echo $row['title']; ?>">
                                        </td>
                                        <td><?php echo $row['ssenable'] ? 'Yes' : 'No'; ?></td>
                                        <td>
                                            <a href="index.php?p=slideshow&inid=<?php echo $row['ssid']; ?>" class="btn btn-outline-warning m-2">Edit</a>
                                            <a href="index.php?p=slideshow&deid=<?php echo $row['ssid']; ?>" class="btn btn-outline-danger m-2">Delete</a>
                                            <button type="submit" class="btn btn-outline-danger m-2">Delete</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8">No data found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
    </html>
<?php } ?>

