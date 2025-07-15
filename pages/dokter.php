<?php 
include '../includes/header2.php';
include '../config/database.php';

// Handle success/error messages
$success = isset($_GET['success']) ? $_GET['success'] : null;
$error = isset($_GET['error']) ? $_GET['error'] : null;
$dokter_id = isset($_GET['id']) ? intval($_GET['id']) : null;
?>

<!-- Notification Toast -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Notifikasi</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body"></div>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Manajemen Dokter</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahDokterModal">
        <i class="bi bi-plus-lg me-1"></i> Dokter Baru
    </button>
</div>

<!-- Search Box -->
<div class="card mb-4">
    <div class="card-body">
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" class="form-control" id="searchDokter" placeholder="Cari dokter/spesialisasi...">
        </div>
    </div>
</div>

<!-- Main Table -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="dokterTable">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Dokter</th>
                        <th>Spesialisasi</th>
                        <th>No. Izin Praktek</th>
                        <th>No. Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM dokter ORDER BY nama";
                    $result = $conn->query($query);
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>$no</td>
                            <td>$row[nama]</td>
                            <td>$row[spesialisasi]</td>
                            <td>$row[no_izin_praktek]</td>
                            <td>$row[no_telp]</td>
                            <td>
                                <button class='btn btn-sm btn-warning edit-dokter' data-id='$row[id_dokter]'>
                                    <i class='bi bi-pencil-square'></i>
                                </button>
                                <button class='btn btn-sm btn-danger hapus-dokter' data-id='$row[id_dokter]'>
                                    <i class='bi bi-trash'></i>
                                </button>
                            </td>
                        </tr>";
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Doctor Modal -->
<div class="modal fade" id="tambahDokterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Dokter Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../proses/crud_dokter.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Dokter</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Spesialisasi</label>
                        <input type="text" class="form-control" name="spesialisasi" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">No. Izin Praktek</label>
                        <input type="text" class="form-control" name="no_izin_praktek" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">No. Telepon</label>
                        <input type="text" class="form-control" name="no_telp" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" name="tambah">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Doctor Modal -->
<div class="modal fade" id="editDokterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Dokter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../proses/crud_dokter.php" method="POST">
                <input type="hidden" name="id_dokter" id="edit_id_dokter">
                <div class="modal-body">
                    <!-- Content will be loaded via AJAX -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" name="edit">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Initialize toast
    const toast = new bootstrap.Toast(document.getElementById('liveToast'));
    
    // Show notification if exists
    <?php if($success): ?>
        $('.toast-body').text('<?php 
            echo $success == 'tambah' ? "Data dokter berhasil ditambahkan" : 
                 ($success == 'edit' ? "Data dokter berhasil diperbarui" : 
                 "Data dokter berhasil dihapus"); 
        ?>');
        $('.toast').addClass('text-white bg-success');
        toast.show();
        
        // Scroll to the newly added/edited row
        <?php if($dokter_id): ?>
            setTimeout(() => {
                $('tr[data-id="<?= $dokter_id ?>"]').get(0).scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }, 500);
        <?php endif; ?>
    <?php elseif($error): ?>
        $('.toast-body').text('<?= htmlspecialchars($error) ?>');
        $('.toast').addClass('text-white bg-danger');
        toast.show();
    <?php endif; ?>

    // Search functionality
    $("#searchDokter").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#dokterTable tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    
    // Edit button click
    $('.edit-dokter').click(function() {
        var id = $(this).data('id');
        
        $.ajax({
            url: '../proses/get_dokter.php',
            type: 'POST',
            data: {id: id},
            success: function(response) {
                $('#editDokterModal .modal-body').html(response);
                $('#edit_id_dokter').val(id);
                $('#editDokterModal').modal('show');
            },
            error: function(xhr) {
                $('.toast-body').text('Error: ' + xhr.statusText);
                $('.toast').addClass('text-white bg-danger');
                toast.show();
            }
        });
    });
    
    // Delete button click
    $('.hapus-dokter').click(function() {
        if(confirm('Apakah Anda yakin ingin menghapus data dokter ini?')) {
            var id = $(this).data('id');
            window.location.href = '../proses/crud_dokter.php?hapus=' + id;
        }
    });
});
</script>

<?php include '../includes/footer.php'; ?>