<?php
session_start();
include_once("db.php");
$var=extract($_POST);


 if($Action1=="Delete")
{
		$data_ids = $_REQUEST['id'];
		$data_id_array = explode(",", $data_ids); 
		if(!empty($data_id_array)) 
		{
			foreach($data_id_array as $id) 
			{
				$sql = "DELETE FROM exam_sub ";
				$sql.=" WHERE id = '".$id."'";
				echo "$sql";
				$query=mysqli_query($con, $sql) or die("exam");
			}
		}
}

if($Action1=="ADD")
{
   $query="insert into time_table values(NULL,'".$time."','".$ass_sub_name."','".$day."')";
	$res=mysqli_query($con,$query);
	if($res==1)
	{
		echo "Success";
	}
}

if($Action1=="EDIT")
{ 
   $query="UPDATE time_table SET assign_id='".$ass_sub_name."',day='".$day."' WHERE id='".$ID1."'";
	$res=mysqli_query($con,$query);
	if($res==1)
	{
		echo "Success";
	}
}

if($Action1=="Display")
{
	$query="select * from time_table where id='".$ID1."'";
	$res=mysqli_query($con,$query);
	$row=mysqli_fetch_array($res);

	$sql2 = "SELECT * from  assign_subject where id='".$row["assign_id"]."'";
    $query2=mysqli_query($con, $sql2) or die("assign_subject");
    $row2=mysqli_fetch_array($query2);


	$id=$row["id"];
	$time_id=$row["time_id"];
	$class_name=$row2["class_id"];
	$assign_id=$row["assign_id"];
	$day=$row["day"];


	echo "Success##".$id."##".$time_id."##".$class_name."##".$assign_id."##".$day;
}


?>