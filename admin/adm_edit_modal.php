<?php
	session_start();
	if (empty($_SESSION['user_id']) || $_SESSION['adm_level'] !='Admin'){
		session_destroy();	
		$login_redirect_url = "../index.php";
		echo "<script>alert('Akses ditolak, Silahkan Login !'); window.location = '$login_redirect_url'</script>";
	}

	include '../utils/lib.php';
    include '../dbcon/config.php';


	$modal_id=$_GET['modal_id'];
	$modal=mysqli_query($koneksi, "SELECT * FROM admin WHERE id_admin='$modal_id'");
	$r=mysqli_fetch_array($modal);
?>

<div class="modal-dialog">
    <div class="modal-content">

    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Edit Administrator</h4>
        </div>

        <div class="modal-body">
        	<!-- <form action="adm_edit_proses.php" name="modal_popup" enctype="multipart/form-data" method="POST"> -->
			<form action="adm_uc.php" name="modal_popup" enctype="multipart/form-data" method="POST">
        		
                <div class="form-group">
                	<label for="Modal Name">Nama </label>
					<input type="hidden" name="uc_type"  class="form-control" value="update"/>
                    <input type="hidden" name="modal_id"  class="form-control" value="<?php echo $r['id_admin']; ?>" />
     				<input type="text" name="modal_name"  class="form-control" value="<?php echo $r['adm_fullname']; ?>" required />
				</div>
				<div class="form-group">
                	<label >Username </label>
     				<input type="text" name="modal_username"  class="form-control" value="<?php echo $r['adm_username']; ?>" required />
				</div>
				<div class="form-group">
					<label for="Modal Name">Password Baru <i> <h6> * Biarkan Tetap Kosong Bila Tidak Ingin Mengganti Password </h6> </i> </label>
     				<input type="password" name="modal_pass"  class="form-control" placeholder="Masukkan Password Baru" />
				</div>
				<div class="form-group" style="padding-bottom: 10px;">
					<label for="Modal Name">Level </label>
					<select class="form-control" name="modal_level" id="mySelect">
						<option selected="selected" value="<?=$r['adm_level'];?>"><?=$akses[$r['adm_level']];?></option>
						<option value="1">Admin</option>
						<option value="2">Tata Usaha</option>
						<option value="3">Kepala Sekolah</option>
					</select>
                </div>
	            <div class="modal-footer">
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