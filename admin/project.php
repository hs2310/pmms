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
function check($a,$b)
{
	global $con;
	$sql = "SELECT * FROM ".$_SESSION['sub']."team WHERE def_approved=$a && def_disapproved=$b ";
	$x=0;
	$s = mysqli_query($con,$sql);
	if (mysqli_num_rows($s) > 0)
	{
		while($row = mysqli_fetch_assoc($s))
		{
			if(!empty($row['definition']) || !empty($row['description']))
			{
				echo "<div class = 'card text-center text-dark' style='padding:1%;'>
				<div class='card-body'>
				<div class='card-title'>";
				
				echo "<h4><u>
				".$row['definition']."
				</u></h4>
				</div>
				<p class='card-text'>
				".$row['description']."
				</p>";
				
				echo "
				<div>Group ID:".$row['gid']."</div>
				</div>
				</div>";
				$x=1;
			}
		}
	}
	else
	{
		$x=1;
		echo "<div class='text-center text-danger' style='padding:1%;'>No Teams To Show</div>";
	}
	if($x==0)
	{
		echo "<div class='text-center text-danger' style='padding:1%;'>No Teams To Show</div>";	
	}	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?include "../includes/file.php";?>
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

	<div class="container-fluid">	
		<div id="main" class="col-lg-12">
			<div class="row">
				<div class="col-xl-12 text-center text-white" style="background-color: #610835">
					<h2 style="padding: 1%;margin: 0;">Project Details</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-12" style="padding: 1%;">
					<div class="row" style="padding: 1%;">
						<div class='col-lg-2'>
							<form action=<?echo $_SERVER['PHP_SELF']?> method = "POST">
								<button class='btn btn-block' name='details' type='submit'>Project <br>Definition</button>
								<button class='btn btn-block' name='reports' type='submit'>Project <br>Reports</button>
							</form>
						</div>
						<div class='col-lg-10' id = 'show'>
							<?
							if(isset($_POST['id']))
							{
								global $con;
								$id = $_POST['id'];
								$sql = "SELECT * FROM ".$_SESSION['sub']."team WHERE (id1 = '$id' OR id2 = '$id' OR id3 = '$id' OR id4 = '$id' OR id5 = '$id')";
								$s = mysqli_query($con,$sql) or die("error");
								if (mysqli_num_rows($s) > 0)
								{
									while ($row=mysqli_fetch_assoc($s))
									{
										$sql1 = "SELECT * FROM ".$_SESSION['sub']."team WHERE gid='".$row['gid']."'";

										$s1 = mysqli_query($con,$sql1);
										if (mysqli_num_rows($s1) > 0)
										{
											while($rw = mysqli_fetch_assoc($s1))
											{
												if(empty($rw['definition']) || empty($rw['description']))
												{
													echo "<div class = 'card text-center' style='padding:1%;'>
													<div class='text-center text-danger'>Group ID : ".$rw['gid']." has Not Uploaded Definition Yet</div></div>";
												}
												else
												{
													echo "<div class = 'card text-center text-dark' style='padding:1%;'>
													<div class='card-body'>
													<div class='card-title'>
													<h4><u>
													".$rw['definition']."
													</u></h4>
													</div>
													<p class='card-text'>
													".$rw['description']."
													</p>
													<div class='text-center'>Group ID:".$rw['gid']."</div>
													</div>";
													if($rw['def_approved'] == '1' AND $rw['def_disapproved'] == '0')
													{
														echo "<div class='text-center text-success' style='padding:1%;'>Definition Is Approved</div></div>";
													}
													else if($rw['def_approved'] == '0' AND $rw['def_disapproved'] == '1')
													{
														echo "<div class='text-center text-danger' style='padding:1%;'>Definition Is Disapproved</div></div>";			
													}
													else 
													{
														echo "<div class='text-center text-danger' style='padding:1%;'>Definition Is Pending</div></div>";
													}
												}
											}
										}
									}
								}
								else
								{
									echo "<div class='text-center'style='padding:1%;'>Student Not Registered Yet</div>";
								}
							}
							if(isset($_POST['fid']))
							{
								global $con;
								$sql = "SELECT * FROM ".$_SESSION['sub']."team WHERE fid = '".$_POST['fid']."'";

								$s = mysqli_query($con,$sql) or die("error");
								if (mysqli_num_rows($s) > 0)
								{
									while ($row=mysqli_fetch_assoc($s))
									{
										$sql1 = "SELECT * FROM ".$_SESSION['sub']."team WHERE gid='".$row['gid']."'";

										$s1 = mysqli_query($con,$sql1);
										if (mysqli_num_rows($s1) > 0)
										{
											while($rw = mysqli_fetch_assoc($s1))
											{
												if(empty($rw['definition']) || empty($rw['description']))
												{
													echo "<div class = 'card text-center' style='padding:1%;'>
													<div class='text-center text-danger'>Group ID : ".$rw['gid']." has Not Uploaded Definition Yet</div></div>";
												}
												else if(!empty($rw['definition']) || !empty($rw['description']))
												{

													echo "<div class = 'card text-center text-dark' style='padding:1%;'>
													<div class='card-body'>
													<div class='card-title'>
													<h4><u>
													".$rw['definition']."
													</u></h4>
													</div>
													<p class='card-text'>
													".$rw['description']."
													</p>
													<div class='text-center'>Group ID:".$rw['gid']."</div>
													</div>
													";
													if($rw['def_approved'] == '1' AND $rw['def_disapproved'] == '0')
													{
														echo "<div class='text-center text-success' style='padding:1%;'>Definition Is Approved</div></div>";
													}
													else if($rw['def_approved'] == '0' AND $rw['def_disapproved'] == '1')
													{
														echo "<div class='text-center text-danger' style='padding:1%;'>Definition Is Disapproved</div></div>";			
													}
													else
													{
														echo "<div class='text-center text-danger' style='padding:1%;'>Definition Is Pending</div></div>";
													}
												}
											}
										}
									}
								}
								else
								{
									echo "<div class='text-center' style='padding:1%;'>No Teams To Show</div>";
								}
							}
							if(isset($_POST['details']))
							{
								
								echo"
								<div class='row'><div class='col-lg-2'></div><div class='col-lg-8'>
								<form method='POST' action=".$_SERVER['PHP_SELF'].">
								<button class='btn btn-block' type='submit' name='registered'>Registered Definition</button>
								<button class='btn btn-block' type='submit' name='pending'>Pending Definition</button>
								<button class='btn btn-block' type='submit' name='rejected'>Rejected Definition</button>
								<button class='btn btn-block' type='submit' name='guide'>Faculty Guide Wise</button>
								<button class='btn btn-block' type='submit' name='student'>Student Wise</button>
								<button class='btn btn-block' type='submit' name='not_registered'>Students Not Uploaded Definition</button>	
								<button class='btn btn-block' type='submit' name='disable'>Disable Project Definition</button>
								<button class='btn btn-block' type='submit' name='enable'>Enable Project Definition</button>
								</form>
								</div>
								</div>
								";
							}
							if(isset($_POST['registered']))
								check(1,0);
							else if(isset($_POST['pending']))
								check(0,0);
							else if(isset($_POST['rejected']))
								check(0,1);
							else if(isset($_POST['guide']))
							{	

								echo "
								<form method='POST' action='".$_SERVER["PHP_SELF"]."'>
								<div class='text-left'>
								<div class='form-group'>
								<label for='guide'>Faculty Guide:</label>
								<select class='form-control' id='fid' name='fid' required='required'>
								<option value=''>Select Faculty Guide</option>";

								$re=mysqli_query($con,"select * from faculty");
								if (mysqli_num_rows($re) > 0)
								{
									while($row = mysqli_fetch_assoc($re))
									{
										echo "<option value='".$row['id']."'>".$row['name']."</option>";			
									}
								}

								echo "</select>
								</div>
								</div>
								<div class='col-md-12 text-center form-control' style='padding:0;margin: 4%; margin-left: 0;'> 
								<button type='submit' name ='guide1' class='btn btn-block'>Select faculty guide</button>
								</div>
								</form>";
							}
							else if(isset($_POST['student']))
							{	

								echo "
								<form method='POST' action='".$_SERVER["PHP_SELF"]."'>
								<div class='text-left'>
								<div class='form-group'>
								<label for='guide'>Student ID:</label>
								<select class='form-control' id='id' name='id' required='required'>
								<option value=''>Select student id</option>";

								$re=mysqli_query($con,"select * from ".$_SESSION['sub']."student");
								if (mysqli_num_rows($re) > 0)
								{
									while($row = mysqli_fetch_assoc($re))
									{
										$i=$row['id'];
										echo "<option value='".$i."'>".$i."</option>";			
									}
								}

								echo "</select>
								</div>
								</div>
								<div class='col-md-12 text-center form-control' style='padding:0;margin: 4%; margin-left: 0;'> 
								<button type='submit' name ='student1' class='btn btn-block'>Get Student Team details</button>
								</div>
								</form>";
							}
							else if(isset($_POST['not_registered']))
							{	
								global $con;
								echo "<div class='row'>
								<div class='col-lg-3'></div>
								<div class='card-body text-center col-lg-6'>";
								$sql = "SELECT gid FROM ".$_SESSION['sub']."team WHERE definition = '' AND description = '' ";
								$r = mysqli_query($con,$sql) or die("error");
								if(mysqli_num_rows($r) > 0)
								{
									echo "<table class='table table-bordered'>
											<thead>
											<tr><th>Group ID</th></tr>
											</thead>
											<tbody>";
									while($row = mysqli_fetch_assoc($r))
									{
										echo "<tr><td>G".$row['gid']."</td></tr>";
									}
									echo "</tbody></table></div></div>";
								}	
								else
								{
									echo "<div class='text-danger'>No teams to Show</div>";
								}
							}
							else if(isset($_POST['disable']))
							{
								global $con;
								$sql="UPDATE ".$_SESSION['sub']."disable_registration SET project_disable = '1'";
								$r = mysqli_query($con,$sql) or die(mysqli_error($con));
								if ($r)
								{
									echo"<div class='card-body text-center text-danger'>Disabled Team Registration<div>";	
								}
							}
							else if(isset($_POST['enable']))
							{
								global $con;
								$sql="UPDATE ".$_SESSION['sub']."disable_registration SET project_disable = '0'";
								$r = mysqli_query($con,$sql) or die('error');
								if ($r)
								{
									echo"<div class='card-body text-center text-success'>Enabled Team Registration<div>";	
								}
							}
							function validate2($x,$y,$a)
							{
								if ($x == 1 && $y == 0 && $a == 1)
								{
									return 'Rejected';	
								}
								elseif ($x == 1 && $y == 1 && $a == 0)
								{
									return 'Approved';
								}
								else if ($x == 1 && $y == 0 && $a == 0)
								{
									return 'Pending';
								}
								else
								{
									return '-';
								}
							}
							if(isset($_POST['id1']))
							{
								global $con;
								$id = $_POST['id1'];
								$sql = "SELECT * FROM ".$_SESSION['sub']."project WHERE gid IN(SELECT gid FROM ".$_SESSION['sub']."team WHERE(id1 = '$id' OR id2 = '$id' OR id3 = '$id' OR id4 = '$id' OR id5 = '$id'))";
								$s = mysqli_query($con,$sql) or die("error");
								if (mysqli_num_rows($s) > 0)
								{
									echo "<table class='table table-hover text-center'> 
									 	<thead>
											<th>Group Id</th>";
											for($n = 1; $n<=$_SESSION['report'];$n++)
												echo "<th>PPR$n</th>";
											echo"<th>Plagiarism Report</th>
											<th>Final Report</th>
										</thead>
										<tbody>";
											
											while ($row =mysqli_fetch_assoc($s))
											{
												echo"
												<tr>
													<td>".$row['gid']."</td>";
													for($n = 1; $n<=$_SESSION['report'];$n++)
														echo "<td>".validate2($row['ppr'.$n],$row['ppr'.$n.'_approved'],$row['ppr'.$n.'_disapproved'])."</td>";
													echo "<td>".validate2($row['plag_report'],$row['plag_approved'],$row['plag_disapproved'])."</td>
													<td>".validate2($row['final_report'],$row['final_approved'],$row['final_disapproved'])."</td>
												</tr>";
											}
										
									echo "</tbody></table>";	
								}
								else
									echo "<div class='text-center text-danger'>Student Not Registered</div>";
							}

							if(isset($_POST['fid1']))
							{
								global $con;
								$f= $_POST['fid1'];
								$r=mysqli_query($con,"SELECT * FROM ".$_SESSION['sub']."project where gid IN(SELECT gid FROM ".$_SESSION['sub']."team where fid = '$f' )") or die(mysqli_error($con));
								if (mysqli_num_rows($r)) 
								{
									echo "<table class='table table-hover text-center'> 
									 	<thead>
											<th>Group Id</th>
											";
											for($n = 1; $n<=$_SESSION['report'];$n++)
												echo "<th>PPR$n</th>";
											echo"
											<th>Plagiarism Report</th>
											<th>Final Report</th>
										</thead>
										<tbody>";
											
											while ($row =mysqli_fetch_assoc($r))
											{
												echo"
												<tr>
													<td>".$row['gid']."</td>";
													for($n = 1; $n<=$_SESSION['report'];$n++)
														echo "<td>".validate2($row['ppr'.$n],$row['ppr'.$n.'_approved'],$row['ppr'.$n.'_disapproved'])."</td>";
													echo "<td>".validate2($row['plag_report'],$row['plag_approved'],$row['plag_disapproved'])."</td>
													<td>".validate2($row['final_report'],$row['final_approved'],$row['final_disapproved'])."</td>
												</tr>";
											}
										
									echo "</tbody></table>";
								}
								else
								{
									echo "<div class='text-danger text-center'>No team to show</div>";
								}	
							}
							if(isset($_POST['r_report']))
							{
								global $con;
								$r=mysqli_query($con,"SELECT * FROM ".$_SESSION['sub']."project");
								if (mysqli_num_rows($r)>0)
								{
									?>
									<table class="table table-hover text-center">
										<thead>
											<th>Group Id</th>
											<?
											for($n = 1; $n<=$_SESSION['report'];$n++)
												echo "<th>PPR$n</th>";
											?>
											<th>Plagiarism Report</th>
											<th>Final Report</th>
										</thead>
										<tbody>
											<?
											while ($row =mysqli_fetch_assoc($r))
											{
												echo"
												<tr>
													<td>".$row['gid']."</td>";
													for($n = 1; $n<=$_SESSION['report'];$n++)
														echo "<td>".validate2($row['ppr'.$n],$row['ppr'.$n.'_approved'],$row['ppr'.$n.'_disapproved'])."</td>";
													echo "
													<td>".validate2($row['plag_report'],$row['plag_approved'],$row['plag_disapproved'])."</td>
													<td>".validate2($row['final_report'],$row['final_approved'],$row['final_disapproved'])."</td>
												</tr>";
											}
											?>
										</tbody>
									</table>
									<?
								}
								else
								{
									echo "<div class='text-danger text-center'>No team to show</div>";
								}
							}
							else if(isset($_POST['r_guide']))
							{	
								echo "
								<form method='POST' action='".$_SERVER["PHP_SELF"]."'>
								<div class='text-left'>
								<div class='form-group'>
								<label for='guide'>Faculty Guide:</label>
								<select class='form-control' id='fid' name='fid1' required='required'>
								<option value=''>Select Faculty Guide</option>";

								$re=mysqli_query($con,"select * from faculty");
								if (mysqli_num_rows($re) > 0)
								{
									while($row = mysqli_fetch_assoc($re))
									{
										echo "<option value='".$row['id']."'>".$row['name']."</option>";			
									}
								}

								echo "</select>
								</div>
								</div>
								<div class='col-md-12 text-center form-control' style='padding:0;margin: 4%; margin-left: 0;'> 
								<button type='submit' name ='r_guide1' class='btn btn-block'>Select faculty guide</button>
								</div>
								</form>";
							}
							else if(isset($_POST['r_student']))
							{	

								echo "
								<form method='POST' action='".$_SERVER["PHP_SELF"]."'>
								<div class='text-left'>
								<div class='form-group'>
								<label for='guide'>Student ID:</label>
								<select class='form-control' id='id' name='id1' required='required'>
								<option value=''>Select student id</option>";

								$re=mysqli_query($con,"select * from ".$_SESSION['sub']."student");
								if (mysqli_num_rows($re) > 0)
								{
									while($row = mysqli_fetch_assoc($re))
									{
										$i=$row['id'];
										echo "<option value='".$i."'>".$i."</option>";			
									}
								}

								echo "</select>
								</div>
								</div>
								<div class='col-md-12 text-center form-control' style='padding:0;margin: 4%; margin-left: 0;'> 
								<button type='submit' name ='student1' class='btn btn-block'>Get Student Team details</button>
								</div>
								</form>";
							}
							else if(isset($_POST['r_disable']))
							{
								global $con;
								$sql="UPDATE ".$_SESSION['sub']."disable_registration SET report_disable = '1'";
								$r = mysqli_query($con,$sql) or die(mysqli_error($con));
								if ($r)
								{
									echo"<div class='card-body text-center text-danger'>Disabled Report Uploads<div>";	
								}
							}
							else if(isset($_POST['r_enable']))
							{
								global $con;
								$sql="UPDATE ".$_SESSION['sub']."disable_registration SET report_disable = '0'";
								$r = mysqli_query($con,$sql) or die('error');
								if ($r)
								{
									echo"<div class='card-body text-center text-success'>Enabled Report Uploads<div>";	
								}
							}
							if(isset($_POST['reports']))
							{
								echo"
								<div class='row'><div class='col-lg-2'></div><div class='col-lg-8'>
								<form method='POST' action=".$_SERVER['PHP_SELF'].">
								<button class='btn btn-block' type='submit' name='r_report'> Gist of Reports</button>
								<button class='btn btn-block' type='submit' name='r_guide'>Faculty Guide Wise</button>
								<button class='btn btn-block' type='submit' name='r_student'>Student Wise</button>
								<button class='btn btn-block' type='submit' name='r_disable'>Disable Project Reports</button>
								<button class='btn btn-block' type='submit' name='r_enable'>Enable Project Reports</button>
								</form>
								</div>
								</div>
								";
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>