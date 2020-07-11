<?php
include_once("db.php");


if(isset($_POST["Exam_Student_List"])) \
{
	$response = array();
	$Student_Id=$_POST["STudent_Id"];

	$query="SELECT * FROM total_mark WHERE student_id='".$Student_Id."'";
	$res=mysqli_query($con,$query) or mysqli_error($con);
	if($row=mysqli_fetch_array($res))
	{
		$query1="SELE"
	}
}
?>