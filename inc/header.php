<?php include 'classes/Mainclass.php'; ?>
 <?php
 $path = $_SERVER['SCRIPT_FILENAME'];
 $currentpage = basename($path, '.php');

 $pageName = ucwords(str_replace("-"," ",$currentpage));
 $pageReal = ucwords(str_replace("-","_",$currentpage));

 date_default_timezone_set('UTC');
 date_default_timezone_set("Asia/Dacca");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<?php include 'meta_icon.php'; ?>
<link href="<?php echo BASE_PATH; ?>css/bootstrap.css" rel="stylesheet">
<link href="<?php echo BASE_PATH; ?>css/owl.css" rel="stylesheet">
<link href="<?php echo BASE_PATH; ?>css/style.css" rel="stylesheet">
<link href="<?php echo BASE_PATH; ?>css/flaticon.css" rel="stylesheet">
<link href="<?php echo BASE_PATH; ?>css/responsive.css" rel="stylesheet">
<link href="<?php echo BASE_PATH; ?>css/bootstrap-datepicker.min.css" rel="stylesheet">
<!--Color Switcher Mockup-->
<link href="<?php echo BASE_PATH; ?>css/color-switcher-design.css" rel="stylesheet">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>css/bootstrap-select.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo BASE_PATH; ?>css/event.css">
</head>
<body style="background: #F9F9F9;">