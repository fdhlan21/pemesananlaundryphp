<?php
// Mengambil konfigurasi koneksi ke database dari file database.php di folder config CodeIgniter
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

// Query SQL untuk mengambil data kontak dari database
$query = "SELECT * FROM kontak"; // Sesuaikan dengan nama tabel kontak Anda
$stmt = $pdo->query($query);

// Fetch data kontak
$contactData = $stmt->fetch(PDO::FETCH_ASSOC);

// Kontak dari database
$id = $contactData['id'];
$nama = $contactData['nama'];
$nomorTelepon = $contactData['nohp'];
$alamat = $contactData['alamat'];

// Sekarang Anda dapat menggunakan variabel $nama, $nomorTelepon, dan $alamat dalam halaman HTML Anda

// ... (kode HTML lainnya)

?>


<div style="padding:10px; " class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('dashboard'); ?>" style="color: black;">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Kontak</li>
        </ol>
    </nav>
    <h2 style="font-family: 'Poppins', sans-serif; font-weight: 500; text-align: center;">Kontak Kami</h2>

    <div class="contact-card">
        <p>Silakan hubungi kami di alamat dan nomor telepon berikut:</p>


        <ol class="breadcrumb">
            <p style="font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 20px;">Nama: <?= $nama ?></p>
        </ol>
        <ol class="breadcrumb">
            <p style="font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 20px;">Nomor Telepon: <?= $nomorTelepon ?></p>
        </ol>
        <ol class="breadcrumb">
            <p style="font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 20px;">Alamat: <?= $alamat ?></p>
        </ol>

        <?php
        // Anda perlu menyesuaikan ini dengan cara Anda mengelola autentikasi dan otorisasi
        $roleId = isset($_SESSION['role_id']) ? $_SESSION['role_id'] : 0;

        // Role_id 2 (atau yang sesuai dengan aturan Anda) dapat melihat tombol Edit
        if ($roleId == 1) {
            echo '<a class="btn btn-primary edit-button" href="kontak/edit?id=' . $id . '">Edit Kontak</a>';
        }

        ?>




    </div>

</div>