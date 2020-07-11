<?php
session_start();
include_once("db.php");
require_once "Classes/PHPExcel.php";
$var=extract($_POST);

$file_path="excel/";
$file_name=$_FILES["file"]["name"];
$tmp_name=$_FILES["file"]["tmp_name"];
$class1=$_POST['class1'];


		$tmpfname =$tmp_name;
		$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
		$excelObj = $excelReader->load($tmpfname);
		$worksheet = $excelObj->getSheet(0);
		$lastRow = $worksheet->getHighestRow();
		 $maxCell = $worksheet->getHighestRowAndColumn();
        $data = $worksheet->rangeToArray('A1:' . $maxCell['column'] . $maxCell['row']);
        $data = array_map('array_filter', $data);
        $data = array_filter($data);
	
		$i=0;
		$j=0;
		$ans=0;
		$recodefound="";
		for ($row = 2; $row <= count($data); $row++) {

				$Suject_Code="";
				$Suject_Name="";
				$Attendance_Type="";
				
				$Suject_Code=mysqli_real_escape_string($con,$worksheet->getCell('A'.$row)->getValue());
				$Suject_Name=mysqli_real_escape_string($con,$worksheet->getCell('B'.$row)->getValue());
				$Attendance_Type=mysqli_real_escape_string($con,$worksheet->getCell('C'.$row)->getValue());

				$query="select * from subject where subject_code='".$Suject_Code."' and attendance_type='".$Attendance_Type."'";
				$res1=mysqli_query($con,$query);
				if($row1=mysqli_fetch_array($res1))
					{
						$recodefound.="<div class='Error_red'>Record No ".($i+2)." Suject Code ".$Suject_Code." Already Exist</div>";
					}
				else{
				  $sql ="insert into subject values(NULL,'".$class1."','".$Suject_Code."','".$Suject_Name."','".$Attendance_Type."')";
                            $res=mysqli_query($con,$sql); 
                            $j++;  
				}
			 $i++;

		}
	$i=$i+1;
		$ans=$i-$j;
		echo $recodefound."<div class='Error_Warning'>".$ans." Record Not Inserted</div><div class='Error_success'>".$j." Record Inserted</div>";
	echo "@@@Success";
?>