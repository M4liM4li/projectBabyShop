<style>
 .dropdown-item-img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: 2px solid #000; 
    cursor: pointer;
}

.custom-navbar {
    background-color: white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
</style>
<nav class="navbar navbar-expand-lg px-5 custom-navbar" style="background-color:rgb(26, 112, 205);">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>

        <div class="nav-item dropdown ms-auto d-flex align-items-center">
            <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                <img src="../image/cat6.jpg" class="dropdown-item-img" alt="Profile Image">
                <span class="ms-2 text-white">Admin</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end custom-dropdown mt-2" >
                <a href="editprofile.php" class="dropdown-item">แก้ไขข้อมูลส่วนตัว</a>
                <a href="#" class="dropdown-item">ติดต่อ</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../index.php">ออกจากระบบ</a>
            </div>
        </div>
    </div>
</nav>
