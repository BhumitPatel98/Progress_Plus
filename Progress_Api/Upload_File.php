<?php

$response = array();

include_once("db.php");



if(isset($_FILES["File"]["name"]))

{

	// response Array

		$response = array();



		// $Institute_ID=$_POST['Institute_ID'];

		// $Staff_ID=$_POST['Staff_ID'];

	

		$Photo="";

		if(isset($_FILES["File"]["name"]))

		{

			$path="Files/";

			$Photo=$_FILES["File"]["name"];

			$Tmp_Photo=$_FILES["File"]["tmp_name"];

			$photo_name=time()."_".$Photo;

			move_uploaded_file($Tmp_Photo,$path.$photo_name);



		 		$response["Success"] = 1;

				$response["URL"] = $url_link."Files/".$photo_name;

				$response["Message"] = "Uploaded Successfully";



		}

		

		



		

			  

		

	echo json_encode($response);

}





?>



