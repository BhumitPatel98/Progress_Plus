<?php
	include_once("db.php");

	if(isset($_POST["enrollment_no"]))
	{
		$enrollment_no=$_POST["enrollment_no"];
		$password=$_POST["password"];
		//$enc_new_password=substr(md5($password),0,30);
		

		$query="select * from `student` where `enrollment_no`='".$enrollment_no."' and `password`='".$password."'";

		$res=mysqli_query($con,$query);
		$response=array();

		if($row=mysqli_fetch_array($res))
		{

					$response["success"]=1;
					$response["Reg_ID"]=$row["id"];
					$response["User_Name"]=$row["first_name"]." ".$row["last_name"];
					$response["Message"]="Login Successfully";
		}
		else
		{
					$response["success"]=0;
					$response["Message"]="Invalid";	
		}
		echo json_encode($response);
	}
?>