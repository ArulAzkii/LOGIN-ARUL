<?php
// Koneksi ke database
$servername = "localhost";
$usernameDB = "root"; // Ganti sesuai username MySQL Anda
$passwordDB = ""; // Ganti sesuai password MySQL Anda
$dbname = "nama_database"; // Ganti dengan nama database Anda

$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mendapatkan data pengguna dari database
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Ambil data pengguna
        $row = $result->fetch_assoc();
        $hashedPasswordFromDB = $row['password'];

        // Verifikasi password
        if (password_verify($password, $hashedPasswordFromDB)) {
            echo "Login berhasil!";
        } else {
            echo "Username atau password salah!";
        }
    } else {
        echo "Username tidak ditemukan!";
    }
}

$conn->close();
?>
