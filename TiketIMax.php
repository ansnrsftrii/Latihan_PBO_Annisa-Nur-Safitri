<?php
// Memanggil file abstract class induk
require_once 'Tiket.php';

// Kelas TiketIMax mewarisi seluruh sifat dari kelas Tiket
class TiketIMax extends Tiket {
    
    // Atribut spesifik (spesial) untuk Studio IMAX / MAX
    private $kacamata3dId;   // Dipetakan dari kolom 'kacamata_3d_id' (bisa bernilai null jika 2D)
    private $efekGerakFitur; // Dipetakan dari kolom 'efek_gerak_fitur' (misal: Motion Vibration, Wind)

    // Konstruktor kelas anak
    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket, $kacamata3dId, $efekGerakFitur) {
        
        // Mengirimkan atribut global ke konstruktor milik kelas induk (Tiket)
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket);
        
        // Mengisi atribut spesifik milik kelas IMAX
        $this->kacamata3dId = $kacamata3dId;
        $this->efekGerakFitur = $efekGerakFitur;
    }

    // --- IMPLEMENTASI ABSTRACT METHODS (Wajib di-override) ---

    /**
     * Menghitung total harga tiket untuk kelas IMAX.
     * Terdapat biaya tambahan fasilitas teknologi IMAX sebesar Rp 25.000 per kursi.
     * @return float|int
     */
    public function hitungTotalHarga() {
        $biayaTambahanIMax = 25000;
        return ($this->hargaDasarTiket + $biayaTambahanIMax) * $this->jumlah_kursi;
    }

    /**
     * Menampilkan informasi fasilitas spesifik untuk kelas IMAX.
     */
    public function tampilkanInfoFasilitas() {
        echo "=== FASILITAS TIKET IMAX / MAX ===<br>";
        echo "ID Tiket        : " . $this->id_tiket . "<br>";
        echo "Film            : " . $this->nama_film . "<br>";
        echo "Kursi Dipesan   : " . $this->jumlah_kursi . " Kursi<br>";
        echo "ID Kacamata 3D  : " . ($this->kacamata3dId ?? "Tidak Menggunakan (2D)") . "<br>";
        echo "Fitur Efek Gerak: " . ($this->efekGerakFitur ?? "Standar (Tanpa Efek)") . "<br>";
        echo "Total Harga (+ include Charge IMAX): Rp " . number_format($this->hitungTotalHarga(), 0, ',', '.') . "<br>";
        echo "-----------------------------------<br>";
    }

    // --- GETTER & SETTER SPESIFIK ---
    public function getKacamata3dId() { return $this->kacamata3dId; }
    public function setKacamata3dId($kacamata3dId) { $this->kacamata3dId = $kacamata3dId; }

    public function getEfekGerakFitur() { return $this->efekGerakFitur; }
    public function setEfekGerakFitur($efekGerakFitur) { $this->efekGerakFitur = $efekGerakFitur; }
}