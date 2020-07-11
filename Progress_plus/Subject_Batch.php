<?php
session_start();
include_once("db.php");

$var=extract($_POST);
$id=$_POST['id'];

if($Type=="check_class1")
{?>
<select name="class_name" id="class_name" required="" class="form-control" onchange="check_subject()">
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
<?php echo "@@@";?>
<select name="staff_name" id="staff_name" required="" class="form-control">
<option value="">Select Staff</option>
<?php 
$query="select * from staff Where department='".$id."'";
$res=mysqli_query($con,$query);
while($row=mysqli_fetch_array($res))
{
?>
<option value="<?php echo $row["id"];?>">
<?php echo $row["first_name"]." ".$row["middle_name"]." ".$row["last_name"];?>
</option>
<?php
}
?>
</select>
<?php
}

if($Type=="check_Subject")
{?>
<select name="subject_name" id="subject_name" required="" class="form-control" onchange="check_batch()">
<option value="">Select Subject</option>
<?php 
$query="select * from subject where class_id='".$id."'";
$res=mysqli_query($con,$query);
while($row=mysqli_fetch_array($res))
{
?>
<option value="<?php echo $row["id"];?>">
<?php echo $row["sub_name"];?>
</option>
<?php
}
?>
</select>
<?php
}

if($Type=="batch")
{
$query="select * from subject where id='".$id."'";
$res1=mysqli_query($con,$query);
$row1=mysqli_fetch_array($res1);
if($row1["attendance_type"]=="Batch_wise")
	{	
		echo "Found";
	}
else
	{
			echo "Not Found";
	}
}

if($Type=="check_batch")
{?>
	<select name="batch_name" id="batch_name" class="form-control">
<option value="">Select Batch</option>

<?php
$query="select * from batch where class_id='".$id."'";
$res=mysqli_query($con,$query);
while($row=mysqli_fetch_array($res))
{
?><option value="<?php echo $row["batch_name"];?>">
<?php echo $row["batch_name"];?>
</option>
<?php
}?>
</select>
<?php
}

?>