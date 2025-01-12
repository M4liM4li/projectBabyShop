<?php
include_once "../config.inc.php";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/portal.css">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Mitr", serif;
            font-weight: 400;
            font-style: normal;
        }

        .hover {
            transition: all 0.3s;

        }

        .hover:hover {
            transform: scale(1.01);
        }
    </style>
</head>

<body>



    <?php include 'navbar.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1">
                <?php include 'sidebar.php'; ?>
            </div>
            <div class="col-md-10">
                <?php if (isset($_GET['type'])) { ?>
                    <div class="app-wrapper">
                        <div class="app-content m-4">
                            <div class="container">
                                <div class="row">
                                    <img src="../image/legomain.png">
                                </div>
                            </div>
                        </div>

                        <hr style="margin: 50px 5px;">
                        <h4 class="col m-4">รายการสินค้า</h4>
                        <div class="row">
                            <?php
                            $type = $_GET['type'];
                            $getFood = "SELECT * FROM product WHERE proType = '$type'";
                            $rs = mysqli_query($conn, $getFood);
                            while ($rw = mysqli_fetch_assoc($rs)) {
                            ?>
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                    <div class="card h-100 d-flex flex-column border-0 shadow-lg hover">
                                        <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
                                            <img src="../product/<?php echo $rw['pro_img']; ?>" class="card-img-top p-4" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                        </div>
                                        <div class="card-body d-flex flex-column justify-content-between text-center">
                                            <p class="card-title" style="color:rgb(24, 255, 93);"><?php echo $rw['proName']; ?></p>
                                            <b class="card-text mb-3" style="color:rgba(253, 0, 0, 0.84);">฿<?php echo $rw['proPrice']; ?> </b>
                                            <div>
                                                <button type="submit" class="btn" style="background-color: #ec407a; color: white;"
                                                    data-bs-toggle="modal" data-bs-target="#viewProduct<?php echo $rw['proID'] ?>">ดูสินค้า</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="app-wrapper">
                        <div class="app-content m-4">
                            <div class="container">
                                <div class="row">
                                    <img src="../image/legomain.png">
                                </div>
                            </div>
                        </div>

                        <hr style="margin: 50px 5px;">
                        <h4 class="col m-4">รายการสินค้า</h4>
                        <div class="row">
                            <?php
                            $getFood = "SELECT * FROM product";
                            $rs = mysqli_query($conn, $getFood);
                            while ($rw = mysqli_fetch_assoc($rs)) {
                            ?>
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                    <div class="card h-100 d-flex flex-column hover">
                                        <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
                                            <img src="../product/<?php echo $rw['pro_img']; ?>" class="card-img-top p-4" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                        </div>
                                        <div class="card-body d-flex flex-column justify-content-between text-center">
                                            <p class="card-title fw-bold" style="color:rgba(255, 123, 0, 0.84)4);"><?php echo $rw['proName']; ?></p>
                                            <b class="card-text mb-3" style="color:rgba(253, 0, 0, 0.84);">฿<?php echo $rw['proPrice']; ?> </b>

                                            <div>
                                                <button type="submit" class="btn" style="background-color: #ec407a; color: white;"
                                                    data-bs-toggle="modal" data-bs-target="#viewProduct<?php echo $rw['proID'] ?>">ดูสินค้า</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php
    $getFood = "SELECT * FROM product";
    $rs = mysqli_query($conn, $getFood);
    while ($rw = mysqli_fetch_assoc($rs)) {
    ?>
        <!-- modal view product -->
        <div class="modal fade" id="viewProduct<?php echo $rw['proID'] ?>" tabindex="-1" aria-labelledby="viewProductLabel<?php echo $rw['proID'] ?>" aria-hidden="true" >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewProductLabel<?php echo $rw['proID'] ?>">รายละเอียดสินค้า</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card border-0">
                            <div class="row">
                                <!-- ส่วนแสดงรูปภาพ -->
                                <div class="col-lg-6 d-flex justify-content-center align-items-center">
                                    <img src="../product/<?php echo $rw['pro_img']; ?>" class="card-img-top p-4" style="max-height: 300px; max-width: 100%; object-fit: contain;">
                                </div>
                                <!-- ส่วนแสดงรายละเอียดสินค้า -->
                                <div class="col-lg-6 mt-4">
                                    <h4 class="fw-bold"><?php echo $rw['proName']; ?></h4>
                                    <p class="text-muted">ราคา: <span class="text-primary"><?php echo $rw['proPrice']; ?> บาท</span></p>
                                    <p class="card-text">รายละเอียด: <?php echo $rw['proDetail']; ?></p>
                                    <form action="../admin/backend/cart.php" method="POST" class="d-inline" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo $rw['proID']; ?>">
                                        <input type="hidden" name="name" value="<?php echo $rw['proName']; ?>">
                                        <input type="hidden" name="price" value="<?php echo $rw['proPrice']; ?>">
                                        <input type="hidden" name="img" value="<?php echo $rw['pro_img']; ?>">
                                        <input type="hidden" name="typeID" value="<?php echo $type ?>">
                                        <button type="submit" class="btn w-100 mt-4" name="addCart" style="background-color: #ec407a; color: white;">ลงตะกร้า</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>

</body>

</html>