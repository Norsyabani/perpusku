<?php
  include '../topmenu_template.php';
  include '../sidebar_template.php';
  include '../db/koneksi.php';
?>
<?php
  error_reporting(0);
  // membuat route
  switch ($_GET['page']) {
  default:
  include "dashboard.php";
  break;

  }
  ?>
<!-- Disini untuk footer_template.php -->
<?php include '../footer_template.php';