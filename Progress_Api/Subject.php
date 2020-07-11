<?php

$response = array();
include_once("db.php");

if(isset($_POST["Class_ID"]))

{
	// response Array

		$response = array();
		$response["Subject"]=array();

		$Class_id=$_POST['Class_ID'];

	$query2="select * from subject where class_id='".$Class_id."'";
	$res2=mysqli_query($con,$query2);
	while($row2=mysqli_fetch_array($res2))
	{
		$subject_ar=array();
		$subject_ar["Subject_Name"]=$row2["sub_name"];
		$subject_ar["Attendance_Type"]=$row2["attendance_type"];
		$batch=$row2["attendance_type"];
		$batch_name="";
		if($batch=="Batch_wise")
		{
			
				$query1="select * from batch where class_id='".$Class_id."' order by id ";
				$res1=mysqli_query($con,$query1);
				while($row1=mysqli_fetch_array($res1))
				{
					$batch_name.=$row1["batch_name"].";";
				// $response["Success"] = 1;
				// $response["sub_name"]=$row2["sub_name"];
				// $response["Message"] = "Change Successfully";
			}
		}
		$subject_ar["Batch_Name"]=$batch_name;
		array_push($response["Subject"], $subject_ar);
	}
	echo json_encode($response);
}

?>



