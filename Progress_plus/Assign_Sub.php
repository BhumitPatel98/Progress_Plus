<?php
session_start();
include_once("db.php");
include_once("session_check.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
<title><?php echo $Company_Name;?></title>
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
<!-- Favicon icon -->
<link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
<!-- Google font--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
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
<link rel="stylesheet" type="text/css"
href="bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="assets/pages/data-table/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css"
href="bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
<style type="text/css">
.discount_chk{
display: none;
}
</style>
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

<div class="main-body">
<div class="page-wrapper">
<div class="page-body">
<div class="row">

<!-- card1 start -->

<div class="col-md-12 col-xl-12">                         
<div class="card">
<div class="card-header">

<div class="text-center">
<h5 style="font-size: 25px;color: #3760f7;">Assign Subject</h5>
</div>

<div class="pull-left">
<a href='#default-Modal'  data-toggle='modal' class="btn btn-primary btn-outline-primary" style="font-weight: 600;">ADD Assign Subject</a>
</div>

<div class="card-header-right"><i
class="icofont icofont-spinner-alt-5"></i></div>
</div>
<div class="card-block">
<div class="table-responsive">
<div class="dt-responsive table-responsive">
<table id="res-config" class="table table-striped table-bordered nowrap">
<thead>
<tr>
<!--  <td><input type="checkbox" name="CheckAll" id="CheckAll" value="Select All"></td> -->
<th>Staff Name</th>
<th>Class Name</th>
<th>Subject Name</th>
<th>Batch Name</th>
<th></th>
<th></th>


</tr>
</thead>
<tbody>
<tr>
<!--   <td></td> -->
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
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

<div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
<div class="modal-content">
<form id="form1" name="form1" method="post">
<div class="modal-header">
<h4 class="modal-title ">Assign Subject</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">              

<div class="form-group row">
<label class="col-sm-4 col-form-label">Department Name<span style="color: red;">*</span></label>
<div class="col-sm-8">
<select name="dept_name" id="dept_name" required="" class="form-control" onchange="check_class()">
<option value="">Select Department</option>
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
<input type="hidden"  id="Action" name="Action" value="ADD" >
<input type="hidden"  id="ID" name="ID" >
</div>
</div>

<div class="form-group row">
<label class="col-sm-4 col-form-label">Class Name<span style="color: red;">*</span></label>
<div class="col-sm-8">
<div id="class1">
<select name="class_name" id="class_name" required="" class="form-control">
<option value="">Select Class</option>

</select>
</div>
</div>
</div>

<div class="form-group row">
<label class="col-sm-4 col-form-label">Staff Name<span style="color: red;">*</span></label>
<div class="col-sm-8">
<div id="show_staff">
<select name="staff_name" id="staff_name" required="" class="form-control" onchange="check_subject()">
<option value="">Select Staff</option>

</select>
</div>
</div>
</div>

<div class="form-group row">
<label class="col-sm-4 col-form-label">Subject Name<span style="color: red;">*</span></label>
<div class="col-sm-8">
  <div id="show_sub">
<select name="subject_name" id="subject_name" required="" class="form-control">
<option value="">Select Subject</option>

</select>
</div>
</div>
</div>  
<div id="batch1" style="display: none;">
<div class="form-group row">
<label class="col-sm-4 col-form-label">Batch Name<span style="color: red;">*</span></label>
<div class="col-sm-8">
<div id="batch2">
<select name="batch_name" id="batch_name" class="form-control">
<option value="">Select Batch</option>
</select>
</div>
</div> 
</div>
</div>

<div class="modal-footer">
<div id="button_div" style="display: block;">
<button type="button" data-dismiss="modal" class="btn btn-warning btn-round">Close</button>
<button type="submit" class="btn btn-primary btn-round" id="btn_save" name="btn_save">Save changes</button>
</div>
<div id="ajax_loader" style="display: none;"><img src="img/loader.gif" style="height: 80px;"></div>
</div>
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

<script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- Custom js -->
<script type="text/javascript" src="assets/js/script.js"></script>
<script type="text/javascript">
  function check_class()
  {
    var name1 = $("#dept_name").val();
   $.ajax({   
            type:"post",
            url:"Subject_Batch.php",
            data:"id="+name1+"&Type=check_class1", 
            success:function(data) {
            var split_data= data.split("@@@");
            var data1=split_data[0];
            var data2=split_data[1];
            $("#class1").html(data1);
            $("#show_staff").html(data2);
                    },
                    async: false
                });
  }
  function check_subject()
  {
    var name1 = $("#class_name").val();
   $.ajax({   
            type:"post",
            url:"Subject_Batch.php",
            data:"id="+name1+"&Type=check_Subject", 
            success:function(data) {
                        $("#show_sub").html(data); 
                    },
                    async: false
                });
  }

  function Subject_Batch()
  {
     var name1 = $("#class_name").val();
   $.ajax({   
            type:"post",
            url:"Subject_Batch.php",
            data:"id="+name1+"&Type=check_batch", 
            success:function(data) {
              
                        $("#batch2").html(data); 
                    },
                    async: false
                });
  }

function check_batch()
{
  var code = $("#subject_name").val();
   $.ajax({   
            type:"post",
            url:"Subject_Batch.php",
            data:"id="+code+"&Type=batch", 
            success: function(data)
            {
              if(data == "Found")
              {
                $("#batch1").show();
                check_batch1();
              }
              else
              {
                $("#batch1").hide();
                $("#batch_name").val("");
              }
            },
            async:false

        });
}
function check_batch1()
{
  var name1=$("#class_name").val();
   $.ajax({   
            type:"post",
            url:"Subject_Batch.php",
            data:"id="+name1+"&Type=check_batch", 
            success:function(data) {
                        $("#batch2").html(data); 
                    },
                    async: false
                });
}

function Display_Category()
{      
var dataTable = $('#res-config').DataTable( {
"processing": true,
"serverSide": true,
"responsive": true,

// dom: "<'row'<'col-sm-6'p><'col-sm-3'l><'col-sm-3'f>>" +
//   "<'row'<'col-sm-12'tr>>" +
//   "<'row'<'col-sm-5'i><'col-sm-7'p>>",
"lengthMenu": [ [50,100,200], [50,100,200] ],
"columnDefs": [ {
"targets": 0,
"orderable": false,
"searchable": false,
} ],
"drawCallback": function( settings ) {
},
"ajax":{
url :"Get_Assign_Sub.php", // json datasource
type: "post",  // method  , by default get 
error: function(){  // error handling
$(".res-config-error").html("");
$("#res-config").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
$("#res-config_processing").css("display","none");
}
}
} );
}

Display_Category();
$('#show-hide-res').DataTable({
responsive: {
details: {
display: $.fn.dataTable.Responsive.display.childRowImmediate,
type: ''
}
}
});
$(document).ready(function(){
$("#CheckAll").click(function () {
$('input:checkbox').not(this).prop('checked', this.checked);
});   
});


function Delete_Data(id)
{
swal({
title: "Are you sure?",
text: "You will not be able to recover this record!",
type: "warning",
showCancelButton: true,
confirmButtonColor: "#278e00",
cancelButtonColor: "#eb4d00",
confirmButtonText: "Yes, delete it!",
closeOnConfirm: false,
},
function(){
$.ajax(
{   type:"post",
url:"AddEdit_Assign_Sub.php",
data:"id="+id+"&Action=Delete",
success: function(data)
{
swal("Deleted!", "Your record has been deleted.", "success");
var table = $('#res-config').DataTable();
table.draw(); 
},
async:false
});
});
}

function Delete(id)
{
var ids = [];
ids.push(id);
var ids_string = ids.toString();
Delete_Data(ids_string);
}
$("#DeleteAll").click(function(){  //"select all" change
if ($('.deleteRow:checked').length >0 ){
var ids = [];
$(".deleteRow:checked").each(function() {
ids.push($(this).val());
});
var ids_string = ids.toString();
Delete_Data(ids_string);
}
else
{
alert("Please Check at least One");
}
});



$(document).on("click", ".edit_model_btn", function () {
var id = $(this).data('id');
$("#ID").val(id);   // assign category id val
$("#Action").val("Display");   // Action EDIT
var formData = new FormData($('#form1')[0]);
$.ajax(
{   url: 'AddEdit_Assign_Sub.php',
type: 'POST',
data: formData,
contentType: false, 
processData: false, 
success: function(data)
{
var split_hash=data.split("##");
var message=split_hash[0];
var sub_id=split_hash[1];
var staff_name=split_hash[2];
var class_name=split_hash[3];
var subject_name=split_hash[4];
var dept_code=split_hash[5];
var batch_name=split_hash[6];

$("#dept_name").val(dept_code);
check_class();
$("#class_name").val(class_name);
$("#staff_name").val(staff_name); 
check_subject();
$("#subject_name").val(subject_name);
check_batch();
$("#batch_name").val(batch_name);                              
$("#Action").val("EDIT"); 
}
});
});


$("#form1").submit(function(e){
e.preventDefault();
$("#button_div").hide();
$("#ajax_loader").show();
var formData = new FormData(this);
//formData.append("Action", "ADD");
$.ajax(
{   type:"post",
url:"AddEdit_Assign_Sub.php",
data:formData,
cache:false,
contentType: false,
processData: false,
success: function(data)
{
if(data.trim()=="Success")
{
$('#default-Modal').modal('toggle'); 
var table = $('#res-config').DataTable();
table.draw(); 
swal("Completed", "You clicked the button!", "success");
$("#button_div").show();
$("#ajax_loader").hide();
$("#form1")[0].reset();
$("#Action").val("ADD");
}
},
async:false
});
});


$('#default-Modal').on('hidden.bs.modal', function () {
$("#form1")[0].reset(); //reset form data
$("#Action").val("ADD");   //Add Action
})
</script>

</body>

</html>
