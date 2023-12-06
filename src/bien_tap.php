<?php
// include '../function.php'; 


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biên tập</title>
    <!-- Begin bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="	sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <!-- End bootstrap cdn -->
    <style>
        img {
            max-width: 400px;
        }

        a {
            text-decoration: none;
            color: white;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION["user"])) {
        header("Location: dang_nhap.php");
    }
    // include 'navbar.php';
    ?>
    <main style="min-height: 100vh; max-width: 100%;">

        <div id="action" style="margin: 20px 0 0 13%;">
            <p class="h3">Khóa học
                <?php
                $id = $_GET["id"];
                include '../connectdb.php';
                $sql = "SELECT * FROM `khoa_hoc` WHERE id_khoa_hoc='$id'";
                $result = mysqli_query($conn, $sql);
                $count = 0;
                while ($row = mysqli_fetch_array($result)) {
                    if ($row[0] != '') {
                        echo $row["ten_khoa_hoc"];
                        $_SESSION["ten_khoa_hoc"] = $row["ten_khoa_hoc"];
                    }
                }
                ?>
                <!--Tên khóa học  -->
            </p>
            <a href="khoa_hoc.php" class="btn btn-primary">Trở lại</a>

            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                Thêm câu hỏi
            </button>
            <ul class="dropdown-menu">
                <?php
                $id = $_GET["id"];
                echo "<li><a class='dropdown-item' href='them_cau_hoi.php?id=$id'>Câu hỏi điền</a></li>";
                ?>
                <?php
                $id = $_GET["id"];
                echo "<li><a class='dropdown-item' href='cau_hoi_chon1.php?id=$id'>Câu chọn</a></li>";
                ?>
            </ul>

        </div>
        <div class="d-flex flex-wrap flex-column align-items-center" style="padding: 1%;margin: 5% 0 0 0; ">
            <p class="h3">Danh sách câu hỏi</p>
            <table class="table table-striped">
                <tr>
                    <th>STT</th>
                    <th>Tên câu hỏi</th>
                    <th>Loại câu hỏi</th>
                    <th>Đáp án</th>
                    <th>Tác giả</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
                <tr>
                    <?php
                    $role = $_SESSION['acc']['role'];
                    echo $role;
                    $user = $_SESSION['acc']['user'];
                    $id = $_GET["id"];
                    include "../connectdb.php";
                    $sql = "";
                    if($role == 1){
                    $sql = "SELECT * FROM `cau_hoi` WHERE id_khoa_hoc='$id'";
                    } else {
                        $sql = "SELECT * FROM `cau_hoi` WHERE id_khoa_hoc='$id' AND (id_user_them='$user' OR status='1')";
                    }
                    $result = mysqli_query($conn, $sql);
                    $count = 0;
                    while ($row = mysqli_fetch_array($result)) {
                        $count++;                        
                        echo "<tr><td>" . $row["id_cau_hoi"] . "</td>";
                        echo "<td>" . $row["ten_cau_hoi"] . "</td>";
                        echo "<td>" . $row["loai_cau_hoi"] . "</td>";
                        echo "<td>" . $row["dap_an"] . "</td>";
                        echo "<td>" . $row["id_user_them"] . "</td>";
                        if ($row["status"] == 1) {
                            echo "<td>Da duyet</td>";
                        } else {
                            echo "<td>Chua duyet</td>";
                        }
                        echo "<td>
                                <form method='post'>
                                    <a style='color:black' href='xem_truoc.php?id=" . $row["id_cau_hoi"] . "'>Xem truoc</a>";
                        if($role == 1){
                            if($row["status"] == 0){
                                echo "<button name='accept'>Duyet</button>";  
                            }                     
                            echo "<input type='hidden' name='idQuest' value='" . $row["id_cau_hoi"] . "'>";
                            echo "<button name='delete'>Xoa</button>";
                        }
                        echo "</form>
                        </td></tr>";
                    }
                    if ($count == 0) {
                        echo "<td align='center' colspan='6'>Không có câu hỏi nào</td>";
                    }
                    if (isset($_POST['accept'])) {
                        $idQuestion = $_POST['idQuest'];
                        $sql = "UPDATE `cau_hoi` SET `status`='1' WHERE id='$idQuestion'";
                        $result = mysqli_query($conn, $sql);
                        header("location: bien_tap.php?id=$id");
                    }
                    if (isset($_POST['delete'])) {
                        $idQuestion = $_POST['idQuest'];
                        $sql1 = "DELETE FROM `cau_hoi` WHERE id='$idQuestion'";
                        $result1 = mysqli_query($conn, $sql1);
                        header("location: bien_tap.php?id=$id");
                    }
                    ?>
                </tr>
            </table>

        </div>
    </main>
    <?php
    // include 'footer.php'; 
    ?>
</body>


</html>