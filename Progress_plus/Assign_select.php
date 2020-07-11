<?php
session_start();
include_once("db.php");
$var=extract($_POST);
$id=$_POST['id'];


$query="select * from assign_subject where class_id='".$id."'";
$res=mysqli_query($con,$query);
?><select name="ass_sub_name" id="ass_sub_name" required="" class="form-control"><?php 
while($row=mysqli_fetch_array($res))
{
$sql2 = "SELECT * from  subject where id='".$row["subject_id"]."'";
    $query2=mysqli_query($con, $sql2) or die("subject");
    $row2=mysqli_fetch_array($query2);

$sql3 = "SELECT * from  staff where id='".$row["staff_id"]."'";
    $query3=mysqli_query($con, $sql3) or die("staff");
    $row3=mysqli_fetch_array($query3);
?>
<option value="<?php echo $row["id"];?>">
    <?php echo $row2["sub_name"]."{".$row["batch_name"]."} - ".$row3["first_name"]." ".$row3["middle_name"]." ".$row3["last_name"]; ?>
</option>
<?php
}
?></select><?php
?>