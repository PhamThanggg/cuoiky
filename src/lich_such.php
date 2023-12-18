<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử câu sai</title>
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
    ob_start();
    include 'navbar.php';
    if (!isset($_SESSION["user"])) {
        header("Location: dang_nhap.php");
    }
    // include 'navbar.php';
    ?>
    <main style="min-height: 100vh; max-width: 100%;padding-top:70px">

        <div id="action" style="margin: 20px 0 0 13%;">
            <p class="h3">Lịch sử sai
                <?php
                if(isset($_GET["id"])){
                    $id = $_GET["id"];
                }else{
                    header("Location: khoa_hoc.php");
                }
                $_SESSION['id_khoa_hoc'] = $id;
                include '../connectdb.php';
                $sql = "SELECT * FROM `khoa_hoc` WHERE id_khoa_hoc='$id'";
                $result = mysqli_query($conn, $sql);
                $count = 0;
                while ($row = mysqli_fetch_array($result)) {
                    if ($row[0] != '') {
                        echo $row["ten_khoa_hoc"];
                    }
                }
                ?>
                <!--Tên khóa học  -->
            </p>
            <?php
            echo "<a href='bien_tap.php?id=$id' class='btn btn-primary'>Trở lại</a>";
            ?>   

        </div>
        <div class="d-flex flex-wrap flex-column align-items-center" style="padding: 1%;margin: 5% 0 0 0; ">
            <p class="h3">Danh sách câu hỏi</p>
            <table class="table table-striped">
                <tr>
                    <th>STT</th>
                    <th>Chủ đề</th>
                    <th>Tên câu hỏi</th>
                    <th>Số lần sai</th>
                    <th>Thao tác</th>
                </tr>
                <tr>
                    <?php
                    $role = $_SESSION['acc']['role'];
                    $id_user = $_SESSION['acc']['id'];
                    // $id = $_GET["id"];
                    include "../function.php";
                    include "../connectdb.php";
                    $kq = mysqli_query($conn, "SELECT COUNT(DISTINCT id_cau_hoi) FROM `lich_su_sai`
                    WHERE id_user_them=$id_user AND id_khoa_hoc=$id
                    ");

                    $roww = mysqli_fetch_array($kq);
                    $so_luong_page = ceil($roww[0] / 10);

                    // $result = getQuestion($id, $id_user);
                    $curr_page = isset($_GET['curr_page'])?$_GET['curr_page']:1;
                    $pre = ($curr_page > 1)?$curr_page - 1:1;
                    $next = ($curr_page < $so_luong_page)?$curr_page + 1:$so_luong_page;

                    $result = getHistory($id_user, $id, $curr_page);
                    $count = 0;
                    $stt = ($curr_page -1)*10;
                    while ($row = mysqli_fetch_array($result)) {
                        $count++;
                        $stt++;
                        echo "<tr><td>$stt</td>";
                        echo "<td>".$_SESSION["ten_khoa_hoc"]."</td>";
                        echo "<td>" . $row["ten_cau_hoi"] . "<br>";
                        echo "</td>";
                        echo "<td>" . $row["so_lan"] . "</td>";
                        echo "<td><form method='post'>
                                    <a style='color:black' href='chitiet_cs.php?id=" . $row["id_cau_hoi"] . "' class='btn btn-info'>Xem chi tiết</a>";
                        echo "</form></td></tr>";
                    }
                    if ($count == 0) {
                        echo "<td align='center' colspan='7'>Không có câu hỏi nào</td>";
                    }
                    ?>
                </tr>
            </table>
            <?php if($id!=-1){?>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?php echo ($curr_page==1)?"disabled":"" ?>">
                        <a class="page-link" href="<?php echo "lich_such.php?id=$id&curr_page=$pre"?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <?php for($i = 1; $i <= $so_luong_page; $i++){ ?>
                        <li class="page-item <?php echo ($i == $curr_page)?"active":"" ?>">
                            <a class="page-link" href="<?php echo "lich_such.php?id=$id&curr_page=$i"?>"><?=$i?></a>
                        </li>
                    <?php } ?>
                    <li class="page-item <?php echo ($curr_page==$so_luong_page)?"disabled":""?>">
                        <a class="page-link" href="<?php echo "lich_such.php?id=$id&curr_page=$next"?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <?php }?>
            
        </div>
    </main>
    <?php
    include 'footer.php';
    ?>
</body>


</html>