<?php

$response = array();

include_once("db.php");

if(isset($_POST["Mobile"]))

{

	

	// response Array

		$response = array();

		

		

		$Mobile=$_POST['Mobile'];

		$Password=md5($_POST['Password']);

		$enc_password=substr($Password,0,30);

		

	

		

		

		$query="SELECT * FROM staff WHERE `email`='".$Mobile."' and `password`='".$enc_password."'";

		$res=mysqli_query($con,$query) or mysqli_error($con);

		if($row=mysqli_fetch_array($res))

		{

			


				$Institute_Name="";







		        $response["Success"] = 1;

		        $response["Staff_ID"] = $row["id"];

				$response["Institute_ID"] = 1;

				$response["Institute_Name"] = $Institute_Name;

				$response["First_Name"] = $row["first_name"];

				$response["Middle_Name"] = $row["middle_name"];

				$response["Last_Name"] = $row["last_name"];

				$response["Email"] = $row["email"];

				$response["Mobile"] = $row["mobile"];

				$response["Gender"] = $row["gender"];

				$response["Birthdate"] = $row["birthdate"];

				$response["Address"] = $row["address"];

				$response["City"] = $row["city"];

				$response["State"] = $row["state"];

				$response["Pincode"] = $row["zipcode"];

				$response["Designation"] = $row["designation"];

				$response["Joining_date"] = $row["joining_date"];

				$response["experience"] = $row["experience"];

				$response["Education"] = $row["education"];

				$response["Department"] = $row["department"];

				$response["Card_No"] = $row["card_no"];

				if($row["photo"]!='')

				{

					$response["Photo"] = mysqli_real_escape_string($con,$row["photo"]);

				}

				else

				{

					$response["Photo"] ="";

				}

			

				$response["Message"] = "Login Successfully";

				$query1="select * from login_log where type='Staff' and user_id='".$row["id"];."'";
				$res1=mysqli_query($con,$query1) or mysqli_error($con);
				$count_login=mysqli_num_rows($res1);


   if($count_login>=1)
   {
   	$response["Attempt"] = "More";
   }
   else
   {
   	  $response["Attempt"] = "First";
   }
				





				

				// echoing JSON response

				

		}

		else

		{

			    $response["Success"] = 0;

				$response["Message"] = "Invalid Login";

		}

	echo json_encode($response);

}



?>

