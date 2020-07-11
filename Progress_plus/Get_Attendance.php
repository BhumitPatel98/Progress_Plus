<?php
session_start();
include_once("db.php");
$requestData= $_REQUEST;


$sql = "SELECT * from  attendance";
$query=mysqli_query($con, $sql) or die("attendance");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  


$sql = "SELECT * from  attendance";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	//$sql.=" where `department_code` LIKE '".$requestData['search']['value']."%' or `department_name` LIKE '".$requestData['search']['value']."%' or `department_sort_name` LIKE '".$requestData['search']['value']."%'";    
	
}

//$sql.=" order by department_code LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

$query=mysqli_query($con, $sql) or die("attendance");
$totalFiltered = mysqli_num_rows($query);


$query=mysqli_query($con, $sql) or die("attendance");

$data = array();
while( $row=mysqli_fetch_array($query) ) 
{  
	$nestedData=array(); 
	
	$id=$row["id"];
	$datetime=$row["datetime"];
	$time=$row["time"];
    $type=$row["type"];
    $batch_name=$row["batch_name"];
    $acadamic_year=$row["acadamic_year"];
    $modify_date=$row["modify_date"];


	$sql2 = "SELECT * from staff where id='".$row["staff_id"]."'";
    $query2=mysqli_query($con, $sql2) or die("staff");
    $row2=mysqli_fetch_array($query2);

    $sql3 = "SELECT * from class where id='".$row["class_id"]."'";
    $query3=mysqli_query($con, $sql3) or die("class");
    $row3=mysqli_fetch_array($query3);

    $sql4 = "SELECT * from subject where id='".$row["subject_id"]."'";
    $query4=mysqli_query($con, $sql4) or die("subject");
    $row4=mysqli_fetch_array($query4);


    $staff_name=$row2["first_name"]." ".$row2["last_name"];
    $class_name=$row3["class_name"];
    $subject_name=$row4["sub_name"];
    
	$nestedData[] = $class_name;
	$nestedData[] = $staff_name;
	$nestedData[] = $subject_name;
	$nestedData[] = $datetime;
	$nestedData[] = "<a href='Attendance_list.php?id=".$id."'><i class='icofont icofont-pencil-alt-5 f-20 text-c-blue'></i></a>";
	

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
