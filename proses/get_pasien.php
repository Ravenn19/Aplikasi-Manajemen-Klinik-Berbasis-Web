<?php
include '../config/database.php';

header('Content-Type: application/json');

if (!isset($_POST['id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'ID pasien tidak valid'
    ]);
    exit;
}

$id = $_POST['id'];
$query = "SELECT * FROM Pasien WHERE id_pasien = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode([
        'success' => true,
        'data' => $row
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Data pasien tidak ditemukan'
    ]);
}

$stmt->close();
$conn->close();
?>