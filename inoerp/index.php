<?php
if (preg_match('/(?i)msie [5-9]/', $_SERVER['HTTP_USER_AGENT'])) {
 echo ($_SERVER['HTTP_USER_AGENT']);
 echo "<h2>Sorry! Your browser is outdated and not compatible with this site!!!</h2> "
 . "Please use any modern browsers such as Firefox, Opera, Chrome, IE 10+ ";
 exit;
}
$dont_check_login = true;
?>
<?php
if (file_exists('install.php')) {
 if (isset($_GET['install'])) {
  if ($_GET['install'] == 'done') {
   // Delete the insatll file after installation
   @unlink('install.php');
   // Redirect to main page
   header('location: index.php');
  }
 } else {
  header('location: install.php');
 }
 return;
}
?>
<?php
$content_class = true;
$class_names[] = 'content';
?>
<?php
include_once("includes/functions/loader.inc");
?>
<!DOCTYPE html>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <?php
  if (!empty($metaname_description)) {
   echo "<meta name='description' content=\"inoERP - A Open Source PHP based Enterprise Management System\">";
  }
  ?>
  <meta name="keywords" content="ERP,PHP ERP,Open Source ERP ">
  <title><?php echo isset($pageTitle) ? $pageTitle . ' - inoERP!' : ' inoERP! ' ?></title>
  <link href="<?php
//  echo THEME_URL;
//  echo (!empty($content_class)) ? '/content_layout.css' : '/layout.css'
  ?>" media="all" rel="stylesheet" type="text/css" />
  <link href="<?php echo THEME_URL; ?>/public.css" media="all" rel="stylesheet" type="text/css" />
  <link href="<?php echo THEME_URL; ?>/menu.css" media="all" rel="stylesheet" type="text/css" />
  <link href="<?php echo THEME_URL; ?>/jquery.css" media="all" rel="stylesheet" type="text/css" />
  <?php
  if (!empty($css_file_paths)) {
   foreach ($css_file_paths as $key => $css_file) {
    ?>
    <link href="<?php echo HOME_URL . $css_file; ?>" media="all" rel="stylesheet" type="text/css" />
    <?php
   }
  }
  ?>
  <link href="<?php echo HOME_URL; ?>tparty/bootstrap/css/bootstrap.css" rel="stylesheet">
  <!-- Styles -->
  <link href="<?php echo HOME_URL; ?>tparty/bootstrap/css/style.css" rel="stylesheet">
  <!-- Carousel Slider -->
  <link href="<?php echo HOME_URL; ?>tparty/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Lato:400,300,400italic,300italic,700,700italic,900' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Exo:400,300,600,500,400italic,700italic,800,900' rel='stylesheet' type='text/css'>
  <link href="<?php echo HOME_URL; ?>themes/default/index.css" media="all" rel="stylesheet" type="text/css" />
  <script src="<?php echo HOME_URL; ?>includes/js/jquery-2.0.3.min.js"></script>
  <script src="<?php echo HOME_URL; ?>includes/js/jquery-ui.min.js"></script>
  <script src="<?php echo HOME_URL; ?>tparty/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo HOME_URL; ?>tparty/bootstrap/js/menu.js"></script>
  <script src="<?php echo HOME_URL; ?>includes/js/custom/tinymce/tinymce.min.js"></script>
  <script src="<?php echo HOME_URL; ?>includes/js/save.js"></script>
  <script src="<?php echo HOME_URL; ?>includes/js/custom_plugins.js"></script>
  <script src="<?php echo HOME_URL; ?>includes/js/basics.js"></script>
  <script src="<?php echo HOME_URL; ?>includes/js/jssor.slider.mini.js"></script>
  <?php
  if (!empty($js_file_paths)) {
   foreach ($js_file_paths as $key => $js_file) {
    ?>
    <script src="<?php echo HOME_URL . $js_file; ?>"></script>
    <?php
   }
  }
  ?>
 </head>
 <body>

  <div id="topbar" class="clearfix">
   <div class="container">
    <?php
    if ($showBlock) {
     echo '<div id = "header_top" class = "clear"></div>';
    }
    ?>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
     <?php
     $show_header_links = true;
     if ((!empty($mode)) && ($mode > 8) && !empty($access_level) && $access_level > 3) {
      if (empty($current_page_path)) {
       $current_page_path = thisPage_url();
      }
      $f->form_button_withImage($current_page_path);
      $show_header_links = false;
     }
     ?>
     <?php if ($show_header_links) { ?>
      <div class="social-icons">
 <!--      <span><a data-toggle="tooltip" data-placement="bottom" title="Facebook" href="#"><i class="fa fa-facebook"></i></a></span>
      <span><a data-toggle="tooltip" data-placement="bottom" title="Google Plus" href="#"><i class="fa fa-google-plus"></i></a></span>-->
      <!--<span><a data-toggle="tooltip" data-placement="bottom" title="Twitter" href="#"><i class="fa fa-twitter"></i></a></span>-->
       <span><a data-toggle="tooltip" data-placement="bottom" title="Youtube" href="https://www.youtube.com/playlist?list=PLI9s_lIFpC099xADLymQcDCmrDhnkxcjM"><i class="fa fa-youtube"></i></a></span>
       <span><a data-toggle="tooltip" data-placement="bottom" title="Linkedin" href="#"><i class="fa fa-linkedin"></i></a></span>
       <!--<span><a data-toggle="tooltip" data-placement="bottom" title="Dribbble" href="#"><i class="fa fa-dribbble"></i></a></span>-->
       <span class="last"><a data-toggle="tooltip" data-placement="bottom" title="Skype" href="#"><i class="fa fa-skype"></i></a></span>

      </div><!-- end social icons -->
     <?php } ?>

    </div><!-- end columns -->
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     <div class="topmenu">
      <span class="topbar-login"><i class="fa fa-user"></i>
       <?php
       if (!empty($_SESSION['login_status'])) {
        echo '
        <ul class="nav navbar-nav">';
        echo '<li class="dropdown"><a aria-expanded="true" role="button" data-toggle="dropdown" class="dropdown-toggle" '
        . 'href="' . HOME_URL . 'form.php?class_name=user&amp;mode=9&amp;user_id=' . $_SESSION['user_id'] . '">';
        echo ucfirst($_SESSION['username']) . '! <span class="caret"></span></a>';
        echo '<ul role="menu" class="dropdown-menu">';
        echo '<li><a  href="' . HOME_URL . '">Home</a> </li>';
        echo '<li><a href="' . HOME_URL . 'form.php?class_name=user&mode=9&user_id=' . $_SESSION['user_id'] . '">User Details</a></li>';
        echo '<li class="child_link"><a href="' . HOME_URL . 'form.php?class_name=user_activity_v&amp;mode=2&amp;user_id=' . $_SESSION['user_id'] . '">Activities</a></li>';
        echo '<li class="child_link"><a href = "' . HOME_URL . 'search.php?class_name=sys_notification_user">All Notifications</a></li>';
        echo '<li data-path_description = "Dashborad">
       <a href = "' . HOME_URL . 'form.php?class_name=user_dashboard_v&amp;mode=2&amp;user_id=' . $_SESSION['user_id'] . '">Dashboard</a>
       </li>
       <li data-path_description = "Dashborad Configuration" class="child_link">
       <a href = "' . HOME_URL . 'form.php?class_name=user_dashboard_config&amp;mode=9&amp;user_id=' . $_SESSION['user_id'] . '">Configure</a>
       </li>';
        echo '<li class = "divider" role = "presentation"></li>';
        echo '<li><a href = "' . HOME_URL . 'extensions/user/user_logout.php"> Logout</a></li>';
       } else {
        echo '<a href = "' . HOME_URL . 'extensions/user/user_login.php">Login / Register</a>';
       }
       echo '</ul>
       </li>
       </ul>
       ';
       ?>
      </span>

     </div><!-- end top menu -->
     <div class="callus">
      <span class="topbar-email"><i class="fa fa-envelope"></i> <a href="#">contact@inoideas.org</a></span>
      <span class="topbar-phone"><i class="fa fa-phone"></i> 1-205-419-5131</span>
     </div><!-- end callus -->
    </div><!-- end columns -->
   </div><!-- end container -->
  </div><!-- end topbar -->

  <header id="header-style-1">
   <div class="container">
    <nav class="navbar yamm navbar-default">
     <div class="navbar-header">
      <img src="<?php
      echo HOME_URL;
      echo!empty($si->logo_path) ? $si->logo_path : 'files/logo.png'
      ?>" class="logo_image" alt="logo"/>
      <a href="<?php echo HOME_URL; ?>" class="navbar-brand"><?php echo!empty($si->site_name) ? $si->site_name : 'inoERP'; ?></a>
     </div>
     <div id="navbar-collapse-1" class="navbar-collapse collapse navbar-right">
      <ul class="nav navbar-nav">
       <li class="active"><a href="http://demo.inoideas.org/extensions/user/user_login.php" >DEMO <div class="arrow-up"></div></a></li>
       <li><a href="https://github.com/inoerp/inoERP" >Download <div class="arrow-up"></div></a></li>
       <li><a href="<?php echo HOME_URL; ?>content.php?content_type=documentation&amp;category_id=30">Documentation <div class="arrow-up"></div></a></li><!-- end standard drop down -->
       <li><a href="<?php echo HOME_URL; ?>content.php?content_type=forum&amp;category_id=1">Forum <div class="arrow-up"></div></a></li>
       <li><a href="<?php echo HOME_URL; ?>content.php?mode=2&amp;content_id=197&amp;content_type_id=47">About <div class="arrow-up"></div></a> </li><!-- end drop down -->
      </ul><!-- end navbar-nav -->
     </div><!-- #navbar-collapse-1 -->			
    </nav><!-- end navbar yamm navbar-default -->
   </div><!-- end container -->
  </header><!-- end header-style-1 -->

  <?php
  if ($showBlock) {
   echo '<div id="header_bottom"></div>';
  }
  ?>

  <?php
  if ($si->maintenance_cb == 1) {
   echo "<div class='error'>Site is under maintenance mode </div>";
  }

  if (!empty($access_deined)) {
   exit("Access denied ! <br> $msg <input action='action' class='button' type='button' value='Go Back' onclick='history.go(-1);
       ' />");
  }
  ?>
  <!-- end grey-wrapper -->
  <div class="grey-wrapper jt-shadow padding-top content_summary">
   <div class="make-center wow fadeInUp animated" style="visibility: visible;">
    <div class="container">
     <div id="structure">
      <?php
      $content = new content();
      $subject_no_of_char = 50;
      $summary_no_of_char = 300;
      $fp_contnts = $content->frontPage_contents(200, 500);

      $pageno = !empty($_GET['pageno']) ? $_GET['pageno'] : 1;
      $per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 6;
      $total_count = count($fp_contnts);
      $pagination = new pagination($pageno, $per_page, $total_count);
      $pagination->setProperty('_path', 'index.php?');
      $position = ($pageno - 1) * $per_page;

      $fp_contnts_ai = new ArrayIterator($fp_contnts);
      $fp_contnts_ai->seek($position);
      $cont_count = 1;
      while ($fp_contnts_ai->valid()) {
       $contnent = $fp_contnts_ai->current();
       if ($cont_count == 1 || $cont_count == 4) {
        $count_class_val = ' first ';
       } else if ($cont_count == 2 || $cont_count == 5) {
        $count_class_val = ' last ';
       } else {
        $count_class_val = '';
       }
       echo '<div class="col-lg-4' . $count_class_val . ' ">
              <div class="panel panel-success">
                <div class="panel-heading">';
       echo "<h3 class='panel-title'>";
       echo '<a href="' . HOME_URL . 'content.php?mode=2&'
       . 'content_id=' . $contnent->content_id . '&content_type_id=' . $contnent->content_type_id . '">';
       echo substr($contnent->subject, 0, $subject_no_of_char) . "</a></h3>";
       echo '</div>';
       echo "<div class='panel-body'>" . ino_strip_html($contnent->content_summary, $summary_no_of_char)  . "</div>";
       echo '</div></div>';
       $cont_count++;
       $fp_contnts_ai->next();
       if ($fp_contnts_ai->key() == $position + $per_page) {
        $cont_count = 1;
        break;
       }
      }
      ?>
     </div>
    </div>
   </div>
  </div>
  <div id="pagination1" style="clear: both;" class="pagination">
   <?php echo $pagination->show_pagination(); ?>
  </div>

  <div id="footer-style-1" class="topBottomBG">
   <div class="container">
    <div id="footer_top"></div>
   </div>
  </div>
  <div id="copyrights">
   <div class="container">
    <div class="col-lg-5 col-md-6 col-sm-12">
     <div class="copyright-text">
      <p>
       <?php
       global $si;
       echo nl2br($si->footer_message);
       ?>
      </p>
     </div><!-- end copyright-text -->
    </div><!-- end widget -->
   </div><!-- end container -->
  </div>
  <div class="dmtop">Scroll to Top</div>

  <?php
  global $f;
  echo (!empty($footer_bottom)) ? "<div id=\"footer_bottom\"> $footer_bottom </div>" : "";
  echo $f->hidden_field_withId('home_url', HOME_URL);
  ?>
 </body>
</html>