<?php
include_once "../../config.inc.php";

if(isset($_POST['editUser'])){
    $id = $_POST['id'];
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $level = $_POST['level'];

    $sql = "UPDATE tb_account SET username='$username' ,fullname='$fullname',level='$level' WHERE id = '$id'";
    $rs = $conn->query($sql);
    header("Location: ../main.php?page=user");
}
if ($rs) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Success!',
                text: 'User updated successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../main.php?page=user';
                }
            });
        });
    </script>";
} else {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Error!',
                text: 'Failed to update user.',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../main.php?page=user';
                }
            });
        });
    </script>";
}


if(isset($_POST['delUser'])){
    $id = $_POST['id'];

    $sql = "DELETE FROM tb_account WHERE id = '$id'";
    $rs = $conn->query($sql);
    header("Location: ../main.php?page=user");
}
?>