<?php
$conn = new mysqli("localhost", "root", "", "crud_db");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "UPDATE users SET name='$name', email='$email', phone='$phone' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Pengguna</title>
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
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <label for="name">Nama:</label>
    <input type="text" name="name" value="<?php echo $name; ?>" required>
    
    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo $email; ?>" required>
    
    <label for="phone">Telepon:</label>
    <input type="text" name="phone" value="<?php echo $phone; ?>" required>
    
    <button type="submit">Update</button>
</form>

</body>
</html>
