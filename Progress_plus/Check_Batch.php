<?php
session_start();
include_once("db.php");

$var=extract($_POST);
$id=$_POST['id'];
if($Type=="check_batch")
{
?> 
<select name="batch_name" id="batch_name" required="" class="form-control">
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