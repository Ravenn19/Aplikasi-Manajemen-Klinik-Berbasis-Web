<?php 
include '../includes/header2.php';
include '../config/database.php';

// Get prescription ID from URL parameter
$resep_id = isset($_GET['resep_id']) ? intval($_GET['resep_id']) : null;

// Initialize variables
$resep_info = [];
$details = [];
$total = 0;

if($resep_id) {
    try {
        // Get prescription header info with prepared statement
        $query = "SELECT r.*, p.nama as nama_pasien, d.nama as nama_dokter 
                  FROM resep_obat r
                  JOIN kunjungan k ON r.id_kunjungan = k.id_kunjungan
                  JOIN pasien p ON k.id_pasien = p.id_pasien
                  JOIN dokter d ON r.id_dokter = d.id_dokter
                  WHERE r.id_resep = ?";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $resep_id);
        $stmt->execute();
        $resep_info = $stmt->get_result()->fetch_assoc();
        
        if(!$resep_info) {
            throw new Exception("Resep tidak ditemukan");
        }

        // Get prescription details with prepared statement
        $query = "SELECT * FROM detail_resep WHERE id_resep = ? ORDER BY nama_obat";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $resep_id);
        $stmt->execute();
        $details = $stmt->get_result();
        
        // Calculate total with prepared statement
        $total_query = "SELECT SUM(jumlah * harga_satuan) as total FROM detail_resep WHERE id_resep = ?";
        $stmt = $conn->prepare($total_query);
        $stmt->bind_param("i", $resep_id);
        $stmt->execute();
        $total_result = $stmt->get_result()->fetch_assoc();
        $total = $total_result['total'] ?? 0;
        
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
?>

<!-- Header Section -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Detail Resep Obat</h2>
        <?php if(!empty($resep_info)): ?>
            <p class="mb-0 text-muted">
                Resep untuk: <?= htmlspecialchars($resep_info['nama_pasien']) ?> 
                (Dokter: <?= htmlspecialchars($resep_info['nama_dokter']) ?>)
                - Tanggal: <?= date('d/m/Y', strtotime($resep_info['tgl_resep'])) ?>
            </p>
        <?php endif; ?>
    </div>
    <?php if($resep_id && !empty($resep_info)): ?>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahDetailModal">
            <i class="bi bi-plus-lg me-1"></i> Tambah Obat
        </button>
    <?php endif; ?>
</div>

<!-- Error Message -->
<?php if(isset($error_message)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
<?php endif; ?>

<!-- Main Table -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="detailTable">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Obat</th>
                        <th>Jumlah</th>
                        <th>Dosis</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($resep_id && !empty($resep_info)): ?>
                        <?php if($details->num_rows > 0): ?>
                            <?php $no = 1; ?>
                            <?php while($row = $details->fetch_assoc()): ?>
                                <?php $subtotal = $row['jumlah'] * $row['harga_satuan']; ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['nama_obat']) ?></td>
                                    <td><?= $row['jumlah'] ?></td>
                                    <td><?= htmlspecialchars($row['dosis']) ?></td>
                                    <td>Rp <?= number_format($row['harga_satuan'], 0, ',', '.') ?></td>
                                    <td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-warning edit-detail" data-id="<?= $row['id_detail'] ?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger hapus-detail" data-id="<?= $row['id_detail'] ?>">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">Belum ada obat yang ditambahkan</td>
                            </tr>
                        <?php endif; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">
                                <?= $resep_id ? 'Resep tidak ditemukan' : 'Silakan pilih resep terlebih dahulu' ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr class="table-dark">
                        <td colspan="5" class="text-end"><strong>Total</strong></td>
                        <td><strong>Rp <?= number_format($total, 0, ',', '.') ?></strong></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Add Medicine Modal -->
<div class="modal fade" id="tambahDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Obat ke Resep</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../proses/crud_detail_resep.php" method="POST">
                <input type="hidden" name="id_resep" value="<?= $resep_id ?>">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Obat</label>
                        <input type="text" class="form-control" name="nama_obat" required>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" min="1" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga Satuan</label>
                            <input type="number" class="form-control" name="harga_satuan" min="0" step="100" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Dosis</label>
                        <input type="text" class="form-control" name="dosis" placeholder="Contoh: 2x sehari 1 tablet" required>
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

<!-- Edit Medicine Modal -->
<div class="modal fade" id="editDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Detail Obat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../proses/crud_detail_resep.php" method="POST">
                <input type="hidden" name="id_detail" id="edit_id_detail">
                <input type="hidden" name="id_resep" value="<?= $resep_id ?>">
                <div class="modal-body">
                    <!-- Content loaded via AJAX -->
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
    // Edit button click handler
    $('.edit-detail').click(function() {
        var id = $(this).data('id');
        
        $.ajax({
            url: '../proses/get_detail_resep.php',
            type: 'POST',
            data: {id: id},
            success: function(response) {
                $('#editDetailModal .modal-body').html(response);
                $('#edit_id_detail').val(id);
                $('#editDetailModal').modal('show');
            },
            error: function(xhr) {
                alert('Error: ' + xhr.statusText);
            }
        });
    });
    
    // Delete button click handler
    $('.hapus-detail').click(function() {
        if(confirm('Apakah Anda yakin ingin menghapus obat ini dari resep?')) {
            var id = $(this).data('id');
            window.location.href = '../proses/crud_detail_resep.php?hapus=' + id + '&resep_id=<?= $resep_id ?>';
        }
    });
});
</script>

<?php include '../includes/footer.php'; ?>  