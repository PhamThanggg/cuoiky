<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Điểm</title>
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
    body{
        width: 99%;
    }
    .badge{
        margin-bottom: 20px;
        padding: 8px 15px;
        background-color: #ccc;
        color: black;
    }
</style>
<body>
<?php
    session_start();
    if (!isset($_SESSION["user"])) {
        header("Location: dang_nhap.php");
    }
    ?>
    <a href='admin.php' class='badge badge-complete'>Trở lại</a>
    <div class="orders" style>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial" style="width: 30px;">Stt</th>
                                        <th style="width: 200px;">Tên khóa học</th>
                                        <th style="width: 200px;">Tên người làm</th>
                                        <th style="width: 300px;">Điểm</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../function.php';
                                    $idKT = $_GET['id_KT'];
                                    $stt = 1;
                                    $resultKT = getDiemLT($idKT);
                                    while ($row = mysqli_fetch_array($resultKT)) {
                                        echo "<tr>
                                                        <td class='serial'>$stt</td>
                                                        <td> <span class='name'>" . $row["ten_khoa_hoc"] . "</span> </td>
                                                        <td> <span class='name'>" . $row["user_name"] . "</span> </td>
                                                        <td> <span class='name'>" . $row["diem"] . "</span> </td>
                                                                                                              
                                                    </tr>";
                                        $stt++;
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
</body>

</html>