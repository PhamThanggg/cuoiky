<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm câu hỏi select option</title>
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
    include '../function.php';
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
                $id = -1;
            }
            echo "<a href='bien_tap.php?id=$id' class='btn btn-primary'>Trở lại</a>";
            ?>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
        <div style="margin: 20px 13%;">
            <div class="form-group">
                <label for="name_quiz">Nhập tên câu hỏi</label>
                <input class="form-control" type="text" name="ten_cau_hoi" id="" value="<?php saveInputPOST('btn', 'ten_cau_hoi')?>">
            </div>
            <div class="form-group">
                <label for="name_quiz">Nhập câu văn (chú ý để dấu "..." vào phần bị thiếu câu trả lời)</label>
                <input class="form-control" type="text" name="ten_cau_hoi1" id="" value="<?php saveInputPOST("btn", "ten_cau_hoi1")?>">
            </div>

            <p>Nhập các lựa chọn và tích đáp án đúng</p>
            <div style='margin: 20px 0 0 0;' class='input-group mb-3'>
                <div class='input-group-text'>
                    <input name='dad' value='da_0' type='radio'>
                </div>
                <input name='da_0' type='text' class='form-control' placeholder='Nhập option1' value="<?php saveInputPOST("btn", "da_0")?>">
            </div>
            <div style='margin: 20px 0 0 0;' class='input-group mb-3'>
                <div class='input-group-text'>
                    <input name='dad' value='da_1' type='radio'>
                </div>
                <input name='da_1' type='text' class='form-control' placeholder='Nhập option2' value="<?php saveInputPOST("btn", "da_1")?>">
            </div>
            <div style='margin: 20px 0 0 0;' class='input-group mb-3'>
                <div class='input-group-text'>
                    <input name='dad' value='da_2' type='radio'>
                </div>
                <input name='da_2' type='text' class='form-control' placeholder='Nhập option3' value="<?php saveInputPOST("btn", "da_2")?>">
            </div>
           

            <?php
            include "../connectdb.php";
            if(isset($_POST['btn'])) {
                $question = trim($_POST['ten_cau_hoi']);
                $question_da = trim($_POST['ten_cau_hoi1']);
                $da0 = trim($_POST['da_0']);
                $da1 = trim($_POST['da_1']);
                $da2 = trim($_POST['da_2']);
                $arr = $da0.", ".$da1.", ".$da2;
                $da = "";

                // số lượng dấu "..."
                $count = substr_count($question_da, "...");
                // tìm vị trí dấu "..."
                $index = strpos($question_da, "...");
                $index1 = strpos($question_da, "....");
                $index2 = strpos($question_da, ".....");
                // echo $count. " ". $index;    
                if(isset($_POST['dad'])) {
                    $da = $_POST[$_POST['dad']];
                }
                $cau_hoi = $question_da.', '.$da;
                // echo $cau_hoi;
                if($question == "") {
                    echo "<div class='alert alert-warning text-center' role='alert'>Tên câu hỏi không được để trống</div>";
                }else if($question_da == "") {
                    echo "<div class='alert alert-warning text-center' role='alert'>Phần câu văn không được để trống</div>";
                }else if($count == 0) {
                    echo "<div class='alert alert-warning text-center' role='alert'>Bạn chưa điền dấu ... vào phần bị thiếu câu trả lời</div>";
                }else if($index1 == true || $index2 == true) {
                    echo "<div class='alert alert-warning text-center' role='alert'>Bạn nhập sai dấu ... </div>";
                }else if($count != 1) {
                    echo "<div class='alert alert-warning text-center' role='alert'>Vui lòng điền đúng 1 lần dấu ...</div>";
                } else if($da == "") {
                    echo "<div class='alert alert-warning text-center' role='alert'>Bạn phải chọn đáp án</div>";
                } else {
                    if(insertCauHoi($question, $cau_hoi, $arr, "4", "", $id)) {
                        echo "<div class='alert alert-success text-center' role='alert'>Thêm câu hỏi thành công</div>";
                    } else {
                        echo "<div class='alert alert-warning text-center' role='alert'>Thêm câu hỏi thất bại</div>";
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