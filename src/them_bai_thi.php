<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm bài thi</title>
    <!-- Begin bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="	sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <!-- End bootstrap cdn -->

</head>

<body>
    <?php
    include 'navbar.php';
    if(!isset($_SESSION["user"])) {
        header("Location: dang_nhap.php");
    }
    ?>
    <main style="min-height: 100vh; max-width: 100%;padding-top:70px">
        <div id="action" style="margin: 20px 0 0 13%;">
            <p class="h3">Giao bài thi</p>
            <a href='admin.php' class='btn btn-primary'>Trở lại</a>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
            <div style="margin: 20px 13%;">
                <div class="form-group">
                    <label for="name_quiz">Nhập tiêu đề</label>
                    <input class="form-control" type="text" name="ten_cau_hoi"
                        value="<?php echo $name = isset($_POST['ten_cau_hoi']) ? $_POST['ten_cau_hoi'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="name_quiz">Nhập nội dung</label>
                    <input class="form-control" type="text" name="noi_dung"
                        value="<?php echo $name = isset($_POST['noi_dung']) ? $_POST['noi_dung'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="name_quiz">Nhập số lượng câu</label>
                    <input class="form-control" type="number" name="so_luong_cau"
                        value="<?php echo $name = isset($_POST['so_luong_cau']) ? $_POST['so_luong_cau'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="name_quiz">Nhập số lần được phép làm</label>
                    <input class="form-control" type="number" name="so_lan"
                        value="<?php echo $name = isset($_POST['so_lan']) ? $_POST['so_lan'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="name_quiz">Nhập thời gian (Điền số phút)</label>
                    <input class="form-control" type="number" name="thoi_gian"
                        value="<?php echo $name = isset($_POST['thoi_gian']) ? $_POST['thoi_gian'] : ''; ?>">
                </div><br>
                <div class="form-group">
                <label for="name_quiz">Chọn khóa học</label>
                    <select name="selectKH">
                        <?php 
                            include "../function.php";
                            include '../connectdb.php';
                            $sql = "SELECT * FROM `khoa_hoc`";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='".$row["id_khoa_hoc"]."'>".$row["ten_khoa_hoc"]."</option>";
                            }
                        ?>
                    </select>
                </div>
                
                <?php
                if(isset($_POST["btn"])) {
                    $sqll = "SELECT COUNT(*) as sl FROM `cau_hoi`";
                    $kq = mysqli_query($conn, $sqll);
                    $sl=0;
                    while ($row = mysqli_fetch_array($kq)) {
                        $sl = $row['sl'];
                    }

                    $name = trim($_POST["ten_cau_hoi"]);
                    $content = trim($_POST["noi_dung"]);
                    $count = trim($_POST["so_luong_cau"]);
                    $count_learn = trim($_POST["so_lan"]);
                    $time = trim($_POST["thoi_gian"]);
                    $selectKH = trim($_POST["selectKH"]);

                    if($name == "") {
                        echo "<div class='alert alert-warning text-center' role='alert'>Không được để trống tiêu đề</div>";
                    }elseif($content == ""){
                        echo "<div class='alert alert-warning text-center' role='alert'>Không được để trống nội dung</div>";
                    }elseif($count == ""){
                        echo "<div class='alert alert-warning text-center' role='alert'>Không được để số câu</div>";
                    }elseif($count_learn == ""){
                        echo "<div class='alert alert-warning text-center' role='alert'>Không được để trống số lần làm</div>";
                    }elseif($time == ""){
                        echo "<div class='alert alert-warning text-center' role='alert'>Không được để trống thời gian làm</div>";
                    }elseif($count < 10 || $count > $sl){
                        echo "<div class='alert alert-warning text-center' role='alert'>Số câu hỏi phải từ 10 trở lên và < $sl </div>";
                    }elseif($time < 1){
                        echo "<div class='alert alert-warning text-center' role='alert'>Thời gian làm phải lớn hơn 0</div>";
                    }elseif($count_learn < 1){
                        echo "<div class='alert alert-warning text-center' role='alert'>Số lần làm phải lớn hơn 0</div>";
                    }else {                        
                        if(insertKyThi($name, $content, $count, $count_learn, $selectKH, $time)) {
                            echo "<div class='alert alert-success text-center' role='alert'>Thêm thành công</div>";
                        } else {
                            echo "<div class='alert alert-warning text-center' role='alert'>Thêm thất bại</div>";
                        }       
                    }
                }
                
                ?>


                <div style="margin: 20px 0 0 0;" class="d-grid">
                    <input class="btn btn-primary btn-block" name="btn" type="submit" value="Thêm bài thi">
                </div>

            </div>
        </form>

    </main>

    <?php
    // include 'footer.php'; 
    ?>

</body>


</html>