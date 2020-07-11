<?php
include_once("db.php");
$id=$_POST['id'];

$sql = "SELECT department_sort_name From department Where department_code = '".$id."'";
$query=mysqli_query($con, $sql);
	$row=mysqli_fetch_array($query);
	$sub_id=$row["department_sort_name"];
	echo $sub_id;
?>