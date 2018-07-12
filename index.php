<?
session_start();
if(isset($_SESSION['back']))
{
	header("location:includes/firsttime.php");
}
if(isset($_SESSION['username']))
{
	header("location:".$_SESSION['type']."/dashboard.php");
}
if (isset($_GET['q']))
{
	if($_GET['q'] == 1)
		echo "<script>alert('Invalid Login Credentials.');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?
	include "includes/file.php";
	include "includes/config.php";
	?>
	<link rel="stylesheet" href="css/style.css">
	<link rel='shortcut icon' type='image/png' href='./img/BVM_Logo.png' />
</head>
<body style="background-color:#0d1925" class="text-white">
	<div class="card" style="background-color: #610835">
		<div class="card-body">
			<div class="container">
				<div class="row">
					<div class="col-xl-12 text-center" style="padding: 1%;" >	
						<img style="float: left;margin-top: -1%;" src="img/BVM_Logo1.png" alt="img not found 404"/>
						<h2 class="text-white" style="">Birla Vishwakarma Mahavidyalaya</h2>
						<h6 class="text-white"><u>An Autonomous Institution</u></h6>
						<h5 class="text-white">Project Monitoring and Management System</h5>
					</div>
				</div>
			</div>
		</div> 
	</div>
	<br>
	<div class="container">
		<div class="row">
			<div class="col-lg-3 text-center">
				<!-- <img style="padding-top: 5%;" src="img/BVM_Logo1.png" alt="img not found 404"/>
				<h3 class="text-center" style="padding-top: 15%;"><u>Purpose of the Portal</u></h3>
				<h6 style="padding-top: 5%;font-size:20px;padding-left: 6%;padding-right: 6%;" class="text-justify font-weight-normal">
					The objective of Project Monitoring and Management System is to monitor the projects of the students and guide them for their project in inorder to enhance and apply their development skills.
				</h6>-->
			</div>
			<div class="col-lg-6" style="padding-left: 5%;" >
				<h3 class="text-center" style="margin-top: 5%;margin-bottom: 5%;padding:3%;"><u>Login</u></h3>
				<form method="POST" action="includes/logincheck.php" name="form" id="form1">
					<div class="form-group">
						<label for="userid">User ID:</label>
						<input type="text" class="form-control" id="uid" name="username" required="required">
					</div>
					<div class="form-group">
						<label for="pwd">Password:</label>
						<input type="password" class="form-control" id="pwd" name="password" >
					</div>
					<div class="form-group">
						<label for="type">User Type:</label>
						<select class="form-control" id="type" name="type" required="required">
							<option value="">Select User type</option>
							<option value="student">Student</option>
							<option value="faculty">Faculty Guide</option>
							<option value="admin">Course Co-ordinator</option>
						</select>
					</div>
					<div class="form-group">
						<label for="type">Subject:</label>
						<select class="form-control" id="sub" name="sub" required="required">
							<option value="">Select Subject</option>
							<option value="mini_">Mini Project</option>
							<option value="project1_">Project - I</option>
							<option value="project2_">Project - II</option>
						</select>
					</div>
					<div class="col-md-12 text-center form-control" style="padding:0;margin: 4%; margin-left: 0;"> 
						<button type="submit" class="btn btn-block text-white" style="background-color: #610835">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>