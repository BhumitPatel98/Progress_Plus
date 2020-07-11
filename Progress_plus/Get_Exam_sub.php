<?php
session_start();
include_once("db.php");
$requestData= $_REQUEST;


$sql = "SELECT * from  exam_sub";
$query=mysqli_query($con, $sql) or die("exam_sub");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  


$sql = "SELECT * from  exam_sub";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	//$sql.=" where `department_code` LIKE '".$requestData['search']['value']."%' or `department_name` LIKE '".$requestData['search']['value']."%' or `department_sort_name` LIKE '".$requestData['search']['value']."%'";    
	
}

//$sql.=" order by department_code LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

$query=mysqli_query($con, $sql) or die("exam_sub");
$totalFiltered = mysqli_num_rows($query);


$query=mysqli_query($con, $sql) or die("exam_sub");

$data = array();
while( $row=mysqli_fetch_array($query) ) 
{  
	$nestedData=array(); 

	$sql2 = "SELECT * from  assign_subject where id='".$row["assign_id"]."'";
    $query2=mysqli_query($con, $sql2) or die("assign_subject");
    $row2=mysqli_fetch_array($query2);

    $sql3 = "SELECT * from  subject where id='".$row2["subject_id"]."'";
    $query3=mysqli_query($con, $sql3) or die("subject");
    $row3=mysqli_fetch_array($query3);

    $sql5 = "SELECT * from  class where id='".$row2["class_id"]."'";
    $query5=mysqli_query($con, $sql5) or die("class");
    $row5=mysqli_fetch_array($query5);

    $sql6 = "SELECT * from  exam where id='".$row["exam_id"]."'";
    $query6=mysqli_query($con, $sql6) or die("exam");
    $row6=mysqli_fetch_array($query6);
	
	$sub_id=$row["id"];
	$class_name=$row5["class_name"];
	$exam_name=$row6["exam_name"];
	$sub_name=$row3["sub_name"];
	$total_mark=$row["total_mark"];
	$passing_mark=$row["passing_mark"];
	$date=$row["date"];
	$status=$row["status"];

	$nestedData[]="<input type='checkbox' name='check_id[]'  class='deleteRow' value='".$row['id']."'  />";
	$nestedData[] = $class_name;
	$nestedData[] = $exam_name;
	$nestedData[] = $sub_name;
	$nestedData[] = "<a href=javascript:Update_Data(".$row["id"].",'".$status."')>".$status."</a>";

	$nestedData[] = "<a href='#Exam_sub'  data-toggle='modal' class='edit_model_btn'  data-id='".$sub_id."'><i class='icofont icofont-pencil-alt-5 f-20 text-c-blue'></i></a>";
	$nestedData[] = "<a href='javascript:Delete(".$sub_id.")'><i class='icofont icofont-ui-delete f-20 text-c-pink'></i></a>";


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
