<?php

class KoneksiDB {
    // Atribut konfigurasi server database
    private $host     = "localhost";
    private $username = "root"; 
    private $password = ""; 
    // Nama database sesuai dengan yang dibuat pada MySQL di Tahap 1 & 2
    private $dbname   = "db_latihan_pbo_trpl_1a_annisa_nur_safitri"; 
    private $koneksi;

    // Konstruktor untuk menginisialisasi koneksi secara otomatis
    public function __construct() {
        try {
            // Menyusun Data Source Name (DSN)
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=utf8mb4";
            
            // Mengatur opsi PDO demi keamanan dan penanganan error PBO yang baik
            $opsi = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Mengubah error menjadi Exception
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Hasil query berupa array asosiatif
                PDO::ATTR_EMULATE_PREPARES   => false,                  // Menonaktifkan emulasi untuk mencegah SQL Injection
            ];

            // Membuat instance baru dari objek PDO
            $this->koneksi = new PDO($dsn, $this->username, $this->password, $opsi);
            
        } catch (PDOException $e) {
            // Menghentikan skrip dan menampilkan pesan error jika koneksi gagal
            die("Koneksi ke database gagal dilakukan: " . $e->getMessage());
        }
    }

    // Method Getter untuk mengambil instans koneksi dari luar kelas
    public function getKoneksi() {
        return $this->koneksi;
    }
}