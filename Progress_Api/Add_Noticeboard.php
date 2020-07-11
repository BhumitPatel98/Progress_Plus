<?php

$response = array();

include_once("db.php");

//include_once("sendsms.php");



if(isset($_POST["Institute_ID"]))

{

	// response Array

		$response = array();

		

	

		$Institute_ID=$_POST['Institute_ID'];

		$Staff_ID=$_POST['Staff_ID'];

		$Title=$_POST['Title'];

		$Message=$_POST['Message'];

		$From_Date=$_POST['From_Date'];

		$To_Date=$_POST['To_Date'];

		$Notice_For="Student";

		$Class_List=$_POST['Notice_For'];

		$Staff_Department="";

		$Url_1=mysqli_real_escape_string($con,$_POST['URL_1']);

		$Url_2=mysqli_real_escape_string($con,$_POST['URL_2']);

		$Url_3=mysqli_real_escape_string($con,$_POST['URL_3']);

		$Url_4="";

		$Url_5="";

		$Send_Sms=$_POST['Send_Sms'];

		

		$Sms_Text=$_POST['Sms_Text'];

		$Sms_Text_a=mysqli_real_escape_string($con,$Sms_Text);

		$Add_By="Staff";

		$User_ID=$Staff_ID;





		$Date=date("Y-m-d H:i:s");

		//SMSSend($Mobile_No,$message,true);



		$query1="insert into `notice_board` value(NULL,'".$Title."','".$Message."','".$From_Date."','".$To_Date."','".$Notice_For."','".$Staff_Department."','".$Class_List."','".$Url_1."','".$Url_2."','".$Url_3."','".$Url_4."','".$Url_5."','".$Send_Sms."','".$Sms_Text_a."','".$Add_By."','".$User_ID."','".$Date."')";

		$res1=mysqli_query($con,$query1);

		if($res1==1)

		{

			

				$response["Success"] = 1;

				$response["Message"] = "Inserted Successfully";

		

		}

		else

		{

			    $response["Success"] = 0;

				$response["Message"] = "Fail";

		}

	echo json_encode($response);

}







?>



