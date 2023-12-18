<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm bài tập về nhà</title>
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
            <p class="h3">Giao BTVN</p>
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
                    <label for="name_quiz">Ảnh</label>
                    <input class="form-control" name="image" type="file">
                </div>
                <div class="form-group">
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
                <div style='margin: 20px 0 0 0;' class='input-group mb-3'>
                    <textarea name='da' type='text' class='form-control' placeholder='Nội dung'></textarea>
                </div>
                <?php
                if(isset($_POST["btn"])) {
                    $name = $_POST["ten_cau_hoi"];
                    $da = $_POST["da"];
                    $selectKH = $_POST["selectKH"];
                    if($name == "") {
                        echo "<div class='alert alert-warning text-center' role='alert'>Không được để trống tiêu đề</div>";
                    }elseif($da == ""){
                        echo "<div class='alert alert-warning text-center' role='alert'>Không được để trống nội dung</div>";
                    } else {                        
                        $img = "";
                        if(isset($_FILES["image"]) && !empty($_FILES["image"]["name"])) {
                            $target_dir = "../images/";
                            $target_file = $target_dir.basename($_FILES["image"]["name"]);
                            $allowed = array("jpg", "jpeg", "png", "gif");
                            $duoi = pathinfo($_FILES["image"]["name"])["extension"];
                            if (in_array(strtolower($duoi), $allowed)) {
                                if(ktAnhTontai($target_dir, $_FILES["image"]["name"])){
                                    if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                                        $img = basename($_FILES["image"]["name"]);
                                    }
                                    if(insertBTVN($selectKH, $name, $img, $da)) {
                                        echo "<div class='alert alert-success text-center' role='alert'>Thêm thành công</div>";
                                    } else {
                                        echo "<div class='alert alert-warning text-center' role='alert'>Thêm thất bại</div>";
                                    }
                                }else{
                                    echo "<div class='alert alert-success text-center' role='alert'>Tên ảnh tồn tại vui lòng đổi tên ảnh hoặc chọn ảnh khác</div>";
                                }  
                            } else {
                                echo "<div class='alert alert-warning text-center' role='alert'>Chỉ nhận file ảnh</div>";
                            }
                        } else {
                            insertBTVN($selectKH, $name, "", $da);
                            echo "<div class='alert alert-success text-center' role='alert'>Thêm thành công</div>";
                        }
                    }
                }
                ?>


                <div style="margin: 20px 0 0 0;" class="d-grid">
                    <input class="btn btn-primary btn-block" name="btn" type="submit" value="Thêm bài tập">
                </div>

            </div>
        </form>

    </main>

    <?php
    // include 'footer.php'; 
    ?>

</body>


</html>