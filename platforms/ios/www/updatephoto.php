<?php


$link=mysqli_connect("localhost","root","Welcome@123","bookedapp");
mysqli_set_charset($link, "utf8");

$err = array();

$data = json_decode(file_get_contents('php://input'), true);



$memberid = $data['memberid'];
$photoseq = $data['photoseq'];
$isbw = $data['isbw'];
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



	$total=0;


			$userresult = mysqli_query($link, "SELECT `id`, `MemberID`, `PhotoSeq`, `IsBW`, `PhotoURL`, `IsPrimary`, `DateUpdated` FROM `MemberPhotos` WHERE `MemberID`='$memberid' AND `PhotoSeq`=$photoseq AND `IsBW`='$isbw'") or die(mysql_error());


			$total = mysqli_num_rows($userresult);
					
			$userres[] = array();

			while (($userrow = mysqli_fetch_assoc($userresult)) != false) 
			{
				$userres[] = $userrow;
			}

if ($total > 0)
{
	$sql_update = "update MemberPhotos set PhotoURL	 = '$photourl' WHERE `MemberID`='$memberid' AND `PhotoSeq`=$photoseq AND `IsBW`='$isbw'";

	$result = mysqli_query($link ,$sql_update) 
								or die (mysqli_error()); 		
								
	$id = mysqli_insert_id($link);  

	header('Content-Type: application/json');
	echo json_encode($passres);		
}
else
{
	$sql_insert = "INSERT INTO `MemberPhotos`(`MemberID`, `PhotoSeq`, `IsBW`, `PhotoURL`) VALUES ($memberid ,'$photoseq','$isbw','$photourl')";

	$result = mysqli_query($link ,$sql_insert) 
								or die (mysqli_error()); 		
								
	$id = mysqli_insert_id($link);  

	header('Content-Type: application/json');
	echo json_encode($passres);		
}
?>