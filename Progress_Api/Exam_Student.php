<?php

$response = array();

include_once("db.php");

if(isset($_POST["Class_ID"]))

{

	

	// response Array

		$response = array();

		$response["Success"]=0;
        $response["Institute_ID"]=1;	
		$response["Total_Recrod"]=0;	
		$response["Mark_Fill"]="";

		$response["Student_List"] = array();

		



		$Class_ID=$_POST['Class_ID'];

		$Batch_Name=$_POST["Batch_Name"];
		$Exam_sub_id=$_POST["Exam_sub_id"];

		//$Lecture=$_POST["Lecture"];
$query3="SELECT e.*,a.`class_id`,a.`staff_id`,a.`subject_id`,a.`batch_name` FROM `exam_sub` e,`assign_subject` a where e.`assign_id`=a.`id` and a.`class_id`='".$Class_ID."'";
$res3=mysqli_query($con,$query3);
		

		$query="SELECT * FROM student WHERE class_id='".$Class_ID."'";



		if($Batch_Name!="Full")

		{

			$query.=" and batch_name Like '%".$Batch_Name."%'";

		}


		$res=mysqli_query($con,$query) or mysqli_error($con);

		$count_no=mysqli_num_rows($res);

		$i=1;

		$query1="select * from total_mark where exam_sub_id='".$Exam_sub_id."'";


				$res1=mysqli_query($con,$query1);

				if($row1=mysqli_fetch_array($res1))

				{

					$Exam_mark="Yes";

				}

				else

				{

					$Exam_mark="No";

				}
		while($row=mysqli_fetch_array($res))

		{

			$Name=$row["first_name"]." ".$row["last_name"];

			$Student_ID=$row["id"];

			$Roll_No=$row["enrollment_no"];

			$Card_No="";


			$marks="";

          if($Exam_mark=="Yes")
          {
          	$query2="select * from total_mark where exam_sub_id='".$Exam_sub_id."'";

				$res2=mysqli_query($con,$query2);

				if($row2=mysqli_fetch_array($res2))

				{

					$marks=$row2["mark"];

				}

				
          }
        

		



				$timetable_ar=array();

		       

		        $timetable_ar["Student_ID"] = $Student_ID;

				$timetable_ar["Student_Name"] = $Name;

				$timetable_ar["Roll_No"] = $Roll_No;

				$timetable_ar["Card_No"] = $Card_No;

				$timetable_ar["Mark"] = $marks;

		

				$i++;

				// echoing JSON response

					array_push($response["Student_List"], $timetable_ar);

				

		}

$response["Success"] = 1;
$response["Total_Recrod"]=$count_no;
$response["Mark_Fill"]=$Exam_mark;

	echo json_encode($response);

}





?>

