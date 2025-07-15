<?php
include '../config/database.php';

// CREATE - Tambah Data Resep
if(isset($_POST['tambah'])) {
    try {
        $id_kunjungan = intval($_POST['id_kunjungan']);
        $id_dokter = intval($_POST['id_dokter']);
        $tgl_resep = $_POST['tgl_resep'];
        $total_harga = floatval($_POST['total_harga']);
        
        $stmt = $conn->prepare("INSERT INTO resep_obat (id_kunjungan, id_dokter, tgl_resep, total_harga) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iisd", $id_kunjungan, $id_dokter, $tgl_resep, $total_harga);
        
        if($stmt->execute()) {
            header("Location: ../pages/resep_obat.php?success=tambah&id=".$conn->insert_id);
            exit();
        } else {
            throw new Exception("Gagal menambahkan data: ".$stmt->error);
        }
    } catch (Exception $e) {
        header("Location: ../pages/resep_obat.php?error=".urlencode($e->getMessage()));
        exit();
    }
}

// UPDATE - Edit Data Resep
if(isset($_POST['edit'])) {
    try {
        $id = intval($_POST['id_resep']);
        $id_kunjungan = intval($_POST['id_kunjungan']);
        $id_dokter = intval($_POST['id_dokter']);
        $tgl_resep = $_POST['tgl_resep'];
        $total_harga = floatval($_POST['total_harga']);

        $stmt = $conn->prepare("UPDATE resep_obat SET 
                              id_kunjungan = ?,
                              id_dokter = ?,
                              tgl_resep = ?,
                              total_harga = ?
                              WHERE id_resep = ?");
        $stmt->bind_param("iisdi", $id_kunjungan, $id_dokter, $tgl_resep, $total_harga, $id);
        
        if($stmt->execute()) {
            header("Location: ../pages/resep_obat.php?success=edit&id=".$id);
            exit();
        } else {
            throw new Exception("Gagal memperbarui data: ".$stmt->error);
        }
    } catch (Exception $e) {
        header("Location: ../pages/resep_obat.php?error=".urlencode($e->getMessage()));
        exit();
    }
}

// DELETE - Hapus Data Resep
if(isset($_GET['hapus'])) {
    try {
        $id = intval($_GET['hapus']);
        
        // First delete all related detail_resep
        $conn->begin_transaction();
        
        $delete_details = $conn->prepare("DELETE FROM detail_resep WHERE id_resep = ?");
        $delete_details->bind_param("i", $id);
        $delete_details->execute();
        
        $delete_resep = $conn->prepare("DELETE FROM resep_obat WHERE id_resep = ?");
        $delete_resep->bind_param("i", $id);
        $delete_resep->execute();
        
        if($delete_resep->affected_rows > 0) {
            $conn->commit();
            header("Location: ../pages/resep_obat.php?success=hapus");
            exit();
        } else {
            $conn->rollback();
            throw new Exception("Gagal menghapus data resep");
        }
    } catch (Exception $e) {
        $conn->rollback();
        header("Location: ../pages/resep_obat.php?error=".urlencode($e->getMessage()));
        exit();
    }
}

// Jika tidak ada aksi yang valid
header("Location: ../pages/resep_obat.php");
exit();
?>