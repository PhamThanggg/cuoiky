<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm câu hỏi</title>
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
            <p class="h3">Khóa học
                <?php echo $_SESSION["ten_khoa_hoc"]; ?>
            </p>
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
                    <label for="name_quiz"><span style="color: red;">*</span>Nhập tên câu hỏi</label>
                    <input class="form-control" type="text" name="ten_cau_hoi"
                        value="<?php echo $name = isset($_POST['ten_cau_hoi']) ? $_POST['ten_cau_hoi'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="name_quiz">Ảnh cho câu hỏi</label>
                    <input class="form-control" name="image" type="file">
                </div>
                <div class="form-group">
                    <label for="name_quiz">Dạng câu hỏi</label>
                    <input class="form-control" value="Điền" readonly type="text" name="dang_cau_hoi">
                </div>
                <div style='margin: 20px 0 0 0;' class='input-group mb-3'>
                    <input name='da' type='text' class='form-control' placeholder='Nhập đáp án'
                        value="<?php echo $da = isset($_POST['da']) ? $_POST['da'] : ''; ?>">
                </div>
                <?php
                if(isset($_POST["btn"])) {
                    $name = trim($_POST["ten_cau_hoi"]);
                    $da = trim($_POST["da"]);
                    if($name == "") {
                        echo "Không được để trống tên câu hỏi";
                    } else if($da == "") {
                        echo "Không được để trống đáp án";
                    } else {
                        $img = "";
                        if(isset($_FILES["image"])&& !empty( $_FILES["image"]["name"])) {
                            $target_dir = "../images/";
                            $target_file = $target_dir.basename($_FILES["image"]["name"]);
                            $allowed = array("jpg", "jpeg", "png", "gif");
                            $duoi = pathinfo($_FILES["image"]["name"])["extension"];
                            if (in_array(strtolower($duoi), $allowed)) {
                                if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                                    $img = basename($_FILES["image"]["name"]);
                                }
                                include "../function.php";
                                if(insertCauHoi($name, $da, "", "1", $img, $id)) {
                                    echo "<div class='alert alert-success text-center' role='alert'>Thêm câu hỏi thành công</div>";
                                } else {
                                    echo "<div class='alert alert-warning text-center' role='alert'>Thêm câu hỏi thất bại</div>";
                                }
                            } else {
                                echo "<div class='alert alert-warning text-center' role='alert'>Hãy chọn file ảnh</div>";
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

    <?php
    // include 'footer.php'; 
    ?>

</body>


</html>