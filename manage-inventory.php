<!DOCTYPE html>
<?php
	session_start();
	$conn = mysqli_connect('localhost', 'root', '', 'dreamtea') or die('Connection Failed: ' . mysqli_error());
	if (!isset($_SESSION['username'])) {
		header("location: index.php");
	}

	$inv_sql = mysqli_query($conn, "SELECT * FROM products");
	$inv_row = mysqli_fetch_assoc($inv_sql);
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
			<h1 class="text-center"><span class="fa fa-database"></span> Manage Inventory</h1>
			<hr>
		</div>
		<div class="table-responsive">
			<table class="table table-hover" id="tblInventory">
				<thead class="thead-inverse">
					<tr>
						<th>Product ID</th>
						<th>Product Name</th>
						<th>Product Type</th>
						<th>Product Price</th>
						<th>Stocks</th>
						<th class="text-center" colspan="3">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$disp_prod = "SELECT * FROM products  ORDER BY ProductID";
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
								<form method="post">
									<td>
										<input type="hidden" name="prod_id" value="<?php echo $disp_prod_row['ProductID']; ?>">
										<input class="form-control" type="number" name="txtAddStocks" min="0"></td>
									<td><button class="btn btn-info" name="add_stocks"><span class="fa fa-plus"></span> Add Stocks</button></td>
									<td><button class="btn btn-danger" name="minus_stocks"><span class="fa fa-minus"></span> Delete Stocks</button><td>
								</form>
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
<?php 
	if (isset($_POST['add_stocks'])) {

		$txtAddStocks = $_POST['txtAddStocks'];
		$prod_id = $_POST['prod_id'];

		$prod_sql = mysqli_query($conn, "SELECT * FROM products");
		$prod_row = mysqli_fetch_assoc($prod_sql);

		$add_stocks_sql = mysqli_query($conn, "UPDATE products 
			SET ProductStocks = ProductStocks +  '".$txtAddStocks."' WHERE ProductID = '$prod_id'");
		echo "<meta http-equiv='refresh' content='0; url=manage-inventory.php'>";
	
	} else if (isset($_POST['minus_stocks'])) {
		
		$txtAddStocks = $_POST['txtAddStocks'];
		$prod_id = $_POST['prod_id'];

		$prod_sql = mysqli_query($conn, "SELECT * FROM products");
		$prod_row = mysqli_fetch_assoc($prod_sql);

		$add_stocks_sql = mysqli_query($conn, "UPDATE products 
			SET ProductStocks = ProductStocks -  '".$txtAddStocks."' WHERE ProductID = '$prod_id'");
		echo "<meta http-equiv='refresh' content='0; url=manage-inventory.php'>";
	}
?>
<script>
	
	var table = document.getElementById('tblInventory'), rIndex;

	for (var i = 0; i < table.rows.length; i++) {
		table.rows[i].onclick = function(){
			rIndex = this.rowIndex;

			document.getElementById('txtGetID').value = this.cells[1].innerHTML;
		}
	}
</script>
<!-- JQuery -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>

<?php

?>
</body>
</html>