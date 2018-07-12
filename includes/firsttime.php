<?
session_start();
include "config.php";
$_SESSION['back'] = 1;
if(!isset($_SESSION['username']) || $_SESSION['type'] != 'student')
{
	header("Location:../index.php");
}
if(isset($_POST['first']) && isset($_POST['id']) && isset($_POST['pwd'])  && isset($_POST['c_pwd']) && isset($_POST['email']))
{
	$id = $_POST['id'];
	$pwd = $_POST['pwd'];
	$cpwd = $_POST['c_pwd'];
	$email = $_POST['email'];
	$flag = 0;
	if(strlen($pwd) < 5 || strlen($pwd) > 12)
	{
		$flag = 1;
		echo "<script>alert('Password less than 5 or greater than 12');</script>";	
	}
	if(strcmp($pwd,$cpwd) != 0)
	{
		$flag = 1;
		echo "<script>alert('Password and Confirm password field not same');</script>";
	}
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
	{
		$flag = 1;
  		echo "<script>alert('invalid email format');</script>";
	}
	if($flag == 0)
	{ 
		unset($_SESSION['back']);
		$result= mysqli_query($con,"UPDATE ".$_SESSION['sub']."student SET password = '$pwd' , email = '$email' WHERE id = '$id'");
		if($result)
		{
			header("location:../".$_SESSION['type']."/dashboard.php?");
		}
	}
}
if(isset($_POST['logout']))
	header("location:logout.php");
?>                                               
<!DOCTYPE html>
<html lang="en">
<head>
	<?
	include "file.php";
	?>
	<link rel="stylesheet" h ref="../css/style.css">
	<link rel='shortcut icon' type='../image/png' href='./img/BVM_Logo.png' />
</head>
<body>
	<div class="card bg-primary	">
		<div class="card-body">
			<div class="container">
				<div class="row">
					<div class="col-xl-12 text-center" style="padding: 1%;" >	
						<img style="float: left;margin-top: -1%;margin-left: 5%;" src="../img/BVM_Logo1.png" alt="img not found 404"/>
						<h2 class="text-white" style="">Project Monitoring and Management System</h2>
						<h3 class="text-white">Birla Vishwakarma Mahavidyalaya</h3>
							<h6 class="text-white"><u>An Autonomous Institution</u></h6>
					</div>
				</div>
			</div>
		</div> 
	</div>
	<div class="container">
		<div class='row'>
			<div class='col-lg-12'>
				<h3 class="text-center" style="padding: 5%;">Registration Form</h3>
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="form" id="form1" style="margin-left: 20%; margin-right: 20%;">
					<div class="form-group">
						<label for="userid">User ID:</label>
						<input type="text" class="form-control" value="<?echo $_SESSION['username'];?>" name="id"readonly>
					</div>
					<div class="form-group">
						<label for="pwd">Password:</label> 
						<input type="password" class="form-control" name="pwd" required="required">
					</div>
					<div class="form-group">
						<label for="pwd">Confirm Password:</label>
						<input type="password" class="form-control" name="c_pwd" required="required">
					</div>
					<div class="form-group">
						<label for="pwd">Email Id:</label>
						<input type="email" class="form-control" name="email" required="required">
					</div> 
					<div class="col-md-12 text-center form-control" style="padding:0;margin: 4%; margin-left: 0;"> 
						<button type="submit" class="btn btn-primary btn-block" name="first">Submit</button>
					</div>
				</form>
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="form1" id="form1" style="margin-left: 20%; margin-right: 20%;">
					<div class="col-md-12 text-center form-control" style="padding:0;margin: 4%; margin-left: 0;"> 
						<button type="submit" class="btn btn-primary btn-block" name="logout">Logout</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>