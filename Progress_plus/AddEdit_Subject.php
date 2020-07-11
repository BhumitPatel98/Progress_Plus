<?php
session_start();
include_once("db.php");
$var=extract($_POST);
$attend_type="";
if(isset($_POST["sub_type"]))
{
	$attend_type="Batch_wise";
}
else
{
	$attend_type="Full";
}

 if($Action=="Delete")
{
		$data_ids = $_REQUEST['id'];
		$data_id_array = explode(",", $data_ids); 
		if(!empty($data_id_array)) 
		{
			foreach($data_id_array as $id) 
			{
				$sql = "DELETE FROM subject ";
				$sql.=" WHERE id = '".$id."'";
				echo "$sql";
				$query=mysqli_query($con, $sql) or die("subject");
			}
		}
}

if($Action=="ADD")
{
   $query="insert into subject values(NULL,'".$class_name."','".$subject_code."','".$subject_name."','".$attend_type."')";
	$res=mysqli_query($con,$query);
	if($res==1)
	{
		echo "Success";
	}
}

if($Action=="EDIT")
{ 
   $query="UPDATE subject SET class_id='".$class_name."',subject_code='".$subject_code."',sub_name='".$subject_name."',attendance_type='".$attend_type."' WHERE id='".$ID."'";
	$res=mysqli_query($con,$query);
	if($res==1)
	{
		echo "Success";
	}
}

if($Action=="Display")
{
	$query="select * from subject where id='".$ID."'";
	$res=mysqli_query($con,$query);
	$row=mysqli_fetch_array($res);
	$sub_id=$row["id"];
	$class_name=$row["class_id"];
	$subject_code=$row["subject_code"];
	$subject_name=$row["sub_name"];
	$attendance_type=$row["attendance_type"];
	echo "Success##".$sub_id."##".$class_name."##".$subject_code."##".$subject_name."##".$attendance_type;
}


?>