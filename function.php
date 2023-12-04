<?php
	// check login session
	function isLogin(){
		// hàm kiểm tra đã đăng nhập chưa
		if(isset($_SESSION['user'])){
			return true;
		}else{
			return false;
		}
	}

	// Begin ham lưu giá trị ô input post
	function saveInputPOST($btn, $name){
		if(isset($_POST[$btn])){
			echo isset($_POST[$name]) ? $_POST[$name] : '';
		}
	}
	
	// ham lưu giá trị ô input get
	function saveInputGET($btn, $name){
		if(isset($_GET[$btn])){
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
            while($row = mysqli_fetch_assoc($tkk)){
                if($row["user_name"] == $username && $row["password"] == $password){
                    $count++;
                    $_SESSION['user'] = $username;
                    break;
                }
            }

        if($count == 1){
            return true;
        }else{
			return false;
        } 
	}
    // end checkLogin

	// check register
	function checkRegister($tk, $mk, $gmail){
		include 'connectdb.php';
			$count = 0;
			$mksql = "SELECT user_name FROM user";
			$tkk = mysqli_query($conn, $mksql);
			while($row = mysqli_fetch_assoc($tkk)){
				if($row["user_name"] == $tk){
					$count++;
					break;
				}
			}
			if($count == 0){
				$sql = "INSERT INTO user (user_name, `password`, gmail) VALUES ('$tk', '$mk', '$gmail')";
				if(mysqli_query($conn, $sql)){
					return true;
				}else{
					return false;
				}
			}else{
				echo '<div class="alert alert-danger text-center" role="alert">Tên tài khoản tồn tại</div>';
			} 
	}

  