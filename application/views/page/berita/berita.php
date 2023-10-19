<?php
// Memuat konfigurasi database dari database.php di CodeIgniter
include(APPPATH . 'config/database.php');

$host = $db['default']['hostname'];
$dbname = $db['default']['database'];
$username = $db['default']['username'];
$password = $db['default']['password'];

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Koneksi ke database gagal: " . $e->getMessage());
}

// Fungsi untuk menghapus berita berdasarkan ID
function hapusBerita($pdo, $idBerita)
{
    $query = "DELETE FROM berita WHERE id = ?";
    $stmt = $pdo->prepare($query);
    return $stmt->execute([$idBerita]);
}

// Menghapus berita jika ada permintaan penghapusan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["hapus_berita"])) {
    $idBerita = $_POST["hapus_berita"];
    if (hapusBerita($pdo, $idBerita)) {
        echo '<div class="alert alert-success">Berita berhasil dihapus ✅</div>';
        echo "<meta http-equiv=refresh content=1;URL='/kingfc/berita'>";
    } else {
        echo '<div class="alert alert-danger">Gagal menghapus berita ❌</div>';
    }
}

// Query SQL untuk mengambil data berita
$query = "SELECT id, judul, gambar, deskripsi FROM berita";
$stmt = $pdo->query($query);

// Menutup koneksi ke database
$pdo = null;
?>

    <div style="padding: 10px;" class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('dashboard'); ?>" style="color: black;">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Berita</li>
            </ol>
        </nav>
        <h2 style="font-family: 'Poppins', sans-serif; font-weight: 500; text-align: center;">Berita Seputar Bola</h2>
        <?php if ($_SESSION['role_id'] == 1) : ?>
            <a class="btn btn-primary" href="<?= base_url('berita/add'); ?>" style="margin-bottom: 10px;">Tambah Berita</a>
                 <?php endif; ?>

        <div style="margin-left: -10px;" class="row">
            <?php
            // Fetch data berita dan tampilkan dalam bentuk card
            while ($row = $stmt->fetch()) {
                echo '<div class="col-md-4">';
                echo '<div class="card" style="margin-bottom: 20px;">';
                echo '<img src="' . base_url("path/assets/berita/" . $row['gambar']) . '" class="card-img-top" alt="Gambar Berita">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row['judul'] . '</h5>';
                echo '<p class="card-text">' . $row['deskripsi'] . '</p>';
                if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
                    // Jika role_id adalah 1 (admin), tampilkan tombol "Hapus Berita"
                    echo '<form method="POST" action="">';
                    echo '<input type="hidden" name="hapus_berita" value="' . $row['id'] . '">';
                    echo '<button type="submit" class="btn btn-danger">Hapus</button>';
                    echo '</form>';
                }
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
 