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
								<button class='btn btn-outline-white btn-block' type = 'submit' name = 'report'>Project <br>Reports</button>
							</form>
						</div>
						<div class='col-lg-10' id = 'show'>
							<?
							function remark($type,$g)
							{
								global $con;
								$r = mysqli_query($con,"SELECT * FROM ".$_SESSION['sub']."remark WHERE gid = $g AND type ='$type'") or die(mysqli_error($con));
								if(mysqli_num_rows($r) > 0)
								{
									echo "
									<div class='card text-center' style='padding:0.5%'>
									<h4 class='card-title'>Remarks</h4>
									<div class='card-body text-left'>";
									while($row = mysqli_fetch_assoc($r))
									{
										echo $row['head']."<br><br>";
									}
									echo"</div></div><br>";
								}
								else
								{
									?>
									<div class="text-danger text-center">No Remarks to Show</div>
									<?
								}
							}
							if(isset($_POST['remark_ppr1']) && isset($_POST['gid']))
								remark('ppr1',$_POST['gid']);
							if(isset($_POST['remark_ppr2']) && isset($_POST['gid']))
								remark('ppr2',$_POST['gid']);
							if(isset($_POST['remark_ppr3']) && isset($_POST['gid']))
								remark('ppr3',$_POST['gid']);
							if(isset($_POST['remark_ppr4']) && isset($_POST['gid']))
								remark('ppr4',$_POST['gid']);
							if(isset($_POST['remark_plag']) && isset($_POST['gid']))
								remark('plag',$_POST['gid']);
							if(isset($_POST['remark_final']) && isset($_POST['gid']))
								remark('final',$_POST['gid']);
							function check($gid,$x)
							{
								global $con;
								$r=mysqli_query($con,"SELECT * FROM ".$_SESSION['sub']."project WHERE gid = $gid") or die("error");
								$row=mysqli_fetch_assoc($r);
								if($x== "final")
								{
									$y="final_report";
								}
								elseif($x == "plag")
								{
									$y="plag_report";
								}
								else
								{
									$y = $x;
								}
								if($row[$y] == 1)
								{
									if($row[$x."_approved"] == 0 && $row[$x."_disapproved"] == 0)
									{
										return "Pending";
									}
									elseif($row[$x."_approved"] == 1 && $row[$x."_disapproved"] == 0)
									{
										return "Approved";
									}
								}
								elseif($row[$y] == 0 && $row[$x."_disapproved"] == 1)
								{
									return "Disapproved";
								}
								else
									return "-";
							}
							function display($gid)
							{
								global $con;
								$disabled ="";
								$sql = "SELECT * FROM ".$_SESSION['sub']."disable_registration WHERE report_disable = 1";
								$rst1 = mysqli_query($con,$sql) or die(mysqli_error($con));
								if(mysqli_num_rows($rst1) > 0)
								{
									
									echo "<div class='text-danger text-center'>Team Registration is Disabled by Co-ordinator</div><br>";
									$disabled = "disabled";
								}
								echo "		
								<table class='table table-hover text-center'>
								<thead>
								<tr>
								<th>Report</th>
								<th>Upload Reports</th>
								<th>Acknowledgement</th>
								<th>Remarks</th>
								</tr>
								</thead>
								<tbody>";
								for($n = 1; $n<=$_SESSION['report'];$n++)
								{
									echo"<tr>
									<td>PPR$n</td>
									<td>
									<form action='' method='post' enctype='multipart/form-data'>
									<input type='file' name='f_PPR$n' class='' required='required'>
									<input type ='hidden' name = 'gid' value = '$gid'/>
									<input type='submit' value='Upload' name='ppr$n' class='btn btn-white $disabled'>
									</form>
									</td>
									<td>".check($gid,"ppr$n")."</td>
									<form action='".$_SERVER['PHP_SELF']."' method='post'>
									<input type ='hidden' name = 'gid' value = '$gid'/>
									<td><input type='submit' value='View Remarks' name='remark_ppr".$n."' class='btn btn-white'/></td>
									</form>
									</tr>
									<tr>";
								}
								echo"
								<td>Plagiarism Report</td>
								<td>
								<form action='' method='post' enctype='multipart/form-data'>
								<input type='file' name='f_Plag' required='required'>
								<input type ='hidden' name = 'gid' value = '$gid'/>
								<input type='submit' value='Upload' name='plag_report' class='btn btn-white $disabled'>
								</form>
								</td>
								<td>".check($gid,"plag")."</td>
								<form action='".$_SERVER['PHP_SELF']."' method='post' >
								<input type ='hidden' name = 'gid' value = '$gid'/>
								<td><input type='submit' value='View Remarks' name='remark_plag' class='btn btn-white'/></td>
								</form>
								</tr>
								<tr>
								<td>Final Report</td>
								<td>
								<form action='' method='post' enctype='multipart/form-data'>
								<input type='file' name='f_final' required='required'>
								<input type ='hidden' name = 'gid' value = '$gid'/>
								<input type='submit' value='Upload' name='final_report' class='btn btn-white $disabled'>
								</form>
								</td>
								<td>".check($gid,"final")."</td>
								<form action='".$_SERVER['PHP_SELF']."' method='post' >
								<input type ='hidden' name = 'gid' value = '$gid'/>
								<td><input type='submit' value='View Remarks' name='remark_final' class='btn btn-white'/></td>
								</form>
								</tr>
								</tbody>	
								</table>";	
							}
							function upload($g,$f,$r,$n)
							{
								global $con;
								$filename = $f["name"];
								$file_basename = substr($filename, 0, strripos($filename, '.')); 
								$file_ext = substr($filename, strripos($filename, '.')); 
								$filesize = $f["size"];
								$allowed_file_types = array('.doc','.docx','.rtf','.pdf');	

								if (in_array($file_ext,$allowed_file_types) && ($filesize < 26214400 ))
								{	
									$newfilename = $n . $file_ext;
									if (file_exists("../".$_SESSION['sub']."report/G".$g."/" . $newfilename))
									{
										echo "<script>alert('You have already uploaded this file.');</script>";
									}
									else
									{		
										$r1=mysqli_query($con,"SELECT * FROM ".$_SESSION['sub']."project WHERE gid = $g") or die(mysqli_error($con));
										if(mysqli_num_rows($r1) > 0)
										{
											$row = mysqli_fetch_assoc($r1);
											if($n == "plag" || $n == "final")
											{
												if($row[$n."_report"] == '0')
												{
													move_uploaded_file($f["tmp_name"], "../".$_SESSION['sub']."report/G".$g."/" . $newfilename);
													$r2=mysqli_query($con,"UPDATE ".$_SESSION['sub']."project SET ".$n."_report = 1 ,".$n."_disapproved = 0 WHERE gid = $g") or die(mysqli_error($con));
													$r = mysqli_query($con,"Select * from ".$_SESSION['sub']."team where gid =".$g);
													$row = mysqli_fetch_assoc($r);
													$s = $row['id1'];
													$fid= $row['fid'];	
													$r = mysqli_query($con,"Select * from ".$_SESSION['sub']."student where id ='".$s."'");
													$row = mysqli_fetch_assoc($r);
													$m = $row['email'];	
													$r1 = mysqli_query($con,"Select * from faculty where id= '".$fid."'") or die(mysqli_error($con));
													$row = mysqli_fetch_assoc($r1);
													$ml = $row['email'];
													$mail = new PHPMailer(true);         
													require '../includes/mail_config.php';
													$mail->setFrom($m);
													$mail->addAddress($ml);     
													$mail->isHTML(true);                                  
													$mail->Subject = 'Report Uploaded';
													$mail->Body    = "Group no : $g has uploaded a report.Kindly visit the portal for more details";
													$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

													//$mail->send();
													echo "<script>alert('File uploaded successfully!');</script>";  
												}	
											}
											else
											{
												if($row[$n] == '0')
												{
													move_uploaded_file($f["tmp_name"], "../".$_SESSION['sub']."report/G".$g."/" . $newfilename);
													$r2=mysqli_query($con,"UPDATE ".$_SESSION['sub']."project SET ".$n." = 1 ,".$n."_disapproved = 0 WHERE gid = $g") or die(mysqli_error($con));
													$r = mysqli_query($con,"Select * from ".$_SESSION['sub']."team where gid =".$g);
													$row = mysqli_fetch_assoc($r);
													$s = $row['id1'];
													$fid= $row['fid'];	
													$r = mysqli_query($con,"Select * from ".$_SESSION['sub']."student where id ='".$s."'");
													$row = mysqli_fetch_assoc($r);
													$m = $row['email'];	
													$r1 = mysqli_query($con,"Select * from faculty where id= '".$fid."'") or die(mysqli_error($con));
													$row = mysqli_fetch_assoc($r1);
													$ml = $row['email'];
													$mail = new PHPMailer(true);         
													require '../includes/mail_config.php';
													$mail->setFrom($m);
													$mail->addAddress($ml);     
													$mail->isHTML(true);                                  
													$mail->Subject = 'Report Uploaded';
													$mail->Body    = "Group no : $g has uploaded a report.Kindly visit the portal for more details";
													$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

												//	$mail->send();
													echo "<script>alert('File uploaded successfully!');</script>";  
												}
											}
										}
									}
								}	 
								elseif ($filesize > 2000000)
								{	
									echo "<script>alert('The file you are trying to upload is too large.');</script>";
								}
								else
								{
									echo "<script>alert('Only these file typs are allowed for upload: " . implode(', ',$allowed_file_types)."');</script>";
									unlink($f["tmp_name"]);
								}
								display($g);
							}
							$id=$_SESSION['username'];
							if(isset($_POST['ppr1']))
							{
								upload($_POST['gid'],$_FILES['f_PPR1'],$_POST['ppr1'],"ppr1");
							}
							if(isset($_POST['ppr2']))
							{
								upload($_POST['gid'],$_FILES['f_PPR2'],$_POST['ppr2'],"ppr2");
							}
							if(isset($_POST['ppr3']))
							{
								upload($_POST['gid'],$_FILES['f_PPR3'],$_POST['ppr3'],"ppr3");
							}
							if(isset($_POST['ppr4']))
							{
								upload($_POST['gid'],$_FILES['f_PPR4'],$_POST['ppr4'],"ppr4");
							}
							if(isset($_POST['plag_report']))
							{
								upload($_POST['gid'],$_FILES['f_Plag'],$_POST['plag_report'],"plag");
							}
							if(isset($_POST['final_report']))
							{
								upload($_POST['gid'],$_FILES['f_final'],$_POST['final_report'],"final");
							}
							if(isset($_POST['report']))
							{
								
								$r=mysqli_query($con,"SELECT * FROM ".$_SESSION['sub']."team WHERE (id1='$id' OR id2='$id' OR id3='$id' OR id4='$id' OR id5='$id') AND approved = 1");	
								
								if(mysqli_num_rows($r) > 0)
								{
									$row = mysqli_fetch_assoc($r);
									$gid = $row['gid'];
									$r1=mysqli_query($con,"SELECT * FROM ".$_SESSION['sub']."team WHERE gid ='$gid' and def_approved = 1") or die('error');
									if(mysqli_num_rows($r1) == 0)
									{
										echo "<div class='text-center text-danger'>Your Definition is Not Approved or Pending</div>";
									}
									else
									{
										display($gid);
									}
								}
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