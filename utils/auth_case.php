<?php 

function validateAdminSession(){
    if(session_id() == '') {
        session_start();
    }

    if (empty($_SESSION['user_id']) || $_SESSION['adm_level'] !='Admin'){
      session_destroy();	
      $login_redirect_url = "../index.php";
      echo "<script>alert('Akses ditolak, Silahkan Login !'); window.location = '$login_redirect_url'</script>";
      return false;
    }
}

function sessionStart() {
    if(session_id() == '') {
        session_start();
    }
}

?>