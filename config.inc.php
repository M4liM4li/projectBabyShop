<?php
$host = "localhost";
$user_con = "root";
$pass_con = "";
$db = "sales";

session_start();
$conn = mysqli_connect($host, $user_con, $pass_con, $db);
mysqli_set_charset($conn, "utf8");

function getUid($uid)
{
    global $conn;
    $sql = "SELECT * FROM tb_account WHERE id = '$uid'";
    $rs = mysqli_query($conn, $sql);
    $rw = mysqli_fetch_assoc($rs);
    return $rw;
};
