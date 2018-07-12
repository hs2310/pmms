<!DOCTYPE html>
<html lang="en">
<head>
	<?
	session_start();
	if(isset($_SESSION['back']))
		header("location:../includes/firsttime.php");
	include "../includes/file.php";
	include "../includes/config.php";
	include '../includes/usercheck.php';
	if($_SESSION['type'] == 'student')
	{}
	else
	{
		header("location:../index.php");
	}
	?>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<div class="card" style="background-color: #610835">
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
		<a href="../includes/logout.php">Logout</a>
	</div>

	<div class="container-fluid" id="main"> 
		<div class="col-lg-12">
			<div class="row">
				<div class="col-xl-12 text-center text-white" style="background-color: #610835">
					<h2 style="padding: 1%;margin: 0;">FAQ's</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-12" style="padding: 1%;">
					<div id="accordion">
						<?
						function display()
						{
							global $con;
							$s = "SELECT * FROM ".$_SESSION['sub']."faq";
							$r=mysqli_query($con,$s);
							if (mysqli_num_rows($r) > 0)
							{
								$x=1;
								while($row = mysqli_fetch_assoc($r)) 
								{
									echo "<div class='card'>
									<div class='card-header'>
									<a class='card-link text-dark' data-toggle='collapse' data-parent='#accordion' href='#collapse".$x."'>
									<h6 style='display:inline;'>".$row['heading']."</h6>
									</a>
									</div>
									<div id='collapse".$x."' class='collapse hide'>
									<div class='card-body text-dark'>
									".$row['content']."
									</div>
									</div>
									</div>";
									$x++;
								}	
							}
							else 
							{
								echo "<div class='col-lg-12 text-center'><a href='#' class= 'text-center text-white'>No FAQ's to show</a></div>";
							}
						}
						display();
						mysqli_close($con);
						?>
					</div>  
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>