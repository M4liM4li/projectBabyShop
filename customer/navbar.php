<?php
include_once "../config.inc.php";
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$total = 0;

if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    unset($_SESSION['cart'][$id]);
    header("Location: main.php");
    exit();
}

?>
<style>
    .custom-navbar {
        background-color: rgb(224, 61, 115);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .busket {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: white;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .dropdown-item-img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 2px solid #000;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg px-5 custom-navbar">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars text-white" style="font-size:24px"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto text-center">
                <a href="main.php?page=home" class="nav-item nav-link text-white">หน้าหลัก</a>
                <a href="#" class="nav-item nav-link text-white">ติดต่อ</a>
            </div>
            <div class="nav-item dropdown ms-auto d-flex align-items-center">
                <button class="me-4 busket" type="button" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas" aria-controls="cartOffcanvas">
                    <img src="../image/basket11.png" alt="Cart" width="30px">
                </button>
                <a href="#" class="nav-link dropdown-toggle d-flex align-items-center text-white" data-bs-toggle="dropdown">
                    <img src="../image/<?php echo getUid($_SESSION['id'])['image']?>" class="dropdown-item-img" alt="User">
                    <span class="ms-2"><?php echo getUid($_SESSION['id'])['fullname']?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end mt-3">
                    <li><a href="editprofile.php" class="dropdown-item">แก้ไขข้อมูลส่วนตัว</a></li>
                    <li><a href="#" class="dropdown-item">สถานะคำสั่งซื้อ</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a href="../index.php" class="dropdown-item">ออกจากระบบ</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 id="cartOffcanvasLabel">ตะกร้าสินค้า</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body ">
            <?php if (empty($_SESSION['cart'])): ?>
                <p>ตะกร้าของคุณยังไม่มีสินค้า</p>
            <?php else: ?>
                <ul class="list-group">
                    <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center ">
                            <img src="../product/<?php echo $item['img']; ?>" class="img-fluid" style="width: 50px; height: 50px; object-fit: cover;">
                            <span class="ms-2"><?php echo $item['name']; ?></span>
                            <span class="mx-2"><?php echo $item['quantity']; ?></span>
                            <a href="?remove=<?php echo $id; ?>" class="btn btn-sm btn-danger">ลบ</a>
                        </li>
                        <?php
                        $total += $item['price'] * $item['quantity'];
                        ?>
                    <?php endforeach; ?>
                </ul>

                <div class="mt-4">
                    <h6>ยอดรวม: <span class="text-primary"><?php echo number_format($total, 2); ?> บาท</span></h6>
                    <form action="../admin/backend/cart.php" method="POST" enctype="multipart/form-data">
                        <label for="paymentSlip" class="mt-5 mb-2">แนบสลิปชำระเงิน</label>
                        <input type="file" class="form-control" id="paymentSlip" required name="paymentSlip" class="mb-3 mt-5">

                        <input type="hidden" name="fname" value="<?php echo getUid($_SESSION['id'])['fullname'] ?>">
                        <input type="hidden" name="total" value="<?php echo $total ?>">
                        <input type="hidden" name="id" value="<?php echo $_SESSION['id'] ?>">

                        <?php foreach ($_SESSION['cart'] as $itemId => $itemQty) {
                            $getItem = "SELECT * FROM product WHERE proID = '$itemId'";
                            $rs = mysqli_query($conn, $getItem);
                            $gT = mysqli_fetch_assoc($rs);

                            if ($gT) {
                        ?>
                                <input type="hidden" name="product[<?php echo $itemId ?>][name]" value="<?php echo $item['name'] ?>">
                                <input type="hidden" name="product[<?php echo $itemId ?>][price]" value="<?php echo $item['price'] ?>">
                                <input type="hidden" name="product[<?php echo $itemId ?>][qty]" value="<?php echo $item['quantity'] ?>">
                        <?php }
                        } ?>
                        <button class="btn btn-success w-100 mt-3" type="submit" name="buy">ยืนยันการสั่งซื้อ</button>
                    </form>
                </div>

            <?php endif; ?>
        </div>
    </div>


</body>