<?php

$response = array();
include_once("db.php");
if(isset($_POST["ID"]))

{
	// response Array

		$response = array();
		$ID=$_POST['ID'];
		$Old_Password=$_POST['Old_Password'];
		$New_Password=$_POST['New_Password'];

		$enc_old=md5($Old_Password);
		$enc_new=md5($New_Password);

		$Enc_old_password=substr($enc_old, 0,30);
		$Enc_new_password=substr($enc_new, 0,30);

	

	$query2="select * from student where id='".$ID."' and parent_password='".$Enc_old_password."'";
	$res2=mysqli_query($con,$query2);
	if($row2=mysqli_fetch_array($res2))
	{
		$query1="update student set parent_password='".$Enc_new_password."' where id='".$ID."' and parent_password='".$Enc_old_password."'";
		$res1=mysqli_query($con,$query1);
		if($res1==1)
		{
				$response["Success"] = 1;
				$response["Message"] = "Change Successfully";
		}
		else
		{
			    $response["Success"] = 0;
				$response["Message"] = "Not Change";
		}
			}	
	else
	{
		$response["Success"] = 0;
		$response["Message"] = "Old password is wrong";
	}
	echo json_encode($response);
}

?>



