<?
session_start();
include '../includes/config.php';
include '../includes/usercheck.php';
if($_SESSION['type'] == 'faculty')
{}
else
{
	header("location:../index.php");
}
$id=$_GET['id'];
$a=$_GET['a'];
$date=date("d-m-Y");
if($a == 0)
{
	$b=1;
}
else
{
	if(!is_dir("../".$_SESSION['sub']."report/G$id"))
		mkdir("../".$_SESSION['sub']."report/G$id");
	$r1 = mysqli_query($con,"INSERT INTO ".$_SESSION['sub']."project (gid) VALUES('$id')") or die(mysqli_error($con));
	$b = 0;
}
$q1="UPDATE ".$_SESSION['sub']."team SET approved = '$a', disapproved = '$b' where gid = '$id'";
mysqli_query($con,$q1);
header("location:../".$_SESSION['type']."/team.php");
?>