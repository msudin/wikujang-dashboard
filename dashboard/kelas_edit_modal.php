<?php
include_once '../utils/auth_case.php';
include_once '../dbcon/config.php';
include_once 'kelas_uc.php';

$r = getKelasDetail($_GET['modal_id']); 

?>

<div class="modal-dialog">
    <div class="modal-content">

    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Edit Kelas</h4>
        </div>

        <div class="modal-body">
        	<form action="kelas_uc.php" name="modal_popup" enctype="multipart/form-data" method="POST">
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="Modal Name">Nama Kelas</label>
                    <input type="hidden" name="modal_id"  class="form-control" value="<?php echo $r['id_kelas']; ?>" />
					<input type="hidden" name="uc_type" value="update" />
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