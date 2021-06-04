<?php
include '../db/koneksi.php';
include '../topmenu_template.php';
include '../sidebar_template.php';
?>

<?php
error_reporting(0);

// membuat route
switch ($_GET['page']) {
    default:
      include "dashboard.php";
      break;
    case "tambah_user":
      include "tambah_user.php";
      break;
    case "simpan_user":
      include "simpan_user.php";
      break;
    case "detail_user":
      include "detail_user.php";
      break;
    case "list_user":
      include "list_user.php";
      break;
    case "edit_user":
      include "edit_user.php";
      break;
    case "update_user":
      include "update_user.php";
      break;
    case "hapus_user":
      include "hapus_user.php";
      break;

    // untuk anggota
    case "tambah_anggota":
      include "tambah_anggota.php";
      break;
    case "simpan_anggota":
      include "simpan_anggota.php";
      break;
    case "detail_anggota":
      include "detail_anggota.php";
      break;
    case "list_anggota":
      include "list_anggota.php";
      break;
    case "hapus_anggota":
      include "hapus_anggota.php";
      break;
    case "edit_anggota":
      include "edit_anggota.php";
      break;
    case "update_anggota":
      include "update_anggota.php";
      break;
    case "print_anggota":
      include "print_anggota.php";
      break;
}
?>

<!-- Disini untuk footer_template.php -->
<?php include '../footer_template.php';