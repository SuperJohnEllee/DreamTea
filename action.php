<?php
	$conn = mysqli_connect('localhost', 'root', '', 'dreamtea') or die('Connection Failed: ' . mysqli_error());

	if (isset($_GET['del_prod'])) {
		
		$del_prod = $_GET['del_prod'];
		$del_prod_sql = mysqli_query($conn, "DELETE FROM products WHERE ProductID = '$del_prod'");
		echo "<meta http-equiv='refresh' content='0; url=manage-products.php'>";
	}
?>