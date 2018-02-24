<?php
// Directory where uploaded images are saved
$dirname = $_POST['uploadpath']; 

if ($_FILES) {
    if(move_uploaded_file($_FILES["file"]["tmp_name"],'../'.$dirname."/".$_POST["imgName"]))
		echo 'Image Uploaded Successfully';
	else
		echo 'Image Not Uploaded';
}
?>