<?php
// [UC TYPE] : insert, update, delete
if (isset($_GET['uc_type'])) {
    $uc_type = $_GET['uc_type'];
    repos($uc_type);
} elseif (isset($_POST['uc_type'])) {
    $uc_type = $_POST['uc_type'];
    repos($uc_type);
}

function repos($uc_type){
    include "../dbcon/config.php";
    include "../utils/err_case.php";

    if(!empty($uc_type)) {  
        if ($uc_type == "insert"){
            $nama = $_POST['nama_modal'];
            $username = $_POST['username_modal']; 
            $password = base64_encode($_POST['pass_modal']);
            $level = $_POST['level_modal'];  
            
            $result = mysqli_query($koneksi,"INSERT INTO admin VALUES (NULL,'$nama', '$username', '$password', $level)");
            if ($result == 1) {
                // Create Log Activity  
                $deskripsi = "Menambahkan Admin, ID=".$nama; 
                $timestamp = date('d-m-Y H:i:s'); 
                $aksi = "Insert"; 
                $userlog = $_SESSION['adm_username'];
                mysqli_query($koneksi, "INSERT INTO tb_log VALUES ('$timestamp', '$aksi', '$userlog', '$deskripsi')");
                // -- End Create Log --
    
                ob_start();
                header('location:adm_data.php?message=add_success');
                exit();
            } else {
                ucHandler("{$uc_type} => Failed insert admin");
            }
    
        } elseif ($uc_type == "delete"){
            $modal_id= $_GET['modal_id'];
    
            $select = mysqli_query($koneksi, "SELECT * FROM admin WHERE id_admin='$modal_id'"); 
            $slt = mysqli_fetch_array($select); 
            $id_slt = $slt['adm_fullname'];   
            $result = mysqli_query($koneksi,"Delete FROM admin WHERE id_admin='$modal_id'");
    
            if ($result == 1){
                // Create Log Activity  
                $deskripsi = "Menghapus Admin, ID=".$modal_id."Value=".$id_slt; 
                $timestamp = date('d-m-Y H:i:s'); 
                $aksi = "Delete"; 
                $userlog = $_SESSION['adm_username'];
                mysqli_query($koneksi, "INSERT INTO tb_log VALUES ('$timestamp', '$aksi', '$userlog', '$deskripsi')");
                // -- End Create Log --  
                
                ob_start(); 
                header('location:adm_data.php?message=delete_success');
                exit();
            } else {
                ucHandler("{$uc_type} => Failed delete admin");
            }
    
        } elseif ($uc_type == "update"){
            $modal_id = $_POST['modal_id'];
            $modal_name = $_POST['modal_name'];
            $modal_user = $_POST['modal_username'];
            $modal_level = $_POST['modal_level'];
            $modal_pass = base64_encode($_POST['modal_pass']);   
            
            $result = 0;
            if(empty($_POST['modal_pass'])) {
               $result = mysqli_query($koneksi,"UPDATE admin SET adm_fullname= '$modal_name', adm_username='$modal_user', adm_level='$modal_level' WHERE id_admin='$modal_id'");   
            } else {
              $result = mysqli_query($koneksi,"UPDATE admin SET adm_fullname= '$modal_name', adm_username='$modal_user', adm_pass='$modal_pass', adm_level='$modal_level' WHERE id_admin='$modal_id'");
            }
             
           if ($result == 1){
                // Create Log Activity  
                $deskripsi = "Merubah Admin, ID=".$modal_id; 
                $timestamp = date('d-m-Y H:i:s'); 
                $aksi = "Update"; 
                $userlog = $_SESSION['adm_username'];
                mysqli_query($koneksi, "INSERT INTO tb_log VALUES ('$timestamp', '$aksi', '$userlog', '$deskripsi')");
    
                ob_start(); 
                header('location:adm_data.php?message=edit_success');
                exit();
           } else {
               ucHandler("{$uc_type} => Failed update admin");
           }
        } 
    } else { 
        ucHandler($uc_type);
    }
}


// FUNCTIONS 
function getDataAdmin(){
    include "../dbcon/config.php";

    $dataList = $koneksi -> query("select * from admin");
    return $dataList; 
}
?>