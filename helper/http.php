<?php 

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