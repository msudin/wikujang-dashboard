<?php
include_once('../helper/import.php');

if (isset($_POST['submitEditCategoryMenu'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    updateCategoryMenu($id, $name);
}

if (isset($_POST['submitAddCategoryMenu'])) {
    $name = $_POST['name'];
    addCategoryMenu($name);
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == "deleteCategoryMenu") {
        $id = $_GET['id'];
        deleteCategoryMenu($id);
    } else {
        ob_start(); 
        header('location: ../dashboard/category.php?success=invalid');
        exit();
    }
}

function getCategoryMenu() {
    $baseUrl = baseUrl();
    $response = callAPI('GET', $baseUrl.'/api-admin/category_all.php', false);
    if ($response->success) {
        return $response->data;
    } else {
        return array();
    }
}

function addCategoryMenu($name) {
    $body = array(
        "categoryName" => $name
    );
    $baseUrl = baseUrl();
    $response = callAPI('POST', $baseUrl.'/api-admin/category_create.php', json_encode($body));
    if ($response->success) {
        ob_start(); 
        header('location: ../dashboard/category.php?success=add');
        exit();
    } else {
        ob_start(); 
        header('location: ../dashboard/category.php?success=invalid');
        exit();
    }
}


function updateCategoryMenu($id, $name) {
    $body = array(
        "categoryId" => $id,
        "categoryName" => $name
    );
    $baseUrl = baseUrl();
    $response = callAPI('POST', $baseUrl.'/api-admin/category_update.php', json_encode($body));
    if ($response->success) {
        ob_start(); 
        header('location: ../dashboard/category.php?success=edit');
        exit();
    } else {
        ob_start(); 
        header('location: ../dashboard/category.php?success=invalid');
        exit();
    }
}

function deleteCategoryMenu($id) {
    $body = array(
        "categoryId" => $id
    );
    $baseUrl = baseUrl();
    $response = callAPI('POST', $baseUrl.'/api-admin/category_delete.php', json_encode($body));
    if ($response->success) {
        ob_start(); 
        header('location: ../dashboard/category.php?success=delete');
        exit();
    } else {
        ob_start(); 
        header('location: ../dashboard/category.php?success=invalid');
        exit();
    }
}
?>