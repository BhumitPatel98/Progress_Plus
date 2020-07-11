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
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">

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

                                                    <div class="text-center">
                                                        <h5 class="sub-title" style="font-size: 25px;color: #3760f7;">Student</h5>
                                                    </div>

                                                    <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>
                                                </div>
                                                <div class="card-block">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            
                                                            <form id="form1" name="form1" method="post" enctype="multipart/form-data">
                                                                <div class="col-sm-12">
                                                                	<h4 class="sub-title" style="color: #4881ff">Class Name:<span style="color: red;">*</span></h4>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-11">
                                                                            <select name="class_name" id="class_name" required="" class="form-control">
                                                                                <option value="">Select Class</option>
                                                                                <?php 
                                                                                    $query="select * from class";
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
                                                                             <input type="hidden"  id="Action" name="Action" value="ADD">
                                                                             <input type="hidden"  id="ID" name="ID" value="<?php echo $id;?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <h4 class="sub-title" style="color: #4881ff">Name:<span style="color: red;">*</span></h4>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-4">

                                                                            <div class="col-sm-12">
                                                                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-3">

                                                                            <div class="col-sm-12">
                                                                                <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name" required="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="col-sm-12">
                                                                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required="">
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <div class="col-sm-12">

                                                                    <h4 class="sub-title" style="color: #4881ff">Student Information</h4>
                                                                  

                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-3 col-form-label">Email:<span style="color: red;">*</span></label>
                                                                                <div class="col-sm-7">
                                                                                    <input type="text" class="form-control" name="email" id="email" placeholder="Email" data-validation="email" required="">
                                                                                    <span class="messages"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-6">
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-3 col-form-label">Mobile No:<span style="color: red;">*</span></label>
                                                                                <div class="col-sm-7">
                                                                                    <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile No" data-validation="number,length"  data-validation-length="10" required="">
                                                                                    <span class="messages"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>  <!-- Row End -->
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-3 col-form-label">Enrollment No:<span style="color: red;">*</span></label>
                                                                                <div class="col-sm-7">
                                                                                    <input type="text" class="form-control" name="enrollment" id="enrollment" placeholder="Enrollment No" onblur="enroll()" data-validation="number,length"  data-validation-length="12" required="">
                                                                                    <div id="dept_code_mas" style="color:#F00;font-weight:600;display: none;">Already Exist.Enter Different Values</div>
                                                                                    <span class="messages"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-6">
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-3 col-form-label">Birth Date:<span style="color: red;">*</span></label>
                                                                                <div class="col-sm-7">
                                                                                    <input type="text" class="form-control datepicker" name="birth" id="birth" required="">
                                                                                    <span class="messages"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>  <!-- Row End -->

                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-3 col-form-label">Gender:<span style="color: red;">*</span></label>
                                                                                <div class="col-sm-7">
                                                                                    <input type="radio" class="form-radio" name="gender" id="gender" value="Male" checked><label>Male</label>     
                                                                                    <input type="radio" class="form-radio" name="gender" id="gender" value="Female"><label>Female</label>
                                                                                    <span class="messages"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-6">
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-3 col-form-label">Academic year:<span style="color: red;">*</span></label>
                                                                                <div class="col-sm-7">
                                                                                    <input type="text" class="form-control" name="academic_year" id="academic_year" placeholder="Academic year" required="">
                                                                                    <span class="messages"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>  <!-- Row End -->


                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-3 col-form-label">Admission Date:<span style="color: red;">*</span></label>
                                                                                <div class="col-sm-7">
                                                                                    <input type="text" class="form-control datepicker" name="admission_date" id="admission_date" required="">
                                                                                    <span class="messages"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-6">
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-3 col-form-label">Batch Name:</label>
                                                                                <div class="col-sm-7">
                                                                                    <input type="text" class="form-control" name="batch_name" id="batch_name" placeholder="Batch Name">
                                                                                    <span class="messages"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>  <!-- Row End -->

                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-3 col-form-label">Address:<span style="color: red;">*</span></label>
                                                                                <div class="col-sm-7">
                                                                                    <input type="text" class="form-control" name="address" id="address" placeholder="Address" required="">
                                                                                    <span class="messages"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-6">
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-3 col-form-label">City:<span style="color: red;">*</span></label>
                                                                                <div class="col-sm-7">
                                                                                    <input type="text" class="form-control" name="city" id="city" placeholder="City" required="">
                                                                                    <span class="messages"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>  <!-- Row End -->

                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-3 col-form-label">State:<span style="color: red;">*</span></label>
                                                                                <div class="col-sm-7">
                                                                                    <input type="text" class="form-control" name="state" id="state" placeholder="State" required="">
                                                                                    <span class="messages"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-6">
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-3 col-form-label">Zipcode:<span style="color: red;">*</span></label>
                                                                                <div class="col-sm-7">
                                                                                    <input type="text" class="form-control" name="zipcode" id="zipcode" placeholder="Zipcode" data-validation="number,length"  data-validation-length="6" required="">
                                                                                    <span class="messages"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>  <!-- Row End -->


                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-3 col-form-label">Status:<span style="color: red;">*</span></label>
                                                                                <div class="col-sm-7">
                                                                                     <input type="checkbox" id="status" name="status">
                                                                                    <span class="messages"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>  <!-- Row End -->
                                                                </div>  <!-- Col-12 End -->
                                                                <hr/>


                                                                <div class="col-sm-12">
                                                                    <h4 class="sub-title" style="color: #4881ff">Parent's Information</h4>

                                                                   
                                                                    <div class="form-group row">
                                                                    	<label class="col-sm-12 col-form-label">Parent's Name:<span style="color: red;">*</span></label>
                                                                        <div class="col-sm-6">
                                                                            <div class="col-sm-12">
                                                                                <input type="text" class="form-control" id="p_firstname" name="p_firstname" placeholder="Parent's First Name" required="">
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-sm-6">
                                                                            <div class="col-sm-12">
                                                                                <input type="text" class="form-control" id="p_lastname" name="p_lastname" placeholder="Parent's Last Name" required="">
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-3 col-form-label">Parent's Email:<span style="color: red;">*</span></label>
                                                                                <div class="col-sm-7">
                                                                                    <input type="text" class="form-control" name="p_email" id="p_email" placeholder="Parent's Email" data-validation="email" required="">
                                                                                    <span class="messages"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-6">
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-3 col-form-label">Parent's Mobile:<span style="color: red;">*</span></label>
                                                                                <div class="col-sm-7">
                                                                                    <input type="text" class="form-control" name="p_mobile" id="p_mobile" placeholder="Parent's Mobile" data-validation="number,length"  data-validation-length="10" required="">
                                                                                    <span class="messages"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>  <!-- Row End -->
                                                                </div>  <!-- Col-12 End -->
                                                               <div class="text-center">
                                                            <div id="button_div" style="display: block;">
                <button type="submit" class="btn btn-primary btn-round" id="btn_save" name="btn_save">Save changes</button>
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
    <!-- Form Validator-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
    <!-- Custom js -->
    <script src="assets/pages/data-table/js/data-table-custom.js"></script>
    <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Swithces --> 
    <script type="text/javascript" src="assets/pages/advance-elements/swithces.js"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="assets/js/script.js"></script>
    <script>
        $( function() {
        $( ".datepicker" ).datepicker({ 
            format: "dd/mm/yyyy",
          autoclose: true
         });
        } );
        $.validate({
    modules : 'security',
    onModulesLoaded : function() {
      //$('#country').suggestCountry();
    }
  });
var elem = document.querySelector('#status');
var init = new Switchery(elem);
elem.onchange = function() {
};
    </script>
    <script type="text/javascript">

function enroll()
{
  var code = $("#enrollment").val();
   $.ajax({   
            type:"post",
            url:"Check.php",
            data:"id="+code+"&Type=student", 
            success: function(data)
            {
              if(data == "Found")
              {
                $("#dept_code_mas").show();
                $("#enrollment").val("");
              }
              else
              {
                $("#dept_code_mas").hide();
              }
            },
            async:false

        });
}
   
function Display()
{

var id=$("#ID").val(); // assign category id val
$("#Action").val("Display"); // Action EDIT

$.ajax({
    url: 'AddEdit_Student.php',
    type: 'POST',
    data: 'ID='+id+'&Action=Display',
    
    success: function(data) {
        var split_hash = data.split("##");
        var message = split_hash[0];
        var student_id = split_hash[1];
        var first_name = split_hash[2];
        var middle_name = split_hash[3];
        var last_name = split_hash[4];
        var email = split_hash[5];
        var mobile = split_hash[6];
        var password = split_hash[7];
        var gender = split_hash[8];
        var birthdate = split_hash[9];
        var address = split_hash[10];
        var city = split_hash[11];
        var state = split_hash[12];
        var zipcode = split_hash[13];
        var academic_year = split_hash[14];
        var admission_date = split_hash[15];
        var enrollment_no = split_hash[16];
        var parent_first_name = split_hash[17];
        var parent_last_name = split_hash[18];
        var parent_email = split_hash[19];
        var parent_mobile = split_hash[20];
        var class_id = split_hash[21];
        var batch_name = split_hash[22];
        var date = split_hash[23];
        var user_id = split_hash[24];
        var status = split_hash[25];

        $("#first_name").val(first_name);
        $("#middle_name").val(middle_name);
        $("#last_name").val(last_name);
        $("#email").val(email);
        $("#mobile").val(mobile);
        $("#academic_year").val(academic_year);
        $("#birth").val(birthdate);
        $("#admission_date").val(admission_date);
        $("#enrollment").val(enrollment_no);
        $("#p_firstname").val(parent_first_name);
        $("#p_lastname").val(parent_last_name);
        $("#p_email").val(parent_email);
        $("#p_mobile").val(parent_mobile);
        $("#class_name").val(class_id);
        $("#batch_name").val(batch_name);
        $("#address").val(address);
        $("#city").val(city);
        $("#state").val(state);
        $("#zipcode").val(zipcode);
        $('input:radio[value='+gender+']').prop('checked', true);
        $("#status").val(status);
        var is_chk=elem.checked;                     
        if(status=="Active")
        {
        
            if(is_chk==false)
            {
                $('#status').trigger('click');
                    
                    $('#status').attr('checked', true);
            }   
        }
        else
        {
            if(is_chk==true)
            {
                $('#status').trigger('click');
                $('#status').attr('checked', false);
                
            } 
        }  
        $("#Action").val("EDIT");
    }
});
}
    $("#form1").submit(function(e) {
    e.preventDefault();
    $("#button_div").hide();
    $("#ajax_loader").show();
    var formData = new FormData(this);
    var s=elem.checked;
    if(s==true)
    {
        new_status1="Active";
    }
    else
    {
        new_status1="Detain";   
    }
    formData.append("new_status",new_status1);
    $.ajax({
        type: "post",
        url: "AddEdit_Student.php",
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
                window.location="Student.php";
            }
        },
        async: false
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