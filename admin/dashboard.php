<?
session_start();
include '../includes/usercheck.php';
include '../includes/config.php';
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
	<?require '../includes/file.php';
	require '../includes/usercheck.php';
	?>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
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
					<h2 style="padding: 1%;margin: 0;" >Dashboard</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-12" style="padding: 1%;" id="board">
					<!-- <div class="text-danger text-center" style="padding: 1%;">Notice from the Course Co-ordinator will be displayed here.</div>
					 --><table class='table text-center text-primary'>
						<?
						if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['link_heading']) && isset($_POST['link'])) 
						{
							$head=$_POST['link_heading'];
							$content=$_POST['link'];
						}
						$date=date("d-m-Y");
						function display()
						{
							global $con;
							$r=mysqli_query($con,"select * from ".$_SESSION['sub']."dashboard");
							if (mysqli_num_rows($r) > 0)
							{
								echo "<thead class='thead-light '>
								<tr>
								<th class='w-25'>Date</th>
								<th class='w-50'>Notice</th>
								<th class='w-25'>delete</th>
								</tr>

								</thead>
								<tbody>";
								$x=1;
								while($row = mysqli_fetch_assoc($r)) 
								{
									$h=$row['heading'];
									echo "<tr>
									<td class='text-white'>".$row["date"]."</td>
									<td><a href='#' class='.mytoggle text-white' data-toggle='modal' data-target='#myModal".$x."'>".$h."</a></td>
									<td><a href='delete.php?id=".$row["id"]."&db=".$_SESSION['sub']."dashboard'><img src='../img/cancel.png' alt='404'/></a></td>
									</tr>
									<div class='modal fade' id='myModal".$x."'>
									<div class='modal-dialog modal-dialog-centered	'>
									<div class='modal-content'>

									<!-- Modal Header -->
									<div class='modal-header'>
									<h4 class='modal-title'>$h</h4>
									<button type='button' class='close' data-dismiss='modal'>&times;</button>
									</div>

									<!-- Modal body -->
									<div class='modal-body'>
									".$row['content']."
									</div>
									</div>
									</div>
									</div>";
									$x++;
								}
								echo "</tbody>";
							}
							else 
							{
								echo "<tr>
								<td>
								<a href='#' class='text-white'>No Notice to show</a>
								</td>
								</tr>";
							}
						}
						if(!empty($head) && !empty($content))
						{
							$sql="insert into ".$_SESSION['sub']."dashboard(date,heading,content) values('$date','$head','$content')";
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
					</table>
				</div>
				<div class='container-fluid'>
					<div class='col-lg-12'>
						<form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
							<label for="link_heading">Notice heading::</label>
							<input type="text" class="form-control" name="link_heading" id="link_heading" value="" required="required">
							<label for="link">Notice link::</label>
							<textarea name="link" id="link" value="" class="form-control" required="required"></textarea>
							<div class="text-center" style="padding:0;margin: 4%; margin-left: 0;"> 
								<button type="submit" class="btn ">Add a Notice</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>