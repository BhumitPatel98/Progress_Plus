<?php

$response = array();

include_once("db.php");

if(isset($_POST["ID"]))

{
	// response Array

		$response = array();
		$response["Class"]=array();
		$ID=$_POST['ID'];

	$query2="select * from staff where id='".$ID."'";
	$res2=mysqli_query($con,$query2);
	$row2=mysqli_fetch_array($res2);

		$query1="select class_name from class where dept_id='".$row2["department"]."'";
		$res1=mysqli_query($con,$query1);
		$class_array=array();
		while($row1=mysqli_fetch_array($res1))

		{
			
				$class_array["class_name"]=$row1["class_name"];
				array_push($response["Class"], $class_array);
		}
		
	echo json_encode($response);
}

?>



