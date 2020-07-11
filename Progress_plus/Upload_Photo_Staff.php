<?php
session_start();
include_once("db.php");
include_once("session_check.php");
?>
<?php
if (! empty($_FILES)) {
    $imagePath = isset($_FILES["file"]["name"]) ? $_FILES["file"]["name"] : "Undefined";
    $targetPath = $link_url.$Staff_Path;
    $imagePath = $targetPath . $imagePath;
    $tempFile = $_FILES['file']['tmp_name'];
    
    $targetFile = $targetPath . $_FILES['file']['name'];
    
    if (move_uploaded_file($tempFile, $targetFile)) {
        echo "true";
    } else {
        echo "false";
    }
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
	<!-- Upload file in server -->
	<link rel="stylesheet" type="text/css" href="bower_components/dropzone/dropzone.css" />

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

																			<form id="form1" name="form1" method="post" enctype="multipart/form-data">
																				<div class="col-sm-12">
																					<h4 class="sub-title" style="color: #4881ff">Upload Photo For Staff:</h4>
																					<div id="photo" name="photo" class="dropzone" action="Upload_Photo_Staff.php?action=save">		
																					</div>
																				</div>
																				 <div class="text-center col-sm-12">
																					<a href="dashboard.php"><button type="button" class="btn btn-primary btn-round">Save changes</button></a>
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
	<!-- Upload file in server -->
	<script type="text/javascript" src="bower_components/dropzone/dropzone.js"></script>
	<script type="text/javascript">
Dropzone.options.photo = {
 acceptedFiles: ".jpg",
}
	</script>
</body>

</html>