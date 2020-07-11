<?php

$response = array();

include_once("db.php");

if(isset($_POST["Institute_ID"]))

{

	

	// response Array

		$response = array();

		$response["Success"]=0;

		$response["Total_Recrod"]=0;	

		$response["Student_List"] = array();

		

		$Institute_ID=$_POST['Institute_ID'];

		$Staff_ID=$_POST['Staff_ID'];

		$Class_ID=$_POST['Class_ID'];

		$Subject_ID=$_POST['Subject_ID'];

		$Batch_Name=$_POST["Batch_Name"];

		//$Lecture=$_POST["Lecture"];

		$Attendance_taken=$_POST["Attendance_taken"];

		$Attendance_ID=$_POST["Attendance_ID"];



		$Date=date("Y-m-d");

		$Day=date("l",strtotime($Date));



		$Subject_Name="";

		$timing="";

		$no_of_student="";

		$Class_Name="";

		

		$query="SELECT * FROM student WHERE class_id='".$Class_ID."'";



		if($Batch_Name!="Full")

		{

			$query.=" and batch_name Like '%".$Batch_Name."%'";

		}





		

		$res=mysqli_query($con,$query) or mysqli_error($con);

		$count_no=mysqli_num_rows($res);

		$i=1;

		while($row=mysqli_fetch_array($res))

		{

			$Name=$row["first_name"]." ".$row["last_name"];

			$Student_ID=$row["id"];

			$Roll_No=$row["enrollment_no"];

			$Card_No="";









$attendance="Absent";

if($Attendance_taken=="Yes")

{

	$query5="select * from attendance_list where attendance_id='".$Attendance_ID."' and student_id='".$Student_ID."'";

	//echo $query5;

				$res5=mysqli_query($con,$query5);

				if($row5=mysqli_fetch_array($res5))

				{

					$attendance=$row5["attendance"];

				}

				else

				{

					$attendance="Absent";

				}

}			

		



				$timetable_ar=array();

		       

		        $timetable_ar["Student_ID"] = $Student_ID;

				$timetable_ar["Student_Name"] = $Name;

				$timetable_ar["Roll_No"] = $Roll_No;

				$timetable_ar["Card_No"] = $Card_No;

				$timetable_ar["Attendance"] = $attendance;

		

				$i++;

				// echoing JSON response

					array_push($response["Student_List"], $timetable_ar);

				

		}

$response["Success"] = 1;

$response["Total_Recrod"]=$count_no;

	echo json_encode($response);

}





?>

