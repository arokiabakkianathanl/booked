<?php
define("COOKIE_TIME_OUT", 10); //specify cookie timeout in days (default is 10 days)
define('SALT_LENGTH', 9); // salt for password

// Password and salt generation
function PwdHash($pwd, $salt = null)
{
    if ($salt === null)     {
        $salt = substr(md5(uniqid(rand(), true)), 0, SALT_LENGTH);
    }
    else     {
        $salt = substr($salt, 0, SALT_LENGTH);
    }
    return $salt . sha1($pwd . $salt);
}


$link=mysqli_connect("localhost","root","Welcome@123","bookedapp");
mysqli_set_charset($link, "utf8");

$err = array();

$data = json_decode(file_get_contents('php://input'), true);


$user_email = $data['usr_email'];
$pass = $data['pwd'];



			
			// Pass
			$pass_ss = "SELECT result FROM result where id=1";


			$passresult = mysqli_query($link ,$pass_ss) 
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






if (strpos($user_email,'@') === false) {
    $user_cond = "tel='$user_email'";
} else {
      $user_cond = "user_email='$user_email'";
    
}

	
$result = mysqli_query($link,"SELECT id,pwd,full_name,user_email,address,tel,user_level,approved FROM `users` WHERE $user_cond AND `banned` = '0'") or die (mysqli_error()); 
$num = mysqli_num_rows($result);


    if ( $num > 0 ) 
	{ 
	
			list($m_id,$m_pwd,$m_full_name,$m_user_email,$m_address,$m_tel,$m_user_level,$m_approved) = mysqli_fetch_row($result);
			
			if(!$m_approved) 
			{
						header('Content-Type: application/json');				
						echo json_encode($failres);
			}
			 
			if ($m_pwd === PwdHash($pass,substr($m_pwd,0,9))) 
			{ 
			
				$userqry = "SELECT id,full_name,user_email,address,tel,user_level FROM `users` where id=" . $m_id;
				
				$userresult = mysqli_query($link ,$userqry) 
									or die (mysqli_error());

				$usernum = mysqli_num_rows($userresult);
						
				$userres[] = array();

				while (($userrow = mysqli_fetch_assoc($userresult)) != false) 
				{
					$userres[] = $userrow;
				} 

							

				header('Content-Type: application/json');				
				echo json_encode($userres);

			}
			else
			{
				header('Content-Type: application/json');				
				echo json_encode($failres);				
			}
	} 
	else 
	{
		header('Content-Type: application/json');				
		echo json_encode($failres);
	}		


?>