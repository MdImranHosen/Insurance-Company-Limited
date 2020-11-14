 <?php  
  if (class_exists('SettingsClass')) {
    $seobj = new SettingsClass();

  if ((Session::get('admin_type') == 2) && (Session::get('admin_ck') == 'emain_admin')) { 
     
 ?>
 <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <?php
            if (method_exists($seobj, 'getAllBranceCount')) { 
              $brancesall = $seobj->getAllBranceCount();
           ?>
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php if ($brancesall) { 
               while ($daa = $brancesall->fetch_assoc()) {
                 echo $daa['brancesall'];
               } } ?></h3>

              <p> Total Branches </p>
            </div>
            <div class="icon">
              <i class="fa fa-th-large"></i>
            </div>
            <a href="branches.php" class="small-box-footer"> More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        <?php } ?>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <?php
            if (method_exists($seobj, 'getTotalPolicy')) { 
              $totalPolicy = $seobj->getTotalPolicy();
           ?>
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php if ($totalPolicy) { 
               while ($paa = $totalPolicy->fetch_assoc()) {
                 echo $paa['totalPolicy'];
               } } ?></h3>

              <p> Total Policy </p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        <?php } ?>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <?php
            if (method_exists($seobj, 'getTotalOnlineClaim')) { 
              $totalOnlineClaim = $seobj->getTotalOnlineClaim();
           ?>
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php if ($totalOnlineClaim) { 
               while ($oaa = $totalOnlineClaim->fetch_assoc()) {
                 echo $oaa['totalOnlineClaim'];
               } } ?></h3>

              <p>Online Claim</p>
            </div>
            <div class="icon">
              <i class="fa fa-fighter-jet"></i> <!-- ion ion-person-add -->
            </div>
            <a href="online_claim.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        <?php } ?>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <?php
            if (method_exists($seobj, 'getTotalMessage')) { 
              $totalMessage = $seobj->getTotalMessage();
           ?>
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php if ($totalMessage) { 
               while ($caa = $totalMessage->fetch_assoc()) {
                 echo $caa['totalMessage'];
               } } ?></h3>

              <p> Total Message </p>
            </div>
            <div class="icon">
              <i class="fa fa-envelope-open"></i>
            </div>
            <a href="contact.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        <?php } ?>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <?php
            if (method_exists($seobj, 'getTotalEventNews')) { 
              $totalEventNews = $seobj->getTotalEventNews();
           ?>
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php if ($totalEventNews) { 
               while ($eaa = $totalEventNews->fetch_assoc()) {
                 echo $eaa['totalEventNews'];
               } } ?></h3>

              <p> Total Event & News </p>
            </div>
            <div class="icon">
              <i class="fa fa-newspaper-o"></i>
            </div>
            <a href="news_events.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        <?php } ?>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <?php
            if (method_exists($seobj, 'getTotalVideo')) { 
              $totalVideo = $seobj->getTotalVideo();
           ?>
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php if ($totalVideo) { 
               while ($vaa = $totalVideo->fetch_assoc()) {
                 echo $vaa['totalVideo'];
               } } ?></h3>

              <p>Video Gallary</p>
            </div>
            <div class="icon">
              <i class="fa fa-video-camera"></i> <!-- ion ion-person-add -->
            </div>
            <a href="media_gallary.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        <?php } ?>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <?php
            if (method_exists($seobj, 'getTotalResume')) { 
              $totalResume = $seobj->getTotalResume();
           ?>
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php if ($totalResume) { 
               while ($raa = $totalResume->fetch_assoc()) {
                 echo $raa['totalResume'];
               } } ?></h3>

              <p> Total Resume </p>
            </div>
            <div class="icon">
              <i class="fa fa-indent"></i>
            </div>
            <a href="submit_resume.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        <?php } ?>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <?php
            if (method_exists($seobj, 'getTotalBoardOfDirectors')) { 
              $tbod = $seobj->getTotalBoardOfDirectors();
           ?>
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php if ($tbod) { 
               while ($bdaa = $tbod->fetch_assoc()) {
                 echo $bdaa['tbod'];
               } } ?></h3>

              <p> Board of Directors </p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="board_of_directors.php" class="small-box-footer"> More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        <?php } ?>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
  <?php } } ?>