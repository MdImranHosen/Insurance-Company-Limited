<!-- Start Support -->
<?php
if (class_exists('SettingsClass')) {
    $sobj = new SettingsClass();
    if (method_exists($sobj, 'getSettingsData')) {
        $sifo = $sobj->getSettingsData();
        if ($sifo) {
            $sirows = $sifo->fetch_assoc();
?>
<div class="card" style="border-bottom: 4px solid #6D0D67;margin-top: 15%;">
  <div class="card-body">
    <div class="service-head"> SERVICE <span class="highlight"> SUPPORT</span></div>
   

     <div class="service-body">
       <div class="row">
        <div class="col-sm-2 col-2 service-body-icon">
          <i class="icon flaticon-open-mail-interface-symbol imran-icon-color" aria-hidden="true"></i>
        </div>
        <div class="col-sm-8 col-8 service-body-text">
          Send us a Message
          <div class="service-body-highlight"> <a href="mailto:<?php echo $sirows['site_email']; ?>"><?php echo $sirows['site_email']; ?></a> </div>
        </div>
       </div>

        <div class="clearfix"></div>
        <div class="row">
        <div class="col-sm-2 col-2 service-body-icon">
          <i class="icon flaticon-phone-call-1 imran-icon-color" aria-hidden="true"></i>
        </div>
        <div class="col-sm-8 col-8 service-body-text">
          Give us a Call
          <div class="service-body-highlight"> <a href="tel:<?php echo $sirows['site_phone']; ?>"><?php echo $sirows['site_phone']; ?></a> </div>
        </div>
       </div>
        <div class="clearfix"></div>
      </div>

  </div>
</div>
<?php } } } ?>
<!-- End Support -->