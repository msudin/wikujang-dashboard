<?php
$data = unserialize($_GET['modal_id']);
?>

<div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Ubah Kategori</h4>
        </div>
        <div class="modal-body">
        	<form action="../usecase/category_uc.php" name="modal_popup" enctype="multipart/form-data" method="POST">
                <div class="form-group" style="padding-bottom: 20px;">
                	<label style="font-weight: normal;">Nama Kategori</label>
                    <input type="hidden" name="id" class="form-control" value="<?php echo $data['id']; ?>" />
     				<input type="text" style="font-weight: normal;" name="name" class="form-control" value="<?php echo $data['name']; ?>" required />
                </div>
	            <div class="modal-footer">
	                <button class="btn btn-success" type="submit" name="submitEditCategoryMenu">Simpan</button>
	                <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">Batal</button>
	            </div>
			</form>
		</div>
	</div>
</div>