<?php
session_start();
include_once("db.php");
$var=extract($_POST);
$date=date("Y-m-d");
$Admin_ID=$_SESSION["P_Admin_ID"];

$birthdate_show=date("Y-m-d",strtotime($birth));
$admissiondate=date("Y-m-d",strtotime($admission_date));

$enc_old=md5('123456');
$Enc_old_password=substr($enc_old, 0,30);


 if($Action=="Delete")
{
		$data_ids = $_REQUEST['id'];
		$data_id_array = explode(",", $data_ids); 
		if(!empty($data_id_array)) 
		{
			foreach($data_id_array as $id) 
			{
				$sql = "DELETE FROM student ";
				$sql.=" WHERE id = '".$id."'";
				echo "$sql";
				$query=mysqli_query($con, $sql) or die("student");
			}
		}
}

if($Action=="ADD")
{
   $query="insert into student values(NULL,'".$first_name."','".$middle_name."','".$last_name."','".$email."','".$mobile."','".$Enc_old_password."','".$gender."','".$birthdate_show."','".$address."','".$city."','".$state."','".$zipcode."','".$academic_year."','".$admissiondate."','".$enrollment."','".$p_firstname."','".$p_lastname."','".$p_email."','".$p_mobile."','".$Enc_old_password."','".$class_name."','".$batch_name."','".$date."','','".$Admin_ID."','".$new_status."')";
	$res=mysqli_query($con,$query);

	if($res==1)
	{
		echo "Success";
	}
}

if($Action=="EDIT")
{ 
   $query="UPDATE student SET first_name='".$first_name."',middle_name='".$middle_name."',last_name='".$last_name."',`email`='".$email."',mobile='".$mobile."',`gender`='".$gender."',`birthdate`='".$birthdate_show."',`address`='".$address."',`city`='".$city."',`state`='".$state."',`zipcode`='".$zipcode."',`academic_year`='".$academic_year."',`admission_date`='".$admissiondate."',`enrollment_no`='".$enrollment."',`parent_first_name`='".$p_firstname."',`parent_last_name`='".$p_lastname."',`parent_email`='".$p_email."',`parent_mobile`='".$p_mobile."',`class_id`='".$class_name."',`batch_name`='".$batch_name."',`date`='".$date."',status='".$new_status."' WHERE id='".$ID."'";
	$res=mysqli_query($con,$query);

	if($res==1)
	{
		echo "Success";
	}
}

if($Action=="Display")
{
   
   $Action="EDIT";
	$query="select * from student where id='".$_REQUEST["ID"]."'";
	$res=mysqli_query($con,$query);
	    $row=mysqli_fetch_array($res);
	    
	    $student_id=$row["id"];
	    $first_name=$row["first_name"];
	    $middle_name=$row["middle_name"];
	    $last_name=$row["last_name"];
	    $email=$row["email"];
	    $mobile=$row["mobile"];
	    $password=$row["password"];
	    $gender=$row["gender"];
	    $birthdate=$row["birthdate"];
	    $address=$row["address"];
	    $city=$row["city"];
	    $state=$row["state"];
	    $zipcode=$row["zipcode"];
	    $academic_year=$row["academic_year"];
	    $admission_date=$row["admission_date"];
	    $enrollment_no=$row["enrollment_no"];
	    $parent_first_name=$row["parent_first_name"];
	    $parent_last_name=$row["parent_last_name"];
	    $parent_email=$row["parent_email"];
	   	$parent_mobile=$row["parent_mobile"];
	    $class_id=$row["class_id"];
	    $batch_name=$row["batch_name"];
	    $date=$row["date"];
	    $photo=$row["photo"];
	    $user_id=$row["user_id"];
	    $status=$row["status"];
	    $birthdate_disp=date("d/m/Y",strtotime($birthdate));
	    $admissiondate=date("d/m/Y",strtotime($admission_date));
	    
	   echo "Success##".$student_id."##".$first_name."##".$middle_name."##".$last_name."##".$email."##".$mobile."##".$password."##".$gender."##".$birthdate_disp."##".$address."##".$city."##".$state."##".$zipcode."##".$academic_year."##".$admissiondate."##".$enrollment_no."##".$parent_first_name."##".$parent_last_name."##".$parent_email."##".$parent_mobile."##".$class_id."##".$batch_name."##".$date."##".$user_id."##".$status;
}

?>