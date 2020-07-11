<?php
session_start();
include_once("db.php");
include_once("session_check.php");

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

<link rel="stylesheet" type="text/css" href="bower_components/datedropper/css/datedropper.css" />

<link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
<style type="text/css">
.discount_chk {
display: none;
}
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
                                                                <h5 style="font-size: 25px;color: #3760f7;">Time Table</h5>
                                                            </div>

                                                            <div style="float:left">
                                                                <a href='#Exam_sub' data-toggle='modal' class="btn btn-primary btn-outline-primary" style="font-weight: 600;">ADD Time Subject</a>
                                                            </div>
                                                            <div style="float:right;">
                                                                <?php if(isset($_GET['class']))
                                                        {
                                                            $class_id=$_GET["class"];
                                                        }
                                                        else{
                                                            $class_id="";
                                                        }
                                                
                                                            ?>
                                                                <form name="form3" method="get" id="form3">
                                                                <select name="class" id="class" required="" class="form-control" onchange="Show_table()">
                                                                    <option value="">Select Class</option>
                                                                    <?php 
                                                                        $query="select * from class order by class_name";
                                                                        $res=mysqli_query($con,$query);
                                                                        while($row=mysqli_fetch_array($res))  
                                                                        { 
                                                                            if($class_id==$row["id"]){
                                                                        ?>
                                                                        <option selected="" value="<?php echo $row["id"];?>">
                                                                            <?php echo $row["class_name"];?>
                                                                        </option>
                                                                        <?php
                                                                    }
                                                                    else{
                                                                        ?><option value="<?php echo $row["id"];?>">
                                                                            <?php echo $row["class_name"];?>
                                                                        </option>
                                                                   <?php }
                                                                                }
                                                                                ?>
                                                                </select>
                                                            </form>
                                                            </div>
                                                            <div class="clearfix"></div>

                                                            <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>
                                                        </div>
                                                        <?php if(isset($_GET['class']))
                                                        {
                                                            $class_id=$_GET["class"];
                                                
                                                            ?>
                                                    
                                                        <div class="card-block">
                                                            <div class="table-responsive">
                                                                <div class="dt-responsive table-responsive">
                                                                    <table id="res-config" class="table table-striped table-bordered nowrap">
                                                                        <thead>
                                                                            <tr>
                                                                    
                                                                                <th>Day/TIme</th>
                                                                                <?php 
                                                                                $query="select * from time";
                                                                                $res=mysqli_query($con,$query);
                                                                                $array_time=array();
                                                                                while($row=mysqli_fetch_array($res))
                                                                                {
                                                                                    $array_time[]=$row["no"];
                                                                                    ?>
                                                                                <th>
                                                                                <?php echo $row["no"]."[".$row["timing"]."]";?>
                                                                                </th>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                                

                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            
                                                                                
                                                                                    <?php
                                                                            
$array=array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
$i=0;
?>
<?php while ($i<count($array))
{?><tr>
<td><?php echo $array[$i];?></td>
<?php
$j=0; 
while($j<count($array_time))
{
$sql="SELECT t.*,a.class_id,a.staff_id,a.subject_id FROM `time_table` t,`assign_subject` a where t.`assign_id`=a.id and a.class_id='".$class_id."' and t.day='".$array[$i]."' and t.time='".$array_time[$j]."'" ;
$query2=mysqli_query($con, $sql);
?>
<td>
<?php
 while($row2=mysqli_fetch_array($query2))
 {
    $sql5 = "SELECT * from  assign_subject where id='".$row2["assign_id"]."'";
    $query5=mysqli_query($con, $sql5) or die("assign_subject");
    $row5=mysqli_fetch_array($query5);

    $sql3 = "SELECT * from  subject where id='".$row5["subject_id"]."'";
    $query3=mysqli_query($con, $sql3) or die("subject");
    $row3=mysqli_fetch_array($query3);

    $sql4 = "SELECT * from  staff where id='".$row5["staff_id"]."'";
    $query4=mysqli_query($con, $sql4) or die("staff");
    $row4=mysqli_fetch_array($query4);
    ?>
    

     <a href='#Exam_sub'  data-toggle='modal' class="edit_model_btn"  data-id='<?php echo $row2["id"]; ?>'><?php echo $row3["sub_name"]."{".$row5["batch_name"]."}</br>[".$row4["first_name"]."]";?></a><hr></br>
 <?php
}?>
</td>
<?php $j++;
}?>   
<?php $i++;
}?>


                                                                            
                                                                                
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
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

    <div class="modal fade" id="Exam_sub" tabindex="-1" role="dialog" style="z-index: 5000">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form2" name="form2" method="post">
                    <div class="modal-header">ADD Time Subjectt</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Select Time</label>
                            <div class="col-sm-8">
                                
                                <div id="time1">
                                <select name="time" id="time" required="" class="form-control">
                                    <option value="">Select Time</option>
                                    <?php 
                                                                            $query="select * from time";
                                                                            $res=mysqli_query($con,$query);
                                                                            while($row=mysqli_fetch_array($res))
                                                                            {
                                                                            ?>
                                        <option value="<?php echo $row["id"];?>">
                                            <?php echo $row["no"]."[".$row["timing"]."]";?>
                                        </option>
                                        <?php
                                                                            }
                                                                            ?>
                                </select>
                            </div>
                            <input type="hidden" id="Action1" name="Action1" value="ADD">
                                <input type="hidden" id="ID1" name="ID1" value="">
                        </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Class Name</label>
                            <div class="col-sm-8">
                                <select name="class_name1" id="class_name1" required="" class="form-control" onchange="class_name()">
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
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Assign Subject Name</label>
                            <div class="col-sm-8">
                                <div id="assign1">
                                    <select name="ass_sub_name" id="ass_sub_name" required="" class="form-control">
                                        <option value="">Select Subject Name</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">DAY</label>
                            <div class="col-sm-8">
                                <div id="day1" >
                                <select name="day" id="day" required="" class="form-control">
                                    <option value="">Select Day</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    
                                </select>
                            </div>
                        </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <div id="button_div" style="display: block;">
                            <button type="button" data-dismiss="modal" class="btn btn-warning btn-round" ">Close</button>
            <button type="submit " class="btn btn-primary btn-round "" id="btn_save" name="btn_save">Save changes</button>
                        </div>
                        <div id="ajax_loader" style="display: none;"><img src="img/loader.gif" style="height: 80px;"></div>
                    </div>

                </form>
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
<!-- Date Dropper -->
<script type="text/javascript" src="bower_components/datedropper/js/datedropper.js"></script>

<script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- Custom js -->
<script type="text/javascript" src="assets/js/script.js"></script>
    <script type="text/javascript">
        function class_name() {
            var id = $("#class_name1").val();
            $.ajax({
                type: "post",
                url: "Assign_select.php",
                data: "id="+id,
                success: function(data) {
                    $("#assign1").html(data);
                },
                async: false

            });
        }


        $(document).on("click", ".edit_model_btn", function() {
            var id = $(this).data('id');
            $("#ID1").val(id); // assign category id val
            $("#Action1").val("Display"); // Action EDIT
            var formData = new FormData($('#form2')[0]);
            $.ajax({
                url: 'AddEdit_Time_Sub.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    var split_hash = data.split("##");
                    var message = split_hash[0];
                    var id = split_hash[1];
                    var time_id = split_hash[2];
                    var class_name1 = split_hash[3];
                    var assign_id = split_hash[4];
                    var day = split_hash[5];
                    

                    $("#time1").html("<input class='form-control' type='text' name='time' id='time' value='"+time_id+"' >");
                    document.getElementById('time').readOnly=true;
                    $("#class_name1").val(class_name1);
                    class_name();
                    $("#ass_sub_name").val(assign_id);
                    $("#day1").html("<input class='form-control' type='text' name='day' id='day' value='"+day+"' >");
                    document.getElementById('day').readOnly=true;
                    $("#Action1").val("EDIT");
                }
            });

        });

        $("#form2").submit(function(e) {
            e.preventDefault();

            $("#button_div").hide();
            $("#ajax_loader").show();
            var formData = new FormData(this);
            //formData.append("Action", "ADD");

            $.ajax({
                type: "post",
                url: "AddEdit_Time_Sub.php",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.trim() == "Success") {
                        $('#Exam_sub').modal('toggle');
                        var table = $('#res-config').DataTable();
                        table.draw();
                        swal("Completed", "You clicked the button!", "success");
                        $("#button_div").show();
                        $("#ajax_loader").hide();
                        $("#form2")[0].reset();
                        // $("#Action").val("ADD");
                    }
                },
                async: false
            });
        });

          $('#Exam_sub').on('hidden.bs.modal', function() {

            $("#form2")[0].reset(); //reset form data
            $("#Action1").val("ADD"); //Add Action
            window.location="";

        })

          function Show_table(){
            $("#form3").submit();
          }

    </script>

</body>

</html>