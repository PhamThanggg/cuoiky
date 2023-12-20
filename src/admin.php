<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Quản trị</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="	sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="../css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">
</head>
<style>
    .pagination {
        display: flex;
        margin-left: 20px;
        list-style: none;
        padding: 0;
    }

    .pagination li {
        margin-right: 5px;
        /* padding: 3px 20px; */
        width: 50px;
        height: 25px;
        text-align: center;
        background-color: #ccc;
    }

    .pagination li a {
        display: block;
        width: 100%;
        height: 100%;
    }

    .pagination .active {
        background-color: #f0b267;
    }
</style>

<body>
    <?php
    ob_start();
    include "navbar.php";
    if (isset($_SESSION["acc"])) {
        if ($_SESSION["acc"]["role"] !== "1") {
            header("location: dang_nhap.php");
        }
    } else {
        header("location: dang_nhap.php");
    }    
    ?>

    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="admin.php"><i class="menu-icon fa fa-laptop"></i>Admin </a>
                    </li>

                </ul>
            </div>
        </nav>
    </aside>

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">

        <div class="content">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-3">
                                        <i class="pe-7s-browser"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count">
                                                    <?php
                                                    include "../function.php";
                                                    echo getQs();
                                                    ?>
                                                </span></div>
                                            <div class="stat-heading">Câu hỏi</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-4">
                                        <i class="pe-7s-users"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count">
                                                    <?php
                                                    getUser();
                                                    ?>
                                                </span></div>
                                            <div class="stat-heading">Tài khoản</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- người dùng -->
                <div class="clearfix"></div>
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="box-title">User </h4>
                                </div>
                                <div class="card-body--">
                                    <div class="table-stats order-table ov-h">
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th class="serial">Stt</th>
                                                    <th>UserName</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $stt = 1;
                                                $result = getUserIfno();
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo "<tr>
                                                    <td class='serial'>$stt</td>
                                                        <td> <span class='name'>" . $row["user_name"] . "</span> </td>
                                                        <td> <span class='name'>" . $row["ho_ten"] . "</span> </td>
                                                        <td> <span class='product'>" . $row["gmail"] . "</span> </td>
                                                        <td>
                                                            <form method='post'>
                                                            <input type='hidden' name='idUser' value='" . $row["id_user"] . "'>
                                                            <button type='submit' name='delete' class='badge badge-complete'>Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>";
                                                    $stt++;
                                                }
                                                if (isset($_POST['delete'])) {
                                                    deleteUser($_POST['idUser']);
                                                    header("refresh:0");
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div> <!-- /.table-stats -->
                                </div>
                            </div> <!-- /.card -->
                        </div>
                    </div>
                </div>

                <!-- khóa học -->
                <div class="clearfix"></div>
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body" style="display:flex">
                                    <h4 class="box-title" style="width:100%">Khóa học</h4>
                                    <h4 class="box-title"><a href="them_khoa_hoc.php">Add</a> </h4>
                                </div>
                                <div class="card-body--">
                                    <div class="table-stats order-table ov-h">
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th class="serial" style="width: 30px;">Stt</th>
                                                    <th style="width: 200px;">Tên khóa</th>
                                                    <th style="width: 300px;">Ảnh</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php                                                
                                                $stt = 1;
                                                $resultKT = getKhoaHoc();
                                                while ($row = mysqli_fetch_array($resultKT)) {
                                                    echo "<tr>
                                                        <td class='serial'>$stt</td>
                                                        <td> <span class='name'>" . $row["ten_khoa_hoc"] . "</span> </td>
                                                        <td> <img src='../images/" . $row["anh_khoa_hoc"] . "'> </td>
                                                        <td><form method='post'>
                                                            <input type='hidden' name='idKT' value='" . $row["id_khoa_hoc"] . "'>
                                                            <button type='submit' name='deleteKH' class='badge badge-complete'>Delete</button>
                                                        </form></td>                                                        
                                                    </tr>";
                                                    $stt++;
                                                }

                                                if (isset($_POST["deleteKH"])) {
                                                    deleteKhoaHoc($_POST["idKT"]);
                                                    header("Location: admin.php");
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- câu hỏi -->
                <div class="clearfix"></div>
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="box-title">Question </h4>
                                </div>
                                <div class="card-body--">
                                    <div class="table-stats order-table ov-h">
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th class="serial">Stt</th>
                                                    <th>Tên câu hỏi</th>
                                                    <th>Đáp án</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $stt = 1;
                                                $trang_hien_tai = isset($_GET['trang']) ? ($_GET['trang']) : 0;
                                                if ($trang_hien_tai > 0)
                                                    $trang_hien_tai *= 10;
                                                $result = panigationQs(($trang_hien_tai));
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo "<tr>
                                                        <td class='serial'>" . $row["id_cau_hoi"] . "</td>
                                                        <td> <span class='name'>" . $row["ten_cau_hoi"] . "</span> </td>
                                                        <td> <span class='name'>" . $row["dap_an"] . "</span> </td>
                                                    </tr>";
                                                    $stt++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div> <!-- /.table-stats -->
                                </div>
                                <ul class="pagination">
                                    <?php
                                    $socau = ceil(getQs() / 10);
                                    for ($i = 0; $i < $socau; $i++) {
                                        if (($trang_hien_tai / 10) == $i) {
                                            echo "<li class='active'><a href='?trang=$i'>" . ($i + 1) . "</a></li>";
                                        } else {
                                            echo "<li><a href='?trang=$i'>" . ($i + 1) . "</a></li>";
                                        }
                                    }
                                    ?>
                                </ul>
                            </div> <!-- /.card -->
                        </div>
                    </div>
                </div>

                <!-- giao btvn -->
                <div class="clearfix"></div>
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body" style="display:flex">
                                    <h4 class="box-title" style="width:100%">BTVN </h4>
                                    <h4 class="box-title"><a href="btvn.php">Add</a> </h4>
                                </div>
                                <div class="card-body--">
                                    <div class="table-stats order-table ov-h">
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th class="serial">Stt</th>
                                                    <th>Tiêu đề</th>
                                                    <th>Ảnh</th>
                                                    <th>Nội dung</th>
                                                    <th>Hạn đóng</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php                                                
                                                $stt = 1;
                                                $result = btvn();
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo "<tr>
                                                        <td class='serial'>$stt</td>
                                                        <td> <span class='name'>" . $row["name"] . "</span> </td>
                                                        <td>";
                                                    if (!$row["img"] == "") {
                                                        echo "<img style='width:100px;height:100px;object-fit: contain' src='../images/" . $row["img"] . "'>";
                                                    }
                                                    echo "</td>
                                                    <td> <span class='name'>" . $row["content"] . "</span> </td>
                                                    <td> <span class='name'>" . $row["expired"] . "</span> </td>
                                                        <td><form method='post'>
                                                            <input type='hidden' name='idBTVN' value='" . $row["id"] . "'>
                                                            <button type='submit' name='deleteBT' class='badge badge-complete'>Delete</button>
                                                        </form></td>                                                        
                                                    </tr>";
                                                    $stt++;
                                                }
                                                if (isset($_POST["deleteBT"])) {
                                                    deleteBTVN($_POST["idBTVN"]);
                                                    header("Location: admin.php");
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- /.card -->
                        </div>
                    </div>
                </div>

                <!-- giao bài thi trắc nghiệm -->
                <div class="clearfix"></div>
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body" style="display:flex">
                                    <h4 class="box-title" style="width:100%">Kỳ thi</h4>
                                    <h4 class="box-title"><a href="them_bai_thi.php">Add</a> </h4>
                                </div>
                                <div class="card-body--">
                                    <div class="table-stats order-table ov-h">
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th class="serial" style="width: 30px;">Stt</th>
                                                    <th style="width: 200px;">Tiêu đề</th>
                                                    <th style="width: 300px;">Nội dung</th>
                                                    <th style="width: 80px;">Số câu</th>
                                                    <th style="width: 100px;">Số lần làm</th>
                                                    <th style="width: 120px;">Thời gian làm</th>
                                                    <th style="width: 120px;">Hạn đóng</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php                                                
                                                $stt = 1;
                                                $resultKT = KyThi();
                                                while ($row = mysqli_fetch_array($resultKT)) {
                                                    echo "<tr>
                                                        <td class='serial'>$stt</td>
                                                        <td> <span class='name'>" . $row["tieu_de"] . "</span> </td>
                                                        <td> <span class='name' >" . $row["noi_dung"] . "</span> </td>
                                                        <td><span class='name'>" . $row["so_luong_cau"] . "</span></td>
                                                        <td> <span class='name'>" . $row["so_lan"] . "</span> </td>
                                                        <td> <span class='name'>" . $row["thoi_gian_lam"] . " phút </span> </td>
                                                        <td> <span class='name'>" . $row["thoi_gian_dong"] . " </span> </td>
                                                        <td><form method='post'>
                                                            <input type='hidden' name='idKT' value='" . $row["id_KT"] . "'>
                                                            <a href='chitiet_kt.php?id_KT=". $row["id_KT"] ."' class='badge badge-complete'>Xem điểm</a>
                                                            <button type='submit' name='deleteKT' class='badge badge-complete'>Delete</button>
                                                        </form></td>                                                        
                                                    </tr>";
                                                    $stt++;
                                                }
                                                if (isset($_POST["deleteKT"])) {
                                                    deleteKyThi($_POST["idKT"]);
                                                    header("Location: admin.php");
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <?php ob_end_flush(); ?> -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="../js/main.js"></script>
</body>

</html>