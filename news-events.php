<?php 
if (isset($_GET['page'])) {
  $page = preg_replace('/\D/', '', $_GET['page']);
  $page = (int)$page;
} else{ $page = 1; }

$per_page = 4;
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
<!--Page Title-->
<?php 
 if (realpath('inc/page_title.php')) {
   include_once 'inc/page_title.php';
 }
 ?>
<!--End Page Title-->
<!--Sidebar Page Container-->
<div class="sidebar-page-container services_page">
<div class="auto-container">
    <div class="row">
<?php 
if (class_exists('NewsEventsClass')) {
  $neObj = new NewsEventsClass();
  if (method_exists($neObj, 'getNewsEventsDataLimit')) {
    $result = $neObj->getNewsEventsDataLimit($start_from,$per_page);
    if ($result) {
      while ($rows = $result->fetch_assoc()) {
        $ne_id  = $rows['news_events_id'];
        $title  = $rows['news_events_title'];
        $date   = $rows['news_events_date'];
        $file   = $rows['news_events_file'];
        $des    = htmlspecialchars_decode(stripcslashes($rows['news_events_des']));
        $c_date = $rows['create_date'];       

      $img = "news_events/".$ne_id."/".$file;
      if (!file_exists($img)) {
         $img = "img/logo.png";
       }
?>
<!-- News Block Three -->
<div class="news-block col-lg-3 col-md-6 col-sm-12 wow fadeInRight">
    <div class="inner-box">
        <div class="image-box">
            <figure class="image"><a href="<?php echo BASE_PATH.'news-events-details/'.$ne_id; ?>"><img src="<?php echo BASE_PATH.$img; ?>" alt=""></a></figure>
        </div>
        <div class="lower-content imran_events_news_text">
            <ul class="post-info">
                <li><span class="far fa-clock"></span> <?php if (!empty($date)) {
                  echo $date;
                } ?></li>
            </ul>    
            <h6><a href="<?php echo BASE_PATH.'news-events-details/'.$ne_id; ?>"> <?php if (!empty($des)) {
              echo $title;
            } ?> </a></h6>
        </div>
    </div>
</div>
<?php  } } else{ echo '<script> location.href="'.BASE_PATH.'"; </script>'; } } } ?>
</div>

<!--Styled Pagination-->
<ul class="styled-pagination text-center">
  <?php 
  if (class_exists('NewsEventsClass')) {
    $neObj = new NewsEventsClass();
    if (method_exists($neObj, 'newsEventsPaginations')) {
    $total_page = $neObj->newsEventsPaginations($per_page);
    
    if ($total_page > 1) {

    $pagination = '';

    if ($page > 1) {
      $pagination .= '<li><a href="'.BASE_PATH.'news-events/'.($page - 1).'"><span class="icon fa fa-angle-left"></span></a></li>';
    }

    for ($pagin = 1; $pagin <= $total_page; $pagin++) { 

    if ($page == $pagin) {
        $active_pagin = 'class="active"';
      } elseif( $page == ''){
        $active_pagin = 'class="active"';
      } else{
       $active_pagin = ''; 
     }

      $pagination .= '<li><a '.$active_pagin.' href="'.BASE_PATH.'news-events/'.$pagin.'">'.$pagin.'</a></li>';

     }

     if ($page < $total_page) {
      $pagination .= '<li><a href="'.BASE_PATH.'news-events/'.($page + 1).'"><span class="icon fa fa-angle-right"></span></a></li>';
    }
    echo $pagination;
    
 } } } ?>
</ul>          
<!--End Styled Pagination-->
</div>
</div>
<!-- End Services Details Container -->
<!-- Main Footer -->
<?php include 'inc/footer.php'; ?>