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
                    $id = $_GET["id"];
                    include "../function.php";
                    $result = getHistory($id_user, $id);
                    $count = 0;
                    $stt = 0;
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

        </div>
    </main>
    <?php
    include 'footer.php';
    ?>
</body>


</html>