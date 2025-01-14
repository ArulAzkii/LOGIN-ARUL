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

    // Hash password sebelum menyimpannya ke database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk menyimpan data pengguna ke database
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";
    if ($conn->query($sql) === TRUE) {
        echo "Registrasi berhasil!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
