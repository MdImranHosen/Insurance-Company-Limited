<?php
  include "../classes/Mainclass.php";
  Session::checkLogin();
?>
<?php

try {

if (class_exists('Adminclass')) {
    
  $al = new Adminclass();

  if (is_object($al)) {

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login_admin'])) {

      $admin_email  = $_POST['email'];
      $admin_pass   = $_POST['password'];
      $admin_type   = 2; //$_POST['admin_type'];

      if (empty($admin_email) || empty($admin_pass) || empty($admin_type)) {
          $login_mas = '<div class="alert alert-warning" role="alert">
                    Field Must not be Empty!
                   </div>';
      } else{

        if ($admin_type == 1) {

          $login_mas = $al->admin_subcheck($admin_email,$admin_pass,$admin_type);
          
        } else if ($admin_type == 2) {
          $login_mas = $al->admin_loginchak($admin_email,$admin_pass,$admin_type);
        }
        
      }
   }

   }
  }
  
} catch (Exception $e) {
  $login_mas = "<div class='alert alert-warning'>Something went Wrong.</div>";
}

?>

<!DOCTYPE html>
<html>
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
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">

    .ligin_bottom_bt{display: none;}
    .espacebottom{margin-bottom: 5px;}
    .signin_title{display: none;}
    .captcha_input_style{width: 150px;padding: 5px;border: 1px solid #ccc;margin-left: 5px;}
    @media(max-width:360px ){
      .ligin_bottom_bt{display: block;}
      .ligin_bottom_bta{display: none;}
      .signin_title_up{display: none;}
      .signin_title{display: block;}
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a target="_blank" href="#"><b>Admin</b>Panel</a>
  </div>
  <!-- /.login-logo -->
    <div class="login-box-body">
    <p class="login-box-msg">
     <?php  if (isset($login_mas)) { echo $login_mas; ?>
       <script type="text/javascript">
        setTimeout(function(){
          window.location.href='login.php';
        },2000)
       </script>
     <?php } else{ ?>
      <h4 align="center" class="btn btn-lg btn-success btn-block btn-flat signin_title_up">Sign in to start your session</h4>
      <h5 align="center" class="btn btn-md btn-success btn-block btn-flat signin_title">Sign in to start your session</h5>
      <?php } ?>
    </p>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <!-- <div class="form-group has-feedback">
        <select class="form-control" name="admin_type" id="admin_type">
          <option value="" style="display: none;"> Select Admin Type </option>
          <option value="1"> Sub Admin </option>
          <option value="2"> Admin </option>
        </select>
      </div> -->
            
      <div class="row ligin_bottom_bta">
        <!-- /.col -->
        <div class="col-xs-8 col-xs-offset-2">
          <button type="submit" name="login_admin" onclick="return validate();" class="btn btn-danger btn-block">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
      <div class="row ligin_bottom_bt">
        <div class="col-xs-12">
           <button type="submit" name="login_admin" onclick="return validate();" class="btn btn-danger btn-block espacebottom">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <hr>
    <?php
    if (class_exists('SettingsClass')) {
        $sobj = new SettingsClass();
        if (method_exists($sobj, 'getSettingsData')) {
            $sifo = $sobj->getSettingsData();
            if ($sifo) {
                $sirows = $sifo->fetch_assoc();
    ?>
    <p style="padding-top: 20px;padding-bottom: 0px;margin-bottom: 0px;" align="center"> Copyright &copy; <?php echo $sirows['site_copy_right']; ?> <a target="_blank" href="#">  <?php echo $sirows['site_dev']; ?> </a></p>
    
    <?php } } } ?>
  </footer>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- Md Imran Hosen www.github.com/MdImranHosen -->
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>