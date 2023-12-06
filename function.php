<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// check login session
function isLogin() {
	// hàm kiểm tra đã đăng nhập chưa
	if(isset($_SESSION['user'])) {
		return true;
	} else {
		return false;
	}
}

// Begin ham lưu giá trị ô input post
function saveInputPOST($btn, $name) {
	if(isset($_POST[$btn])) {
		echo isset($_POST[$name]) ? $_POST[$name] : '';
	}
}

// ham lưu giá trị ô input get
function saveInputGET($btn, $name) {
	if(isset($_GET[$btn])) {
		echo isset($_GET[$name]) ? $_GET[$name] : '';
	}
}

// begin checkLogin
function checkLogin($username, $password) {
	include 'connectdb.php';
	$count = 0;
	$mksql = "SELECT * FROM user";
	$tkk = mysqli_query($conn, $mksql);
	while($row = mysqli_fetch_assoc($tkk)) {
		$passMD5 = md5($password);
		if($row["user_name"] == $username && $row["password"] == $passMD5) {
			$_SESSION["role"] = $row["role"];
			$count++;
			if($row["ho_ten"] != "") {
				$get_ht = $row["ho_ten"];
			} else {
				$get_ht = 'user';
			}

			$_SESSION['acc'] = array(
				'id' => $row["id_user"],
				'user' => $row["user_name"],
				'hoten' => $get_ht,
				'level' => $row["level"],
				'gmail' => $row["gmail"],
				'role' => $row["role"]
			);
			break;
		}
	}

	if($count == 1) {
		return true;
	} else {
		return false;
	}
}
// end checkLogin

// check register
function checkRegister($tk, $mk, $gmail) {
	include 'connectdb.php';
	$count = 0;
	$countG = 0;
	$mksql = "SELECT * FROM user";
	$tkk = mysqli_query($conn, $mksql);
	while($row = mysqli_fetch_assoc($tkk)) {
		if($row["user_name"] == $tk) {
			$count++;
		}
		if($row["gmail"] == $gmail) {
			$countG++;
		}
	}
	if($count == 0 && $countG == 0) {
		$pasMD5 = md5($mk);
		$sql = "INSERT INTO user (`user_name`, `password`, gmail) VALUES ('$tk', '$pasMD5', '$gmail')";
		if(mysqli_query($conn, $sql)) {
			return true;
		} else {
			return false;
		}
	} elseif($count != 0) {
		echo '<div class="alert alert-danger text-center" role="alert">Tên tài khoản tồn tại</div>';
	} elseif($countG != 0) {
		echo '<div class="alert alert-danger text-center" role="alert">Gmail đã được sử dụng trong hệ thống</div>';
	}
}

// ham send email
function sendEmail($to, $subject, $message) {
	//Create an instance; passing `true` enables exceptions
	$mail = new PHPMailer(true);

	try {
		//Server settings
		// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'ngocngo8080@gmail.com';
		$mail->Password = 'rgczrzrcjxepufgl';
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
		$mail->Port = 465;

		//Recipients
		$mail->setFrom('ngocngo8080@gmail.com', 'CanDyy');
		$mail->addAddress($to);

		//Content
		$mail->isHTML(true);
		$mail->Subject = $subject;
		$mail->Body = $message;

		$mail->send();
		echo 'Message has been sent';
	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
}

// ham check tk co ko
function checkAccount($tk) {
	include 'connectdb.php';
	$count = 0;
	$mksql = "SELECT * FROM user";
	$tkk = mysqli_query($conn, $mksql);
	while($row = mysqli_fetch_assoc($tkk)) {
		if($row["gmail"] == $tk) {
			$count++;
			break;
		}
	}

	if($count == 1) {
		return true;
	} else {
		return false;
	}
}

// check gmail khi update
function checkAccountGmail($tk) {
	include 'connectdb.php';
	$count = 0;
	if($tk == $_SESSION['acc']['gmail']) {
		$count++;
	}
	$mksql = "SELECT * FROM user";
	$tkk = mysqli_query($conn, $mksql);
	while($row = mysqli_fetch_assoc($tkk)) {
		if($row["gmail"] == $tk) {
			$count++;
		}
	}

	if($count == 2 || $count == 0) {
		return true;
	} else {
		return false;
	}
}

// ham update mat khau
function updateAccount($tk, $mk) {
	include 'connectdb.php';
	$sql = "UPDATE `user` SET `password`='$mk' WHERE `gmail` = '$tk'";
	$tkk = mysqli_query($conn, $sql);
}

// cập nhật thông tin tài khoản
function updateAccountInfo($tk, $ht, $gmail) {
	include 'connectdb.php';
	if(checkAccountGmail($gmail)) {
		$sql = "UPDATE `user` SET `ho_ten`='$ht', `gmail`='$gmail' WHERE `user_name` = '$tk'";
		if(mysqli_query($conn, $sql)) {
			return true;
		} else {
			return false;
		}
	}
}

// Đổi mật khẩu
function updateAccountPass($id, $mkO, $mk) {
	include 'connectdb.php';
	$passMD5 = md5($mk);

	$mksql = "SELECT `password` FROM user WHERE `id_user`='$id'";
	$tkk = mysqli_query($conn, $mksql);
	while($row = mysqli_fetch_assoc($tkk)) {
		$passO = $row['password'];
	}

	if($passO == md5($mkO)) {
		$sql = "UPDATE `user` SET `password`='$passMD5' WHERE `id_user` = '$id'";
		if(mysqli_query($conn, $sql)) {
			return true;
		} else {
			return false;
		}

	} else {
		echo '<div class="alert alert-danger text-center" role="alert">Mật khẩu cũ không chính xác</div>';
	}
}
