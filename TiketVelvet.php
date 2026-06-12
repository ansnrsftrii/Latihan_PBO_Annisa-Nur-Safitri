<?php
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
     * Menghitung total harga tiket untuk kelas Velvet.
     * Terdapat tambahan biaya pelayanan premium Velvet Suite sebesar Rp 50.000 flat per transaksi.
     * @return float|int
     */
    public function hitungTotalHarga() {
        $biayaSurchargeLuxury = 50000;
        return ($this->hargaDasarTiket * $this->jumlah_kursi) + $biayaSurchargeLuxury;
    }

    /**
     * Menampilkan informasi fasilitas spesifik untuk kelas Velvet.
     */
    public function tampilkanInfoFasilitas() {
        echo "=== FASILITAS TIKET ULTRA LUXURY VELVET ===<br>";
        echo "ID Tiket        : " . $this->id_tiket . "<br>";
        echo "Film            : " . $this->nama_film . "<br>";
        echo "Kursi Dipesan   : " . $this->jumlah_kursi . " Sofa Bed<br>";
        echo "Fasilitas Kenyamanan: " . ($this->bantalSelimutPack ?? "Standar Pack") . "<br>";
        echo "Layanan Eksklusif  : " . ($this->layananButler ?? "On-Call Service") . "<br>";
        echo "Total Harga (+ include Luxury Service Charge): Rp " . number_format($this->hitungTotalHarga(), 0, ',', '.') . "<br>";
        echo "-------------------------------------------<br>";
    }

    // --- GETTER & SETTER SPESIFIK ---
    public function getBantalSelimutPack() { return $this->bantalSelimutPack; }
    public function setBantalSelimutPack($bantalSelimutPack) { $this->bantalSelimutPack = $bantalSelimutPack; }

    public function getLayananButler() { return $this->layananButler; }
    public function setLayananButler($layananButler) { $this->layananButler = $layananButler; }
}