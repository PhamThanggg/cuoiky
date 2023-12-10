<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="	sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</head>
<style>
    main {
        margin-top: 10%;
        padding: 5%;
        margin-top: 70px;
        overflow-x: auto;
        min-height: 100vh;
        font-family: "Nunito", sans-serif;
    }
</style>

<body>
    <?php
    include "navbar.php";
    include "../function.php";
    if (!isLogin()) {
        header("location: dang_nhap.php");
    }
    ?>
    <main>
        <?php
        $id = $_GET["idBT"];
        $result = get1BT($id);
        while ($row = mysqli_fetch_array($result)) {
            echo '<div style="border: 1px solid #dee2e6; height: 800px; margin-bottom: 100px; border-radius: .375em;">
                <div class="header"
                    style="padding: 5px; width: 100%; height: 4%; background-color: #485fc7; color: #fff; font-weight: bold; border-top-left-radius: .375em; border-top-right-radius: .375em;"
                    title="Tên bài tập">' . $row["name"] . ' (Hệ thống đóng khi đủ 5 bạn nộp nhanh - lưu ý các bạn nén thành file zip để nộp) </div>';
            if($row["img"]){
                echo '<img style="width:100%;height:96%;object-fit: contain;"
                src="https://uploads.nguoidothi.net.vn/content/f29d9806-6f25-41c0-bcf8-4095317e3497.jpg" alt="">';
            } else {
                echo $row["content"];
            }
            echo '</div>
            <div id="nopBai-container">
                <h5
                    style="margin: auto 0; background-color: #f14668; color: #fff; border-radius: 25px; padding: 5px;  width: 250px; text-align: center;">
                    Trạng thái: Chưa nộp</h5><br>
                <button id="timeUploadFile"
                    style="margin: auto 0; background-color: #28a745; color: #fff; border-radius: 25px; width: fit-content; padding: 10px; display: flex; align-items: center; border: none; gap: 10px; outline: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                        class="bi bi-calendar-check" viewBox="0 0 16 16">
                        <path
                            d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z">
                        </path>
                        <path
                            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z">
                        </path>
                    </svg>
                    Hạn chót: ' . $row["expired"] . '</button><br>
            </div>
            <div style="border: 1px solid #dee2e6; width: 100%; height: 300px; margin-top: 11px; border-radius: .5rem;">
                <table cellpadding="10" class="table table-bordered">
                    <tbody>
                        <tr>
                            <th colspan="3" style="text-align: center;">Bài nộp được chấp nhận</th>
                        </tr>
                        <tr>
                            <th style="color: #ff4d4f; background: #fff2f0; border-color: #ffccc7;">Chưa có bài nộp được
                                chấp nhận</th>
                        </tr>
                    </tbody>
                </table>
            </div>';
        }
        ?>        
    </main>
</body>

</html>