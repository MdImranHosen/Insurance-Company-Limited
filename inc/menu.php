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
<div class="auto-container header-top-new">
<div class="clearfix">
    <!--Top Left-->
    <div class="row">
        <div class="col-lg-6 col-md-5 col-sm-12 header-top-image">
            <a href="<?php echo BASE_PATH; ?>">
                <img  src="<?php echo BASE_PATH; ?>/img/<?php echo $sirows['site_logo']; ?>" alt="" title="<?php echo $sirows['site_title']; ?>">
               <p class="github_mdimranhosen_companyname"> <?php echo $sirows['site_title']; ?> </p><p class="github_mdimranhosen_companyname"><i class="icon flaticon-placeholder"></i> <?php echo $sirows['site_address']; ?> </p> </a>   

        </div>
        <div class="col-lg-6 col-md-7 col-sm-12 github_mdimranhosen-right_menu">
           <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-4 col-4 mdimranhosen_github_menutop">
                 <div class="header-top-icon">
                    <span class="icon flaticon-open-mail-interface-symbol imran-icon-color"></span>
                </div>
                <div class="header-top-text">
                    <p>Send us a Message</p>
                  <a href="mailto:<?php echo $sirows['site_email']; ?>"><?php echo $sirows['site_email']; ?></a>  
                </div> 
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4 col-4 mdimranhosen_github_menutop">
                <div class="header-top-icon">
                    <span class="icon flaticon-phone-call-1 imran-icon-color"></span>
                </div>
                <div class="header-top-text">
                  <p>Give us a Call</p>
                  <a href="tel:<?php echo $sirows['site_phone']; ?>"><?php echo $sirows['site_phone']; ?></a>   
                </div>                 
              </div>              
              <div class="col-lg-4 col-md-4 col-sm-4 col-4 mdimranhosen_github_menutop">
                 <div class="header-top-icon">
                    <span class="icon flaticon-clock-1 imran-icon-color"></span>
                </div>
                <div class="header-top-text">
                  <?php
                   $opening_time = $sirows['opening_time']; 
                   if (!empty($opening_time)) {

                     $optim = explode('=', $opening_time);
                     if (isset($optim[0])) {
                       $fiopday = $optim[0];
                     }else{
                      $fiopday = '';
                     }
                     if (isset($optim[1])) {
                        $setime  = $optim[1];
                     }else{
                       $setime = '';
                     }
                     echo '<p>'.$fiopday.'</p><a href="">'.$setime.'</a>';
                    
                   }
                  ?>
                </div> 
              </div>
           </div> 
           <div class="row justify-content-md-center">
               <div class="col-lg-12 col-md-12 col-sm-12">
                 <ul class="header-top-bottom-menu">
                    <li><a href="<?php echo BASE_PATH; ?>digital-insurance"> Digital Insurance  </a></li>
                    <li><a href="#"> Insurance Payment </a></li>
                    <li><a href="<?php echo BASE_PATH; ?>online-claim"> Online Claim </a></li>
                    <li><a target="_blank" href="<?php echo BASE_PATH; ?>webmail"> Webmail </a></li>
                </ul>  
               </div>
           </div>
        </div>
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
   <img src="<?php echo BASE_PATH; ?>/img/<?php echo $sirows['site_logo']; ?>">
   <p class="github_mdimranhosen_companyname_mobile"> <?php echo $sirows['site_title']; ?> </p><p class="github_mdimranhosen_companyname_mobile mobile_comname"> <i class="icon flaticon-placeholder"></i> <?php echo $sirows['site_address']; ?> </p>
</center>
</a></div>
</div>
<!--Nav Box-->
<div class="nav-outer clearfix">
<!--Mobile Navigation Toggler-->
<div class="mobile-nav-toggler gighub_imranhosen_menuicon" style="color: black;" ><span class="icon flaticon-menu"></span></div>
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
