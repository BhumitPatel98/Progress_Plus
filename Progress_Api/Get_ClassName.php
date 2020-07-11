<?php

$response = array();

include_once("db.php");

if(isset($_POST["Institute_ID"]))

{

	

	// response Array

		$response = array();

		$response["Class_Details"]=array();

	

		

		$Institute_ID=$_POST['Institute_ID'];

		//$Staff_ID=$_POST['Staff_ID'];

		$Date=date("Y-m-d");

		$Day=date("l",strtotime($Date));



		$Class_Name="";

		

		$query="SELECT * from class";

		$res=mysqli_query($con,$query) or mysqli_error($con);

		$count_no=mysqli_num_rows($res);

		$i=1;

		while($row=mysqli_fetch_array($res))

		{

				$Class_ID=$row["id"];

				$Class_Name=$row["class_name"];



			

		      	$Class_ar=array();

		      	$Class_ar["Class_ID"]=$Class_ID;

		      	$Class_ar["Class_Name"]=$Class_Name;



		    	array_push($response["Class_Details"], $Class_ar);

				$i++;

				// echoing JSON response

				

				

		}

$response["Success"] = 1;



	echo json_encode($response);

}





?>

