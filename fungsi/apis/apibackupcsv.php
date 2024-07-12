<?php
session_start();

// Memasukkan file konfigurasi database
require '../../config.php';

// Query untuk mengambil daftar semua tabel dalam database
$query_tables = "SHOW TABLES";
$stmt_tables = $config->query($query_tables);

if (!$stmt_tables) {
    // Jika gagal mengambil daftar tabel, tampilkan pesan kesalahan
    echo "Gagal memperoleh daftar tabel: " . $config->errorInfo()[2];
    exit;
}

// Menyimpan daftar tabel dalam array
$tables = $stmt_tables->fetchAll(PDO::FETCH_COLUMN);

// Cek apakah ada tabel yang ditemukan
if (empty($tables)) {
    echo "Tidak ada tabel yang ditemukan dalam database.";
    exit;
}

// Direktori tempat menyimpan file backup
$backup_directory = 'C:/xampp/htdocs/kasir_kopsaw24/admin/module/backup_restore/file_backup_csv/';

// Jika direktori tidak ada, buat direktori 
if (!is_dir($backup_directory)) {
    mkdir($backup_directory, 0777, true);
}

// Loop untuk backup setiap tabel ke file CSV
foreach ($tables as $table) {
    // Nama file backup untuk tabel ini
    $backup_file = $backup_directory . 'backup-' . $table . '-' . date('Y-m-d_H.i.s') . '.csv';

    // Query untuk ekspor data tabel ke CSV
    $query_export = "SELECT * INTO OUTFILE '$backup_file'
                     FIELDS TERMINATED BY ','
                     ENCLOSED BY '\"'
                     LINES TERMINATED BY '\n'
                     FROM $table";

    // Eksekusi query
    $stmt_export = $config->query($query_export);

    if (!$stmt_export) {
        // Jika terjadi kesalahan, tampilkan pesan kesalahan
        echo "Terjadi kesalahan saat backup tabel $table. Error: " . $config->errorInfo()[2] . "<br>";
    } else {
        // Beri feedback bahwa backup berhasil
        echo '<script>window.location="../../index.php?page=backup_restore&backup=backup"</script>';
    }

    // Tampilkan query yang dijalankan untuk debugging
    echo "Query yang dijalankan: " . htmlspecialchars($query_export) . "<br>";
}
?>
