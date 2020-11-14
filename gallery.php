<?php 
if (isset($_GET['page'])) {
  $page = preg_replace('/\D/', '', $_GET['page']);
  $page = (int)$page;
} else{ $page = 1; }

$per_page = 8;
$start_from = ($page - 1) * $per_page;

?>
<?php include 'inc/header.php'; ?>
<div class="page-wrapper">
<!-- Preloader -->
<div class="preloader"></div>
<!-- Header span -->
<!-- Header Span -->
<span class="header-span"></span>
<!-- Main Header-->
<?php include 'inc/menu.php'; ?>
<!--End Main Header -->
<div class="clearfix"></div>
<!--Page Title-->
<?php 
 if (realpath('inc/page_title.php')) {
   include_once 'inc/page_title.php';
 }
 ?>
<!--End Page Title-->
     <!-- Gallery Section -->
    <section class="gallery-section">   
      <div class="auto-container">
        <div class="row">
         <?php
          if (class_exists('SlideContentClass')) {
            $mgallary = new SlideContentClass();
            if (method_exists($mgallary, 'getGalleryLimit')) {
              $result = $mgallary->getGalleryLimit($start_from,$per_page);
              if ($result) {
                while ($rows = $result->fetch_assoc()) {
                 $g_image = $rows['gallery_image'];
                 $g_title = $rows['content_title'];

                $img = "images/gallery/".$rows['mg_id']."/".$rows['gallery_image'];
                if (!file_exists($img)) {
                   $img = "images/gallery/1.jpg"; 
                 }
            ?>
                <!-- Gallery Item -->
                <div class="gallery-item col-lg-3 col-md-4 col-sm-6 col-xm-12 wow zoomIn" data-wow-delay="500ms">
                    <div class="image-box">
                        <figure class="image imran_gallery">
                            <img src="<?php if (!empty($img)) {
                                echo BASE_PATH.$img;
                            } ?>" alt="">
                            <?php if(!empty($g_title)) echo "<p style='border-top:1px solid #ddd;padding:5px;color:#222;font-family:sans-serif;'><i class='flaticon-arrow-pointing-to-right'></i> ".$g_title."</p>"; ?>
                        </figure>
                        <div class="overlay-box"><a href="<?php if (!empty($img)) {
                                echo BASE_PATH.$img;
                            } ?>" class="lightbox-image" data-fancybox='gallery'><span class="icon fa fa-expand-arrows-alt"></span></a></div>
                    </div>
                </div>               
            <?php  } } } } ?>    
            </div>
           <!--Styled Pagination-->
<ul class="styled-pagination text-center">
  <?php 
  if (class_exists('SlideContentClass')) {
    $mgallary = new SlideContentClass();
    if (method_exists($mgallary, 'galleryImagePaginations')) {
    $total_page = $mgallary->galleryImagePaginations($per_page);
    
    if ($total_page > 1) {

    $pagination = '';

    if ($page > 1) {
      $pagination .= '<li><a href="'.BASE_PATH.$currentpage.'/'.($page - 1).'"><span class="icon fa fa-angle-left"></span></a></li>';
    }

    for ($pagin = 1; $pagin <= $total_page; $pagin++) { 

    if ($page == $pagin) {
        $active_pagin = 'class="active"';
      } elseif( $page == ''){
        $active_pagin = 'class="active"';
      } else{
       $active_pagin = ''; 
     }

      $pagination .= '<li><a '.$active_pagin.' href="'.BASE_PATH.$currentpage.'/'.$pagin.'">'.$pagin.'</a></li>';

     }

     if ($page < $total_page) {
      $pagination .= '<li><a href="'.BASE_PATH.$currentpage.'/'.($page + 1).'"><span class="icon fa fa-angle-right"></span></a></li>';
    }
    echo $pagination;
    
 } } } ?>
</ul>          
<!--End Styled Pagination-->
        </div>
    </section>
    <!--End Gallery Section -->
<!-- Main Footer -->
<?php include 'inc/footer.php'; ?>