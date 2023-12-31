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

    .exam {
        display: inline-block;
        text-transform: uppercase;
        font-size: 22px;
        font-weight: 200;
        padding: 10px;
        margin-right: 10px;
        margin-bottom: 15px;
        background-color: #60769785;
        border-radius: 8%;
        color: #fff;
        text-shadow: 1px 1px 1px #919191, 1px 2px 1px #919191, 1px 3px 1px #919191, 1px 4px 1px #919191, 1px 5px 1px #919191, 1px 6px 1px #919191, 1px 7px 1px #919191, 1px 8px 1px #919191, 1px 9px 1px #919191, 1px 10px 1px #919191, 1px 18px 6px rgba(16, 16, 16, 0.4), 1px 22px 10px rgba(16, 16, 16, 0.2), 1px 25px 35px rgba(16, 16, 16, 0.2), 1px 30px 60px rgba(16, 16, 16, 0.4);
    }

    body{
        overflow-x: hidden;
    }
</style>

<body >
    <?php
    ob_start();
    include 'navbar.php';
    echo '<div style="height: 70px;"></div>';
    include '../function.php';

    if (!isLogin()) {
        header('location: dang_nhap.php');
    }

    if (isset($_GET["id_diem"])) {
        $id = $_GET["id_diem"];
        $id_KT = $_GET["id_KT"];
        
    } else {
        $id = "-1";
    }

    $kqkt = get_KT($id_KT);
    while($rowkt = mysqli_fetch_array($kqkt)){
        $id_kh=$rowkt['id_khoa_hoc'];
    }
    $getName = getNameKH($id_kh);
    while($rowName = mysqli_fetch_array($getName)){
        $Name_KH=$rowName['ten_khoa_hoc'];
    }
    ?>
    <div id="action" style="margin: 20px 0 0 13%;">
        <p class="h3">Khóa học
            <?php echo $Name_KH ?>
        </p>
        <?php
        // $id = $_SESSION['id_khoa_hoc'];
        echo "<a href='lichsu.php' class='btn btn-primary'>Trở lại</a>";
        ?>
    </div>

    <?php


    $result = getKiThiSaiAll($id, $_SESSION['acc']['id'], $id_KT);
    $i=0;
    while ($row = mysqli_fetch_array($result)) {
        // for ($i = 1; $i <= $row["total"]; $i++) {
            // bg cau hoi dien
            if ($row['loai_cau_hoi'] == 1) {
                echo '<div style="margin: 20px 13%;">
                <div class="form-group" style="display: flex; align-items: center;">
                    <p class="exam">Lần ' . ($i+1) . ': </p>
                    <p style="font-size:20px">' . $row['ten_cau_hoi'] . '</p> ';
                    if($row['checkds'] == 1){
                        echo "Dung";
                    }else{
                        echo "Sai";
                    }
                echo '</div>
                <div class="form-group">';
                if (!$row["anh_cau_hoi"] == "") {
                    echo "<br><img style='width:450px;object-fit: contain; margin-bottom:20px' src='../images/" . $row["anh_cau_hoi"] . "'>";
                }
                echo '<input type="text" class="form-control" readonly value=' . $row["dap_an"] . '></div></div>';
            }
            // end cau hoi dien
    
            // begin cau hoi chon 1
            if ($row['loai_cau_hoi'] == 2) {
                $arr_da = explode(", ", $row['correct']);
                echo '<div style="margin: 20px 13%;">
                        <div class="form-group" style="display: flex; align-items: center;">
                            <p class="exam">Lần ' . ($i+1) . ': </p>
                            <p style="font-size:20px">' . $row['ten_cau_hoi'] . '</p> ';
                            if($row['checkds'] == 1){
                                echo "Dung";
                            }else{
                                echo "Sai";
                            }
                        echo '</div>';
                foreach ($arr_da as $key) {
                    echo '<div style="margin: 20px 0 0 0;" class="input-group mb-3"><div class="input-group-text">';
                            if($key == $row["dap_an"]){
                                echo '<input type="radio" checked>';
                            } else {
                                echo '<input type="radio">';
                            }
                    echo '</div><input name="da_0" type="text" class="form-control" readonly placeholder="Nhập đáp án" value="' . $key . '"></div>';
                }
                echo '</div>';
            }
            // end cau hoi chon 1
    
            // begin cau hoi chon nhieu
            if ($row['loai_cau_hoi'] == 3) {
                $arr = explode(", ", $row['correct']);
                $arr_da = explode(", ", $row['dap_an']);
                $count_da = count($arr) - 1;

                echo '<div style="margin: 20px 13%;">
                <div class="form-group" style="display: flex; align-items: center;">
                    <p class="exam">Lần ' . ($i+1) . ': </p>
                    <p style="font-size:20px">' . $row['ten_cau_hoi'] . '</p>';
                    if($row['checkds'] == 1){
                        echo "Dung";
                    }else{
                        echo "Sai";
                    }
                echo '</div>
                <div class="form-group">';
                if (!$row["anh_cau_hoi"] == "") {
                    echo "<br><img style='width:450px;object-fit: contain' src='../images/" . $row["anh_cau_hoi"] . "'>";
                }
                echo '</div>';

                for ($j = 0; $j < $count_da; $j++) {
                    echo '<div class="input-group mb-3" style="margin-top: 20px;">
                    <div class="input-group-prepend">
                        <div class="input-group-text1">
                            <input type="checkbox" id="check1" value="' . $j . '" ';
                    if ($j == $arr_da[$j]) {
                        echo "checked";
                    } else {
                        echo "";
                    }
                    echo '> 
                        </div>
                    </div>
                    <input type="text" class="form-control"  value="' . $arr[$j] . '" readonly>
                    </div>';
                }
                echo '</div>';
            }

             // begin cau select option
             if ($row['loai_cau_hoi'] == 4) {
                // $arr_da = explode(", ", $row['correct']);
                // tach da đúng trong tiêu đề
                $dap_an_dung = explode(", ", $row['dap_an']);
                $ch = explode("...", $dap_an_dung[0]);
                
                // tách câu hỏi con thiếu
                echo '';
                
                echo " 
                <div style='margin: 20px 0 0 13%;' class='form-group' style='display: flex; align-items: center;'>
                    <p class='exam'>Lần " . ($i+1) . ": </p>
                    <p style='display: inline;' style='font-size:20px'>" . $row['ten_cau_hoi'] . "</p> ";
                    if($row['checkds'] == 1){
                        echo "Dung";
                    }else{
                        echo "Sai";
                    }
                echo "</div>
                <div style='margin: 10px 0 0 13%;' class='input-group mb-3'>
                <label for='selectOption'>$ch[0]</label>
                <select name='selectOption' id='selectOption'>
                    <option value='$dap_an_dung[1]'>$dap_an_dung[1]</option>
                </select>
                <label for='selectOption'>$ch[1]</label>

            </div>";
            }
            // end cau select option
            
        // }
        $i++;
    }

    //   include 'footer.php';
    ob_end_flush();

    ?>
</body>

</html>