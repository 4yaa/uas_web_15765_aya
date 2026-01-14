<?php
session_start();
include "koneksi.php"; 

// Proteksi halaman admin
if (!isset($_SESSION['username'])) {
    header("location:login.php"); 
    exit;
}

// ==========================================
// LOGIKA PEMROSES GALLERY (TIDAK BERUBAH)
// ==========================================
if (isset($_POST['simpan_gallery'])) {
    $judul = $_POST['judul'];
    $tanggal = date("Y-m-d H:i:s");
    $gambar = '';
    $nama_gambar = $_FILES['gambar']['name'];
    if ($nama_gambar != '') {
        $nama_gambar_baru = date('YmdHis') . '_' . $nama_gambar;
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], 'img/' . $nama_gambar_baru)) {
            $gambar = $nama_gambar_baru;
        }
    }
    $sql = "INSERT INTO gallery (judul, gambar, tanggal) VALUES ('$judul', '$gambar', '$tanggal')";
    if ($conn->query($sql)) {
        echo "<script>alert('Foto berhasil ditambahkan!'); window.location='admin.php?page=gallery';</script>";
    }
}

if (isset($_POST['update_gallery'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $gambar_lama = $_POST['gambar_lama'];
    $nama_gambar = $_FILES['gambar']['name'];
    if ($nama_gambar != '') {
        $gambar = date('YmdHis') . '_' . $nama_gambar;
        move_uploaded_file($_FILES['gambar']['tmp_name'], 'img/' . $gambar);
        if ($gambar_lama != '' && file_exists("img/$gambar_lama")) { unlink("img/$gambar_lama"); }
    } else { $gambar = $gambar_lama; }
    $sql = "UPDATE gallery SET judul='$judul', gambar='$gambar' WHERE id='$id'";
    if ($conn->query($sql)) {
        echo "<script>alert('Foto berhasil diperbarui!'); window.location='admin.php?page=gallery';</script>";
    }
}

if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus_gallery') {
    $id = $_GET['id'];
    $data = $conn->query("SELECT gambar FROM gallery WHERE id='$id'")->fetch_assoc();
    if ($data['gambar'] != '' && file_exists("img/" . $data['gambar'])) { unlink("img/" . $data['gambar']); }
    $conn->query("DELETE FROM gallery WHERE id='$id'");
    echo "<script>alert('Foto berhasil dihapus!'); window.location='admin.php?page=gallery';</script>";
}

// ==========================================
// LOGIKA PEMROSES USER (MILIK ANDA)
// ==========================================
if (isset($_POST['simpan_user'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $foto = '';
    $nama_foto = $_FILES['foto']['name'];
    if ($nama_foto != '') {
        $foto = date('YmdHis') . '_' . $nama_foto;
        move_uploaded_file($_FILES['foto']['tmp_name'], 'img/' . $foto);
    }
    $sql = "INSERT INTO user (username, password, foto) VALUES ('$username', '$password', '$foto')";
    if ($conn->query($sql)) {
        echo "<script>alert('User berhasil ditambahkan!'); window.location='admin.php?page=user';</script>";
    }
}

if (isset($_POST['update_user'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $foto_lama = $_POST['foto_lama'];
    $password_baru = $_POST['password'];
    $sql_pass = ($password_baru != '') ? ", password='".md5($password_baru)."'" : "";
    if ($_FILES['foto']['name'] != '') {
        $foto = date('YmdHis') . '_' . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], 'img/' . $foto);
        if ($foto_lama != '' && file_exists("img/$foto_lama")) { unlink("img/$foto_lama"); }
    } else { $foto = $foto_lama; }
    $sql = "UPDATE user SET username='$username', foto='$foto' $sql_pass WHERE id='$id'";
    if ($conn->query($sql)) {
        echo "<script>alert('User berhasil diperbarui!'); window.location='admin.php?page=user';</script>";
    }
}

if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus_user') {
    $id = $_GET['id'];
    $data = $conn->query("SELECT foto FROM user WHERE id='$id'")->fetch_assoc();
    if ($data['foto'] != '' && file_exists("img/" . $data['foto'])) { unlink("img/" . $data['foto']); }
    $conn->query("DELETE FROM user WHERE id='$id'");
    echo "<script>alert('User berhasil dihapus!'); window.location='admin.php?page=user';</script>";
}

// Data Dashboard
$jumlah_article = $conn->query("SELECT * FROM article")->num_rows;
$jumlah_gallery = $conn->query("SELECT * FROM gallery")->num_rows;
$jumlah_user = $conn->query("SELECT * FROM user")->num_rows;

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Aesthetic Blue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f0f7ff; min-height: 100vh; }
        .menu-card {
            background: white; border-radius: 24px; padding: 30px; transition: all 0.4s;
            border: 2px solid #e0f2fe; cursor: pointer; text-decoration: none !important;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
        }
        .menu-card:hover { transform: translateY(-10px); border-color: #0ea5e9; box-shadow: 0 20px 40px rgba(14, 165, 233, 0.1); }
        .welcome-gradient { background: linear-gradient(135deg, #0ea5e9 0%, #2563eb 100%); border-radius: 30px; color: white; padding: 50px; text-align: center; margin-bottom: 40px; }
    </style>
</head>
<body>

    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 py-3 border-b-2 border-sky-100 mb-8">
        <div class="max-w-6xl mx-auto px-6 flex justify-between items-center">
            <a href="admin.php" class="font-black italic text-xl text-sky-800 tracking-tighter no-underline">PUTRI <span class="text-sky-500">ADMIN</span></a>
            <div class="flex items-center gap-4">
                <a href="logout.php" class="bg-sky-50 text-sky-600 px-4 py-2 rounded-xl text-[10px] font-black hover:bg-sky-600 hover:text-white transition uppercase no-underline">Logout</a>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-6 pb-20">
        
        <?php if ($page == "dashboard"): ?>
            <div class="welcome-gradient">
                <h2 class="text-4xl font-black italic mb-2">Pusat Kendali Jurnal</h2>
                <p class="opacity-80">Halo <strong><?= $_SESSION['username']; ?></strong>, selamat mengelola konten.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <a href="admin.php?page=article" class="menu-card">
                    <div class="w-16 h-16 bg-sky-100 text-sky-600 rounded-2xl flex items-center justify-center text-2xl mb-4">
                        <i class="fa-solid fa-newspaper"></i>
                    </div>
                    <h3 class="text-xl font-black text-slate-800 uppercase">Article</h3>
                    <span class="mt-4 bg-sky-50 text-sky-600 px-4 py-1 rounded-full text-xs font-bold"><?= $jumlah_article; ?> Data</span>
                </a>
                <a href="admin.php?page=gallery" class="menu-card">
                    <div class="w-16 h-16 bg-sky-100 text-sky-600 rounded-2xl flex items-center justify-center text-2xl mb-4"><i class="fa-solid fa-images"></i></div>
                    <h3 class="text-xl font-black text-slate-800 uppercase">Gallery</h3>
                    <span class="mt-4 bg-sky-50 text-sky-600 px-4 py-1 rounded-full text-xs font-bold"><?= $jumlah_gallery; ?> Foto</span>
                </a>
                <a href="admin.php?page=user" class="menu-card">
                    <div class="w-16 h-16 bg-sky-100 text-sky-600 rounded-2xl flex items-center justify-center text-2xl mb-4"><i class="fa-solid fa-user-gear"></i></div>
                    <h3 class="text-xl font-black text-slate-800 uppercase">Users</h3>
                    <span class="mt-4 bg-sky-50 text-sky-600 px-4 py-1 rounded-full text-xs font-bold"><?= $jumlah_user; ?> Akun</span>
                </a>
            </div>

            <?php elseif ($page == "article"): ?>
           
            
            <div id="article_data_container">
                <?php include "article.php"; ?>
            </div>


            <?php elseif ($page == "gallery"): ?>
            <?php include "gallery.php"; ?>
            
            <div id="gallery_data"></div>
            <script>
                function load_gallery(hlm){
                    $.ajax({
                        url: "gallery_data.php", method: "POST",
                        data: JSON.stringify({ hlm: hlm }), contentType: "application/json; charset=utf-8",
                        success: function(data){ $('#gallery_data').html(data); }
                    });
                }
                $(document).ready(function(){ load_gallery(1); });
            </script>

        <?php elseif ($page == "user"): ?>
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-4">
                    <a href="admin.php" class="bg-white p-3 rounded-2xl shadow-sm text-sky-600 hover:bg-sky-600 hover:text-white transition no-underline"><i class="fa-solid fa-arrow-left"></i></a>
                    <h2 class="text-2xl font-black text-sky-800 uppercase italic">User Management</h2>
                </div>
                <button class="bg-sky-500 text-white px-5 py-2.5 rounded-2xl text-xs font-bold shadow-lg hover:bg-sky-600 transition" data-bs-toggle="modal" data-bs-target="#modalTambahUser">+ Tambah User</button>
            </div>
            
            <div id="user_data_container"></div>

            <div class="modal fade" id="modalTambahUser" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-[2rem] border-0 shadow-lg">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="modal-header border-0 bg-sky-50 rounded-t-[2rem] p-4"><h5 class="font-black text-sky-600 m-0">USER BARU</h5></div>
                            <div class="modal-body p-5">
                                <label class="small fw-bold text-sky-400 mb-1 d-block uppercase tracking-wider">Username</label>
                                <input type="text" name="username" class="form-control rounded-xl mb-3 border-sky-100" placeholder="..." required>
                                
                                <label class="small fw-bold text-sky-400 mb-1 d-block uppercase tracking-wider">Password</label>
                                <input type="password" name="password" class="form-control rounded-xl mb-3 border-sky-100" placeholder="..." required>
                                
                                <label class="small fw-bold text-sky-400 mb-1 d-block uppercase tracking-wider">Foto Profil</label>
                                <input type="file" name="foto" class="form-control rounded-xl border-sky-100">
                            </div>
                            <div class="modal-footer border-0 p-5 pt-0"><button type="submit" name="simpan_user" class="w-full bg-sky-500 text-white py-3 rounded-xl font-bold hover:bg-sky-600 transition">SIMPAN</button></div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                function load_user(hlm){
                    $.ajax({
                        url: "user_data.php", method: "POST",
                        data: JSON.stringify({ hlm: hlm }), contentType: "application/json; charset=utf-8",
                        success: function(data){ 
                            $('#user_data_container').html(data); 
                        }
                    });
                }
                $(document).ready(function(){ load_user(1); });
            </script>
        <?php endif; ?>

    </main>

    <footer class="text-center py-10 font-black text-[10px] uppercase tracking-[0.5em] text-sky-300">&copy; 2025 PUTRI SURYA &bull; ADMIN PANEL</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>