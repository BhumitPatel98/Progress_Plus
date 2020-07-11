<?php
session_start();
include_once("db.php");
$requestData= $_REQUEST;


$sql = "SELECT * from  notice_board";
$query=mysqli_query($con, $sql) or die("notice_board");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  


$sql = "SELECT * from  notice_board";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" where `notice_for` LIKE '".$requestData['search']['value']."%' or `title` LIKE '".$requestData['search']['value']."%'";    
	
}

	$sql.=" order by from_date LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

$query=mysqli_query($con, $sql) or die("notice_board");
$totalFiltered = mysqli_num_rows($query);


$query=mysqli_query($con, $sql) or die("notice_board");

$data = array();
while( $row=mysqli_fetch_array($query) ) 
{  
	$nestedData=array(); 
	
	$notice_board_id=$row["id"];
	$title=$row["title"];
	$message=$row["message"];
	$from_date=$row["from_date"];
	$to_date=$row["to_date"];
	$notice_for=$row["notice_for"];
	$department=$row["department"];
	$class_list=$row["class_list"];
	$attatchment1=$row["attatchment1"];
	$attatchment2=$row["attatchment2"];
	$attatchment3=$row["attatchment3"];
	$attatchment4=$row["attatchment4"];
	$attatchment5=$row["attatchment5"];
	$add_by=$row["add_by"];
	$user_id=$row["user_id"];
	$date=$row["date"];



	$nestedData[]="<input type='checkbox' name='check_id[]'  class='deleteRow' value='".$row['id']."'  />";

	$nestedData[] = $notice_for;
	$nestedData[] = $title;
	$nestedData[] = $from_date;
	$nestedData[] = $to_date;

	$nestedData[] = "<a href='Add_Notification.php?id=".$notice_board_id."'><i class='icofont icofont-pencil-alt-5 f-20 text-c-blue'></i></a>";
	$nestedData[] = "<a href='javascript:Delete(".$notice_board_id.")'><i class='icofont icofont-ui-delete f-20 text-c-pink'></i></a>";

	
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
