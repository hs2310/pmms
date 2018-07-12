<?

/*use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$mail = new PHPMailer(true);         
$mail->SMTPDebug = 0;            
$mail->isSMTP();                 
$mail->Host = 'smtp.gmail.com';  
$mail->SMTPAuth = true;                              
$mail->Username = 'harshilshah186@gmail.com';        
$mail->Password = 'hsshah396321';                    
$mail->SMTPSecure = 'tls';                           
$mail->Port = 25;                                    

$mail->setFrom('bhairavivaidya96@gmail.com');
$mail->addAddress('harshilshah186@gmail.com');     
$mail->isHTML(true);                                  
$mail->Subject = 'Here is the subject';
$mail->Body    = ' <b>Love you sexy baby <3 <3!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if($mail->send())
	echo 'Message has been sent';*/
include "includes/config.php";
/*for($x = 65 ; $x<67;$x++)
{
	$r = mysqli_query($con,"INSERT INTO mini_student (id) VALUES('15it0".$x."')");
}
for($x = 4; $x<10;$x++)
{
	$r = mysqli_query($con,"INSERT INTO mini_student (id) VALUES('16it60".$x."')");
}
for($x = 1; $x<10;$x++)
{
	$r = mysqli_query($con,"INSERT INTO project1_student (id) VALUES('15it00".$x."')");
}*/
/*for($x = 10; $x<73;$x++)
{
	$r = mysqli_query($con,"INSERT INTO project2_student (id) VALUES('15it0".$x."')");
}*/
for($x = 1; $x<10;$x++)
{
	$r = mysqli_query($con,"INSERT INTO project1_student (id) VALUES('15it00".$x."')") or die(mysqli_error($con));
	echo "string";
}
for($x = 10; $x<73;$x++)
{
	$r = mysqli_query($con,"INSERT INTO project1_student (id) VALUES('15it0".$x."')") or die(mysqli_error($con));
}
for($x = 1; $x<10;$x++)
{
	$r = mysqli_query($con,"INSERT INTO project1_student (id) VALUES('16it60".$x."')") or die(mysqli_error($con));
	echo "string";
}
for($x = 10; $x<16;$x++)
{
	$r = mysqli_query($con,"INSERT INTO project1_student (id) VALUES('16it6".$x."')") or die(mysqli_error($con));
}
/*
	$r = mysqli_query($con,"INSERT INTO mini_student (id) VALUES('16it602')");
	$r = mysqli_query($con,"INSERT INTO mini_student (id) VALUES('15it070')");
//}	
	$r = mysqli_query($con,"INSERT INTO mini_student (id) VALUES('15it071')");
*/	/*$r = mysqli_query($con,"INSERT INTO mini_student (id) VALUES('15it005')");
	$r = mysqli_query($con,"INSERT INTO mini_student (id) VALUES('15it006')");*/
?>