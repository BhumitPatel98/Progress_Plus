<?php
session_start();
include_once("db.php");
$var=extract($_POST);

$date_show=date("Y-m-d",strtotime($f_date));
$date_added=date("Y-m-d H:i:s");

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
   $query="insert into exam_sub values(NULL,'".$exam_name1."','".$ass_sub_name."','".$total_make."','".$pass_mark."','".$date_show."','No','".$date_added."','Pending')";
	$res=mysqli_query($con,$query);
	if($res==1)
	{
		echo "Success";
	}
}

if($Action1=="EDIT")
{ 
   $query="UPDATE exam_sub SET exam_id='".$exam_name1."',assign_id='".$ass_sub_name."',total_mark='".$total_make."',passing_mark='".$pass_mark."',date='".$date_show."' where id='".$ID1."'";
	$res=mysqli_query($con,$query);
	//echo $query;
	if($res==1)
	{
		echo "Success";
	}
}

if($Action1=="Display")
{
	$query="select * from exam_sub where id='".$ID1."'";
	$res=mysqli_query($con,$query);
	$row=mysqli_fetch_array($res);

	$sql2 = "SELECT * from  assign_subject where id='".$row["assign_id"]."'";
    $query2=mysqli_query($con, $sql2) or die("assign_subject");
    $row2=mysqli_fetch_array($query2);


	$id=$row["id"];
	$exam_name=$row["exam_id"];
	$class_name=$row2["class_id"];
	$assign_id=$row["assign_id"];
	$total_mark=$row["total_mark"];
	$passing_mark=$row["passing_mark"];
	$f_date=$row["date"];
	$added=$row["added"];
	$added_date=$row["added_date"];
	$status=$row["status"];
	$date_disp=date("d/m/Y",strtotime($f_date));


	echo "Success##".$id."##".$exam_name."##".$class_name."##".$total_mark."##".$passing_mark."##".$date_disp."##".$assign_id;
}

if($Action1=="Status")
{
	if($status=="Pending")
	{
		$new_status="Done";
		
	}
	else
	{
		$new_status="Pending";
	}
	$query="UPDATE exam_sub SET status='".$new_status."' where id='".$id."'";
	$res=mysqli_query($con,$query);
	if($res==1)
	{
		echo "Success";	
	}
}

?>