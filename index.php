<!DOCTYPE html>
<?php
	session_start(); //starts session
	$conn = mysqli_connect('localhost', 'root', '', 'dreamtea'); // connection to database

	if (isset($_POST['login'])) {

		//define login variables
		$username = $_POST['username'];
		$password = $_POST['password'];

		if (empty($username)) {
			echo "<script>
				alert('Username is required');
				window.open('index.php', '_self');
			</script>";
		} else if (empty($password)) {
			echo "<script>
				alert('Password is required');
				window.open('index.php', '_self');
			</script>";
		} else {
			//query start for login
			$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
			$res = mysqli_query($conn, $sql);

			if (mysqli_num_rows($res) == 1) {
				$row = mysqli_fetch_assoc($res);

				//define session variables
				$_SESSION['id'] = $row['id'];
				$_SESSION['lastname'] = $row['lastname'];
				$_SESSION['firstname'] = $row['firstname'];
				$_SESSION['middlename'] = $row['middlename'];
				$_SESSION['name'] = $row['firstname'] . " " . $row['lastname'];
				$_SESSION['username'] = $row['username'];
				header("location: dashboard.php");
			} else {
				echo "<script>
				alert('Username or Password is incorrect');
			</script>";
			}
		}
	}
?>	
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale-1.0">
	<meta http-equiv="Content-Type" content="IE=edge">
	<title>Dream Tea</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/mdb.min.css">
  <link rel="icon" href="img/LOGO_MOD.jpg">
  <style>
     .parallax{
        background-image: url(https://us.123rf.com/450wm/mitdesign/mitdesign1707/mitdesign170700015/82757532-milk-tea-pouring-down-close-up-can-be-used-as-design-elements-3d-illustration.jpg?ver=6);
        background-position: center;
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-size: cover;
        opacity: 1.0;
        height: 700px;
     }
  </style>
</head>
<body class="purple lighten-4">
	<nav class="navbar navbar-expand-lg navbar-light fixed-top purple">
		<a class="navbar-brand text-white" href="index.php"><em>Dream Tea</em></a>
		<button class="navbar-toggler mdb-color" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbar">
			<div class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link active text-white" data-toggle="modal" data-target="#loginModal"><span class="fa fa-sign-in"></span> Login</a>
				</li>
			</div>
		</div>
	</nav>
	<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content cyan lighten-5">
            <div class="modal-header text-center purple lighten-3">
                <h4 class="modal-title w-100 font-weight-bold"><span class="fa fa-sign-in"></span> Admin Login </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <p class="text-center">Note: Only the Dream Tea Personnels can access this system</p>
            <div class="modal-body mx-3">
                <form  method="post">
                	<div class="md-form mb-4">
                		<i class="fa fa-user prefix dark-text"></i>
                		<input class="form-control" type="text" name="username" id="username">
                		<label>Username</label>
                	</div>
                    <div class="md-form mb-4">
                        <i class="fa fa-lock prefix dark-text"></i>
                        <input type="password" name="password" id="password" class="form-control">
                        <label data-error="wrong" data-success="right" for="password">Password</label>
                    </div>
                    <div class="md-form mb-4">
                        <button type="submit" class="btn btn-primary pull-right" name="login"><span class="fa fa-sign-in"></span> Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
    <div class="view jarallax" style="height: 200vh;">
    <img class="jarallax-img" src="img/dream_tea.jpg" height="1350" alt="">
    <div class="mask rgba-blue-slight">
      <div class="container flex-center text-center">
        <div class="row mt-5">
          <!--<div class="col-md-12 wow fadeIn mb-3">
            <h1 class="display-3 mb-2 font-weight-bold cyan-text wow fadeInDown" data-wow-delay="0.3s">DREAMTEA <br><a class="pink-text font-weight-bold">A CUP OF MILKY TREASURE</a></h1>
          </div>-->
        </div>
      </div>
    </div>
  </div>
    <div class="mask rgba-blue-slight">
      <div class="container flex-center text-center">
        <div class="row mt-5">
          <div class="col-md-12 wow fadeIn mb-3">
            <h1 class="display-3 mb-2 font-weight-bold cyan-text wow fadeInDown" data-wow-delay="0.3s">DREAMTEA <br><a class="pink-text font-weight-bold">A CUP OF MILKY TREASURE</a></h1>
          </div>
        </div>
      </div>
    </div>
    <div class="parallax"></div>
    <div class="container">
      <div class="row">
        <div class="col-4">
            <img src="img/menu.png" height="400px" width="250px">
        </div> 
        <div class="col-4">
            <img src="img/menu2.png" height="400px" width="250px">
        </div>
         <div class="col-4">
            <img src="img/menu3.png" height="400px" width="250px">
        </div>
    </div>
  </div>
  
  <div style="padding: 15px 0;" class="purple text-white text-center">
  	<h6 class="col-lg-12">Develop by Belhera Solutions &copy; 2018</h6>
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