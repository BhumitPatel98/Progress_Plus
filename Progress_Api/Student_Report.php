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

		$Month=$_POST['Month'];

		$Year=$_POST['Year'];

		$Month_Year=$Month." ".$Year;

		

		$response["Success"] = 1;

		$response["Institute_ID"] = $Institute_ID;

		$response["Class_ID"] = $Class_ID;

		$response["Student_ID"] = $Student_ID;

		$response["Month"] =$Month;

		$response["Year"] = $Year;

		$response["Subject_Report"] = array();



	

		$timestamp    = strtotime($Month_Year);

	

		$To_Date  = date('Y-m-t', $timestamp); // A leap year!



		$days=date("t",strtotime($To_Date));

		





$i=1;

		$count_no1=0;

		while($i<=$days)

		{

			$date_two = sprintf("%02d", $i);

		    $Date = date('Y-m-'.$date_two, $timestamp);

		    $New_Day=date("l",strtotime($Date));;



			$Total_Present=0;

			$Total_Absent=0;

			$query1="SELECT * FROM `attendance` WHERE  `class_id`='".$Class_ID."' and `datetime`  Like '".$Date."%'";

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



			if($Total_Lecture==$Total_Present && $Total_Lecture!=0)

			{

				$Attendance_View="Full";

				$color_status="#5ace3f";

			}

			else if($Total_Lecture==$Total_Absent && $Total_Lecture!=0)

			{

				$Attendance_View="Absent";

				$color_status="#ce132c";

			}

			else if($Total_Lecture==0 && $Total_Present==0 && $Total_Absent==0)

			{



				$Attendance_View="Holiday";

				$color_status="#8696a2";

			}

			else

			{

				$Attendance_View="Partial";

				$color_status="#f6a244";

			}





		

			$Student_Report_ar=array();



		    

				$Student_Report_ar["Date"] = $Date;

				$Student_Report_ar["Day"] = $New_Day;

				$Student_Report_ar["Status"] = $Attendance_View;

				$Student_Report_ar["Color"] = $color_status;

			

				array_push($response["Subject_Report"], $Student_Report_ar);



				



				

				

				// echoing JSON response

				

		$i++;

		}

	echo json_encode($response);

}





?>

