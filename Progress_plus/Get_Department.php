<?php
session_start();
include_once("db.php");
$requestData= $_REQUEST;


$sql = "SELECT * from  department";
$query=mysqli_query($con, $sql) or die("department");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  


$sql = "SELECT * from  department";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" where `department_code` LIKE '".$requestData['search']['value']."%' or `department_name` LIKE '".$requestData['search']['value']."%' or `department_sort_name` LIKE '".$requestData['search']['value']."%'";    
	
}

$sql.=" order by department_code LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

$query=mysqli_query($con, $sql) or die("Department");
$totalFiltered = mysqli_num_rows($query);


$query=mysqli_query($con, $sql) or die("Department");

$data = array();
while( $row=mysqli_fetch_array($query) ) 
{  
	$nestedData=array(); 
	
	$department_id=$row["id"];
	$department_code=$row["department_code"];
	$department_name=$row["department_name"];
	$department_sort_name=$row["department_sort_name"];



	$nestedData[]="<input type='checkbox' name='check_id[]'  class='deleteRow' value='".$row['id']."'  />";
	$nestedData[] = $department_code;
	$nestedData[] = $department_name;
	$nestedData[] = $department_sort_name;

	$nestedData[] = "<a href='#default-Modal'  data-toggle='modal' class='edit_model_btn'  data-id='".$department_id."'><i class='icofont icofont-pencil-alt-5 f-20 text-c-blue'></i></a>";
	$nestedData[] = "<a href='javascript:Delete(".$department_id.")'><i class='icofont icofont-ui-delete f-20 text-c-pink'></i></a>";




	
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
