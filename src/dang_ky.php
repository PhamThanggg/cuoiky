<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Đăng ký</title>
	<!-- Begin bootstrap cdn -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="	sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<!-- End bootstrap cdn -->

</head>
<body>
        <?php
            include '../function.php';
            
			if(isset($_POST['submitLogin'])){
                $tk = $_POST['username'];
                $mk = $_POST['password'];
                $remk = $_POST['repassword'];
                $gmail = $_POST['email'];

                if($tk==""){
                    echo '<div class="alert alert-danger text-center" role="alert">Bạn chưa nhập tên tài khoản</div>';
                }elseif($mk==""){
                    echo '<div class="alert alert-danger text-center" role="alert">Bạn chưa nhập mật khẩu </div>';
                }elseif($remk==""){
                    echo '<div class="alert alert-danger text-center" role="alert">Bạn chưa nhập lại mật khẩu </div>';
                }elseif($gmail==""){
                    echo '<div class="alert alert-danger text-center" role="alert">Bạn chưa nhập email </div>';
                }else{
                    if($mk == $remk){
                        if(checkRegister($tk, $mk, $gmail)){
                            echo '<div class="alert alert-success text-center" role="alert">Đăng ký thành công</div>';
                        }
                    }else{
                        echo '<div class="alert alert-danger text-center" role="alert">Mật khẩu không trùng nhau</div>';
                    }
                }
            }
		
		?>

	
	<main style="min-height: 100vh; margin-top: 10%;">
		<div class="d-flex justify-content-center"><h1>Đăng ký</h1></div>
		<div class="d-flex justify-content-center">
			<form class="w-25" method="POST">
				<div class="mb-3">
				  <label for="username" class="form-label">Tên tài khoản</label>
				  <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên tài khoản" value="<?php saveInputPOST('submitLogin', 'username') ?>">
				</div>
				<div class="mb-3">
				    <label for="inputPassword" class="form-label">Mật khẩu</label>
				    <div class="col">
				      <input type="password" class="form-control" id="inputPassword" placeholder="Nhập mật khẩu" name="password" value="<?php //saveInputPOST('submitLogin', 'password') ?>">
				    </div>
				</div>
                <div class="mb-3">
				    <label for="inputPassword" class="form-label">Nhập lại mật khẩu</label>
				    <div class="col">
				      <input type="password" class="form-control" id="inputPassword" placeholder="Nhập lại mật khẩu" name="repassword" value="<?php //saveInputPOST('submitLogin', 'repassword') ?>">
				    </div>
				</div>
                <div class="mb-3">
				    <label for="inputPassword" class="form-label">Địa chỉ email</label>
				    <div class="col">
				      <input type="email" class="form-control" id="inputPassword" placeholder="Nhập đia chỉ email" name="email" value="<?php saveInputPOST('submitLogin', 'email') ?>">
				    </div>
				</div>
				<input type="submit" class="btn btn-primary" name="submitLogin" value="Đăng ký">
				<a href="dang_nhap.php">Đăng nhập</a>
			  </form>
		</div>
		
	</main>
	<?php include 'footer.php'; ?>
</body>

	
</html>