<?php
session_start();
include_once("db.php");
$requestData= $_REQUEST;

$att_id=$_REQUEST["id"];

$sql = "SELECT * from  attendance_list where attendance_id='".$att_id."'";
$query=mysqli_query($con, $sql) or die("attendance_list");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  

$query=mysqli_query($con, $sql) or die("attendance_list");

$data = array();
while( $row=mysqli_fetch_array($query) ) 
{  
	$nestedData=array(); 
	$id=$row["id"];
	$attendance_id=$row["attendance_id"];
	$attendance=$row["attendance"];
	$date=$row["date"];

	$sql2 = "SELECT * from student where id='".$row["student_id"]."'";
    $query2=mysqli_query($con, $sql2) or die("student");
    $row2=mysqli_fetch_array($query2);

    $student_name=$row2["first_name"]." ".$row2["middle_name"]." ".$row2["last_name"];

	$nestedData[]="<input type='checkbox' name='check_id[]'  class='deleteRow' value='".$row['id']."'  />";
	$nestedData[] = $student_name;


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