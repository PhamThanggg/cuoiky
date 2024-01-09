<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lịch sử điểm</title>
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
    include "../function.php";
    if (isset($_SESSION["acc"])) {
        $id_user = $_SESSION["acc"]['id'];
    } else {
        header("location: dang_nhap.php");
    }    
    ?>
        <h1 style="margin-top: 70px; margin-left: 25px;">Lịch Sử</h1>
        <div class="content">
            <div class="animated fadeIn">
                <!-- Lich su thi -->
                <div class="clearfix"></div>
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="box-title">Lịch sử làm bài thi (10 bài gần nhất)</h4>
                                </div>
                                <div class="card-body--">
                                    <div class="table-stats order-table ov-h">
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th class="serial">Tên kỳ thi</th>
                                                    <th>Thời gian thi</th>
                                                    <th>Thời gian nộp bài</th>
                                                    <th>Điểm</th>
                                                    <th>Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $stt = 1;
                                                $result = getDiemThi($id_user);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $id_diem = $row['id_diem'];
                                                    $id_KT = $row['id_KT'];
                                                    // echo $id_diem;
                                                    echo "<tr>
                                                    <td class='serial'>". $row['tieu_de'] . "</td>
                                                        <td> <span class='name'>" . $row['thoi_gian_mo'] . "</span> </td>
                                                        <td> <span class='name'>" . $row['thoi_gian'] . "</span> </td>
                                                        <td> <span class='product'>" . $row['diem'] . "</span> </td>
                                                        <td> <a href='chi_tiet_baiThi.php?id_diem=$id_diem&id_KT=$id_KT' >Chi tiet</a></td>
                                                        <td>
                                                            <form method='post'>
                                                            <input type='hidden' name='idUser' value='" . "" . "'>
                                                            
                                                            </form>
                                                        </td>
                                                    </tr>";
                                                    $stt++;
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

                <!-- lich su luyên tập -->
                <div class="clearfix"></div>
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="box-title">Lịch sử luyện tập (10 bài gần nhất)</h4>
                                </div>
                                <div class="card-body--">
                                    <div class="table-stats order-table ov-h">
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th class="serial">Tên khóa hoc</th>
                                                    <th>Thời gian làm</th>
                                                    <th>Thời gian nộp bài</th>
                                                    <th>Điểm</th>
                                                    <th>Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $stt = 1;
                                                $result = getDiemLuyenTap($id_user);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo "<tr>
                                                    <td class='serial'>". $row['ten_khoa_hoc'] . "</td>
                                                        <td> <span class='name'>" . $row['thoi_gian_dau'] . "</span> </td>
                                                        <td> <span class='name'>" . $row['thoi_gian'] . "</span> </td>
                                                        <td> <span class='product'>" . $row['diem'] . "</span> </td>
                                                        <td>
                                                            <form method='post'>
                                                            <input type='hidden' name='idUser' value='" . "" . "'>
                                                            
                                                            </form>
                                                        </td>
                                                    </tr>";
                                                    $stt++;
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
            </div>
        </div>

        <!-- <?php ob_end_flush(); ?> -->
  
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="../js/main.js"></script>
</body>

</html>