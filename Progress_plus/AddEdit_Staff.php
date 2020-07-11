<?php
session_start();
include_once("db.php");
$var=extract($_POST);
$date=date("Y-m-d");

$birthdate_show=date("Y-m-d",strtotime($birth));
$joiningdate=date("Y-m-d",strtotime($joining_date));

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
				$sql = "DELETE FROM staff ";
				$sql.=" WHERE id = '".$id."'";
				$query=mysqli_query($con, $sql) or die("staff");
			}
		}
}

if($Action=="ADD")
{
   $query="insert into staff values(NULL,'".$first_name."','".$middle_name."','".$last_name."','".$email."','".$mobile."','".$Enc_old_password."','".$card_no."','".$gender."','".$birthdate_show."','".$designation."','".$joiningdate."','".$experience."','".$education."','".$address."','".$city."','".$state."','".$zipcode."','".$department_name."','','".$date."','".$new_status."')";
	$res=mysqli_query($con,$query);

	if($res==1)
	{
		echo "Success";
	}
}

if($Action=="EDIT")
{ 
   $query="UPDATE staff SET first_name='".$first_name."',middle_name='".$middle_name."',last_name='".$last_name."',email='".$email."',mobile='".$mobile."',card_no='".$card_no."',gender='".$gender."',birthdate='".$birthdate_show."',designation='".$designation."',joining_date='".$joiningdate."',experience='".$experience."',education='".$education."',address='".$address."',city='".$city."',state='".$state."',zipcode='".$zipcode."',department='".$department_name."',date='".$date."',status='".$new_status."' WHERE id='".$ID."'";

	$res=mysqli_query($con,$query);

	if($res==1)
	{
		echo "Success";
	}
}

if($Action=="Display")
{
	 $Action="EDIT";
	$query="select * from Staff where id='".$_POST["ID"]."'";
	$res=mysqli_query($con,$query);
	    $row=mysqli_fetch_array($res);
	    
	    $staff_id=$row["id"];
	    $first_name=$row["first_name"];
	    $middle_name=$row["middle_name"];
	    $last_name=$row["last_name"];
	    $email=$row["email"];
	    $mobile=$row["mobile"];
	    $password=$row["password"];
	    $card_no=$row["card_no"];
	    $birthdate=$row["birthdate"];
	    $designation=$row["designation"];
	    $joining_date=$row["joining_date"];
	    $experience=$row["experience"];
	    $education=$row["education"];
	    $address=$row["address"];
	    $city=$row["city"];
	    $state=$row["state"];
	    $zipcode=$row["zipcode"];
	    $department=$row["department"];
	    $date=$row["date"];
	    $photo=$row["photo"];
	    $status=$row["status"];
	    $gender=$row["gender"];
	    $birthdate_disp=date("d-m-Y",strtotime($birthdate));
	    $joiningdate=date("d-m-Y",strtotime($joining_date));

	    echo "Success##".$staff_id."##".$first_name."##".$middle_name."##".$last_name."##".$email."##".$mobile."##".$password."##".$card_no."##".$birthdate_disp."##".$designation."##".$joiningdate."##".$experience."##".$education."##".$address."##".$city."##".$state."##".$zipcode."##".$department."##".$date."##".$gender."##".$status;

}


?>