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

		$Class_ID=$_POST['Class_ID'];

		$Date=date("Y-m-d");

		$Day=date("l",strtotime($Date));

		$Staff_Name="";



		$Days_ar=array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");



		$Subject_Name="";

		$timing="";

		$no_of_student="";

		$Class_Name="";




		$j=0;

		while($j<count($Days_ar))

		{



		$response[$Days_ar[$j]] = array();



		$query="select a.class_id,a.staff_id,a.subject_id,a.`batch_name`,t.time,t.day from assign_subject a,time_table t where t.assign_id=a.id and a.class_id='".$Class_ID."' and t.day='".$Days_ar[$j]."' order by time";

		$res=mysqli_query($con,$query) or mysqli_error($con);

		$count_no=mysqli_num_rows($res);

		$i=1;

		while($row=mysqli_fetch_array($res))

		{

				$class_id=$row["class_id"];
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



				$query4="SELECT * FROM `staff` WHERE id='".$row["staff_id"]."'";

				$res4=mysqli_query($con,$query4) or mysqli_error($con);

				if($row4=mysqli_fetch_array($res4))

				{

					$Staff_Name=$row4["first_name"] ." ".$row4["last_name"];

				}



				$timetable_ar=array();

		       

		        $timetable_ar["Class_ID"] = $class_id;

				$timetable_ar["Class_Name"] = $Class_Name;

				$timetable_ar["Subject_Name"] = $Subject_Name;

				$timetable_ar["Staff_Name"] = $Staff_Name;

				$timetable_ar["Timing"] = $timing;

			

			

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

