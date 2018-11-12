<!DOCTYPE html>
<?php
	session_start();

	$conn = mysqli_connect('localhost', 'root', '', 'dreamtea');
	if (!isset($_SESSION['username'])) {
		header("locaation: index.php");
	}

	$name = $_SESSION['name'];

	$prod_sql = "SELECT ProductID FROM products";
	$prod_res = mysqli_query($conn, $prod_sql);
	$prod_count = mysqli_num_rows($prod_res);

?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale-1.0">
	<title>Dream Tea</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/mdb.min.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light fixed-top purple">
		<a class="navbar-brand text-white" href="dashboard.php"><em>Dream Tea</em></a>
		<button class="navbar-toggler mdb-color" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbar">
			<div class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link active text-white" href="logout.php"><span class="fa fa-sign-out"></span> Logout</a>
				</li>
			</div>
		</div>
	</nav><br><br><br>
	<div class="container">
		<div class="page-header">
			<h1>Hello, <?php echo $name; ?></h1>
			<hr>
		</div>
		<div class="row">
			<div class="col-4">
				<a class="btn btn-info btn-lg" href="manage-products.php"><span class="fa fa-shopping-cart fa-5x"></span> Products(<?php echo $prod_count; ?>)</a>
			</div>
			<div class="col-4">
				<a class="btn btn-warning btn-lg" href="manage-inventory.php"><span class="fa fa-shopping-cart fa-5x"></span> Inventory</a>
			</div>
			<div class="col-4">
				<a class="btn btn-danger btn-lg" href="accounts.php"><span class="fa fa-user-secret fa-5x"></span> Accounts</a>
			</div>
		</div>
	</div>

<!-- JQuery -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>
</body>
</html>