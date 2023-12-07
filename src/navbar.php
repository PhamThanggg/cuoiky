<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="khoa_hoc.php">Khóa học</a>
    <a class="navbar-brand" href="#">kỳ thi</a>
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
            session_start();
            if (isset($_SESSION['user'])) {
              echo $_SESSION['user'];
            }
            ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <form action="" method="post">
              <?php
                if($_SESSION["acc"]["role"] == "1"){
                  echo "<li><a style='padding-left: 22px;' class='dropdown-item' href='admin.php'>Admin</a></li>";
                }
              ?>
              <li><a class="dropdown-item" href=""><input type="submit" name="sm_info" value="Hồ sơ của bạn"
                    style="border: none; font-size: 16px; background: rgba(255, 255, 255, 0);"></a></li>
              <li><a class="dropdown-item" href=""><input type="submit" name="sm_ls" value="Lịch sử"
                    style="border: none; font-size: 16px; background: rgba(255, 255, 255, 0);"></a></li>
              <li><a class="dropdown-item" href=""><input type="submit" name="sm_dmk" value="Đổi mật khẩu"
                    style="border: none; font-size: 16px; background: rgba(255, 255, 255, 0);"></a></li>
              <li><a class="dropdown-item" href=""><input type="submit" name="sm" value="Đăng xuất"
                    style="border: none; font-size: 16px; background: rgba(255, 255, 255, 0);"></a></li>
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

// sang trang thông tin tài khoản
if (isset($_POST['sm_info'])) {
  header('location: thong_tinTK.php');
}

//
if (isset($_POST['sm_ls'])) {

}

// đổi mật khẩu
if (isset($_POST['sm_dmk'])) {
  header('location: doi_mk.php');

}

?>