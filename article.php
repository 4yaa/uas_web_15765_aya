<?php
include "koneksi.php"; 

// --- LOGIKA SIMPAN ---
if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tanggal = date("Y-m-d H:i:s");
    $username = $_SESSION['username'];
    $gambar = '';
    $nama_gambar = $_FILES['gambar']['name'];
    if ($nama_gambar != '') {
        $cek_upload = move_uploaded_file($_FILES['gambar']['tmp_name'], 'img/' . $nama_gambar);
        if ($cek_upload) { $gambar = $nama_gambar; }
    }
    $sql_simpan = "INSERT INTO article (judul, isi, gambar, tanggal, username) VALUES ('$judul', '$isi', '$gambar', '$tanggal', '$username')";
    if ($conn->query($sql_simpan)) { echo "<script>alert('Simpan sukses!'); window.location='admin.php?page=article';</script>"; }
}

// --- LOGIKA UPDATE ---
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $gambar_lama = $_POST['gambar_lama'];
    $nama_gambar = $_FILES['gambar']['name'];
    if ($nama_gambar != '') {
        move_uploaded_file($_FILES['gambar']['tmp_name'], 'img/' . $nama_gambar);
        $gambar = $nama_gambar;
        if ($gambar_lama != "" && file_exists("img/" . $gambar_lama)) { unlink("img/" . $gambar_lama); }
    } else {
        $gambar = $gambar_lama;
    }
    $sql_update = "UPDATE article SET judul='$judul', isi='$isi', gambar='$gambar' WHERE id='$id'";
    if ($conn->query($sql_update)) { echo "<script>alert('Update sukses!'); window.location='admin.php?page=article';</script>"; }
}

// --- LOGIKA HAPUS ---
if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    $id = $_GET['id'];
    $sql_gambar = "SELECT gambar FROM article WHERE id = '$id'";
    $data_gambar = $conn->query($sql_gambar)->fetch_assoc();
    if ($data_gambar['gambar'] != "" && file_exists("img/" . $data_gambar['gambar'])) { unlink("img/" . $data_gambar['gambar']); }
    $sql_hapus = "DELETE FROM article WHERE id = '$id'";
    if ($conn->query($sql_hapus)) { echo "<script>alert('Hapus sukses!'); window.location='admin.php?page=article';</script>"; }
}
?>

<div class="max-w-7xl mx-auto p-4">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-4">
            <a href="admin.php" class="bg-white p-3 rounded-2xl shadow-sm text-sky-600 hover:bg-sky-600 hover:text-white transition no-underline">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h2 class="text-2xl font-black text-sky-800 uppercase italic m-0">Manajemen Article</h2>
        </div>
        <button type="button" class="bg-sky-500 text-white px-5 py-2.5 rounded-2xl text-xs font-bold shadow-lg" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="fa-solid fa-plus mr-2"></i> TAMBAH ARTICLE
        </button>
    </div>

    <div id="isi_article_data" class="bg-white rounded-[2.5rem] shadow-sm border border-sky-100 overflow-hidden"></div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-[2rem] border-0">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-header border-0 bg-sky-50 p-4">
                    <h5 class="font-black text-sky-600 m-0 italic uppercase">Tambah Artikel Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-5">
                    <div class="mb-3 text-start"><label class="small fw-bold text-sky-400">Judul</label><input type="text" name="judul" class="form-control rounded-xl" required></div>
                    <div class="mb-3 text-start"><label class="small fw-bold text-sky-400">Isi</label><textarea name="isi" class="form-control rounded-xl" rows="5"></textarea></div>
                    <div class="mb-3 text-start"><label class="small fw-bold text-sky-400">Gambar</label><input type="file" name="gambar" class="form-control rounded-xl"></div>
                </div>
                <div class="modal-footer border-0 p-5 pt-0">
                    <button type="submit" name="simpan" class="w-full bg-sky-500 text-white py-3 rounded-xl font-bold shadow-lg">SIMPAN DATA</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function load_data_article(hlm){
    $.ajax({
        url: "article_data.php",
        method: "POST",
        data: JSON.stringify({ hlm: hlm }),
        contentType: "application/json; charset=utf-8",
        success: function(data){ $('#isi_article_data').html(data); }
    });
}
$(document).ready(function(){ load_data_article(1); });
</script>