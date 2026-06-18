<?php
// =========================================================================
// PART 1: DEFINISI KELAS ANAK (TiketRegular)
// =========================================================================

// Memanggil file abstract class induk
require_once 'Tiket.php';

// Kelas TiketRegular mewarisi seluruh sifat dari kelas Tiket
class TiketRegular extends Tiket {
    
    // Atribut spesifik (spesial) untuk Studio Regular
    private $tipeAudio;  // Dipetakan dari kolom 'tipe_studio' (misal: Dolby Atmos, DTS)
    private $lokasiBaris; // Dipetakan dari kolom 'lokasi_baris' (misal: Row A, Row B)

    // Konstruktor kelas anak
    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket, $tipeAudio, $lokasiBaris) {
        
        // Mengirimkan atribut global ke konstruktor milik kelas induk (Tiket)
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket);
        
        // Mengisi atribut spesifik milik kelas Regular
        $this->tipeAudio = $tipeAudio;
        $this->lokasiBaris = $lokasiBaris;
    }

    // --- IMPLEMENTASI ABSTRACT METHODS (Wajib diisi karena kelas anak konkrit) ---

    /**
     * Polimorfisme Overriding: Menghitung total harga tiket kelas Regular.
     * Sesuai Aturan Tahap 5: Total Harga = jumlah_kursi * hargaDasarTiket
     * @return float|int
     */
    public function hitungTotalHarga() {
        return $this->jumlah_kursi * $this->hargaDasarTiket;
    }

    /**
     * Menampilkan informasi fasilitas spesifik untuk kelas Regular.
     */
    public function tampilkanInfoFasilitas() {
        echo "=== FASILITAS TIKET REGULAR ===<br>";
        echo "ID Tiket        : " . $this->id_tiket . "<br>";
        echo "Film            : " . $this->nama_film . "<br>";
        echo "Kursi Dipesan   : " . $this->jumlah_kursi . " Kursi<br>";
        echo "Harga Dasar/Pcs : Rp " . number_format($this->hargaDasarTiket, 0, ',', '.') . "<br>";
        echo "Tipe Audio      : " . $this->tipeAudio . "<br>";
        echo "Lokasi Baris    : " . $this->lokasiBaris . "<br>";
        echo "---------------------------------<br>";
        echo "Total Harga     : Rp " . number_format($this->hitungTotalHarga(), 0, ',', '.') . "<br>";
        echo "=================================<br>";
    }

    // --- GETTER & SETTER SPESIFIK ---
    public function getTipeAudio() { return $this->tipeAudio; }
    public function setTipeAudio($tipeAudio) { $this->tipeAudio = $tipeAudio; }

    public function getLokasiBaris() { return $this->lokasiBaris; }
    public function setLokasiBaris($lokasiBaris) { $this->lokasiBaris = $lokasiBaris; }
}


// =========================================================================
// PART 2: PROSES HITUNG-HITUNGAN & SIMULASI OBJEK
// =========================================================================

// 1. Menentukan Data Input
$id_tiket          = "TKT-REG-002";
$nama_film         = "Avengers: Secret Wars";
$jadwal_tayang     = "2026-06-20 19:00:00";
$jumlah_kursi      = 3;          // Contoh beli 3 kursi
$hargaDasarTiket   = 50000;      // Contoh harga dasar Rp 50.000 per kursi
$tipeAudio         = "Dolby Atmos";
$lokasiBaris       = "Row H (Tengah)";

// 2. Instansiasi Objek TiketRegular
$pesananRegular = new TiketRegular(
    $id_tiket, 
    $nama_film, 
    $jadwal_tayang, 
    $jumlah_kursi, 
    $hargaDasarTiket, 
    $tipeAudio, 
    $lokasiBaris
);

// 3. Eksekusi Program & Tampilkan Output Perhitungan ke Layar/Browser
$pesananRegular->tampilkanInfoFasilitas();
?>