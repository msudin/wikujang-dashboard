<?php
	session_start();
	if (empty($_SESSION['user_id']) || $_SESSION['adm_level'] !='Tata Usaha'){
		session_destroy();	
		$login_redirect_url = "../index.php";
		echo "<script>alert('Akses ditolak, Silahkan Login !'); window.location = '$login_redirect_url'</script>";
	}
	include 'lib.php'; 
    include '../dbcon/config.php';
	$modal_id=$_GET['modal_id'];
	$modal=mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE id_nis='$modal_id'");
	$r=mysqli_fetch_array($modal);
?>

<div class="modal-dialog">
    <div class="modal-content">

    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Edit SPP</h4>
        </div>

        <div class="modal-body">
        	<form action="sispp_edit_proses.php" name="modal_popup" enctype="multipart/form-data" method="POST">
                <div class="form-group">
                	<label for="Modal Name">ID Siswa</label>
                    <input type="hidden" name="modal_id"  class="form-control" value="<?php echo $r['id_nis']; ?>" />
     				<input type="text" class="form-control" value="<?php echo $r['id_nis']; ?>" readonly />
                </div>
				<div class="form-group">
                	<label for="Modal Name">Nama Siswa</label>
     				<input type="text" name="modal_name" class="form-control" value="<?php echo $r['nama_siswa']; ?>" readonly />
                </div>
				<div class="form-group">
                	<label for="Modal Name">Kelas</label>
     				<input type="text" name="modal_kelas" class="form-control" value="<?php echo $r['kls_siswa']; ?>/ <?=$r['jk_siswa']?>" readonly />
                </div>
				<div class="form-group">
                	<label for="Modal Name">SPP (Saat Ini)</label>
     				<input type="text" name="modal_spp" class="form-control" value="<?php echo rupiah0($r['nominal_spp']); ?>" readonly />
                </div>
				<div class="form-group" style="padding-bottom: 50px;">
				<label class="col-sm-2" for="Modal Name">SPP Baru</label>
					<div class="col-xs-4">
						<select class="form-control" name="nominal_spp_auto" id="mySelect" onchange="proses()">
							<option selected="selected" value="manual">Set Manual</option>
							<?php 
							$nominal= mysqli_query($koneksi,"SELECT * FROM tb_spp"); 
							while($nspp=mysqli_fetch_array($nominal))
							{?>
							<option value="<?php echo $nspp['nominal_spp']; ?>"><?php echo rupiah1($nspp['nominal_spp']); ?></option>
							<?php } ?>
						</select>        
					</div>
					<div class="form-group" id="ifYes">
						<div class="col-sm-4">
						<input type="text" onkeyup="pisahdgnTitik(this)" class="form-control" name="nominal_spp" placeholder="Nominal Rp.">
						</div>
					</div>
			 	</div>
				 <div class="form-group">
                	<label for="Modal Name">Keterangan</label>
     				<input type="text" name="modal_keterangan" class="form-control" value="<?php echo $r['ket_siswa']; ?>"/>
                </div>
	            <div class="modal-footer" >
	                <button class="btn btn-success" type="submit">
	                    Simpan
	                </button>
	                <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">
	               		Cancel
	                </button>
	            </div>
            	</form>
            </div>
        </div>
    </div>
	<script>
    function proses() {
	var xdata = document.getElementById("mySelect").value ;
	if (xdata == "<?=$r['nominal_spp']?>"){
		document.getElementById('ifYes').style.display = 'none';
	} else if(xdata !="manual") {
      document.getElementById('ifYes').style.display = 'none';
    }else if (xdata=="manual"){
    document.getElementById('ifYes').style.display = 'block';
	}	
}</script>

	<!-- Format Rupiah Versi 2 -->
	<script type="text/javascript">
		function inputAngka(input) {
		return [].map.call(input, function(x) {
		return x;
		}).reverse().join('');
		}
		function formatTitik(number) {
		return number.split('.').join('');
		}
		function pisahdgnTitik(input) {
		var value = input.value,
		plain = formatTitik(value),
		reversed = inputAngka(plain),
		isiTitik = reversed.match(/.{1,3}/g).join('.'),
		normal = inputAngka(isiTitik);
		input.value = normal;
	}</script>