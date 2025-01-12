<?php
include_once "../../config.inc.php";

if (isset($_POST['addCart'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $img = $_POST['img'];
    $typeid = $_POST['typeID'];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] += 1;
    } else {
        $_SESSION['cart'][$id] = [
            'name' => $name,
            'price' => $price,
            'quantity' => 1,
            'img' => $img
        ];
    }

    if ($typeid) {
        header("Location: ../../customer/main.php?type=$typeid");
    } else {
        header("Location: ../../customer/main.php");
    }
    exit();
}

$total = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }
}

if (isset($_POST['buy'])) {
    $fname = $_POST['fname'];
    $total = $_POST['total'];
    $date = date('Y-m-d H:i:s');
    $userId = $_POST['id'];

    $order = "INSERT INTO orders (orderFname, orderTotal, orderStatus, orderUid, orderDate) 
              VALUES ('$fname', '$total', '0', '$userId', '$date')";
    mysqli_query($conn, $order);

    $oid = mysqli_insert_id($conn);

    foreach ($_SESSION['cart'] as $itemId => $item) {
        $productName = $item['name'];
        $productPrice = $item['price'];
        $productQty = $item['quantity'];
        $productId = $itemId;

        $sql = "INSERT INTO orders_detail(productName, productPrice, productQty, orderID , proID ) 
                VALUES ('$productName', '$productPrice', '$productQty', '$oid', '$productId')";
        mysqli_query($conn, $sql);
    }

    unset($_SESSION['cart']);

    header("Location: ../../customer/main.php");
}
