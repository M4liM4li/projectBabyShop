<?php
    include 'config.inc.php';

    if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
        session_destroy();
        header("Location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.boundle.js"></script>
    <title>Document</title>
</head>
<body>
    
    <div class="login">
        <form method="post" action="?login" class="mt-5" style="text-align: center;">
            <h3 style="text-align: center;">LOGIN</h3>
            <div class="container fluid">
             <div class="col-lg-3 m-auto mt-3">
              <input class="form-control" type="text" name="username" placeholder="User *" required>
             </div>
            </div>
            <div class="container fluid">
             <div class="col-lg-3 m-auto mt-3">
             <input class="form-control" type="password" name="password" placeholder="Password *" required>
             </div>
            </div>
            <div class="container fluid">
             <div class="col-lg-3 m-auto mt-3">
             <button class="btn btn-success" type="submit">LOGIN</button>
             </div>
            </div>
            
            
            <?php
                if (isset($_GET['login'])) {
                    $user = $_POST['username'];
                    $pass = $_POST['password'];

                    // ค้นหาผู้ใช้ในฐานข้อมูล
                    $mysql = "SELECT * FROM tb_account WHERE username = '$user' AND password = '$pass'";
                    $res = $conn->query($mysql);

                    if ($res->num_rows > 0) {
                        $rw = $res->fetch_assoc();

                        // ตรวจสอบ level
                        if ($rw['level'] == 99) { // เมื่อเข้า admin
                            $_SESSION['id'] = $rw['id'];
                            header("Location: admin/main.php?page=home");
                            exit();
                        } else if ($rw['level'] == 1) { //เมื่อเข้า user
                            $_SESSION['id'] = $rw['id'];
                            header("Location: customer/main.php?page=main");
                            exit();
                        } else if ($rw['level'] == 50) { //เมื่อเข้า user
                            $_SESSION['id'] = $rw['id'];
                            header("Location: seller/main.php?page=home");
                            exit();
                        } else {
                            echo '<div class="alert alert-warning mt-2" role="alert">
                                    ไม่พบสิทธิ์ที่ถูกต้อง
                                  </div>';
                        }
                    } else {
                        // แจ้งเตือนเมื่อ username หรือ password ไม่ถูกต้อง
                        echo '<div class="alert alert-danger mt-2" role="alert mt-3">
                                Username หรือ Password ไม่ถูกต้อง
                              </div>';
                              
                    }
                }
            ?>
        </form>
    </div>
</body>
</html>
