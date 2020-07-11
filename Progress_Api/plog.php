<?php
	include_once("db.php");

	if(isset($_POST["parent_email"]))
	{
		$parent_email=$_POST["parent_email"];
		$parent_password=$_POST["parent_password"];
		//$enc_new_password=substr(md5($parent_password),0,30);
		

		$query="select * from `student` where `parent_email`='".$parent_email."' and `parent_password`='".$parent_password."'";

		$res=mysqli_query($con,$query);
		$response=array();

		if($row=mysqli_fetch_array($res))
		{

					$response["success"]=1;
					$response["Reg_ID"]=$row["id"];
					$response["User_Name"]=$row["parent_first_name"]." ".$row["parent_last_name"];
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