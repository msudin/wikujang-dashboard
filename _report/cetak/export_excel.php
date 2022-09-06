<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$date = date('d/m/Y');
header("Content-Disposition: attachment; filename=export-log-$date.xls");
?>

<table border="1">
 <tr>
 <th>NO.</th>
 <th>timestamp</th>
 <th>aksi</th>
 <th>user_log</th>
 <th>deskripsi</th>
 </tr>
 <?php
 //koneksi ke database
 include '../../dbcon/config.php';
 
 //query menampilkan data
 $sql = mysqli_query($koneksi, "SELECT * FROM tb_log");
 $no = 1;
 while($data = mysqli_fetch_assoc($sql)){
 echo '
 <tr>
 <td>'.$no.'</td>
 <td>'.$data['timestamp'].'</td>
 <td>'.$data['aksi'].'</td>
 <td>'.$data['user_log'].'</td>
 <td>'.$data['deskripsi'].'</td>
 </tr>
 ';
 $no++;
 }
 ?>
</table>