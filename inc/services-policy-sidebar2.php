<!--Sidebar Side-->
<div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
<aside class="sidebar padding-rignt" data-wow-duration="2s" data-wow-delay="500ms">  
    <!-- Category Widget -->
   <!-- Post Widget -->
<div class="sidebar-widget categories">
    <h4 class="sidebar-title">Popular Products / Policies</h4>
    <div class="widget-content">
        <!-- Blog Category -->
        <ul class="blog-categories">
<?php
if (method_exists($ps, 'getpsPolicyByServices')) {
    $psresult = $ps->getpsPolicyByServices();
       if ($psresult) {
        while ($psrows = $psresult->fetch_assoc()) {

            $policy_id_sb   = $psrows['policy_id'];
            $policy_url_sb  = $psrows['services_url'];            
            $policy_name_sb = $psrows['policy_name'];

            $services_name_sb = ucwords(str_replace('_', ' ', $policy_url_sb));
            
            $psurl_sb = BASE_PATH.$currentpage.'/'.$policy_id_sb;

            if ($policy_id_sb == $policyid) {
                $active = 'class="active"';
            } else{
                $active = '';
            }

            

          echo '<li '.$active.'><a class="whoareyoumenu" href="'.$psurl_sb.'"><i class="fa fa-angle-right" aria-hidden="true"></i>'. $services_name_sb.' " '.$policy_name_sb.'"</a></li>';
        } } }  ?>

        </ul>
    </div>
</div>


</aside>
</div>