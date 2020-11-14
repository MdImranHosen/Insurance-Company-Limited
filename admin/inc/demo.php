  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo Session::get('name'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php
         $path = $_SERVER['SCRIPT_FILENAME'];
         $currentpage = basename($path, '.php');
       ?>

      <ul class="sidebar-menu" data-widget="tree">
       <li class="header">MAIN NAVIGATION</li>

       <?php  if ((Session::get('admin_type') == 2) && (Session::get('admin_ck') == 'emain_admin')) { ?>

       <li <?php if ($currentpage == 'index') { echo 'class="active"'; } ?> >
          <a href="index.php"><i class="fa fa-dashboard"></i> <span> Dashboard</span></a>
        </li>
        
        <li <?php if ($currentpage == 'event_list') { echo 'class="active"';} ?> >
         <a href="event_list.php"><i class="fa fa-users"></i><span> Event List </span></a>
        </li>
        <li <?php if ($currentpage == 'slider_banner') { echo 'class="active"';} ?>>
         <a href="slider_banner.php"><i class="fa fa-building"></i><span> Slide Content </span></a>
        </li>
        <li <?php if ($currentpage == 'media_gallary') { echo 'class="active"';} ?>>
         <a href="media_gallary.php"><i class="fa fa-video-camera"></i><span> Media Gallery </span></a>
        </li>
        <li <?php if ($currentpage == 'gallery') { echo 'class="active"';} ?>>
         <a href="gallery.php"><i class="fa fa-picture-o"></i><span> Gallery </span></a>
        </li>
        <li <?php if ($currentpage == 'partners') { echo 'class="active"';} ?>>
         <a href="partners.php"><i class="fa fa-linode"></i><span> Partners </span></a>
        </li>
        <li <?php if ($currentpage == 'contact') { echo 'class="active"';} ?>>
         <a href="contact.php"><i class="fa fa-envelope"></i><span> Message </span></a>
        </li>
        <li <?php if ($currentpage == 'subscriber_list') { echo 'class="active"'; } ?>>
         <a href="subscriber_list.php"><i class="fa fa-list"></i><span> Subscriber List </span></a>
        </li> 
        <li <?php if ($currentpage == 'about_us') { echo 'class="active"'; } ?>>
         <a href="about_us.php"><i class="fa fa-globe"></i><span> About </span></a>
        </li>
        <li <?php if ($currentpage == 'admin') { echo 'class="active"';} ?>>
         <a href="admin.php"><i class="fa fa-user"></i><span> Admin Account </span></a>
        </li>

        <li <?php if ($currentpage == 'settings') { echo 'class="active"'; } ?>>
         <a href="settings.php"><i class="fa fa-cog"></i><span> Settings </span></a>
        </li>
      <?php } else if ((Session::get('admin_type') == 1) && (Session::get('admin_ck') == 'event_admin')) { ?>

        <li <?php if ($currentpage == 'event') { echo 'class="active"'; } ?> >
         <a href="event.php"><i class="fa fa-list"></i><span> Event </span></a>
        </li>

      <?php } ?>
    
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>