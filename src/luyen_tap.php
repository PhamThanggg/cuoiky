<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="	sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
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
    ob_start();
        include 'navbar.php';
        include '../function.php';
        if (!isset($_SESSION["user"])) {
            header("Location: dang_nhap.php");
        }
        $id_user = $_SESSION['acc']['id'];
        if(isset($_SESSION['id_khoa_hoc'])){
            $id_kh = $_SESSION['id_khoa_hoc'];
        }else{
            header("Location: khoa_hoc.php");
        }
    ?>
    <section class="main-section" style="margin-top: 70px;">
        <div style="position: fixed; margin-left: 20px;">
            <?php
            if(isset($_SESSION['id_khoa_hoc'])){
                $id = $_SESSION['id_khoa_hoc'];
            }else{
                $id=-1;

            }
            echo "<a href='bien_tap.php?id=$id' class='btn btn-primary'>Trở lại</a>
            <h2>Luyện tập</h2>";
            $kq = getDiem($id_user, $id_kh, '0');
            $thoiGianEnd=0;
            while($roww = mysqli_fetch_array($kq)){
                $thoiGianEnd = $roww['thoi_gian_end'];
                echo "<p>Thời gian bắt đầu</p><p>";
                echo $roww['thoi_gian_dau']!=''?$roww['thoi_gian_dau']:"yyyy-mm-dd 00-00-00";
                echo "</p>
                <p>Thời gian kết thúc</p>
                <p>";
                echo $roww['thoi_gian_cuoi']!=''?$roww['thoi_gian_cuoi']:"yyyy-mm-dd 00-00-00";
                echo "</p>
                ";
            }
        ?>
        </div>
        <form action="" method="post" id="form">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-md-8">
                        <div class="card my-2 p-3">
                            <div class="card-body">

                                <?php 
                                    $stt = 0;
                                    $list_correct=[];
                                    $list_id_ch=[];
                                    $result = get_limit10($id_kh, $_SESSION['acc']['id']);
                                    while($row = mysqli_fetch_array($result)){
                                        
                                        // begin câu hỏi điền
                                        echo "<h5 class='card-title py-2' style='margin-top: 10px;'>Câu "; echo ($stt+1). ": "; echo $row['ten_cau_hoi']." </h5>";
                                        if($row['loai_cau_hoi']==1){
                                            $list_correct[]=$row['dap_an'];
                                            $list_id_ch[]=$row['id_cau_hoi'];
                                            if (!$row["anh_cau_hoi"] == "") {
                                                echo "<br><img style='width:450px;object-fit: contain' src='../images/" . $row["anh_cau_hoi"] . "'>";
                                            }
                                            echo "
                                            <div style='margin: 5px 0 0 0;' class='input-group mb-3'>
                                                <input name='cau_dien$stt' type='text' class='form-control' placeholder='Nhập đáp án'
                                                    value=''>
                                            </div>";
                                        }
                                        // end câu hỏi điền

                                        //begin câu hỏi chọn 1
                                        if($row['loai_cau_hoi']==2){
                                            $arr_da = explode(", ", $row['correct']);
                                            $list_correct[]=$row['dap_an'];
                                            $list_id_ch[]=$row['id_cau_hoi'];
                                            if (!$row["anh_cau_hoi"] == "") {
                                                echo "<br><img style='width:450px;object-fit: contain' src='../images/" . $row["anh_cau_hoi"] . "'>";
                                            }
                                            echo "
                                            <div style='margin: 20px 0 0 0;' class='input-group mb-3'>
                                                <div class='input-group-text'>
                                                    <input name='dad$stt' value='cau$stt"."da_0' type='radio' >
                                                </div>
                                                <input name='cau$stt"."da_0' type='text' class='form-control' placeholder='Nhập đáp án' value='".$arr_da[0]."' readonly>
                                            </div>
                                            <div style='margin: 20px 0 0 0;' class='input-group mb-3'>
                                                <div class='input-group-text'>
                                                    <input name='dad$stt' value='cau$stt"."da_1' type='radio' >
                                                </div>
                                                <input name='cau$stt"."da_1' type='text' class='form-control' placeholder='Nhập đáp án' value='".$arr_da[1]."' readonly>
                                            </div>
                                            <div style='margin: 20px 0 0 0;' class='input-group mb-3'>
                                                <div class='input-group-text'>
                                                    <input name='dad$stt' value='cau$stt"."da_2' type='radio'>
                                                </div>
                                                <input name='cau$stt"."da_2' type='text' class='form-control' placeholder='Nhập đáp án' value='".$arr_da[2]."' readonly>
                                            </div>
                                            <div style='margin: 20px 0 0 0;' class='input-group mb-3'>
                                                <div class='input-group-text'>
                                                    <input name='dad$stt' value='cau$stt"."da_3' type='radio'>
                                                </div>
                                                <input name='cau$stt"."da_3' type='text' class='form-control' placeholder='Nhập đáp án' value='".$arr_da[3]."' readonly>
                                            </div>";
                                        }
                                         // end câu hỏi chọn 1 

                                         // begin cau hoi chon nhiều
                                        if($row['loai_cau_hoi']==3){
                                            $arr_da = explode(", ", $row['correct']);
                                            $list_correct[]=$row['dap_an'];
                                            $list_id_ch[]=$row['id_cau_hoi'];
                                            $count_sl = count($arr_da)-1;
                                            if (!$row["anh_cau_hoi"] == "") {
                                                echo "<br><img style='width:450px;object-fit: contain' src='../images/" . $row["anh_cau_hoi"] . "'>";
                                            }
                                            for($i = 0; $i < $count_sl; $i++){
                                                echo '
                                                <div class="input-group mb-3" style="margin-top: 20px;">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text1">
                                                        <input type="checkbox" id="check1" name="cb'.$stt.$i.'" value="'.$i.'"> 
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" name="cau_cn'.$stt.$i.'" placeholder="Nhập đáp án" value="'.$arr_da[$i].'" readonly>
                                                </div>';
                                            }
                                        }
                                        // end cau hoi chon nhiều 
                                        
                                        // begin cau hoi select option
                                         if($row['loai_cau_hoi']==4){
                                            $arr_da = explode(", ", $row['correct']);
                                            // tach da đúng trong tiêu đề
                                            $dap_an_dung = explode(", ", $row['dap_an']);

                                            $list_correct[]=$row['dap_an'];
                                            $list_id_ch[]=$row['id_cau_hoi'];

                                            // tách câu hỏi con thiếu
                                            $ch = explode("...", $dap_an_dung[0]);
                                            $_SESSION['select'.$stt] = $dap_an_dung[0];
                                            
                                            echo "  <div style='margin: 20px 0 0 0;' class='input-group mb-3'>
                                            <label for='selectOption'>$ch[0]</label>
                                            <select name='selectOption$stt' id='selectOption'>
                                                <option value='$arr_da[0]'>$arr_da[0]</option>
                                                <option value='$arr_da[1]'>$arr_da[1]</option>
                                                <option value='$arr_da[2]'>$arr_da[2]</option>
                                            </select>
                                            <label for='selectOption'>$ch[1]</label>

                                        </div>";

                                        }
                                        // end cau hoi select option 

                                        if(!isset($_SESSION['list_correct'])){
                                            $_SESSION['list_correct'] = $list_correct;
                                        }

                                        $stt++; 
                                    }
                                
                                ?>
                            </div>
                        </div>
                    </div>
                    
                    <?php
                        if($stt!=0){
                            echo '<div class="col-md-8 mb-5">
                            <input type="submit" id="sm" class="btn btn-success" name="submit" value="Nộp bài"></input>
                            </div>';
                        }else{
                            echo '<div class="col-md-8 mb-5">
                            <input type="submit" class="btn btn-success" name="begin" value="Bắt đầu"></input>
                            </div><br>';
                        }

                        if(isset($_POST['begin'])){
                            // check số lượng câu hỏi
                            include '../connectdb.php';
                            $check = 0;
                            $sql = mysqli_query($conn, "SELECT COUNT(*) FROM cau_hoi WHERE status = 1 AND id_khoa_hoc = $id");
                            while($row = mysqli_fetch_array($sql)){
                                if($row[0] < 10){
                                    $check++;
                                }
                            }

                            // ramdom cau hoi
                            if($check == 0){
                                begin_practice($id_kh, $_SESSION['acc']['id'], 10, 0, 0);
                            }
                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                            // tgian hiện tại
                            $thoi_gian_begin = date("Y-m-d H:i:s");
                            $thoi_gian_now = time();
                            
                            // tgian cộng thêm 10p
                            $thoi_gian_end = $thoi_gian_now + (10 * 60);
                            
                            // Thời gian kết thúc
                            $ket_thuc = date("Y-m-d H:i:s", $thoi_gian_end);

                            //insert cac dl vao bang diem
                            $id_lt=0;
                           
                            if($check == 0){
                                insert_diem($id_user, $id_kh, $thoi_gian_begin, $ket_thuc, $id_lt, $thoi_gian_end, "0");
                                header("Location: luyen_tap.php?id=$id_kh");
                            }else{
                                setcookie("mess", '<div style="margin-left: 800px;">Khóa học này không có đủ 10 câu hỏi để luyện tập</div>', time()+2);
                                header("Location: luyen_tap.php?id=$id_kh");   
                            }

                        }
                        if(isset($_COOKIE['mess'])){
                            echo $_COOKIE['mess'];
                        }
                    ?>
                    
                    
                    <!-- Tính điểm  -->
                    <?php
                        
                        $listGet_cr = [];
                        // begin submit
                        if(isset($_POST['submit'])){
                            $stt1=0;
                            
                            for($i = 0; $i < 10; $i++){
                                // cau hoi điền
                                if(isset($_POST["cau_dien$i"])){
                                    $listGet_cr[] = $_POST["cau_dien$i"];
                                }

                                // cau hoi chon 1
                                elseif(isset($_POST["dad$stt1"])){
                                    $da = $_POST[$_POST["dad$stt1"]];
                                    $listGet_cr[]=$da;
                                }

                                // cau hoi chon nhieu
                                elseif(isset($_POST["cau_cn$stt1"."1"])){
                                    $arr_cr = explode(", ", $list_correct[$i]);
                                    $sl_da = count($arr_cr)-1;
                                    $list_da = [];
                                    for($j=0; $j<$sl_da; $j++){
                                        if(isset($_POST["cb$stt1$j"])){
                                            $list_da[] = $_POST["cb$stt1$j"];
                                        }else{
                                            $list_da[] = "";
                                        }
                                    }
                                    $da_correct='';
                                    for ($j=0; $j < count($list_da); $j++) { 
                                        $da_correct .= $list_da[$j]. ', ';
                                    }

                                    $listGet_cr[] = $da_correct;
                                }
                                
                                // cau hoi select option
                                elseif(isset($_POST["selectOption$stt1"])){
                                    $da = $_SESSION['select'.$stt1].", ".$_POST["selectOption$stt1"];
                                    // echo $da;
                                    $listGet_cr[]=$da;
                                }else{
                                    $listGet_cr[] = "";
                                }
                                $stt1++;
                            }

                            $diem = 0;
                            for($i=0; $i < 10; $i++){
                                if($list_correct[$i]==$listGet_cr[$i]){
                                    $diem += 10;
                                }else{
                                    // neu sai thi add vao bang lich_su_sai
                                    insertFail($list_id_ch[$i], $id_user, $listGet_cr[$i]);
                                }
                            }
                            setcookie("diem", "<p style='text-align: center; font-size: 20px;' >Điểm của bạn: $diem</p>", time() + 5);

                            // đấy vào bảng điểm;
                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                            $thoi_gian_nop = date("Y-m-d H:i:s");
                            update_diem($id_user, $id_kh, '0', $diem, $thoi_gian_nop);

                            // xoa dl trong bảng bt khi nộp bài
                            deleteData($id_kh, $id_user);
                            // gỡ sesion tgian
                            if(isset($_SESSION['thoi_gian_end'])){
                                unset($_SESSION['thoi_gian_end']);
                            }
                            
                            header("Location: luyen_tap.php?id=$id_kh");
                        }
                        // end submit

                        if(isset($_COOKIE['diem'])){
                            echo $_COOKIE['diem'];
                        }
                        ob_end_flush();
                    ?>
                </div>
            </div>
        </form>
    </section>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> -->
    <script>
        var phpSessionValue = "<?php echo $thoiGianEnd; ?>";
        console.log(phpSessionValue);
        var clientTime = new Date().getTime()/1000;
        var timeDifference = phpSessionValue - clientTime;
        console.log(timeDifference);

        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var form = document.getElementById('sm');
                console.log(form);

                form.click();
            }, timeDifference*1000);
        });
    </script>
</body>

</html>