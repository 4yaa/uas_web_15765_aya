<?php
include "koneksi.php"; 

// --- LOGIKA SIMPAN ---
if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $tanggal = date("Y-m-d H:i:s");
    $nama_gambar = $_FILES['gambar']['name'];
    if ($nama_gambar != '') {
        move_uploaded_file($_FILES['gambar']['tmp_name'], 'img/' . $nama_gambar);
    }
    $sql = "INSERT INTO gallery (judul, gambar, tanggal) VALUES ('$judul', '$nama_gambar', '$tanggal')";
    if ($conn->query($sql)) { echo "<script>window.location='admin.php?page=gallery';</script>"; }
}

// --- LOGIKA UPDATE & HAPUS TETAP SAMA SEPERTI SEBELUMNYA ---
?>

<div class="max-w-7xl mx-auto p-4">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-4">
            <a href="admin.php" class="bg-white p-3 rounded-2xl shadow-sm text-sky-600 hover:bg-sky-600 hover:text-white transition no-underline flex items-center justify-center w-12 h-12 shadow-md">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h2 class="text-2xl font-black text-sky-800 uppercase italic m-0">Manajemen Gallery</h2>
        </div>
        <button type="button" class="bg-sky-500 text-white px-5 py-2.5 rounded-2xl text-xs font-bold shadow-lg flex items-center gap-2 border-0" data-bs-toggle="modal" data-bs-target="#modalTambahG">
            <i class="fa-solid fa-plus"></i> TAMBAH GALLERY
        </button>
    </div>

    <div id="isi_gallery_data" class="bg-white rounded-[2.5rem] shadow-sm border border-sky-100 overflow-hidden"></div>
</div>

<div class="modal fade" id="modalTambahG" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-0 px-4 pt-4">
                <h5 class="modal-title fw-light text-secondary">Tambah Gallery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body px-4">
                    <div class="mb-4">
                        <label class="form-label fw-light text-secondary">Judul</label>
                        <input type="text" name="judul" class="form-control form-control-lg border-light-subtle rounded-3" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-light text-secondary">Gambar</label>
                        <input type="file" name="gambar" class="form-control form-control-lg border-light-subtle rounded-3" required>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button" class="btn btn-secondary px-4 py-2 rounded-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="simpan" class="btn btn-primary px-4 py-2 rounded-3">simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function load_data_gallery(hlm){
    $.ajax({
        url: "gallery_data.php",
        method: "POST",
        data: JSON.stringify({ hlm: hlm }),
        contentType: "application/json; charset=utf-8",
        success: function(data){ $('#isi_gallery_data').html(data); }
    });
}
$(document).ready(function(){ load_data_gallery(1); });
</script><div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-4">
        <a href="admin.php" class="bg-white p-3 rounded-2xl shadow-sm text-sky-600 hover:bg-sky-600 hover:text-white transition no-underline shadow-md w-12 h-12 flex items-center justify-center border-0">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h2 class="text-2xl font-black text-sky-800 uppercase italic m-0">Manajemen Gallery</h2>
    </div>
    <button type="button" class="bg-sky-500 text-white px-5 py-2.5 rounded-2xl text-xs font-bold shadow-lg border-0 hover:bg-sky-600 transition" data-bs-toggle="modal" data-bs-target="#modalTambahG">
        <i class="fa-solid fa-plus me-2"></i> TAMBAH GALLERY
    </button>
</div>

<div id="isi_gallery_data" class="bg-white rounded-[2.5rem] shadow-sm border border-sky-100 overflow-hidden"></div>

<div class="modal fade" id="modalTambahG" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-[2rem] border-0 shadow-lg">
            <div class="modal-header border-0 bg-sky-50 p-4">
                <h5 class="font-black text-sky-600 m-0 uppercase italic">Tambah Gallery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body p-5">
                    <div class="mb-4 text-start">
                        <label class="small fw-bold text-sky-400 mb-2 d-block">Judul Foto</label>
                        <input type="text" name="judul" class="form-control rounded-xl border-sky-100" placeholder="..." required>
                    </div>
                    <div class="mb-4 text-start">
                        <label class="small fw-bold text-sky-400 mb-2 d-block">Pilih Gambar</label>
                        <input type="file" name="gambar" class="form-control rounded-xl border-sky-100" required>
                    </div>
                </div>
                <div class="modal-footer border-0 p-5 pt-0">
                    <button type="submit" name="simpan_gallery" class="w-full bg-sky-500 text-white py-3 rounded-xl font-bold shadow-lg hover:bg-sky-600 transition">SIMPAN FOTO</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function load_gallery_data(hlm){
    $.ajax({
        url: "gallery_data.php",
        method: "POST",
        data: JSON.stringify({ hlm: hlm }),
        contentType: "application/json; charset=utf-8",
        success: function(data){ 
            $('#isi_gallery_data').html(data); 
        }
    });
}
$(document).ready(function(){ load_gallery_data(1); });
</script>