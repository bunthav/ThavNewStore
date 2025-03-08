<?php
// Retrieve existing data from the database
$table = "slideshow";
$criteria = "ssid = $id";
$result = dbSelect($table, "*", $criteria);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    
    $title = $row['title'];
    $subtitle = $row['subtitle'];
    $link = $row['link'];
    $order = $row['ssorder'];
    $image = $row['ssimage'];
    $enable = $row['ssenable'];
} else {
    // Default values if no data found
    $title = '';
    $subtitle = '';
    $link = '';
    $order = '';
    $image = '';
    $enable = 1;
}
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Slideshow Management</title>
    </head>
    <body>
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Update Slide</h6>

                <form action="index.php?p=slideshow" method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                        <label for="inputID" class="col-sm-2 col-form-label">ID</label>
                        <div class="col-sm-10">
                            <input type="number" value="<?= $id ?>" placeholder="ID" name="ssid" class="form-control" id="inputID">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputTitle" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="Title" value="<?= $title ?>" name="title" required class="form-control" id="inputTitle">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputSubtitle" class="col-sm-2 col-form-label">Sub Title</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="Subtitle" value="<?= $subtitle ?>" name="subtitle" required class="form-control" id="inputSubtitle">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputLink" class="col-sm-2 col-form-label">Link</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="Link" value="<?= $link ?>" name="link" class="form-control" id="inputLink">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputOrder" class="col-sm-2 col-form-label">Slide Order</label>
                        <div class="col-sm-10">
                            <input type="number" placeholder="Order's slide" value="<?= $order ?>" name="ssorder" required class="form-control" id="inputOrder">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputBigImage" class="col-sm-2 col-form-label">Big image</label>
                        <div class="col-sm-10">
                            <input type="file" name="ssimage" accept="image/*" class="form-control" id="inputBigImage">
                            <?php if (!empty($image)): ?>
                                <small>Current Image: <img src="./img/<?php echo $image; ?>" width="200" alt="Current Image"></small>
                            <?php endif; ?>
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
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </body>
    </html>