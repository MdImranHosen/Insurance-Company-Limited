<aside class="sidebar padding-rignt">  
    <!-- Category Widget -->
    <div class="sidebar-widget categories">
<?php
  if (class_exists('ServicesClass')) {
    $ps = new ServicesClass();
    if (method_exists($ps, 'getByPageTitle')) {
        $psresult = $ps->getByPageTitle($currentpage);
           if ($psresult) {
            while ($psrows = $psresult->fetch_assoc()) {
                $mainManu = $psrows['label']; ?>
        <h4 style="color: #222;padding: 10px;" class="sidebar-title"> <?php echo $mainManu; ?> </h4>
    <?php } } } } ?>
        <div class="widget-content">
            <!-- Blog Category -->
            <ul class="blog-categories">
        <?php
          if (class_exists('ServicesClass')) {
            $ps = new ServicesClass();
            if (method_exists($ps, 'getByPageNameSidebar')) {
                $psresult = $ps->getByPageNameSidebar($currentpage);
                   if ($psresult) {
                    while ($psrows = $psresult->fetch_assoc()) {
                        $menu_id = $psrows['menu_id'];
                        $label = $psrows['label'];
                        $url   = $psrows['external_link'];
                        
                        $psurl = BASE_PATH.$url;

                        if ($currentpage == $url) {
                            $active = 'class="active"';
                        }else{
                            $active = '';
                        }

                      echo '<li '.$active.'><a class="whoareyoumenu" href="'.$psurl.'"><i class="fa fa-angle-right" aria-hidden="true"></i> '. $label.'</a></li>';
                    } } } } ?>

            </ul>
        </div>
    </div>
</aside>
