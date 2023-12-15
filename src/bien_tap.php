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
        integrity="	sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- End bootstrap cdn -->
</head>

<body>
    <?php
    ob_start();
    include 'navbar.php';
    if (!isset($_SESSION["user"])) {
        header("Location: dang_nhap.php");
    }
    // include 'navbar.php';
    ?>
    <main style="min-height: 100vh; max-width: 100%;padding-top:70px">

        <div id="action" style="margin: 20px 0 0 13%;">
            <p class="h3">Khóa học
                <?php
                $id = $_GET["id"];
                $_SESSION['id_khoa_hoc'] = $id;
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
            <?php
                $id = $_GET["id"];
                echo "<a href='xembtvn.php?id=$id' class='btn btn-primary'>BTVN</a> <a href='luyen_tap.php?id=$id' class='btn btn-primary'>Luyện tập</a>
                <a href='lich_such.php?id=$id' class='btn btn-primary'>Lịch sử câu sai</a>";
            ?>

            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                Đóng góp câu hỏi
            </button>
            <ul class="dropdown-menu">
                <?php
                $id = $_GET["id"];
                echo "<li><a class='dropdown-item' href='them_cau_hoi.php?id=$id'>Câu hỏi điền</a></li>";
                ?>
                <?php
                $id = $_GET["id"];
                echo "<li><a class='dropdown-item' href='cau_hoi_chon1.php?id=$id'>Câu hỏi chọn</a></li>";
                echo "<li><a class='dropdown-item' href='ch_chon_nhieu.php?id=$id'>Câu hỏi chọn nhiều</a></li>";
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
                    $id_user = $_SESSION['acc']['id'];
                    $id = $_GET["id"];
                    include "../function.php";
                    include "../connectdb.php";
                    $kq = mysqli_query($conn, "SELECT COUNT(*) FROM `cau_hoi` WHERE `status`=1");
                    $roww = mysqli_fetch_array($kq);
                    $so_luong_page = ceil($roww[0] / 10);

                    // $result = getQuestion($id, $id_user);
                    $curr_page = isset($_GET['curr_page'])?$_GET['curr_page']:1;
                    $pre = ($curr_page > 1)?$curr_page - 1:1;
                    $next = ($curr_page < $so_luong_page)?$curr_page + 1:$so_luong_page;

                    $result = getQuestionPT($id, $id_user, $curr_page);
                    $count = 0;
                    $stt = ($curr_page-1)*10;
                    while ($row = mysqli_fetch_array($result)) {
                        $count++;
                        $stt++;
                        echo "<tr><td>$stt</td>";
                        echo "<td>" . $row["ten_cau_hoi"] . "<br>";
                        if (!$row["anh_cau_hoi"] == "") {
                            echo "<img style='width:100px;height:100px;object-fit: contain' src='../images/" . $row["anh_cau_hoi"] . "'>";
                        }
                        echo "</td>";
                        echo "<td>" . $row["loai_CH"] . "</td>";
                        echo "<td>" . $row["dap_an"] . "</td>";
                        echo "<td>" . $row["user_name"] . "</td>";
                        if ($row["status"] == 1) {
                            echo "<td>Đã duyệt</td>";
                        } else {
                            echo "<td>Chưa duyệt</td>";
                        }
                        echo "<td>
                                <form method='post'>
                                    <a style='color:black' href='xem_truoc.php?id=" . $row["id_cau_hoi"] . "' class='btn btn-info'>Xem trước</a>";
                        if ($row["status"] == 0 && $role == 1) {
                            echo "<button class='btn btn-primary' name='accept'>Duyệt</button>";
                        }
                        if ($role == 1 || $row["status"] == 0) {
                            echo "<input type='hidden' name='idQuest' value='" . $row["id_cau_hoi"] . "'>";
                            echo "<button class='btn btn-danger' name='delete'>Xóa</button>";
                        }


                        echo "</form></td></tr>";
                    }
                    if ($count == 0) {
                        echo "<td align='center' colspan='7'>Không có câu hỏi nào</td>";
                    }
                    if (isset($_POST['accept'])) {
                        $idQuestion = $_POST['idQuest'];
                        $sql = "UPDATE `cau_hoi` SET `status`='1' WHERE id_cau_hoi='$idQuestion'";
                        $result = mysqli_query($conn, $sql);
                        header("location: bien_tap.php?id=$id");
                    }
                    if (isset($_POST['delete'])) {
                        $idQuestion = $_POST['idQuest'];
                        $sql1 = "DELETE FROM `cau_hoi` WHERE id_cau_hoi='$idQuestion'";
                        $result1 = mysqli_query($conn, $sql1);
                        header("location: bien_tap.php?id=$id");
                    }
                    ob_end_flush();
                    ?>
                </tr>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?php echo ($curr_page==1)?"disabled":"" ?>">
                        <a class="page-link" href="<?php echo "bien_tap.php?id=$id&curr_page=$pre"?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <?php for($i = 1; $i <= $so_luong_page; $i++){ ?>
                        <li class="page-item <?php echo ($i == $curr_page)?"active":"" ?>">
                            <a class="page-link" href="<?php echo "bien_tap.php?id=$id&curr_page=$i"?>"><?=$i?></a>
                        </li>
                    <?php } ?>
                    <li class="page-item <?php echo ($curr_page==$so_luong_page)?"disabled":""?>">
                        <a class="page-link" href="<?php echo "bien_tap.php?id=$id&curr_page=$next"?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </main>
    <?php
    include 'footer.php';
    ?>
</body>


</html>