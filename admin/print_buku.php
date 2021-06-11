<?php
// memanggil library FPDF
require '../lib/fpdf.php';
include '../db/koneksi.php';
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('L','mm','A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);
// mencetak string
$pdf->Image('../assets/image/logo-uniska.png',75,5, 25,25);
$pdf->Cell(290,7,'UNIVERSITAS ISLAM KALIMANTAN',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(290,7,'LAPORAN DATA BUKU',0,1,'C');
$pdf->Line(10,32,285,32);
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,10,'',0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,6, 'NO', 1,0);
$pdf->Cell(108,6,'JUDUL',1,0,'C');
$pdf->Cell(50,6,'PENGARANG',1,0,'C');
$pdf->Cell(30,6,'ISBN',1,0, 'C');
$pdf->Cell(50,6,'PENERBIT/TAHUN',1,0, 'C');
$pdf->Cell(18,6,'LOKASI',1,0, 'C');
$pdf->Cell(10,6,'JML',1,1);
$pdf->SetFont('Arial','',10);
$anggota = mysqli_query($link, "SELECT * FROM tb_buku");
$no=1;
while ($row = mysqli_fetch_array($anggota)){
  $pdf->Cell(10,6, $no.'.', 1,0);
  $pdf->Cell(108,6,$row['judul'],1,0);
  $pdf->Cell(50,6,$row['pengarang'],1,0);
  $pdf->Cell(30,6,$row['isbn'],1,0);
  $pdf->Cell(50,6,$row['penerbit'].', '.$row['thn_terbit'],1,0);
  $pdf->Cell(18,6,$row['lokasi'],1,0);
  $pdf->Cell(10,6,$row['jumlah_buku'],1,1);
  $no++;
}
$pdf->Output();
?>