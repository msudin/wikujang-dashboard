<?php
// Local 
// $server="localhost";
// $username="root";
// $db_name="infak";
// $password="";

// Server
$server="localhost";
$username="root";
$db_name="infak";
$password="root";

// Server 000 Hosting
/*$server="localhost";
$username="id6978001_root";
$password="root1234";
$db_name="id6978001_sispp";*/

// Open Connection DB
$koneksi = mysqli_connect($server, $username, $password, $db_name);
// Validate database
if (mysqli_connect_errno()){
	echo "Silahkan Periksa Kembali Database Anda";
}

date_default_timezone_set('Asia/Jakarta');

?>