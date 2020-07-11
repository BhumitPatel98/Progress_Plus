<?php
session_start();
include_once("db.php");
$var=extract($_POST);
$batch1=$_POST['batch_name'];

$Batch="";
if($batch1=="")
{
	$Batch="Full";
}
else{
$Batch=$batch1;}

 if($Action=="Delete")
{
		$data_ids = $_REQUEST['id'];
		$data_id_array = explode(",", $data_ids); 
		if(!empty($data_id_array)) 
		{
			foreach($data_id_array as $id) 
			{
				$sql = "DELETE FROM assign_subject ";
				$sql.=" WHERE id = '".$id."'";
				echo "$sql";
				$query=mysqli_query($con, $sql) or die("assign_subject");
			}
		}
}

if($Action=="ADD")
{
   $query="insert into assign_subject values(NULL,'".$class_name."','".$staff_name."','".$subject_name."','".$Batch."')";
	$res=mysqli_query($con,$query);
	if($res==1)
	{
		echo "Success";
	}
}

if($Action=="EDIT")
{ 
   $query="UPDATE assign_subject SET class_id='".$class_name."',staff_id='".$staff_name."',subject_id='".$subject_name."',batch_name='".$Batch."' WHERE id='".$ID."'";
	$res=mysqli_query($con,$query);
	if($res==1)
	{
		echo "Success";
	}
}

if($Action=="Display")
{
	$query="select * from assign_subject where id='".$ID."'";
	$res=mysqli_query($con,$query);
	$row=mysqli_fetch_array($res);

	$query2="select * from class where id='".$row["class_id"]."'";
	$res2=mysqli_query($con,$query2);
	$row2=mysqli_fetch_array($res2);

	$sub_id=$row["id"];
	$class_name=$row["class_id"];
	$staff_name=$row["staff_id"];
	$subject_name=$row["subject_id"];
	$batch_name=$row["batch_name"];
	$dept_code=$row2["dept_id"];
	

	echo "Success##".$sub_id."##".$staff_name."##".$class_name."##".$subject_name."##".$dept_code."##".$batch_name;
}


?>