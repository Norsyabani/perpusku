<?php
if (!isset($_SESSION['nama'])) {
    echo "<script> alert('Silahkan login terlebih dahulu'); </script>";
    echo "<meta http-equiv='refresh' content='0; url=../login.php'>";
} else {
    ?>
<!-- ini untuk konten -->
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Admin <small>Detail User</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-book"></i>Dashboard</a></li>
      <li class="active">Detail User</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Detail User User</h3>
          </div>
          <table class="table table-bordered">
            <?php
                            //apakah ada GET id
                            $id = isset($_GET['id']) ? $_GET['id'] : "";

    //jalankan query ambil data sesuai GET id
    $query = mysqli_query($link, "SELECT * FROM tb_user WHERE id='$id'");
    //tampung data ke dalam variabel $data
    $data = mysqli_fetch_array($query); ?>

            <tbody>
              <tr>
                <th width="30%">ID</th>
                <td>: <?php echo $data[0]; ?>
                </td>
              </tr>
              <tr>
                <th width="30%">Username</th>
                <td>: <?php echo $data[1]; ?>
                </td>
              </tr>
              <tr>
                <th width="30%">Password</th>
                <td>: <?php echo $data['password']; ?>
                </td>
              </tr>
              <tr>
                <th width="30%">Email</th>
                <td>: <?php echo $data['email']; ?>
                </td>
              </tr>
              <tr>
                <th width="30%">Foto</th>
                <td>
                  <?php $cek =  $data['foto'];
    if (isset($data['foto'])) {
        echo ": <img src='../assets/image/$cek', alt='Foto User' width='200' height='200'>";
    } else {
        echo ": Tidak ada foto";
    } ?>
                </td>
              </tr>
              <tr>
                <th width="30%">Level</th>
                <td>: <?= ($data[5] == '1' ? 'Admin' : 'User'); ?>
                </td>
              </tr>
              <tr>
                <td></td>
                <?php $id = $data['id']; ?>
                <td colspan="2"><a href='?page=edit_user&id=<?php echo $id; ?>' class="btn btn-info">Edit User</a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>
<?php
}