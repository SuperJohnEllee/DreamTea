<!DOCTYPE html>
<?php
	session_start();
	$conn = mysqli_connect('localhost', 'root', '', 'dreamtea');
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
	<div class="modal fade" id="addAccountModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header text-center">
				<h3 class="modal-title w-100 text-dark"><strong><span class="fa fa-user-circle"></span> Add Account</strong></h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
			</div>
			<p class="text-center">Note: Do not use same username</p>
			<div class="modal-body mx-4">
                <form method="post">
                    <div class="md-form mb-5">
                        <i class="fa fa-user-circle text-dark prefix"></i>
                        <input type="text" name="lastname" id="lastname" class="form-control" required>
                        <label data-error="wrong" data-success="right" for="news_title">Last Name</label>
                    </div>
                    <div class="md-form mb-5">
                        <i class="fa fa-user-circle text-dark prefix"></i>
                        <input type="text" name="firstname" id="firstname" class="form-control" required>
                        <label data-error="wrong" data-success="right" for="news_title">First Name</label>
                    </div>
                    <div class="md-form mb-5">
                        <i class="fa fa-user-circle text-dark prefix"></i>
                        <input type="text" name="midname" id="midname" class="form-control" required>
                        <label data-error="wrong" data-success="right" for="news_title">Middle Name</label>
                    </div>
                    <div class="md-form mb-5">
                        <i class="fa fa-user-circle text-dark prefix"></i>
                        <input type="text" name="username" id="username" class="form-control" required>
                        <label data-error="wrong" data-success="right" for="news_title">Username</label>
                    </div>
                    <div class="md-form mb-5">
                        <i class="fa fa-lock text-dark prefix"></i>
                        <input type="text" name="password" id="password" class="form-control" required>
                        <label data-error="wrong" data-success="right" for="news_title">Password</label>
                    </div>	
                    <div class="md-form mb-5">
                    	<button class="btn btn-success" name="add_account"><span class="fa fa-plus"></span> Add</button>
                    </div>
                </form>
            </div>
		</div>
	</div>
</div>
<div class="container">
	<h1><span class="fa fa-user-circle"></span> Manage Accounts</h1>
	<hr>
	<a class="btn btn-info" data-toggle="modal" data-target="#addAccountModal">Add Account</a>
	<div class="table-responsive">
		<table class="table table-hover">
			<thead class="thead-inverse">
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Username</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$conn = mysqli_connect('localhost', 'root', '', 'dreamtea');
					$disp_user = mysqli_query($conn, "SELECT * FROM users");
					if (mysqli_num_rows($disp_user) > 0) {
						while ($user_row = mysqli_fetch_assoc($disp_user)) {
							echo "<tr>
								<td>".$user_row['id']."</td>
								<td>".$user_row['lastname'].", ".$user_row['firstname']." ".$user_row['middlename']."</td>
								<td>".$user_row['username']."</td>
							</tr>";
						}
					} else {
						echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-warning'></span> No Users Found</h3></td></tr>";
					}
				?>
			</tbody>
		</table>
	</div>
</div>
<?php
	$conn = mysqli_connect('localhost', 'root', '', 'dreamtea');
	if (isset($_POST['add_account'])) {
		
		$lastname = $_POST['lastname'];
		$firstname = $_POST['firstname'];
		$midname = $_POST['midname'];
		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql = "INSERT INTO users(lastname, firstname, middlename, username, password)
		VALUES('$lastname', '$firstname', '$midname', '$username', '$password')";
		mysqli_query($conn, $sql);
		echo "<meta http-equiv='refresh' content='0; url=accounts.php'>";
	
	}
?>
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