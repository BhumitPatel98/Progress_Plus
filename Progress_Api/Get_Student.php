<?php

$response = array();
include_once("db.php");

if(isset($_POST["Class_ID"]))

{
	// response Array

		$response = array();
		$response["Student_List"]=array();

		$Class_id=$_POST['Class_ID'];
		$Batch_Name=$_POST['batch_name'];

	$query2="select * from student where class_id='".$Class_id."' and batch_name='".$Batch_Name."'";
	$res2=mysqli_query($con,$query2);
	while($row2=mysqli_fetch_array($res2))
	{
		$Student_ar=array();
		$Student_ar["Student_id"]=$row2["id"];
		$Student_ar["Enrollment_No"]=$row2["enrollment_no"];
		$Student_ar["Student_Name"]=$row2["first_name"]." ".$row2["last_name"];
		$Student_ar["Card_No"]="";
		$Student_ar["Attendance"]="Absent";
		
		array_push($response["Student_List"], $Student_ar);
	}
	echo json_encode($response);
}

?>