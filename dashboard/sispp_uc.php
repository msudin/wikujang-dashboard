<?php 
if (isset($_GET['uc_type'])){
    $uc_type = $_GET['uc_type'];
    repos($uc_type);
} elseif (isset($_POST['uc_type'])) {
    $uc_type = $_POST['uc_type'];
    repos($uc_type);
}

function repos($uc_type) {
    include '../dbcon/config.php';
    include '../utils/err_case.php';

    validateSession();
    if ($uc_type == "update") { 
        $modal_id=$_POST['modal_id'];
        $keterangan = $_POST['modal_keterangan']; 

        if ($_POST['nominal_spp_auto'] != "manual"){
            $nomi = $_POST['nominal_spp_auto']; 
            $result = mysqli_query($koneksi,"UPDATE tb_siswa SET nominal_spp='$nomi' WHERE id_nis='$modal_id'" );

            if ($result == 1) {
                ob_start(); 
                header('location:sispp_data.php?message=edit_success');
                exit();
            } else {
                ucHandler("Update failed");
            }
        } elseif ($_POST['nominal_spp_auto'] == "manual"){
            if($_POST['nominal_spp'] == null){
                $nomi1 = $_POST['modal_spp'];
                $simpan = str_replace("Rp", "", $nomi1);
            } else {
                $simpan = $_POST['nominal_spp'];
            }
        
            $nomi = str_replace(".", "", $simpan);
            $result = mysqli_query($koneksi,"UPDATE tb_siswa SET nominal_spp='$nomi',  ket_siswa='$keterangan' WHERE id_nis='$modal_id' " );

            if ($result == 1) {
                // Create Log Activity  
                $deskripsi = "Merubah SPP, ID=".$modal_id; 
                $timestamp = date('d-m-Y H:i:s'); 
                $aksi = "Update"; 
                $userlog = $_SESSION['adm_username'];
                mysqli_query($koneksi, "INSERT INTO tb_log VALUES ('$timestamp', '$aksi', '$userlog', '$deskripsi')");
                // -- End Create Log --
                
                ob_start(); 
                header('location:sispp_data.php?message=edit_success');
                exit();
            } else {
                ucHandler("Update failed");
            }          
        }
    } else {
        ucHandler("Method undefined");
    }
}


// FUNCTIONS 
function validateSession(){
    include '../utils/auth_case.php';

    validateAdminSession();
}

function getData() {
    include '../dbcon/config.php';

    $data = mysqli_query($koneksi, "SELECT * FROM tb_siswa ORDER BY id_nis ASC"); 
    return $data;
}

?>