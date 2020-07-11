<?php
include_once("db.php");
$query="select * from staff";
$res=mysqli_query($con,$query);
while ($row=mysqli_fetch_array($res)) {
	$card_no=$row["card_no"].".jpg";

	$query2="update staff set photo='".$card_no."' where id='".$row["id"]."'";
	$res2=mysqli_query($con,$query2);
}
?>