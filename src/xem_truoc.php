<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="	sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <title>Xem trước</title>
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
        echo '<div style="height: 70px;"></div>';
    ?>
    <div id="action" style="margin: 20px 0 0 13%;">
        <p class="h3">Khóa học
            <?php echo $_SESSION["ten_khoa_hoc"]; ?>
        </p>
        <?php
            $id = $_SESSION['id_khoa_hoc'];
            echo "<a href='bien_tap.php?id=$id' class='btn btn-primary'>Trở lại</a>";
        ?>
    </div>

    <?php
        
        include '../function.php';

        if(!isLogin()){
            header('location: dang_nhap.php');
        }

      if(isset($_GET["id"])){
        $id = $_GET["id"];
      }else{
        $id = "-1";
      }

      $result = getDetail($id);
      while ($row = mysqli_fetch_array($result)) {
        // bg cau hoi dien
        if($row['loai_cau_hoi']==1){
            echo '<form action="" method="POST" enctype="multipart/form-data">
            <div style="margin: 20px 13%;">
                <div class="form-group">
                    <label for="name_quiz"><span style="color: red;"></span>Tên câu hỏi</label>
                    <input class="form-control" type="text" name="ten_cau_hoi"
                        value="'.$row['ten_cau_hoi'].'">
                </div>
                <div class="form-group">
                    <label for="name_quiz">Ảnh cho câu hỏi</label>';
                    if (!$row["anh_cau_hoi"] == "") {
                        echo "<br><img style='width:450px;object-fit: contain' src='../images/" . $row["anh_cau_hoi"] . "'>";
                    }
                echo    '<input class="form-control" name="image" type="file" value="">
                </div>
                <div class="form-group">
                    <label for="name_quiz">Dạng câu hỏi</label>
                    <input class="form-control" value="Điền" readonly type="text" name="dang_cau_hoi">
                </div>
                <label for="name_quiz">Đáp án</label>
                <div class="input-group mb-3">
                    <input name="da" type="text" class="form-control" placeholder=""
                        value="'.$row['dap_an'] .'">
                </div>
                <div class="form-group">
                    <label for="name_quiz">Người thêm</label>
                    <input class="form-control" value="'.$row['user_name'].'" readonly type="text" name="dang_cau_hoi">
                </div>
                <div class="form-group">
                    <label for="name_quiz">Trạng thái</label>
                    <input class="form-control" value="'; echo $row["status"]=="1"?"đã duyệt":"chưa duyệt"; echo '" readonly type="text" name="dang_cau_hoi">
                </div>';
                if($row["status"]=="0"){
                    echo '<div style="margin: 20px 0 0 0;" class="d-grid">
                    <input class="btn btn-primary btn-block" name="btn" type="submit" value="Thay đổi">
                </div>';
                }
                

            echo '</div>
            </form>';
            if(isset($_POST["btn"])) {
                $name = trim($_POST["ten_cau_hoi"]);
                $da = trim($_POST["da"]);
                if($name == "") {
                    echo "Không được để trống tên câu hỏi";
                } else if($da == "") {
                    echo "Không được để trống đáp án";
                } else {
                    $img = "";
                    $arr = "";
                    echo !empty($_FILES["image"]["name"]);
                    if ( isset( $_FILES["image"] ) && !empty($_FILES["image"]["name"])) {
                        $target_dir = "../images/";
                        $target_file = $target_dir.basename($_FILES["image"]["name"]);
                        $allowed = array("jpg", "jpeg", "png", "gif");
                            $duoi = pathinfo($_FILES["image"]["name"])["extension"];
                        if (in_array(strtolower($duoi), $allowed)) {
                            if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                                $img = basename($_FILES["image"]["name"]);
                            }
                        }
                        //  else {
                        //     echo "<div class='alert alert-warning text-center' role='alert'>Hãy chọn file ảnh</div>";
                        // }
                    }
                    if(updateCauHoi($name, $da, $arr, $img, $id)) {
                        setcookie("tb", "<div class='alert alert-success text-center' role='alert'>Thêm câu hỏi thành công</div>", time() + 5);
                        header('Location: xem_truoc.php?id='.$id);
                    } else {
                        echo "<div class='alert alert-warning text-center' role='alert'>Cập nhật câu hỏi thất bại</div>";
                    }
                }
            }
            if(isset($_COOKIE['tb'])){
                echo $_COOKIE['tb'];
            }
        }

        // end cau hoi dien

        
        // begin cau hoi chon 1
        if($row['loai_cau_hoi']==2){
            $arr_da = explode(", ", $row['correct']);
           echo ' <form action="" method="POST" enctype="multipart/form-data">
           <div style="margin: 20px 13%;">
               <div class="form-group">
                   <label for="name_quiz">Tên câu hỏi</label>
                   <input class="form-control" type="text" name="ten_cau_hoi" id="" value="'.$row['ten_cau_hoi'].'">
               </div>

               <p>Các lựa chọn và tích đáp án đúng</p>
               <div style="margin: 20px 0 0 0;" class="input-group mb-3">
                   <div class="input-group-text">
                       <input name="dad" value="da_0" type="radio"';if($row['dap_an']==$arr_da[0]){echo "checked";}else{echo "";} echo ' >
                   </div>
                   <input name="da_0" type="text" class="form-control" placeholder="Nhập đáp án" value="'.$arr_da[0].'">
               </div>
               <div style="margin: 20px 0 0 0;" class="input-group mb-3">
                   <div class="input-group-text">
                       <input name="dad" value="da_1" type="radio"';if($row['dap_an']==$arr_da[1]){echo "checked";}else{echo "";} echo '>
                   </div>
                   <input name="da_1" type="text" class="form-control" placeholder="Nhập đáp án" value="'.$arr_da[1].'">
               </div>
               <div style="margin: 20px 0 0 0;" class="input-group mb-3">
                   <div class="input-group-text">
                       <input name="dad" value="da_2" type="radio"';if($row['dap_an']==$arr_da[2]){echo "checked";}else{echo "";} echo '>
                   </div>
                   <input name="da_2" type="text" class="form-control" placeholder="Nhập đáp án" value="'.$arr_da[2].'">
               </div>
               <div style="margin: 20px 0 0 0;" class="input-group mb-3">
                   <div class="input-group-text">
                       <input name="dad" value="da_3" type="radio"';if($row['dap_an']==$arr_da[3]){echo "checked";}else{echo "";} echo '>
                   </div>
                   <input name="da_3" type="text" class="form-control" placeholder="Nhập đáp án" value="'.$arr_da[3].'">
               </div>
               <div class="form-group">
                    <label for="name_quiz">Người thêm</label>
                    <input class="form-control" value="'.$row['user_name'].'" readonly type="text" name="dang_cau_hoi">
                </div>
                <div class="form-group">
                    <label for="name_quiz">Trạng thái</label>
                    <input class="form-control" value="'; echo $row["status"]=="1"?"đã duyệt":"chưa duyệt"; echo '" readonly type="text" name="dang_cau_hoi">
                </div>';
   
               if($row["status"]=="0"){
                   echo '<div style="margin: 20px 0 0 0;" class="d-grid">
                       <input class="btn btn-primary btn-block" name="btn" type="submit" value="Thay đổi">
                   </div>';
               }

           echo '</div>
           </form>';

           include "../connectdb.php";
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
                } else if($da == "") {
                    echo "<div class='alert alert-warning text-center' role='alert'>Bạn phải chọn đáp án</div>";
                } else {
                    if(updateCauHoi($question, $da, $arr , "", $id)) {
                        setcookie("tb", "<div class='alert alert-success text-center' role='alert'>Thêm câu hỏi thành công</div>", time() + 5);
                        header('Location: xem_truoc.php?id='.$id);
                    } else {
                        echo "<div class='alert alert-warning text-center' role='alert'>Thêm câu hỏi thất bại</div>";
                    }
                }

            }
            if($_COOKIE['tb']){
                echo $_COOKIE['tb'];
            }
        }
        // end cau hoi chon 1

        
        // begin cau hoi chon nhieu
        if($row['loai_cau_hoi']==3){
            $arr = explode(", ", $row['correct']);
            $arr_da = explode(", ", $row['dap_an']);
            $count_da = count($arr)-1;

            echo '  <form action="" method="POST" enctype="multipart/form-data">
            <div style="margin: 20px 13%;">
                <div class="form-group">
                    <label for="name_quiz"><span style="color: red;">*</span>Tên câu hỏi</label>
                    <input class="form-control" type="text" name="ten_cau_hoi" id=""
                        value="'.$row['ten_cau_hoi'].'">
                </div>
                <div class="form-group">
                    <label for="name_quiz">Ảnh cho câu hỏi</label>';
                    if (!$row["anh_cau_hoi"] == "") {
                        echo "<br><img style='width:450px;object-fit: contain' src='../images/" . $row["anh_cau_hoi"] . "'>";
                    }
                    echo '
                    <input class="form-control" type="file" name="file_tai_len" id="">
                </div>
    
                <div class="form-group">
                    <label for="name_quiz">Dạng câu hỏi</label>
                    <input class="form-control" value="Chọn nhiều" readonly type="text" name="dang_cau_hoi" id="">
                </div>
                <br><p>Các lựa chọn và tích đáp án đúng</p>';
                
                for($i = 0; $i < $count_da; $i++){
                    echo '<div class="input-group mb-3" style="margin-top: 20px;">
                    <div class="input-group-prepend">
                        <div class="input-group-text1">
                            <input type="checkbox" id="check1" name="'.$i.'" value="'.$i.'" ';if($i==$arr_da[$i]){echo "checked";}else{echo "";} echo '> 
                        </div>
                    </div>
                    <input type="text" class="form-control" name="txt'.$i.'" placeholder="Nhập đáp án" value="'.$arr[$i].'">
                    </div>';
                }
    
                echo '<div style="margin: 20px 0 0 0;" class="d-grid">
                    <input class="btn btn-primary btn-block" name="btn" type="submit" value="Thêm câu hỏi">
                </div>
            </div>
            </form>';

            if(isset($_POST['btn'])){
                $ten_ch = trim($_POST['ten_cau_hoi']);
                $img="";
                if(isset($_FILES['file_tai_len'])){
                    $target_dir = "../images/";
                        $target_file = $target_dir.basename($_FILES["file_tai_len"]["name"]);
                        if(move_uploaded_file($_FILES["file_tai_len"]["tmp_name"], $target_file)) {
                            $img = basename($_FILES["file_tai_len"]["name"]);
                        }
                }else{
                    $img = '';
                }
                $sl_da = $count_da;
    
                $list_da = [];
                $list_datxt = [];
                $check_cb=0;
                $check_txt=0;
                // add vào mảng
                for($i=0; $i<$sl_da; $i++){
                    if(isset($_POST[$i])){
                        $list_da[] = $_POST[$i];
                        $check_cb++;
                    }else{
                        $list_da[] = " ";
                    }
    
                    if(isset($_POST['txt'.$i])){
                        if($_POST['txt'.$i]!=""){
                            $list_datxt[$i] = $_POST['txt'.$i];
                            $check_txt++;
                        }else{
                            $list_datxt[] = "";
                        }
                    }
                }
                
                //validate
                if($ten_ch==''){
                    echo '<br><div class="alert alert-danger text-center" role="alert">Bạn chưa nhập tên câu hỏi</div>';
                }
                elseif($check_cb==0){
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
                    $stt=0;
                    if($_SESSION["acc"]["role"] == 1) {
                        $stt = 1;
                    }
    
                    include '../connectdb.php';
                   
                    if(updateCauHoi($ten_ch, $da_correct, $da_txt, $img, $id )) {
                        setcookie("tb", "<div class='alert alert-success text-center' role='alert'>Thêm câu hỏi thành công</div>", time() + 5);
                        header('Location: xem_truoc.php?id='.$id);
                    } else {
                        echo "<div class='alert alert-warning text-center' role='alert'>Thêm câu hỏi thất bại</div>";
                    }
                }
                if($_COOKIE['tb']){
                    echo $_COOKIE['tb'];
                }
            }
        }
        // end cau hoi chon nhieu

        // begin cau hoi select option
        if($row['loai_cau_hoi']==4){
            $arr_da = explode(", ", $row['correct']);
            $dap_an = explode(", ", $row['dap_an']);
           echo ' <form action="" method="POST" enctype="multipart/form-data">
           <div style="margin: 20px 13%;">
               <div class="form-group">
                   <label for="name_quiz">Tên câu hỏi</label>
                   <input class="form-control" type="text" name="ten_cau_hoi" id="" value="'.$row['ten_cau_hoi'].'">
               </div>

               <div class="form-group">
                   <label for="name_quiz">Đáp án còn thiếu</label>
                   <input class="form-control" type="text" name="ten_cau_hoi1" id="" value="'.$dap_an[0].'">
               </div>

               <p>Đáp án đúng</p>
               <div style="margin: 20px 0 0 0;" class="input-group mb-3">
                   <div class="input-group-text">
                       <input name="dad" value="da_0" type="radio"';if($dap_an[1]==$arr_da[0]){echo "checked";}else{echo "";} echo ' >
                   </div>
                   <input name="da_0" type="text" class="form-control" placeholder="Nhập đáp án" value="'.$arr_da[0].'">
               </div>
               <div style="margin: 20px 0 0 0;" class="input-group mb-3">
                   <div class="input-group-text">
                       <input name="dad" value="da_1" type="radio"';if($dap_an[1]==$arr_da[1]){echo "checked";}else{echo "";} echo '>
                   </div>
                   <input name="da_1" type="text" class="form-control" placeholder="Nhập đáp án" value="'.$arr_da[1].'">
               </div>
               <div style="margin: 20px 0 0 0;" class="input-group mb-3">
                   <div class="input-group-text">
                       <input name="dad" value="da_2" type="radio"';if($dap_an[1]==$arr_da[2]){echo "checked";}else{echo "";} echo '>
                   </div>
                   <input name="da_2" type="text" class="form-control" placeholder="Nhập đáp án" value="'.$arr_da[2].'">
               </div>
               <div class="form-group">
                    <label for="name_quiz">Người thêm</label>
                    <input class="form-control" value="'.$row['user_name'].'" readonly type="text" name="dang_cau_hoi">
                </div>
                <div class="form-group">
                    <label for="name_quiz">Trạng thái</label>
                    <input class="form-control" value="'; echo $row["status"]=="1"?"đã duyệt":"chưa duyệt"; echo '" readonly type="text" name="dang_cau_hoi">
                </div>';
   
               if($row["status"]=="0"){
                   echo '<div style="margin: 20px 0 0 0;" class="d-grid">
                       <input class="btn btn-primary btn-block" name="btn" type="submit" value="Thay đổi">
                   </div>';
               }

           echo '</div>
           </form>';

           include "../connectdb.php";
            if(isset($_POST['btn'])) {
                $question = $_POST['ten_cau_hoi'];
                $question_da = $_POST['ten_cau_hoi1'];
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
                    if(updateCauHoi($question, $cau_hoi, $arr , "", $id)) {
                        setcookie("tb", "<div class='alert alert-success text-center' role='alert'>Thêm câu hỏi thành công</div>", time() + 5);
                        header('Location: xem_truoc.php?id='.$id);
                    } else {
                        echo "<div class='alert alert-warning text-center' role='alert'>Thêm câu hỏi thất bại</div>";
                    }
                }

            }
            if(isset($_COOKIE['tb'])){
                echo $_COOKIE['tb'];
            }
        }

        // end cau hoi select option
        
          
      }       
      
    //   include 'footer.php';
    ob_end_flush();

    ?>
</body>

</html>