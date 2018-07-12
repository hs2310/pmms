<?
session_start();
include '../includes/config.php';
include '../includes/usercheck.php';
if($_SESSION['type'] == 'admin')
{}
else
{
	header("location:../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?include "../includes/file.php";?>
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<div class="card " style="background-color: #610835">
		<div class="card-body">
			<div class="container">
				<div class="row">
					<div class="col-xl-10 text-center" style="padding: 1%;" >	
						<img style="float: left;margin-top: -1%;margin-left: 5%;" src="../img/BVM_Logo1.png" alt="img not found 404"/>
						<h2 class="text-white" style="">Project Monitoring and Management System</h2>
						<h3 class="text-white">Birla Vishwakarma Mahavidyalaya</h3>
							<h6 class="text-white"><u>An Autonomous Institution</u></h6>
						</div>
						<div class="col-xl-2 text-center" style="padding: 1%;" >	
						<h6 class="text-white" style="display: inline-block;">Logged In As:<br><br> <?echo $_SESSION['username'];?></h6>
					</div>
				</div>
			</div>
		</div> 
	</div>
	<div class="col-lg-2 sidenav">
		<a href="dashboard.php">Dashboard</a>
		<a href="team.php">Team Registration</a>
		<a href="project.php">Project Details</a>
		<a href="faq.php">FAQs</a>
		<a href="report.php">Reports</a>
		<a href="../includes/logout.php">Logout</a>
	</div>
	<div class="container-fluid">	
		<div id="main" class="col-lg-12">
			<div class="row">
				<div class="col-xl-12 text-center text-white" style="background-color: #610835">
					<h2 style="padding: 1%;margin: 0;">Reports</h2>
				</div>
			</div>

			<div class="row" style="padding-top: 1%;">
				<div class="col-lg-2"></div>
				<div class="col-lg-8">
					<?
					if(isset($_POST['ppr']))
					{
						global $con;
						$ppr = $_POST['ppr'];
						$r = mysqli_query($con,"UPDATE ".$_SESSION['sub']."report SET ppr = $ppr") or mysqli_error($con);
						echo "<div class='text-center'>Teams have to Submit <strong>$ppr</strong> Periodic Report(s)</div>";
						$_SESSION['report'] = $ppr;
					}
					if(isset($_POST['max']) && isset($_POST['min']))
					{
						global $con;
						$min = $_POST['min'];
						$max = $_POST['max'];
						$r = mysqli_query($con,"UPDATE ".$_SESSION['sub']."report SET team_min = $min , team_max = $max") or mysqli_error($con);
						echo "<div class='text-center'>Teams have to be minimum <strong>$min</strong> maximum of <strong>$max</strong>.</div>";
						$_SESSION['min'] = $min;	
						$_SESSION['max'] = $max;
					}
					?>
					<br>
					<form method="POST" action=""<?echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"" name="form" id="form1">
						<div class="form-group">
							<label for="type">Number of Period Reports to be submitted:</label>
							<select class="form-control" id="ppr" name="ppr" required="required">
								<option value="">Select a Number</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>	
								<option value="4">4</option>
							</select>
						</div>
						<div class="col-md-12 text-center form-control" style="padding:0;margin: 4%; margin-left: 0;"> 
							<button type="submit" class="btn btn-block">Submit</button>
						</div>
					</form>
					<form method="POST" action=""<?echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"" name="form1" id="form">
						<div class="form-group">
							<label for="type">Minimum Number of Students needed in a group:</label>
							<select class="form-control" id="ppr" name="min" required="required">
								<option value="">Select a Number</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>	
								<option value="4">4</option>
							</select>
						</div>
						<div class="form-group">
							<label for="type">Maximum Number of Students needed in a group:</label>
							<select class="form-control" id="ppr" name="max" required="required">
								<option value="">Select a Number</option>
								<option value="2">2</option>
								<option value="3">3</option>	
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
						</div>
						<div class="col-md-12 text-center form-control" style="padding:0;margin: 4%; margin-left: 0;"> 
							<button type="submit" class="btn btn-block">Submit</button>
						</div>
					</form>
				</div>
			</div>				
		</div>
	</div>
</body>
</html>
