<?php
session_start();
include_once("db.php");
include_once("session_check.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title><?php echo $Company_Name;?> </title>
<!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 10]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="description" content="#">
<meta name="">
<meta name="author" content="#">
<meta http-equiv="refresh" content="300">
<!-- Favicon icon -->
<link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
<!-- Google font--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
<!-- Required Fremwork -->
<link rel="stylesheet" type="text/css" href="bower_components/bootstrap/css/bootstrap.min.css">
<!-- themify-icons line icon -->
<link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
<!-- ico font -->
<link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
<!-- flag icon framework css -->
<link rel="stylesheet" type="text/css" href="assets/pages/flag-icon/flag-icon.min.css">
<!-- Menu-Search css -->
<link rel="stylesheet" type="text/css" href="assets/pages/menu-search/css/component.css">
<!-- Style.css -->
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<style type="text/css">
.widget_text{
text-align: center;font-size: 25px;
}

.bg-c-pink{
background: #f52149;
}

.bg-c-pink:hover{
opacity: 0.5;

}

.bg-c-blue{
background: #3760f7;
}

.bg-c-yellow{
background: #f76300;
}


.text-c-yellow{
color: #f76300;
}
.text-c-sky{
color: #000000;
}



</style>
<!-- Data Table Css -->
<link rel="stylesheet" type="text/css"
href="bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="assets/pages/data-table/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css"
href="bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
<!-- light-box css -->
<link rel="stylesheet" type="text/css" href="bower_components/ekko-lightbox/css/ekko-lightbox.css">
<link rel="stylesheet" type="text/css" href="bower_components/lightbox2/css/lightbox.css">
</head>

<body>
<!-- Pre-loader start -->
<div class="theme-loader">
<div class="ball-scale">
<div class='contain'>
<div class="ring"><div class="frame"></div></div>
<div class="ring"><div class="frame"></div></div>
<div class="ring"><div class="frame"></div></div>
<div class="ring"><div class="frame"></div></div>
<div class="ring"><div class="frame"></div></div>
<div class="ring"><div class="frame"></div></div>
<div class="ring"><div class="frame"></div></div>
<div class="ring"><div class="frame"></div></div>
<div class="ring"><div class="frame"></div></div>
<div class="ring"><div class="frame"></div></div>
</div>
</div>
</div>
<!-- Pre-loader end -->
<div id="pcoded" class="pcoded">
<div class="pcoded-overlay-box"></div>
<div class="pcoded-container navbar-wrapper">

<?php include_once('top_bar.php');?>



<div class="pcoded-main-container">
<div class="pcoded-wrapper">
<?php include_once('sidebar.php');?>
<div class="pcoded-content">
<div class="pcoded-inner-content">
<?php

$count_student=0;
$count_staff=0;
$count_class=0;



$query1="select * from student";
$res1=mysqli_query($con,$query1);
$count_student=mysqli_num_rows($res1);

$query2="select * from staff";
$res2=mysqli_query($con,$query2);
$count_staff=mysqli_num_rows($res2);

$query3="select * from class";
$res3=mysqli_query($con,$query3);
$count_class=mysqli_num_rows($res3);









?>
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">
<div class="row">
<div class="col-md-4 col-xl-4">
<div class="card feed-card">
<div class="card-block p-t-0 p-b-0">
<div class="row">
<div class="col-4 bg-c-blue border-feed">
    <i class="icofont icofont-users f-50"></i>
</div>
<div class="col-8">
    <div class="p-t-30 p-b-30">
        <h2 class="f-w-400 m-b-10 text-center"><?php echo $count_student ;?></h2>
        <p class="text-muted m-0 text-center" style="font-size: 15px;">Total <div class="text-c-blue widget_text f-w-600">Total Student</div></p>
    </div>
</div>
</div>
</div>
</div>
</div>

<div class="col-md-4 col-xl-4">
<div class="card feed-card">
<div class="card-block p-t-0 p-b-0">
<div class="row">
<div class="col-4 bg-c-pink border-feed">
    <i class="icofont icofont-teacher f-50"></i>
</div>
<div class="col-8">
    <div class="p-t-30 p-b-30">
        <h2 class="f-w-400 m-b-10 text-center"><?php echo $count_staff;?></h2>
        <p class="text-muted m-0 text-center" style="font-size: 15px;">Total<div class="text-c-pink widget_text f-w-600">Total Staff</div></p>
    </div>
</div>
</div>
</div>
</div>
</div>

<div class="col-md-4 col-xl-4">
<div class="card feed-card">
<div class="card-block p-t-0 p-b-0">
<div class="row">
<div class="col-4 bg-c-yellow border-feed">
    <i class="icofont icofont-chart-flow-alt-1 f-50"></i>
</div>
<div class="col-8">
    <div class="p-t-30 p-b-30">
        <h2 class="f-w-400 m-b-10 text-center"><?php echo $count_class;?></h2>
        <p class="text-muted m-0 text-center" style="font-size: 15px;">Total<div class="text-c-yellow widget_text f-w-600">Total Class</div></p>
    </div>
</div>
</div>
</div>
</div>
</div>
<!-- card1 start -->


</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>



<!-- Required Jquery -->
<script type="text/javascript" src="bower_components/jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="bower_components/jquery-ui/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="bower_components/popper.js/js/popper.min.js"></script>
<script type="text/javascript" src="bower_components/bootstrap/js/bootstrap.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
<!-- modernizr js -->
<script type="text/javascript" src="bower_components/modernizr/js/modernizr.js"></script>
<script type="text/javascript" src="bower_components/modernizr/js/css-scrollbars.js"></script>
<!-- light-box js -->
<script type="text/javascript" src="bower_components/ekko-lightbox/js/ekko-lightbox.js"></script>
<script type="text/javascript" src="bower_components/lightbox2/js/lightbox.js"></script>
<!-- i18next.min.js -->
<script type="text/javascript" src="bower_components/i18next/js/i18next.min.js"></script>
<script type="text/javascript" src="bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
<script type="text/javascript" src="bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="bower_components/chart.js/js/Chart.js"></script>

<!-- Morris Chart js -->
<script src="bower_components/raphael/js/raphael.min.js"></script>
<script src="bower_components/morris.js/js/morris.js"></script>
<!-- amchart js -->
<script type="text/javascript" src="assets/pages/dashboard/amchart/js/amcharts.js"></script>
<script type="text/javascript" src="assets/pages/dashboard/amchart/js/serial.js"></script>
<script type="text/javascript" src="assets/pages/dashboard/amchart/js/light.js"></script>
<script type="text/javascript" src="assets/pages/dashboard/amchart/js/custom-amchart.js"></script>
<script type="text/javascript" src="bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>

<!-- data-table js -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/pages/data-table/js/jszip.min.js"></script>
<script src="assets/pages/data-table/js/pdfmake.min.js"></script>
<script src="assets/pages/data-table/js/vfs_fonts.js"></script>
<script src="bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="assets/js/pcoded.min.js"></script>
<script src="assets/js/demo-12.js"></script>
<!-- Custom js -->
<script src="assets/pages/data-table/js/data-table-custom.js"></script>

<script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- Custom js -->
<script type="text/javascript" src="assets/js/script.js"></script>

</body>

</html>
