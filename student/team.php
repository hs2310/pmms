<?
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../includes/PHPMailer/src/Exception.php';
require '../includes/PHPMailer/src/PHPMailer.php';
require '../includes/PHPMailer/src/SMTP.php';
if(isset($_SESSION['back']))
	header("location:../includes/firsttime.php");
include '../includes/config.php';
include '../includes/usercheck.php';
if($_SESSION['type'] == 'student')
{}
else
{
	header("location:../index.php");
}
$id = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?include '../includes/file.php';?>
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
						<h6 class="text-white" style="display: inline-block;">Logged In As:<br><br> <?echo strtoupper($_SESSION['username']);?></h6>
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
			<?
			function check($x)
			{
				global $con;
				$sx = "Select * from ".$_SESSION['sub']."student where id ='$x'";	
				$rst = mysqli_query($con,$sx) or die(mysqli_error());
				$c1=mysqli_num_rows($rst);
				if ($c1 !== 1)
				{
					die("<script>alert('invalid ID Number : $x');</script>");
				}
			}
			if (isset($_POST['team'])) 
			{
				$s = array("","","","","");
				for($n=0;$n<$_SESSION['min'];$n++)
				{
					$s[$n]= $_POST['sid'.($n+1)];
				}
				for($n=$_SESSION['min'];$n<$_SESSION['max'];$n++)
				{
					if(empty($_POST['sid'.($n+1)]))
						$s[$n]="";
					else
						$s[$n]=$_POST['sid'.($n+1)];
				}
				for($n=0;$n<$_SESSION['min'];$n++)
					check($s[$n]);
				for($n=$_SESSION['min'];$n<$_SESSION['max'];$n++)
				{
					if($s[$n] != "")
						check($s[$n]);
				}
				$date=date("d-m-Y");
				$query_check = "Select * from ".$_SESSION['sub']."team";
				$result = mysqli_query($con,$query_check) or die(mysqli_error());
				$flag = 0;
				$c=mysqli_num_rows($result);
				if($c == 0)
				{
					$flag = 0;
				}
				if($c>0)
				{
					while ($a = mysqli_fetch_assoc($result))
					{
						$k=1;
						for($n=$_SESSION['min'];$n<5;$n++)
						{
							if(empty($s[$n]))
							{	
								$s[$n]=$k;
								$k++;
							}
						}
						if($a['id1'] == $s[1] || $a['id1'] == $s[2] || $a['id1'] == $s[3] || $a['id1'] == $s[4] || $a['id1'] == $s[0])
						{
							echo "<script>alert('student already exist');</script>";
							$flag = 1;
						}
						else if($a['id2'] == $s[1] || $a['id2'] == $s[2] || $a['id2'] == $s[3] || $a['id2'] == $s[4] || $a['id2'] == $s[0])
						{
							echo "<script>alert('student already exist');</script>";
							$flag = 1;
						}
						else if($a['id3'] == $s[1] || $a['id3'] == $s[2] || $a['id3'] == $s[3] || $a['id3'] == $s[4] || $a['id3'] == $s[0])	
						{
							echo "<script>alert('student already exist');</script>";
							$flag = 1;
						}
						else if($a['id4'] == $s[1] || $a['id4'] == $s[2] || $a['id4'] == $s[3] || $a['id4'] == $s[4] || $a['id4'] == $s[0])	
						{
							echo "<script>alert('student already exist');</script>";
							$flag = 1;
						}
						else if($a['id5'] == $s[1] || $a['id5'] == $s[2] || $a['id5'] == $s[3] || $a['id5'] == $s[4] || $a['id5'] == $s[0])	
						{
							echo "<script>alert('student already exist');</script>";
							$flag = 1;
						}
					}
				}
				if($flag == 0)
				{
					$k=1;
					for($n=$_SESSION['min'];$n<5;$n++)
					{
						if(empty($s[$n]))
						{	
							$s[$n]=$k;
							$k++;
						}
					}
					if($s[0] != $s[1] && $s[1] != $s[2] && $s[0] != $s[2] && $s[0] != $s[3] && $s[0] != $s[4] && $s[1] != $s[3] && $s[1] != $s[4] && $s[2] != $s[3] && $s[2] != $s[4] && $s[3] != $s[4])
					{
						$k=1;
						for($n=$_SESSION['min'];$n<5;$n++)
						{
							if($s[$n] == $k)
							{	
								$s[$n]="";
								$k++;
							}
						}
						$query1 = "INSERT INTO ".$_SESSION['sub']."team (id1,id2,id3,id4,id5) VALUES('".$s[0]."','".$s[1]."','".$s[2]."','".$s[3]."','".$s[4]."')";
						$result2 = mysqli_query($con,$query1);
						if(!$result2)
						{
							mysqli_error($con);
						}
						else if($result2)
						{					
							$r = mysqli_query($con,"Select * from ".$_SESSION['sub']."student where id ='".$s[0]."'");
							$row = mysqli_fetch_assoc($r);
							$m = $row['email'];	
							$r1 = mysqli_query($con,"Select * from admin where type= '".$_SESSION['sub']."'") or die(mysqli_error($con));
							$row = mysqli_fetch_assoc($r1);
							$ml = $row['email'];
							$r = mysqli_query($con,"Select * from ".$_SESSION['sub']."team where id1 = '$s[0]'");
							$row = mysqli_fetch_assoc($r);
							$gid = $row['gid'];
							
							$mail = new PHPMailer(true);         
							require '../includes/mail_config.php';
							/*$mail->setFrom($m);
							$mail->addAddress($ml);     
							$mail->isHTML(true);                                  
							$mail->Subject = 'Team Registered';
							$mail->Body    = "Group no: G$gid has Uploaded the team. Kindly accept the team";
							$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

							//$mail->send();*/
							echo "<script>alert('team submitted');</script>";
						}
					}
					else
					{
						echo "<script>alert('ID number not unique');</script>";
					}
				}
			}
			
			?>
			<div class="row">
				<div class="col-lg-12 text-center text-white" style="background-color: #610835">
					<h2 style="padding: 1%;margin: 0;">Team Registration</h2>
				</div>
			</div>
			<div class="row">
				
				<?
				function display()
				{
					echo "<div class='text-white text-center' style='padding-bottom: 1%;'>Notice from the faculty guide will be displayed here.</div>";
					$id=$_SESSION['username'];
					global $con;
					$s = "SELECT * FROM ".$_SESSION['sub']."notice where gid IN(select gid from ".$_SESSION['sub']."team WHERE id1 = '$id' OR id2 = '$id' OR id3 = '$id' OR id4 = '$id' OR id5 = '$id')";
					$r=mysqli_query($con,$s);
					if (mysqli_num_rows($r) > 0)
					{
						echo "<div class='col-lg-12'><table class='table text-center text-white'>
						<thead class='thead-light '>
						<tr>
						<th class='w-25'>Date</th>
						<th class='w-75'>Notice</th>
						</tr>
						</thead>
						<tbody>";
						$x=1;
						while($row = mysqli_fetch_assoc($r)) 
						{
							$h=$row['heading'];
							echo "<tr>
							<td>".$row["date"]."</td>
							<td><a href='#' class='.mytoggle text-white' data-toggle='modal' data-target='#myModal".$x."'>".$h."</a></td>
							</tr>
							<div class='modal fade' id='myModal".$x."'>
							<div class='modal-dialog modal-dialog-centered	'>
							<div class='modal-content'>

							<!-- Modal Header -->
							<div class='modal-header'>
							<h4 class='modal-title text-dark'>$h</h4>
							<button type='button' class='close' data-dismiss='modal'>&times;</button>
							</div>

							<!-- Modal body -->
							<div class='modal-body text-dark'>
							".$row['content']."
							</div>
							</div>
							</div>
							</div>";
							$x++;
						}
						echo "</tbody></table></div>";
					}
				}
				//display();
				?>	

				<div class="col-lg-2">
					<form method = 'POST' action=<?echo $_SERVER["PHP_SELF"]?> style='margin-top:13%;'>
						<button class='btn btn-outline-white btn-block' type = 'submit' name = 'notice'>Guide's <br> Dashboard</button>
						<button class='btn btn-outline-white btn-block' type = 'submit' name = 'details'>Team <br> Details</button>
					</form>
				</div>
				<div class="col-lg-10" style="margin-top: 2%;margin-bottom: 2%;">
					<?
					if(isset($_POST['notice']))
					{
						display();
					}
					if(isset($_POST['p_definition']) && isset($_POST['p_description']) && isset($_POST['gid']) && isset($_POST['r_details']))
					{
						$def = $_POST['p_definition'];
						$des = $_POST['p_description'];
						$gid = $_POST['gid'];
						$r2 = mysqli_query($con,"UPDATE ".$_SESSION['sub']."team SET  definition = '$def' , description = '$des' , def_disapproved = 0 , def_approved = 0 WHERE gid = $gid") or die(mysqli_error($con));
						$r = mysqli_query($con,"Select * from ".$_SESSION['sub']."team where gid = $gid");
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
						/*$mail->setFrom($m);
						$mail->addAddress($ml);     
						$mail->isHTML(true);                                  
						$mail->Subject = 'Definition Submitted';
						$mail->Body    = "Group no: G$gid have Submitted their project definition";
						$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

						/*if($mail->send())*/
						/*	echo "<script>alert('Mail sent');</script>";
						}
						else
							echo "<script>alert('Mail not sent');</script>";*/
						echo "<script>alert('Definition submitted');</script>";
					}
					if(isset($_POST['p_definition']) && isset($_POST['p_description']) && isset($_POST['gid']) && isset($_POST['p_details']))
					{
						$def = $_POST['p_definition'];
						$des = $_POST['p_description'];
						$gid = $_POST['gid'];
						$r2 = mysqli_query($con,"UPDATE ".$_SESSION['sub']."team SET  definition = '$def' , description = '$des' , def_disapproved = 0 , def_approved = 0 WHERE gid = $gid") or die(mysqli_error($con));
						$r2 = mysqli_query($con,"UPDATE ".$_SESSION['sub']."team SET  definition = '$def' , description = '$des' , def_disapproved = 0 , def_approved = 0 WHERE gid = $gid") or die(mysqli_error($con));
						$r = mysqli_query($con,"Select * from ".$_SESSION['sub']."team where gid = $gid");
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
						$mail->setFrom($m);
						$mail->addAddress($ml);     
						$mail->isHTML(true);                                  
						$mail->Subject = 'Definition Submitted';
						$mail->Body    = "Group no: G$gid have Submitted their project definition";
						$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

						//$mail->send();
						echo "<script>alert('Definition submitted');</script>";
					}
					$r=mysqli_query($con,"SELECT * FROM ".$_SESSION['sub']."team WHERE id1='$id' OR id2='$id' OR id3='$id' OR id4='$id' OR id5='$id'");	
					$c = mysqli_num_rows($r);
					function check1($a)
					{
						if ($a <= $_SESSION['min']) 
						{
							return "required='required'";
						}
					}
					function check2($a)
					{
						if ($a <= $_SESSION['min']) 
						{
							return "<div class='text-white' style='display:inline-block;'>&nbsp;&nbsp;&nbsp;* </div>";
						}
					}
					if(isset($_POST['details']))
					{
						?>
						<div class="card-body">
							<h4 class="card-title text-center">Team details</h4><?
							if($c == 0)
							{
								$disabled ="";
								$sql = "SELECT * FROM ".$_SESSION['sub']."disable_registration WHERE team_disable = 1";
								$rst1 = mysqli_query($con,$sql) or die(mysqli_error($con));
								if(mysqli_num_rows($rst1) > 0)
								{
									
									echo "<div class='text-white text-center'>Team Registration is Disabled by Co-ordinator</div>";
									$disabled = "disabled";
								}
								echo "<form method='POST' action='".$_SERVER["PHP_SELF"]."' name='form' id='form1'>
								<div class='form-group'>
								<label for='sid1'>Member 1's ID:</label>
								<input type='text' class='form-control' id='sid1' name='sid1' value='".$id."' readonly>
								</div>";
								for($x=2;$x<=$_SESSION['max'];$x++)
								{
									
									echo"<div class='form-group'>
									<label for='sid$x'>Member ".$x."'s ID:</label>".check2($x)."
									<select class='form-control' id='sid".$x."' name='sid".$x."' ".check1($x).">
									<option value=''>Select Member</option>";
										
									$sql = "SELECT id FROM ".$_SESSION['sub']."student WHERE id NOT IN (";
									for($n=1;$n<=$_SESSION['max'];$n++)
									{
										if($n==$_SESSION['max'])	
											$sql.="SELECT id".$n." FROM ".$_SESSION['sub']."team where id".$n." is not null)";
										else
											$sql.="SELECT id".$n." FROM ".$_SESSION['sub']."team where id".$n." is not null UNION ";
									}

									$re=mysqli_query($con,$sql) or die(mysqli_error($con));
									
									if (mysqli_num_rows($re) > 0)
									{
										while($row = mysqli_fetch_assoc($re))
										{
											echo "<option value='".$row['id']."'>".$row['id']."</option>";			
										}
									}

									echo "</select>";
									echo "</div>";
								}
								echo "<div class='col-md-12 text-center form-control' style='padding:0;margin: 4%; margin-left: 0;'> 
								<input type='submit' class='text-white btn btn-block $disabled'style='background-color: #610835' value='Add Team' name='team'>
								</div>
								</form>";
							}
							else 
							{
								$q="select * from ".$_SESSION['sub']."team where (id1='$id'OR id2='$id' OR id3='$id' OR id4='$id'OR id5='$id') and approved='1'";
								$s=mysqli_query($con,$q);
								$id=$_SESSION['username'];
								$r1=mysqli_query($con,"SELECT * FROM ".$_SESSION['sub']."team WHERE gid IN(select gid from ".$_SESSION['sub']."team WHERE id1 = '$id' OR id2 = '$id' OR id3 = '$id' OR id4 = '$id' OR id5 = '$id') AND def_approved = 0 AND def_disapproved = 0 and definition != '' and description != ''") or die(mysqli_error($con));
								if(mysqli_num_rows($r1) > 0)
								{
									$row = mysqli_fetch_assoc($r1);
									echo "<div class = 'card text-center bg-dark'>
									<div class='card-body'>
									<h4 class='card-title'>
									".$row['definition']."
									</h4>
									<p class='card-text'>
									".$row['description']."
									</p>
									</div>
									</div>
									<div class='text-center ' style='padding:1%;'>Your Definition Approval is Pending</div>";
								}
								$p_disabled = '';
								$r=mysqli_query($con,"SELECT * FROM ".$_SESSION['sub']."team WHERE (id1='$id' OR id2='$id' OR id3='$id' OR id4='$id' OR id5='$id') AND approved = 1");	
								if(mysqli_num_rows($r) > 0)
								{
									$row = mysqli_fetch_assoc($r);
									$gid = $row['gid'];
									$r=mysqli_query($con,"SELECT * FROM ".$_SESSION['sub']."team WHERE gid ='$gid'");
									$row = mysqli_fetch_assoc($r);	
									if(empty($row['definition']) || empty($row['description']))
									{
										$r1=mysqli_query($con,"SELECT * FROM ".$_SESSION['sub']."disable_registration WHERE project_disable = 1") or die(mysqli_error($con));
										if(mysqli_num_rows($r1) > 0)
										{
											echo "<div class='text-white text-center'>Project Definition Upload disabled</div>";
											$p_disabled = 'disabled';
										}
										echo "<form class='form' action='".$_SERVER["PHP_SELF"]."' method='POST'>
										<label for='link_heading'>Project Definition::</label>
										<input type='text' class='form-control' name='p_definition' value='' required='required'>
										<input type='hidden' class='form-control' name='gid' value='$gid' required='required'>
										<label for='link'>Project Description::</label>
										<textarea name='p_description' value='' class='form-control' required='required' rows='7'></textarea>
										<div class='text-center' style='padding:0;margin: 4%; margin-left: 0;'> 
										<button type='submit' class='btn $p_disabled'  name='r_details' style='background-color: #610835'>Submit Project Details</button>
										</div>
										";
									}
									else
									{
										function addfaculty($x)
										{
											global $con;
											$r=mysqli_query($con,"SELECT * FROM faculty WHERE id = '$x'") or die(mysqli_error($con));
											$row = mysqli_fetch_assoc($r);	
											return $row['name'];
										}
										$r1=mysqli_query($con,"SELECT * FROM ".$_SESSION['sub']."team WHERE gid = $gid and def_approved = 1 and def_disapproved = 0") or die(mysqli_error($con));
										if(mysqli_num_rows($r1) > 0)
										{
											$row = mysqli_fetch_assoc($r1);
											echo "<table class='table table-bordered'>
											<thead>
											<tr>
											<th>Group ID</th>";
											for($n = 1; $n<=$_SESSION['max'];$n++)
												echo "<th>ID$n</th>";
											echo"
											<th>Faculty Guide</th><th>Definition</th></tr>
											</thead>
											<tbody>";
											echo "<tr><td>".$row['gid']."</td>";
											for($n = 1; $n<=$_SESSION['max'];$n++)
												echo "<td>".$row['id'.$n]."</td>";
											echo "<td>".addfaculty($row['fid'])."</td>
											<td><a href='#' class='.mytoggle text-white' data-toggle='modal' data-target='#myModal'>Definition</a></td></tr></tbody></table>
											</thead>
											</table>
											<div class='modal fade' id='myModal'>
											<div class='modal-dialog modal-dialog-centered	'>
											<div class='modal-content'>

											<!-- Modal Header -->
											<div class='modal-header'>
											<h4 class='modal-title text-dark'>".$row['definition']."</h4>
											<button type='button' class='close' data-dismiss='modal'>&times;</button>
											</div>

											<!-- Modal body -->
											<div class='modal-body text-dark'>
											".$row['description']."
											</div>
											</div>
											</div>
											</div>";
										}
										else
										{
											$r1=mysqli_query($con,"SELECT * FROM ".$_SESSION['sub']."team WHERE gid = $gid and def_approved = 0 and def_disapproved = 1") or die(mysqli_error($con));
											if(mysqli_num_rows($r1) > 0)
											{
												echo "<div class='text-center text-white'>Your Definition is disapproved</div>
												<form class='form' action='".$_SERVER["PHP_SELF"]."' method='POST'>
												<label for='link_heading'>Project Definition::</label>
												<input type='text' class='form-control' name='p_definition' value='' required='required'>
												<input type='hidden' class='form-control' name='gid' value='$gid' required='required'>
												<label for='link'>Project Description::</label>
												<textarea name='p_description' value='' class='form-control' required='required' rows='7'></textarea>
												<div class='text-center' style='padding:0;margin: 4%; margin-left: 0;'> 
												<button type='submit' class='btn text-white $p_disabled' name = 'p_details' style='background-color: #610835'>Submit Project Details</button>
												</div>";		
											}			
										}
									}
								}
							}
						}
						$r1=mysqli_query($con,"SELECT * FROM ".$_SESSION['sub']."team WHERE (id1='$id' OR id2='$id' OR id3='$id' OR id4='$id' OR id5='$id') AND approved = 0 AND disapproved = 0");
						
						$c1 = mysqli_num_rows($r1);
						$row = mysqli_fetch_assoc($r1);
						if($c1 > 0)
						{
							echo "<div class='text-center'>Your team is pending</div>";
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
