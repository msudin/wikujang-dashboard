<?php 


// GET DATA FROM METHOD POST AJAX
if (isset($_POST['uc_type'])) {
    repos($_POST['uc_type']);
}

function repos($uc_type) {
    include "../dbcon/config.php";
    include "../utils/auth_case.php";

    sessionStart();
    if ($uc_type == "update") {
        $id_nis = $_POST['id_nis'];
        $new_kelas = $_POST['new_kelas'];
        $status = $_POST['status'];
        
        //  echo "idnis : $id_nis ------,  "; 
        //  echo "newkelas : $new_kelas --------,  ";
        //  echo "status : $status --------,  ";  
        
        $sql = mysqli_query($koneksi, "UPDATE tb_siswa SET kls_siswa='$new_kelas', status_siswa='$status' WHERE id_nis='$id_nis'");
        echo "status query : $sql ";
        
        
        // Create Log Activity  
        $deskripsi = "Naik Kelas Siswa, ID=".$id_nis; 
        $timestamp = date('d-m-Y H:i:s'); 
        $aksi = "Update"; 
        $userlog = $_SESSION['adm_username'];
        mysqli_query($koneksi, "INSERT INTO tb_log VALUES ('$timestamp', '$aksi', '$userlog', '$deskripsi')");
    }
}


// FUNCTIONS
function getDataKelas() {
    include "../dbcon/config.php";

    $dataList = mysqli_query($koneksi, "SELECT * FROM tb_kelas"); 
    return $dataList;
}

function getDataSiswa($kls) {
    include "../dbcon/config.php";

    $dataList = mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE kls_siswa like '%$kls%' ORDER BY id_nis ASC"); 
    return $dataList;
}

?>