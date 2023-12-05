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
            require_once('phpmailer/Exception.php');
            require_once('phpmailer/PHPMailer.php');
            require_once('phpmailer/SMTP.php');
            include '../function.php';            
			session_start();
            
			if(isset($_POST['submitLogin'])){
                $tk = $_POST['username'];

                if($tk==""){
                    echo '<div class="alert alert-danger text-center" role="alert">Bạn chưa nhập tên tài khoản</div>';
                }else{
                    if(checkAccount($tk)){
                        $random = rand(100000, 999999);
                        $passMD5 = md5($random);
                        sendEmail($tk, "New passwork", $random);
                        updateAccount($tk, $passMD5);
                        header("location: khoa_hoc.php");
                    }else{
						echo '<div class="alert alert-danger text-center" role="alert">Tài khoản hoặc mật khẩu không chính xác</div>';
					}
                }
            }
		
		?>

	<main style="min-height: 100vh; margin-top: 10%;">
		<div class="d-flex justify-content-center"><h1>Quên mật khẩu</h1></div>
		<div class="d-flex justify-content-center">
			<form class="w-25" method="POST">
				<div class="mb-3">
				  <label for="username" class="form-label">Email</label>
				  <input type="text" class="form-control" id="username" name="username" placeholder="Nhập email" value="<?php saveInputPOST('submitLogin', 'username') ?>">
				</div>				
				<input type="submit" class="btn btn-primary" name="submitLogin" value="Xác nhận">
				<a href="dang_nhap.php">Đăng nhập</a>
			  </form>
		</div>

		<?php

		
		?>


		
	</main>
	<?php include 'footer.php'; ?>
</body>

	
</html>