<?php

$response = array();

include_once("db.php");

if(isset($_POST["Institute_ID"]))

{

	

	// response Array

		$response = array();

		

		

		$Institute_ID=$_POST['Institute_ID'];

		$Class_ID=$_POST['Class_ID'];

		$response["Notice_List"] = array();

		

		$date=date("Y-m-d");

		$title="";

		$message="";

		$from_date="";

		$to_date="";

		$notice_for="";

		$Class_List="";

		$staff_department="";;

		$Url_1="";

		$Url_2="";

		$Url_3="";

		

		$query="SELECT * FROM `notice_board` WHERE class_list Like '%".$Class_ID.";%' and `from_date`<='".$date."' and `to_date`>='".$date."'  order by id desc";
	
	

	



		$res=mysqli_query($con,$query) or mysqli_error($con);

		while($row=mysqli_fetch_array($res))

		{

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



		        $notice_board_ar["Success"] = 1;

		        $notice_board_ar["Notice_ID"] = $notice_id;

		        $notice_board_ar["Title"] = $title;

				$notice_board_ar["Message"] = $message;

				$notice_board_ar["From_date"] = $from_date;

				$notice_board_ar["To_date"] = $to_date;

				$notice_board_ar["Class_List_ID"] = $Class_List_ID;

				$notice_board_ar["Class_List_Name"] ="";

				$notice_board_ar["Url_1"] = $Url_1;

				$notice_board_ar["Url_2"] = $Url_2;

				$notice_board_ar["Url_3"] = $Url_3;

				array_push($response["Notice_List"], $notice_board_ar);



				

				

				// echoing JSON response

				

		}

		

	echo json_encode($response);

}





?>

