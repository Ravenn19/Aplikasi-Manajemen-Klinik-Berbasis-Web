<?php
include '../config/database.php';

// CREATE - Tambah Data Kunjungan
if(isset($_POST['tambah'])) {
    try {
        $id_pasien = intval($_POST['id_pasien']);
        $id_penyakit = intval($_POST['id_penyakit']);
        $tgl_kunjungan = $_POST['tgl_kunjungan'];
        $gejala = htmlspecialchars($_POST['gejala']);
        $tindakan = htmlspecialchars($_POST['tindakan']);
        $status = $_POST['status'];
        
        $stmt = $conn->prepare("INSERT INTO Kunjungan (id_pasien, id_penyakit, tgl_kunjungan, gejala, tindakan, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iissss", $id_pasien, $id_penyakit, $tgl_kunjungan, $gejala, $tindakan, $status);
        
        if($stmt->execute()) {
            header("Location: ../pages/kunjungan.php?success=tambah&id=".$conn->insert_id);
            exit();
        } else {
            throw new Exception("Gagal menambahkan data: ".$stmt->error);
        }
    } catch (Exception $e) {
        header("Location: ../pages/kunjungan.php?error=".urlencode($e->getMessage()));
        exit();
    }
}

// UPDATE - Edit Data Kunjungan
if(isset($_POST['edit'])) {
    try {
        $id = intval($_POST['id_kunjungan']);
        $id_pasien = intval($_POST['id_pasien']);
        $id_penyakit = intval($_POST['id_penyakit']);
        $tgl_kunjungan = $_POST['tgl_kunjungan'];
        $gejala = htmlspecialchars($_POST['gejala']);
        $tindakan = htmlspecialchars($_POST['tindakan']);
        $status = $_POST['status'];

        $stmt = $conn->prepare("UPDATE Kunjungan SET 
                              id_pasien = ?,
                              id_penyakit = ?,
                              tgl_kunjungan = ?,
                              gejala = ?,
                              tindakan = ?,
                              status = ?
                              WHERE id_kunjungan = ?");
        $stmt->bind_param("iissssi", $id_pasien, $id_penyakit, $tgl_kunjungan, $gejala, $tindakan, $status, $id);
        
        if($stmt->execute()) {
            header("Location: ../pages/kunjungan.php?success=edit&id=".$id);
            exit();
        } else {
            throw new Exception("Gagal memperbarui data: ".$stmt->error);
        }
    } catch (Exception $e) {
        header("Location: ../pages/kunjungan.php?error=".urlencode($e->getMessage()));
        exit();
    }
}

// DELETE - Hapus Data Kunjungan
if(isset($_GET['hapus'])) {
    try {
        $id = intval($_GET['hapus']);
        
        $stmt = $conn->prepare("DELETE FROM Kunjungan WHERE id_kunjungan = ?");
        $stmt->bind_param("i", $id);
        
        if($stmt->execute()) {
            header("Location: ../pages/kunjungan.php?success=hapus");
            exit();
        } else {
            throw new Exception("Gagal menghapus data: ".$stmt->error);
        }
    } catch (Exception $e) {
        header("Location: ../pages/kunjungan.php?error=".urlencode($e->getMessage()));
        exit();
    }
}

// Jika tidak ada aksi yang valid
header("Location: ../pages/kunjungan.php");
exit();
?>