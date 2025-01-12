<?php
include_once "../../config.inc.php";
if (isset($_POST['add'])) {
    $proname = $_POST['proName'];
    $protype = $_POST['proType'];
    $proprice = $_POST['proPrice'];
    $prodetail = $_POST['proDetail'];

    // จัดการอัปโหลดไฟล์
    $pro_img = "";
    if (!empty($_FILES["pro_img"]["tmp_name"])) {
        $img_type = pathinfo($_FILES["pro_img"]["name"], PATHINFO_EXTENSION);
        $pro_img = "img_" . uniqid() . "." . $img_type; // ตั้งชื่อไฟล์ใหม่
        move_uploaded_file($_FILES["pro_img"]["tmp_name"], "../../product/" . $pro_img); // ย้ายไฟล์ไปยังโฟลเดอร์ uploads
    }

    // ป้องกันการเกิด SQL Injection และการใช้เครื่องหมายอัญประกาศในข้อมูล
    $proname = mysqli_real_escape_string($conn, $proname);
    $protype = mysqli_real_escape_string($conn, $protype);
    $prodetail = mysqli_real_escape_string($conn, $prodetail);

    // ดึงข้อมูลรหัสสินค้าล่าสุด
    $sql_last_id = "SELECT MAX(proID) AS last_id FROM product";
    $rs_last_id = $conn->query($sql_last_id);
    $last_id = $rs_last_id->num_rows > 0 ? $rs_last_id->fetch_assoc()['last_id'] : '88000000000';
    $new_id_number = (int)substr($last_id, 2) + 1;
    $new_id = '88' . str_pad($new_id_number, 9, '0', STR_PAD_LEFT);

    // เพิ่มข้อมูลในฐานข้อมูล
    $sql = "INSERT INTO product (proID, proName, proType, proPrice, proDetail, pro_img) 
            VALUES ('$new_id', '$proname', '$protype', '$proprice', '$prodetail', '$pro_img')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../main.php?page=product");
        exit();
    }
} else if (isset($_POST['edit'])) {
    $proid = $_POST['id'];
    $proname = $_POST['proName'];
    $protype = $_POST['proType'];
    $proprice = $_POST['proPrice'];
    $prodetail = $_POST['proDetail'];


    $pro_img = "";
    if (!empty($_FILES["pro_img"]["tmp_name"])) {
        $img_type = pathinfo($_FILES["pro_img"]["name"], PATHINFO_EXTENSION);
        $pro_img = "img_" . uniqid() . "." . $img_type; // ตั้งชื่อไฟล์ใหม่
        move_uploaded_file($_FILES["pro_img"]["tmp_name"], "../../product/" . $pro_img); // ย้ายไฟล์ไปยังโฟลเดอร์ uploads


        $sql = "UPDATE product SET proName='$proname', proType='$protype', proPrice='$proprice',proDetail='$prodetail', pro_img='$pro_img' WHERE proID='$proid'";
        $rs = $conn->query($sql);
        if ($rs) {
            echo '<script>
                    Swal.fire({
                        title: "สำเร็จ!!",
                        text: "แก้ไขข้อมูลได้แล้ว!",
                        icon: "success"
                    });
                </script>';
        } else {
            echo '<script>
                    Swal.fire({
                        title: "เกิดข้อผิดพลาด!",
                        text: "ไม่สามารถแก้ไขข้อมูลได้",
                        icon: "error"
                    });
                </script>';
        }
        header("Location: ../main.php?page=product");
    }
    $sql = "UPDATE product SET proName='$proname', proType='$protype', proPrice='$proprice',proDetail='$prodetail' WHERE proID='$proid'";
    $rs = $conn->query($sql);
    if ($rs) {
        echo '<script>
                    Swal.fire({
                        title: "สำเร็จ!!",
                        text: "แก้ไขข้อมูลได้แล้ว!",
                        icon: "success"
                    });
                </script>';
    } else {
        echo '<script>
                    Swal.fire({
                        title: "เกิดข้อผิดพลาด!",
                        text: "ไม่สามารถแก้ไขข้อมูลได้",
                        icon: "error"
                    });
                </script>';
    }
    header("Location: ../main.php?page=product");
}
if (isset($_POST['delProduct'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM product WHERE proID = '$id'";
    $rs = $conn->query($sql);
    header("Location: ../main.php?page=product");
}
if (isset($_POST['addType'])) {
    $typeName = $_POST['typeName'];
    $typeimg = "";
    if (!empty($_FILES["typeimg"]["tmp_name"])) {
        $img_type = pathinfo($_FILES["typeimg"]["name"], PATHINFO_EXTENSION);
        $typeimg = "img_" . uniqid() . "." . $img_type; // ตั้งชื่อไฟล์ใหม่
        move_uploaded_file($_FILES["typeimg"]["tmp_name"], "../../picture/" . $typeimg); // ย้ายไฟล์ไปยังโฟลเดอร์ uploads

        $sql = "INSERT INTO product_type(typeName,type_img)VALUE('$typeName','$typeimg')";
        $rs = $conn->query($sql);
        header("Location: ../main.php?page=type");
    }
}

if (isset($_POST['delType'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM product_type WHERE typeID = '$id'";
    $rs = $conn->query($sql);
    header("Location: ../main.php?page=type");
}
