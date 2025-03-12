<?php
include 'config.php';
$result = mysqli_query($conn, "SELECT * FROM daftartugas ORDER BY deadline ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduTracker - Daftar Tugas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">EduTracker - Daftar Tugas</h2>
        <p class="text-center">Website untuk membantu mahasiswa mengelola jadwal kuliah lebih terorganisir.</p>
        
        <h4>Form Tambah Tugas</h4>
        <form action="add.php" method="POST">
            <div class="mb-2">
                <input type="text" class="form-control" name="mata_kuliah" placeholder="Mata Kuliah" required>
            </div>
            <div class="mb-2">
                <input type="text" class="form-control" name="deskripsi" placeholder="Deskripsi Tugas" required>
            </div>
            <div class="mb-2">
                <input type="date" class="form-control" name="deadline" required>
            </div>
            <div class="mb-2">
                <select class="form-control" name="jenis" required>
                    <option value="">Pilih Jenis Tugas</option>
                    <option value="Tugas Harian">Tugas Harian</option>
                    <option value="Proyek">Proyek</option>
                    <option value="Ujian">Ujian</option>
                    <option value="Quis">Quis</option>
                </select>
            </div>
            <div class="mb-2">
                <select class="form-control" name="status" required>
                    <option value="Belum Selesai">Belum Selesai</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Tambah Tugas</button>
        </form>
        
        <h4 class="mt-4">Tabel Daftar Tugas</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Mata Kuliah</th>
                    <th>Deskripsi</th>
                    <th>Deadline</th>
                    <th>Jenis</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['mata_kuliah']); ?></td>
                    <td><?= htmlspecialchars($row['deskripsi']); ?></td>
                    <td><?= htmlspecialchars($row['deadline']); ?></td>
                    <td><?= htmlspecialchars($row['jenis']); ?></td>
                    <td><?= htmlspecialchars($row['status']); ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id_tugas']; ?>" class="btn btn-success">Edit</a>
                        <a href="delete.php?id=<?= $row['id_tugas']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?');">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
