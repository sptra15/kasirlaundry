<?php echo view('admin/templates/header'); ?>

<div class="flex">
    <!-- Sidebar -->
    <div class="w-64">
        <?php echo view('admin/templates/sidebar'); ?>
    </div>

    <!-- Konten -->
    <div class="content p-4 flex-1">
        <h1 class="text-3xl font-semibold mb-4">Laporan Transaksi Selesai</h1>

        <!-- Filter Chart -->
        <div class="mb-6 flex items-center gap-4">
            <label for="filterChart" class="text-sm font-medium">Tampilkan Pendapatan:</label>
            <select id="filterChart" onchange="filterChart()" class="p-2 border rounded">
                <option value="hari" <?= $filter == 'hari' ? 'selected' : '' ?>>Per Hari</option>
                <option value="minggu" <?= $filter == 'minggu' ? 'selected' : '' ?>>Per Minggu</option>
                <option value="bulan" <?= $filter == 'bulan' ? 'selected' : '' ?>>Per Bulan</option>
            </select>
        </div>

        <!-- Chart Pendapatan -->
        <div class="bg-white p-4 rounded shadow-md mb-8">
            <canvas id="chartPendapatan" height="100"></canvas>
        </div>

        <!-- Filter ID Transaksi -->
        <div class="mb-4">
            <input type="text" id="cariReport" placeholder="Cari ID Transaksi..." onkeyup="filterReport()" class="p-2 border border-gray-300 rounded-lg w-80" />
        </div>

        <!-- Tabel Data -->
        <table class="min-w-full table-auto border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">ID Transaksi</th>
                    <th class="px-4 py-2 border">Nama Pelanggan</th>
                    <th class="px-4 py-2 border">Tanggal</th>
                    <th class="px-4 py-2 border">Total</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Proses</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($transaksi as $trx): ?>
                <tr class="bg-white hover:bg-gray-50">
                    <td class="px-4 py-2 border"><?= $no++ ?></td>
                    <td class="px-4 py-2 border"><?= $trx['id_transaksi'] ?></td>
                    <td class="px-4 py-2 border"><?= $trx['nama_pelanggan'] ?></td>
                    <td class="px-4 py-2 border"><?= $trx['tanggal'] ?></td>
                    <td class="px-4 py-2 border">Rp<?= number_format($trx['total'], 0, ',', '.') ?></td>
                    <td class="px-4 py-2 border"><?= $trx['status'] ?></td>
                    <td class="px-4 py-2 border text-green-600 font-semibold"><?= $trx['proses'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Filter ID Transaksi -->
<script>
function filterReport() {
    var input = document.getElementById("cariReport").value.toUpperCase();
    var rows = document.querySelectorAll("table tbody tr");

    rows.forEach(function(row) {
        var idTransaksi = row.cells[1].textContent.toUpperCase();
        row.style.display = idTransaksi.indexOf(input) > -1 ? "" : "none";
    });
}
</script>

<!-- Filter Chart -->
<script>
function filterChart() {
    const value = document.getElementById('filterChart').value;
    window.location.href = "?filter=" + value;
}
</script>

<!-- Chart Script -->
<script>
const ctx = document.getElementById('chartPendapatan').getContext('2d');
const chartPendapatan = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= $labels ?>,
        datasets: [{
            label: 'Pendapatan',
            data: <?= $pendapatan ?>,
            backgroundColor: 'rgba(59, 130, 246, 0.6)',
            borderColor: 'rgba(37, 99, 235, 1)',
            borderWidth: 1,
            borderRadius: 6
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return 'Rp' + value.toLocaleString('id-ID');
                    }
                }
            }
        }
    }
});
</script>
