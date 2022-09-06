<?php
	session_start();
	if (empty($_SESSION['user_id']) || $_SESSION['adm_level'] !='Admin'){
		session_destroy();	
		$login_redirect_url = "../index.php";
		echo "<script>alert('Akses ditolak, Silahkan Login !'); window.location = '$login_redirect_url'</script>";
	}

    include '../dbcon/config.php';
	$modal_id=$_GET['modal_id'];
	$modal=mysqli_query($koneksi, "SELECT * FROM tb_kelas WHERE id_kelas='$modal_id'");
	$r=mysqli_fetch_array($modal);
?>

<div class="modal-dialog">
    <div class="modal-content">

    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Edit Kelas</h4>
        </div>

        <div class="modal-body">
        	<form action="kelas_edit_proses.php" name="modal_popup" enctype="multipart/form-data" method="POST">
        		
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="Modal Name">Nama Kelas</label>
                    <input type="hidden" name="modal_id"  class="form-control" value="<?php echo $r['id_kelas']; ?>" />
     				<input type="text" name="modal_name"  class="form-control" value="<?php echo $r['nama_kelas']; ?>" required />
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