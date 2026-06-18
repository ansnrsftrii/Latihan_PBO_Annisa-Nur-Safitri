<?php
// =========================================================================
// PART 1: DEFINISI KELAS ANAK (TiketVelvet)
// =========================================================================

// Memanggil file abstract class induk
require_once 'Tiket.php';

// Kelas TiketVelvet mewarisi seluruh sifat dari kelas Tiket
class TiketVelvet extends Tiket {
    
    // Atribut spesifik (spesial) untuk Studio Luxury Velvet
    private $bantalSelimutPack; // Dipetakan dari kolom 'bantal_selimut_pack' (misal: Pack Premium, Gold Pack)
    private $layananButler;     // Dipetakan dari kolom 'layanan_butler' (misal: Personal Butler, VIP Butler)

    // Konstruktor kelas anak
    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket, $bantalSelimutPack, $layananButler) {
        
        // Mengirimkan atribut global ke konstruktor milik kelas induk (Tiket)
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket);
        
        // Mengisi atribut spesifik milik kelas Velvet
        $this->bantalSelimutPack = $bantalSelimutPack;
        $this->layananButler = $layananButler;
    }

    // --- IMPLEMENTASI ABSTRACT METHODS (Wajib di-override) ---

    /**
     * Polimorfisme Overriding: Menghitung total harga tiket untuk kelas Velvet.
     * Sesuai Aturan Tahap 5: Total Harga = (jumlah_kursi * hargaDasarTiket) * 1.50
     * @return float|int
     */
    public function hitungTotalHarga() {
        // Surcharge kelas premium sebesar 50% dari total harga dasar (dikali 1.50)
        return ($this->jumlah_kursi * $this->hargaDasarTiket) * 1.50;
    }

    /**
     * Menampilkan informasi fasilitas spesifik untuk kelas Velvet.
     */
    public function tampilkanInfoFasilitas() {
        echo "=== FASILITAS TIKET ULTRA LUXURY VELVET ===<br>";
        echo "ID Tiket        : " . $this->id_tiket . "<br>";
        echo "Film            : " . $this->nama_film . "<br>";
        echo "Kursi Dipesan   : " . $this->jumlah_kursi . " Sofa Bed<br>";
        echo "Harga Dasar/Pcs : Rp " . number_format($this->hargaDasarTiket, 0, ',', '.') . "<br>";
        echo "Fasilitas Paket : " . ($this->bantalSelimutPack ?? "Standar Pack") . "<br>";
        echo "Layanan Butler  : " . ($this->layananButler ?? "On-Call Service") . "<br>";
        echo "-------------------------------------------<br>";
        echo "Total Harga (+ Surcharge Premium 50%): Rp " . number_format($this->hitungTotalHarga(), 0, ',', '.') . "<br>";
        echo "===========================================<br>";
    }

    // --- GETTER & SETTER SPESIFIK ---
    public function getBantalSelimutPack() { return $this->bantalSelimutPack; }
    public function setBantalSelimutPack($bantalSelimutPack) { $this->bantalSelimutPack = $bantalSelimutPack; }

    public function getLayananButler() { return $this->layananButler; }
    public function setLayananButler($layananButler) { $this->layananButler = $layananButler; }
}


// =========================================================================
// PART 2: PROSES HITUNG-HITUNGAN & SIMULASI OBJEK
// =========================================================================

// 1. Menentukan Data Input
$id_tiket          = "TKT-VLV-003";
$nama_film         = "Avengers: Secret Wars";
$jadwal_tayang     = "2026-06-20 19:00:00";
$jumlah_kursi      = 2;          // Contoh beli 2 Sofa Bed
$hargaDasarTiket   = 80000;      // Contoh harga dasar Velvet Rp 80.000 per kursi
$bantalSelimutPack = "Gold Pack Premium";
$layananButler     = "VIP Personal Butler";

// 2. Instansiasi Objek TiketVelvet
$pesananVelvet = new TiketVelvet(
    $id_tiket, 
    $nama_film, 
    $jadwal_tayang, 
    $jumlah_kursi, 
    $hargaDasarTiket, 
    $bantalSelimutPack, 
    $layananButler
);

// 3. Eksekusi Program & Tampilkan Output Perhitungan ke Browser
$pesananVelvet->tampilkanInfoFasilitas();
?>