<?php 
	include 'funcition.php';
	// dùng hàm kiểm tra đăng nhập trong file funciton
	// nếu đăng nhập rồi thì truy cập vào trang khóa học
	// còn chưa đăng nhập thì điều hướng ra trang đăng nhập
	if(isLogin()){
		header("location: src/khoa_hoc.php");
	}else{
		header("location: src/dang_nhap.php");
	}


 ?>