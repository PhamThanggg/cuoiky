<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm câu hỏi nhiều đáp án</title>
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
    <!-- 	 -->
    <main style="min-height: 100vh; max-width: 100%;">
        <!-- <hr> -->

        <div id="action" style="margin: 20px 0 0 13%;">
            <p class="h3">Thêm câu hỏi </p>
            <?php
            $id = $_GET['id'];
            echo "<a href='bien_tap.php?id=$id' class='btn btn-primary'>Trở lại</a>";
            ?>
            <form action="" method="POST" enctype="multipart/form-data">
        </div>
        <div style="margin: 20px 13%;">
            <div class="form-group">
                <label for="name_quiz">Nhập tên câu hỏi</label>
                <input class="form-control" type="text" name="ten_cau_hoi" id="">
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
            if(isset($_POST['btn'])) {
                $question = $_POST['ten_cau_hoi'];
                $da0 = $_POST['da_0'];
                $da1 = $_POST['da_1'];
                $da2 = $_POST['da_2'];
                $da3 = $_POST['da_3'];
                $arr = $da0.", ".$da1.", ".$da2.", ".$da3;
                $da = "";

                if(isset($_POST['dad'])) {
                    $da = $_POST[$_POST['dad']];
                }
                if($question == "") {
                    echo "<div class='alert alert-warning text-center' role='alert'>Tên câu hỏi không được để trống</div>";
                } else if($da == "") {
                    echo "<div class='alert alert-warning text-center' role='alert'>Bạn phải chọn đáp án</div>";
                }
                session_start();
                $user = $_SESSION["acc"]["user"];
                $stt = 0;
                if($_SESSION["acc"]["role"] == 1) {
                    $stt = 1;
                }
                $sql = "INSERT INTO `cau_hoi` (`ten_cau_hoi`, `dap_an`, `correct`,`loai_cau_hoi`, `anh_cau_hoi`, `id_user_them`, `id_khoa_hoc`, `status`) VALUES ('$question' ,'$da', '$arr', 'Chọn 1','', '$user', '$id',$stt)";
                $result = mysqli_query($conn, $sql);
                if($result) {
                    echo "<div class='alert alert-success text-center' role='alert'>Thêm câu hỏi thành công</div>";
                } else {
                    echo "<div class='alert alert-warning text-center' role='alert'>Thêm câu hỏi thất bại</div>";
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