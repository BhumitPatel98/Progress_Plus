<?php
session_start();
include_once("db.php");
$var=extract($_POST);
$id1=$_POST['ID1'];
$query="SELECT * from  attendance_list where attendance_id='".$id1."'";
$res=mysqli_query($con,$query);
$student=array();
while($row=mysqli_fetch_array($res))
{
    $i=0;
	$attendance="";
	$student=$row["student_id"];
	foreach ($_POST['Check_id'] as $id) {
        if($id==$student)
        {
            $i=1;    
        }
    }
    if($i==1)
    {
        $attendance="Present";
        $query1="UPDATE attendance_list SET attendance='".$attendance."' WHERE student_id='".$student."' and attendance_id='".$id1."'";
        $res1=mysqli_query($con,$query1);

    }
    else 
    {
        $attendance="Absent";
        $query1="UPDATE attendance_list SET attendance='".$attendance."' WHERE student_id='".$student."' and attendance_id='".$id1."'";
        $res1=mysqli_query($con,$query1); 
    }
}
    echo "Success";
?>