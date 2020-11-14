<?php
  include "../classes/Mainclass.php";
 Session::checkSession();

$admin = new Adminclass();

  if (isset($_GET['action']) && $_GET['action'] == 'logout') {
      Session::destroy();
  }

  $access_token = Session::get('access_token');
  $checkAdmin = $admin->checkAdminLogin($access_token);
  if($checkAdmin != true) {
    Session::destroy();
    header("Location:login.php");
  }

 $path = $_SERVER['SCRIPT_FILENAME'];
 $currentpage = basename($path, '.php');
 $pageName = ucwords(str_replace("_"," ",$currentpage));      

    /* Cache control or Cache Remove */
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
  ?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <?php
    if (class_exists('SettingsClass')) {
      $sobj = new SettingsClass();
      if (method_exists($sobj, 'getSettingsData')) {
        $sifo = $sobj->getSettingsData();
        if ($sifo) {
          $sirows = $sifo->fetch_assoc();
    ?> 
   <title><?php echo $sirows['site_title']; ?></title>
  <!-- Stylesheets -->
  <link rel="shortcut icon" href="../img/<?php echo $sirows['site_icon']; ?>" type="image/x-icon">
  <link rel="icon" href="../img/<?php echo $sirows['site_icon']; ?>" type="image/x-icon">
    <?php } } } ?>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Md Imran Hosen www.github.com/MdImranHosen -->
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
<!-- Md Imran Hosen www.github.com/MdImranHosen -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
    .menu_defarent{text-align: center;}
    .menu_defarent span{padding-right: 8px;}
    .menu_defarent span a{}
    .selectedStyle{cursor: pointer;border-radius: 3px;}
    .fileImage{border: 1px solid #ddd;}
    .control-froms[disabled]{cursor: not-allowed;background-color: #eee;
    opacity: 1;}
    .control-froms {
    display: block;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
  }
    .form-control{font-size: 16px;font-weight: normal;}
  </style>
</head>