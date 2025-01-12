<?php
include_once "../config.inc.php";
?>

<header class="app-header" >
    <div class="app-sidepanel" >
        <div class="sidepanel-inner d-flex flex-column">
            <div class="app-branding">
                <a class="app-logo" href="main.php?page=main"><img class="logo-icon me-2" src="../image/logoShop.png"><span class="logo-text">BIEWIE | SHOPs</span></a>
            </div>
            <nav id="app-nav-main" class="app-nav app-nav-main " >
                <ul class="app-menu list-unstyled accordion">
               
                    <hr>
                    <li class="nav-item text-center">
                        <h4 class="nav-link-text"><b>หมวดหมู่</b></h4>
                    </li>
                    <li class="nav-item text-center">
                        <h5 class="mt-5"><a class="text-decoration-none" href="main.php">ทั้งหมด</a></h5>
                    </li>
                    <?php 
                        $getType = "SELECT * FROM product_type";
                        $rs = mysqli_query($conn,$getType);
                        while($rw = mysqli_fetch_assoc($rs)){
                    
                    ?>
                    <li class="nav-item text-center mt-5">
                        <a class="text-decoration-none" href="main.php?type=<?php echo $rw['typeID'] ?>">
                         <img src="../picture/<?php echo $rw['type_img']?>"  width="70px">
                            <p class="nav-link-text mt-3" style="font-size:1.1rem;"><?php echo $rw['typeName']?></p>
                        </a>
                    </li>
                    <?php }?>
                </ul>
            </nav>
        </div>
    </div>
</header>
