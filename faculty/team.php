<?
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../includes/PHPMailer/src/Exception.php';
require '../includes/PHPMailer/src/PHPMailer.php';
require '../includes/PHPMailer/src/SMTP.php';
include '../includes/config.php';
include '../includes/usercheck.php';
if($_SESSION['type'] == 'faculty')
{}
else
{
	header("location:../index.php");
}
function display()
{
	echo "<div class='text-danger text-center' style='padding-top: 2%;'>Notice from the faculty guide will be displayed here.</div>";
	global $con,$id;
	$r=mysqli_query($con,"select * from ".$_SESSION['sub']."notice where fid = '$id'");
	if (mysqli_num_rows($r) > 0)
	{
		echo "<table class='table text-center text-primary' style='margin-top: 2%;'><thead class='thead-light '>
		<tr>
		<th class='w-25'>Date</th>
		<th class='w-50'>Notice</th>
		<th class='w-25'>gid</th>
		</tr>

		</thead>
		<tbody>";
		$x=1;
		while($row = mysqli_fetch_assoc($r)) 
		{
			$h=$row['heading'];
			echo "<tr>
			<td>".$row["date"]."</td>
			<td><a href='#' class='.mytoggle' data-toggle='modal' data-target='#myModal".$x."'>".$h."</a></td>
			<td>G".$row["gid"]."</td>
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
		echo "</tbody></table>";
	}
	else 
	{
		echo "<table class='table text-center text-primary' style='margin-top: 2%;'>
		<tr>
		<td>
		<a href='#'>No Notice to show</a>
		</td>
		</tr></table>";
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
	<div class="card bg-primary	">
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
			<div class="col-xl-12 text-center bg-primary text-white">
				<h2 style="padding: 1%;margin: 0;">Team Registration</h2>
			</div>
			<div class="row">
				<div class='col-lg-2'>
					<form method = 'POST' action=<?echo $_SERVER["PHP_SELF"]?> style='margin-top:10%;'>
						<button class='btn btn-outline-primary btn-block' type = 'submit' name = 'notice'>Guide's <br> Dashboard</button>
						<button class='btn btn-outline-primary btn-block' type = 'submit' name = 'details'>Team <br> Details</button>
					</form>
				</div>
				<div class='col-lg-10'>
					<?	
					$id = $_SESSION['username'];
					if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['link_heading']) && isset($_POST['link']) && isset($_POST['gid'])) 
					{
						$head=$_POST['link_heading'];
						$content=$_POST['link'];
						$gid = $_POST['gid'];
						$date=date("d-m-Y");
						$sql="insert into ".$_SESSION['sub']."notice(date,heading,content,gid,fid) values('$date','$head','$content','$gid','$id')";
						if(mysqli_query($con,$sql))
						{
							$r = mysqli_query($con,"Select * from ".$_SESSION['sub']."team where gid =".$gid);
							$row = mysqli_fetch_assoc($r);
							$s = $row['id1'];	
							$r = mysqli_query($con,"Select * from ".$_SESSION['sub']."student where id ='".$s."'");
							$row = mysqli_fetch_assoc($r);
							$m = $row['email'];	
							$r1 = mysqli_query($con,"Select * from faculty where id= '".$_SESSION['username']."'") or die(mysqli_error($con));
							$row = mysqli_fetch_assoc($r1);
							$ml = $row['email'];
							$mail = new PHPMailer(true);         
							require '../includes/mail_config.php';
							/*$mail->setFrom($ml);
							$mail->addAddress($m);     
							$mail->isHTML(true);                                  
							$mail->Subject = 'Team Guidelines';
							$mail->Body    = "Group no: G$gid $head";
							$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

							//$mail->send();*/
							echo "<script>alert('data inserted')</script>";
						}
						display();
						
					}
					if(isset($_POST['notice']))
					{					
						if(empty($head) || empty($content) || empty($gid))
						{
							display();
						}
						?>	
						<div class="row" style="margin-top: 2%;">
							<div class="col-lg-12">
								<form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
									<label for="link_heading">Notice heading::</label><br>
									<input type="text" class="form-control" name="link_heading" id="link_heading" value="" required="required">
									<label for="link">Notice link::</label><br>
									<textarea name="link" id="link" value="" class="form-control" required="required"></textarea>
									<div class='text-left'>
										<div class='form-group'>
											<label for='guide'>Select Group:</label><br>
											<select class='form-control' id='gid' name='gid' required='required'>
												<option value=''>Select Group</option>";
												<? 
												$re=mysqli_query($con,"select gid from ".$_SESSION['sub']."team Where fid = '".$_SESSION['username']."' AND approved = 1") or die( mysqli_error($con));

												if(mysqli_num_rows($re) > 0)
												{
													while($row = mysqli_fetch_assoc($re))
													{
														$gid = $row['gid'];
														echo "<option value='".$gid."'>G".$gid."</option>";
													}
												}
												else if((mysqli_num_rows($re) == 0))
												{
													echo "no group";
												}
												?>
											</select>
										</div>
									</div>
									<div class="text-center" style="padding:0;margin: 4%; margin-left: 0;"> 
										<button type="submit" class="btn btn-primary">Add a Notice</button>
									</div>
								</form>
							</div>
						</div>
						<?
					}
					if(isset($_POST['details']))
					{
						?>
						<div class="row" style="margin-top: 2%;padding: 2%;">
							<div class="card col-lg-11">
								<div class='card-body'>
									<h4 class="card-title text-center">Team Details</h4>
									<?
									$q="select * from ".$_SESSION['sub']."team where fid='".$_SESSION['username']."'";
									$s=mysqli_query($con,$q);
									echo "<div class='text-center text-primary'>You have <strong>".mysqli_num_rows($s)."</strong> teams under your guidance<br/><br/></div>";
									$x=100;
									if (mysqli_num_rows($s) > 0)
									{
										echo "<table class='table table-bordered'>
										<thead>
										<tr>
										<th>Group ID</th>";
										for($n = 1; $n<=$_SESSION['max'];$n++)
											echo "<th>ID$n</th>";
										echo"<td>Definition</td></tr>
										</thead>
										<tbody>";
										while($rw = mysqli_fetch_assoc($s))
										{
											echo "<tr><td>".$rw['gid']."</td>";
											for($n = 1; $n<=$_SESSION['max'];$n++)
												echo "<td>".$rw['id'.$n]."</td>";
											echo "<td><a href='#' class='.mytoggle' data-toggle='modal' data-target='#myModal".$x."'>Definition</a></td></tr><div class='modal fade' id='myModal".$x."'>
											<div class='modal-dialog modal-dialog-centered	'>
											<div class='modal-content'>

											<!-- Modal Header -->
											<div class='modal-header'>
											<h4 class='modal-title'>".$rw['definition']."</h4>
											<button type='button' class='close' data-dismiss='modal'>&times;</button>
											</div>

											<!-- Modal body -->
											<div class='modal-body'>
											";
											if(empty($rw['description']))
											{
												echo "Definition not Uploaded";
											} else
											echo $rw['description'];
											echo"</div>
											</div>
											</div>
											</div>";
											$x++;
										}
										echo "</tbody></table>";
									}
									?>	
								</div>						
							</div>
						</div>
						<?
					}
					?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
