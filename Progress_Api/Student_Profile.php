<?php

$response = array();

include_once("db.php");



if(isset($_POST["Student_ID"]))

{

	// response Array

		$response = array();



		$Student_ID=$_POST['Student_ID'];

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

			$Parent_FirstName=$_POST['Parent_FirstName'];

			$Parent_LastName=$_POST['Parent_LastName'];

			$Parent_Email=$_POST['Parent_Email'];

			$Parent_Mobile=$_POST['Parent_Mobile'];





		



			

			$query1="update student set first_name='".$First_Name."',middle_name='".$Middle_Name."',last_name='".$Last_Name."',gender='".$Gender."',birthdate='".$Birthdate."',address='".$Address."',city='".$City."',state='".$State."',zipcode='".$Pincode."', parent_first_name='".$Parent_FirstName."',parent_last_name='".$Parent_LastName."',email='".$Email."',mobile='".$Mobile."'";



			// if(isset($_FILES["Photo"]["name"]))

			// {

			// 	$path="Student_Profile/";

			// 	$Photo=$_FILES["Photo"]["name"];

			// 	$Tmp_Photo=$_FILES["Photo"]["tmp_name"];

			// 	$photo_name=time()."_".$Photo;

			// 	move_uploaded_file($Tmp_Photo,$path.$photo_name);

			// 	$URL="http://www.opustech.in/SchoolStaff/Student_Profile/".$photo_name;



			// 	$query1.=",photo='".mysqli_real_escape_string($con,$URL)."'";

			// }



			// if(isset($_POST["Photo"]))

			// {

			// 	$URL=$_POST["Photo"];

			// 	$query1.=",photo='".mysqli_real_escape_string($con,$URL)."'";

			// }



			$query1.=" where id='".$Student_ID."'";

		



			

		$res1=mysqli_query($con,$query1);

		if($res1==1)

		{

				$query="select * from student where id='".$Student_ID."'";

				$res=mysqli_query($con,$query);

				$row=mysqli_fetch_array($res);



				$query1="SELECT * FROM class WHERE `id`='".$row["class_id"]."'";

				$res1=mysqli_query($con,$query1) or mysqli_error($con);

				$row1=mysqli_fetch_array($res1);

				$Class_Name=$row1["class_name"];




				$Institute_Name="";





				$response["Success"] = 1;

				$response["Student_ID"] = $row["id"];

				$response["Institute_ID"] = 1;

				$response["Institute_Name"] = $Institute_Name;

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

				$response["Card_No"] = "";

				

				$response["Photo"] ="";

				

				$response["Message"] = "Updated Successfully";

		

		}

		else

		{

			    $response["Success"] = 0;

				$response["Message"] = "Fail";

		}

	echo json_encode($response);

}





?>



