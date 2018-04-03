<?php


$link=mysqli_connect("localhost","root","Welcome@123","bookedapp");
mysqli_set_charset($link, "utf8");

$err = array();

$data = json_decode(file_get_contents('php://input'), true);


$memberid = $data['memberid'];
$eventname = $data['eventname'];
$placename = $data['placename'];
$placeaddress = $data['placeaddress'];
$eventtime = $data['eventtime'];
$whopays = $data['whopays'];
$chatavailability = $data['chatavailability'];
$visibility = $data['visibility'];
$decisiontype = $data['decisiontype'];
$timedecision = $data['timedecision'];
$specialinstructions = $data['specialinstructions'];
$locationwhencreated = $data['locationwhencreated'];
			
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



	$sql_insert = "INSERT INTO Event(MemberID, EventName, PlaceName, PlaceAddress, EventTime, WhoPays, ChatAvailability, Visibility, DecisionType, TimeDecision, SpecialInstructions, LocationWhenCreated) VALUES ($memberid, $eventname, '$placename', '$placeaddress', '$eventtime', '$whopays', $chatavailability, '$visibility', '$decisiontype', '$timedecision', '$specialinstructions', '$locationwhencreated')";

	$result = mysqli_query($link ,$sql_insert) 
								or die (mysqli_error()); 		
								
	$id = mysqli_insert_id($link);  

	header('Content-Type: application/json');
	echo json_encode($passres);		

?>