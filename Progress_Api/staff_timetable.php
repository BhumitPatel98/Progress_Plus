<?php

$response = array();

include_once("db.php");

if(isset($_POST["Institute_ID"]))

{

	

	// response Array

		$response = array();

		$response["Success"]=0;

		//$response["Total_Recrod"]=0;

		

		

		$Institute_ID=$_POST['Institute_ID'];

		$Staff_ID=$_POST['Staff_ID'];

		$Date=date("Y-m-d");

		$Day=date("l",strtotime($Date));



$Days_ar=array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");



		$Subject_Name="";

		$timing="";

		$no_of_student="";

		$Class_Name="";





		$j=0;

		while($j<count($Days_ar))

		{



		$response[$Days_ar[$j]] = array();



		$query="SELECT t.*,a.`staff_id` as staff,a.`subject_id`,a.`batch_name`,a.`class_id` FROM `time_table` t, `assign_subject` a WHERE t.`assign_id`=a.`id` and a.`staff_id`='".$Staff_ID."' and t.`day`='".$Days_ar[$j]."' order by time";

		$res=mysqli_query($con,$query) or mysqli_error($con);
		$count_no=mysqli_num_rows($res);

		$i=1;

		while($row=mysqli_fetch_array($res))

		{

				$class_id=$row["class_id"];

				$subject_id=$row["subject_id"];
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

				$res4=mysqli_query($con,$query4) or mysqli_error($con);

				$no_of_student=mysqli_num_rows($res4);

		



				$timetable_ar=array();

		       

		        $timetable_ar["Class_ID"] = $class_id;

				$timetable_ar["Class_Name"] = $Class_Name;

				$timetable_ar["Subject_ID"] = $subject_id;

				$timetable_ar["Subject_Name"] = $Subject_Name;

				$timetable_ar["Batch_Name"] = "No";

				$timetable_ar["Timing"] = $timing;

				$timetable_ar["Day"] = $Days_ar[$j];

				$timetable_ar["No_Of_Student"] = $no_of_student;

				$i++;

				// echoing JSON response

					array_push($response[$Days_ar[$j]], $timetable_ar);

				

		}



			$j++;

		}

$response["Success"] = 1;

//$response["Total_Recrod"]=$count_no;

	echo json_encode($response);

}





?>

