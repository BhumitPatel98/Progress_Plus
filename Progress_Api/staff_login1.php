<?php
	include_once("db.php");

	if(isset($_POST["Mobile"]))
	{
		$email=$_POST["Mobile"];
		$password=$_POST["Password"];
		$enc_new_password=substr(md5($password),0,30);
		

		$query="select * from `staff` where `email`='".$email."' and `password`='".$enc_new_password."'";

		$res=mysqli_query($con,$query);
		$response=array();

		if($row=mysqli_fetch_array($res))
		{

					$response["success"]=1;
					$response["Reg_ID"]=$row["id"];
					$response["User_Name"]=$row["first_name"]." ".$row["middle_name"]." ".$row["last_name"];
					$response["email"]=$row["email"];
					$response["mobile"]=$row["mobile"];
					$response["card_no"]=$row["card_no"];
					$response["gender"]=$row["gender"];
					$response["birthdate"]=$row["birthdate"];
					$response["designation"]=$row["designation"];
					$response["joining_date"]=$row["joining_date"];
					$response["experience"]=$row["experience"];
					$response["education"]=$row["education"];
					$response["address"]=$row["address"];
					$response["city"]=$row["city"];
					$response["state"]=$row["state"];
					$response["zipcode"]=$row["zipcode"];
					$response["department"]=$row["department"];
					$response["photo"]="";
					$response["date"]=$row["date"];
					$response["status"]=$row["status"];
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