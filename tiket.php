<?php

abstract class Tiket {
    // Properti terenkapsulasi (protected) sesuai dengan kolom database
    protected $id_tiket;
    protected $nama_film;
    protected $jadwal_tayang;
    protected $jumlah_kursi;
    protected $hargaDasarTiket;

    // Konstruktor untuk memetakan data langsung dari baris tabel database
    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket) {
        $this->id_tiket = $id_tiket;
        $this->nama_film = $nama_film;
        $this->jadwal_tayang = $jadwal_tayang;
        $this->jumlah_kursi = $jumlah_kursi;
        $this->hargaDasarTiket = $hargaDasarTiket;
    }

    // --- ABSTRACT METHODS (Mode abstrak wajib tanpa isi/body) ---
    
    // Wajib diimplementasikan kelas anak untuk menghitung total harga + biaya tambahan studio
    abstract public function hitungTotalHarga();

    // Wajib diimplementasikan kelas anak untuk menampilkan fasilitas spesifik
    abstract public function tampilkanInfoFasilitas();

    // --- GETTER & SETTER (Melindungi akses properti dari luar ekosistem inheritance) ---
    public function getIdTiket() { return $this->id_tiket; }
    public function getNamaFilm() { return $this->nama_film; }
    public function getJadwalTayang() { return $this->jadwal_tayang; }
    public function getJumlahKursi() { return $this->jumlah_kursi; }
    public function getHargaDasarTiket() { return $this->hargaDasarTiket; }
}