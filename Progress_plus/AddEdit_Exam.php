<?php
session_start();
include_once("db.php");
$var=extract($_POST);



 if($Action=="Delete")
{
		$data_ids = $_REQUEST['id'];
		$data_id_array = explode(",", $data_ids); 
		if(!empty($data_id_array)) 
		{
			foreach($data_id_array as $id) 
			{
				$sql = "DELETE FROM exam ";
				$sql.=" WHERE id = '".$id."'";
				echo "$sql";
				$query=mysqli_query($con, $sql) or die("exam");
			}
		}
}

if($Action=="ADD")
{
   $query="insert into exam values(NULL,'".$exam_name."')";
	$res=mysqli_query($con,$query);
	if($res==1)
	{
		echo "Success";
	}
}

if($Action=="EDIT")
{ 
   $query="UPDATE exam SET exam_name='".$exam_name."' WHERE id='".$ID."'";
	$res=mysqli_query($con,$query);

	if($res==1)
	{
		echo "Success";
	}
}

if($Action=="Display")
{
	$query="select * from exam where id='".$ID."'";
	$res=mysqli_query($con,$query);
	$row=mysqli_fetch_array($res);
	$exam_id=$row["id"];
	$exam_name=$row["exam_name"];

	echo "Success##".$exam_id."##".$exam_name;
}


?>