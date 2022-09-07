<?php
	session_start();
	if (empty($_SESSION['user_id']) || $_SESSION['adm_level'] !='Admin'){
		session_destroy();	
		$login_redirect_url = "../index.php";
		echo "<script>alert('Akses ditolak, Silahkan Login !'); window.location = '$login_redirect_url'</script>";
    }
  $modal_id=$_GET['modal_id'];
  
  
include '../dbcon/config.php';
include '../utils/lib.php';
?>

<html>
<body>
  
<div class="modal-dialog">
    <div class="modal-content">
    	  <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Pilih Bulan</h4>
        </div>
        <div class="modal-body">

        	<form action="" id="cetakmultiple" name="modal_popup" enctype="multipart/form-data" method="POST">
                <div class="form-group">
                	<label for="Modal Name">NIS</label>
                    <input type="hidden" name="modal_id" id="modal_id"  class="form-control" value="<?php echo $modal_id; ?>" />
                    <input type="text" name="modal_name" id="modal_name"  class="form-control" value="<?php echo $modal_id; ?>" readonly required />

                </div>
				        <div class="form-group">
                	<label for="Modal Name">- Dari Bulan -</label>
                    <select class="form-control" style="width: 100%;" name="bulan1" id="bulan1"  required>
                    <option value="01">1</option>
                    <option value="02">2</option>
                    <option value="03">3</option>
                    <option value="04">4</option>
                    <option value="05">5</option>
                    <option value="06">6</option>
                    <option value="07" selected="selected">7</option>
                    <option value="08">8</option>
                    <option value="09">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                  </select></td>
                </div>
			        	<div class="form-group">
                	<label for="Modal Name">- s/d Bulan -</label>
                    <select class="form-control" style="width: 100%;" name="bulan2" id="bulan2" required>
                    <option value="01">1</option>
                    <option value="02">2</option>
                    <option value="03">3</option>
                    <option value="04">4</option>
                    <option value="05">5</option>
                    <option value="06">6</option>
                    <option value="07">7</option>
                    <option value="08">8</option>
                    <option value="09">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12" selected="selected">12</option>
                  </select></td>
                </div>

                <div class="form-group" style="padding-bottom: 20px;" hidden>
                	<label for="Modal Name">Tahun</label>
				        	<select class="form-control" style="width: 100%;" name="tahun" id="tahun" required>
                  <?php 
                  $thn_this = date("Y"); 
                  echo"<option value='$thn_this'>$thn_this</option>";
                  for ($thn=date("Y")-2; $thn <=date("Y")+1; $thn++){
                    echo"<option value='$thn'>$thn</option>";
                  }
                  $data = 'tgl';
                  ?>
                  </select></td>
              </div>

	            <div class="modal-footer">
	                <button id="btn" class="btn btn-success">
                  <i class="glyphicon glyphicon-print"></i> Cetak
                  </button>
	                <button type="reset" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cancel</button>

	            </div>
            </form>
          </div>
        </div>
	</div>
	</div>
 
  <script>
  //JS BTN PRINT ONCLICK
  $(document).ready(function(){
    $('#btn').click(function (e){
      e.preventDefault();

      //GET DATA FORM TYPE 
      var idnis = $('#modal_name').val(); 
      var bulan1 = $('#bulan1').val();
      var bulan2 = $('#bulan2').val();
      var tahun = $('#tahun').val();  
      
      // REPLACE DIALOG TO DIALOG PRINT
      $("#printabel").remove();
      loadOtherPage1(idnis, bulan1, bulan2, tahun);
    });
  });


  function loadOtherPage1(idnis, bulan1, bulan2, tahun) {
    // console.log("idnis function"+idnis);

    $("<iframe id='printabel'>")    
        .hide()                     
        .attr("src", "../_report/cetak/faktur_multiple2.php?modal_id="+idnis+"&tahun="+tahun+"&bulan1="+bulan1+"&bulan2="+bulan2) 
        .appendTo("body");           
    };

  </script>


