<?php 

if (isset($_GET['uc_type'])) {
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
    if ($uc_type == "insert") {
        $nis = $_POST['nis']; 
        $nama= $_POST['nama']; 
        $jk = $_POST['jk']; 
        $kelas = $_POST['kelas']; 
        $keterangan = $_POST['keterangan']; 
    
        //Cek Data Siswa
        $cek_nis = "SELECT * FROM tb_siswa WHERE id_nis='$nis'"; 
        $qry = mysqli_query($koneksi, $cek_nis); 
    
        if (mysqli_num_rows($qry) == 1){
            header('location:siswa_input.php?message=nis_used');
        } else {
            if ($_POST['nominal_spp_auto'] != "manual"){
                $nomi = $_POST['nominal_spp_auto']; 
                $result = mysqli_query($koneksi,"INSERT INTO tb_siswa VALUES ('$nis','$nama', '$jk', '$kelas', '$nomi', '$keterangan', 0)");

                if ($result) {
                    ob_start(); 
                    header('location:siswa_input.php?message=add_success');
                    exit();
                } else {  
                    ob_start(); 
                    header('location:siswa_input.php?message=add_failed');
                    exit();
                }
            } elseif ($_POST['nominal_spp_auto'] == "manual") {
                if ($_POST['nominal_spp'] == null){
                    $nomi = "0"; 
                } else {
                    $nomi = $_POST['nominal_spp'];
                }
                
                $simpan = str_replace(".", "", $nomi);
                $sql = mysqli_query($koneksi,"INSERT INTO tb_siswa VALUES ('$nis','$nama', '$jk', '$kelas', '$simpan', '$keterangan', 0)");
                
                if ($sql) {
                    // Create Log Activity  
                    $deskripsi = "Menambahkan Siswa, ID=".$nis; 
                    $timestamp = date('d-m-Y H:i:s'); 
                    $aksi = "Insert"; 
                    $userlog = $_SESSION['adm_username'];
                    mysqli_query($koneksi, "INSERT INTO tb_log VALUES ('$timestamp', '$aksi', '$userlog', '$deskripsi')");
                    // -- End Create Log --

                    ob_start();
                    header('location:siswa_input.php?message=add_success');
                    exit();
                } else {
                    ob_start(); 
                    header('location:siswa_input.php?message=add_failed');
                    exit();
                }
            }
        }
    } elseif ($uc_type == "delete") {
        $modal_id=$_GET['modal_id'];
        $select = mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE id_nis='$modal_id'"); 
        $slt = mysqli_fetch_array($select); 
        $id_slt = $slt['nama_siswa'];

        $result = mysqli_query($koneksi,"Delete FROM tb_siswa WHERE id_nis='$modal_id'");
        if ($result) {
             // Create Log Activity  
            $deskripsi = "Menghapus Siswa, ID=".$modal_id."Value".$id_slt; 
            $timestamp = date('d-m-Y H:i:s'); 
            $aksi = "Delete"; 
            $userlog = $_SESSION['adm_username'];
            mysqli_query($koneksi, "INSERT INTO tb_log VALUES ('$timestamp', '$aksi', '$userlog', '$deskripsi')");
            // -- End Create Log --

            ob_start(); 
            header('location:siswa_data.php?message=delete_success');
            exit();
        } else {
            ucHandler("Failed delete data");
        }
    } elseif ($uc_type == "update") {
        if(isset($_POST['simpan_edit'])){
            $nis = $_POST['nis']; 
            $nama = $_POST['nama']; 
            $jk_siswa = $_POST['jk'];
            $kelas = $_POST['kelas']; 
         
            $result = mysqli_query($koneksi,"UPDATE tb_siswa SET nama_siswa='$nama', jk_siswa='$jk_siswa', kls_siswa='$kelas' WHERE id_nis='$nis'");
            if ($result) {
                // Create Log Activity  
                $deskripsi = "Merubah Siswa, ID=".$nis; 
                $timestamp = date('d-m-Y H:i:s'); 
                $aksi = "Update"; 
                $userlog = $_SESSION['adm_username'];
                mysqli_query($koneksi, "INSERT INTO tb_log VALUES ('$timestamp', '$aksi', '$userlog', '$deskripsi')");
                // -- End Create Log --

                ob_start(); 
                header('location:siswa_data.php?message=edit_success');
                exit();
            } else {
                ucHandler("Update data failed"); 
            }
         }
    }
}

// FUNCTIONS 
function validateSession(){
    include '../utils/auth_case.php';

    validateAdminSession();
}

function getKelas(){
    include '../dbcon/config.php';

    $data = mysqli_query($koneksi,"SELECT * FROM tb_kelas"); 
    return $data;
}

function getSPP(){
    include '../dbcon/config.php';

    $data = mysqli_query($koneksi,"SELECT * FROM tb_spp"); 
    return $data;
}

function getDetailSiswa($id) {
    include '../dbcon/config.php';

    $sql = "SELECT * FROM tb_siswa WHERE id_nis='$id'";
    $qry = mysqli_query($koneksi, $sql); 
    $ds = mysqli_fetch_array($qry); 
    return $ds;
}

?>