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
				$sql = "DELETE FROM department ";
				$sql.=" WHERE id = '".$id."'";
				echo "$sql";
				$query=mysqli_query($con, $sql) or die("department");
			}
		}
}

if($Action=="ADD")
{
   $query="insert into department values(NULL,'".$department_code."','".$department_name."','".$dept_sort_name."')";
	$res=mysqli_query($con,$query);

	if($res==1)
	{
		echo "Success";
	}
}

if($Action=="EDIT")
{ 
   $query="update department set department_code='".$department_code."',department_name='".$department_name."',department_sort_name='".$dept_sort_name."' where id='".$ID."'";
	$res=mysqli_query($con,$query);

	if($res==1)
	{
		echo "Success";
	}
}

if($Action=="Display")
{
	$query="select * from department where id='".$ID."'";
	$res=mysqli_query($con,$query);
	$row=mysqli_fetch_array($res);
	$f_department_id=$row["id"];
	$f_department_code=$row["department_code"];
	$f_department_name=$row["department_name"];
	$department_sort_name=$row["department_sort_name"];

	echo "Success##".$f_department_id."##".$f_department_code."##".$f_department_name."##".$department_sort_name;
}


?>