<?
session_start();
include '../includes/config.php';
if($_SESSION['type'] == 'student')
{
}
else
{
	header("location:../index.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['fid'])) 
{
	$id = $_SESSION['username'];
	$f = $_POST['fid'];
	$q = "UPDATE ".$_SESSION['sub']."team SET fid = '$f' , approved = 0 , disapproved = 0 WHERE id1='$id' OR id2='$id' OR id3='$id'";
	echo "$q";
	$result2 = mysqli_query($con,$q);
	if ($result2)
	{
		header("location:team.php");		
	}
	else if(!$result2)
	{
		
	}			
}
?>