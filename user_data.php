<?php
include "koneksi.php";

$json = file_get_contents('php://input');
$data = json_decode($json, true);
$hlm = isset($data['hlm']) ? $data['hlm'] : 1;

$limit = 4; 
$offset = ($hlm - 1) * $limit;

$sql_total = "SELECT COUNT(*) as total FROM user";
$total_data = $conn->query($sql_total)->fetch_assoc()['total'];
$total_halaman = ceil($total_data / $limit);

$sql = "SELECT * FROM user ORDER BY id DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<div class="bg-white rounded-[2.5rem] shadow-sm border border-sky-100 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="bg-slate-800 text-white text-[11px] uppercase tracking-[0.2em]">
                <tr>
                    <th class="p-4 text-center border-0" width="80">No</th>
                    <th class="p-4 border-0" width="120">Foto</th>
                    <th class="p-4 border-0">Username</th>
                    <th class="p-4 text-center border-0" width="150">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <?php 
                $no = $offset + 1;
                while ($row = $result->fetch_assoc()): 
                ?>
                <tr class="border-bottom border-sky-50">
                    <td class="text-center font-bold text-slate-400"><?= $no++ ?></td>
                    <td>
                        <img src="img/<?= $row['foto'] ? $row['foto'] : 'default.png' ?>" class="w-14 h-14 rounded-full object-cover border-4 border-sky-50 mx-auto">
                    </td>
                    <td>
                        <span class="font-black text-slate-700 uppercase"><?= $row['username'] ?></span>
                    </td>
                    <td class="text-center">
                        <div class="flex gap-2 justify-center">
                            <button class="w-10 h-10 flex items-center justify-center bg-amber-400 text-white rounded-xl shadow-sm hover:bg-amber-500 transition" data-bs-toggle="modal" data-bs-target="#modalEditUser<?= $row['id'] ?>">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <a href="admin.php?page=user&aksi=hapus_user&id=<?= $row['id'] ?>" class="w-10 h-10 flex items-center justify-center bg-rose-500 text-white rounded-xl shadow-sm hover:bg-rose-600 transition" onclick="return confirm('Hapus user ini?')">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>

                <div class="modal fade" id="modalEditUser<?= $row['id'] ?>" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded-[2.5rem] border-0 shadow-2xl">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="modal-header border-0 p-5 pb-0">
                                    <h5 class="font-black text-sky-900 uppercase italic">Edit User Profil</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body p-5 text-start">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <input type="hidden" name="foto_lama" value="<?= $row['foto'] ?>">
                                    <div class="mb-3">
                                        <label class="text-[10px] font-bold text-slate-400 uppercase block mb-1">Username</label>
                                        <input type="text" name="username" class="form-control rounded-xl border-sky-100" value="<?= $row['username'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="text-[10px] font-bold text-slate-400 uppercase block mb-1">Ganti Password (Kosongkan jika tidak ganti)</label>
                                        <input type="password" name="password" class="form-control rounded-xl border-sky-100">
                                    </div>
                                    <div class="mb-3">
                                        <label class="text-[10px] font-bold text-slate-400 uppercase block mb-1">Update Foto</label>
                                        <input type="file" name="foto" class="form-control rounded-xl border-sky-100">
                                    </div>
                                </div>
                                <div class="modal-footer border-0 p-5 pt-0">
                                    <button type="submit" name="update_user" class="w-full bg-sky-600 text-white py-3 rounded-xl font-bold uppercase tracking-widest shadow-lg shadow-sky-100">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="p-4 bg-white border-t border-sky-50 flex justify-between items-center">
        <span class="text-[11px] font-black text-sky-600 uppercase tracking-widest">
            Menampilkan <?= ($offset + 1) ?>-<?= min($offset + $limit, $total_data) ?> Dari <?= $total_data ?> Data
        </span>
        <nav>
            <ul class="pagination pagination-sm mb-0 gap-1">
                <?php for ($i = 1; $i <= $total_halaman; $i++): ?>
                    <li class="page-item">
                        <a class="page-link border-0 rounded-xl px-3 font-black <?= ($i == $hlm) ? 'bg-sky-600 text-white' : 'text-sky-600 bg-sky-50' ?>" href="javascript:void(0)" onclick="load_user(<?= $i ?>)"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item">
                    <a class="page-link border-0 rounded-xl px-3 text-sky-600 bg-sky-50 font-bold" href="#">Akhir</a>
                </li>
            </ul>
        </nav>
    </div>
</div>