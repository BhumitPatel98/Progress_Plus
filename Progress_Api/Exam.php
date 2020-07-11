<?php

$response = array();
include_once("db.php");

if(isset($_POST["Staff_ID"]))

{
	// response Array

		$response = array();
		$response["Exam_Sub"]=array();


		$Staff_ID=$_POST['Staff_ID'];


	$query="SELECT s.* ,e.exam_name,a.staff_id,a.class_id,a.subject_id From exam_sub s,exam e,assign_subject a WHERE s.assign_id=a.id and e.id=s.exam_id and a.staff_id='".$Staff_ID."' and s.status='Pending'";
	$res=mysqli_query($con,$query);
	$i=1;
	while($row=mysqli_fetch_array($res))
	{
		$Class_Name="";
		$Subject_Name="";
		
		
		$query1="SELECT * FROM `class` WHERE id='".$row["class_id"]."'";
		$res1=mysqli_query($con,$query1) or mysqli_error($con);
		if($row1=mysqli_fetch_array($res1))
		{
			$Class_Name=$row1["class_name"];
		}

		$query2="SELECT * FROM `subject` WHERE id='".$row["subject_id"]."'";
		$res2=mysqli_query($con,$query2) or mysqli_error($con);
		if($row2=mysqli_fetch_array($res2))
		{
			$Subject_Name=$row2["sub_name"];
			$Batch=$row2["attendance_type"];
		}
		 if($Batch=="Full")
		 {
		 	$Batch_Name="";
		 }
		 else
		 {
		 	$query3="SELECT * FROM assign_subject where id='".$row["id"]."'";
		 	$res3=mysqli_query($con,$query3) or mysqli_error($con);
			if($row3=mysqli_fetch_array($res3))
			{
				$Batch_Name=$row3["batch_name"];
			}
		 }

		$Exam_ar=array();
		 
	
		$Exam_ar["Exam_sub_id"]=$row["id"];
		$Exam_ar["Exam_name"]=$row["exam_name"];
		$Exam_ar["Class_ID"]=$row["class_id"];
		$Exam_ar["Class_Name"]=$Class_Name;
		$Exam_ar["Subject_Name"]=$Subject_Name;
		$Exam_ar["Batch_Name"]=$Batch_Name;
		$Exam_ar["Total_Mark"]=$row["total_mark"];
		$Exam_ar["Passing_Mark"]=$row["passing_mark"];

		$i++;

		array_push($response["Exam_Sub"], $Exam_ar);
	}
	echo json_encode($response);
}

?>