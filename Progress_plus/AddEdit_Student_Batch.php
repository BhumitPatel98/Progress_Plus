<?php
session_start();
include_once("db.php");
$var=extract($_POST);
 foreach($_POST['check_id'] as $check) {
            $query="UPDATE student SET batch_name='".$BtachNM."'WHERE class_id='".$class_name."' and id='".$check."'";
	$res=mysqli_query($con,$query);
    }
    echo "Success";
?>