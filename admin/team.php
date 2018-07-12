<?
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../includes/PHPMailer/src/Exception.php';
require '../includes/PHPMailer/src/PHPMailer.php';
require '../includes/PHPMailer/src/SMTP.php';
include '../includes/config.php';
include '../includes/usercheck.php';
if($_SESSION['type'] == 'admin')
{}
else
{
	header("location:../index.php");
}
$i = $_SESSION['username'];
include "../includes/config.php";
function addfac($x)
{
	global $con;
	$q="select * from faculty where id = '$x'";
	$s=mysqli_query($con,$q);
	while($rw = mysqli_fetch_assoc($s))
	{
		return $rw['name'];
	}
}
function check($a,$b)
{
	global $con;
	$sql = "SELECT * FROM ".$_SESSION['sub']."team WHERE approved=$a && disapproved=$b ";

	$s = mysqli_query($con,$sql);
	if (mysqli_num_rows($s) > 0)
	{
		echo "<div class='card-body text-center'><table class='table table-bordered'>
		<thead>
		<tr>
		<th>Group ID</th>";
		for($n = 1; $n<=$_SESSION['max'];$n++)
			echo "<th>ID$n</th>";
		echo"<th>Guide</th>
		</tr>
		</thead>
		<tbody>";
		while($rw = mysqli_fetch_assoc($s))
		{
			echo "<tr><td>".$rw['gid']."</td>";
			for($n = 1; $n<=$_SESSION['max'];$n++)
				echo "<td>".$rw['id'.$n]."</td>";
			echo"<td>".addfac($rw['fid'])."</td></tr>";			
		}
		echo "</tbody></table></div>";	
	}
	else
	{
		echo "<div class='text-center text-danger'>No teams to show</div>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?include '../includes/file.php';?>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<div class="card fixed" style="background-color: #610835">
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
			<div class="col-xl-12 text-center text-white" style="background-color: #610835">
				<h2 style="padding: 1%;margin: 0;">Team Registration</h2>
			</div>
			<div class="row text-dark" style="margin: 1%;padding: 1%;">
				<div class="col-lg-2 card" style="padding: 1%;">
					<h5 class="card-title text-center">Track Team</h5>
					<div class="card-body text-center">
						<form method="POST" action="<?echo $_SERVER['PHP_SELF'];?>">
							<button class="btn btn-outline-white btn-block" type="submit" name="approve">Approve<br> Teams</button>
							<button class="btn btn-outline-white btn-block" type="submit" name="registered">Registered<br> Teams</button>
							<button class="btn btn-outline-white btn-block" type="submit" name="pending">Pending<br> Teams</button>
							<button class="btn btn-outline-white btn-block" type="submit" name="rejected">Rejected<br> Teams</button>
							<button class="btn btn-outline-white btn-block" type="submit" name="guide">Faculty<br> Guide Wise</button>
							<button class="btn btn-outline-white btn-block" type="submit" name="student">Student<br> Wise</button>
							<button class="btn btn-outline-white btn-block" type="submit" name="not_registered">Students not<br> Registered</button>	
							<button class="btn btn-outline-white btn-block" type="submit" name="disable">Disable Team <br> Registration</button>
							<button class="btn btn-outline-white btn-block" type="submit" name="enable">Enable Team <br> Registration</button>
						</form>
					</div>
				</div>
				<div class="col-lg-10" id="insert">
					<div class="card col-lg-12">
						<div class="card-body">
							<h4 class="card-title text-center">Team details</h4>
							<?
							$flag = 0;
							if(isset($_POST['team_approve']))
							{
								$gid =$_POST['gid'];
								$r = mysqli_query($con,"UPDATE ".$_SESSION['sub']."team SET approved = 1 where gid =$gid");
								$r = mysqli_query($con,"Select * from ".$_SESSION['sub']."team where gid =".$gid);
								$row = mysqli_fetch_assoc($r);
								$s = $row['id1'];
								$r = mysqli_query($con,"Select * from ".$_SESSION['sub']."student where id ='".$s."'");
								$row = mysqli_fetch_assoc($r);
								$m = $row['email'];	
								$r1 = mysqli_query($con,"Select * from admin where type= '".$_SESSION['sub']."'") or die(mysqli_error($con));
								$row = mysqli_fetch_assoc($r1);
								$ml = $row['email'];
								$mail = new PHPMailer(true);         
								require '../includes/mail_config.php';
								/*$mail->setFrom($ml);
								$mail->addAddress($m);     
								$mail->isHTML(true);                                  
								$mail->Subject = 'Team Registeration acknowledgement';
								$mail->Body    = "Group no: G$gid your team has been accepted by the Course coordinator";
								$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
								//$mail->send();*/
							}
							if(isset($_POST['def_approve']))
							{
								$gid =$_POST['gid'];
								$r = mysqli_query($con,"UPDATE ".$_SESSION['sub']."team SET def_approved = 1 , def_disapproved = 0 where gid = $gid");
								$r = mysqli_query($con,"Select * from ".$_SESSION['sub']."team where gid =".$gid);
								$row = mysqli_fetch_assoc($r);
								$s = $row['id1'];
								$r = mysqli_query($con,"Select * from ".$_SESSION['sub']."student where id ='".$s."'");
								$row = mysqli_fetch_assoc($r);
								$m = $row['email'];	
								$r1 = mysqli_query($con,"Select * from admin where type= '".$_SESSION['sub']."'") or die(mysqli_error($con));
								$row = mysqli_fetch_assoc($r1);
								$ml = $row['email'];
								$mail = new PHPMailer(true);         
								require '../includes/mail_config.php';
								/*$mail->setFrom($ml);
								$mail->addAddress($m);     
								$mail->isHTML(true);                                  
								$mail->Subject = 'Project Definition Approved';
								$mail->Body    = "Group no: G$gid your Definition is approved by the Course coordinator";
								$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
								//$mail->send();*/
							}
							if(isset($_POST['def_disapprove']))
							{
								$gid =$_POST['gid'];
								$r = mysqli_query($con,"UPDATE ".$_SESSION['sub']."team SET def_approved = 0 , def_disapproved = 1 where gid = $gid");
								$r = mysqli_query($con,"Select * from ".$_SESSION['sub']."team where gid =".$gid);
								$row = mysqli_fetch_assoc($r);
								$s = $row['id1'];
								$r = mysqli_query($con,"Select * from ".$_SESSION['sub']."student where id ='".$s."'");
								$row = mysqli_fetch_assoc($r);
								$m = $row['email'];	
								$r1 = mysqli_query($con,"Select * from admin where type= '".$_SESSION['sub']."'") or die(mysqli_error($con));
								$row = mysqli_fetch_assoc($r1);
								$ml = $row['email'];
								$mail = new PHPMailer(true);         
								require '../includes/mail_config.php';
								/*$mail->setFrom($ml);
								$mail->addAddress($m);     
								$mail->isHTML(true);                                  
								$mail->Subject = 'Project Definition Disapproved';
								$mail->Body    = "Group no: G$gid your Definition is disapproved by the Course coordinator";
								$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
								//$mail->send();*/
							}		
							if(isset($_POST['assign_fac']))
							{
								$gid =$_POST['gid'];
								$r = mysqli_query($con,"UPDATE ".$_SESSION['sub']."team SET fid = '".$_POST['assign']."' where gid = $gid");
								$r = mysqli_query($con,"Select * from ".$_SESSION['sub']."team where gid =".$gid);
								$row = mysqli_fetch_assoc($r);
								$s = $row['id1'];
								$r = mysqli_query($con,"Select * from ".$_SESSION['sub']."student where id ='".$s."'");
								$row = mysqli_fetch_assoc($r);
								$m = $row['email'];	
								$r1 = mysqli_query($con,"Select * from admin where type= '".$_SESSION['sub']."'") or die(mysqli_error($con));
								$row = mysqli_fetch_assoc($r1);
								$ml = $row['email'];
								$r1 = mysqli_query($con,"Select * from faculty where id= '".$_POST['assign']."'") or die(mysqli_error($con));
								$row = mysqli_fetch_assoc($r1);
								$mx = $row['email'];
								$mail = new PHPMailer(true);         
								require '../includes/mail_config.php';
								/*$mail->setFrom($ml);
								$mail->addAddress($m,$mx);     
								$mail->isHTML(true);                                  
								$mail->Subject = 'Faculty Guide Assigned';
								$mail->Body    = "Group no: G$gid your faculty guide is ".$_POST['assign'];
								$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
								*///$mail->send();
							}
							if(isset($_POST['approve'])) 
							{
								$flag=1;
								$q="select * from ".$_SESSION['sub']."team";
								$s=mysqli_query($con,$q);
								echo "<div class='text-center'>You have <strong>".mysqli_num_rows($s)."</strong> teams under your guidance<br/><br/></div>";
								$x=100;
								if (mysqli_num_rows($s) > 0)
								{
									echo "<table class='table table-bordered text-center'>
									<thead>
									<tr>
									<th>Group ID</th>";
									for($n = 1; $n<=$_SESSION['max'];$n++)
										echo "<th>ID$n</th>";
									echo"<th>Accept</th><th>Definition</th><th>Assign faculty</th></tr>
									</thead>
									<tbody>";
									while($rw = mysqli_fetch_assoc($s))
									{
										$gid=$rw['gid'];
										echo "<tr><td>".$gid."</td>";
										for($n = 1; $n<=$_SESSION['max'];$n++)
											echo "<td>".$rw['id'.$n]."</td>";
										if($rw['approved'] == 1)
										{
											echo "<td>Accepted</td>";
										}
										else
										{
											echo "<td><form method='post' action='".$_SERVER['PHP_SELF']."'><button class='btn btn-block' name='team_approve' type='submit'>Accept</button>
											<input type='hidden' name='gid' value='$gid'/>
											</form></td>";
										}
										if($rw['approved'] == 1 && !empty($rw['definition']))
										{
											echo"<td><a href='#' class='.mytoggle btn btn-outline-dark btn-block text-dark' data-toggle='modal' data-target='#myModal".$x."'><b>Definition</b></a></td>";
											if(empty($rw['fid']))
											{
												echo"<td>
												<form method='post' action='".$_SERVER['PHP_SELF']."'>
												<input type='hidden' name='gid' value='$gid'/>
												<div class='form-group'>
												<select class='form-control' name='assign' required='required'>
												<option value=''>Select faculty</option>";
												$r = mysqli_query($con,"SELECT * FROM faculty");
												while($row = mysqli_fetch_assoc($r))
												{
													echo "<option value=".$row['id'].">".$row['name']."</option>";
												}			
												echo"</select>
												</div>
												<button class='btn' type='submit' name='assign_fac'>Assign</button>
												</form>
												</td>";
											}
											else
											{
												echo "<td>".addfac($rw['fid'])."</td>";
											}
										}
										else
										{
											echo"<td>-</td><td>-</td>";
										}
										echo"</tr><div class='modal fade' id='myModal".$x."'>
										<div class='modal-dialog modal-dialog-centered	'>
										<div class='modal-content'>

										<!-- Modal Header -->
										<div class='modal-header'>
										<h4 class='modal-title'>".$rw['definition']."</h4>
										<button type='button' class='close' data-dismiss='modal'>&times;</button>
										</div>

										<!-- Modal body -->
										<div class='modal-body'>
										".$rw['description']."
										</div>

										<!-- Modal footer -->
										<div class='modal-footer'>";
										if($rw['def_approved'] == 0 && $rw['def_disapproved'] == 0)
										{
											echo"
											<form method='post' action='".$_SERVER['PHP_SELF']."'>
											<input type='hidden' name='gid' value='$gid'/>
											<button class='btn' type='submit' name='def_approve'>Approve</button>
											<button class='btn' type='submit' name='def_disapprove'>Disapprove</button>
											</form>";
										}
										else if($rw['def_approved'] == 1 && $rw['def_disapproved'] == 0)
											echo "Approved";
										else if($rw['def_approved'] == 0 && $rw['def_disapproved'] == 1)
											echo "Disapproved";
										echo"</div>
										</div>
										</div>
										";
										$x++;
									}
									echo "</tbody></table>";
								}
							}
							if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']))
							{
								global $con;
								$id = $_POST['id'];
								$sql = "SELECT * FROM ".$_SESSION['sub']."team WHERE (id1 = '$id' OR id2 = '$id' OR id3 = '$id' OR id4 = '$id' OR id5 = '$id')";

								
								$s = mysqli_query($con,$sql) or die("error");
								if (mysqli_num_rows($s) > 0)
								{
									echo "<div class='card-body text-center'><table class='table table-bordered'>
									<thead>
									<tr>
									<th>Group ID</th>";
									for($n = 1; $n<=$_SESSION['max'];$n++)
									{
										echo "<th>ID$n</th>";
									}
									echo"<th>Guide</th>
									</tr>
									</thead>
									<tbody>";
									while($rw = mysqli_fetch_assoc($s))
									{
										echo "<tr>
										<td>".$rw['gid']."</td>";
										for($n = 1; $n<=$_SESSION['max'];$n++)
											echo "<td>".$rw['id'.$n]."</td>";
										
										echo"<td>".addfac($rw['fid'])."</td></tr>";			
									}
									echo "</tbody></table></div>";
									$flag = 1;	
								}	
								else if(mysqli_num_rows($s) == 0)
								{
									echo "<div class='text-center text-danger'>Student has not registered yet</div>";
								}
							}
							if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['fid']))
							{
								global $con;
								$sql = "SELECT * FROM ".$_SESSION['sub']."team WHERE fid = '".$_POST['fid']."'";

								$s = mysqli_query($con,$sql) or die("error");
								if (mysqli_num_rows($s) > 0)
								{
									echo "<div class='card-body text-center'><table class='table table-bordered'>
									<thead>
									<tr>
									<th>Group ID</th>";
									for($n = 1; $n<=$_SESSION['max'];$n++)
									{
										echo "<th>ID$n</th>";
									}
									echo"<th>Guide</th>
									</tr>
									</thead>
									<tbody>";
									while($rw = mysqli_fetch_assoc($s))
									{
										echo "<tr><td>".$rw['gid']."</td>";
										for($n = 1; $n<=$_SESSION['max'];$n++)
											echo "<td>".$rw['id'.$n]."</td>";
										echo"<td>".addfac($rw['fid'])."</td></tr>";			
									}
									echo "</tbody></table></div>";
									$flag = 1;	
								}	
								else
								{
									echo "<div class='text-danger text-center'>No Teams Are Registered Under The Selected Faculty</div>";
								}	
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
								<button type='submit' name ='guide1' class='btn btn-block'>Update faculty guide</button>
								</div>
								</form>";
							}
							else if(isset($_POST['student']))
							{	

								echo "
								<form method='POST' action='".$_SERVER["PHP_SELF"]."'>
								<div class='text-left'>
								<div class='form-group'>
								<label for='guide'>ID No.:</label>
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
								<button type='submit' name ='student1' class='btn
								btn-block'>Get Student Team details</button>
								</div>
								</form>";
							}
							else if(isset($_POST['not_registered']))
							{	
								global $con;
								$sql = "SELECT id FROM ".$_SESSION['sub']."student WHERE id NOT IN (";
								for($n=1;$n<=$_SESSION['max'];$n++)
								{
									if($n == $_SESSION['max'])	
										$sql.="SELECT id".$n." FROM ".$_SESSION['sub']."team WHERE id".$n." is not null)";
									else if($n < $_SESSION['max'])
										$sql.="SELECT id".$n." FROM ".$_SESSION['sub']."team WHERE id".$n." is not null UNION ";
								}									
								$r = mysqli_query($con,$sql) or die(mysqli_error($con));
								if(mysqli_num_rows($r) > 0)
								{
									echo "<div class='row'>
									<div class='col-lg-3'></div>
									<div class='card-body text-center col-lg-6'>
									<table class='table table-bordered'>
									<thead>
									<tr><th>ID</th></tr>
									</thead>
									<tbody>";
									while($row = mysqli_fetch_assoc($r))
									{
										echo "<tr><td>".$row['id']."</td></tr>";
									}
									echo "</tbody></table></div></div>";
								}	
								else
								{
									echo "<div class='text-danger text-center'>No Student to Show</div>";
								}
							}
							else if(isset($_POST['disable']))
							{
								global $con;
								$sql="UPDATE ".$_SESSION['sub']."disable_registration SET team_disable = 1";
								$r = mysqli_query($con,$sql) or die(mysqli_error($con));
								if ($r)
								{
									echo"<div class='card-body text-center text-danger'>Disabled Team Registration<div>";	
								}
							}
							else if(isset($_POST['enable']))
							{
								global $con;
								$sql="UPDATE ".$_SESSION['sub']."disable_registration SET team_disable = 0";
								$r = mysqli_query($con,$sql) or die('error');
								if ($r)
								{
									echo"<div class='card-body text-center text-success'>Enabled Team Registration<div>";	
								}
							}
							else if($flag == 0)
								echo"<div class='card-body text-center'>Select any Criteria<div>";
							?>				
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>