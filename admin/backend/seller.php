<?php

include_once "../../config.inc.php";


if(isset($_POST['prepare'])){
    $id = $_POST['id'];
    $sql ="UPDATE orders SET orderStatus='1' WHERE orderID='$id'";
    $rs = $conn->query($sql);
    header("Location: ../../seller/main.php?page=order");
}
if(isset($_POST['delivery'])){
    $id = $_POST['id'];
    $sql ="UPDATE orders SET orderStatus='2' WHERE orderID='$id'";
    $rs = $conn->query($sql);
    header("Location: ../../seller/main.php?page=order");
}