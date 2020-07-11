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

		$From_Date=$_POST['From_Date'];

		$To_Date=$_POST['To_Date'];



		

		$response["Success"] = 1;

		$response["Institute_ID"] = $Institute_ID;

		$response["Class_ID"] = $Class_ID;

		$response["Student_ID"] = $Student_ID;

		$response["Month"] =$Month;

		$response["Year"] = $Year;

		$response["Subject_Report"] = array();



		$date=date("Y-m-d");



		// $timestamp    = strtotime($Month_Year);

		 $From_Date_Format = date('Y-m-d 00:00:00', strtotime($From_Date));

		 $To_Date_Format  = date('Y-m-d 12:59:59', strtotime($To_Date));



		

		$query="SELECT * FROM `assign_subject` WHERE `class_id`='".$Class_ID."'";

	



		$res=mysqli_query($con,$query) or mysqli_error($con);

		while($row=mysqli_fetch_array($res))

		{

			$Staff_ID=$row["staff_id"];

			$Class_ID=$row["class_id"];

			$Subject_ID=$row["subject_id"];

			$Type="Full";
			if($Batch_name!="Full")
			{
				$Type="BatchWise";
			}

			$Batch_name=$row["batch_name"];

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
				if($Batch_name!="Full")
					{
						$Subject_Name=$row4["sub_name"]." (".$Batch_name.")";
					}

			}







		

			$Total_Present=0;

			$Total_Absent=0;

			$query1="SELECT * FROM `attendance` WHERE `staff_id`='".$Staff_ID."' AND `class_id`='".$Class_ID."' AND `subject_id`='".$Subject_ID."' AND `type`='".$Type."' AND `batch_name`='".$Batch_name."' and `datetime` BETWEEN '".$From_Date_Format."' AND '".$To_Date_Format."'";

			



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



		

			$Student_Report_ar=array();



		      	$Student_Report_ar["Staff_ID"] = $Staff_ID;

				$Student_Report_ar["Staff_Name"] = $Staff_Name;

				$Student_Report_ar["Subject_ID"] = $Subject_ID;

				$Student_Report_ar["Subject_Name"] = $Subject_Name;

				$Student_Report_ar["Type"] = $Type;

				$Student_Report_ar["Batch_Name"] = $Batch_name;

				$Student_Report_ar["Total_Lecture"] = $Total_Lecture;

				$Student_Report_ar["Total_Present"] = $Total_Present;

				$Student_Report_ar["Total_Absent"] = $Total_Absent;

				$Student_Report_ar["Percentange"] = number_format((float)$Percentange, 2, '.', '');

				array_push($response["Subject_Report"], $Student_Report_ar);



				



				

				

				// echoing JSON response

				

		}

		

	echo json_encode($response);

}





?>

