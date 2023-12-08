<nav class="navbar navbar-expand-lg navbar-light bg-light" style="position: fixed;z-index:1000;left:0;right:0;top:0">
  <div class="container-fluid">
    <a class="navbar-brand" href="khoa_hoc.php">Khóa học</a>
    <a class="navbar-brand" href="#">Kỳ thi</a>
    <?php   
    session_start();
    if ($_SESSION["acc"]["role"] == "1") {
      echo "<a class='navbar-brand' href='admin.php'>Admin</a>";
    }
    ?>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            <?php                    
            if (isset($_SESSION['user'])) {
              echo $_SESSION['user'];
            }
            ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <form action="" method="post">
              <li><a class="dropdown-item" style='padding-left: 22px;color:#212529' href="thong_tinTK.php">Hồ sơ của bạn</a></li>
              <li><a class="dropdown-item" style='padding-left: 22px;color:#212529' href="">Lịch sử</a></li>
              <li><a class="dropdown-item" style='padding-left: 22px;color:#212529' href="doi_mk.php">Đổi mật khẩu</a></li>
              <li><a class="dropdown-item" style='padding-left: 17px;color:#212529' href=""><input type="submit"
                    name="sm" value="Đăng xuất"
                    style="border: none; font-size: 14px; background: rgba(255, 255, 255, 0);"></a></li>
            </form>
          </ul>

        </li>
      </ul>
    </div>
  </div>
</nav>

<?php
// đăng xuất
if (isset($_POST['sm'])) {
  unset($_SESSION['acc']);
  header("location: dang_nhap.php");
}
?>