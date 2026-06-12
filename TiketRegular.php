<?php
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
     * Menghitung total harga tiket untuk kelas Regular.
     * Pada kelas regular, biasanya tidak ada biaya tambahan studio.
     * @return float|int
     */
    public function hitungTotalHarga() {
        return $this->hargaDasarTiket * $this->jumlah_kursi;
    }

    /**
     * Menampilkan informasi fasilitas spesifik untuk kelas Regular.
     */
    public function tampilkanInfoFasilitas() {
        echo "=== FASILITAS TIKET REGULAR ===<br>";
        echo "ID Tiket      : " . $this->id_tiket . "<br>";
        echo "Film          : " . $this->nama_film . "<br>";
        echo "Kursi Dipesan : " . $this->jumlah_kursi . " Kursi<br>";
        echo "Tipe Audio    : " . $this->tipeAudio . "<br>";
        echo "Lokasi Baris  : " . $this->lokasiBaris . "<br>";
        echo "Total Harga   : Rp " . number_format($this->hitungTotalHarga(), 0, ',', '.') . "<br>";
        echo "---------------------------------<br>";
    }

    // --- GETTER & SETTER SPESIFIK ---
    public function getTipeAudio() { return $this->tipeAudio; }
    public function setTipeAudio($tipeAudio) { $this->tipeAudio = $tipeAudio; }

    public function getLokasiBaris() { return $this->lokasiBaris; }
    public function setLokasiBaris($lokasiBaris) { $this->lokasiBaris = $lokasiBaris; }
}