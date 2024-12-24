<?php
// Mengecek apakah form telah dikirim dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = substr(preg_replace('/[^0-9]/', '', $_POST['phone']), 0, 13);

    // Membuat koneksi ke database
    $conn = new mysqli("localhost", "root", "", "crud_db");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error); // Mengecek apakah koneksi gagal
    }

    // Menyusun query untuk memasukkan data ke tabel users
    $sql = "INSERT INTO users (name, email, phone) VALUES ('$name', '$email', '$phone')";

    // Mengeksekusi query dan mengecek apakah berhasil
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Redirect ke halaman utama jika berhasil
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error; // Menampilkan pesan kesalahan jika gagal
    }

    // Menutup koneksi
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengguna</title>
    <style>
        /* Mengatur gaya umum untuk body */
        body {
            font-family: 'Georgia', serif;
            background-color: #ffeef2; /* Warna latar pink lembut */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        
        /* Mengatur gaya container form */
        form {
            background-color: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 320px;
            border: 2px solid #f7a9c4; /* Border pink lembut */
        }

        /* Mengatur label input dan spasi antar elemen */
        form input {
            width: 100%;
            padding: 12px;
            margin: 12px 0;
            border: 1px solid #f4cedf;
            border-radius: 6px;
            box-sizing: border-box;
        }

        /* Mengatur gaya tombol submit */
        form button {
            width: 100%;
            padding: 12px;
            background-color: #f7a9c4; /* Warna pink lembut */
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        /* Mengatur gaya tombol submit saat di-hover */
        form button:hover {
            background-color: #f38db1; /* Warna pink sedikit lebih gelap saat di-hover */
        }

        /* Mengatur gaya teks label */
        form label {
            font-weight: bold;
            color: #d173a5; /* Warna label ungu lembut */
        }
    </style>
</head>
<body>

    <form method="POST" action="">
        <label for="name">Nama:</label>
        <input type="text" name="name" required>
        
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        
        <label for="phone">Telepon:</label>
        <input type="text" name="phone" required>
        
        <button type="submit">Submit</button>
    </form>

</body>
</html>
