<?php

$response = array();

include_once("db.php");

if(isset($_POST["Institute_ID"]))

{

	

	// response Array

		$response = array();

		



		$Institute_ID=$_POST['Institute_ID'];

		$Student_ID=$_POST['Student_ID'];

		$Class_ID=$_POST['Class_ID'];

		$Staff_ID=$_POST['Staff_ID'];

		$Subject_ID=$_POST['Subject_ID'];

		$Batch_Name=$_POST['Batch_Name'];

		$Type=$_POST['Type'];

		$From_Date=$_POST['From_Date'];

		$To_Date=$_POST['To_Date'];



		

		$From_Date_New = date('Y-m-d 00:00:00', strtotime($From_Date));

		$To_Date_New  = date('Y-m-d 12:59:59', strtotime($To_Date));



		$From_Date_Format=date("d-m-Y",strtotime($From_Date));

		$To_Date_Format=date("d-m-Y",strtotime($To_Date));





		$query3="SELECT * FROM `staff` WHERE `id`='".$Staff_ID."'";

			$res3=mysqli_query($con,$query3) or mysqli_error($con);

			if($row3=mysqli_fetch_array($res3))

			{

				$Staff_Name=$row3["first_name"]." ".$row3["last_name"];

			}





	     $query4="SELECT * FROM `subject` WHERE  `id`='".$Subject_ID."'";

			$res4=mysqli_query($con,$query4) or mysqli_error($con);

			if($row4=mysqli_fetch_array($res4))

			{

				$Subject_Name=$row4["sub_name"];
				if($Batch_Name!="Full")
					{
						$Subject_Name=$row4["sub_name"]." (".$Batch_Name.")";
					}

			}



		$query5="SELECT * FROM `student` WHERE  `id`='".$Student_ID."'";

			$res5=mysqli_query($con,$query5) or mysqli_error($con);

			if($row5=mysqli_fetch_array($res5))

			{

				$Student_Name=$row5["first_name"]." ".$row5["last_name"];

			}





		$response["Success"] = 1;

		$response["From_Date"] = $From_Date_Format;

		$response["To_Date"] = $To_Date_Format;

		$response["Subject_Name"] = $Subject_Name;

		$response["Batch_Name"] = $Batch_Name;

		$response["Teacher_Name"] =$Staff_Name;

		$response["Student_Name"] =$Student_Name;

		$response["Total_Lecture"] =0;

		$response["Total_Present"] =0;

		$response["Total_Absent"] = 0;

		$response["Percentange"] = 0;

		$response["Subject_Report"] = array();



		$date=date("Y-m-d");



			$Total_Present=0;

			$Total_Absent=0;

			$query1="SELECT * FROM `attendance` WHERE `staff_id`='".$Staff_ID."' AND `class_id`='".$Class_ID."' AND `subject_id`='".$Subject_ID."' AND `type`='".$Type."' AND `batch_name`='".$Batch_Name."' and `datetime` BETWEEN '".$From_Date_New."' AND '".$To_Date_New."'";





			$res1=mysqli_query($con,$query1) or mysqli_error($con);

			$Total_Lecture=mysqli_num_rows($res1);

			while($row1=mysqli_fetch_array($res1))

			{

				$Attendance_ID=$row1["id"];

				$query2="SELECT * FROM `attendance_list` WHERE `attendance_id`='".$Attendance_ID."' AND `student_id`='".$Student_ID."'";

				$res2=mysqli_query($con,$query2);

				if($row2=mysqli_fetch_array($res2))

				{

					$Attendance_Status=$row2["attendance"];

					$Sms_Status="";

					$Date_Status=$row2["date"];

					if($Attendance_Status=="Present")

					{

						$Total_Present++;

					}

					else

					{

						$Total_Absent++;

					}



					$New_Date=date("d-m-Y",strtotime($Date_Status));

					$New_Day=date("l",strtotime($Date_Status));



						$Student_Report_ar=array();

						$Student_Report_ar["Date"] = $New_Date;

						$Student_Report_ar["Day"] = $New_Day;

						$Student_Report_ar["Attendance"] = $Attendance_Status;

						array_push($response["Subject_Report"], $Student_Report_ar);



				}





			}



			if($Total_Lecture!=0)

			{

				$Percentange=$Total_Present*100/$Total_Lecture;

			}

			else

			{

				$Percentange=0;

			}



			$response["Total_Lecture"] = $Total_Lecture;

			$response["Total_Present"] = $Total_Present;

			$response["Total_Absent"] = $Total_Absent;

			$response["Percentange"] = number_format((float)$Percentange, 2, '.', '');



	echo json_encode($response);

}





?>

