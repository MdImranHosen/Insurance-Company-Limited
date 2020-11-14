<section style="margin-top: 5px;padding-top: 50px;">
<div class="auto-container">
<div class="row">
<div class="col-lg-12 services_fbpage">
 <h2> <span> News & Events </span> </h2>
  <div class="row">
    <div id="news_events_owl" class="owl-carousel owl-theme">
   <?php 
      if (class_exists('NewsEventsClass')) {
        $neObj = new NewsEventsClass();
        if (method_exists($neObj, 'getNewsEventsDataHomePage')) {
          $result = $neObj->getNewsEventsDataHomePage();
          if ($result) {
            while ($rows = $result->fetch_assoc()) {
              $ne_id  = $rows['news_events_id'];
              $title  = $rows['news_events_title'];
              $date   = $rows['news_events_date'];
              $des    = htmlspecialchars_decode(stripcslashes($rows['news_events_des']));
              $description = $neObj->textShorten($des, 100);
      ?>

    <div class="item">
      <a href="news-events-details/<?php echo $ne_id; ?>">
      <div class="event_news_style">
      <h3><?php if (!empty($title)) { echo $title; } ?></h3>
      <p><i class="fa fa-clock"></i> <?php if (!empty($date)) { echo $date; } ?></p>
      <p><?php if (!empty($description)) { echo $description; } ?></p> 
    </div>
     </a>
    </div>
  <?php  } } } } ?>
  </div>
    </div>

    <div class="row">
      <div class="col-lg-12 text-center imran_event_news">
        <a href="news-events"> View all News & Events </a>
      </div>
  </div>
</div>
</div>
</div>
</section>