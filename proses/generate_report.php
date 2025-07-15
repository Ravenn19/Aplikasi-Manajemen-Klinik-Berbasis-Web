<?php
include '../config/database.php';

// Debugging: Log received parameters
error_log("Received params - start_date: ".$_POST['start_date']." end_date: ".$_POST['end_date']." type: ".$_POST['report_type']);

// Set header JSON
header('Content-Type: application/json');

// Get and validate parameters
$start_date = $_POST['start_date'] ?? date('Y-m-01');
$end_date = $_POST['end_date'] ?? date('Y-m-d');
$report_type = $_POST['report_type'] ?? 'all';

// Convert dates to Y-m-d format
$start_date = date('Y-m-d', strtotime($start_date));
$end_date = date('Y-m-d', strtotime($end_date));

// Validate date range
if ($start_date > $end_date) {
    echo json_encode([
        'success' => false,
        'message' => 'Tanggal mulai tidak boleh lebih besar dari tanggal akhir'
    ]);
    exit;
}

// Base query with JOIN
$query = "SELECT 
            k.id_kunjungan,
            DATE_FORMAT(k.tgl_kunjungan, '%d/%m/%Y %H:%i') as formatted_date,
            p.nama as patient_name,
            py.nama as disease_name,
            k.status,
            k.tindakan as treatment,
            DATE(k.tgl_kunjungan) as visit_date
          FROM Kunjungan k
          JOIN Pasien p ON k.id_pasien = p.id_pasien
          JOIN Penyakit py ON k.id_penyakit = py.id_penyakit
          WHERE DATE(k.tgl_kunjungan) BETWEEN ? AND ?";

$params = [$start_date, $end_date];
$types = 'ss';

// Add status filter if needed
$status_map = [
    'inap' => 'Rawat Inap',
    'jalan' => 'Rawat Jalan', 
    'sembuh' => 'Sembuh',
    'rujuk' => 'Rujuk'
];

if ($report_type !== 'all' && isset($status_map[$report_type])) {
    $query .= " AND k.status = ?";
    $params[] = $status_map[$report_type];
    $types .= 's';
}

$query .= " ORDER BY k.tgl_kunjungan DESC";

// Prepare and execute
$stmt = $conn->prepare($query);

// Debugging: Log the actual query being executed
error_log("Executing query: ".$query);
error_log("With params: ".print_r($params, true));

if ($stmt === false) {
    echo json_encode([
        'success' => false,
        'message' => 'Error preparing query: '.$conn->error
    ]);
    exit;
}

$stmt->bind_param($types, ...$params);

if (!$stmt->execute()) {
    echo json_encode([
        'success' => false,
        'message' => 'Error executing query: '.$stmt->error
    ]);
    exit;
}

$result = $stmt->get_result();
$tableData = [];

while ($row = $result->fetch_assoc()) {
    $tableData[] = [
        'tanggal' => $row['formatted_date'],
        'pasien' => $row['patient_name'],
        'penyakit' => $row['disease_name'],
        'status' => $row['status'],
        'tindakan' => $row['treatment']
    ];
}

// Query for chart data (simplified)
$chartQuery = "SELECT 
                DATE(tgl_kunjungan) as date,
                COUNT(*) as count
               FROM Kunjungan
               WHERE DATE(tgl_kunjungan) BETWEEN ? AND ?";

if ($report_type !== 'all' && isset($status_map[$report_type])) {
    $chartQuery .= " AND status = ?";
}

$chartQuery .= " GROUP BY DATE(tgl_kunjungan)
                ORDER BY DATE(tgl_kunjungan)";

$chartStmt = $conn->prepare($chartQuery);
$chartStmt->bind_param($types, ...$params);
$chartStmt->execute();
$chartResult = $chartStmt->get_result();

$chartData = [
    'dates' => [],
    'visitCounts' => []
];

while ($row = $chartResult->fetch_assoc()) {
    $chartData['dates'][] = $row['date'];
    $chartData['visitCounts'][] = $row['count'];
}

// Disease distribution data
$diseaseQuery = "SELECT 
                  py.nama as disease,
                  COUNT(*) as count
                 FROM Kunjungan k
                 JOIN Penyakit py ON k.id_penyakit = py.id_penyakit
                 WHERE DATE(k.tgl_kunjungan) BETWEEN ? AND ?";

if ($report_type !== 'all' && isset($status_map[$report_type])) {
    $diseaseQuery .= " AND k.status = ?";
}

$diseaseQuery .= " GROUP BY py.nama
                  ORDER BY count DESC
                  LIMIT 8";

$diseaseStmt = $conn->prepare($diseaseQuery);
$diseaseStmt->bind_param($types, ...$params);
$diseaseStmt->execute();
$diseaseResult = $diseaseStmt->get_result();

$chartData['diseases'] = [];
$chartData['diseaseCounts'] = [];

while ($row = $diseaseResult->fetch_assoc()) {
    $chartData['diseases'][] = $row['disease'];
    $chartData['diseaseCounts'][] = $row['count'];
}


// Final response
echo json_encode([
    'success' => true,
    'tableData' => $tableData,
    'chartData' => $chartData,
    'debug' => [
        'query' => $query,
        'params' => $params,
        'record_count' => count($tableData)
    ]
    
]);

$stmt->close();
$chartStmt->close();
$diseaseStmt->close();
$conn->close();

?>