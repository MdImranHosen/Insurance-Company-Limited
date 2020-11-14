<aside class="sidebar padding-left">
    <!-- Category Widget -->
    <div class="sidebar-widget categories">
        <h4 style="background: #6D0D67;color: white;padding: 10px;" class="sidebar-title"> Who we are </h4>
        <div class="widget-content">
            <!-- Blog Category -->
            <ul class="blog-categories">
        <?php
          if (class_exists('ServicesClass')) {
            $ps = new ServicesClass();
            if (method_exists($ps, 'getWhoAreyouManu')) {
                   $psresult = $ps->getWhoAreyouManu();
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

                      echo '<li '.$active.'><a class="whoareyoumenu" href="'.$psurl.'"><i class="fa fa-angle-left" aria-hidden="true"></i>'. $label.'</a></li>';
                    } } } } ?>

            </ul>
        </div>
    </div>
</aside>
