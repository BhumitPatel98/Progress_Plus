<?php
session_start();
include_once("db.php");
$requestData= $_REQUEST;

$sql = "SELECT * from  assign_subject";
$query=mysqli_query($con, $sql) or die("assign_subject");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  


$sql = "SELECT a.*,s.first_name,s.last_name,su.sub_name,c.class_name from assign_subject a,staff s,subject su,class c WHERE a.staff_id=s.id and a.subject_id=su.id AND a.class_id=c.id";
if( !empty($requestData['search']['value']) ) {   
// if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND c.class_name LIKE '".$requestData['search']['value']."%'";    
	
}

	$sql.=" LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

$query=mysqli_query($con, $sql) or die("assign_subject");
$totalFiltered = mysqli_num_rows($query);


$query=mysqli_query($con, $sql) or die("assign_subject");

$data = array();
while( $row=mysqli_fetch_array($query) ) 
{  
	$nestedData=array(); 
	
	$sql2 = "SELECT * from  class where id='".$row["class_id"]."'";
    $query2=mysqli_query($con, $sql2) or die("class");
    $row2=mysqli_fetch_array($query2);

    $sql3 = "SELECT * from  staff where id='".$row["staff_id"]."'";
    $query3=mysqli_query($con, $sql3) or die("staff");
    $row3=mysqli_fetch_array($query3);

    $sql4 = "SELECT * from  subject where id='".$row["subject_id"]."'";
    $query4=mysqli_query($con, $sql4) or die("subject");
    $row4=mysqli_fetch_array($query4);

	$sub_id=$row["id"];
	$staff_name=$row3["first_name"]." ".$row3["middle_name"]." ".$row3["last_name"];
	$class_name=$row2["class_name"];
	$subject_name=$row4["sub_name"];
	$batch_name=$row["batch_name"];


	// $nestedData[]="<input type='checkbox' name='check_id[]'  class='deleteRow' value='".$row['id']."'  />";
	//$nestedData[] = $department_name;
	//$nestedData[] = $semester;
	$nestedData[] = $staff_name;
	$nestedData[] = $class_name;
	$nestedData[] = $subject_name;
	$nestedData[] = $batch_name;

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
