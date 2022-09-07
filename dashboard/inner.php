<?php 
include '../dbcon/config.php'; ?>

<table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th width="3px">No</th>
                  <th width="120px">ID Pembayaran</th>
                  <th width="90px">NIS</th>
                  <th width="300px">Nama Siswa</th>
                  <th width="90px">Kelas</th>
                  <th width="120px">Bulan</th>
                  <th width="90px">Nominal</th>
                  <th width="140px">Tgl Pembayaran</th>
                  <th width="5px">Keterangan</th>
                 
                </tr>
                </thead>
                <tbody>


<?php
$no ="0";
$data_transaksi = mysqli_query($koneksi,  "SELECT * FROM tb_pembayaran INNER JOIN tb_siswa ON tb_pembayaran.nis_bayar=tb_siswa.id_nis WHERE kls_siswa='XII MIPA-1'" );
while($dt=mysqli_fetch_array($data_transaksi)){
                  $no++; 

                
                ?>
              
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $dt['id_bayar']; ?></td>
                  <td><?php echo $dt['nis_bayar']; ?></td>
                  <td><?php echo $dt['kls_siswa']; ?></td>
                  <td><?php echo $dt['jk_siswa']; ?></td>
                  <td><?php echo $dt['bulan_bayar']; ?></td>
                  <td><?php echo $dt['nominal_bayar']; ?></td>
                  <td><?php echo $dt['tgl_bayar']; ?></td>
                  <td><span class="badge bg-red">LUNAS</span></td>
                </tr>
                
                <?php } ?>
                </tbody>
                </table>
