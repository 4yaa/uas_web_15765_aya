<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
        <h2 class="text-2xl font-black text-pink-600 uppercase italic">User Management</h2>
        <button class="btn btn-secondary btn-sm rounded-3 shadow-sm px-3" data-bs-toggle="modal" data-bs-target="#modalTambahUser">
            + Tambah User
        </button>
    </div>
    
    <div id="user_data"></div>

    <div class="modal fade" id="modalTambahUser" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-header border-0 bg-light rounded-t-4">
                        <h5 class="modal-title fw-bold text-pink-600">Tambah User Baru</h5>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="small fw-bold text-muted">USERNAME</label>
                            <input type="text" name="username" class="form-control rounded-3" required>
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold text-muted">PASSWORD</label>
                            <input type="password" name="password" class="form-control rounded-3" required>
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold text-muted">FOTO PROFIL</label>
                            <input type="file" name="foto" class="form-control rounded-3">
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" name="simpan_user" class="btn btn-primary w-100 rounded-3 py-2 fw-bold">SIMPAN USER</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        load_user(1);
    });

    function load_user(hlm){
        $.ajax({
            url: "user_data.php",
            method: "POST",
            data: JSON.stringify({ hlm: hlm }),
            contentType: "application/json; charset=utf-8",
            success: function(data){
                $('#user_data').html(data);
            }
        });
    }
</script>