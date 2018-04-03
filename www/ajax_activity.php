<?php

$link=mysqli_connect("localhost","root","Welcome@123","bookedapp");
mysqli_set_charset($link, "utf8");

$keyword = '%'.$_POST['keyword'].'%';

$sql = "SELECT ID, EventName, SearchTags FROM lookup_EventNames WHERE SearchTags LIKE '$keyword' ORDER BY EventName ASC LIMIT 0, 10";


//$sql = "SELECT ID, EventName, SearchTags FROM lookup_EventNames";


$result = mysqli_query($link ,$sql) or die (mysqli_error()); 

$num = mysqli_num_rows($result);
					
$res[] = array();

for ($x = 0; $x < $num; $x++) 
{
	list($ID, $EventName, $SearchTags) = mysqli_fetch_row($result);
			


	echo '<li onclick="set_coordinates(\''.str_replace("'", "\'", $ID).'\',\''.str_replace("'", "\'", $EventName).'\',\''.str_replace("'", "\'", $SearchTags).'\')"><a href="#">'.$EventName.'</a></li>';
	
}


?>