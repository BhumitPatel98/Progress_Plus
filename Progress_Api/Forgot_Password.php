<?php

$response = array();
include_once("db.php");
date_default_timezone_set('Asia/Calcutta');

function OTP( $length )
{
	  $chars = "0123456789";	
      $str="";
	   $size = strlen( $chars );
	   for( $i = 0; $i < $length; $i++ ) 
	   {
		 $str .= $chars[ rand( 0, $size - 1 ) ];
	   }
	return $str;
}
if(isset($_POST["Email"]))
{
	// response Array
		$response = array();
		$Type=$_POST['Type'];
	
		$Email=$_POST['Email'];
		$otp=OTP(6);
		$date=date("Y-m-d H:i:a");
		$count=0;

		if($Type=="Staff")
		{
			
			$query2="select * from staff where email='".$Email."'";
			$res2=mysqli_query($con,$query2);
			if($row2=mysqli_fetch_array($res2))
			{
				$name=$row2['first_name']." ".$row2['last_name'].",";
				$Staff_id=$row2['id'];
				$query3="select * from otp where id='".$Staff_id."' and type='".$Type."'";
				$res3=mysqli_query($con,$query3);
				$count_otp=mysqli_num_rows($res3);
				if($count_otp<=3)
				{
					$message="Your Otp to reset password is ".$otp;
					$query1="insert into otp value(NULL,'".$Type."','".$Staff_id."','".$otp."','".$date."')";
					$res1=mysqli_query($con,$query1);
					if($res1==1)
					{
							//include_once("Otp_email.php");
							$response["Success"] = 1;
							$response["User_ID"]= $Staff_id;
							$response["Type"]="Success";
							$response["Message"] = "OTP Sent Successfully";
					}
				
				}
				else
				{
					    $response["Success"] = 0;
					    $response["Type"]= "Exeed_limt";
						$response["Message"] = "Your Number of Attmp Exeed Limt.Your Account Has Been Loaked.";
				}	
			}
			else
				{
					    $response["Success"] = 0;
					    $response["Type"]="Not_Exist";
						$response["Message"] = "Email Not Exist";
				}	
			// echo json_encode($response);
		
		}
	if($Type=="Student")
		{
			$Student_ID=$_POST['Student_ID'];
			$query2="select * from student where email='".$Email."'";
			$res2=mysqli_query($con,$query2);
			if($row2=mysqli_fetch_array($res2))
			{
				$name=$row2['first_name']." ".$row2['last_name'].",";
				$Student_ID=$row2['id'];
				$query3="select * from otp where id='".$Student_ID."' and type='".$Type."'";
				$res3=mysqli_query($con,$query3);
				$count_otp=mysqli_num_rows($res3);
				if($count_otp<=3)
				{
					$message="Your Otp to reset password is ".$otp;
					$query1="insert into otp value(NULL,'".$Type."','".$Student_ID."','".$otp."','".$date."')";
					$res1=mysqli_query($con,$query1);
					if($res1==1)
					{
							//include_once("Otp_email.php");
							$response["Success"] = 1;
							$response["User_ID"]= $Student_ID;
							$response["Type"]="Success";
							$response["Message"] = "OTP Sent Successfully";
					}
				
				}
				else
				{
					    $response["Success"] = 0;
					    $response["Type"]= "Exeed_limt";
						$response["Message"] = "Your Number of Attmp Exeed Limt.Your Account Has Been Loaked.";
				}	
			}
			else
				{
					    $response["Success"] = 0;
					    $response["Type"]="Not_Exist";
						$response["Message"] = "Email Not Exist";
				}	
		
		}
	if($Type=="Parent")
		{
			
			$query2="select * from student where parent_email='".$Email."'";
			$res2=mysqli_query($con,$query2);
			if($row2=mysqli_fetch_array($res2))
			{
				$name=$row2['parent_first_name']." ".$row2['parent_last_name'].",";
				$Student_ID=$row2['id'];
				$query3="select * from otp where id='".$Student_ID."' and type='".$Type."'";
				$res3=mysqli_query($con,$query3);
				$count_otp=mysqli_num_rows($res3);
				if($count_otp<=3)
				{
					$message="Your Otp to reset password is ".$otp;
					$query1="insert into otp value(NULL,'".$Type."','".$Student_ID."','".$otp."','".$date."')";
					$res1=mysqli_query($con,$query1);
					if($res1==1)
					{
							//include_once("Otp_email.php");
							$response["Success"] = 1;
							$response["User_ID"]= $Student_ID;
							$response["Type"]="Success";
							$response["Message"] = "OTP Sent Successfully";
					}
				
				}
				else
				{
					    $response["Success"] = 0;
					    $response["Type"]= "Exeed_limt";
						$response["Message"] = "Your Number of Attmp Exeed Limt.Your Account Has Been Loaked.";
				}	
			}
			else
				{
					    $response["Success"] = 0;
					    $response["Type"]="Not_Exist";
						$response["Message"] = "Email Not Exist";
				}	
		
		}
		
	echo json_encode($response);
}
?>