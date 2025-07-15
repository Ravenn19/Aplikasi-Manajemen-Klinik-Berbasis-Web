<?php
include '../config/database.php';

if(isset($_POST['id'])) {
    $id = intval($_POST['id']);
    
    $query = "SELECT r.*, p.nama as nama_pasien, d.nama as nama_dokter 
              FROM resep_obat r
              JOIN kunjungan k ON r.id_kunjungan = k.id_kunjungan
              JOIN pasien p ON k.id_pasien = p.id_pasien
              JOIN dokter d ON r.id_dokter = d.id_dokter
              WHERE r.id_resep = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $tgl_resep = date('Y-m-d', strtotime($data['tgl_resep']));
        ?>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Kunjungan</label>
                <select class="form-select" name="id_kunjungan" required>
                    <option value="<?= $data['id_kunjungan'] ?>">
                        <?= $data['nama_pasien'] ?> - <?= date('d/m/Y H:i', strtotime($data['tgl_kunjungan'])) ?>
                    </option>
                    <?php
                    $kunjungan = $conn->query("SELECT k.id_kunjungan, p.nama, k.tgl_kunjungan 
                                             FROM kunjungan k
                                             JOIN pasien p ON k.id_pasien = p.id_pasien
                                             WHERE k.id_kunjungan != ".$data['id_kunjungan']."
                                             ORDER BY k.tgl_kunjungan DESC");
                    while($k = $kunjungan->fetch_assoc()) {
                        echo "<option value='$k[id_kunjungan]'>$k[nama] - ".date('d/m/Y H:i', strtotime($k['tgl_kunjungan']))."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Dokter</label>
                <select class="form-select" name="id_dokter" required>
                    <option value="<?= $data['id_dokter'] ?>"><?= $data['nama_dokter'] ?></option>
                    <?php
                    $dokter = $conn->query("SELECT * FROM dokter WHERE id_dokter != ".$data['id_dokter']." ORDER BY nama");
                    while($d = $dokter->fetch_assoc()) {
                        echo "<option value='$d[id_dokter]'>$d[nama] ($d[spesialisasi])</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Resep</label>
                <input type="date" class="form-control" name="tgl_resep" value="<?= $tgl_resep ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Total Harga</label>
                <input type="number" class="form-control" name="total_harga" value="<?= $data['total_harga'] ?>" step="0.01" required>
            </div>
        </div>
        
        <?php
    } else {
        echo "<div class='alert alert-danger'>Data resep tidak ditemukan</div>";
    }
} else {
    echo "<div class='alert alert-warning'>ID resep tidak valid</div>";
}
?>