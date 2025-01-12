<?php
include_once "../config.inc.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/portal.css">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <script src="js/sweetalert2.all.min.js"></script>
    <title>Seller Parnel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Mitr", serif;
            font-weight: 400;
            font-style: normal;
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
                <?php
                $page = isset($_GET['page']) ? $_GET['page'] : '';
                if ($page == 'home') { ?>
                    <div class="app-wrapper">
                        <div class="app-content m-4">
                            <div class="container">
                                <div class="row">
                                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img src="../image/hero01.jpg" class="d-block w-100">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="../image/hero02.jpg" class="d-block w-100">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="../image/hero03.jpg" class="d-block w-100">
                                            </div>
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } else if ($page == 'order') { ?>
                    <div class="app-wrapper">
                        <h3 style="margin: 20px;">สินค้า</h3>
                        <div class="app-content m-5">
                            <div class="container">
                                <div class="row">
                                    <table class="table text-center">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>เวลา</th>
                                                <th>ชื่อผู้สั่ง</th>
                                                <th>ราคารวม</th>
                                                <th>สถานะ</th>
                                                <th>การจัดการ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM orders";
                                            $rs = mysqli_query($conn, $sql);
                                            while ($rw = mysqli_fetch_assoc($rs)) { ?>
                                                <tr>
                                                    <td><?php echo $rw['orderDate'] ?></td>
                                                    <td><?php echo $rw['orderFname'] ?></td>
                                                    <td>฿<?php echo number_format($rw['orderTotal']) ?></td>
                                                    <td><span class="badge bg-warning">
                                                            <?php echo str_replace('0', 'รอดำเนินการ', str_replace('1', 'เตรียมสินค้า', str_replace('2', 'จัดส่งสินค้า', $rw['orderStatus']))) ?>
                                                        </span></td>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#orderDetail<?php echo $rw['orderID'] ?>">
                                                            ดูรายละเอียด
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php } else if ($page == 'history') { ?>

                    <?php } ?>
                    </div>
            </div>
        </div>
        <?php
        $sql = "SELECT * FROM orders LEFT JOIN tb_account ON orders.orderUID = tb_account.id";
        $rs = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_assoc($rs)) {
        ?>
            <!-- Modal แสดงรายละเอียดสินค้า -->
            <div class="modal fade" id="orderDetail<?php echo $rw['orderID'] ?>" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">รายละเอียดคำสั่งซื้อ</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p><strong>ชื่อผู้สั่ง:</strong> <?php echo $rw['fullname'] ?> </p>
                                    <p><strong>เวลาสั่งซื้อ:</strong> <?php echo $rw['orderDate'] ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>สถานะ:</strong> <span class="badge bg-warning">
                                            <?php echo str_replace('0', 'รอดำเนินการ', str_replace('1', 'เตรียมสินค้า', str_replace('2', 'จัดส่งสินค้า', $rw['orderStatus']))) ?>
                                        </span></p>
                                    <p><strong>ราคารวม:</strong> ฿<?php echo number_format($rw['orderTotal']) ?></p>
                                </div>
                            </div>
                            <h6>รายการสินค้า</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>สินค้า</th>
                                        <th>จำนวน</th>
                                        <th>ราคาต่อชิ้น</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getDetail = "SELECT * FROM orders_detail WHERE orderID = " . $rw['orderID'];
                                    $res = mysqli_query($conn, $getDetail);
                                    while ($row = mysqli_fetch_assoc($res)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['productName'] ?></td>
                                            <td><?php echo $row['productPrice'] ?></td>
                                            <td><?php echo $row['productQty'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <form action="../admin/backend/seller.php" method="POST">
                                <input type="hidden" value="<?php echo $rw['orderID'] ?>" name="id">
                                <?php if ($rw['orderStatus'] == 0) { ?>
                                    <button type="submit" class="btn btn-primary" name="prepare">เตรียมสินค้า</button>
                                <?php } else if ($rw['orderStatus'] == 1) { ?>
                                    <button type="submit" class="btn btn-success" name="delivery">จัดส่งสินค้า</button>

                                <?php } ?>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
<?php } ?>
</body>

</html>