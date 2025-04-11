<?php
include ("conn.php");
date_default_timezone_set('Asia/Jakarta');

session_start();

$username = $_POST['username'];
$password1 = $_POST['password'];
$password = sha1($password1);

//$username = mysqli_real_escape_string($username);
//$password = mysqli_real_escape_string($password);

if (empty($username) && empty($password)) {
	header('location:index.php?error=Username dan Password Kosong!');
} else if (empty($username)) {
	header('location:index.php?error=Username Kosong!');
} else if (empty($password)) {
	header('location:index.php?error=Password Kosong!');
}

$stmt = mysqli_prepare($koneksi, "SELECT * FROM karyawan WHERE username=? AND password=?");
mysqli_stmt_bind_param($stmt, "ss", $username, $password);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$row = mysqli_fetch_array ($result);

if (mysqli_num_rows($result) == 1) {
    $_SESSION['nik']        = $row['nik'];
    $_SESSION['username']   = $username;
    $_SESSION['nama']       = $row['nama'];
    $_SESSION['departemen'] = $row['departemen'];
    $_SESSION['jabatan']    = $row['jabatan'];	
    $_SESSION['level']      = $row['level'];
    $_SESSION['gambar']     = $row['gambar'];
    
    if ($_SESSION['level'] == 'Admin'){
        header('location:admin/index.php');
    } else if ($_SESSION['level'] == 'Superuser'){
        header('location:superuser/index.php');
    } else if ($_SESSION['level'] == 'User'){
        header('location:user/index.php');
    }
	
} else {
	header('location:index.php?error=Anda Belum Terdaftar!');
}
?>