<?php
session_start();
include_once("db.php");
$requestData= $_REQUEST;
$class1=$_POST["id"];
$sql = "SELECT * from  student where class_id='".$class1."'";
$query=mysqli_query($con, $sql) or die("student");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  

$query=mysqli_query($con, $sql) or die("student");

$data = array();
while( $row=mysqli_fetch_array($query) ) 
{  
	$nestedData=array(); 
	
	$student_id=$row["id"];
	$student_name=$row["first_name"]." ".$row["middle_name"]." ".$row["last_name"];
	$email=$row["email"];
	$mobile=$row["mobile"];
	$password=$row["password"];
	$gender=$row["gender"];
	$birthdate=$row["birthdate"];
	$address=$row["address"];
	$city=$row["city"];
	$state=$row["state"];
	$zipcode=$row["zipcode"];
	$academic_year=$row["academic_year"];
	$admission_date=$row["admission_date"];
	$enrollment_no=$row["enrollment_no"];
	$parent_first_name=$row["parent_first_name"];
	$parent_last_name=$row["parent_last_name"];
	$parent_email=$row["parent_email"];
	$parent_mobile=$row["parent_mobile"];
	$class_id=$row["class_id"];
	$batch_name=$row["batch_name"];
	$date=$row["date"];
	$user_id=$row["user_id"];

	$nestedData[]="<input type='checkbox' name='check_id[]'  class='deleteRow' value='".$row['id']."'  />";
	$nestedData[] = $enrollment_no;
	$nestedData[] = $student_name;

	$nestedData[] = "<a href='Add_Student.php?id=".$student_id."'><i class='icofont icofont-pencil-alt-5 f-20 text-c-blue'></i></a>";
	$nestedData[] = "<a href='javascript:Delete(".$student_id.")'><i class='icofont icofont-ui-delete f-20 text-c-pink'></i></a>";




	
	$data[] = $nestedData;
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   
			"recordsTotal"    => intval( $totalData ),  
			"recordsFiltered" => intval( $totalFiltered ),
			"data"            => $data   
			);

echo json_encode($json_data);  // send data as json format

?>
