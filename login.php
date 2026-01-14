<?php
session_start();
include "koneksi.php"; // Pastikan file koneksi sudah benar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil input dan mengubah username menjadi huruf kecil semua
    $username = strtolower($_POST['username']);
    $password = $_POST['password']; // Password teks biasa tanpa MD5
    
    // Mencari user di database berdasarkan username dan password
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        
        // Dialihkan ke admin.php jika berhasil
        echo "<script>alert('Login Berhasil! Halo " . $row['username'] . "'); window.location='admin.php';</script>";
    } else {
        $error = "Username atau Password Salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - My Daily Journal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f0f7ff; }
        .login-card { background: white; border-radius: 1.5rem; box-shadow: 0 10px 25px rgba(59, 130, 246, 0.1); }
        .info-blue { background-color: #e0efff; border: 1px solid #bddbff; color: #1e40af; }
    </style>
</head>
<body class="flex flex-col items-center justify-center min-h-screen p-4">

    <div class="login-card w-full max-w-sm p-8 text-center border border-blue-100">
        <div class="flex justify-center mb-4">
            <div class="bg-blue-500 p-4 rounded-full text-white shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
        </div>
        
        <h2 class="text-2xl font-bold text-blue-900 mb-6 italic">Welcome to My Daily Journal</h2>
        
        <form method="POST" class="space-y-4 text-left">
            <div>
                <label class="text-[10px] font-bold text-blue-400 uppercase ml-1">Username</label>
                <input type="text" name="username" placeholder="..." required
                    class="w-full px-4 py-2 border border-blue-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            
            <div>
                <label class="text-[10px] font-bold text-blue-400 uppercase ml-1">Password</label>
                <input type="password" name="password" placeholder="..." required
                    class="w-full px-4 py-2 border border-blue-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            
            <button type="submit" 
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition duration-300 shadow-md uppercase text-sm tracking-widest mt-4">
                MASUK
            </button>
        </form>

        <div class="mt-6 border-t pt-4">
            <a href="index.php" class="text-blue-600 hover:text-blue-800 text-sm font-medium no-underline">
                ← Kembali ke Website
            </a>
        </div>
    </div>

    <?php if(isset($error)): ?>
        <div class="w-full max-w-sm mt-4 p-3 bg-red-100 border border-red-200 text-red-700 rounded-xl text-center font-bold text-sm">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <div class="info-blue w-full max-w-sm mt-4 p-5 rounded-2xl shadow-sm text-sm text-center">
        <span class="font-bold uppercase block mb-2 tracking-tighter">Database Account Info:</span>
        <div class="flex justify-around italic font-medium">
            <span>User: <strong class="text-blue-700">danny</strong></span>
            <span>Pass: <strong class="text-blue-700">admin</strong></span>
        </div>
    </div>

</body>
</html>