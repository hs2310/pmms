<!DOCTYPE html>
<html lang="en">
<head>
	<?
	session_start();
	include "../includes/file.php";
	include "../includes/config.php";
	include '../includes/usercheck.php';
	if($_SESSION['type'] == 'admin')
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
		<a href="report.php">Reports</a>
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
						if ($_SERVER["REQUEST_METHOD"] == "POST") 
						{
							$head=$_POST['link_heading'];
							$content=$_POST['link'];
						}
						$date=date("d-m-Y");

						function display()
						{
							global $con;
							$r=mysqli_query($con,"select * from ".$_SESSION['sub']."faq");
							if (mysqli_num_rows($r) > 0)
							{
								$x=1;
								while($row = mysqli_fetch_assoc($r)) 
								{
									echo "<div class='card'>
									<div class='card-header'>
									<a class='card-link text-dark' data-toggle='collapse' data-parent='#accordion' href='#collapse".$x."'>
									<h6 style='display:inline;'>".$row['heading']."</h6><a href='delete.php?id=".$row["id"]."&db=".$_SESSION['sub']."faq'><span><img src='../img/cancel.png' alt='404'class='float-right'/></span></a>
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
								echo "<div class='col-lg-12 text-center'><a href='#' class ='text-center text-white'>No FAQ's to show</a></div>";
							}
						}
						if(!empty($head) && !empty($content))
						{
							$sql="insert into ".$_SESSION['sub']."faq(heading,content) values('$head','$content')";
							if(mysqli_query($con,$sql))
								echo "<script>alert('data inserted')</script>";
							display();
						}
						else if(empty($head) || empty($content))
						{
							display();
						}
						mysqli_close($con);
						?>	
					</div>
					<div class='container-fluid' style="padding-top: 2%;">
						<div class='col-lg-12'>
							<form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
								<label for="link_heading">Question::</label>
								<input type="text" class="form-control" name="link_heading" id="link_heading" value="" required="required">
								<label for="link">Answer::</label>
								<textarea name="link" id="link" value="" class="form-control" required="required"></textarea>
								<div class="text-center" style="padding:0;margin: 4%; margin-left: 0;"> 
									<button type="submit" class="btn">Add a Question</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>