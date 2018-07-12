<?
session_start();
include '../includes/config.php';
include '../includes/usercheck.php';
$id=$_GET['id'];
$db=$_GET['db'];
$sql="DELETE FROM $db WHERE id = $id";
$f = $_SESSION['sub']."faq";
$d = $_SESSION['sub']."dashboard";
if(mysqli_query($con,$sql))
{
	if ($db == $f) 
	{
		$p = "faq";
	}
	else if ($db == $d)
	{
		$p = "dashboard";
	}
	header("location:../".$_SESSION['type']."/".$p.".php");
}
?>