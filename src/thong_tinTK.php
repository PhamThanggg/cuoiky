<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="	sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Thông tin tài khoản</title>
</head>

<style>
.card {
    border: none
}

.image {
   margin-top: -30px;
}

.user-details h4 {
    color: blue;
    margin-top: 20px;
}

.inputs label {
    display: flex;
    margin-left: 3px;
    font-weight: 500;
    font-size: 16px;
    margin-bottom: 4px;
    margin-top: 10px;
}

.inputs input {
    margin-top: 5px;
    font-size: 14x;
    height: 40px;
    border: 2px solid #ced4da;
}

.about-inputs textarea:focus {
    box-shadow: none
}

.btn {
    font-weight: 600
}

.col-size {
    width: 600px;
    font-size: 20px;
}
</style>

<body>
    <?php 
        ob_start();
        include 'navbar.php'; 
        include '../function.php';

        if(!isLogin()){
            header('location: dang_nhap.php');
        }
    ?>

<form action="" method="post">
    <div class="container mt-3" style="padding-top:70px">
        <div class="card p-3 text-center">
            <div class=" flex-row justify-content-center mb-3">
                <div class="image"> <img src="https://png.pngtree.com/png-vector/20190623/ourlarge/pngtree-accountavataruser--flat-color-icon--vector-icon-banner-templ-png-image_1491720.jpg" class="rounded-circle" style="width: 100px;"></div>
                <div class="user-details">
                    <h4 class="" style="margin-top: 0px;"><?php echo $_SESSION['acc']['hoten'] ?></h4>
                </div>
            </div>
            <h3>Hồ sơ cá nhân</h3>
            <div class="row" style="margin: 0 400px;">
                <div class="col-size">
                    <div class="inputs"> <label>Tên tài khoản</label> <input class="form-control" name="tk" type="text" value="<?php echo $_SESSION['acc']['user'] ?>" readonly>
                    </div>
                </div>
                <div class="col-size">
                    <div class="inputs"> <label>Họ tên</label> <input class="form-control" name="ht" type="text" value="<?php echo $_SESSION['acc']['hoten'] ?>" value="<?php  ?>">
                    </div>
                </div>
                <div class="col-size">
                    <div class="inputs"> <label>Mật khẩu</label> <input class="form-control" name="mk" type="text" value="*********" readonly>
                    </div>
                </div>
                <div class="col-size">
                    <div class="inputs"> <label>Email</label> <input class="form-control" name="email" type="gmail" value="<?php echo $_SESSION['acc']['gmail'] ?>"
                            placeholder="Email"> </div>
                </div>
                <div class="col-size">
                    <div class="inputs"> <label>Cấp độ: <?php echo $_SESSION['acc']['level'] ?></label> 
                    </div>
                </div>
                <div class="alert-danger col-size"></div>

                <?php
                    if(isset($_POST['cn_sm'])){
                        $ht = trim($_POST['ht']);
                        $gmail = trim($_POST['email']);

                        $id = $_SESSION['acc']['id'];
                        $user = $_SESSION['acc']['user'];
                        $role = $_SESSION['acc']['role'];
                        $lv = $_SESSION['acc']['level'];

                        if($ht==""){
                            echo '<div class="alert alert-danger text-center" role="alert">Bạn chưa nhập họ tên</div>';
                        }elseif($gmail==""){
                            echo '<div class="alert alert-danger text-center" role="alert">Bạn chưa nhập gmail</div>';
                        }elseif(strlen($ht) > 45 || strlen($gmail) > 45 ){
                            echo '<div class="alert alert-danger text-center" role="alert"> Chuỗi trong ô input không được dài quá 45 ký tự</div>';
                        }else{
                            if(updateAccountInfo($user, $ht, $gmail)){
                                $_SESSION['acc']= array(
                                    'id' => $id,
                                    'user' => $user,
                                    'hoten' => $ht,
                                    'level' => $lv,
                                    'gmail' =>  $gmail,
                                    'role' => $role
                                );
                                setcookie("alert", '<div class="alert alert-success text-center" role="alert">Cập nhật thành công</div>', time() + 5);
                                header('location: thong_tinTK.php');
                            }else{
                                echo '<div class="alert alert-danger text-center" role="alert">Cập nhật lỗi!!!</div>';
                            }
                        }

                        
                    }
                    ob_end_flush();
                    if(isset($_COOKIE['alert'])){
                        echo $_COOKIE['alert'];
                    }
                    // echo $_SESSION['acc']['gmail'];
                ?>
                
            </div><br>
            <div class=""> 
                <input type="submit" name="cn_sm" value="Cập nhật" class="btn btn-primary">
            </div>
        </div>
    </div>
    <br><br><br>
</form>
    <?php include 'footer.php'; ?>
</body>

</html>