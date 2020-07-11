<?php

include_once("db.php");

date_default_timezone_set("Asia/Calcutta");



if(isset($_POST["Attendance_List"])) 

{

   $data=$_POST["Attendance_List"];

	$Student = json_decode($data,true);



	$Success=$Student["Success"];

	$Total_Recrod=$Student["Total_Recrod"];

	$Institute_ID=$Student["Institute_ID"];

	$Staff_ID=$Student["Staff_ID"];

	$Class_ID=$Student["Class_ID"];

	$Subject_ID=$Student["Subject_ID"];

	$Batch_Name=$Student["Batch_Name"];

	$Lecture=$Student["Lecture"];

	$Attendance_taken=$Student["Attendance_taken"];

	$Attendance_ID=$Student["Attendance_ID"];

	



	$Batch_Type="Full";

	$Academic_Year="2018-19";

	if($Batch_Name!="Full")

	{

		$Batch_Type="BatchWise";

	}

	 $Sms=$Student["Sms"];

	$DateTime=date("Y-m-d H:i:s");

	$Modify_Date=date("Y-m-d");

	





if($Attendance_taken=="No")

{

		$query="insert into `attendance` values(NULL,'".$Staff_ID."','".$Class_ID."','".$Subject_ID."','".$Lecture."','".$Batch_Type."','".$Batch_Name."','".$Academic_Year."','".$DateTime."','".$Modify_Date."')";


	      $res=mysqli_query($con,$query);

	      $Attendance_ID=mysqli_insert_id($con);

	      if($res==1)

	      {

	      

			 $DateTime1=date("Y-m-d H:i:s");

			 foreach ($Student["Student_List"] as $s_key => $s_value)

			  {



			    $Student_ID=$s_value["Student_ID"];

			    // $Student_Name=$s_value["Student_Name"];

			    // $Roll_No=$s_value["Roll_No"];

			    // $Card_No=$s_value["Card_No"];

			    $Attendance=$s_value["Attendance"];



			  

			      $query="insert into `attendance_list` values(NULL,'".$Attendance_ID."','".$Student_ID."','".$Attendance."','".$DateTime1."')";

				

			      $res=mysqli_query($con,$query);

			      // if($res==1)

			      // {

			     

			      

			      // }

	      

	           }

	     



			    $response["Success"] = 1;

			    $response["Message"]="Inserted Successfully";

			   

			}

			else

			{

				  $response["Success"] = 0;

				   $response["Message"]="Fail";

			}

}

else

{

	 foreach ($Student["Student_List"] as $s_key => $s_value)

			  {



			    $Student_ID=$s_value["Student_ID"];

			    $Attendance=$s_value["Attendance"];

 				$DateTime1=date("Y-m-d H:i:s");

			  

			      $query="update `attendance_list` set `attendance`='".$Attendance."',`date`='".$DateTime1."' where `attendance_id`='".$Attendance_ID."' and `student_id`='".$Student_ID."'";

			      $res=mysqli_query($con,$query);

			     

	      

	           }

	            $response["Success"] = 1;

			    $response["Message"]="Updated Successfully";

}

    

 echo json_encode($response);

}







 ?>

 