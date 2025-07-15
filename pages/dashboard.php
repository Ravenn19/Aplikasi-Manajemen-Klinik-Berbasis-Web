<?php include '../includes/header2.php'; ?>
<?php include '../config/database.php'; ?>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2 text-muted">Total Pasien</h6>
                        <h3 class="card-title">
                            <?php 
                            $query = "SELECT COUNT(*) as total FROM Pasien";
                            $result = $conn->query($query);
                            $row = $result->fetch_assoc();
                            echo $row['total'];
                            ?>
                        </h3>
                    </div>
                    <div class="card-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2 text-muted">Kunjungan Hari Ini</h6>
                        <h3 class="card-title">
                            <?php 
                            $today = date('Y-m-d');
                            $query = "SELECT COUNT(*) as total FROM Kunjungan WHERE DATE(tgl_kunjungan) = '$today'";
                            $result = $conn->query($query);
                            $row = $result->fetch_assoc();
                            echo $row['total'];
                            ?>
                        </h3>
                    </div>
                    <div class="card-icon">
                        <i class="bi bi-clipboard2-pulse-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2 text-muted">Total Penyakit</h6>
                        <h3 class="card-title">
                            <?php 
                            $query = "SELECT COUNT(*) as total FROM Penyakit";
                            $result = $conn->query($query);
                            $row = $result->fetch_assoc();
                            echo $row['total'];
                            ?>
                        </h3>
                    </div>
                    <div class="card-icon">
                        <i class="bi bi-bug-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2 text-muted">Pasien Rawat Inap</h6>
                        <h3 class="card-title">
                            <?php 
                            $query = "SELECT COUNT(*) as total FROM Kunjungan WHERE status = 'Rawat Inap'";
                            $result = $conn->query($query);
                            $row = $result->fetch_assoc();
                            echo $row['total'];
                            ?>
                        </h3>
                    </div>
                    <div class="card-icon">
                        <i class="bi bi-hospital-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Statistik Kunjungan 7 Hari Terakhir</h5>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="visitChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Penyakit Terbanyak</h5>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="diseaseChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Kunjungan Terbaru</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pasien</th>
                                <th>Tanggal</th>
                                <th>Penyakit</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT k.*, p.nama as nama_pasien, py.nama as nama_penyakit 
                                      FROM Kunjungan k
                                      JOIN Pasien p ON k.id_pasien = p.id_pasien
                                      JOIN Penyakit py ON k.id_penyakit = py.id_penyakit
                                      ORDER BY k.tgl_kunjungan DESC LIMIT 5";
                            $result = $conn->query($query);
                            $no = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>$no</td>
                                    <td>$row[nama_pasien]</td>
                                    <td>" . date('d M Y', strtotime($row['tgl_kunjungan'])) . "</td>
                                    <td>$row[nama_penyakit]</td>
                                    <td><span class='badge bg-" . ($row['status'] == 'Rawat Inap' ? 'danger' : ($row['status'] == 'Sembuh' ? 'success' : 'primary')) . "'>$row[status]</span></td>
                                    <td>
                                        <a href='kunjungan_detail.php?id=$row[id_kunjungan]' class='btn btn-sm btn-primary'>Detail</a>
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
    </div>
</div>

<script>
    // Kunjungan Chart
    const visitCtx = document.getElementById('visitChart').getContext('2d');
    
    <?php
    $labels = [];
    $data = [];
    for ($i = 6; $i >= 0; $i--) {
        $date = date('Y-m-d', strtotime("-$i days"));
        $labels[] = date('d M', strtotime($date));
        
        $query = "SELECT COUNT(*) as total FROM Kunjungan WHERE DATE(tgl_kunjungan) = '$date'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $data[] = $row['total'];
    }
    ?>
    
    const visitChart = new Chart(visitCtx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: 'Jumlah Kunjungan',
                data: <?php echo json_encode($data); ?>,
                backgroundColor: 'rgba(52, 152, 219, 0.2)',
                borderColor: 'rgba(52, 152, 219, 1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });
    
    // Disease Chart
    const diseaseCtx = document.getElementById('diseaseChart').getContext('2d');
    
    <?php
    $query = "SELECT py.nama, COUNT(*) as total 
              FROM Kunjungan k 
              JOIN Penyakit py ON k.id_penyakit = py.id_penyakit 
              GROUP BY k.id_penyakit 
              ORDER BY total DESC LIMIT 5";
    $result = $conn->query($query);
    $diseaseLabels = [];
    $diseaseData = [];
    $colors = ['#3498db', '#2ecc71', '#f1c40f', '#e74c3c', '#9b59b6'];
    while ($row = $result->fetch_assoc()) {
        $diseaseLabels[] = $row['nama'];
        $diseaseData[] = $row['total'];
    }
    ?>
    
    const diseaseChart = new Chart(diseaseCtx, {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode($diseaseLabels); ?>,
            datasets: [{
                data: <?php echo json_encode($diseaseData); ?>,
                backgroundColor: <?php echo json_encode($colors); ?>,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'right',
                }
            }
        }
    });
</script>

<?php include '../includes/footer.php'; ?>