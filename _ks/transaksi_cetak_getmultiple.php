<?php
	session_start();
	if (empty($_SESSION['user_id']) || $_SESSION['adm_level'] !='Tata Usaha'){
		session_destroy();	
		$login_redirect_url = "../index.php";
		echo "<script>alert('Akses ditolak, Silahkan Login !'); window.location = '$login_redirect_url'</script>";
	}

    include '../dbcon/config.php';
	$modal_id=$_GET['modal_id'];
	$modal=mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE nis_bayar='$modal_id'");
	$r=mysqli_fetch_array($modal); 
?>

<div class="modal-dialog">
    <div class="modal-content">

    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Pilih Bulan</h4>
        </div>

        <div class="modal-body">
        	<form action="../_report/cetak/faktur_multiple.php" name="modal_popup" enctype="multipart/form-data" method="POST" target="_blank">
        		
                <div class="form-group">
                	<label for="Modal Name">NIS</label>
                    <input type="hidden" name="modal_id"  class="form-control" value="<?php echo $r['nis_bayar']; ?>" />
     				<input type="text" name="modal_name"  class="form-control" value="<?php echo $r['nis_bayar']; ?>" readonly required />
                </div>

				<div class="form-group">
                	<label for="Modal Name">Bulan</label>
                    <select class="form-control" style="width: 100%;" name="bulan1" required>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                  </select></td>
                </div>
				<div class="form-group">
                	<label for="Modal Name">- Bulan</label>
                    <select class="form-control" style="width: 100%;" name="bulan2" required>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                  </select></td>
                </div>
				<div class="form-group" style="padding-bottom: 20px;">
                	<label for="Modal Name">Tahun</label>
					<select class="form-control" style="width: 100%;" name="tahun" required>
                  <?php for ($thn=date("Y"); $thn <=date("Y")+1; $thn++){
                    echo"<option value='$thn'>$thn</option>";
                  }
                  $data = 'tgl';
                  ?>
                  </select></td>
                </div>
	            <div class="modal-footer">
	                <button class="btn btn-success" type="submit">
					<i class="glyphicon glyphicon-print"></i> Cetak
	                </button>
	                <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">
	               		Cancel
	                </button>
	            </div>

            	</form>
   

            </div>

           
        </div>
	</div>
	</div>