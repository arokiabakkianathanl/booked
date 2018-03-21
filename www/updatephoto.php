<?php


$link=mysqli_connect("localhost","root","Welcome@123","bookedapp");
mysqli_set_charset($link, "utf8");

$err = array();

$data = json_decode(file_get_contents('php://input'), true);



$memberid = $data['memberid'];
$primary = $data['primary'];	
$neworupd = $data['neworupd'];
$photourl = $data['photourl'];
$oldfilename = $data['oldfilename'];	
	
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




	if ($neworupd == "UPDATE")
	{

		$sql_update = "delete from MemberPhotos where `MemberID`='$memberid' AND `PhotoURL`='$oldfilename'";

		$result = mysqli_query($link ,$sql_update) 
								or die (mysqli_error()); 										

		//rename("upload/$oldfilename", "upload/deleted/$oldfilename");	
		unlink("upload/$oldfilename");	
	}
	else
	{

		$sql_insert = "INSERT INTO `MemberPhotos`(`MemberID`,`PhotoURL`,`IsPrimary`) VALUES ($memberid,'$photourl', '$primary')";

		$result = mysqli_query($link ,$sql_insert) 
									or die (mysqli_error()); 		
									
		$id = mysqli_insert_id($link);  

	}
	
	
	header('Content-Type: application/json');
	echo json_encode($passres);		
	
?>