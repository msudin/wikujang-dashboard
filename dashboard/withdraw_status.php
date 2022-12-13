<?php
$data = unserialize($_GET['modal_id']);
?>

<div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Status Pencairan</h4>
        </div>
        <div class="modal-body">
        	<form action="../usecase/withdraw_uc.php" name="modal_popup" enctype="multipart/form-data" method="POST">
                <div class="form-group" style="padding-bottom: 20px;">
                    <input type="hidden" name="id" class="form-control" value="<?php echo $data['id']; ?>" />
					<div>
						<select class="form-control" style="width: 100%;" name="status">
							<option selected="selected" value="">Pilih Status</option>	
							<option value="approve">Sudah Transfer</option>
							<option value="refund">Refund</option>
						</select>  
					</div>       
                </div>
	            <div class="modal-footer">
	                <button class="btn btn-success" type="submit" name="submitStatusPencairan">Simpan</button>
	                <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">Batal</button>
	            </div>
			</form>
		</div>
	</div>
</div>