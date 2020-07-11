<?php
session_start();
include_once("db.php");
$requestData= $_REQUEST;


$sql = "SELECT * from  batch";
$query=mysqli_query($con, $sql) or die("batch");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  


$sql = "SELECT * from  batch";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" where batch_name LIKE '".$requestData['search']['value']."%'";    
	
}

	$sql.=" order by class_id LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

$query=mysqli_query($con, $sql) or die("batch");
$totalFiltered = mysqli_num_rows($query);


$query=mysqli_query($con, $sql) or die("batch");

$data = array();
while( $row=mysqli_fetch_array($query) ) 
{  
	$nestedData=array(); 
	
	$sql2 = "SELECT * from  class where id='".$row["class_id"]."'";
    $query2=mysqli_query($con, $sql2) or die("class");
    $row2=mysqli_fetch_array($query2);

	$id=$row["id"];
	$class_code=$row2["class_name"];
	$batch_name=$row["batch_name"];


	$nestedData[]="<input type='checkbox' name='check_id[]'  class='deleteRow' value='".$row['id']."'  />";
	$nestedData[] = $class_code;
	$nestedData[] = $batch_name;

	$nestedData[] = "<a href='#default-Modal'  data-toggle='modal' class='edit_model_btn'  data-id='".$id."'><i class='icofont icofont-pencil-alt-5 f-20 text-c-blue'></i></a>";
	$nestedData[] = "<a href='javascript:Delete(".$id.")'><i class='icofont icofont-ui-delete f-20 text-c-pink'></i></a>";
	
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
