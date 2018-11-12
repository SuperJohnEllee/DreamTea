<!DOCTYPE html>
<?php
	session_start();
	$conn = mysqli_connect('localhost', 'root', '', 'dreamtea') or die('Connection Failed: ' . mysqli_error());
	if (!isset($_SESSION['username'])) {
		header("location: index.php");
	}
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
	</nav><br><br><br>
	<div class="container">
		<div class="page-header">
			<h1 class="text-center"><span class="fa fa-shopping-cart"></span> Manage Products</h1>
			<hr>
		</div>
		<div class="row">
			<div class="col-md-6">
				<h5>Input the fields completely</h5>
				<form method="post">
					<div class="md-form mb-4">
						<i class="fa fa-tag prefix"></i>
						<input class="form-control" type="text" name="prod_name">
						<label>Product Name</label>
					</div>
					<div class="md-form mb-4">
						<i class="fa fa-tag prefix"></i>
						<input class="form-control" type="text" name="prod_type">
						<label>Product Type</label>
					</div>
					<div class="md-form mb-4">
						<i class="fa fa-dollar prefix"></i>
						<input class="form-control" type="text" name="prod_price">
						<label>Product Price</label>
					</div>
					<div class="md-form mb-4">
						<i class="fa fa-database prefix"></i>
						<input class="form-control" type="number" name="prod_stocks" min="0">
						<label>Number of Stocks</label>
					</div>
					<div class="md-form">
						<button type="submit" class="btn btn-success" name="btn_add"><span class="fa fa-plus"></span> Add</button>
					</div>
				</form>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table table-hover">
				<thead class="thead-inverse">
					<tr>
						<th>Product ID</th>
						<th>Product Name</th>
						<th>Product Type</th>
						<th>Product Price</th>
						<th>No of Stocks</th>
						<th class="text-center" colspan="2">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$disp_prod = "SELECT * FROM products ORDER BY ProductID";
						$disp_prod_res = mysqli_query($conn, $disp_prod);

						if (mysqli_num_rows($disp_prod_res) > 0) {
							while ($disp_prod_row = mysqli_fetch_assoc($disp_prod_res)) {
						?>	
							<tr>
								<td><?php echo $disp_prod_row['ProductID']; ?></td>
								<td><?php echo $disp_prod_row['ProductName']; ?></td>
								<td><?php echo $disp_prod_row['ProductType']; ?></td>
								<td><?php echo $disp_prod_row['ProductPrice']; ?></td>
								<td><?php echo $disp_prod_row['ProductStocks']; ?></td>
								<td><a class="btn btn-info" href=""><span class="fa fa-edit"></span> Edit</a></td>
								<td><a class="btn btn-danger" onclick="return confirm('Delete this product?')" href="action.php?del_prod=<?php echo $disp_prod_row['ProductID'] ?>"><span class="fa fa-trash"></span> Delete</a></td>
							</tr>
						<?php	} ?>
 					<?php	} else {
							echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-warning'></span> No Products Found</h3></td></tr>";
						}
					?>
				</tbody>
			</table>
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

<?php
	if (isset($_POST['btn_add'])) {
		
		$prod_name = $_POST['prod_name'];
		$prod_type = $_POST['prod_type'];
		$prod_price = $_POST['prod_price'];
		$prod_stocks = $_POST['prod_stocks'];

		if (empty($prod_name)) {
			echo "<script>
				alert('Input Product Name');
				window.open('manage-products.php', '_self');
			</script>";
		} else if (empty($prod_type)) {
			echo "<script>
				alert('Input product type');
				window.open('manage-products.php', '_self');
			</script>";
		} else if (empty($prod_price)) {
			echo "<script>
				alert('Input product price');
				window.open('manage-products.php', '_self');
			</script>";
		} else {
			$sql = "INSERT INTO products(ProductName, ProductType, ProductPrice, ProductStocks)
			VALUES('$prod_name', '$prod_type', '$prod_price', '$prod_stocks')";
			mysqli_query($conn, $sql);
			echo "<meta http-equiv='refresh' content='0; url=manage-products.php'>";
		}
	}
?>
</body>
</html>