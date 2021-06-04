<?php

//menghubungkan koneksi database
include '../db/koneksi.php';

if ($_POST['simpan']) {
    //ambil semua isian dari form
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $email      = $_POST['email'];
    $foto       = $_POST['foto'];
    $level      = $_POST['level'];
    $pass       = md5($password);

    //untuk pengaturan file yang diunggah
    $extensi_diperbolehkan = array('png', 'jpg', 'jpeg');

    //mengambil nama dari file yang diunggah
    $nama = $_FILES['foto']['name'];

    //memisahkan string yang ditandai dengan titik
    $x = explode('.', $nama);

    //mengambil ekstensi file
    $extensi = strtolower(end($x));

    //mengambil ukuran
    $ukuran = $_FILES['foto']['size'];
    $file_tmp = $_FILES['foto']['tmp_name'];

    //diperiksa apakah ekstensinya sesuai
    if (in_array($extensi, $extensi_diperbolehkan) === true) {
        //jika ektensi sesuai, periksa lagi apakah ukuran filenya sesuai (5MB)
        if ($ukuran <= 41943040) {
            //jika ektensi dan ukuran sesuai, pindahkan file ke folder tujuan
            move_uploaded_file($file_tmp, '../assets/image/' . $nama);

            //simpan data
            $query = mysqli_query($link, "INSERT INTO tb_user(username, password, email, foto, level) VALUES('$username','$pass','$email','$nama','$level')");

            //periksa apakah query simpannya berhasil
            if (!$query) {
                //jika gagal tampikan pesan gagal
                $isi = "Gagal Menambahkan Data dengan kesalahan =  " . mysqli_errno($link) . " - " . mysqli_error($link);
                //pindah ke halaman tambah user dan tampilkan status gagal
                echo "<meta http-equiv='refresh' content='0; url=home.php?page=tambah_user.php?status=$isi'>";
            } else {
                //jika berhasil, kita ambil data user yang baru ditambahkan kemudian arahkan ke halaman detail_user
                $query = mysqli_query($link, "SELECT id FROM tb_user WHERE username='$username'");
                $data = mysqli_fetch_array($query);
                $id = $data[0];
                echo "<script> alert('Data Berhasil Ditambahkan') </script>";
                echo "<meta http-equiv='refresh' content='0; url=home.php?page=detail_user&id=$id'>";
            }
        } else {
            $isi = "FIle terlalu besar =  " . mysqli_errno($link) . " - " . mysqli_error($link);
            echo "<meta http-equiv='refresh' content='0; url=home.php?page=tambah_user.php&status=$isi'>";
        }
    } else {
        $isi = "Extensi File Tidak Diperbolehkan =  " . mysqli_errno($link) . " - " . mysqli_error($link);
        die(mysqli_error($link));
        echo "<meta http-equiv='refresh' content='0; url=home.php?page=tambah_user&status=$isi'>";
    }
}