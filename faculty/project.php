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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?include "../includes/file.php";?>
	<link rel="stylesheet" href="../css/style.css">
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

	<div class="container-fluid">	
		<div id="main" class="col-lg-12">
			<div class="row">
				<div class="col-xl-12 text-center bg-primary text-white">
					<h2 style="padding: 1%;margin: 0;">Project Details</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-12" style="padding: 1%;">
					<div class="row" style="padding: 1%;">
						<div class='col-lg-2'>						
							<form method = 'POST' action=<?echo $_SERVER["PHP_SELF"]?>>
								<button class='btn btn-outline-primary btn-block' type = 'submit' name = 'report'>Project <br>Reports</button>
							</form>
						</div>
						<div class='col-lg-10' id = 'show'>
							<?
							if(isset($_POST['gid']) && isset($_POST['type']) && isset($_POST['head']))
							{
								$g=$_POST['gid'];
								$t=$_POST['type'];
								$h=$_POST['head'];
								$r = mysqli_query($con,"INSERT INTO ".$_SESSION['sub']."remark (gid,head,type) VALUES ('$g','$h','$t')") or die(mysqli_error($con)) ;
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
								$mail->setFrom($ml);
								$mail->addAddress($m);     
								$mail->isHTML(true);                                  
								$mail->Subject = 'Remark added';
								$mail->Body    = "Group no : $g remark is added for a report.Kindly visit the portal for more details";
								$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

								//$mail->send();
								remark($t,$g);
							}
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
									echo"
									<form action='".$_SERVER['PHP_SELF']."' method='post'>
									<input type ='hidden' name = 'gid' value = '$g'/>
									<input type ='hidden' name = 'type' value = '$type'/>
									<label for='link'>Remark::</label>
									<textarea name='head' value='' class='form-control' required='required'></textarea>
									<div class='text-center' style='padding:0;margin: 4%; margin-left: 0;''> 
									<button type='submit' class='btn btn-primary'>Add a Remark</button>
									</div>
									</form>";
								}
								else
								{
									echo"
									<form action='".$_SERVER['PHP_SELF']."' method='post'>
									<input type ='hidden' name = 'gid' value = '$g'/>
									<input type ='hidden' name = 'type' value = '$type'/>
									<label for='link'>Remark::</label>
									<textarea name='head' value='' class='form-control' required='required'></textarea>
									<div class='text-center' style='padding:0;margin: 4%; margin-left: 0;''> 
									<button type='submit' class='btn btn-primary'>Add a Remark</button>
									</div>
									</form>";
								}
							}
							function update1($a,$d,$g,$f)
							{
								global $con;
								if($f == "plag" || $f == "final")
								{
									$r = mysqli_query($con,"UPDATE ".$_SESSION['sub']."project SET ".$f."_report= $a , ".$f."_approved = $a , ".$f."_disapproved = $d WHERE gid = $g") or die(mysqli_error($con));
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
									$mail->setFrom($ml);
									$mail->addAddress($m);     
									$mail->isHTML(true);                                  
									$mail->Subject = 'Report acknowlwdged';
									$mail->Body    = "Group no : $g your report is acknowlwdged by the guide. Kindly visit the portal for more details";
									$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

									//$mail->send();
								}
								else
								{
									$r = mysqli_query($con,"UPDATE ".$_SESSION['sub']."project SET ".$f."= $a , ".$f."_approved = $a , ".$f."_disapproved = $d WHERE gid = $g") or die(mysqli_error($con));
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
									$mail->setFrom($ml);
									$mail->addAddress($m);     
									$mail->isHTML(true);                                  
									$mail->Subject = 'Report acknowlwdged';
									$mail->Body    = "Group no : $g your report is acknowlwdged by the guide. Kindly visit the portal for more details";
									$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

									//$mail->send();
								}
								if($d == 1)
								{
									$fileName = $f;
									$path ="../".$_SESSION['sub']."report/G".$g."/";
									$filePath = $path;
									$a1 = scandir($path);
									$x = array();
									foreach ($a1 as $value)
									{
										$x[] = substr($value, 0, strripos($value, '.')); 
									}
									$ext = array_search($f , $x); 
									$fileName = $a1[$ext];
									$filePath .= $fileName;
									unlink($filePath);
									display($g);
								}
							}
							function check($gid,$x)
							{
								global $con,$ppr1,$ppr2,$ppr3,$ppr4,$plag_report,$final_report;
								$r=mysqli_query($con,"SELECT * FROM ".$_SESSION['sub']."project WHERE gid = $gid") or die("error");
								$row=mysqli_fetch_assoc($r);

								if($row[$x] == 1)
									return "Uploaded";
								else
									return "-";
							}
							function check1($gid,$x)
							{
								global $con,$ppr1,$ppr2,$ppr3,$ppr4,$plag_report,$final_report;
								$r=mysqli_query($con,"SELECT * FROM ".$_SESSION['sub']."project WHERE gid = $gid") or die("error");
								$row=mysqli_fetch_assoc($r);
								if($row[$x.'_approved'] == 1)
									return "Approved";
								elseif($row[$x.'_disapproved'] == 1)
									return "Disapproved";
								else
									return "-";
							}
							function download($file,$g)
							{
								$fileName = $file;
								$path ="../".$_SESSION['sub']."report/G".$g."/";
								$filePath = $path;
								$a = scandir($path);
								$x = array();
								foreach ($a as $value)
								{
									$x[] = substr($value, 0, strripos($value, '.')); 
								}
								$ext = array_search($file , $x); 
								$fileName = $a[$ext];
								$filePath .= $fileName;
								if(!empty($fileName) && file_exists($filePath) && check($g,$file) != '-')
								{
									/*header('Connection: Keep-Alive');
									header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
									header("Content-Description: File Transfer");
									header("Content-Disposition: attachment; filename=$fileName");
									header("Content-Type: application/force-download");
									header("Expires: 0");
									header("Pragma: public");
									header("Content-Length: ".filesize($filePath) );
									//header("Content-Transfer-Encoding: binary");
									ob_clean();
									flush();
									readfile($filePath);
									exit;*/
									header('Content-Description: File Transfer');
								    header('Content-Type: application/octet-stream');
								    header("Content-Disposition: attachment; filename=$fileName");
								    header('Expires: 0');
								    header('Cache-Control: must-revalidate');
								    header('Pragma: public');
								    header('Content-Length: ' . filesize($filePath));
								    readfile($file);
								    exit;
								}	
								else
								{
									?>
									<script type="text/javascript">
										alert('invalid action');
									</script>
									<?
								}			 
							}
							if(isset($_POST['gid']) && isset($_POST['ppr1']))
								download('ppr1',$_POST['gid']);
							if(isset($_POST['gid']) && isset($_POST['ppr2']))
								download('ppr2',$_POST['gid']);
							if(isset($_POST['gid']) && isset($_POST['ppr3']))
								download('ppr3',$_POST['gid']);
							if(isset($_POST['gid']) && isset($_POST['ppr4']))
								download('ppr4',$_POST['gid']);
							if(isset($_POST['gid']) && isset($_POST['plag_report']))
								download('plag_report',$_POST['gid']);
							if(isset($_POST['gid']) && isset($_POST['final_report']))
								download('final_report',$_POST['gid']);
							if(isset($_POST['ppr1_a']) && isset($_POST['gid']))
								update1(1,0,$_POST['gid'],'ppr1');
							if(isset($_POST['ppr1_d']) && isset($_POST['gid']))
								update1(0,1,$_POST['gid'],'ppr1');
							if(isset($_POST['ppr2_a']) && isset($_POST['gid']))
								update1(1,0,$_POST['gid'],'ppr2');
							if(isset($_POST['ppr2_d']) && isset($_POST['gid']))
								update1(0,1,$_POST['gid'],'ppr2');
							if(isset($_POST['ppr3_a']) && isset($_POST['gid']))
								update1(1,0,$_POST['gid'],'ppr3');
							if(isset($_POST['ppr3_d']) && isset($_POST['gid']))
								update1(0,1,$_POST['gid'],'ppr3');
							if(isset($_POST['ppr4_a']) && isset($_POST['gid']))
								update1(1,0,$_POST['gid'],'ppr4');
							if(isset($_POST['ppr4_d']) && isset($_POST['gid']))
								update1(0,1,$_POST['gid'],'ppr4');
							if(isset($_POST['plag_a']) && isset($_POST['gid']))
								update1(1,0,$_POST['gid'],'plag');
							if(isset($_POST['plag_d']) && isset($_POST['gid']))
								update1(0,1,$_POST['gid'],'plag');
							if(isset($_POST['final_a']) && isset($_POST['gid']))
								update1(1,0,$_POST['gid'],'final');
							if(isset($_POST['final_d']) && isset($_POST['gid']))
								update1(0,1,$_POST['gid'],'final');
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
							function display($gid)
							{
								echo "		
								<table class='table table-hover text-center'>
								<thead>
								<tr>
								<th>Report</th>
								<th>Download Reports</th>
								<th>Report status</th>
								<th>Approve</th>
								<th>Disapprove</th>
								<th>Status</th>	
								<th>Remarks</th>
								</tr>
								</thead>
								<tbody>";
								for($n = 1; $n<=$_SESSION['report'];$n++)
								{
									echo"<tr>
									<td>PPR$n</td>
									<td>
									<form action='' method='post'>
									<input type ='hidden' name = 'gid' value = '$gid'/>
									<input type='submit' value='Download' name='ppr".$n."' class='btn btn-primary ";
									if(check($gid,"ppr$n") == '-' ){echo 'disabled';}
									echo" '>
									</form>
									</td>
									<td>".check($gid,"ppr$n")."</td>
									<form action='".$_SERVER['PHP_SELF']."' method='post'>
									<input type ='hidden' name = 'gid' value = '$gid'/>
									<td><input type='submit' value='Approve' name='ppr".$n."_a' class='btn btn-primary' ";
									if(check($gid,"ppr$n") == '-'){echo 'disabled';}
									echo" /> </td>
									<td><input type='submit' value='Disapprove' name='ppr".$n."_d' class='btn btn-primary ";
									if(check($gid,"ppr$n") == '-'){echo 'disabled';}
									echo" '/></td>
									<td>".check1($gid,"ppr$n")."</td>
									<td><input type='submit' value='Add Remarks' name='remark_ppr".$n."' class='btn btn-primary ";
									if(check($gid,"ppr$n") == '-'){echo 'disabled';}
									echo" '/></td>
									</form>
									</tr>";
								}
								echo "
								<td>Plagiarism Report</td>
								<td>
								<form action='' method='post' enctype='multipart/form-data'>
								<input type ='hidden' name = 'gid' value = '$gid'/>
								<input type='submit' value='Download' name='plag_report' class='btn btn-primary ";
								if(check($gid,"plag_report") == '-'){echo 'disabled';}
								echo"'>
								</form>
								</td>
								<td>".check($gid,"plag_report")."</td>
								<form action='".$_SERVER['PHP_SELF']."' method='post'>
								<input type ='hidden' name = 'gid' value = '$gid'/>
								<td><input type='submit' value='Approve' name='plag_a' class='btn btn-primary ";
								if(check($gid,"plag_report") == '-'){echo 'disabled';}
								echo" '/> </td>
								<td><input type='submit' value='Disapprove' name='plag_d' class='btn btn-primary ";
								if(check($gid,"plag_report") == '-'){echo 'disabled';}
								echo" '/></td>
								<td>".check1($gid,'plag')."</td>
								<td><input type='submit' value='Add Remarks' name='remark_plag' class='btn btn-primary ";
								if(check($gid,"plag_report") == '-'){echo 'disabled';}
								echo" '/></td>
								</form>
								</tr>
								<tr>
								<td>Final Report</td>
								<td>
								<form action='' method='post'>
								<input type ='hidden' name = 'gid' value = '$gid'/>
								<input type='submit' value='Download' name='final_report' class='btn btn-primary ";
								if(check($gid,"final_report") == '-'){echo 'disabled';}
								echo"'>
								</form>
								</td>
								<td>".check($gid,"final_report")."</td>
								<form action='".$_SERVER['PHP_SELF']."' method='post'>
								<input type ='hidden' name = 'gid' value = '$gid'/>
								<td><input type='submit' value='Approve' name='final_a' class='btn btn-primary ";
								if(check($gid,"final_report") == '-'){echo 'disabled';}
								echo" '/> </td>
								<td><input type='submit' value='Disapprove' name='final_d' class='btn btn-primary ";
								if(check($gid,"final_report") == '-'){echo 'disabled';}
								echo" '/></td>
								<td>".check1($gid,'final')."</td>
								<td><input type='submit' value='Add Remarks' name='remark_final' class='btn btn-primary ";
								if(check($gid,"final_report") == '-'){echo 'disabled';}
								echo" '/></td>
								</form>
								</tr>
								</tbody>	
								</table>";	
							}
							
							if(isset($_POST['gid']) && isset($_POST['group1']))
							{
								$gid=$_POST['gid'];
								$r=mysqli_query($con,"SELECT * FROM ".$_SESSION['sub']."team WHERE gid = $gid") or die("error");
								$row=mysqli_fetch_assoc($r);
								if((!empty($row['definition']) && !empty($row['description'])) || $row['def_approved'] == 1)
								{
									display($_POST['gid']);
								}
								else
								{
									echo "<div class='text-danger text-center'>Definition not uploaded or approved yet </div>";
								}
							}
							if(isset($_POST['report']))
							{
								echo "
								<form method='POST' action='".$_SERVER["PHP_SELF"]."'>
								<div class='text-left'>
								<div class='form-group'>
								<label for='guide'>Select Group:</label>
								<select class='form-control' id='gid' name='gid' required='required'>
								<option value=''>Select Group</option>";

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

								echo "</select>
								</div>
								</div>
								<div class='col-md-12 text-center form-control' style='padding:0;margin: 4%; margin-left: 0;'> 
								<button type='submit' name ='group1' class='btn btn-primary btn-block'>Select Group</button>
								</div>
								</form>";
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