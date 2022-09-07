<?php
include_once('../helper/import.php');

if(isset($_POST['submitLogin'])) {
  $conn = callDb();
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $sqlAdmin = "SELECT * FROM `admin` WHERE username='$username'";
  $resultAdmin = $conn->query($sqlAdmin);
  if ($resultAdmin->num_rows == 1) {
    while($row = $resultAdmin->fetch_assoc()) {
      $passwordDecode = base64_decode(mysqli_real_escape_string($conn, $row['password']));
      if ($password != $passwordDecode) {
        ob_start(); 
        header('location:../index.php?message=error');
        exit();
      } else {
        session_start();
        $_SESSION['id'] = $row['id'];
        $_SESSION['fullName'] = $row['fullname'];
        $_SESSION['userName'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['type'] = 'admin';
        ob_start();
        header('location:../dashboard/index.php');
        exit(); 
      }
    }  
  } else {
    ob_start(); 
    header('location:../index.php?message=usernotfound');
    exit();
  }
} else {
    ob_start(); 
    header('location:../index.php?message=method');
    exit();
}
?>
