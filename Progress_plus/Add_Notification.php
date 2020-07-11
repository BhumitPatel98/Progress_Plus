<?php
session_start();
include_once("db.php");
include_once("session_check.php");
if(isset($_REQUEST["id"]))
{
$id=$_REQUEST["id"];  
}
else
{
$id="";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>
    <?php echo $Company_Name;?>
</title>
<!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 10]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description" content="#">
<meta name="">
<meta name="author" content="#">
<!-- Favicon icon -->
<link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
<!-- Google font-->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
<!-- Required Fremwork -->
<link rel="stylesheet" type="text/css" href="bower_components/bootstrap/css/bootstrap.min.css">
<!-- themify-icons line icon -->
<link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
<!-- ico font -->
<link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
<link rel="stylesheet" type="text/css" href="assets/icon/material-design/css/material-design-iconic-font.min.css">
<!-- flag icon framework css -->
<link rel="stylesheet" type="text/css" href="assets/pages/flag-icon/flag-icon.min.css">
<!-- Menu-Search css -->
<link rel="stylesheet" type="text/css" href="assets/pages/menu-search/css/component.css">
<!-- Style.css -->
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<!-- sweet alert framework -->
<link rel="stylesheet" type="text/css" href="bower_components/sweetalert/css/sweetalert.css">
<!-- Switch component css -->
<link rel="stylesheet" type="text/css" href="bower_components/switchery/css/switchery.min.css">
<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="assets/pages/data-table/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">

<!-- Select 2 css -->
<link rel="stylesheet" href="bower_components/select2/css/select2.min.css" />
<!-- Multi Select css -->
<link rel="stylesheet" type="text/css" href="bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css" />
<link rel="stylesheet" type="text/css" href="bower_components/multiselect/css/multi-select.css" />

<link rel="stylesheet" type="text/css" href="bower_components/datedropper/css/datedropper.min.css" />

<link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
<!-- Date Css -->
<link rel="stylesheet" type="text/css" href="assets/css/datepicker.css">
<style type="text/css">
    .discount_chk {
        display: none;
    }
</style>
</head>

<body>
<!-- Pre-loader start -->
<div class="theme-loader">
    <div class="ball-scale">
        <div class='contain'>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
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

                                <div class="main-body">
                                    <div class="page-wrapper">
                                        <div class="page-body">
                                            <div class="row">

                                                <!-- card1 start -->

                                                <div class="col-md-12 col-xl-12">
                                                    <div class="card">
                                                        <div class="card-header">

                                                            <div class="card-block">
                                                                <div class="row">
                                                                    <div class="col-sm-8" style="margin: 0px">
                                                                        <?php

                                                                         ?>
                                                                        <form id="form1" name="form1" method="post" enctype="multipart/form-data">
                                                                            <div class="col-sm-12">
                                                                                <h4 class="sub-title" style="color: #4881ff">Notification:</h4>
                                                                                <div class="form-group row">
                                                                                    <label class="col-sm-4 col-form-label">Message To:<span style="color:red;display:inline;">&nbsp;*</span></label>
                                                                                    <div class="col-sm-8">
                                                                                        <div class="form-radio">

                                                                                            <div class="radio radio-inline">
                                                                                                <label>
                                                                                                    <input type="radio" class="college" id="mass1" name="mass" checked="checked" onchange="show_dept()" value="All_dept" required="">
                                                                                                    <i class="helper"></i>All Department
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="radio radio-inline">
                                                                                                <label>
                                                                                                    <input type="radio" class="department1" id="mass2" name="mass" onchange="show_dept(),check_class()" value="Department">
                                                                                                    <i class="helper"></i>Department
                                                                                                </label>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div id="dept" style="display:none;">
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-4 col-form-label">Department Name</label>
                                                                                        <div class="col-sm-8">
                                                                                            <select name="department" id="department"  class="form-control" onchange="check_class()">
                                                                                                <option value="">Select Department </option>
                                                                                                <?php 
                                                                    $query="select * from department";
                                                                    $res=mysqli_query($con,$query);
                                                                    while($row=mysqli_fetch_array($res))
                                                                    {
                                                                    ?>
                                                                                                    <option value="<?php echo $row["department_code"];?>">
                                                                                                        <?php echo $row["department_name"];?>
                                                                                                    </option>
                                                                                                    <?php
                                                                    }
                                                                    ?>
                                                                                            </select>

                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-4 col-form-label">Message To:</label>
                                                                                        <div class="col-sm-8">
                                                                                            <div class="form-radio">
                                                                                                <div class="radio radio-inline">
                                                                                                    <label>
                                                                                                        <input type="radio" id="radio1" checked="checked" name="radio1" value="All">
                                                                                                        <i class="helper"></i>All
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div class="radio radio-inline">
                                                                                                    <label>
                                                                                                        <input type="radio" id="radio1" name="radio1" value="Staff">
                                                                                                        <i class="helper"></i>Staff
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div class="radio radio-inline">
                                                                                                    <label>
                                                                                                        <input type="radio" class="Student" id="radio1" name="radio1" value="Student">
                                                                                                        <i class="helper"></i>Student
                                                                                                    </label>
                                                                                                </div>

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-4 col-form-label">Class Name</label>
                                                                                        <div class="col-sm-8">
                                                                                            <div id="class1">
                                                                                                <select class="multiselect" id="class_name1" name="class_name1">
                                                                                                <option value="">Select Class</option>
                                                                                            </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="hidden" id="Action" name="Action" value="ADD">
                                                                                <input type="hidden" id="ID" name="ID" value="<?php echo $id;?>">
                                                                            </div>

                                                                            <div class="clearfix"></div>
                                                                            <div class="col-sm-12">

                                                                                <h4 class="sub-title" style="color: #4881ff">Notification Details</h4>

                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-2 col-form-label text-center">Title:<span style="color:red;display:inline;">&nbsp;*</span></label>
                                                                                            <div class="col-sm-10">
                                                                                                <input type="text" class="form-control" name="title" id="title" placeholder="Title" required="">
                                                                                                <span class="messages"></span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <!-- Row End -->

                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-2 col-form-label text-center">Message:<span style="color:red;display:inline;">&nbsp;*</span></label>
                                                                                            <div class="col-sm-10">
                                                                                                <input type="text" class="form-control" name="massage" id="massage" placeholder="Message" required="">
                                                                                                <span class="messages"></span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- Row End -->

                                                                                <div class="row">
                                                                                    <div class="col-sm-6">
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-4 col-form-label text-center">From Date:<span style="color:red;display:inline;">&nbsp;*</span></label>
                                                                                            <div class="col-sm-8">
                                                                                                <input type="text" class="form-control datepicker" name="f_date" id="f_date" placeholder="dd-mm-yyyy" required="">
                                                                                                <span class="messages"></span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-sm-6">
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-4 col-form-label text-center">To Date:<span style="color:red;display:inline;">&nbsp;*</span></label>
                                                                                            <div class="col-sm-8">
                                                                                                <input type="text" class="form-control datepicker" name="t_date" id="t_date" placeholder="dd-mm-yyyy" required="">
                                                                                                <span class="messages"></span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                <!-- Row End -->

                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-2 col-form-label text-center">Attchment:<span style="color:red;display:inline;">&nbsp;*</span></label>
                                                                                            <div class="col-sm-10">
                                                                                                <input type="file" name="file1" id="file1"  class="form-control" required="">
                                                                                                <span class="messages"></span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- Row End -->

                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-2 col-form-label text-center">Attchment:</label>
                                                                                            <div class="col-sm-10">
                                                                                                <input type="file" name="file2" id="file2"  class="form-control">
                                                                                                <span class="messages"></span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- Row End -->

                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-2 col-form-label text-center">Attchment:</label>
                                                                                            <div class="col-sm-10">
                                                                                                <input type="file" name="file3" id="file3"  class="form-control">
                                                                                                <span class="messages"></span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- Row End -->

                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-2 col-form-label text-center">Attchment:</label>
                                                                                            <div class="col-sm-10">
                                                                                                <input type="file" name="file4" id="file4"  class="form-control">
                                                                                                <span class="messages"></span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- Row End -->

                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-2 col-form-label text-center">Attchment:</label>
                                                                                            <div class="col-sm-10">
                                                                                                <input type="file" name="file5" id="file5"  class="form-control">
                                                                                                <span class="messages"></span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- Row End -->

                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-2 col-form-label text-center">Type:<span style="color:red;display:inline;">&nbsp;*</span></label>
                                                                                            <div class="col-sm-10">
                                                                                                <div class="checkbox-fade fade-in-primary">
                                                                                                    <label>
                                                                                                        <input type="checkbox" id="type" name="type">
                                                                                                        <span class="cr">
                                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                                </span>
                                                                                                        <span>Send Massage On Phone</span>
                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- Row End -->

                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-2 col-form-label text-center">Massage:<span style="color:red;display:inline;">&nbsp;*</span></label>
                                                                                            <div class="col-sm-10">
                                                                                                <textarea name="massage1" id="massage1" class="form-control"></textarea>
                                                                                                <span class="messages"></span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- Row End -->

                                                                            </div>
                                                                            <!-- Col-12 End -->
                                                                            <div class="text-center">
                                                                                <div id="button_div" style="display: block;">
                                                                                    <button type="submit" class="btn btn-primary btn-round" id="btn_save " name="btn_save ">Save changes</button>
                               <button type="button" class="btn btn-warning btn-round">Cancel</button>
                                                                                    <div id="ajax_loader" style="display: none;"><img src="img/loader.gif" style="height: 80px;"></div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                <!-- Row End -->
                                                            </div>
                                                        </div>

                                                        <!-- card1 End -->

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
    </div>
</div>

<!-- Warning Section Starts -->
<!-- Older IE warning message -->
<!--[if lt IE 10]>
<div class="ie-warning">
<h1>Warning!!</h1>
<p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers
to access this website.</p>
<div class="iew-container">
<ul class="iew-download">
<li>
<a href="http://www.google.com/chrome/">
<img src="assets/images/browser/chrome.png" alt="Chrome">
<div>Chrome</div>
</a>
</li>
<li>
<a href="https://www.mozilla.org/en-US/firefox/new/">
<img src="assets/images/browser/firefox.png" alt="Firefox">
<div>Firefox</div>
</a>
</li>
<li>
<a href="http://www.opera.com">
<img src="assets/images/browser/opera.png" alt="Opera">
<div>Opera</div>
</a>
</li>
<li>
<a href="https://www.apple.com/safari/">
<img src="assets/images/browser/safari.png" alt="Safari">
<div>Safari</div>
</a>
</li>
<li>
<a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
<img src="assets/images/browser/ie.png" alt="">
<div>IE (9 & above)</div>
</a>
</li>
</ul>
</div>
<p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
<!-- Warning Section Ends -->
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
<!--Date is -->
<script type="text/javascript" src="assets/js/bootstrap-datepicker.js"></script>
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
<!-- Switch component js -->
<script type="text/javascript" src="bower_components/switchery/js/switchery.min.js"></script>
<!-- sweet alert js -->
<script type="text/javascript" src="bower_components/sweetalert/js/sweetalert.min.js"></script>
<script type="text/javascript" src="assets/js/modal.js"></script>
<script src="assets/js/pcoded.min.js"></script>
<script src="assets/js/demo-12.js"></script>
<!-- Custom js -->
<script src="assets/pages/data-table/js/data-table-custom.js"></script>
<script type="text/javascript" src="bower_components/datedropper/js/datedropper.min.js"></script>

<!-- Select 2 js -->
<script type="text/javascript" src="bower_components/select2/js/select2.full.min.js"></script>
<!-- Multiselect js -->
<script type="text/javascript" src="bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>

<script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- Custom js -->
<script type="text/javascript" src="assets/js/script.js"></script>

<script type="text/javascript">
    function show_dept() {

        if ($(".department1").prop("checked") == true) {

            $("#dept").show();

        } else if ($(".department1").prop("checked") == false) {

            $("#dept").hide();

        }
    }

    function check_class() {
        var id = $("#department").val();
        $.ajax({
            type: "post",
            url: "Check.php",
            data: "id=" + id + "&Type=check_class",
            success: function(data) {
                $("#class1").html(data);
                $(".multiselect").select2({
                    placeholder: "Select Your Class"
                });

            },
            async: false
        });
    }

function Display()
{
var id=$("#ID").val(); // assign category id val
$("#Action").val("Display"); // Action EDIT

$.ajax({
url: 'AddEdit_Notification.php',
type: 'POST',
data: 'ID='+id+'&Action=Display',

success: function(data) {
var split_hash=data.split("##");
                      var message=split_hash[0];
                      var notice_board_id=split_hash[1];
                      var title=split_hash[2];
                      var message=split_hash[3];
                      var formdate=split_hash[4];
                      var todate=split_hash[5];
                      var notice_for=split_hash[6];
                      var department=split_hash[7]
                      var class_list=split_hash[8];
                      var attatchment1=split_hash[9];
                      var attatchment2=split_hash[10];
                      var attatchment3=split_hash[11]
                      var attatchment4=split_hash[12];
                      var attatchment5=split_hash[13];
                      var add_by=split_hash[14];
                      var user_id=split_hash[15];
                      var date=split_hash[16];

                      $("#title").val(title);
                      $("#massage").val(message);
                      $("#f_date").val(formdate);
                      $("#t_date").val(todate);
                   
                     if(notice_for!='All_dept')
                     {
                         $('input:radio[value="Department"]').prop('checked', true);
                         show_dept();
                         $("#department").val(department);
                         check_class();
                         $('input:radio[value='+notice_for+']').prop('checked', true);
                     }
                     else
                     {
                       $("#dept").hide()
                     }
                      alert(notice_for);
                      $("#Action").val("EDIT");
}
});
}



    $("#form1").submit(function(e) {
        e.preventDefault();
        var classs =$("#class_name1").val();
        alert($("#class_name1").val());
        $("#button_div").hide();
        $("#ajax_loader").show();
        var formData = new FormData(this);
        formData.append("ClassNM", classs);
        $.ajax({
            type: "post",
            url: "AddEdit_Notification.php",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.trim() == "Success") {
                    swal("Completed", "You clicked the button!", "success");
                    $("#button_div").show();
                    $("#ajax_loader").hide();
                    $("#form1")[0].reset();
                    //$("#Action").val("EDIT");
                    window.location = "Notification.php";
                }
            },
            async: false
        });
    });
</script>
        <script>
            $(function() {
                $(".datepicker").dateDropper({
                    dropWidth: 200,
                    init_animation: "bounce",
                    dropPrimaryColor: "#1abc9c",
                    dropBorder: "1px solid #1abc9c"
                });
            });
        </script>
                <?php
if(isset($_REQUEST["id"]))
{
$id=$_REQUEST["id"];
?>
    <script type="text/javascript">
        Display();
    </script>
    <?php

}
?>
</body>

</html>