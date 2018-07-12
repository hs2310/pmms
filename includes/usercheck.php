<?
if(isset($_SESSION['username']) && isset($_SESSION['type']))
{

}
else
{
	header('location:../index.php');
}
?>