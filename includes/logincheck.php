<?
session_start();
include '../includes/config.php';

$username = $_POST['username'];
$password = $_POST['password'];
$type = $_POST['type'];
$sub = $_POST['sub'];
$query = "SELECT * FROM $sub$type WHERE id = '".$username."' AND password = '".$password."'";
if ($type == 'faculty') 
{
	$query = "SELECT * FROM $type WHERE id = '".$username."' AND password = '".$password."'";
}
if($type == "admin")
{
	$query = "SELECT * FROM $type WHERE id = '".$username."' AND password = '".$password."' AND type = '$sub'";	
}
$result = mysqli_query($con, $query);
if(mysqli_error($con))
{
	echo "<script>alert('invalid userid or password');</script>";
}
$count = mysqli_num_rows($result);
if ($count == 1)
{
	$_SESSION['username'] = $username;
	$_SESSION['type'] = $type;
	$_SESSION['sub'] = $sub;
	$x = mysqli_query($con,"SELECT * FROM ".$_SESSION['sub']."report") or die(mysqli_error($con));
	$rppr = mysqli_fetch_assoc($x);
	$_SESSION['report'] = $rppr['ppr']; 
	$_SESSION['min'] = $rppr['team_min'];
	$_SESSION['max'] = $rppr['team_max'];
	if(!empty($password))
	{
		header("location:../".$type."/dashboard.php?");
	}
	else
	{
		header("location:../includes/firsttime.php");
	}
}
else
{
	$q=1;
	header("location:../index.php?q=".$q);
}

?>