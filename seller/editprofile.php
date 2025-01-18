<?php
include('../config.inc.php'); // Include your database connection file


$id = $_SESSION['id'];
$query = "SELECT * FROM tb_account WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if (isset($_POST['profile'])) {
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];

    $pro_img = "";
    if (!empty($_FILES["pro_img"]["tmp_name"])) {
        $img_type = pathinfo($_FILES["pro_img"]["name"], PATHINFO_EXTENSION);
        $pro_img = "img_" . uniqid() . "." . $img_type; // ตั้งชื่อไฟล์ใหม่
        move_uploaded_file($_FILES["pro_img"]["tmp_name"], "../image/" . $pro_img); // ย้ายไฟล์ไปยังโฟลเดอร์ uploads

        $update_query = "UPDATE tb_account SET username = '$username', fullname = '$fullname',image= '$pro_img' WHERE id = '$id'";
        mysqli_query($conn, $update_query);
    } else {
        $update_query = "UPDATE tb_account SET username = '$username', fullname = '$fullname' WHERE id = '$id'";
        mysqli_query($conn, $update_query);
    }

    header('Location: editprofile.php');
    exit();
}
if (isset($_POST['editpass'])) {
    $password = $_POST['password'];
    $conpassword = $_POST['conpassword'];
    if ($password == $conpassword) {
        $update_pass = "UPDATE tb_account SET password = '$password' WHERE id = '$id'";
        mysqli_query($conn, $update_pass);
    } else {
        echo "<script>alert('รหัสผ่านไม่ตรงกัน')</script>";
    }
    header('Location: editprofile.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/portal.css">
    <script src="../js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <?php include 'sidebar.php'; ?>
            <div class="col-md-6">
                <h2 class="text-center">แก้ไขข้อมูล</h2>
                <form action="editprofile.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $user['username']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fullname</label>
                        <input type="text" name="fullname" class="form-control" value="<?php echo $user['fullname']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Profile</label>
                        <input type="file" name="pro_img" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary text-light" name="profile">แก้ไข</button>
                </form>
                <h2 class="text-center mt-5">แก้ไขรหัสผ่าน</h2>

                <form action="editprofile.php" method="POST" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="name" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Confirm password</label>
                        <input type="password" name="conpassword" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary text-light" name="editpass">ยืนยัน</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
</body>

</html