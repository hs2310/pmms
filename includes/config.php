<?php
$con = mysqli_connect('localhost','root','','pmms');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
?>