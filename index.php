<?php
// 1. Memuat semua file dependensi komponen PBO dan Koneksi
require_once 'KoneksiDB.php';
require_once 'Tiket.php';
require_once 'TiketRegular.php';
require_once 'TiketIMax.php';
require_once 'TiketVelvet.php';

// 2. Inisialisasi Koneksi Database dan Mengambil Data
$database = new KoneksiDB();
$db = $database->getKoneksi();

// Array penampung untuk mengelompokkan objek tiket berdasarkan jenis studionya
$kelompokTiket = [
    'regular' => [],
    'max'     => [],
    'velvet'  => []
];

// Variabel bantuan untuk widget statistik
$totalPendapatan = 0;
$totalTiketTerjual = 0;

try {
    // Mengambil seluruh data dari tabel_tiket
    $query = "SELECT * FROM tabel_tiket";
    $stmt = $db->query($query);
    $semuaData = $stmt->fetchAll();

    // 3. PROSES DATA secara Polimorfik (Object Mapping)
    foreach ($semuaData as $row) {
        $jenis = $row['jenis_studio'];
        $objekTiket = null;
        
        // Membentuk objek konkrit secara dinamis berdasarkan discriminator 'jenis_studio'
        if ($jenis === 'regular') {
            $objekTiket = new TiketRegular(
                $row['id_tiket'], $row['nama_film'], $row['jadwal_tayang'], 
                $row['jumlah_kursi'], $row['harga_dasar_tiket'], 
                $row['tipe_studio'], $row['lokasi_baris']
            );
        } elseif ($jenis === 'max') {
            $objekTiket = new TiketIMax(
                $row['id_tiket'], $row['nama_film'], $row['jadwal_tayang'], 
                $row['jumlah_kursi'], $row['harga_dasar_tiket'], 
                $row['kacamata_3d_id'], $row['efek_gerak_fitur']
            );
        } elseif ($jenis === 'velvet') {
            $objekTiket = new TiketVelvet(
                $row['id_tiket'], $row['nama_film'], $row['jadwal_tayang'], 
                $row['jumlah_kursi'], $row['harga_dasar_tiket'], 
                $row['bantal_selimut_pack'], $row['layanan_butler']
            );
        }

        if ($objekTiket !== null) {
            // Memasukkan objek ke kelompok array masing-masing
            $kelompokTiket[$jenis][] = $objekTiket;
            
            // Akumulasi data untuk statistik dashboard secara polimorfik
            $totalPendapatan += $objekTiket->hitungTotalHarga();
            $totalTiketTerjual += $objekTiket->getJumlahKursi();
        }
    }

} catch (PDOException $e) {
    die("Gagal memproses data view: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Tiket Bioskop - Annisa Nur Safitri</title>
    <style>
        :root {
            --bg-body: #f8fafc;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --regular-color: #10b981;
            --imax-color: #3b82f6;
            --velvet-color: #8b5cf6;
            --danger-color: #ef4444;
        }

        body { 
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; 
            background-color: var(--bg-body); 
            margin: 0; 
            padding: 30px 20px; 
            color: var(--text-main); 
        }
        
        .container { max-width: 1240px; margin: 0 auto; }
        
        /* Header Styling */
        header { margin-bottom: 35px; }
        h1 { font-size: 28px; color: #0f172a; margin: 0 0 8px 0; font-weight: 700; }
        .subtitle { color: var(--text-muted); font-size: 14px; margin: 0; }
        .subtitle strong { color: #0f172a; }

        /* Widget Statistik */
        .stats-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); 
            gap: 20px; 
            margin-bottom: 40px; 
        }
        .stat-card { 
            background: white; 
            padding: 20px; 
            border-radius: 12px; 
            box-shadow: 0 1px 3px rgba(0,0,0,0.05), 0 1px 2px rgba(0,0,0,0.02);
            border: 1px solid #e2e8f0;
        }
        .stat-label { font-size: 13px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; }
        .stat-value { font-size: 24px; font-weight: 700; margin-top: 8px; color: #0f172a; }

        /* Section Studio */
        .studio-card { 
            background: white; 
            border-radius: 12px; 
            padding: 24px; 
            margin-bottom: 35px; 
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            border: 1px solid #e2e8f0;
        }
        .studio-header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 20px; 
            padding-bottom: 12px; 
            border-bottom: 1px solid #f1f5f9; 
        }
        .studio-title { font-size: 18px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
        
        .title-regular { color: var(--regular-color); }
        .title-max { color: var(--imax-color); }
        .title-velvet { color: var(--velvet-color); }
        
        .badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; background: #f1f5f9; color: #475569; }

        /* Tabel Modern */
        .table-responsive { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th { padding: 12px 16px; background: #f8fafc; color: var(--text-muted); font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e2e8f0; }
        td { padding: 16px; border-bottom: 1px solid #f1f5f9; font-size: 14px; color: #334155; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background-color: #f8fafc; }
        
        /* Komponen Detail Tabel */
        .id-badge { font-family: monospace; font-weight: 700; background: #f1f5f9; padding: 4px 8px; border-radius: 6px; color: #334155; }
        .film-name { font-weight: 600; color: #0f172a; }
        .spec-container { display: inline-block; background: #f8fafc; border: 1px solid #e2e8f0; padding: 6px 12px; border-radius: 6px; font-size: 13px; }
        .spec-label { color: var(--text-muted); font-weight: 500; }
        .harga-total { font-weight: 700; color: var(--danger-color); font-size: 15px; }
    </style>
</head>
<body>

<div class="container">
    <header>
        <h1>Sistem Informasi Pemesanan Tiket Bioskop</h1>
        <div class="subtitle">Dashboard Utama Manajemen Penjualan — Administrator: <strong>Annisa Nur Safitri</strong></div>
    </header>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Total Transaksi</div>
            <div class="stat-value"><?= count($semuaData); ?> Pesanan</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Kursi Terjual</div>
            <div class="stat-value"><?= $totalTiketTerjual; ?> Kursi</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Pendapatan (Polimorfik)</div>
            <div class="stat-value" style="color: #10b981;">Rp <?= number_format($totalPendapatan, 0, ',', '.'); ?></div>
        </div>
    </div>

    <div class="studio-card">
        <div class="studio-header">
            <div class="studio-title title-regular">● Studio Regular</div>
            <div class="badge"><?= count($kelompokTiket['regular']); ?> Transaksi</div>
        </div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID Tiket</th>
                        <th>Nama Film</th>
                        <th>Jadwal Tayang</th>
                        <th>Jumlah Kursi</th>
                        <th>Fasilitas & Spesifikasi</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($kelompokTiket['regular'])): ?>
                        <tr><td colspan="6" style="text-align:center; color: var(--text-muted);">Tidak ada data pesanan Studio Regular.</td></tr>
                    <?php else: ?>
                        <?php foreach ($kelompokTiket['regular'] as $tiket): ?>
                            <tr>
                                <td><span class="id-badge"><?= $tiket->getIdTiket(); ?></span></td>
                                <td><span class="film-name"><?= $tiket->getNamaFilm(); ?></span></td>
                                <td><?= date('d M Y - H:i', strtotime($tiket->getJadwalTayang())); ?> WIB</td>
                                <td><?= $tiket->getJumlahKursi(); ?> Kursi</td>
                                <td>
                                    <div class="spec-container">
                                        <span class="spec-label">Audio:</span> <?= $tiket->getTipeAudio(); ?> | 
                                        <span class="spec-label">Baris:</span> <?= $tiket->getLokasiBaris(); ?>
                                    </div>
                                </td>
                                <td class="harga-total">Rp <?= number_format($tiket->hitungTotalHarga(), 0, ',', '.'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="studio-card">
        <div class="studio-header">
            <div class="studio-title title-max">● Studio IMAX</div>
            <div class="badge"><?= count($kelompokTiket['max']); ?> Transaksi</div>
        </div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID Tiket</th>
                        <th>Nama Film</th>
                        <th>Jadwal Tayang</th>
                        <th>Jumlah Kursi</th>
                        <th>Fasilitas & Spesifikasi</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($kelompokTiket['max'])): ?>
                        <tr><td colspan="6" style="text-align:center; color: var(--text-muted);">Tidak ada data pesanan Studio IMAX.</td></tr>
                    <?php else: ?>
                        <?php foreach ($kelompokTiket['max'] as $tiket): ?>
                            <tr>
                                <td><span class="id-badge"><?= $tiket->getIdTiket(); ?></span></td>
                                <td><span class="film-name"><?= $tiket->getNamaFilm(); ?></span></td>
                                <td><?= date('d M Y - H:i', strtotime($tiket->getJadwalTayang())); ?> WIB</td>
                                <td><?= $tiket->getJumlahKursi(); ?> Kursi</td>
                                <td>
                                    <div class="spec-container">
                                        <span class="spec-label">Kacamata 3D:</span> <?= $tiket->getKacamata3dId() ?? '2D (N/A)'; ?> | 
                                        <span class="spec-label">Efek:</span> <?= $tiket->getEfekGerakFitur() ?? 'Standar'; ?>
                                    </div>
                                </td>
                                <td class="harga-total">Rp <?= number_format($tiket->hitungTotalHarga(), 0, ',', '.'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="studio-card">
        <div class="studio-header">
            <div class="studio-title title-velvet">● Studio Velvet (Ultra Luxury)</div>
            <div class="badge"><?= count($kelompokTiket['velvet']); ?> Transaksi</div>
        </div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID Tiket</th>
                        <th>Nama Film</th>
                        <th>Jadwal Tayang</th>
                        <th>Jumlah Kursi</th>
                        <th>Fasilitas & Spesifikasi</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($kelompokTiket['velvet'])): ?>
                        <tr><td colspan="6" style="text-align:center; color: var(--text-muted);">Tidak ada data pesanan Studio Velvet.</td></tr>
                    <?php else: ?>
                        <?php foreach ($kelompokTiket['velvet'] as $tiket): ?>
                            <tr>
                                <td><span class="id-badge"><?= $tiket->getIdTiket(); ?></span></td>
                                <td><span class="film-name"><?= $tiket->getNamaFilm(); ?></span></td>
                                <td><?= date('d M Y - H:i', strtotime($tiket->getJadwalTayang())); ?> WIB</td>
                                <td><?= $tiket->getJumlahKursi(); ?> Sofa Bed</td>
                                <td>
                                    <div class="spec-container">
                                        <span class="spec-label">Paket:</span> <?= $tiket->getBantalSelimutPack(); ?> | 
                                        <span class="spec-label">Layanan:</span> <?= $tiket->getLayananButler(); ?>
                                    </div>
                                </td>
                                <td class="harga-total">Rp <?= number_format($tiket->hitungTotalHarga(), 0, ',', '.'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>