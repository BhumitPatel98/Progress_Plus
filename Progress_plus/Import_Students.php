 <?php
session_start();
include_once("db.php");
require_once "Classes/PHPExcel.php";
$var=extract($_POST);

$file_path="excel/";
$file_name=$_FILES["file"]["name"];
$tmp_name=$_FILES["file"]["tmp_name"];
$class1=$_POST['class1'];
$Admin_ID=$_SESSION["P_Admin_ID"];


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
				$Gender="";
				$Birthdate="";
				$Address="";
				$City="";
				$State="";
				$Zipcode="";
				$Academic_year="";
				$Addmission_date="";
				$Enrollment_no="";
				$Parent_first_name="";
				$Parent_last_name="";
				$Parent_Email="";
				$Parent_mobile="";
				$batch_name="";
				$photo="";
				$Status="";
				$Date=date("Y-m-d");

				$First_Name=mysqli_real_escape_string($con,$worksheet->getCell('A'.$row)->getValue());
				$Middle_Name=mysqli_real_escape_string($con,$worksheet->getCell('B'.$row)->getValue());
				$Last_Name=mysqli_real_escape_string($con,$worksheet->getCell('C'.$row)->getValue());
				$Email=mysqli_real_escape_string($con,$worksheet->getCell('D'.$row)->getValue());
				$Mobile=mysqli_real_escape_string($con,$worksheet->getCell('E'.$row)->getValue());
				$Gender=mysqli_real_escape_string($con,$worksheet->getCell('F'.$row)->getValue());
				$Birthdate=mysqli_real_escape_string($con,$worksheet->getCell('G'.$row)->getValue());
				$Address=mysqli_real_escape_string($con,$worksheet->getCell('H'.$row)->getValue());
				$City=mysqli_real_escape_string($con,$worksheet->getCell('I'.$row)->getValue());
				$State=mysqli_real_escape_string($con,$worksheet->getCell('J'.$row)->getValue());
				$Zipcode=mysqli_real_escape_string($con,$worksheet->getCell('K'.$row)->getValue());
				$Academic_year=mysqli_real_escape_string($con,$worksheet->getCell('L'.$row)->getValue());
				$Addmission_date=mysqli_real_escape_string($con,$worksheet->getCell('M'.$row)->getValue());
				$Enrollment_no=mysqli_real_escape_string($con,$worksheet->getCell('N'.$row)->getValue());
				$Parent_first_name=mysqli_real_escape_string($con,$worksheet->getCell('O'.$row)->getValue());
				$Parent_last_name=mysqli_real_escape_string($con,$worksheet->getCell('P'.$row)->getValue());
				$Parent_Email=mysqli_real_escape_string($con,$worksheet->getCell('Q'.$row)->getValue());
				$Parent_mobile=mysqli_real_escape_string($con,$worksheet->getCell('R'.$row)->getValue());
				$batch_name=mysqli_real_escape_string($con,$worksheet->getCell('S'.$row)->getValue());
				$photo=mysqli_real_escape_string($con,$worksheet->getCell('T'.$row)->getValue());
				$Status=mysqli_real_escape_string($con,$worksheet->getCell('U'.$row)->getValue());
				
				$enc_old=md5('123456');
				$Enc_old_password=substr($enc_old, 0,30);

				$unix_date=($Birthdate - 25569) * 86400;
				$Birth_date=gmdate("Y-m-d",$unix_date);

				$unixdate=($Addmission_date - 25569) * 86400;
				$Addmissiondate=gmdate("Y-m-d",$unixdate);
			
				$query1="SELECT enrollment_no FROM student where enrollment_no='".$Enrollment_no."'";
				$res1=mysqli_query($con,$query1);
				if($row1=mysqli_fetch_array($res1))
					{	
						$recodefound.="<div class='Error_red'>Record No ".($i+2)." Enrollment No ".$Enrollment_no." Already Exist</div>";
					}
				else
				{
						$sql ="INSERT INTO student VALUES (NULL,'".$First_Name."','".$Middle_Name."','".$Last_Name."','".$Email."','".$Mobile."','".$Enc_old_password."','".$Gender."','".$Birth_date."','".$Address."','".$City."','".$State."','".$Zipcode."','".$Academic_year."','".$Addmissiondate."','".$Enrollment_no."','".$Parent_first_name."','".$Parent_last_name."','".$Parent_Email."','".$Parent_mobile."','".$Enc_old_password."','".$class1."','".$batch_name."','".$Date."','".$photo."','".$Admin_ID."','".$Status."')";
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