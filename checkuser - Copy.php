<?php


$link=mysqli_connect("localhost","root","Welcome@123","bookedapp");
mysqli_set_charset($link, "utf8");

$err = array();

$data = json_decode(file_get_contents('php://input'), true);


$phone = $data['phone'];
$dob = $data['dob'];
			
			// Pass
			$pass = "SELECT result FROM result where id=1";


			$passresult = mysqli_query($link ,$pass) 
								or die (mysqli_error()); 

					
			$passnum = mysqli_num_rows($passresult);
					
			$passres[] = array();

			while (($passrow = mysqli_fetch_assoc($passresult)) != false) 
			{
				$passres[] = $passrow;
			} 

			// Fail
			$fail = "SELECT result FROM result where id=2";


			$failresult = mysqli_query($link ,$fail) 
								or die (mysqli_error()); 

					
			$failnum = mysqli_num_rows($failresult);
					
			$failres[] = array();

			while (($failrow = mysqli_fetch_assoc($failresult)) != false) 
			{
				$failres[] = $failrow;
			} 




$rs_duplicate = mysqli_query($link, "SELECT count(*) FROM `Member` WHERE `PhoneNumber`='$phone' AND `DOB`='$dob'") or die(mysql_error());

list($total) = mysqli_fetch_row($rs_duplicate);

if ($total > 0)
{
	header('Content-Type: application/json');				
	echo json_encode($failres);
}
else
{
	header('Content-Type: application/json');
	echo json_encode($passres);
}	
?>