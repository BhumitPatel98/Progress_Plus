<?php

include_once("db.php");


if(isset($_POST["Exam_Student_List"])) 

{

   $data=$_POST["Exam_Student_List"];

	$Student = json_decode($data,true);



	$Success=$Student["Success"];

	$Total_Recrod=$Student["Total_Recrod"];

	$Institute_ID=$Student["Institute_ID"];

	$Mark_Fill=$Student["Mark_Fill"];

	$Student_List=$Student["Student_List"];
	$Exam_sub_id=$Student["Exam_sub_id"];

	



if($Mark_Fill=="No")

{
			 foreach ($Student["Student_List"] as $s_key => $s_value)

			  {



			    $Student_ID=$s_value["Student_ID"];

			    // $Student_Name=$s_value["Student_Name"];

			    // $Roll_No=$s_value["Roll_No"];

			    // $Card_No=$s_value["Card_No"];

			    $mark=$s_value["Mark"];
			    if($mark=="")
			    {
			    	$present="Absent";
			    }
			    else
			    {
			    	$present="Present";
			    }

			      $query="insert into total_mark values(NULL,'".$Exam_sub_id."','".$Student_ID."','".$mark."','".$present."')";

				  echo $query;

			      $res=mysqli_query($con,$query);

	           }

			    $response["Success"] = 1;

			    $response["Message"]="Inserted Successfully";

}

else

{

	 foreach ($Student["Student_List"] as $s_key => $s_value)

			  {



			    $Student_ID=$s_value["Student_ID"];

			   $mark=$s_value["Mark"];
			    if($mark=="")
			    {
			    	$present="Absent";
			    }
			    else
			    {
			    	$present="Present";
			    }

			  

			      $query="UPDATE `total_mark` SET mark='".$mark."',present='".$present."' WHERE Exam_sub_id='".$Exam_sub_id."' and student_id='".$Student_ID."'";

			      $res=mysqli_query($con,$query);

	           }

	            $response["Success"] = 1;

			    $response["Message"]="Updated Successfully";

}

    

 echo json_encode($response);

}







 ?>

 