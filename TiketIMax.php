<?php
// =========================================================================
// PART 1: DEFINISI KELAS ANAK (TiketIMax)
// =========================================================================

// Memanggil file abstract class induk
require_once 'Tiket.php';

class TiketIMax extends Tiket {
    
    // Atribut spesifik untuk Studio IMAX
    private $kacamata3dId;   
    private $efekGerakFitur; 

    // Konstruktor kelas anak
    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket, $kacamata3dId, $efekGerakFitur) {
        // Mengirimkan atribut global ke kelas induk (Tiket)
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket);
        
        // Mengisi atribut spesifik
        $this->kacamata3dId = $kacamata3dId;
        $this->efekGerakFitur = $efekGerakFitur;
    }

    /**
     * Polimorfisme Overriding: Menghitung total harga tiket kelas IMAX.
     * Sesuai Aturan Tahap 5: (jumlah_kursi * hargaDasarTiket) + 35000
     */
    public function hitungTotalHarga() {
        $biayaTambahanIMax = 35000; // Biaya teknologi flat Rp 35.000
        return ($this->jumlah_kursi * $this->hargaDasarTiket) + $biayaTambahanIMax;
    }

    /**
     * Menampilkan informasi fasilitas spesifik dan rincian harga
     */
    public function tampilkanInfoFasilitas() {
        echo "=== FASILITAS TIKET IMAX / MAX ===<br>";
        echo "ID Tiket        : " . $this->id_tiket . "<br>";
        echo "Film            : " . $this->nama_film . "<br>";
        echo "Kursi Dipesan   : " . $this->jumlah_kursi . " Kursi<br>";
        echo "Harga Dasar/Pcs : Rp " . number_format($this->hargaDasarTiket, 0, ',', '.') . "<br>";
        echo "ID Kacamata 3D  : " . ($this->kacamata3dId ?? "Tidak Menggunakan (2D)") . "<br>";
        echo "Fitur Efek Gerak: " . ($this->efekGerakFitur ?? "Standar (Tanpa Efek)") . "<br>";
        echo "-----------------------------------<br>";
        echo "Total Harga (+ Surcharge IMAX): Rp " . number_format($this->hitungTotalHarga(), 0, ',', '.') . "<br>";
        echo "===================================<br>";
    }

    // --- GETTER & SETTER SPESIFIK ---
    public function getKacamata3dId() { return $this->kacamata3dId; }
    public function setKacamata3dId($kacamata3dId) { $this->kacamata3dId = $kacamata3dId; }

    public function getEfekGerakFitur() { return $this->efekGerakFitur; }
    public function setEfekGerakFitur($efekGerakFitur) { $this->efekGerakFitur = $efekGerakFitur; }
}


// =========================================================================
// PART 2: PROSES HITUNG-HITUNGAN & SIMULASI OBJEK
// =========================================================================

// 1. Menentukan Data Input
$id_tiket          = "TKT-IMAX-001";
$nama_film         = "Avengers: Secret Wars";
$jadwal_tayang     = "2026-06-20 19:00:00";
$jumlah_kursi      = 3;          // Contoh beli 3 kursi
$hargaDasarTiket   = 50000;      // Contoh harga dasar Rp 50.000
$kacamata3dId      = "GLASS-99"; 
$efekGerakFitur    = "Motion Vibration";

// 2. Instansiasi Objek TiketIMax
$pesananImax = new TiketIMax(
    $id_tiket, 
    $nama_film, 
    $jadwal_tayang, 
    $jumlah_kursi, 
    $hargaDasarTiket, 
    $kacamata3dId, 
    $efekGerakFitur
);

// 3. Eksekusi Program & Tampilkan Output Perhitungan
$pesananImax->tampilkanInfoFasilitas();
?>