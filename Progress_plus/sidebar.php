    <nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
    <div class="">
    <div class="main-menu-header">
    <img class="img-40 img-radius" src="assets/images/avtar-new.png" alt="User-Profile-Image">
    <div class="user-details">
    <span><?php echo $Admin_User;?></span>
    <span id="more-details">Admin<i class="ti-angle-down"></i></span>
    </div>
    </div>

    <div class="main-menu-content">
    <ul>
    <li class="more-details">
    <!--  <a href=""><i class="ti-user"></i>View Profile</a> -->

    <a href="logout.php"><i class="ti-layout-sidebar-left"></i>Logout</a>
    </li>
    </ul>
    </div>
    </div>

    <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Navigation</div>
    <ul class="pcoded-item pcoded-left-item">
    <li class="">
    <a href="dashboard.php">
    <span class="pcoded-micon"><i class="ti-home f-20"></i><b>D</b></span>
    <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
    <span class="pcoded-mcaret"></span>
    </a> 
    </li>



    <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Other</div>
    <li class="">
    <a href="Department.php">
    <span class="pcoded-micon"><i class="zmdi zmdi-city-alt f-30"></i><b>D</b></span>
    <span class="pcoded-mtext" data-i18n="nav.dash.main">Add Department</span>
    <span class="pcoded-mcaret"></span>
    </a>
    </li>

    <li class="">
    <a href="Class.php">
    <span class="pcoded-micon"><i class="icofont icofont-company f-20"></i><b>D</b></span>
    <span class="pcoded-mtext" data-i18n="nav.dash.main">Add Class</span>
    <span class="pcoded-mcaret"></span>
    </a>
    </li> 
    
    <ul class="pcoded-item pcoded-left-item">
        <li class="pcoded-hasmenu">
            <a href="javascript:void(0)">
                <span class="pcoded-micon" style="background-color: #f2234b;"><i class="icofont icofont-student-alt f-20"></i><b>FC</b></span>
                <span class="pcoded-mtext" data-i18n="nav.form-components.main">Student</span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">
                <li class=" ">
                    <a href="Student.php">
                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.form-components.form-components">Add Student</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <li class=" ">
                    <a href="Upload_Photo_Student.php">
                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.form-components.form-elements-add-on">Upload Photo For Student</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>

    <ul class="pcoded-item pcoded-left-item">
        <li class="pcoded-hasmenu">
            <a href="javascript:void(0)">
                <span class="pcoded-micon" style="background-color: #39ADB5;"><i class="icofont icofont-teacher f-20"></i><b>FC</b></span>
                <span class="pcoded-mtext" data-i18n="nav.form-components.main">Staff</span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">
                <li class=" ">
                    <a href="Staff.php">
                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.form-components.form-components">Add Staff</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <li class=" ">
                    <a href="Upload_Photo_Staff.php">
                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.form-components.form-elements-add-on">Upload Photo For Staff</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>

    <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon" style="background-color: #000080;"><i class="icofont icofont-book-alt f-20"></i><b>FC</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Subject</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="Subject.php">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.form-components">ADD Subject</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="Assign_Sub.php">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.form-elements-add-on">Assign Subject</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
    </ul>

    <ul class="pcoded-item pcoded-left-item">
        <li class="pcoded-hasmenu">
            <a href="javascript:void(0)">
                <span class="pcoded-micon" style="background-color: #8E002F;"><i class="ti-layers"></i><b>FC</b></span>
                <span class="pcoded-mtext" data-i18n="nav.form-components.main f-20">Batch</span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">
                <li class=" ">
                    <a href="Batch.php">
                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.form-components.form-components">ADD Batch</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <li class="">
                    <a href="Assign_Batch.php">
                        <span class="pcoded-micon"><i class="ti-eye"></i><b>D</b></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Assign Batch</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <li class="">
                    <a href="Assigned_Batch_Show.php">
                        <span class="pcoded-micon"><i class="ti-eye"></i><b>D</b></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Assigneed Batch Show</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>    

    <li class="">
    <a href="Time_Subject.php">
    <span class="pcoded-micon"><i class="icofont icofont-files f-20"></i><b>D</b></span>
    <span class="pcoded-mtext" data-i18n="nav.dash.main">Add Time Subject</span>
    <span class="pcoded-mcaret"></span>
    </a>
    </li>


    <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Exam</div>
    <li class="">
    <a href="Exam.php">
    <span class="pcoded-micon"><i class="icon-pencil f-20"></i><b>D</b></span>
    <span class="pcoded-mtext" data-i18n="nav.dash.main">Add Exam</span>
    <span class="pcoded-mcaret"></span>
    </a>
    </li>

    <li class="">
    <a href="Exam_Sub.php">
    <span class="pcoded-micon"><i class="zmdi zmdi-dns f-20"></i><b>D</b></span>
    <span class="pcoded-mtext" data-i18n="nav.dash.main">Add Exam Subject</span>
    <span class="pcoded-mcaret"></span>
    </a>
    </li> 
 

    <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Attendance</div>
    <li class="">
    <a href="Attendance.php">
    <span class="pcoded-micon"><i class="ti-user f-20"></i><b>D</b></span>
    <span class="pcoded-mtext" data-i18n="nav.dash.main">Attendance</span>
    <span class="pcoded-mcaret"></span>
    </a>

    </li>
    <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Notification</div>
    <li class="">
    <a href="Notification.php">
    <span class="pcoded-micon" style="background-color:#483D8B"><i class="fa fa-commenting f-30"></i><b>D</b></span>
    <span class="pcoded-mtext" data-i18n="nav.dash.main">Notification</span>
    <span class="pcoded-mcaret"></span>
    </a>
    </li> 
    </ul>
    </div>
    </nav>