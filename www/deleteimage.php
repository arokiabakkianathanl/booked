<?php


$link=mysqli_connect("localhost","root","Welcome@123","bookedapp");
mysqli_set_charset($link, "utf8");

$err = array();

$data = json_decode(file_get_contents('php://input'), true);



$memberid = $data['memberid'];
$photourl = $data['photourl'];

			
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



	$sql_update = "delete from MemberPhotos where `MemberID`='$memberid' AND `PhotoURL`='$photourl'";

	$result = mysqli_query($link ,$sql_update) 
								or die (mysqli_error()); 		
			
	
	
	rename("upload/$photourl", "upload/deleted/$photourl");
    

	header('Content-Type: application/json');
	echo json_encode($passres);		

?>