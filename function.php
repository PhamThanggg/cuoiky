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

// check tiếng việt có dấu
function checkTV($str){
	$pattern = '/[áàảãạâấầẩẫậăắằẳẵặéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựýỳỷỹỵđÁÀẢÃẠÂẤẦẨẪẬĂẮẰẲẴẶÉÈẺẼẸÊẾỀỂỄỆÍÌỈĨỊÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢÚÙỦŨỤƯỨỪỬỮỰÝỲỶỸỴĐ]/';
    return preg_match($pattern, $str) > 0;
}

// check dấu cách
function checkDauCach($str){
	if (strpos($str, ' ')) {
        return true;
    } else {
        return false;
    }
}

// ham send email
function sendEmail($to, $subject, $message)
{
	$mail = new PHPMailer(true);

	try {
		//Server settings                     
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

function getQuestionPT($id, $id_user, $curr_page)
{
	include 'connectdb.php';
	$offset = ($curr_page - 1) * 10;

	$role = $_SESSION['acc']['role'];
	$sql = "";
	if ($role == 1) {
		$sql = "SELECT * FROM `cau_hoi` 
		JOIN `user` ON `cau_hoi`.id_user_them = `user`.id_user
		JOIN `loai_cau_hoi` ON `cau_hoi`.loai_cau_hoi = `loai_cau_hoi`.id_loai
		WHERE id_khoa_hoc='$id'
		ORDER BY `id_cau_hoi` DESC 
		LIMIT 10 OFFSET $offset";
	} else {
		$sql = "SELECT * FROM `cau_hoi` 
		JOIN `user` ON `cau_hoi`.`id_user_them` = `user`.`id_user`
		JOIN `loai_cau_hoi` ON `cau_hoi`.`loai_cau_hoi` = `loai_cau_hoi`.`id_loai`
		WHERE id_khoa_hoc='$id' AND id_user_them='$id_user'
		ORDER BY `id_cau_hoi` DESC
		LIMIT 10 OFFSET $offset";
	}
	$result = mysqli_query($conn, $sql);
	return $result;
}

//search
function getQuestionSearch($id, $id_user, $curr_page, $search)
{
	include 'connectdb.php';
	$offset = ($curr_page - 1) * 10;

	$role = $_SESSION['acc']['role'];
	$sql = "";
	if ($role == 1) {
		$sql = "SELECT * FROM `cau_hoi` 
		JOIN `user` ON `cau_hoi`.id_user_them = `user`.id_user
		JOIN `loai_cau_hoi` ON `cau_hoi`.loai_cau_hoi = `loai_cau_hoi`.id_loai
		WHERE id_khoa_hoc=$id AND ten_cau_hoi LIKE '%$search%'
		ORDER BY `id_cau_hoi` ASC 
		LIMIT 10 OFFSET $offset";
	} else {
		$sql = "SELECT * FROM `cau_hoi` 
		JOIN `user` ON `cau_hoi`.`id_user_them` = `user`.`id_user`
		JOIN `loai_cau_hoi` ON `cau_hoi`.`loai_cau_hoi` = `loai_cau_hoi`.`id_loai`
		WHERE id_khoa_hoc='$id' AND id_user_them='$id_user' AND ten_cau_hoi LIKE '%$search%'
		ORDER BY `id_cau_hoi` ASC 
		LIMIT 10 OFFSET $offset";
	}
	$result = mysqli_query($conn, $sql);
	return $result;
}

//FIlter
function getQuestionFilter($id, $id_user, $curr_page, $id_ch)
{
	include 'connectdb.php';
	$offset = ($curr_page - 1) * 10;

	$role = $_SESSION['acc']['role'];
	$sql = "";
	if ($role == 1) {
		$sql = "SELECT * FROM `cau_hoi` 
		JOIN `user` ON `cau_hoi`.id_user_them = `user`.id_user
		JOIN `loai_cau_hoi` ON `cau_hoi`.loai_cau_hoi = `loai_cau_hoi`.id_loai
		WHERE id_khoa_hoc=$id AND loai_cau_hoi = $id_ch
		ORDER BY `id_cau_hoi` ASC 
		LIMIT 10 OFFSET $offset";
	} else {
		$sql = "SELECT * FROM `cau_hoi` 
		JOIN `user` ON `cau_hoi`.`id_user_them` = `user`.`id_user`
		JOIN `loai_cau_hoi` ON `cau_hoi`.`loai_cau_hoi` = `loai_cau_hoi`.`id_loai`
		WHERE id_khoa_hoc='$id' AND id_user_them='$id_user' AND loai_cau_hoi = $id_ch
		ORDER BY `id_cau_hoi` ASC 
		LIMIT 10 OFFSET $offset";
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
// function getDetailSai($id)
// {
// 	include 'connectdb.php';
// 	$sql = "SELECT *, COUNT(*) as total FROM `lich_su_sai`
// 		WHERE id_cau_hoi='$id'";
// 	$result = mysqli_query($conn, $sql);
// 	return $result;
// }

function getDetailSaiAll($id, $id_user)
{
	include 'connectdb.php';
	$sql = "SELECT * FROM `lich_su_sai`
		WHERE id_cau_hoi='$id' AND id_user_them=$id_user";
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
function deleteUser($user)
{
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
function panigationQs($trang_hien_tai)
{
	include 'connectdb.php';
	$sql = "SELECT * FROM cau_hoi LIMIT 10 OFFSET $trang_hien_tai";
	$result = mysqli_query($conn, $sql);
	return $result;
}

// lấy ngẫu nhiên 10 câu để luện tập
function begin_practice($id_kh, $id_user, $sl, $id_KT, $id_quizz)
{
	include 'connectdb.php';
	$sqly = "SELECT * FROM cau_hoi 
	WHERE (status = 1 AND id_khoa_hoc = $id_kh)
	ORDER BY RAND() LIMIT $sl";
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
		$sql = "INSERT INTO luyen_tap (`id_cau_hoi`, `ten_cau_hoi`, `dap_an`, `correct`,`loai_cau_hoi`, `anh_cau_hoi`, `id_user_them`, `id_khoa_hoc`, `status`, `id_KT`, `id_quizz`)
			VALUES ('$r1', '$r2', '$r3', '$r4', '$r5', '$r6', '$id_user', '$r8', '$r9', '$id_KT', $id_quizz)";
		$result = mysqli_query($conn, $sql);
	}

	return $result;
}

// lấy bảng luyện tập
function get_limit10($id_kh, $id_user)
{
	include 'connectdb.php';
	$sql = "SELECT * FROM luyen_tap WHERE id_khoa_hoc=$id_kh AND id_user_them=$id_user";
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
function insert_diem($id_user, $id_khoa_hoc, $time_bg, $time_end, $id_quizz, $thoi_gian_end, $id_KT)
{
	include 'connectdb.php';
	$sql = "INSERT INTO `diem`(`id_user`, `id_khoa_hoc`, `thoi_gian_dau`, `thoi_gian_cuoi`, `id_quizz`, `thoi_gian_end`, `id_KT`) VALUES ('$id_user','$id_khoa_hoc','$time_bg','$time_end', '$id_quizz', $thoi_gian_end, '$id_KT')";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		return true;
	} else {
		return false;
	}
}

function update_diem($id_user, $id_kh, $id_quizz, $diem, $time_submit)
{
	include 'connectdb.php';
	$sql = "UPDATE `diem` SET `diem`='$diem',`thoi_gian`='$time_submit' 
	WHERE id_user=$id_user AND id_khoa_hoc=$id_kh AND thoi_gian='' AND id_quizz=$id_quizz";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		return true;
	} else {
		return false;
	}
}

//lay diem
function getDiem($id_user, $id_kh, $id_quizz){
	include 'connectdb.php';
	$sql = "SELECT * FROM `diem`
	WHERE id_user=$id_user AND id_khoa_hoc=$id_kh AND thoi_gian='' AND id_quizz=$id_quizz AND thoi_gian_cuoi > NOW()";
	$result = mysqli_query($conn, $sql);
	return $result;
}

//lay diem KT
function getDiemKT($id_user, $id_kh, $id_KT){
	include 'connectdb.php';
	$sql = "SELECT * FROM `diem`
	WHERE id_user=$id_user AND id_khoa_hoc=$id_kh AND thoi_gian='' AND id_KT=$id_KT AND thoi_gian_cuoi > NOW()";
	$result = mysqli_query($conn, $sql);
	return $result;
}

// xoa du lieu trong bảng luyen_tap
function deleteData($id_khoa_hoc, $id_user)
{
	include 'connectdb.php';
	$sql = "DELETE FROM `luyen_tap` WHERE id_khoa_hoc = $id_khoa_hoc AND id_user_them = $id_user";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		return true;
	} else {
		return false;
	}
}

// xem lich su cau sai
function getHistory($id_user, $id_kh, $curr_page)
{
	include 'connectdb.php';
	$offset = ($curr_page-1)*10;

	$sql = "SELECT DISTINCT *, COUNT(*) AS so_lan FROM `lich_su_sai`
	WHERE id_user_them=$id_user AND id_khoa_hoc=$id_kh
	GROUP BY id_cau_hoi
	ORDER BY `id_cau_hoi` ASC 
	LIMIT 10 OFFSET $offset";
	$result = mysqli_query($conn, $sql);
	return $result;
}

// them btvn
function insertBTVN($idKH, $name, $img, $content)
{
	include 'connectdb.php';
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$ngay_gio = date("Y-m-d H:i:s");
	$expired = date("Y-m-d H:i:s", strtotime($ngay_gio . " +3 days"));
	$sql = "INSERT INTO `btvn`(`id_khoa_hoc`,`name`, `img`, `content`, `createDate`, `expired`, `quantity`) VALUES ('$idKH', '$name','$img','$content', '$ngay_gio', '$expired', '')";
	$result = mysqli_query($conn, $sql);
	return $result;
}

// them btvn
function insertKyThi($tieu_de, $noi_dung, $so_luong, $so_lan, $id_kh, $thoi_gian)
{
	include 'connectdb.php';
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$ngay_gio = date("Y-m-d H:i:s");
	$expired = date("Y-m-d H:i:s", strtotime($ngay_gio . " +3 days"));
	$sql = "INSERT INTO `ky_thi`(`tieu_de`, `noi_dung`, `so_luong_cau`, `so_lan`, `thoi_gian_mo`, `thoi_gian_dong`, `id_khoa_hoc`, `thoi_gian_lam`) 
	VALUES ('$tieu_de','$noi_dung','$so_luong','$so_lan','$ngay_gio','$expired','$id_kh','$thoi_gian')";
	$result = mysqli_query($conn, $sql);
	return $result;
}

//update so nguoi nop bai
function updateBTVN($id, $quantity)
{
	include 'connectdb.php';
	$sql = "UPDATE `btvn` SET `quantity`='$quantity' WHERE id='$id'";
	$result = mysqli_query($conn, $sql);
}
// lay btvn
function btvn(){
	include 'connectdb.php';
	$sql = "SELECT * FROM `btvn`";
	$result = mysqli_query($conn, $sql);
	return $result;
}
function getBTVN($id)
{
	include 'connectdb.php';
	$sql = "SELECT * FROM `btvn` WHERE id_khoa_hoc='$id' AND expired > NOW()";
	$result = mysqli_query($conn, $sql);
	return $result;
}
function get1BT($id)
{
	include 'connectdb.php';
	$sql = "SELECT * FROM `btvn` WHERE id=$id";
	$result = mysqli_query($conn, $sql);
	return $result;
}

// delete btvn
function deleteBTVN($id)
{
	include 'connectdb.php';
	$sql = "DELETE FROM `btvn` WHERE id=$id";
	$result = mysqli_query($conn, $sql);
}

// delete khóa học
function deleteKhoaHoc($id)
{
	include 'connectdb.php';
	$sql = "DELETE FROM `khoa_hoc` WHERE id_khoa_hoc=$id";
	$result = mysqli_query($conn, $sql);
}

// lấy thong tin ky thi
function KyThi(){
	include 'connectdb.php';
	$sql = "SELECT * FROM `ky_thi`";
	$result = mysqli_query($conn, $sql);
	return $result;
}

// delete btvn
function deleteKyThi($id)
{
	include 'connectdb.php';
	$sql = "DELETE FROM `ky_thi` WHERE id_KT=$id";
	$result = mysqli_query($conn, $sql);
}

// get all ky thi
function getKyTHi()
{
	include 'connectdb.php';
	$sql = "SELECT * FROM `ky_thi`
	JOIN `khoa_hoc` ON `ky_thi`.id_khoa_hoc=`khoa_hoc`.id_khoa_hoc
	WHERE `ky_thi`.thoi_gian_dong > NOW()";
	$result = mysqli_query($conn, $sql);
	return $result;
}


// get 1 ky thi
function get_KT($id_KT)
{
	include 'connectdb.php';
	$sql = "SELECT * FROM `ky_thi`
	WHERE id_KT=$id_KT";
	$result = mysqli_query($conn, $sql);
	return $result;
}

// đếm số ky thi
function count_KT()
{
	include 'connectdb.php';
	$sql = "SELECT COUNT(*) FROM `ky_thi`
	WHERE `thoi_gian_dong`> NOW()";
	$result = mysqli_query($conn, $sql);
	return $result;
}

// dem so lan 1 user đã làm bài kiểm tra
function count_userKT($id_user, $id_kt){
	include 'connectdb.php';
	$sql = "SELECT COUNT(*) FROM `diem`
	WHERE id_user = $id_user AND id_KT = $id_kt";
	$result = mysqli_query($conn, $sql);
	return $result;
}

// lay khoa hoc
function getKhoaHoc(){
	include 'connectdb.php';
	$sql = "SELECT * FROM `khoa_hoc`";
	$result = mysqli_query($conn, $sql);
	return $result;
}
//them khoa hoc
function insertKhoaHoc($name, $img){
	include 'connectdb.php';
	$sql = "INSERT INTO `khoa_hoc`(`ten_khoa_hoc`, `anh_khoa_hoc`) VALUES ('$name', '$img')";
	$result = mysqli_query($conn, $sql);
	return $result;
}

// lấy bảng điểm
function getDiemLT($idKT, $role){
	include 'connectdb.php';
	$sql = "SELECT * FROM `diem` 
			JOIN `user` ON `user`.id_user = `diem`.id_user
			JOIN `khoa_hoc` ON `khoa_hoc`.id_khoa_hoc = `diem`.id_khoa_hoc
			WHERE `id_KT` = $idKT AND `role` = $role";
	$result = mysqli_query($conn, $sql);
	return $result;
}

// lấy bảng điểm thi
function getDiemThi($id_user){
	include 'connectdb.php';
	$sql = "SELECT * FROM `diem` 
	JOIN `ky_thi` ON `ky_thi`.`id_KT` = `diem`.`id_KT`
	WHERE id_user = $id_user AND id_quizz = 1
	ORDER BY id_diem DESC 
	LIMIT 10";
	$result = mysqli_query($conn, $sql);
	return $result;
}

// lấy bảng điểm thi
function getDiemLuyenTap($id_user){
	include 'connectdb.php';
	$sql = "SELECT * FROM `diem` 
	JOIN `khoa_hoc` ON `khoa_hoc`.`id_khoa_hoc` = `diem`.`id_khoa_hoc`
	WHERE id_user = 1 AND id_quizz = 0
	ORDER BY id_diem DESC 
	LIMIT 10
	";
	$result = mysqli_query($conn, $sql);
	return $result;
}