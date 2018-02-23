<?php


$link=mysqli_connect("localhost","root","Welcome@123","bookedapp");
mysqli_set_charset($link, "utf8");

$err = array();

$data = json_decode(file_get_contents('php://input'), true);



$iam = $data['iam'];
$interested = $data['interested'];
$dob = $data['dob'];
$phone = $data['phone'];
$otpcode = $data['otpcode'];

			
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


if ($phone=="")
{
	$total=0;
}
else
{
	$rs_duplicate = mysqli_query($link, "SELECT count(*) FROM `Member` WHERE `PhoneNumber`='$phone'") or die(mysql_error());
	list($total) = mysqli_fetch_row($rs_duplicate);
}

if ($total > 0)
{
	header('Content-Type: application/json');				
	echo json_encode($failres);
	exit();	
}


			$sql_insert = "INSERT INTO `Member`(`PhoneNumber`, `Gender`, `SeekingGender`, `DOB`) VALUES ('$phone','$iam','$interested','$dob')";
			
	
			$result = mysqli_query($link ,$sql_insert) 
								or die (mysqli_error()); 		
								
			$MemberId = mysqli_insert_id($link);  


			$userqry = "SELECT `MemberID`, `PhoneNumber`, `Gender`, `SeekingGender`, `DOB`, `Accountstatus`, `PhoneSerialNumber`, `icloudAccount`, `DateCreated`, `DateUpdated` FROM `Member` WHERE MemberID = " . $MemberId;
			
			$userresult = mysqli_query($link ,$userqry) 
								or die (mysqli_error());

			$usernum = mysqli_num_rows($userresult);
					
			$userres[] = array();

			while (($userrow = mysqli_fetch_assoc($userresult)) != false) 
			{
				$userres[] = $userrow;
			}

								
			if ($result)
			{	
				header('Content-Type: application/json');
				echo json_encode($userres);
			}
			else
			{
				header('Content-Type: application/json');
				echo json_encode($failres);
			}	
?>