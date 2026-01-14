<?php
session_start();

// Menghapus semua data session yang tersimpan
$_SESSION = array();

// Jika ingin benar-benar menghapus cookie session di browser juga
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Menghancurkan session
session_destroy();

// Redirect ke halaman login atau halaman utama
// Jika ingin ke halaman utama setelah logout, ganti menjadi header("location:home.php");
header("location:login.php");
exit;
?>