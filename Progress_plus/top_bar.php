<!-- Material Icon -->
    <link rel="stylesheet" type="text/css" href="assets/icon/material-design/css/material-design-iconic-font.min.css">
<!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="assets/icon/font-awesome/css/font-awesome.min.css">
<!-- simple line icon -->
<link rel="stylesheet" type="text/css" href="assets/icon/simple-line-icons/css/simple-line-icons.css">

<nav class="navbar header-navbar pcoded-header">
<div class="navbar-wrapper">

<div class="navbar-logo">
   
  <a class="mobile-menu" id="mobile-collapse" href="#!">
     <i class="ti-menu"></i>
  </a>
    <a href="index.html">
        <img class="img-fluid" src="assets/images/logo.png" alt="Theme-Logo" />
    </a>
  
</div>

<div class="navbar-container container-fluid">
        <ul class="nav-left">
            <li>
                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
            </li>
           
            <li>
                <a href="#!" onclick="javascript:toggleFullScreen()">
                    <i class="ti-fullscreen"></i>
                </a>
            </li>
           
                  
               
        </ul>
        <ul class="nav-right">
         
          
           
            <li class="user-profile header-notification">
                <a href="#!">
                    <img src="assets/images/avtar-new.png" class="img-radius" alt="User-Profile-Image">
                    <span><?php echo $Admin_User;?></span>
                    <i class="ti-angle-down"></i>
                </a>
                <ul class="show-notification profile-notification">
                   
                  
                    <li>
                <a href="logout.php">
                    <i class="ti-layout-sidebar-left"></i> Logout
                </a>
            </li>
                </ul>
            </li>
        </ul>
        
</div>
</div>
</nav>
