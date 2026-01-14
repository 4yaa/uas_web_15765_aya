<?php
include "koneksi.php";
$json = file_get_contents('php://input');
$data = json_decode($json, true);
$hlm = isset($data['hlm']) ? $data['hlm'] : 1;
$limit = 3; 
$offset = ($hlm - 1) * $limit;

$sql_total = "SELECT COUNT(*) as total FROM article";
$total_data = $conn->query($sql_total)->fetch_assoc()['total'];
$total_halaman = ceil($total_data / $limit);

$sql = "SELECT * FROM article ORDER BY tanggal DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<table class="w-full text-left border-collapse m-0">
    <thead>
        <tr class="bg-sky-800 text-white uppercase text-[11px] tracking-[0.2em]">
            <th class="p-4 border-0 text-center" width="80">No</th>
            <th class="p-4 border-0">Judul & Tanggal</th>
            <th class="p-4 border-0">Isi Konten</th>
            <th class="p-4 border-0 text-center">Gambar</th>
            <th class="p-4 border-0 text-center" width="150">Aksi</th>
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
                    <div class="text-[10px] text-gray-400 mt-1 uppercase italic"><?= $row["tanggal"]; ?></div>
                </td>
                <td class="p-4 text-xs text-gray-500"><?= substr(strip_tags($row["isi"]), 0, 50); ?>...</td>
                <td class="p-4 text-center">
                    <img src="img/<?= $row["gambar"]; ?>" class="w-16 h-16 object-cover rounded-xl shadow-sm mx-auto">
                </td>
                <td class="p-4">
                    <div class="flex gap-2 justify-center">
                        <button class="w-9 h-9 flex items-center justify-center bg-amber-100 text-amber-600 rounded-xl hover:bg-amber-600 hover:text-white transition" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row["id"] ?>">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <button class="w-9 h-9 flex items-center justify-center bg-red-100 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row["id"] ?>">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>

            <div class="modal fade" id="modalEdit<?= $row["id"] ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content rounded-[2rem] border-0">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="modal-header border-0 bg-sky-50 p-4">
                                <h5 class="font-black text-sky-600 m-0 uppercase italic">Edit Artikel</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body p-5">
                                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                <input type="hidden" name="gambar_lama" value="<?= $row["gambar"] ?>">
                                <div class="mb-3 text-start"><label class="small fw-bold text-sky-400">Judul</label><input type="text" name="judul" class="form-control rounded-xl" value="<?= $row["judul"] ?>" required></div>
                                <div class="mb-3 text-start"><label class="small fw-bold text-sky-400">Isi</label><textarea name="isi" class="form-control rounded-xl" rows="5"><?= $row["isi"] ?></textarea></div>
                                <div class="mb-3 text-start"><label class="small fw-bold text-sky-400">Gambar (Opsional)</label><input type="file" name="gambar" class="form-control rounded-xl"></div>
                            </div>
                            <div class="modal-footer border-0 p-5 pt-0">
                                <button type="submit" name="update" class="w-full bg-sky-500 text-white py-3 rounded-xl font-bold shadow-lg">UPDATE DATA</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalHapus<?= $row["id"] ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-[2rem] border-0 p-5 text-center">
                        <i class="fa-solid fa-trash text-red-500 text-5xl mb-4"></i>
                        <h4 class="font-black text-sky-900">Hapus Artikel?</h4>
                        <p class="text-gray-400 small mb-5 italic">"<?= $row["judul"] ?>"</p>
                        <div class="flex gap-3 justify-center">
                            <button type="button" class="bg-gray-100 text-gray-500 px-6 py-2 rounded-xl font-bold" data-bs-dismiss="modal">BATAL</button>
                            <a href="admin.php?page=article&aksi=hapus&id=<?= $row["id"] ?>" class="bg-red-500 text-white px-6 py-2 rounded-xl font-bold no-underline shadow-lg">HAPUS</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </tbody>
</table>

<div class="p-4 flex justify-between items-center bg-gray-50 border-t rounded-b-[2.5rem]">
    <div class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Total: <?= $total_data ?></div>
    <nav>
        <ul class="pagination pagination-sm mb-0">
            <?php for ($i = 1; $i <= $total_halaman; $i++): ?>
                <li class="page-item <?= ($i == $hlm) ? 'active' : '' ?>">
                    <a class="page-link border-0 mx-1 <?= ($i == $hlm) ? 'bg-sky-700 text-white' : 'text-sky-700' ?>" href="javascript:void(0)" onclick="load_data_article(<?= $i ?>)"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>