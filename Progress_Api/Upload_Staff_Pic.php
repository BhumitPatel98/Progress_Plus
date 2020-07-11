<?php

$response = array();

include_once("db.php");



if(isset($_FILES["Photo"]["name"]))

{

	// response Array

		$response = array();



		$Institute_ID=$_POST['Institute_ID'];

		$Staff_ID=$_POST['Staff_ID'];

	

		$Photo="";

		if(isset($_FILES["Photo"]["name"]))

		{

			$path="Staff_Profile/";

			$Photo=$_FILES["Photo"]["name"];

			$Tmp_Photo=$_FILES["Photo"]["tmp_name"];

			$photo_name=time()."_".$Photo;

			move_uploaded_file($Tmp_Photo,$path.$photo_name);

			$URL = $url_link."Staff_Profile/".$photo_name;



		



				$query="update staff set photo='".mysqli_real_escape_string($con,$URL)."' where id='".$Staff_ID."'";

				$res=mysqli_query($con,$query);



				if($res==1)

				{

					$response["Success"] = 1;

					$response["URL"] = $URL;

					$response["Message"] = "Uploaded Successfully";

				}

				else

				{

					 $response["Success"] = 0;

					 $response["Message"] = "Fail";

				}





		}

		

	echo json_encode($response);

}





?>



