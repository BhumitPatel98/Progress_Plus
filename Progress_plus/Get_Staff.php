<?php
session_start();
include_once("db.php");
$requestData= $_REQUEST;


$sql = "SELECT * from  staff";
$query=mysqli_query($con, $sql) or die("staff");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  


$sql = "SELECT * from  staff where 1=1";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" and `first_name` LIKE '".$requestData['search']['value']."%' or `middle_name` LIKE '".$requestData['search']['value']."%' or `last_name` LIKE '".$requestData['search']['value']."%' or `card_no` LIKE '".$requestData['search']['value']."%'";    
	
}

if( !empty($requestData['columns'][0]['search']['value']) ){   //name
    $sql.=" AND department='".$requestData['columns'][0]['search']['value']."' ";
}

	$sql.=" order by card_no LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

$query=mysqli_query($con, $sql) or die("staff");
$totalFiltered = mysqli_num_rows($query);


$query=mysqli_query($con, $sql) or die("staff");

$data = array();
while( $row=mysqli_fetch_array($query) ) 
{  
	$nestedData=array(); 
	
	$staff_id=$row["id"];
	$staff_name=$row["first_name"]." ".$row["middle_name"]." ".$row["last_name"];
	$email=$row["email"];
	$mobile=$row["mobile"];
	$password=$row["password"];
	$card_no=$row["card_no"];
	$birthdate=$row["birthdate"];
	$designation=$row["designation"];
	$joining_date=$row["joining_date"];
	$experience=$row["experience"];
	$education=$row["education"];
	$address=$row["address"];
	$city=$row["city"];
	$state=$row["state"];
	$zipcode=$row["zipcode"];
	$department=$row["department"];
	$photo=$link_url.$Staff_Path.$row["photo"];
	$date=$row["date"];
	$status=$row["status"];

if(!file_exists($photo))
{
	$photo=$link_url.$Staff_Path."No_Image.jpg";
}


	$nestedData[]="<input type='checkbox' name='check_id[]'  class='deleteRow' value='".$row['id']."'  />";
	$nestedData[] = $staff_name;
	$nestedData[] = $card_no;
	$nestedData[] = $email;
	$nestedData[] = "<img src='".$photo."' style='height: 50px;width: auto;'>";

	$nestedData[] = "<a href='Add_Staff.php?id=".$staff_id."'><i class='icofont icofont-pencil-alt-5 f-20 text-c-blue'></i></a>";
	$nestedData[] = "<a href='javascript:Delete(".$staff_id.")'><i class='icofont icofont-ui-delete f-20 text-c-pink'></i></a>";




	
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
