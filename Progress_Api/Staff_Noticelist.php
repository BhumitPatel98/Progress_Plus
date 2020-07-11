<?php

$response = array();

include_once("db.php");

if(isset($_POST["Institute_ID"]))

{

	

	// response Array

		$response = array();

		

		

		$Institute_ID=$_POST['Institute_ID'];

		$Staff_ID=$_POST['Staff_ID'];

		$response["Notice_List"] = array();

		

	

		$title="";

		$message="";

		$from_date="";

		$to_date="";

		$notice_for="";

		$Class_List="";

		$staff_department="";

		$Url_1="";

		$Url_2="";

		$Url_3="";

		

		$query="SELECT * FROM `notice_board` WHERE add_by='Staff' and user_id='".$Staff_ID."' order by id desc";


		$res=mysqli_query($con,$query) or mysqli_error($con);

		while($row=mysqli_fetch_array($res))

		{ 
			$Class_Name1="";

			$notice_id=$row["id"];

			$title=$row["title"];

			$message=$row["message"];

			$from_date=$row["from_date"];

			$to_date=$row["to_date"];

			$notice_for=$row["notice_for"];

			$Class_List_ID=$row["class_list"];

			$staff_department=$row["department"];

			$Url_1=$row["attatchment1"];

			$Url_2=$row["attatchment2"];

			$Url_3=$row["attatchment3"];

				$notice_board_ar=array();
				 $class_name=explode(";",$Class_List_ID);
				 $i=0;
				 $count_class=(count($class_name)-1);
				 while ($i<$count_class) {
				 	$query1="SELECT * from class WHERE id='".$class_name[$i]."'";
				 	$res1=mysqli_query($con,$query1) or mysqli_error($con);
				 	$row1=mysqli_fetch_array($res1);
				 	$Class_Name1.=$row1["class_name"];
				 	if($i!=($count_class-1))
				 	{
				 			$Class_Name1.=",";
				 	}
				 	
				 	$i++;
				 }

		        $notice_board_ar["Success"] = 1;

		        $notice_board_ar["Notice_ID"] = $notice_id;

		        $notice_board_ar["Title"] = $title;

				$notice_board_ar["Message"] = $message;

				$notice_board_ar["From_date"] = $from_date;

				$notice_board_ar["To_date"] = $to_date;

				$notice_board_ar["Class_List_ID"] = $Class_List_ID;

				$notice_board_ar["Class_List_Name"] =$Class_Name1;

				$notice_board_ar["Url_1"] = $Url_1;

				$notice_board_ar["Url_2"] = $Url_2;

				$notice_board_ar["Url_3"] = $Url_3;

				array_push($response["Notice_List"], $notice_board_ar);



				

				

				// echoing JSON response

				

		}

		

	echo json_encode($response);

}





?>

