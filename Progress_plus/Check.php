<?php
session_start();
include_once("db.php");

$var=extract($_POST);
$id=$_POST['id'];

if($Type=="dept")
{
$query="SELECT department_code FROM department where department_code='".$id."'";
$res=mysqli_query($con,$query);
if($row=mysqli_fetch_array($res))
	{	
		echo "Found";
	}
else
{
		echo "Not Found";
}
}

if($Type=="student")
{
$query="SELECT enrollment_no FROM student where enrollment_no='".$id."'";
$res=mysqli_query($con,$query);
if($row=mysqli_fetch_array($res))
	{	
		echo "Found";
	}
else
{
		echo "Not Found";
}
}

if($Type=="staff")
{
$query="select * from staff where email='".$id."'";
$res1=mysqli_query($con,$query);
if($row1=mysqli_fetch_array($res1))
	{	
		echo "Found";
	}
else
{
		echo "Not Found";
}
}

if($Type=="subject")
{
$query="select * from subject where subject_code='".$id."'";
$res1=mysqli_query($con,$query);
if($row1=mysqli_fetch_array($res1))
	{	
		echo "Found";
	}
else
{
		echo "Not Found";
}
}



if($Type=="check_class")
{?> 
	<select class="multiselect" multiple="multiple" id="class_name1" name="class_name1">
    <option value="">Select Class</option>
    
<?php
$query="select * from class where dept_id='".$id."'";
$res=mysqli_query($con,$query);
while($row=mysqli_fetch_array($res))
{
?><option value="<?php echo $row["id"];?>">
<?php echo $row["class_name"];?>
</option>
<?php
}
?>
 </select>
<?php
}

// Assing_batch.php

if($Type=="check_batch")
{?> 
	<select class="multiselect" multiple="multiple" id="batch_name1" name="btach_name1">
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


if($Type=="check_sub")
{?>
	<select id="sub_name" name="sub_name">
    <option value="">Select Subject</option> 
	<?php
$query="select * from assign_subject where class_id='".$id."'";
$res=mysqli_query($con,$query);
while($row=mysqli_fetch_array($res))
{
	$sql2 = "SELECT * from  subject where id='".$row["subject_id"]."'";
    $query2=mysqli_query($con, $sql2) or die("subject");
    $row2=mysqli_fetch_array($query2);

?><option value="<?php echo $row2["id"];?>">
<?php echo $row2["sub_name"];?>
</option>
<?php
}?>
 </select><?php
}
?>