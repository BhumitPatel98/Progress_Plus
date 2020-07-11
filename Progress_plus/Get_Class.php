<?php
session_start();
include_once("db.php");
$requestData= $_REQUEST;


$sql = "SELECT * from  class";
$query=mysqli_query($con, $sql) or die("class");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  


$sql = "SELECT * from  class";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" where `class_name` LIKE '".$requestData['search']['value']."%'";    
}
	$sql.=" order by class_name LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

$query=mysqli_query($con, $sql) or die("class");
$totalFiltered = mysqli_num_rows($query);


$query=mysqli_query($con, $sql) or die("class");

$data = array();
while( $row=mysqli_fetch_array($query) ) 
{  
	$nestedData=array(); 
	
	$sql2 = "SELECT * from  department where id='".$row["dept_id"]."'";
    $query2=mysqli_query($con, $sql2) or die("class");
    $row2=mysqli_fetch_array($query2);

	$class_id=$row["id"];
	$department_name=$row2["department_name"];
	$semester=$row["semester"];
	$class_name=$row["class_name"];


	$nestedData[]="<input type='checkbox' name='check_id[]'  class='deleteRow' value='".$row['id']."'  />";
	$nestedData[] = $class_name;

	$nestedData[] = "<a href='#default-Modal'  data-toggle='modal' class='edit_model_btn'  data-id='".$class_id."'><i class='icofont icofont-pencil-alt-5 f-20 text-c-blue'></i></a>";
	$nestedData[] = "<a href='javascript:Delete(".$class_id.")'><i class='icofont icofont-ui-delete f-20 text-c-pink'></i></a>";




	
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
