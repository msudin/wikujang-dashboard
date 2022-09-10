<?php 

function checkSession() {
    if (session_id() == '') {
        session_start();
    }
}

function startSession(){
    checkSession();
    if (empty($_SESSION['id']) || $_SESSION['type'] !='admin'){
      session_destroy();	
      $login_redirect_url = "../index.php";
      echo "<script>alert('Silakan login terlebih dahulu!'); window.location = '$login_redirect_url'</script>";
      return false;
    }
}

function isEnvironmentLocal() {
    return false;
}

function serverName() {
    return "localhost";
}

function serverUserName() {
    if (isEnvironmentLocal()) {
        return "root";
    } else {
        return "wiks7958_albaar";
    }
}

function serverDbPassword() {
    if (isEnvironmentLocal()) {
        return "root";
    } else {
        return "Albaar_1234";
    }
}

function serverDbName() {
    if (isEnvironmentLocal()) { 
        return "wikujang_db";
    } else {
        return "wiks7958_wikujang";
    }
}


function baseUrl() {
    if (isEnvironmentLocal()) { 
        return "http://localhost:8888/wikujang-api/";
    } else {
        return "https://wikujang.site/apiv1";
    }
}

function urlPathImage() {
    if (isEnvironmentLocal()) {
        return "http://192.168.68.101:8888/wikujang-web/"."uploads/"; 
    } else {
        return "https://wikujang.site/dashboard/uploads/";
    }
}

?>