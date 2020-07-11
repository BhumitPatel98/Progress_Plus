<?php
session_start();
include_once("db.php");
$var=extract($_POST);
$batch1=explode(";",$batch_name);
$countbatch=count($batch1)-1;
 if($Action=="Delete")
{
		$data_ids = $_REQUEST['id'];
		$data_id_array = explode(",", $data_ids); 
		if(!empty($data_id_array)) 
		{
			foreach($data_id_array as $id) 
			{
				$sql = "DELETE FROM batch ";
				$sql.=" WHERE id = '".$id."'";
				echo "$sql";
				$query=mysqli_query($con, $sql) or die("batch");
			}
		}
}

if($Action=="ADD")
{
	$i=0;
	while($i<$countbatch){
   $query="INSERT into batch values(NULL,'".$class_name."','".ucwords($batch1[$i])."')";
	$res=mysqli_query($con,$query);

	
$i++;}
	if($res==1)
	{
		echo "Success";
	}
}

if($Action=="EDIT")
{ 
   $query="UPDATE batch SET class_id='".$class_name."',batch_name='".$batch_name."' WHERE id='".$ID."'";
	$res=mysqli_query($con,$query);

	if($res==1)
	{
		echo "Success";
	}
}

if($Action=="Display")
{
	$query="SELECT * from batch where id='".$ID."'";
	$res=mysqli_query($con,$query);
	$row=mysqli_fetch_array($res);
	$id=$row["id"];
	$class_id=$row["class_id"];
	$batch_name=$row["batch_name"];

	echo "Success##".$id."##".$class_id."##".$batch_name;
}


?>