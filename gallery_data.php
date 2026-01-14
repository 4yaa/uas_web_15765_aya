<?php
include "koneksi.php";
$json = file_get_contents('php://input');
$data = json_decode($json, true);
$hlm = isset($data['hlm']) ? $data['hlm'] : 1;
$limit = 4; 
$offset = ($hlm - 1) * $limit;

$sql_total = "SELECT COUNT(*) as total FROM gallery";
$total_data = $conn->query($sql_total)->fetch_assoc()['total'];
$total_halaman = ceil($total_data / $limit);

$sql = "SELECT * FROM gallery ORDER BY tanggal DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<table class="w-full text-left border-collapse m-0">
    <thead>
        <tr class="bg-sky-800 text-white uppercase text-[11px] tracking-[0.2em]">
            <th class="p-4 border-0 text-center" width="80">NO</th>
            <th class="p-4 border-0">JUDUL & TANGGAL</th>
            <th class="p-4 border-0 text-center">GAMBAR</th>
            <th class="p-4 border-0 text-center" width="150">AKSI</th>
        </tr>
    </thead>
    <tbody class="text-sm text-gray-700 bg-white">
        <?php
        $no = $offset + 1;
        while($row = $result->fetch_assoc()) {
        ?>
            <tr class="border-bottom border-sky-50">
                <td class="p-4 text-center font-bold"><?= $no++; ?></td>
                <td class="p-4">
                    <div class="font-bold text-sky-900"><?= $row["judul"]; ?></div>
                    <div class="text-[10px] text-gray-400 mt-1 uppercase italic">Diupload: <?= $row["tanggal"]; ?></div>
                </td>
                <td class="p-4 text-center">
                    <img src="img/<?= $row["gambar"]; ?>" class="w-24 h-16 object-cover rounded-xl shadow-sm mx-auto">
                </td>
                <td class="p-4 text-center">
                    <div class="flex gap-2 justify-center">
                        <button class="w-9 h-9 flex items-center justify-center bg-green-100 text-green-600 rounded-xl hover:bg-green-600 hover:text-white transition border-0" data-bs-toggle="modal" data-bs-target="#modalEditG<?= $row["id"] ?>">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <a href="admin.php?page=gallery&aksi=hapus_gallery&id=<?= $row["id"] ?>" onclick="return confirm('Hapus foto ini?')" class="w-9 h-9 flex items-center justify-center bg-red-100 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition no-underline border-0">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                </td>
            </tr>

            <div class="modal fade" id="modalEditG<?= $row["id"] ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-[2rem] border-0 shadow-lg">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="modal-header border-0 bg-sky-50 p-4">
                                <h5 class="font-black text-sky-600 m-0 uppercase italic">Edit Foto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body p-5 text-start">
                                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                <input type="hidden" name="gambar_lama" value="<?= $row["gambar"] ?>">
                                <div class="mb-4">
                                    <label class="small fw-bold text-sky-400 mb-2 d-block">Judul Foto</label>
                                    <input type="text" name="judul" class="form-control rounded-xl border-sky-100" value="<?= $row["judul"] ?>" required>
                                </div>
                                <div class="mb-4">
                                    <label class="small fw-bold text-sky-400 mb-2 d-block">Ganti Gambar (Opsional)</label>
                                    <input type="file" name="gambar" class="form-control rounded-xl border-sky-100">
                                </div>
                            </div>
                            <div class="modal-footer border-0 p-5 pt-0">
                                <button type="submit" name="update_gallery" class="w-full bg-sky-500 text-white py-3 rounded-xl font-bold shadow-lg hover:bg-sky-600 transition">UPDATE FOTO</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </tbody>
</table>

<div class="p-4 flex justify-between items-center bg-gray-50 border-t rounded-b-[2.5rem]">
    <div class="text-[10px] text-gray-400 font-black uppercase tracking-widest">TOTAL: <?= $total_data ?> FOTO</div>
    <nav>
        <ul class="pagination pagination-sm mb-0">
            <?php for ($i = 1; $i <= $total_halaman; $i++): ?>
                <li class="page-item <?= ($i == $hlm) ? 'active' : '' ?>">
                    <a class="page-link border-0 mx-1 <?= ($i == $hlm) ? 'bg-sky-700 text-white' : 'text-sky-700' ?>" href="javascript:void(0)" onclick="load_gallery_data(<?= $i ?>)"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>