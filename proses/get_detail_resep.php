<?php
include '../config/database.php';

if(isset($_POST['id'])) {
    $id = intval($_POST['id']);
    
    $query = "SELECT * FROM detail_resep WHERE id_detail = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        ?>
        
        <div class="mb-3">
            <label class="form-label">Nama Obat</label>
            <input type="text" class="form-control" name="nama_obat" value="<?= htmlspecialchars($data['nama_obat']) ?>" required>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" class="form-control" name="jumlah" value="<?= $data['jumlah'] ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Harga Satuan</label>
                <input type="number" class="form-control" name="harga_satuan" value="<?= $data['harga_satuan'] ?>" step="0.01" required>
            </div>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Dosis</label>
            <input type="text" class="form-control" name="dosis" value="<?= htmlspecialchars($data['dosis']) ?>" required>
        </div>
        
        <?php
    } else {
        echo "<div class='alert alert-danger'>Data detail resep tidak ditemukan</div>";
    }
} else {
    echo "<div class='alert alert-warning'>ID detail resep tidak valid</div>";
}
?>