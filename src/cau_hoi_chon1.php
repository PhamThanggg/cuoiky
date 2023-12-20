<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm câu hỏi 1 đáp án</title>
    <!-- Begin bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="	sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <!-- End bootstrap cdn -->
    <style>

    </style>
</head>

<body>
    <?php
    include 'navbar.php';
    if(!isset($_SESSION["user"])) {
        header("Location: dang_nhap.php");
    }
    ?>
    <!-- 	 -->
    <main style="min-height: 100vh; max-width: 100%;padding-top:70px">
        <!-- <hr> -->

        <div id="action" style="margin: 20px 0 0 13%;" >
            <p class="h3">Thêm câu hỏi </p>
            <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
            }else{
                header("Location: khoa_hoc.php");
            }
            echo "<a href='bien_tap.php?id=$id' class='btn btn-primary'>Trở lại</a>";
            ?>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
        <div style="margin: 20px 13%;">
            <div class="form-group">
                <label for="name_quiz">Nhập tên câu hỏi</label>
                <input class="form-control" type="text" name="ten_cau_hoi" id="">
            </div>
            <div class="form-group">
                    <label for="name_quiz">Ảnh cho câu hỏi</label>
                    <input class="form-control" name="image" type="file">
            </div>

            <p>Nhập các lựa chọn và tích đáp án đúng</p>
            <div style='margin: 20px 0 0 0;' class='input-group mb-3'>
                <div class='input-group-text'>
                    <input name='dad' value='da_0' type='radio'>
                </div>
                <input name='da_0' type='text' class='form-control' placeholder='Nhập đáp án'>
            </div>
            <div style='margin: 20px 0 0 0;' class='input-group mb-3'>
                <div class='input-group-text'>
                    <input name='dad' value='da_1' type='radio'>
                </div>
                <input name='da_1' type='text' class='form-control' placeholder='Nhập đáp án'>
            </div>
            <div style='margin: 20px 0 0 0;' class='input-group mb-3'>
                <div class='input-group-text'>
                    <input name='dad' value='da_2' type='radio'>
                </div>
                <input name='da_2' type='text' class='form-control' placeholder='Nhập đáp án'>
            </div>
            <div style='margin: 20px 0 0 0;' class='input-group mb-3'>
                <div class='input-group-text'>
                    <input name='dad' value='da_3' type='radio'>
                </div>
                <input name='da_3' type='text' class='form-control' placeholder='Nhập đáp án'>
            </div>

            <?php
            include "../connectdb.php";
            include "../function.php";
            if(isset($_POST['btn'])) {
                $question = $_POST['ten_cau_hoi'];
                $da0 = trim($_POST['da_0']);
                $da1 = trim($_POST['da_1']);
                $da2 = trim($_POST['da_2']);
                $da3 = trim($_POST['da_3']);
                $arr = $da0.", ".$da1.", ".$da2.", ".$da3;
                $da = "";

                if(isset($_POST['dad'])) {
                    $da = $_POST[$_POST['dad']];
                }
                if($question == "") {
                    echo "<div class='alert alert-warning text-center' role='alert'>Tên câu hỏi không được để trống</div>";
                }elseif($da0 == "" || $da1 == "" ||  $da2 == "" || $da3 == "" ){
                    echo '<div class="alert alert-danger text-center" role="alert"> Đáp án không được để trống</div>';
                } else if($da == "") {
                    echo "<div class='alert alert-warning text-center' role='alert'>Bạn phải chọn đáp án</div>";
                }elseif(strlen($question) > 200){
                    echo '<div class="alert alert-danger text-center" role="alert"> Câu hỏi không được dài quá 200 ký tự</div>';
                }elseif(strlen($da0) > 100 || strlen($da1) > 100 || strlen($da2) > 100 || strlen($da3) > 100 ){
                    echo '<div class="alert alert-danger text-center" role="alert"> Đáp án không được dài quá 100 ký tự</div>';
                } else {
                    $img = "";
                    if(isset($_FILES["image"])&& !empty( $_FILES["image"]["name"])) {
                        $target_dir = "../images/";
                        $target_file = $target_dir.basename($_FILES["image"]["name"]);
                        $allowed = array("jpg", "jpeg", "png", "gif");
                        $duoi = pathinfo($_FILES["image"]["name"])["extension"];
                        if (in_array(strtolower($duoi), $allowed)) {
                            if(ktAnhTontai($target_dir, $_FILES["image"]["name"])){
                                if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                                    $img = basename($_FILES["image"]["name"]);
                                }
                                if(insertCauHoi($question, $da, $arr, "2", $img, $id)) {
                                    echo "<div class='alert alert-success text-center' role='alert'>Thêm câu hỏi thành công</div>";
                                } else {
                                    echo "<div class='alert alert-warning text-center' role='alert'>Thêm câu hỏi thất bại</div>";
                                }
                            }else{
                                echo "<div class='alert alert-success text-center' role='alert'>Tên ảnh tồn tại vui lòng đổi tên ảnh hoặc chọn ảnh khác</div>";
                            }  
                            
                        } else {
                            echo "<div class='alert alert-warning text-center' role='alert'>Hãy chọn file ảnh</div>";
                        }
                    }else{
                        if(insertCauHoi($question, $da, $arr, "2", $img, $id)) {
                            echo "<div class='alert alert-success text-center' role='alert'>Thêm câu hỏi thành công</div>";
                        } else {
                            echo "<div class='alert alert-warning text-center' role='alert'>Thêm câu hỏi thất bại</div>";
                        }
                    }
                    
                }

            }
            ?>

            <div style="margin: 20px 0 0 0;" class="d-grid">
                <input class="btn btn-primary btn-block" name="btn" type="submit" value="Thêm câu hỏi">
            </div>
        </div>
        </form>

    </main>
</body>

</html>