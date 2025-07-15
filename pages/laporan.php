<?php include '../includes/header2.php'; ?>
<?php include '../config/database.php'; ?>

<div class="row mb-4">
    <div class="col-md-6">
        <h2>Laporan Klinik</h2>
    </div>
    <div class="col-md-6 text-end">
        <button class="btn btn-success" id="exportExcelBtn">
            <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
        </button>
        <button class="btn btn-info ms-2" id="exportPDFBtn">
            <i class="bi bi-file-earmark-pdf me-1"></i> Export PDF
        </button>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form id="filterForm">
            <div class="row">
                <div class="col-md-3">
                    <label>Tanggal Mulai</label>
                    <input type="date" class="form-control" name="start_date" id="start_date" required>
                </div>
                <div class="col-md-3">
                    <label>Tanggal Akhir</label>
                    <input type="date" class="form-control" name="end_date" id="end_date" required>
                </div>
                <div class="col-md-3">
                    <label>Jenis Laporan</label>
                    <select class="form-select" name="report_type" id="report_type">
                        <option value="all">Semua Kunjungan</option>
                        <option value="inap">Rawat Inap</option>
                        <option value="jalan">Rawat Jalan</option>
                        <option value="sembuh">Sembuh</option>
                        <option value="rujuk">Rujuk</option>
                    </select>
                </div>
                <div class="col-md-3 align-self-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-filter me-1"></i> Filter
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-12">
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control" id="searchInput" placeholder="Cari pasien/penyakit...">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Statistik Kunjungan</h5>
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
                <h5 class="card-title mb-0">Distribusi Penyakit</h5>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="diseaseChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Data Kunjungan</h5>
        <div class="text-muted small" id="reportSummary"></div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="reportTable">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Pasien</th>
                        <th>Penyakit</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be loaded via AJAX -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

<script>
// Initialize variables
let visitChartInstance = null;
let diseaseChartInstance = null;
let currentReportData = [];

$(document).ready(function() {
    // Set default dates (last 30 days)
    const endDate = new Date();
    const startDate = new Date();
    startDate.setDate(startDate.getDate() - 30);
    
    $('#start_date').val(startDate.toISOString().split('T')[0]);
    $('#end_date').val(endDate.toISOString().split('T')[0]);
    
    // Load initial report data
    loadReportData();
    
    // Filter form submission
    $('#filterForm').submit(function(e) {
        e.preventDefault();
        loadReportData();
    });
    
    // Search functionality
    $('#searchInput').on('keyup', function() {
        const searchTerm = $(this).val().toLowerCase();
        $('#reportTable tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(searchTerm) > -1);
        });
    });
    
    // Export to Excel
    $('#exportExcelBtn').click(exportToExcel);
    
    // Export to PDF
    $('#exportPDFBtn').click(exportToPDF);
    
    function loadReportData() {
        // Show loading state
        $('#reportTable tbody').html('<tr><td colspan="6" class="text-center">Memuat data...</td></tr>');
        
        // Get form data
        const formData = $('#filterForm').serialize();
        
        // Debug: log what's being sent
        console.log("Sending filter data:", formData);
        
        $.ajax({
            url: '../proses/generate_report.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log("Server response:", response);
                
                if (response.success) {
                    if (response.tableData.length > 0) {
                        renderCharts(response.chartData);
                        renderTable(response.tableData);
                        updateReportSummary(response.tableData.length);
                    } else {
                        $('#reportTable tbody').html(
                            '<tr><td colspan="6" class="text-center">Tidak ada data ditemukan untuk periode yang dipilih</td></tr>'
                        );
                        resetCharts();
                        updateReportSummary(0);
                    }
                } else {
                    showError(response.message || 'Gagal memuat data laporan');
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
                showError('Terjadi kesalahan saat memuat data. Silakan coba lagi.');
            }
        });
    }

    function resetCharts() {
        if (visitChartInstance) {
            visitChartInstance.destroy();
            $('#visitChart').replaceWith('<canvas id="visitChart"></canvas>');
        }
        if (diseaseChartInstance) {
            diseaseChartInstance.destroy();
            $('#diseaseChart').replaceWith('<canvas id="diseaseChart"></canvas>');
        }
        
        // Initialize empty charts
        const emptyChartOptions = {
            scales: { y: { beginAtZero: true } },
            plugins: { legend: { display: false } }
        };
        
        new Chart($('#visitChart')[0].getContext('2d'), {
            type: 'bar',
            data: { labels: [], datasets: [{ data: [] }] },
            options: emptyChartOptions
        });
        
        new Chart($('#diseaseChart')[0].getContext('2d'), {
            type: 'pie',
            data: { labels: [], datasets: [{ data: [] }] },
            options: emptyChartOptions
        });
    }

    function showError(message) {
        $('#reportTable tbody').html(
            `<tr><td colspan="6" class="text-center text-danger">${message}</td></tr>`
        );
        resetCharts();
        updateReportSummary(0);
    }
    
    function renderCharts(data) {
        // Destroy existing charts if they exist
        if (visitChartInstance) {
            visitChartInstance.destroy();
        }
        if (diseaseChartInstance) {
            diseaseChartInstance.destroy();
        }
        
        // Visit Chart (Line)
        const visitCtx = $('#visitChart')[0].getContext('2d');
        visitChartInstance = new Chart(visitCtx, {
            type: 'line',
            data: {
                labels: data.dates,
                datasets: [{
                    label: 'Jumlah Kunjungan',
                    data: data.visitCounts,
                    backgroundColor: 'rgba(52, 152, 219, 0.2)',
                    borderColor: 'rgba(52, 152, 219, 1)',
                    borderWidth: 2,
                    tension: 0.1,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
        
        // Disease Chart (Doughnut)
        const diseaseCtx = $('#diseaseChart')[0].getContext('2d');
        diseaseChartInstance = new Chart(diseaseCtx, {
            type: 'doughnut',
            data: {
                labels: data.diseases,
                datasets: [{
                    data: data.diseaseCounts,
                    backgroundColor: [
                        '#3498db', '#2ecc71', '#f1c40f', '#e74c3c',
                        '#9b59b6', '#1abc9c', '#d35400', '#34495e',
                        '#16a085', '#27ae60', '#2980b9', '#8e44ad',
                        '#f39c12', '#e67e22', '#c0392b', '#7f8c8d'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    }
    
    function renderTable(data) {
        let html = '';
        
        data.forEach((row, index) => {
            const statusClass = getStatusClass(row.status);
            
            html += `<tr>
                <td>${index + 1}</td>
                <td>${row.tanggal}</td>
                <td>${row.pasien}</td>
                <td>${row.penyakit}</td>
                <td><span class="badge bg-${statusClass}">${row.status}</span></td>
                <td>${row.tindakan}</td>
            </tr>`;
        });
        
        $('#reportTable tbody').html(html);
    }
    
    function updateReportSummary(count) {
        const startDate = $('#start_date').val();
        const endDate = $('#end_date').val();
        const reportType = $('#report_type option:selected').text();
        
        $('#reportSummary').html(`
            Menampilkan ${count} data | ${reportType} | 
            ${formatDate(startDate)} s/d ${formatDate(endDate)}
        `);
    }
    
    function getStatusClass(status) {
        switch(status.toLowerCase()) {
            case 'rawat inap': return 'danger';
            case 'sembuh': return 'success';
            case 'rujuk': return 'warning';
            default: return 'primary';
        }
    }
    
    function formatDate(dateString) {
        const options = { day: '2-digit', month: 'short', year: 'numeric' };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    }
    
    function exportToExcel() {
        if (currentReportData.length === 0) {
            alert('Tidak ada data untuk diexport!');
            return;
        }
        
        // Prepare data for Excel
        const excelData = [
            ['No', 'Tanggal', 'Pasien', 'Penyakit', 'Status', 'Tindakan'],
            ...currentReportData.map((row, index) => [
                index + 1,
                row.tanggal,
                row.pasien,
                row.penyakit,
                row.status,
                row.tindakan
            ])
        ];
        
        // Create workbook
        const wb = XLSX.utils.book_new();
        const ws = XLSX.utils.aoa_to_sheet(excelData);
        
        // Add worksheet to workbook
        XLSX.utils.book_append_sheet(wb, ws, 'Laporan Kunjungan');
        
        // Generate file name
        const startDate = $('#start_date').val();
        const endDate = $('#end_date').val();
        const reportType = $('#report_type option:selected').text();
        const fileName = `Laporan_Kunjungan_${reportType}_${startDate}_${endDate}.xlsx`;
        
        // Export to Excel
        XLSX.writeFile(wb, fileName);
    }
    
    function exportToPDF() {
        if (currentReportData.length === 0) {
            alert('Tidak ada data untuk diexport!');
            return;
        }
        
        // Initialize jsPDF
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        
        // Add title
        const startDate = $('#start_date').val();
        const endDate = $('#end_date').val();
        const reportType = $('#report_type option:selected').text();
        
        doc.setFontSize(16);
        doc.text(`Laporan Kunjungan Klinik`, 14, 15);
        doc.setFontSize(12);
        doc.text(`Jenis: ${reportType} | Periode: ${formatDate(startDate)} - ${formatDate(endDate)}`, 14, 22);
        
        // Prepare data for PDF
        const pdfData = currentReportData.map((row, index) => [
            index + 1,
            row.tanggal,
            row.pasien,
            row.penyakit,
            row.status,
            row.tindakan
        ]);
        
        // Add table
        doc.autoTable({
            head: [['No', 'Tanggal', 'Pasien', 'Penyakit', 'Status', 'Tindakan']],
            body: pdfData,
            startY: 30,
            styles: {
                fontSize: 8,
                cellPadding: 2,
                overflow: 'linebreak'
            },
            columnStyles: {
                0: { cellWidth: 10 },
                1: { cellWidth: 25 },
                2: { cellWidth: 40 },
                3: { cellWidth: 40 },
                4: { cellWidth: 25 },
                5: { cellWidth: 50 }
            }
        });
        
        // Save PDF
        doc.save(`Laporan_Kunjungan_${reportType}_${startDate}_${endDate}.pdf`);
    }
});
</script>

<?php include '../includes/footer.php'; ?>