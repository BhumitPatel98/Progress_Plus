<?php

$response = array();

include_once("db.php");

date_default_timezone_set("Asia/Calcutta");



if(isset($_POST["Institute_ID"]))

{

	

	// response Array

		$response = array();

		$response["Success"]=0;

		$response["Total_Recrod"]=0;

		$response["Today_Schedule"] = array();

		

		$Institute_ID=$_POST['Institute_ID'];

		$Staff_ID=$_POST['Staff_ID'];

		$Date=date("Y-m-d");

		$Day=date("l",strtotime($Date));



		$Subject_Name="";

		$timing="";

		$no_of_student="";

		$Class_Name="";



		

		$query="SELECT t.*,a.`staff_id` as staff,a.`class_id`,a.`subject_id`,a.`batch_name` FROM `time_table` t, `assign_subject` a WHERE t.`assign_id`=a.`id` and a.`staff_id`='".$Staff_ID."' and t.`day`='".$Day."' order by time";
		$res=mysqli_query($con,$query) or mysqli_error($con);

		$count_no=mysqli_num_rows($res);

		$i=1;

		while($row=mysqli_fetch_array($res))

		{

				$total_present="";

				 $class_id=$row["class_id"];

				$subject_id=$row["subject_id"];

				$Lecture=$row["time"];

				$Sms="";

				$Attendance_ID="";

				$Batch_Name=$row['batch_name'];





				$query1="SELECT * FROM `subject` WHERE id='".$row["subject_id"]."'";

				$res1=mysqli_query($con,$query1) or mysqli_error($con);

				if($row1=mysqli_fetch_array($res1))

				{

					$Subject_Name=$row1["sub_name"];

					if($Batch_Name!="Full")
					{
						$Subject_Name=$row1["sub_name"]." (".$Batch_Name.")";
					}

				}



				$query2="SELECT * FROM `time` WHERE no='".$row["time"]."'";

				$res2=mysqli_query($con,$query2) or mysqli_error($con);

				if($row2=mysqli_fetch_array($res2))

				{

					$timing=$row2["timing"];

				}



				$query3="SELECT * FROM `class` WHERE id='".$row["class_id"]."'";

				$res3=mysqli_query($con,$query3) or mysqli_error($con);

				if($row3=mysqli_fetch_array($res3))

				{

					$Class_Name=$row3["class_name"];

				}



				$query4="SELECT * FROM `student` WHERE class_id='".$row["class_id"]."'";


		if($Batch_Name!="Full")

		{

			$query4.=" and batch_name Like '%".$Batch_Name."%'";

		}



				$res4=mysqli_query($con,$query4) or mysqli_error($con);

				$no_of_student=mysqli_num_rows($res4);



				$Attendance_Taken="No";

				$query5="select * from attendance where class_id='".$class_id."' and subject_id='".$subject_id."' and `time`='".$Lecture."' and staff_id='".$Staff_ID."' and `datetime` Like '".$Date."%'";

				

			

			

				$res5=mysqli_query($con,$query5);

				if($row5=mysqli_fetch_array($res5))

				{

					$Attendance_Taken="Yes";

					$Attendance_ID=$row5["id"];

					//$Sms=$row5["sms"];

					$query6="SELECT * FROM `attendance_list` WHERE `attendance_id`='".$Attendance_ID."' and `attendance`='Present'";



					$res6=mysqli_query($con,$query6);

					$total_present=mysqli_num_rows($res6);

					

				}

		



				$timetable_ar=array();

		       

		        $timetable_ar["Class_ID"] = $class_id;

				$timetable_ar["Class_Name"] = $Class_Name;

				$timetable_ar["Subject_ID"] = $subject_id;

				$timetable_ar["Subject_Name"] = $Subject_Name;

				$timetable_ar["Batch_Name"] = $row['batch_name'];

				$timetable_ar["Timing"] = $timing;

				$timetable_ar["Lecture"] = $Lecture;

				$timetable_ar["Attendance_Taken"] = $Attendance_Taken;

				$timetable_ar["Attendance_ID"] = $Attendance_ID;

				$timetable_ar["Present"] = $total_present;

				$timetable_ar["Sms"] = $Sms;

				$timetable_ar["Day"] = $Day;

				$timetable_ar["No_Of_Student"] = $no_of_student;

				$i++;

				// echoing JSON response

					array_push($response["Today_Schedule"], $timetable_ar);

				

		}

$response["Success"] = 1;

$response["Total_Recrod"]=$count_no;

	echo json_encode($response);

}





?>

