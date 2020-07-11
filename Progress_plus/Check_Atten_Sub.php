<?php
session_start();
include_once("db.php");

$var=extract($_POST);
$id=$_POST['id'];

if($Type=="check_class1")
{?>
<select name="class_name" id="class_name" required="" class="form-control" onchange="staff()">
<option value="">Select Class</option>
<?php 
$query="select * from class Where dept_id='".$id."'";
$res=mysqli_query($con,$query);
while($row=mysqli_fetch_array($res))
{
?>
<option value="<?php echo $row["id"];?>">
<?php echo $row["class_name"];?>
</option>
<?php
}
?>
</select>
<?php
}

if($Type=="check_staff")
{?>
<select name="staff_name" id="staff_name" required="" class="form-control" onchange="check_subject()">
<option value="">Select Staff</option>
<?php 
$query="select * from staff Where department='".$id."'";
$res=mysqli_query($con,$query);
while($row=mysqli_fetch_array($res))
{
?>
<option value="<?php echo $row["id"];?>">
<?php echo $row["first_name"]." ".$row["last_name"];?>
</option>
<?php
}
?>
</select>
<?php
}


?>