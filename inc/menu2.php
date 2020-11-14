<?php
if (class_exists('SettingsClass')) {
    $sobj = new SettingsClass();
    if (method_exists($sobj, 'getSettingsData')) {
        $sifo = $sobj->getSettingsData();
        if ($sifo) {
            $sirows = $sifo->fetch_assoc();
?>


<header class="main-header header-style-two alternate-two">
<!-- Header Top Two -->
<div class="header-top-two">
<div class="auto-container">
<div class="clearfix">
    <!--Top Left-->
    <div class="top-left clearfix">
        <ul class="links clearfix">
            <li><a href="<?php echo BASE_PATH; ?>">
                <img src="<?php echo BASE_PATH; ?>/img/<?php echo $sirows['site_logo']; ?>" alt="" title="<?php echo $sirows['site_title']; ?>">
               </a></li>
            <li><a href="tel:<?php echo $sirows['site_phone']; ?>"><span class="icon fa fa-phone imran-icon-color"></span>Hotline : <?php echo $sirows['site_phone']; ?></a></li>
            <li><a href="mailto:<?php echo $sirows['site_email']; ?>"><span class="icon fa fa-envelope imran-icon-color"></span><?php echo $sirows['site_email']; ?></a></li>
        </ul>
    </div>
    <!--Top Right-->
    <div class="top-right clearfix">
        <ul class="social-icons">
            <li style="padding-top: 6%;"><a href="#"><span class="fas fa-laptop imran-icon-color"></span>
            Digital Insurance
            </a></li>
            <li style="padding-top: 6%;"><a href="#"><span class="fas fa-money-bill-wave-alt imran-icon-color"></span>
              Insurance Payment
            </a></li>
        </ul>
    </div>
</div>
</div>
</div>
<!-- Header Top End -->
<div class="main-box">
<div class="auto-container clearfix">
<div class="logo-box">
<div id="menu_logo" class="logo"><a href="<?php echo BASE_PATH; ?>">
<center>
   <img style="max-height: 80px;width: auto;" src="<?php echo BASE_PATH; ?>/img/<?php echo $sirows['site_logo']; ?>">
</center>
</a></div>
</div>
<!--Nav Box-->
<div class="nav-outer clearfix">
<!--Mobile Navigation Toggler-->
<div class="mobile-nav-toggler" style="color: black;padding-right: 10px;"><span class="icon flaticon-menu"></span></div>
<!-- Main Menu -->
<nav class="main-menu navbar-expand-md navbar-light">
<div class="navbar-header">
    <!-- Togg le Button -->      
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="icon flaticon-menu-button"></span>
    </button>
</div>

<div class="collapse navbar-collapse clearfix" id="navbarSupportedContent">
    <ul class="navigation clearfix">
<?php
if (class_exists('SettingsClass')) {
$sobj = new SettingsClass();
if (method_exists($sobj, 'getTopMenuAll')) {
$stmenu = $sobj->getTopMenuAll();
if ($stmenu) {
    $topmenu = '';
    while ($stmrow = $stmenu->fetch_assoc()) {
        $menu_id   = $stmrow['menu_id'];
        $main_menu = $stmrow['label'];
        $menu_link = $stmrow['external_link'];

        if ($currentpage == $menu_link) {
            $active = 'class="current"';
        }else{
            $active = '';
        }
        
    if (method_exists($sobj, 'getSubmenuallbymainm')) {
        $submenu = $sobj->getSubmenuallbymainm($menu_id);
        if ($submenu) {

           $mainmenu = "<li class='dropdown'><a href='".BASE_PATH.$menu_link."'>$main_menu <i class='menu_icon_h fa fa-caret-down' aria-hidden='true'></i></a><ul>";
            $submenulist = '';                            
            while ($submrow = $submenu->fetch_assoc()) {
              $sub_menu = $submrow['label'];
              $sub_link = $submrow['external_link'];
              $submenulist .= "<li><a href='".BASE_PATH.$sub_link."'>$sub_menu</a>";  
            }
            $mainmenu .= $submenulist."</ul></li>";

            $topmenu .= $mainmenu;
        } else{
          $topmenu .= "<li ".$active."><a href='".BASE_PATH.$menu_link."'>$main_menu</a></li>";
        }
      }                       
    }
    echo $topmenu;
  } } } ?>
    </ul>
</div>
</nav>
<!-- Main Menu End-->
</div>
</div>
</div>

<!-- Mobile Menu  -->
<div class="mobile-menu">
    <div class="menu-backdrop"></div>
    <div class="close-btn"><span class="icon flaticon-cancel-1"></span></div>
    
    <!-- Here Menu Will Come Automatically Via Javascript / Same Menu as in Header -->
    <nav class="menu-box">
        <div class="nav-logo"><a href="<?php echo BASE_PATH; ?>">
            <img src="<?php echo BASE_PATH; ?>/img/<?php echo $sirows['site_logo']; ?>" alt="" title="<?php echo $sirows['site_title']; ?>">
        </a></div>
        <ul class="navigation clearfix"> <!--Keep This Empty / Menu will come through Javascript--></ul>
    </nav>
</div><!-- End Mobile Menu -->

</header>
<!--End Main Header-->
<?php } } } ?>
