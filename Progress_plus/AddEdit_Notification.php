<?php
session_start();
include_once("db.php");
$var=extract($_POST);

if($class_name1!="")
{
	$class_name1=$ClassNM;
}
$Admin_ID=$_SESSION["P_Admin_ID"];

$file_path="Notification/";
$file_name1=$_FILES["file1"]["name"];
$tmp_name1=$_FILES["file1"]["tmp_name"];

$file_name2=$_FILES["file2"]["name"];
$tmp_name2=$_FILES["file2"]["tmp_name"];

$file_name3=$_FILES["file3"]["name"];
$tmp_name3=$_FILES["file3"]["tmp_name"];

$file_name4=$_FILES["file4"]["name"];
$tmp_name4=$_FILES["file4"]["tmp_name"];

$file_name5=$_FILES["file5"]["name"];
$tmp_name5=$_FILES["file5"]["tmp_name"];

move_uploaded_file($tmp_name1,$file_path.$file_name1);
move_uploaded_file($tmp_name2,$file_path.$file_name2);
move_uploaded_file($tmp_name3,$file_path.$file_name3);
move_uploaded_file($tmp_name4,$file_path.$file_name4);
move_uploaded_file($tmp_name5,$file_path.$file_name5);

$date=date("Y-m-d");


$from_date=date("Y-m-d",strtotime($f_date));
$to_date=date("Y-m-d",strtotime($t_date));
$message_to="";
$message_for="";

	if($mass=="Department")
	{ 
		$message_for=$radio1;
		if($message_for=="All")
		{
			$class_name1="All";
		}
	}
else{
	$message_for=$mass;
}
 if($Action=="Delete")
{
		$data_ids = $_REQUEST['id'];
		$data_id_array = explode(",", $data_ids); 
		if(!empty($data_id_array)) 
		{
			foreach($data_id_array as $id) 
			{
				$sql = "DELETE FROM notice_board ";
				$sql.=" WHERE id = '".$id."'";
	
				$query=mysqli_query($con, $sql) or die("notice_board");
			}
		}
}

if($Action=="ADD")
{

   $query="insert into notice_board values(NULL,'".$title."','".$massage."','".$from_date."','".$to_date."','".$message_for."','".$department."','".$class_name1."','".$file_name1."','".$file_name2."','".$file_name3."','".$file_name4."','".$file_name5."','Admin','".$Admin_ID."','".$date."')";
   echo $query;
	$res=mysqli_query($con,$query);
	if($res==1)
	{
		echo "Success";
	}
}

if($Action=="EDIT")
{ 
   $query="UPDATE notice_board SET title='".$title."',message='".$massage."',from_date='".$from_date."',to_date='".$to_date."',notice_for='".$message_for."',department='".$department."',class_list='".$class_name1."',attatchment1='".$file_name1."',attatchment2='".$file_name2."',attatchment3='".$file_name3."',attatchment4='".$file_name4."',attatchment5='".$file_name5."',add_by='Admin',user_id='".$Admin_ID."',date='".$date."' WHERE id='".$ID."'";
	$res=mysqli_query($con,$query);

	if($res==1)
	{
		echo "Success";
	}
}

if($Action=="Display")
{
   
   $Action="EDIT";
	$query="select * from notice_board where id='".$_REQUEST["ID"]."'";
	$res=mysqli_query($con,$query);
	    $row=mysqli_fetch_array($res);
	    
	$notice_board_id=$row["id"];
	$title=$row["title"];
	$message=$row["message"];
	$from_date=$row["from_date"];
	$to_date=$row["to_date"];
	$notice_for=$row["notice_for"];
	$department=$row["department"];
	$class_list=$row["class_list"];
	$attatchment1=$row["attatchment1"];
	$attatchment2=$row["attatchment2"];
	$attatchment3=$row["attatchment3"];
	$attatchment4=$row["attatchment4"];
	$attatchment5=$row["attatchment5"];
	$add_by=$row["add_by"];
	$user_id=$row["user_id"];
	$date=$row["date"];
    $formdate=date("m/d/Y",strtotime($from_date));
    $todate=date("m/d/Y",strtotime($to_date));
	    
	   echo "Success##".$notice_board_id."##".$title."##".$message."##".$formdate."##".$todate."##".$notice_for."##".$department."##".$class_list."##".$attatchment1."##".$attatchment2."##".$attatchment3."##".$attatchment4."##".$attatchment5."##".$add_by."##".$user_id."##".$date;
}

?>