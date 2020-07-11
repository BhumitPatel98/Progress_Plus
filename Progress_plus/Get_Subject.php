<?php
session_start();
include_once("db.php");
$requestData= $_REQUEST;

$sql = "SELECT * from  subject";
$query=mysqli_query($con, $sql) or die("subject");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  


$sql = "SELECT * from  subject";
if( !empty($requestData['search']['value']) ) {   
// if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" where `sub_name` LIKE '".$requestData['search']['value']."%'";    
	
}

	$sql.=" order by sub_name LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

$query=mysqli_query($con, $sql) or die("subject");
$totalFiltered = mysqli_num_rows($query);


$query=mysqli_query($con, $sql) or die("subject");

$data = array();
while( $row=mysqli_fetch_array($query) ) 
{  
	$nestedData=array(); 
	
	$sql2 = "SELECT * from  class where id='".$row["class_id"]."'";
    $query2=mysqli_query($con, $sql2) or die("subject");
    $row2=mysqli_fetch_array($query2);

	$sub_id=$row["id"];
	$class_name=$row2["class_name"];
	$subject_code=$row["subject_code"];
	$subject_name=$row["sub_name"];


	$nestedData[]="<input type='checkbox' name='check_id[]'  class='deleteRow' value='".$row['id']."'  />";
	$nestedData[] = $class_name;
	$nestedData[] = $subject_code;
	$nestedData[] = $subject_name;

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
