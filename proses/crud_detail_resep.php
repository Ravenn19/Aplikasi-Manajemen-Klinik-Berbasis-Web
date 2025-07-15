<?php
include '../config/database.php';

// CREATE - Tambah Data Detail Resep
if(isset($_POST['tambah'])) {
    try {
        $id_resep = intval($_POST['id_resep']);
        $nama_obat = htmlspecialchars($_POST['nama_obat']);
        $jumlah = intval($_POST['jumlah']);
        $dosis = htmlspecialchars($_POST['dosis']);
        $harga_satuan = floatval($_POST['harga_satuan']);
        
        $stmt = $conn->prepare("INSERT INTO detail_resep (id_resep, nama_obat, jumlah, dosis, harga_satuan) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isisd", $id_resep, $nama_obat, $jumlah, $dosis, $harga_satuan);
        
        if($stmt->execute()) {
            // Update total harga in resep_obat
            updateTotalHarga($conn, $id_resep);
            
            header("Location: ../pages/detail_resep.php?success=tambah&id=".$conn->insert_id."&resep_id=".$id_resep);
            exit();
        } else {
            throw new Exception("Gagal menambahkan data: ".$stmt->error);
        }
    } catch (Exception $e) {
        $resep_id = isset($_POST['id_resep']) ? intval($_POST['id_resep']) : 0;
        header("Location: ../pages/detail_resep.php?error=".urlencode($e->getMessage())."&resep_id=".$resep_id);
        exit();
    }
}

// UPDATE - Edit Data Detail Resep
if(isset($_POST['edit'])) {
    try {
        $id = intval($_POST['id_detail']);
        $id_resep = intval($_POST['id_resep']);
        $nama_obat = htmlspecialchars($_POST['nama_obat']);
        $jumlah = intval($_POST['jumlah']);
        $dosis = htmlspecialchars($_POST['dosis']);
        $harga_satuan = floatval($_POST['harga_satuan']);

        $stmt = $conn->prepare("UPDATE detail_resep SET 
                              nama_obat = ?,
                              jumlah = ?,
                              dosis = ?,
                              harga_satuan = ?
                              WHERE id_detail = ?");
        $stmt->bind_param("sissi", $nama_obat, $jumlah, $dosis, $harga_satuan, $id);
        
        if($stmt->execute()) {
            // Update total harga in resep_obat
            updateTotalHarga($conn, $id_resep);
            
            header("Location: ../pages/detail_resep.php?success=edit&id=".$id."&resep_id=".$id_resep);
            exit();
        } else {
            throw new Exception("Gagal memperbarui data: ".$stmt->error);
        }
    } catch (Exception $e) {
        $resep_id = isset($_POST['id_resep']) ? intval($_POST['id_resep']) : 0;
        header("Location: ../pages/detail_resep.php?error=".urlencode($e->getMessage())."&resep_id=".$resep_id);
        exit();
    }
}

// DELETE - Hapus Data Detail Resep
if(isset($_GET['hapus'])) {
    try {
        $id = intval($_GET['hapus']);
        $resep_id = isset($_GET['resep_id']) ? intval($_GET['resep_id']) : 0;
        
        // Get detail first to update total later
        $stmt = $conn->prepare("SELECT id_resep FROM detail_resep WHERE id_detail = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($resep_id);
        $stmt->fetch();
        $stmt->close();
        
        $delete = $conn->prepare("DELETE FROM detail_resep WHERE id_detail = ?");
        $delete->bind_param("i", $id);
        
        if($delete->execute()) {
            // Update total harga in resep_obat
            if($resep_id > 0) {
                updateTotalHarga($conn, $resep_id);
            }
            
            header("Location: ../pages/detail_resep.php?success=hapus&resep_id=".$resep_id);
            exit();
        } else {
            throw new Exception("Gagal menghapus data: ".$delete->error);
        }
    } catch (Exception $e) {
        $resep_id = isset($_GET['resep_id']) ? intval($_GET['resep_id']) : 0;
        header("Location: ../pages/detail_resep.php?error=".urlencode($e->getMessage())."&resep_id=".$resep_id);
        exit();
    }
}

// Helper function to update total harga in resep_obat
function updateTotalHarga($conn, $id_resep) {
    $sum = $conn->prepare("SELECT SUM(jumlah * harga_satuan) FROM detail_resep WHERE id_resep = ?");
    $sum->bind_param("i", $id_resep);
    $sum->execute();
    $sum->bind_result($total);
    $sum->fetch();
    $sum->close();
    
    $update = $conn->prepare("UPDATE resep_obat SET total_harga = ? WHERE id_resep = ?");
    $update->bind_param("di", $total, $id_resep);
    $update->execute();
    $update->close();
}

// Jika tidak ada aksi yang valid
$resep_id = isset($_GET['resep_id']) ? intval($_GET['resep_id']) : 0;
header("Location: ../pages/detail_resep.php".($resep_id > 0 ? "?resep_id=".$resep_id : ""));
exit();
?>