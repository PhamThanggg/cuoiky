<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khóa học</title>
    <!-- Begin bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="	sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <!-- End bootstrap cdn -->

</head>
<style>
    .card-img-top {
        width: 380px;
        height: 260px;
        object-fit: contain;
    }

    .topic {
        width: 85%;
        height: 80px;
        background-color: #eff1fa;
        border-color: #485fc7;
        color: #3850b7;
        border-radius: 0.375em;
        border-style: solid;
        border-width: 0 0 0 5px;
        line-height: 80px;
        padding-left: 1.5%;
        padding-right: 1.5%;
        font-size: 22px;
        font-weight: 600;
        margin-top: 30px;
        display: flex;
        justify-content: space-between;
    }

    .exercise-item {
        display: flex;
        background-color: #fff;
        align-items: center;
        position: relative;
        width: 85%;
        background-color: #fff;
        border-radius: 4px;
        box-shadow: 0.8em 0.8em 0 0 #00d1b2;
        border: 2px solid #00d1b2;
        margin-top: 1.5em;
        padding: 0 2em;
        box-sizing: border-box;
    }

    .exercise-info {
        padding: 10px;
        width: 80%;
    }

    .title {
        font-size: 22px;
        font-weight: 600;
        color: #46535e;
        line-height: 34px;
    }

    .decs-item {
        font-size: 12px;
        margin: 4px 24px 0 0;
        color: #666;
        line-height: 18px;
    }

    .btn-cus {
        background: #00d1b2;
        border: 1px solid #00d1b2;
        color: #fff;
        max-width: 170px;
        width: 100%;
        font-size: 16px;
        font-weight: 600;
        padding: 0 12px;
        display: block;
        cursor: pointer;
        line-height: 44px;
        text-align: center;
        min-width: 60px;
        border-radius: 3px;
        text-decoration: none;
        outline: none;
        box-sizing: border-box;
        margin-right: 25px;
        cursor: pointer;
    }
</style>

<body>
    <?php
    include 'navbar.php';
    include '../function.php';
    if (!isLogin()) {
        header('location: dang_nhap.php');
    }
    ?>

    <main style="min-height: 100vh; width: 100%;margin:70px 0">
        <div class="row row-cols-1 row-cols-md-3 g-4" style="margin: 0 auto; width: 80%;">
            <div class="content-wrap" style="width:100%">
                <?php
                include "../connectdb.php";
                $result = getBTVN();
                $stt = 1;
                while ($row = mysqli_fetch_array($result)) {
                    echo "<div class='topic '>
                        <p>Bài $stt</p>
                    </div>
                    <div class='exercise-item '>
                        <div class='exercise-info'>
                            <div class='title'>". $row["name"] ." (Hệ thống đóng khi đủ 5 bạn nộp nhanh - lưu ý các bạn nén
                                thành file zip để nộp)</div>
                            <div class='decs'>
                                <div class='decs-item'>Hạn nộp: ". $row["expired"] ."</div>
                                <div class='decs-item'></div>
                            </div>
                        </div>
                        <a href='chitiet_bt.php?idBT=".$row["id"]."' class='btn-cus'>Chi tiết</a>
                    </div>";
                    $stt++;
                }
                ?>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>


</html>