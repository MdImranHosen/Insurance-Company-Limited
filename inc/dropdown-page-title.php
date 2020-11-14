<section class="page_title_new" style="background-image:url(<?php echo BASE_PATH; ?>/img/title-background.jpg);">
<div class="auto-container">
 <div class="sec-title"> 
<?php
  if (class_exists('ServicesClass')) {
    $ps = new ServicesClass();
    if (method_exists($ps, 'getByPageTitle')) {
        $psresult = $ps->getByPageTitle($currentpage);
           if ($psresult) {
            while ($psrows = $psresult->fetch_assoc()) {
                $menu_id = $psrows['menu_id'];
                $label   = $psrows['label'];
                $pagename= $psrows['pagename'];
                $url     = $psrows['external_link'];
                
                $psurl = BASE_PATH.$url; 
                ?>
                	
    <h1 class=" wow fadeInDown" data-wow-delay="500ms"> <?php echo $pagename; ?> </h1>
    <p><a href="<?php echo BASE_PATH; ?>"><i class="fa fa-home"></i></a>  <span class="sep sep-1"> » </span> <a href="<?php echo $psurl; ?>"><?php echo $label; ?> </a> <span class="sep sep-1"> » </span> <?php echo $pagename; ?> </p>
   <?php } } } } ?> 
 </div>
</div>
</section>