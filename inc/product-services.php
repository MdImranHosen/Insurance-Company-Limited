<section class="features-section-two product_services">
        <div class="auto-container">
            <div class="anim-icons">   
                <span class="icon twist-line-1 wow zoomIn"></span>
                <span class="icon twist-line-2 wow zoomIn" data-wow-delay="1s"></span>
                <span class="icon twist-line-3 wow zoomIn" data-wow-delay="2s"></span>
            </div>

            <div class="row">
                 <?php if ($currentpage != 'product-services') { ?>
                <!-- Title Block -->
                <div class="title-block col-lg-12 col-md-12 col-sm-12 wow fadeInUp">
                    <div class="inner-box">
                        <div class="sec-title">
                            <center><span class="title"> Services </span>
                            <h2> Products & Services </h2></center>
                        </div>
                    </div>
                </div>
               <?php } ?>

     <?php 
       if (class_exists('ServicesClass')) {
           $ps = new ServicesClass();
           if (method_exists($ps, 'getProductsServicesData')) {
               $psresult = $ps->getProductsServicesData();
               if ($psresult) {
                   while ($psrows = $psresult->fetch_assoc()) {
                    $psid     = $psrows['id'];
                    $ps_icon  = $psrows['ps_icon'];
                    $ps_title = $psrows['ps_title'];
                    $ps_url   = $psrows['ps_url'];
                ?>
                <!-- Feature Block -->
                <div class="feature-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
                    <div class="inner-box">
                        <div class="icon-box">
                            <span class="icon <?php echo $ps_icon; ?>"></span>
                        </div>
                        <h4><a href="product-services/<?php echo $psid; ?>"><?php echo $ps_title; ?></a></h4>
                    </div>
                </div>
            <?php } } } } ?>

            </div>
         <?php if ($currentpage != 'product-services') { ?>
            <div class="row justify-content-lg-center">
                <div class="col-lg-4">
                  <a href="product-services" class="btn btn-dark btn-lg btn-block" style="background: #63339C;font-weight: 800;padding: 20px;" onmouseover="this.style='background:#101130;font-weight: 800;padding: 20px;'" onmouseout="this.style='background:#63339C;font-weight: 800;padding: 20px;'"> View More >> </a>  
                </div>
            </div>
         <?php } ?>
        </div>
    </section>