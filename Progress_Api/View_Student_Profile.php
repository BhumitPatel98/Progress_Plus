<?php

$response = array();

include_once("db.php");

if(isset($_POST["Student_ID"]))

{

	

	// response Array

		$response = array();

		

		

		$Institute_ID=$_POST['Institute_ID'];

		$Student_ID=$_POST['Student_ID'];

		

	

		

		

		$query="SELECT * FROM `student` WHERE id='".$Student_ID."'";

		$res=mysqli_query($con,$query) or mysqli_error($con);

		if($row=mysqli_fetch_array($res))

		{



				$query1="SELECT * FROM class WHERE `id`='".$row["class_id"]."'";

				$res1=mysqli_query($con,$query1) or mysqli_error($con);

				$row1=mysqli_fetch_array($res1);

				$Class_Name=$row1["class_name"];



				$Institute_name="";



		        $response["Success"] = 1;

				$response["Student_ID"] = $row["id"];

				$response["Institute_ID"] = 1;

				$response["Institute_Name"] = $Institute_name;

				$response["Class_ID"] = $row["class_id"];

				$response["Class_Name"] = $Class_Name;

				$response["First_Name"] = $row["first_name"];

				$response["Middle_Name"] = $row["middle_name"];

				$response["Last_Name"] = $row["last_name"];

				$response["Student_Email"] = $row["email"];

				$response["Student_Mobile"] = $row["mobile"];

				$response["Gender"] = $row["gender"];

				$response["Birthdate"] = $row["birthdate"];

				$response["Address"] = $row["address"];

				$response["City"] = $row["city"];

				$response["State"] = $row["state"];

				$response["Pincode"] = $row["zipcode"];

				$response["Roll_No"] = $row["enrollment_no"];

				$response["Academic_Year"] = $row["academic_year"];

				$response["Admission_Date"] = $row["admission_date"];

				$response["Parent_First_Name"] = $row["parent_first_name"];

				$response["Parent_last_Name"] = $row["parent_last_name"];

				$response["Parent_Email"] = $row["parent_email"];

				$response["Parent_Mobile"] = $row["parent_mobile"];

				$response["Card_No"] ="";

			
					$response["Photo"] ="";

				

				$response["Message"] = "Success";

				

				

				

				

				// echoing JSON response

				

		}

		else

		{

			    $response["Success"] = 0;

				$response["Message"] = "Fail";

		}

	echo json_encode($response);

}





?>

