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
		$class_id=$row["class_id"];
		$batch_name=$row["batch_name"];
		$response["Exam_Details"]=array();

		$query1="SELECT e.*,a.`class_id`,a.`staff_id`,a.`subject_id`,a.`batch_name`,m.`exam_name` FROM `exam_sub` e,`assign_subject` a,`exam` m  where e.`assign_id`=a.`id` and e.`exam_id`=m.`id` and a.`class_id`='".$class_id."' group by `exam_id`";
		$res1=mysqli_query($con,$query1);

		while($row1=mysqli_fetch_array($res1))
		{



			$Exam_ar=array();
			$Exam_name=$row1["exam_name"];
			$Exam_ar["Exam_Name"]=$row1["exam_name"];
			$Exam_ar["Total_Subject"]=0;
			$Exam_ar["Exam_Total"]=0;
			$Exam_ar["Subject_List"]=array();

			$total=0;
			$i=0;

			$query2="SELECT e.*,a.`class_id`,a.`staff_id`,a.`subject_id`,a.`batch_name` FROM `exam_sub` e,`assign_subject` a where e.`assign_id`=a.`id` and a.`class_id`='".$class_id."' and e.`exam_id`='".$row1["exam_id"]."'";
			$res2=mysqli_query($con,$query2);

			while($row2=mysqli_fetch_array($res2))
			{
				$Subject_ar=array();
				$subject_id=$row2["subject_id"];
			    $batch_name=$row2["batch_name"];

				$query3="select * from subject where id='".$subject_id."'";
				$res3=mysqli_query($con,$query3);
				$row3=mysqli_fetch_array($res3);
				
				$subject_name=$row3["sub_name"];
				$attendance_type=$row3["attendance_type"];


					$query4="SELECT * FROM `total_mark` WHERE `exam_sub_id`='".$row2["id"]."' and `student_id`='".$Student_Id."'";
					$mark=0;
					$res4=mysqli_query($con,$query4);
					if($row4=mysqli_fetch_array($res4)) {
							$mark=$row4["mark"];
							$total+=$mark;
					}
					$Subject_ar["Subject_Name"]=$subject_name;
					$Subject_ar["Marks"]=$mark;
					array_push($Exam_ar["Subject_List"], $Subject_ar);
					$i++;
				
			}
	
		$Exam_ar["Total_Subject"]=$i;
		$Exam_ar["Exam_Total"]=$total;
		array_push($response["Exam_Details"], $Exam_ar);
	
		}
 echo json_encode($response);

	}
	
}
?>