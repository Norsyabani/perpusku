<?php
  if(!isset($_SESSION['nama'])){
  echo "<script> alert('Silahkan login terlebih dahulu'); </script>";
  echo "<meta http-equiv='refresh' content='0; url=../login.php'>";
  }else{
?>
<!-- ini untuk konten -->
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Admin <small>Daftar Buku</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-book"></i>Dashboard</a></li>
      <li class="active">Daftar Buku</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Daftar Buku</h3> <br>
            <a href="?page=tambah_buku" class="btn btn-primary">Tambah Buku</a>
            <a target="blank" href="print_buku.php" class="btn btn-danger"><i class="fa fa-print"
                aria-hidden="true"></i> Print</a>
            <div class="box-tools">
              <form action="?page=cari_buku" method="POST">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="cari" class="form-control pull-right" placeholder="Cari...">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </form>
            </div>
            <table class="table table-bordered">
              <?php 
                $halaman = 5;
                $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
                $result = mysqli_query($link, "SELECT*FROM tb_buku");
                $total = mysqli_num_rows($result);
                $pages = ceil($total/$halaman);
                $query = mysqli_query($link, "SELECT*FROM tb_buku LIMIT $mulai, $halaman") or die(mysqli_error($link));
                ?>
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Judul</th>
                  <th>Pengarang</th>
                  <th>Penerbit Tahun</th>
                  <th>Cover</th>
                  <th>Jumlah</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $m = 1; 
                  while ($buku=mysqli_fetch_array($query)) {
                    $a = $buku['cover']; ?>
                <tr>
                  <td><?php echo $m; ?></td>
                  <td><a href="?page=detail_buku&id=<?php echo $buku[0]; ?>"><?php echo $buku[1]; ?></a></td>
                  <td><?php echo $buku[2]; ?></td>
                  <td><?php echo $buku[3]; ?></td>
                  <td><?php echo '<img src="../assets/image/cover/'.$a.'"alt="" width=40 height=40>'; ?></td>
                  <td><?php echo $buku['jumlah_buku']; ?></td>
                  <td>
                    <a href="?page=edit_buku&id=<?php echo $buku[0]; ?>"><i class="fa fa-edit"></i></a> || <a
                      href="?page=hapus_buku&id=<?php echo $buku[0]; ?>"
                      onclick="return confirm('Anda yakin Ingin menghapus Buku <?php echo $buku[1]; ?> ?')"><i
                        class="fa fa-trash"></i></a>
                  </td>
                </tr>
                <?php 
                    $m++;
                  }
                    ?>
              </tbody>

            </table>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">Halaman</a></li>
                <?php for($i=1; $i<=$pages; $i++) { ?>
                <li><a href="?page=list_buku&halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
<?php
}
?>