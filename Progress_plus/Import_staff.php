<?php
session_start();
include_once("db.php");
require_once "Classes/PHPExcel.php";
$var=extract($_POST);


$file_path="excel/";
$file_name=$_FILES["file"]["name"];
$tmp_name=$_FILES["file"]["tmp_name"];
$department=$_POST['department'];

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

				
				$First_Name="";
				$Middle_Name="";
				$Last_Name="";
				$Email="";
				$Mobile="";
				$Card_no="";
				$Gender="";
				$Birthdate="";
				$Designation="";
				$Joining_Date="";
				$Experience="";
				$Education="";
				$Address="";
				$City="";
				$State="";
				$Zipcode="";
				$Photo="";
				$Status="";
				$Date=date("Y-m-d");
			
				$First_Name=mysqli_real_escape_string($con,$worksheet->getCell('A'.$row)->getValue());
				$Middle_Name=mysqli_real_escape_string($con,$worksheet->getCell('B'.$row)->getValue());
				$Last_Name=mysqli_real_escape_string($con,$worksheet->getCell('C'.$row)->getValue());
				$Email=mysqli_real_escape_string($con,$worksheet->getCell('D'.$row)->getValue());
				$Mobile=mysqli_real_escape_string($con,$worksheet->getCell('E'.$row)->getValue());
				$Card_no=mysqli_real_escape_string($con,$worksheet->getCell('F'.$row)->getValue());
				$Gender=mysqli_real_escape_string($con,$worksheet->getCell('G'.$row)->getValue());
				$Birthdate=mysqli_real_escape_string($con,$worksheet->getCell('H'.$row)->getValue());
				$Designation=mysqli_real_escape_string($con,$worksheet->getCell('I'.$row)->getValue());
				$Joining_Date=mysqli_real_escape_string($con,$worksheet->getCell('J'.$row)->getValue());
				$Experience=mysqli_real_escape_string($con,$worksheet->getCell('K'.$row)->getValue());
				$Education=mysqli_real_escape_string($con,$worksheet->getCell('L'.$row)->getValue());
				$Address=mysqli_real_escape_string($con,$worksheet->getCell('M'.$row)->getValue());
				$City=mysqli_real_escape_string($con,$worksheet->getCell('N'.$row)->getValue());
				$State=mysqli_real_escape_string($con,$worksheet->getCell('O'.$row)->getValue());
				$Zipcode=mysqli_real_escape_string($con,$worksheet->getCell('P'.$row)->getValue());
				$Photo=mysqli_real_escape_string($con,$worksheet->getCell('Q'.$row)->getValue());
				$Status=mysqli_real_escape_string($con,$worksheet->getCell('R'.$row)->getValue());
				
				$enc_old=md5('123456');
				$Enc_old_password=substr($enc_old, 0,30);

				$unix_date=($Birthdate - 25569) * 86400;
				$Birth_date=gmdate("Y-m-d",$unix_date);
				
				$unixdate=($Joining_Date - 25569) * 86400;
				$Joiningdate=gmdate("Y-m-d",$unixdate);

				$query="select * from staff where email='".$Email."'";
				$res1=mysqli_query($con,$query);
	    		if($row1=mysqli_fetch_array($res1))
	    		{
	    				$recodefound.="<div class='Error_red'>Record No ".($i+2)." Email id ".$Email." Already Exist</div>";
	    		}
				else{
				  $sql ="INSERT INTO staff VALUES (NULL,'".$First_Name."','".$Middle_Name."','".$Last_Name."','".$Email."','".$Mobile."','".$Enc_old_password."','".$Card_no."','".$Gender."','".$Birth_date."','".$Designation."','".$Joiningdate."','".$Experience."','".$Education."','".$Address."','".$City."','".$State."','".$Zipcode."','".$department."','".$Photo."','".$Date."','".$Status."')";
				  //echo $sql;
                            $res=mysqli_query($con,$sql);
                            $j++;
                            	}
			 $i++;;
		}
		$i=$i+1;
		$ans=$i-$j;
		echo $recodefound."<div class='Error_Warning'>".$ans." Record Not Inserted</div><div class='Error_success'>".$j." Record Inserted</div>";
	echo "@@@Success";
?>