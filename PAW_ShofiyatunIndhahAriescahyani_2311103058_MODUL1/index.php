<?php
include 'config.php';

// Inisialisasi variabel
$nama = $email = $nomor_telepon = $pilih_mobil = $alamat = "";
$namaErr = $emailErr = $nomor_teleponErr = $alamatErr = "";
$successMessage = "";
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi nama
    $nama = trim($_POST["nama"]);
    if (empty($nama)) {
        $namaErr = "Nama wajib diisi";
    }

    // Validasi email
    $email = trim($_POST["email"]);
    if (empty($email)) {
        $emailErr = "Email wajib diisi";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Format email tidak valid";
    }

    // Validasi nomor_telepon
    $nomor_telepon = trim($_POST["nomor_telepon"]);
    if (empty($nomor_telepon)) {
        $nomor_teleponErr = "Nomor Telepon wajib diisi";
    } elseif (!ctype_digit($nomor_telepon)) {
        $nomor_teleponErr = "Nomor Telepon harus berupa angka";
    }

    // Validasi alamat
    $alamat = trim($_POST["alamat"]);
    if (empty($alamat)) {
        $alamatErr = "Alamat wajib diisi";
    }

    // pilih_mobil
    $pilih_mobil = $_POST["pilih_mobil"];

    // Simpan ke database
    if (empty($namaErr) && empty($emailErr) && empty($nomor_teleponErr) && empty($alamatErr)) {
        $sql = "INSERT INTO pembelian (nama, email, nomor_telepon, pilih_mobil, alamat) 
                VALUES ('$nama', '$email', '$nomor_telepon', '$pilih_mobil', '$alamat')";

    if ($conn->query($sql) === TRUE) {
        $successMessage = "<div class='alert success'>✅ Data berhasil disimpan!</div>";

          // Kosongkan input setelah sukses
        $nama = $email = $nomor_telepon = $pilih_mobil = $alamat = "";
        } else {
         $errorMessage = "<div class='alert error'>❌ Terjadi kesalahan: " . $conn->error . "</div>";
        }
    }
}

// Mengambil semua data pembelian dari database
$result = $conn->query("SELECT * FROM pembelian ORDER BY id_beli DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pembelian Mobil</title>
    <title>By Shofiyatun Indhah Ariescahyani 2311103058 S1SI07B</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Form Pembelian Mobil</h2>
        <h3><span>By Shofiyatun Indhah Ariescahyani 2311103058 S1SI07B</h3>

        <!-- Pesan Sukses/Error -->
        <?php if ($successMessage) echo "<p class='success'>$successMessage</p>"; ?>
        <?php if ($errorMessage) echo "<p class='error'>$errorMessage</p>"; ?>

        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>">
                <span class="error"><?php echo $namaErr ? "* $namaErr" : ""; ?></span>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo $email; ?>">
                <span class="error"><?php echo $emailErr ? "* $emailErr" : ""; ?></span>
            </div>

            <div class="form-group">
                <label for="nomor_telepon">Nomor Telepon:</label>
                <input type="text" id="nomor_telepon" name="nomor_telepon" value="<?php echo $nomor_telepon; ?>">
                <span class="error"><?php echo $nomor_teleponErr ? "* $nomor_teleponErr" : ""; ?></span>
            </div>

            <div class="form-group">
                <label for="pilih_mobil">Pilih Mobil:</label>
                <select id="pilih_mobil" name="pilih_mobil">
                    <option value="Sedan" <?php echo ($pilih_mobil == "Sedan") ? "selected" : ""; ?>>Sedan</option>
                    <option value="SUV" <?php echo ($pilih_mobil == "SUV") ? "selected" : ""; ?>>SUV</option>
                    <option value="Hatchback" <?php echo ($pilih_mobil == "Hatchback") ? "selected" : ""; ?>>Hatchback</option>
                </select>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat Pengiriman:</label>
                <textarea id="alamat" name="alamat"><?php echo $alamat; ?></textarea>
                <span class="error"><?php echo $alamatErr ? "* $alamatErr" : ""; ?></span>
            </div>

            <div class="button-container">
                <button type="submit">Beli Mobil</button>
            </div>
        </form>
    </div>

    <div class="container">
        <h2>Data Pembelian:</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>
                        <th>Mobil</th>
                        <th>Alamat Pengiriman</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['nomor_telepon']); ?></td>
                        <td><?php echo htmlspecialchars($row['pilih_mobil']); ?></td>
                        <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Untuk hapus pesan 
        setTimeout(function() {
            let alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500);
            });
        }, 3000);
    </script>

</body>
</html>
