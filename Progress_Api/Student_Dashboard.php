<?php
include_once("db.php");

if(isset($_POST["Student_ID"])) 
{
	$response = array();
	$Student_Id=$_POST["Student_ID"];

	$query="select * from student where id='".$Student_Id."'";
	$res=mysqli_query($con,$query);

    
	if($row=mysqli_fetch_array($res))
	{

		$query2="SELECT * FROM `attendance_list` WHERE `student_id`='".$Student_Id."'";
		$res2=mysqli_query($con,$query2);
		$row2=mysqli_fetch_array($res2);
		$total_lacture=mysqli_num_rows($res2);

        $query4="SELECT * FROM `attendance_list` WHERE `student_id`='".$Student_Id."'";
		$res4=mysqli_query($con,$query4);
		$row4=mysqli_fetch_array($res4);
		$total_attend=mysqli_num_rows($res4);

$attendance_message="";
        $average = ($total_attend*100)/$total_lacture;

        if($average>=75)
        {
        	$attendance_message="Eligibal for exam.";
        }
        else if($average>=50 and $average<=74)
        {
        	$attendance_message="Good";
        }	
        else
        {
        	$attendance_message="Must Attend all lecture.";
        }

		$class_id=$row["class_id"];
		$batch_name=$row["batch_name"];
		$response["Total_Lacture"]=$total_lacture;
		$response["Attend"]=$total_attend;
		$response["Attendance_Percentage"]=$average;
		$response["Attendance_Message"]=$attendance_message;


		$response["Exam_Details"]=array();

		$query1="SELECT t.*,s.exam_id,sum(s.`total_mark`) as Total_Marks,sum(t.`mark`) as Marks,count(*) as total_subject,s.`added` FROM `total_mark` t,exam_sub s WHERE t.`exam_sub_id`=s.id and t.`student_id`='".$Student_Id."'  and s.`added`='Yes' group by s.`exam_id`";
		$res1=mysqli_query($con,$query1);

		while($row1=mysqli_fetch_array($res1))
		{

		

			$Exam_ar=array();
			$exam_id=$row1["exam_id"];
			$Total_Marks=$row1["Total_Marks"];
			$Marks=$row1["Marks"];
			$total_subject=$row1["total_subject"];

			$query3="select * from exam where id='".$exam_id."'";
			$res3=mysqli_query($con,$query3);
			$row3=mysqli_fetch_array($res3);
			$exam_name=$row3["exam_name"];

			$percentage = ($Marks*100)/$Total_Marks;

			$Exam_ar["Exam_Name"]=$exam_name;
			$Exam_ar["Total_Subject"]=$total_subject;
			$Exam_ar["Total_Marks"]=$Total_Marks;
			$Exam_ar["Marks"]=$Marks;
			$Exam_ar["Percentage"]=$percentage;
			
		array_push($response["Exam_Details"], $Exam_ar);
	
		}
		$response["Exam_Message"]="";
 echo json_encode($response);

	}
	
}
?>