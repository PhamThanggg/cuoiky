<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Đăng nhập</title>
	<!-- Begin bootstrap cdn -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="	sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<!-- End bootstrap cdn -->

</head>
<body>
<?php
            include '../function.php';
			session_start();
            
			if(isset($_POST['submitLogin'])){
                $tk = $_POST['username'];
                $mk = $_POST['password'];

                if($tk==""){
                    echo '<div class="alert alert-danger text-center" role="alert">Bạn chưa nhập tên tài khoản</div>';
                }elseif($mk==""){
                    echo '<div class="alert alert-danger text-center" role="alert">Bạn chưa nhập mật khẩu </div>';
                }else{
                    if(checkLogin($tk, $mk)){
						// $_SESSION['user'] = $tk;
                        header("location: khoa_hoc.php");
                    }else{
						echo '<div class="alert alert-danger text-center" role="alert">Tài khoản hoặc mật khẩu không chính xác</div>';
					}
                }
            }
		
		?>

	<main style="min-height: 100vh; margin-top: 10%;">
		<div class="d-flex justify-content-center"><h1>Đăng nhập</h1></div>
		<div class="d-flex justify-content-center">
			<form class="w-25" method="POST">
				<div class="mb-3">
				  <label for="username" class="form-label">Tài khoản</label>
				  <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên tài khoản" value="<?php saveInputPOST('submitLogin', 'username') ?>">
				</div>
				<div class="mb-3">
				    <label for="inputPassword" class="form-labell">Mật khẩu</label>
				    <div class="col">
				      <input type="password" class="form-control" id="inputPassword" placeholder="Nhập mật khẩu" name="password">
				    </div>
				</div>
				<input type="submit" class="btn btn-primary" name="submitLogin" value="Đăng nhập">
				<a href="dang_ky.php">Đăng ký</a>
				<a href="quen_mk.php">Quên mật khẩu</a>
			  </form>
		</div>

		<?php

		
		?>


		
	</main>
	<?php include 'footer.php'; ?>
</body>

	
</html>