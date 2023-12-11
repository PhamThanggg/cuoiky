<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// check login session
function isLogin()
{
	// hàm kiểm tra đã đăng nhập chưa
	if (isset($_SESSION['acc']['user'])) {
		return true;
	} else {
		return false;
	}
}

// Begin ham lưu giá trị ô input post
function saveInputPOST($btn, $name)
{
	if (isset($_POST[$btn])) {
		echo isset($_POST[$name]) ? $_POST[$name] : '';
	}
}

// ham lưu giá trị ô input get
function saveInputGET($btn, $name)
{
	if (isset($_GET[$btn])) {
		echo isset($_GET[$name]) ? $_GET[$name] : '';
	}
}

// begin checkLogin
function checkLogin($username, $password)
{
	include 'connectdb.php';
	$count = 0;
	$mksql = "SELECT * FROM user";
	$tkk = mysqli_query($conn, $mksql);
	while ($row = mysqli_fetch_assoc($tkk)) {
		$passMD5 = md5($password);
		if ($row["user_name"] == $username && $row["password"] == $passMD5) {
			$_SESSION["role"] = $row["role"];
			$count++;
			if ($row["ho_ten"] != "") {
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

	if ($count == 1) {
		return true;
	} else {
		return false;
	}
}
// end checkLogin

// check register
function checkRegister($tk, $mk, $gmail)
{
	include 'connectdb.php';
	$count = 0;
	$countG = 0;
	$mksql = "SELECT * FROM user";
	$tkk = mysqli_query($conn, $mksql);
	while ($row = mysqli_fetch_assoc($tkk)) {
		if ($row["user_name"] == $tk) {
			$count++;
		}
		if ($row["gmail"] == $gmail) {
			$countG++;
		}
	}
	if ($count == 0 && $countG == 0) {
		$pasMD5 = md5($mk);
		$sql = "INSERT INTO user (`user_name`, `password`, gmail) VALUES ('$tk', '$pasMD5', '$gmail')";
		if (mysqli_query($conn, $sql)) {
			return true;
		} else {
			return false;
		}
	} elseif ($count != 0) {
		echo '<div class="alert alert-danger text-center" role="alert">Tên tài khoản tồn tại</div>';
	} elseif ($countG != 0) {
		echo '<div class="alert alert-danger text-center" role="alert">Gmail đã được sử dụng trong hệ thống</div>';
	}
}

// ham send email
function sendEmail($to, $subject, $message)
{
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
function checkAccount($tk)
{
	include 'connectdb.php';
	$count = 0;
	$mksql = "SELECT * FROM user";
	$tkk = mysqli_query($conn, $mksql);
	while ($row = mysqli_fetch_assoc($tkk)) {
		if ($row["gmail"] == $tk) {
			$count++;
			break;
		}
	}

	if ($count == 1) {
		return true;
	} else {
		return false;
	}
}

// check gmail khi update
function checkAccountGmail($tk)
{
	include 'connectdb.php';
	$count = 0;
	if ($tk == $_SESSION['acc']['gmail']) {
		$count++;
	}
	$mksql = "SELECT * FROM user";
	$tkk = mysqli_query($conn, $mksql);
	while ($row = mysqli_fetch_assoc($tkk)) {
		if ($row["gmail"] == $tk) {
			$count++;
		}
	}

	if ($count == 2 || $count == 0) {
		return true;
	} else {
		return false;
	}
}

// ham update mat khau
function updateAccount($tk, $mk)
{
	include 'connectdb.php';
	$sql = "UPDATE `user` SET `password`='$mk' WHERE `gmail` = '$tk'";
	$tkk = mysqli_query($conn, $sql);
}

// cập nhật thông tin tài khoản
function updateAccountInfo($tk, $ht, $gmail)
{
	include 'connectdb.php';
	if (checkAccountGmail($gmail)) {
		$sql = "UPDATE `user` SET `ho_ten`='$ht', `gmail`='$gmail' WHERE `user_name` = '$tk'";
		if (mysqli_query($conn, $sql)) {
			return true;
		} else {
			return false;
		}
	}
}

// Đổi mật khẩu
function updateAccountPass($id, $mkO, $mk)
{
	include 'connectdb.php';
	$passMD5 = md5($mk);

	$mksql = "SELECT `password` FROM user WHERE `id_user`='$id'";
	$tkk = mysqli_query($conn, $mksql);
	while ($row = mysqli_fetch_assoc($tkk)) {
		$passO = $row['password'];
	}

	if ($passO == md5($mkO)) {
		$sql = "UPDATE `user` SET `password`='$passMD5' WHERE `id_user` = '$id'";
		if (mysqli_query($conn, $sql)) {
			return true;
		} else {
			return false;
		}

	} else {
		echo '<div class="alert alert-danger text-center" role="alert">Mật khẩu cũ không chính xác</div>';
	}
}

// ham insert cau hoi
function insertCauHoi($question, $da, $arr, $type, $img, $id)
{
	include 'connectdb.php';
	$user = $_SESSION["acc"]["id"];
	$stt = 0;
	if ($_SESSION["acc"]["role"] == 1) {
		$stt = 1;
	}
	$sql = "INSERT INTO `cau_hoi` (`ten_cau_hoi`, `dap_an`, `correct`,`loai_cau_hoi`, `anh_cau_hoi`, `id_user_them`, `id_khoa_hoc`, `status`) VALUES ('$question' ,'$da', '$arr', '$type', '$img', '$user', '$id',$stt)";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		return true;
	} else {
		return false;
	}
}

// ham update cau hoi
function updateCauHoi($question, $da, $arr, $img, $id)
{
	include 'connectdb.php';
	$sql = "UPDATE `cau_hoi` SET `ten_cau_hoi`='$question',`dap_an`='$da', `correct`='$arr', `anh_cau_hoi`='$img' WHERE `id_cau_hoi`=$id";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		return true;
	} else {
		return false;
	}
}

// ham lay cau hoi
function getQuestion($id, $id_user)
{
	include 'connectdb.php';
	$role = $_SESSION['acc']['role'];
	$sql = "";
	if ($role == 1) {
		$sql = "SELECT * FROM `cau_hoi` 
		JOIN `user` ON `cau_hoi`.id_user_them = `user`.id_user
		JOIN `loai_cau_hoi` ON `cau_hoi`.loai_cau_hoi = `loai_cau_hoi`.id_loai
		WHERE id_khoa_hoc='$id'";
	} else {
		$sql = "SELECT * FROM `cau_hoi` 
		JOIN `user` ON `cau_hoi`.`id_user_them` = `user`.`id_user`
		JOIN `loai_cau_hoi` ON `cau_hoi`.`loai_cau_hoi` = `loai_cau_hoi`.`id_loai`
		WHERE id_khoa_hoc='$id' AND id_user_them='$id_user'";
	}
	$result = mysqli_query($conn, $sql);
	return $result;
}

//lay cau hoi xem chi tiết
function getDetail($id)
{
	include 'connectdb.php';
	$sql = "SELECT *, COUNT(*) as total FROM `cau_hoi` 
		JOIN `user` ON `cau_hoi`.id_user_them = `user`.id_user
		JOIN `loai_cau_hoi` ON `cau_hoi`.loai_cau_hoi = `loai_cau_hoi`.id_loai
		WHERE id_cau_hoi='$id'";
	$result = mysqli_query($conn, $sql);
	return $result;
}
function getDetailSai($id)
{
	include 'connectdb.php';
	$sql = "SELECT *, COUNT(*) as total FROM `lich_su_sai`
		WHERE id_cau_hoi='$id'";
	$result = mysqli_query($conn, $sql);
	return $result;
}

function getDetailSaiAll($id)
{
	include 'connectdb.php';
	$sql = "SELECT * FROM `lich_su_sai`
		WHERE id_cau_hoi='$id'";
	$result = mysqli_query($conn, $sql);
	return $result;
}

// ham lay so nguoi dung
function getUser()
{
	include 'connectdb.php';
	$sql = "SELECT COUNT(*) as totalUser FROM `user`";
	$result = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_array($result)) {
		echo $row["totalUser"];
	}
}
function getUserIfno()
{
	include 'connectdb.php';
	$sql = "SELECT * FROM `user`";
	$result = mysqli_query($conn, $sql);
	return $result;
}
// xóa người dùng
function deleteUser($user){
	include 'connectdb.php';
	$sql = "DELETE FROM `user` WHERE `id_user` = '$user'";
	$result = mysqli_query($conn, $sql);
}
// lấy só lượng câu hỏi, phân trang câu hỏi
function getQs()
{
	include 'connectdb.php';
	$sql = "SELECT COUNT(*) as totalQs FROM `cau_hoi`";
	$result = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_array($result)) {
		return $row["totalQs"];
	}
}
function panigationQs($trang_hien_tai){
	include 'connectdb.php';
	$sql = "SELECT * FROM cau_hoi LIMIT 10 OFFSET $trang_hien_tai";
	$result = mysqli_query($conn, $sql);
	return $result;
}

// lấy ngẫu nhiên 10 câu để luện tập
function begin_practice($id_kh)
{
	include 'connectdb.php';
	$sql = "INSERT INTO luyen_tap (`id_cau_hoi`, `ten_cau_hoi`, `dap_an`, `correct`,`loai_cau_hoi`, `anh_cau_hoi`, `id_user_them`, `id_khoa_hoc`, `status`)
	SELECT `id_cau_hoi`, `ten_cau_hoi`, `dap_an`, `correct`,`loai_cau_hoi`, `anh_cau_hoi`, `id_user_them`, `id_khoa_hoc`, `status`
	FROM cau_hoi
	WHERE (status = 1 AND id_khoa_hoc = $id_kh)
	ORDER BY RAND() LIMIT 10";
	$result = mysqli_query($conn, $sql);
	return $result;
}

// lấy bảng luyện tập
function get_limit10($id_kh)
{
	include 'connectdb.php';
	$sql = "SELECT * FROM luyen_tap WHERE id_khoa_hoc=$id_kh";
	$result = mysqli_query($conn, $sql);
	return $result;
}

// insert vào bảng những câu làm sai
function insertFail($id_ch, $id_user, $da_false)
{
	include 'connectdb.php';
	$sqly = "SELECT * FROM cau_hoi WHERE id_cau_hoi = $id_ch";
	$result1 = mysqli_query($conn, $sqly);
	while ($row = mysqli_fetch_array($result1)) {
		$r1 = $row['id_cau_hoi'];
		$r2 = $row['ten_cau_hoi'];
		$r3 = $row['dap_an'];
		$r4 = $row['correct'];
		$r5 = $row['loai_cau_hoi'];
		$r6 = $row['anh_cau_hoi'];
		$r7 = $row['id_user_them'];	
		$r8 = $row['id_khoa_hoc'];
		$r9 = $row['status'];
	}
	
		$sql = "INSERT INTO lich_su_sai (`id_cau_hoi`, `ten_cau_hoi`, `dap_an`, `correct`,`loai_cau_hoi`, `anh_cau_hoi`, `id_user_them`, `id_khoa_hoc`, `status`)
		VALUES ('$r1', '$r2', '$da_false', '$r4', '$r5', '$r6', '$id_user', '$r8', '$r9')";
		
		$result = mysqli_query($conn, $sql);
		if ($result) {
			return true;
		} else {
			return false;
		}	
}

//insert vào bảng điểm
function insert_diem($diem, $id_user, $id_khoa_hoc, $time){
	include 'connectdb.php';
	$sql = "INSERT INTO `diem`(`diem`, `id_user`, `id_khoa_hoc`, `thoi_gian`) VALUES ('$diem','$id_user','$id_khoa_hoc','$time')";
	$result = mysqli_query($conn, $sql);
		if ($result) {
			return true;
		} else {
			return false;
		}	
}

// xoa du lieu trong bảng luyen_tap
function deleteData($id_khoa_hoc)
{
	include 'connectdb.php';
	$sql = "DELETE FROM `luyen_tap` WHERE id_khoa_hoc = $id_khoa_hoc";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		return true;
	} else {
		return false;
	}
}

// xem lich su cau sai
function getHistory($id_user, $id_kh)
{
	include 'connectdb.php';
	$sql = "SELECT DISTINCT *, COUNT(*) AS so_lan FROM `lich_su_sai`
	JOIN `loai_cau_hoi` ON `lich_su_sai`.loai_cau_hoi = `loai_cau_hoi`.id_loai
	WHERE id_user_them=$id_user AND id_khoa_hoc=$id_kh
	GROUP BY id_cau_hoi";
	$result = mysqli_query($conn, $sql);
	return $result;
}