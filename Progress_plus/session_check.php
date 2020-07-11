<?php
$Admin_ID="";
$Admin_User="";
$Admin_Role="";
$Company_Name="Progress Plus";
$Role="";

if(isset($_SESSION["P_Admin_ID"]))
{
    $Admin_ID=$_SESSION["P_Admin_ID"];
    $Admin_User=$_SESSION["P_Admin_User"];
    $Admin_Role=$_SESSION["P_Admin_Role"];
}
else{
    header("location:index.php");
}
?>