<?php
// Mulai sesi
session_start();

// Cek apakah file diunggah
if (isset($_FILES['restore_file'])) {
    // Tentukan direktori tempat file akan disimpan sementara
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["restore_file"]["name"]);

    // Pindahkan file yang diunggah ke direktori target
    if (move_uploaded_file($_FILES["restore_file"]["tmp_name"], $target_file)) {
        // Tentukan path ke mysqldump
        $mysql_path = 'C:/xampp/mysql/bin/mysql.exe'; // Ubah sesuai dengan path mysqldump Anda
        $db_host = 'localhost'; // Host database
        $db_name = 'db_niagakopsaw'; // Nama database
        $db_user = 'root'; // Username database
        $db_pass = ''; // Password database

        // Jalankan perintah restore menggunakan mysqldump
        $command = "$mysql_path -h $db_host -u $db_user -p$db_pass $db_name < $target_file";

        // Eksekusi perintah dan tangkap output serta kode status
        exec($command, $output, $status);

        // Cek apakah perintah berhasil dijalankan
        if ($status === 0) {
            // Redirect dengan pesan sukses
            header("Location: ../index.php?restore=restore");
        } else {
            // Redirect dengan pesan gagal
            echo "Restore database gagal: " . implode("\n", $output);
        }
    } else {
        echo "Gagal mengunggah file.";
    }
} else {
    echo "Tidak ada file yang diunggah.";
}
?>
