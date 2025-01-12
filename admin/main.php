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
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <script src="js/sweetalert2.all.min.js"></script>
    <title>Admin Parnel</title>
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
                <?php } else if ($page == 'product') { ?>
                    <div class="app-wrapper">
                        <div class="app-content m-4">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-10">
                                        <!-- ฟอร์มเพิ่มข้อมูลสินค้า -->
                                        <div class="card">
                                            <div class="card-header border-1" style="background-color:rgb(235, 249, 255)">
                                                <img src="../image/logo.png" width="80" style="float: right;">
                                                <h4 class="col mt-3">เพิ่มข้อมูลสินค้า</h4>
                                            </div>
                                            <div class="card-body">
                                                <form method="post" action="backend/product.php" enctype="multipart/form-data">
                                                    <div class="mb-1">
                                                        <label class="form-label">ชื่อสินค้า</label>
                                                        <input type="text" class="form-control" name="proName" required>
                                                    </div>
                                                    <div class="mb-1">
                                                        <label class="form-label">ประเภทสินค้า</label>
                                                        <select class="form-control" name="proType" required>
                                                            <option value="" disabled selected>เลือกประเภทสินค้า</option>
                                                            <?php
                                                            $getType = "SELECT * FROM product_type";
                                                            $rs = mysqli_query($conn, $getType);
                                                            while ($rw = mysqli_fetch_assoc($rs)) {
                                                            ?>
                                                                <option value="<?php echo $rw['typeID'] ?>"><?php echo $rw['typeName'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-1">
                                                        <label class="form-label">ราคา</label>
                                                        <input type="text" class="form-control" name="proPrice" required>
                                                    </div>
                                                    <div class="mb-1">
                                                        <label class="form-label">รายละเอียด</label>
                                                        <textarea name="proDetail" class="form-control" cols="50" required></textarea>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">เพิ่มรูปสินค้า</label>
                                                        <input type="file" class="form-control" name="pro_img" required>
                                                    </div>
                                                    <div class="mb-1">
                                                        <input type="submit" class="btn" style="background-color: #28B031FF; color: white;" value="บันทึก" name="add">
                                                        <a class="btn" style="background-color: #D5304EFF; color: white;">ยกเลิก</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ตารางแสดงรายการสินค้า -->
                                    <div class="col-lg-10 mt-4">
                                        <div class="card">
                                            <div class="card-header" style="background-color:rgb(255, 230, 240)">
                                                <img src="../image/information.png" width="50" style="float: right;">
                                                <div class="col m-2">
                                                    <h3 style="font-weight: bold">รายการสินค้า</h3>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-bordered table-sm" style="text-align: center;">
                                                    <thead>
                                                        <tr>
                                                            <th>รูปสินค้า</th>
                                                            <th>รหัสสินค้า</th>
                                                            <th>ชื่อสินค้า</th>
                                                            <th>ประเภทสินค้า</th>
                                                            <th>ราคาสินค้า (บาท)</th>
                                                            <th>รายละเอียดสินค้า</th>
                                                            <th>Tools</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sql = "SELECT * FROM product LEFT JOIN product_type ON product.proType = product_type.typeID ";
                                                        $rs = mysqli_query($conn, $sql);

                                                        if (mysqli_num_rows($rs) > 0) {
                                                            while ($rw = mysqli_fetch_assoc($rs)) { ?>
                                                                <tr>
                                                                    <td><img src="../product/<?php echo $rw['pro_img']; ?>" alt="" width="30px"></td>
                                                                    <td><?php echo $rw['proID']; ?></td>
                                                                    <td><?php echo $rw['proName']; ?></td>
                                                                    <td><?php echo $rw['typeName']; ?></td>
                                                                    <td><?php echo $rw['proPrice']; ?></td>
                                                                    <td><?php echo $rw['proDetail']; ?></td>
                                                                    <td class="d-flex">
                                                                        <button class="btn" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $rw['proID'] ?>"><img src="../image/edit.png" alt="" width="30"></button>
                                                                        <form action="backend/product.php" method="POST">
                                                                            <input type="text" hidden value="<?php echo $rw['proID'] ?>" name="id">
                                                                            <button class="btn" name="delProduct" onclick="return confirm('ยืนยันการลบข้อมูล?');"><img src="../image/delete.png" width="30"></button>
                                                                        </form>
                                                                    </td>

                                                                </tr>
                                                            <?php }
                                                        } else { ?>
                                                            <tr>
                                                                <td colspan="5">ไม่มีข้อมูลสินค้า</td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } else if ($page == 'user') { ?>
                    <div class="app-wrapper">
                        <h3 style="margin: 20px;">จัดการผู้ใช้งาน</h3>
                        <div class="app-content m-5">
                            <div class="container">
                                <div class="row">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Username</th>
                                                <th>Fullname</th>
                                                <th>Level</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM tb_account WHERE level!='99'";
                                            $rs = mysqli_query($conn, $sql);
                                            while ($rw = mysqli_fetch_assoc($rs)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $rw['id'] ?></td>
                                                    <td><?php echo $rw['username'] ?></td>
                                                    <td><?php echo $rw['fullname'] ?></td>
                                                    <td><?php echo $rw['level'] ?></td>
                                                    <td class="d-flex">
                                                        <button class="btn me-2" data-bs-toggle="modal" data-bs-target="#editUser<?php echo $rw['id'] ?>"><img src="../image/edit.png" alt="" width="30"></button>
                                                        <form action="backend/user.php" method="POST">
                                                            <input type="text" hidden value="<?php echo $rw['id'] ?>" name="id">
                                                            <button class="btn" name="delUser"><img src="../image/delete.png" width="30"></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php } else if ($page == 'orderInfo') { ?>
                        <div class="app-wrapper">
                            <h3 style="margin: 20px;">รายการสั่งซื้อทั้งหมด</h3>
                            <div class="app-content m-5">
                                <div class="container">
                                    <div class="row">
                                        <table class="table">
                                            <tr>
                                                <th>รหัสคำสั่งซื้อ</th>
                                                <th>รายการสินค้า</th>
                                                <th>จำนวน</th>
                                                <th>ราคา</th>
                                                <th>Tools</th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php } else if ($page == 'type') { ?>
                            <div class="app-wrapper">
                                <div class="app-content m-4">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-10">
                                                <!-- ฟอร์มเพิ่มข้อมูลสินค้า -->
                                                <div class="card">
                                                    <div class="card-header border-1" style="background-color:rgb(235, 249, 255)">
                                                        <img src="../image/logo.png" width="80" style="float: right;">
                                                        <h4 class="col mt-3">เพิ่มประเภทสินค้า</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <form method="post" action="backend/product.php" enctype="multipart/form-data">
                                                            <div class="mb-1">
                                                                <label class="form-label">ชื่อประเภทสินค้า</label>
                                                                <input type="text" class="form-control" name="typeName" required>
                                                            </div>
                                                            <div class="mb-4">
                                                                <label class="form-label">เพิ่มรูปประเภทสินค้า</label>
                                                                <input type="file" class="form-control" name="typeimg" required>
                                                            </div>
                                                            <div class="mb-1">
                                                                <input type="submit" class="btn" style="background-color: #28B031FF; color: white;" value="บันทึก" name="addType">
                                                                <a class="btn" style="background-color: #D5304EFF; color: white;">ยกเลิก</a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- ตารางแสดงรายการสินค้า -->
                                            <div class="col-lg-10 mt-4">
                                                <div class="card">
                                                    <div class="card-header" style="background-color:rgb(255, 230, 240)">
                                                        <img src="../image/information.png" width="50" style="float: right;">
                                                        <div class="col m-2">
                                                            <h3 style="font-weight: bold">ประเภทสินค้า</h3>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <table class="table table-bordered table-sm" style="text-align: center;">
                                                            <thead>
                                                                <tr>
                                                                    <th>รูปประเภทสินค้า</th>
                                                                    <th>ประเภทสินค้า</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $sql = "SELECT * FROM product_type";
                                                                $rs = mysqli_query($conn, $sql);

                                                                if (mysqli_num_rows($rs) > 0) {
                                                                    while ($rw = mysqli_fetch_assoc($rs)) { ?>
                                                                        <tr>
                                                                            <td><img src="../picture/<?php echo $rw['type_img']; ?>" alt="" width="30px"></td>
                                                                            <td><?php echo $rw['typeName']; ?></td>
                                                                            <td>
                                                                                <form action="backend/product.php" method="POST">
                                                                                    <input type="text" value="<?php echo $rw['typeID'] ?>" name="id" hidden>
                                                                                    <button class="btn" onclick="return confirm('ยืนยันการลบข้อมูล?');" type="submit" name="delType"><img src="../image/delete.png" width="30"></button>
                                                                                </form>
                                                                            </td>

                                                                        </tr>
                                                                    <?php }
                                                                } else { ?>
                                                                    <tr>
                                                                        <td colspan="5">ไม่มีข้อมูลสินค้า</td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } else if ($page == 'summary') { ?>
                            <div class="app-wrapper">
                                <h3 style="margin: 20px;">สรุปยอดคำสั่งซื้อ</h3>
                                <div class="app-content m-5">
                                    <div class="container">
                                        <div class="row">
                                            <!-- ฟอร์มกรองวันที่ -->
                                            <form method="GET" action="main.php">
                                                <input type="hidden" name="page" value="summary">
                                                <div class="row g-3">
                                                    <div class="col-md-4">
                                                        <label class="form-label">วันที่เริ่มต้น</label>
                                                        <input type="date" name="start_date" class="form-control"
                                                            value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-d'); ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">วันที่สิ้นสุด</label>
                                                        <input type="date" name="end_date" class="form-control"
                                                            value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d'); ?>">
                                                    </div>
                                                    <div class="col-md-4 align-self-end">
                                                        <button type="submit" class="btn btn-primary">แสดงรายงาน</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <?php
                                                    $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-d');
                                                    $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d');


                                                    $sql = $conn->query("SELECT 
                                                tb_orders.order_date,
                                                SUM(tb_orders.order_total) AS total_sales,
                                                COUNT(tb_orders.order_id) AS total_orders 
                                            FROM 
                                                tb_orders
                                            WHERE 
                                                tb_orders.order_date BETWEEN '$start_date' AND '$end_date'
                                            GROUP BY 
                                                tb_orders.order_date");

                                                    $total_sales = 0;
                                                    ?>
                                                    <h4>รายงานยอดขาย</h4>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>วันที่</th>
                                                                <th>ยอดขาย (บาท)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            while ($rw = $sql->fetch_assoc()) {
                                                                $total_sales += $rw['total_sales'];
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $rw['order_date']; ?></td>
                                                                    <td><?php echo number_format($rw['total_sales'], 2); ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                            <tr>
                                                                <td><b>รวม</b></td>
                                                                <td><b><?php echo number_format($total_sales, 2); ?></b></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                        </div>
                    </div>
            </div>
            <?php
            $sql = "SELECT * FROM product";
            $rs = mysqli_query($conn, $sql);
            while ($rw = mysqli_fetch_assoc($rs)) {
            ?>

                <!--Edit Product -->

                <div class="modal fade" id="editModal<?php echo $rw['proID'] ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <p class="modal-title fs-5" id="exampleModalLabel">แก้ไขข้อมูล</p>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="backend/product.php" enctype="multipart/form-data">
                                    <div class="mb-1">
                                        <label class="form-label">รหัสสินค้า</label>
                                        <input type="text" class="form-control" name="proID" value="<?php echo $rw['proID'] ?>" disabled>
                                    </div>

                                    <div class="mb-1">
                                        <label class="form-label">ชื่อสินค้า</label>
                                        <input type="text" class="form-control" name="proName" value="<?php echo $rw['proName']; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">ประเภทสินค้า</label>
                                        <select class="form-select" id="proType" name="proType" required>
                                            <?php
                                            $getType = "SELECT * FROM product_type";
                                            $res = mysqli_query($conn, $getType);
                                            while ($row = mysqli_fetch_assoc($res)) {
                                                $isSelected = ($row['typeID'] == $rw['proType']) ? 'selected' : '';
                                            ?>
                                                <option value="<?php echo $row['typeID']; ?>" <?php echo $isSelected; ?>><?php echo $row['typeName']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>


                                    <div class="mb-1">
                                        <label class="form-label">ราคาสินค้า</label>
                                        <input type="text" class="form-control" name="proPrice" value="<?php echo $rw['proPrice']; ?>">
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label">รายละเอียด</label>
                                        <textarea name="proDetail" class="form-control" cols="50" required><?php echo $rw['proDetail']; ?></textarea>

                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label">อัพโหลดรูป</label>
                                        <input type="file" class="form-control" name="pro_img" value="<?php echo $rw['pro_img']; ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <input type="text" value="<?php echo $rw['proID'] ?>" name="id" hidden>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>
                                        <button type="submit" class="btn btn-primary" name="edit">บันทึก</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php
            $sql = "SELECT * FROM tb_account WHERE level!='99'";
            $rs = mysqli_query($conn, $sql);
            while ($rw = mysqli_fetch_assoc($rs)) {
            ?>
                <!--Edit User-->

                <div class="modal fade" id="editUser<?php echo $rw['id'] ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">แก้ไขข้อมูล</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="backend/user.php" method="POST">
                                    <input type="text" hidden value="<?php echo $rw['id'] ?> " name="id">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Username</label>
                                        <input type="text" class="form-control" value="<?php echo $rw['username'] ?>" name="username">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Full name</label>
                                        <input type="text" class="form-control" value="<?php echo $rw['fullname'] ?>" name="fullname">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Level</label>
                                        <input type="text" class="form-control" value="<?php echo $rw['level'] ?>" name="level">
                                    </div>
                                    <button class="btn btn-success" type="submit" name="editUser">แก้ไข</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
</body>

</html>