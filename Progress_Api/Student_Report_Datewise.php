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

		$Date=$_POST['Date'];

		 $New_Day=date("l",strtotime($Date));

	

		

		$response["Success"] = 1;

		$response["Institute_ID"] = $Institute_ID;

		$response["Class_ID"] = $Class_ID;

		$response["Student_ID"] = $Student_ID;

		$response["Date"] = $Date;

		$response["Day"] = $New_Day;

		

	

		$response["Subject_Report"] = array();



	

		

		





		  



			$Total_Present=0;

			$Total_Absent=0;

			$query1="SELECT * FROM `attendance` WHERE  `class_id`='".$Class_ID."' and `datetime`  Like '".$Date."%'";

			$res1=mysqli_query($con,$query1) or mysqli_error($con);

			$Total_Lecture=mysqli_num_rows($res1);

			while($row1=mysqli_fetch_array($res1))

			{

				$Attendance_ID=$row1["id"];

				$Staff_ID=$row1["staff_id"];

				$Subject_ID=$row1["subject_id"];

				$Time=$row1["time"];

				$Type=$row1["type"];

				$Batch_Name=$row1["batch_name"];









			$query3="SELECT * FROM `staff` WHERE  `id`='".$Staff_ID."'";

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

					$Subject_Name.=" (".$Batch_Name.")";

				}

			}



				$query5="SELECT * FROM `time` WHERE no='".$Time."'";

				$res5=mysqli_query($con,$query5) or mysqli_error($con);

				if($row5=mysqli_fetch_array($res5))

				{

					$timing=$row5["timing"];

				}



				$query2="SELECT * FROM `attendance_list` WHERE `attendance_id`='".$Attendance_ID."' AND `student_id`='".$Student_ID."'";

				$res2=mysqli_query($con,$query2);

				if($row2=mysqli_fetch_array($res2))

				{

					$Attendance_Status=$row2["attendance"];

					$Sms_Status="";

					$Date_Status=$row2["date"];

					$Student_Report_ar=array();



		    

				$Student_Report_ar["Subject_Name"] = $Subject_Name;

				$Student_Report_ar["Staff_Name"] = $Staff_Name;

				$Student_Report_ar["Time"] = $timing;

			    $Student_Report_ar["Attendance"] = $Attendance_Status;

				array_push($response["Subject_Report"], $Student_Report_ar);

					



				}





			}

		

	echo json_encode($response);

}





?>

