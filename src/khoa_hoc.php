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
</style>

<body>
	<?php
	include 'navbar.php';
	include '../function.php';
	if (!isLogin()) {
		header('location: dang_nhap.php');
	}
	?>
	
	<main style="min-height: 100vh; width: 100%;">
		<div style="text-align: center;padding-top:70px">
			<h2>Khóa học</h2>
		</div>
		<div class="row row-cols-1 row-cols-md-3 g-4" style="margin: 0 auto; width: 80%;">
			<!-- begin khóa học -->
			<?php
			include '../connectdb.php';
			$sql = "SELECT * FROM `khoa_hoc`";
			$result = mysqli_query($conn, $sql);
			while ($row = mysqli_fetch_array($result)) {
				if ($row[0] != '') {
					echo "<div class='col'>
							<div class='card'>
								<img src='" . $row["anh_khoa_hoc"] . "' class='card-img-top' alt='Course Image'>
								<div class='card-body' style='text-align:center'>
									<h5 class='card-title'>" . $row["ten_khoa_hoc"] . "</h5>
									<a style='width:40%' class='btn btn-primary' href='bien_tap.php?id=" . $row["id_khoa_hoc"] . "'>Chi tiết</a></div>
								</div>
						</div>";
				}
			}
			?>
			<!-- end khóa học -->


		</div>
	</main>

	<div class="card-body" style="text-align:center">
		<a style="width:40%" class="btn btn-primary" href="xembtvn.php">Bài tập</a>
	</div>

	<?php include 'footer.php'; ?>
</body>


</html>