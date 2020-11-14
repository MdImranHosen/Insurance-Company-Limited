<?php
if (class_exists('SettingsClass')) {
	$sobj = new SettingsClass();
	if (method_exists($sobj, 'getSettingsData')) {
		$sifo = $sobj->getSettingsData();
		if ($sifo) {
			$sirows = $sifo->fetch_assoc();
			$surl   = $sirows['site_url'];
			$s_m_t  = $sirows['site_title'];
			$s_m_d  = $sirows['site_meta_description'];
			$s_m_k  = $sirows['site_meta_keyword'];

			if ($currentpage == 'index') {
				$pagename = "Home";
			} else{
				$pagename = ucfirst($currentpage);
			}

     define('BASE_PATH', $surl);
?> 

<?php

		if (!empty($_GET['psurl'])) {

		  if(($_GET['psurl'] == 0) || ($_GET['psurl'] == NULL)){
		    header('Location:'.BASE_PATH.'product-services');
		 } elseif(!preg_replace('/\D/', '', $_GET['psurl'])){
		    header('Location:'.BASE_PATH.'product-services');
		 } else{
		    $psmurl = preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['psurl']);
		    $psmurl = preg_replace('/\D/', '', $_GET['psurl']);
		    $psmurl = htmlentities($psmurl);
		    $psmurl = (int)$psmurl;

		    if (class_exists('ServicesClass')) {
		    	$psm = new ServicesClass();
		    	if (method_exists($psm, 'productsServicesUpdate')) {
		    		$psmdata = $psm->productsServicesUpdate($psmurl);
                if ($psmdata) {
                     $psmrows = $psmdata->fetch_assoc();
                     $psm_title = $psmrows['ps_title'];         
		    ?>
		 <title><?php echo $psm_title.' - '.$s_m_t; ?></title>
		<meta name="description" content="<?php echo $psm_title.' '.$s_m_d.' '.$pagename; ?>">
		<meta name="keywords" content="<?php echo $psm_title.', '.$pagename; ?>">

		 <?php } } } } } elseif (!empty($_GET['nedid'])) {

		  if(($_GET['nedid'] == 0) || ($_GET['nedid'] == NULL)){
		    header('Location:'.BASE_PATH.'news-events');
		 } elseif(!preg_replace('/\D/', '', $_GET['nedid'])){
		    header('Location:'.BASE_PATH.'news-events');
		 } else{
		    $nedid = preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['nedid']);
		    $nedid = preg_replace('/\D/', '', $_GET['nedid']);
		    $nedid = htmlentities($nedid);
		    $nedid = (int)$nedid;

		    if (class_exists('NewsEventsClass')) {
		    	$p_event = new NewsEventsClass();
		    	if (method_exists($p_event, 'getNewsEventsUpdate')) {
		    		$dataEvent = $p_event->getNewsEventsUpdate($nedid);
                if ($dataEvent) {
                     $mticon = $dataEvent->fetch_assoc();
                     $con_title_p = $mticon['news_events_title'];          
		    ?>
		 <title><?php echo $con_title_p.' - '.$s_m_t; ?></title>
		<meta name="description" content="<?php echo $con_title_p.' '.$s_m_d.' '.$pagename; ?>">
		<meta name="keywords" content="<?php echo $con_title_p.', '.$pagename; ?>">
		    <?php } } } } } else { ?>
		<title><?php echo $s_m_t.' - '.$pagename; ?></title>
		<meta name="description" content="<?php echo $s_m_d.' '.$pagename; ?>">
		<meta name="keywords" content="<?php echo $s_m_k.', '.$pagename; ?>">
		 <?php } ?>
		<meta name="author" content="<?php echo $s_m_t; ?>">
         <!-- Stylesheets -->
		<link rel="shortcut icon" href="<?php echo BASE_PATH; ?>/img/<?php echo $sirows['site_icon']; ?>" type="image/x-icon">
		<link rel="icon" href="<?php echo BASE_PATH; ?>/img/<?php echo $sirows['site_icon']; ?>" type="image/x-icon">
		 <?php } } } ?>