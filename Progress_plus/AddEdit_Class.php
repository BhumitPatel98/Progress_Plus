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
				$sql = "DELETE FROM class ";
				$sql.=" WHERE id = '".$id."'";
				echo "$sql";
				$query=mysqli_query($con, $sql) or die("class");
			}
		}
}

if($Action=="ADD")
{
   $query="insert into class values(NULL,'".$department."','".$semester."','".$division."','".$class_name."')";
	$res=mysqli_query($con,$query);

	if($res==1)
	{
		echo "Success";
	}
}

if($Action=="EDIT")
{ 
   $query="update class set dept_id='".$department."',semester='".$semester."',division='".$division."',class_name='".$class_name."' where id='".$ID."'";
	$res=mysqli_query($con,$query);
	if($res==1)
	{
		echo "Success";
	}
}

if($Action=="Display")
{
	$query="select * from class where id='".$ID."'";
	$res=mysqli_query($con,$query);
	$row=mysqli_fetch_array($res);
	$f_class_id=$row["id"];
	$f_dept_id=$row["dept_id"];
	$f_semester=$row["semester"];
	$division=$row["division"];
	$f_class_name=$row["class_name"];

	echo "Success##".$f_class_id."##".$f_dept_id."##".$f_semester."##".$division."##".$f_class_name;
}


?>