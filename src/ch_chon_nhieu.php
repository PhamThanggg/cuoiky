<?php 
    // include '../function.php'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm câu hỏi chọn nhiều</title>
    <!-- Begin bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="	sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- End bootstrap cdn -->

</head>

<style>
.input-group-text1 {
    /* display: flex; */
    align-items: center;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    text-align: center;
    white-space: nowrap;
    background-color: #e9ecef;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
}
</style>

<body>
    <?php 
        include 'navbar.php';
        include '../function.php';
        if(!isLogin()){
            header("location: dang_nhap.php");
        }

    ?>
    <main style="min-height: 100vh; max-width: 100%;padding-top:70px">
        <div id="action" style="margin: 20px 0 0 13%;">
            <p class="h3">Khóa học
                <!-- tên khóa học -->
            </p>
            <?php
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                }else{
                    header("Location: khoa_hoc.php");
                }
                echo '<a href="bien_tap.php?id='.$id.'" class="btn btn-primary">Trở lại</a>';
            ?>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
        <div style="margin: 20px 13%;">
            <div class="form-group">
                <label for="name_quiz"><span style="color: red;">*</span>Nhập tên câu hỏi</label>
                <input class="form-control" type="text" name="ten_cau_hoi" id=""
                    value="<?php saveInputPOST("add_da", "ten_cau_hoi"); saveInputPOST("btn", "ten_cau_hoi") ?>">
            </div>

            <div class="form-group">
                <label for="name_quiz">Dạng câu hỏi</label>
                <input class="form-control" value="Chọn nhiều" readonly type="text" name="dang_cau_hoi" id="">
            </div>
            <div class="form-group" style="margin-top: 20px;">
                <label for="name_quiz">Thêm số đáp án</label>
                <input class="" value="<?php saveInputPOST("add_da", "count_da"); saveInputPOST("btn", "count_da") ?>"
                    type="number" name="count_da" id="">
                <input class="btn-info" value="Thêm" type="submit" name="add_da" id="">
                <!-- <input class="btn-info" value="Thêm 1 đáp án" type="submit" name="add_one" id=""> -->

            </div>
            <?php
                // begin add so dap an
                if(isset($_POST['add_da'])){
                    $sl_da = $_POST['count_da'];
                        if($sl_da>=2){
                            for($i=0; $i<$sl_da; $i++){
                                $_SESSION["stt".$i] = '<div class="input-group mb-3" style="margin-top: 20px;">
                                <div class="input-group-prepend">
                                    <div class="input-group-text1">
                                        <input type="checkbox" id="check1" name="'.$i.'" value="'.$i.'"> 
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="txt'.$i.'" placeholder="Nhập đáp án">
                                </div>';
                            }
                        }else{
                             echo '<br><div class="alert alert-danger text-center" role="alert">Bạn phải thêm ít nhất 2 đáp án</div>';
                        }
                }

               if(isset($_POST['count_da']) && $_POST['count_da']>=2){
                    $sl_da = $_POST['count_da'];
                    for($i=0; $i<$sl_da; $i++){
                        if(isset($_SESSION["stt"."$i"])){
                            echo $_SESSION["stt"."$i"];
                        }
                    }
                }
            ?>

            <div class="form-group">
                <label for="name_quiz">Ảnh cho câu hỏi (Nếu có)</label>
                <input class="form-control" type="file" name="image" id="">
            </div>
            
            <?php
            // begin add so dap an
            if(isset($_POST['btn'])){
                $ten_ch = trim($_POST['ten_cau_hoi']);
                $sl_da = trim($_POST['count_da']);

                $list_da = [];
                $list_datxt = [];
                $check_cb=0;
                $check_txt=0;
                // add vào mảng
                for($i=0; $i<$sl_da; $i++){
                    if(isset($_POST[$i])){
                        $list_da[$i] = $_POST[$i];
                        $check_cb++;
                    }else{
                        $list_da[$i] = "";
                    }

                    if(isset($_POST['txt'.$i])){
                        if($_POST['txt'.$i]!=""){
                            $list_datxt[$i] = trim($_POST['txt'.$i]);
                            $check_txt++;
                        }else{
                            $list_datxt[$i] = "";
                        }
                    }
                }
                
                //validate
                if($ten_ch==''){
                    echo '<br><div class="alert alert-danger text-center" role="alert">Bạn chưa nhập tên câu hỏi</div>';
                }elseif($sl_da==''){
                    echo '<br><div class="alert alert-danger text-center" role="alert">Bạn chưa thêm số đáp án</div>';
                }elseif($sl_da < 2){
                    echo '<br><div class="alert alert-danger text-center" role="alert">Bạn phải thêm ít nhất 2 đáp án</div>';
                }elseif($check_cb==0){
                    echo '<br><div class="alert alert-danger text-center" role="alert">Bạn phải tích ít nhất 1 đáp án</div>';
                }elseif($check_txt!=$sl_da){
                    echo '<br><div class="alert alert-danger text-center" role="alert">Bạn chưa điền đầy đủ đáp án</div>';
                }else{
                    $da_correct='';
                    $da_txt='';
                    for ($i=0; $i < count($list_datxt); $i++) { 
                        $da_txt .= $list_datxt[$i]. ', ';
                        $da_correct .= $list_da[$i]. ', ';
                    }
                    // echo $da_correct. " ". $da_txt;

                    $id_user = $_SESSION["acc"]["id"];
                    $id = $_GET['id'];
                    $stt=0;
                    if($_SESSION["acc"]["role"] == 1) {
                        $stt = 1;
                    }
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
                                include '../connectdb.php';
                                $sql = "INSERT INTO `cau_hoi` (`ten_cau_hoi`, `dap_an`, `correct`,`loai_cau_hoi`, `anh_cau_hoi`, `id_user_them`, `id_khoa_hoc`, `status`) VALUES ('$ten_ch' ,'$da_correct', '$da_txt', '3','$img', '$id_user', '$id',$stt)";
                                $result = mysqli_query($conn, $sql);
                                if($result) {
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
                        include '../connectdb.php';
                        $sql = "INSERT INTO `cau_hoi` (`ten_cau_hoi`, `dap_an`, `correct`,`loai_cau_hoi`, `anh_cau_hoi`, `id_user_them`, `id_khoa_hoc`, `status`) VALUES ('$ten_ch' ,'$da_correct', '$da_txt', '3','$img', '$id_user', '$id',$stt)";
                        $result = mysqli_query($conn, $sql);
                        if($result) {
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

    <?php 
        include 'footer.php'; 
    ?>

</body>


</html>