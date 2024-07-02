<?php
session_start();

if (isset($_GET['backup_restore_sql']) && $_GET['backup_restore_sql'] === 'backup') {
    require '../../config.php'; // Memasukkan file konfigurasi database

    // Nama file backup dengan timestamp
    $backup_file = 'backup_' . date('Y-m-d_H.i.s') . '.sql';

    // Path ke direktori backup
    $backup_dir = 'C:/xampp/htdocs/kasir_kopsaw24/admin/module/backup_restore/file_backup_sql/';

    // Perintah mysqldump
    $mysqldump_path = 'C:/xampp/mysql/bin/mysqldump.exe'; // Ganti dengan path aktual
    $command = "$mysqldump_path -u$user $dbname > $backup_dir$backup_file";

    // Eksekusi perintah
    $output = [];
    $return_var = 0;
    exec($command . ' 2>&1', $output, $return_var);

    if ($return_var !== 0) {
        // Jika terjadi kesalahan, tampilkan pesan kesalahan dan output detail
        echo "Terjadi kesalahan saat melakukan backup. Kode kesalahan: $return_var.<br>";
        echo "Output:<br>";
        foreach ($output as $line) {
            echo htmlspecialchars($line) . "<br>";
        }
    } else {
        // Beri feedback kepada pengguna
        echo '<script>window.location="../../index.php?page=backup_restore&backup=backup"</script>';
    }

    // Tampilkan perintah yang dijalankan untuk debugging
    echo "<br>Perintah yang dijalankan: " . htmlspecialchars($command);
} else {
    echo "Operasi backup tidak valid.";
}
?>
