<?php

$response = array();

include_once("db.php");

if(isset($_POST["Notice_ID"]))

{

	// response Array

		$response = array();

		

	

		

		$Notice_ID=$_POST['Notice_ID'];

		

		$query1="delete from notice_board where id='".$Notice_ID."'";

		$res1=mysqli_query($con,$query1);

		if($res1==1)

		{

			

				$response["Success"] = 1;

				$response["Message"] = "Deleted Successfully";

		

		}

		else

		{

			    $response["Success"] = 0;

				$response["Message"] = "Not Deleted";

		}

	echo json_encode($response);

}





?>



