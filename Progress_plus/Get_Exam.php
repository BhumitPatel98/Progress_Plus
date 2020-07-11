<?php
session_start();
include_once("db.php");
$requestData= $_REQUEST;


$sql = "SELECT * from  exam";
$query=mysqli_query($con, $sql) or die("exam");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  


$sql = "SELECT * from  exam";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" where `exam_name` LIKE '".$requestData['search']['value']."%'";    
	
}

	$sql.=" order by exam_name LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

$query=mysqli_query($con, $sql) or die("exam");
$totalFiltered = mysqli_num_rows($query);


$query=mysqli_query($con, $sql) or die("exam");

$data = array();
while( $row=mysqli_fetch_array($query) ) 
{  
	$nestedData=array(); 
	
	$sub_id=$row["id"];
	$exam_name=$row["exam_name"];

	$nestedData[]="<input type='checkbox' name='check_id[]'  class='deleteRow' value='".$row['id']."'  />";
	$nestedData[] = $exam_name;

	$nestedData[] = "<a href='#default-Modal'  data-toggle='modal' class='edit_model_btn'  data-id='".$sub_id."'><i class='icofont icofont-pencil-alt-5 f-20 text-c-blue'></i></a>";
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
