<?php include 'includes/header.php'; ?>
<?php include 'config/database.php'; 

// Add this function definition at the top of your file
function getStatusColor($status) {
    switch($status) {
        case 'Rawat Inap': return 'danger';
        case 'Sembuh': return 'success';
        case 'Rujuk': return 'warning';
        default: return 'primary';
    }
}
?>

<div class="row mb-4">
    <div class="col-md-12">
        <div class="alert alert-primary">
            <h4 class="alert-heading"><i class="bi bi-heart-pulse-fill"></i> Selamat Datang di HEALTHCONNECT</h4>
            <p>No Patient Left Behind</p>
        </div>
    </div>
</div>

<div class="row">
    <!-- Stat Cards -->
    <div class="col-md-3">
        <div class="card stat-card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-subtitle">Total Pasien</h6>
                        <h3 class="card-title">
                            <?php echo $conn->query("SELECT COUNT(*) FROM Pasien")->fetch_row()[0]; ?>
                        </h3>
                    </div>
                    <i class="bi bi-people-fill display-6"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card stat-card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-subtitle">Kunjungan Hari Ini</h6>
                        <h3 class="card-title">
                            <?php 
                            $today = date('Y-m-d');
                            echo $conn->query("SELECT COUNT(*) FROM Kunjungan WHERE DATE(tgl_kunjungan) = '$today'")->fetch_row()[0]; 
                            ?>
                        </h3>
                    </div>
                    <i class="bi bi-clipboard2-pulse-fill display-6"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card stat-card bg-warning text-dark">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-subtitle">Rawat Inap</h6>
                        <h3 class="card-title">
                            <?php echo $conn->query("SELECT COUNT(*) FROM Kunjungan WHERE status = 'Rawat Inap'")->fetch_row()[0]; ?>
                        </h3>
                    </div>
                    <i class="bi bi-hospital-fill display-6"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card stat-card bg-danger text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-subtitle">Kasus Darurat</h6>
                        <h3 class="card-title">
                            <?php echo $conn->query("SELECT COUNT(*) FROM Kunjungan WHERE gejala LIKE '%darurat%' OR gejala LIKE '%gawat%'")->fetch_row()[0]; ?>
                        </h3>
                    </div>
                    <i class="bi bi-exclamation-triangle-fill display-6"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Kunjungan Terakhir</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Pasien</th>
                                <th>Penyakit</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT k.tgl_kunjungan, p.nama as pasien, py.nama as penyakit, k.status 
                                      FROM Kunjungan k
                                      JOIN Pasien p ON k.id_pasien = p.id_pasien
                                      JOIN Penyakit py ON k.id_penyakit = py.id_penyakit
                                      ORDER BY k.tgl_kunjungan DESC LIMIT 5";
                            $result = $conn->query($query);
                            $no = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>$no</td>
                                    <td>".date('d/m/Y H:i', strtotime($row['tgl_kunjungan']))."</td>
                                    <td>$row[pasien]</td>
                                    <td>$row[penyakit]</td>
                                    <td><span class='badge bg-".getStatusColor($row['status'])."'>$row[status]</span></td>
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
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Penyakit Terbanyak</h5>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="topDiseasesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Top Diseases Chart
    new Chart($('#topDiseasesChart'), {
        type: 'bar',
        data: {
            labels: [
                <?php
                $query = "SELECT py.nama, COUNT(*) as total 
                          FROM Kunjungan k 
                          JOIN Penyakit py ON k.id_penyakit = py.id_penyakit 
                          GROUP BY k.id_penyakit 
                          ORDER BY total DESC 
                          LIMIT 5";
                $result = $conn->query($query);
                while($row = $result->fetch_assoc()) {
                    echo "'$row[nama]',";
                }
                ?>
            ],
            datasets: [{
                label: 'Jumlah Kasus',
                data: [
                    <?php
                    $result = $conn->query($query);
                    while($row = $result->fetch_assoc()) {
                        echo "$row[total],";
                    }
                    ?>
                ],
                backgroundColor: [
                    'rgba(52, 152, 219, 0.7)',
                    'rgba(46, 204, 113, 0.7)',
                    'rgba(241, 196, 15, 0.7)',
                    'rgba(231, 76, 60, 0.7)',
                    'rgba(155, 89, 182, 0.7)'
                ]
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>

<?php include 'includes/footer.php'; ?>