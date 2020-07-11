<?php

$response = array();

include_once("db.php");



if(isset($_POST["Staff_ID"]))

{

	// response Array

		$response = array();



		$Staff_ID=$_POST['Staff_ID'];

		$Photo="";

		

			$First_Name=$_POST['First_Name'];

			$Middle_Name=$_POST['Middle_Name'];

			$Last_Name=$_POST['Last_Name'];

			$Email=$_POST['Email'];

			$Mobile=$_POST['Mobile'];

			$Gender=$_POST['Gender'];

			$Address=$_POST['Address'];

			$Birthdate=$_POST['Birthdate'];

			$City=$_POST['City'];

			$State=$_POST['State'];

			$Pincode=$_POST['Pincode'];

			$Designation=$_POST['Designation'];

			$Joining_Date=$_POST['Joining_Date'];

			$Experience=$_POST['Experience'];

			$Education=$_POST['Education'];



			

		$query1="update staff set first_name='".$First_Name."',middle_name='".$Middle_Name."',last_name='".$Last_Name."',gender='".$Gender."',birthdate='".$Birthdate."',address='".$Address."',city='".$City."',state='".$State."',zipcode='".$Pincode."', designation='".$Designation."',joining_date='".$Joining_Date."',experience='".$Experience."',education='".$Education."'";



			if(isset($_POST["Photo"]))

			{

				$URL=$_POST["Photo"];

				$query1.=",photo='".mysqli_real_escape_string($con,$URL)."'";

			}



			$query1.=" where id='".$Staff_ID."'";

		



		$res1=mysqli_query($con,$query1);

		if($res1==1)

		{

				$query="select * from staff where id='".$Staff_ID."'";

				$res=mysqli_query($con,$query);

				$row=mysqli_fetch_array($res);



				




				$response["Success"] = 1;

				$response["Staff_ID"] = $row["id"];

				$response["Institute_ID"] = 1;

				$response["Institute_Name"] = "";

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

				$response["Message"] = "Success";

		

		}

		else

		{

			    $response["Success"] = 0;

				$response["Message"] = "Fail";

		}

	echo json_encode($response);

}





?>



