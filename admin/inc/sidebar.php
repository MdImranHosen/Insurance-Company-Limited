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

      <ul class="sidebar-menu" data-widget="tree">
       <li class="header">MAIN NAVIGATION</li>

       <?php  if ((Session::get('admin_type') == 2) && (Session::get('admin_ck') == 'emain_admin')) { ?>

       <li <?php if ($currentpage == 'index') { echo 'class="active"'; } ?> >
          <a href="index.php"><i class="fa fa-dashboard"></i> <span> Dashboard</span></a>
        </li>
        <li class="treeview" <?php if ($currentpage == ('slider_banner')) { echo 'class="active"'; } ?>>
         <a href="#"><i class="fa fa-home"></i><span> Home Page </span><span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu"> 
            <li <?php if ($currentpage == 'slider_banner') { echo 'class="active"'; } ?>>
             <a href="slider_banner.php"><i class="fa fa-circle-o"></i> Image Slider </a></li>
              <li><a href="image_video.php"><i class="fa fa-circle-o"></i> Image & Video</a></li>

          </ul>
        </li> 
        <li class="treeview" <?php if ($currentpage == ('about_us' || 'our_vision_&_mission' || 'company_profile')) { echo 'class="active"'; } ?>>
         <a href="#"><i class="fa fa-globe"></i><span> Who we are </span><span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="about_us.php"><i class="fa fa-circle-o"></i> About</a></li>
            <li><a href="company_profile.php"><i class="fa fa-circle-o"></i> Company Profile </a></li> 
            <li><a href="our_vision_&_mission.php"><i class="fa fa-circle-o"></i> Our Vision & Mission </a></li>
            <li><a href="share_holders.php"><i class="fa fa-circle-o"></i> Share Holders </a></li>
            <li><a href="board_of_directors.php"><i class="fa fa-circle-o"></i> Board of Directors </a></li>
            <li><a href="senior_management_team.php"><i class="fa fa-circle-o"></i> Senior Management Team </a></li>
            <li><a href="senior_development_team.php"><i class="fa fa-circle-o"></i> Senior Development Team </a></li>
            <li><a href="message_from_chairman.php"><i class="fa fa-circle-o"></i> Message from Chairman </a></li>
            <li><a href="message_from_managing_director_and_ceo.php"><i class="fa fa-circle-o"></i> Message From Managing <br> Director & CEO </a></li>
          </ul>
        </li>        
        <li class="treeview" <?php if ($currentpage == 'products_services') { echo 'class="active"'; } ?>>
         <a href="products_services.php"><i class="fa fa-paper-plane"></i><span> Products & Services </span><span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="fire_insurance.php"><i class="fa fa-circle-o"></i> Fire Insurance </a></li>
            <li><a href="engineering_insurance.php"><i class="fa fa-circle-o"></i> Engineering Insurance </a></li> 
            <li><a href="motor_insurance.php"><i class="fa fa-circle-o"></i> Motor Insurance </a></li>
            <li><a href="marine_cargo_insurance.php"><i class="fa fa-circle-o"></i> Marine Cargo Insurance </a></li>
            <li><a href="miscellaneous.php"><i class="fa fa-circle-o"></i> Miscellaneous </a></li>
            <li><a href="liability_insurance.php"><i class="fa fa-circle-o"></i> Liability Insurance </a></li>
          </ul>
        </li>
        <li class="treeview">
         <a href="#"><i class="fa fa-paper-plane"></i><span> Digital Insurance </span><span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="fireinsurance.php"><i class="fa fa-circle-o"></i> Fire Insurance </a></li>
            <li><a href="engineeringinsurance.php"><i class="fa fa-circle-o"></i> Engineering Insurance </a></li> 
            <li><a href="#"><i class="fa fa-circle-o"></i> Motor Insurance </a></li>
            <li><a href="marinecargoinsurance.php"><i class="fa fa-circle-o"></i> Marine Cargo Insurance </a></li>
            <li><a href="miscellaneousinsurance.php"><i class="fa fa-circle-o"></i> Miscellaneous </a></li>
            <li><a href="liabilityinsurance.php"><i class="fa fa-circle-o"></i> Liability Insurance </a></li>
          </ul>
        </li>
        <li class="treeview">
         <a href="#"><i class="fa fa-usd"></i><span> Financial Indicators </span><span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="shareholding_structure.php"><i class="fa fa-circle-o"></i> Shareholding Structure </a></li>
            <li><a href="financial_strength.php"><i class="fa fa-circle-o"></i> Financial Strength </a></li> 
            <li><a href="credit_rating_reports.php"><i class="fa fa-circle-o"></i>  
             Credit Rating Reports </a></li>
            <li><a href="annual_reports.php"><i class="fa fa-circle-o"></i> Annual Reports </a></li>
            <li><a href="company_prospectus.php"><i class="fa fa-circle-o"></i> Company Prospectus </a></li>
            <li><a href="unsettled_claim_information.php"><i class="fa fa-circle-o"></i> Unsettled Claim Information </a></li>
          </ul>
        </li>
        <li <?php if ($currentpage == 'branches') { echo 'class="active"';} ?>>
         <a href="branches.php"><i class="fa fa-linode"></i><span> Branches </span></a>
        </li>
        <li <?php if ($currentpage == 'claims_outstanding') { echo 'class="active"';} ?>>
         <a href="claims_outstanding.php"><i class="fa fa-skyatlas"></i><span> Claims Outstanding </span></a>
        </li>        
        <li class="treeview">
         <a href="#"><i class="fa fa-video-camera"></i><span> Media </span><span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if ($currentpage == 'gallery') { echo 'class="active"';} ?>>
             <a href="gallery.php"><i class="fa fa-picture-o"></i><span> Photo Gallery </span></a>
            </li>
            <li <?php if ($currentpage == 'media_gallary') { echo 'class="active"';} ?>>
             <a href="media_gallary.php"><i class="fa fa-video-camera"></i><span> Video Gallery </span></a>
            </li>
            <li <?php if ($currentpage == 'news_events') { echo 'class="active"';} ?>>
             <a href="news_events.php"><i class="fa fa-circle-o"></i><span> News & Events </span></a>
            </li>
          </ul>
        </li>
        <li <?php if ($currentpage == 'contact') { echo 'class="active"';} ?>>
         <a href="contact.php"><i class="fa fa-envelope"></i><span> Message </span></a>
        </li>     
        <li <?php if ($currentpage == 'online_claim') { echo 'class="active"'; } ?>>
         <a href="online_claim.php"><i class="fa fa-list"></i><span> Onlline Claim </span></a>
        </li>   
        <li <?php if ($currentpage == 'download_forms') { echo 'class="active"';} ?>>
         <a href="download_forms.php"><i class="fa fa-download"></i><span> Download Forms </span></a>
        </li>        
        <li class="treeview">
         <a href="#"><i class="fa fa-rebel"></i><span> Career </span><span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if ($currentpage == 'career') { echo 'class="active"';} ?>>
             <a href="career.php"><i class="fa fa-rebel"></i><span> Career </span></a>
            </li>
            <li><a href="submit_resume.php"><i class="fa fa-circle-o"></i> Submit Resume </a></li>
          </ul>
        </li>
        <li <?php if ($currentpage == 'directors_employers_list') { echo 'class="active"';} ?>>
         <a href="directors_employers_list.php"><i class="fa fa-users"></i><span> Directors & Employers List </span></a>
        </li>
        <li <?php if ($currentpage == 'faq') { echo 'class="active"'; } ?>>
         <a href="faq.php"><i class="fa fa-question"></i><span> FAQ </span></a>
        </li> 
        <li <?php if ($currentpage == 'agent_license') { echo 'class="active"'; } ?>>
         <a href="agent_license.php"><i class="fa fa-download"></i><span> Agent License </span></a>
        </li>
        <li <?php if ($currentpage == 'subscriber_list') { echo 'class="active"'; } ?>>
         <a href="subscriber_list.php"><i class="fa fa-list"></i><span> Subscriber List </span></a>
        </li>       

        <li <?php if ($currentpage == 'admin') { echo 'class="active"';} ?>>
         <a href="admin.php"><i class="fa fa-user"></i><span> Admin Account </span></a>
        </li>

        <li <?php if ($currentpage == 'settings') { echo 'class="active"'; } ?>>
         <a href="settings.php"><i class="fa fa-cog"></i><span> Settings </span></a>
        </li>
      <?php } ?>    
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>