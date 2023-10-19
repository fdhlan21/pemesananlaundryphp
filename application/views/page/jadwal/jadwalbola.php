<?php
// Mengambil konfigurasi koneksi ke database dari file database.php di folder config CodeIgniter
include(APPPATH . 'config/database.php');


$host = $db['default']['hostname'];
$dbname   = $db['default']['database'];
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

// Query SQL untuk mengambil data dari tabel jadwalmainbola
$queryJadwal = "SELECT * FROM jadwalmainbola";
$stmtJadwal = $pdo->query($queryJadwal);

// Query SQL untuk mengambil data dari tabel
$query = "SELECT * FROM app_data";
$stmt = $pdo->query($query);
// Fetch data baris per baris
while ($row = $stmt->fetch()) {
    // Ambil nilai kolom yang diinginkan
    $color = $row['color3'];
}
// Menutup koneksi ke database
$pdo = null;
?>
<div style="padding:10px;" class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('dashboard'); ?>" style="color: black;">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Jadwal</li>
        </ol>
    </nav>
    <div>
        <h2 style="font-family: 'Poppins', sans-serif; font-weight: 500; text-align: center;">Jadwal Main Bola</h2>
    </div>

    <div style="padding:10px; margin-top: 2%">
        <div>
            <?php
            // Check apakah pengguna adalah admin (role_id == 1)
            // Anda perlu menyesuaikan ini dengan cara Anda mengelola autentikasi dan otorisasi
            $isAdmin = false; // Misalnya, setel awalnya ke false
            if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
                $isAdmin = true; // Pengguna adalah admin
            }

            // Kemudian, gunakan variabel $isAdmin untuk menentukan apakah tombol Edit Jadwal harus ditampilkan
            if ($isAdmin) {
                echo '<div>';
                echo '<a href="' . base_url('jadwal/edit') . '" class="btn btn-primary">Tambah Jadwal</a>';
                echo '</div>';
            }
            ?>
        </div>
        <table style="margin-top:1%;" class="table table-bordered table-striped table-hover tabza dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
            <thead>
                <tr class="" style="color:white; background-color: <?= $color ?>;" role="row">
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Username: activate to sort column ascending">Lokasi Lapangan</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Hari dan Tanggal</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Password: activate to sort column ascending">Waktu</th>
                    <?php if ($_SESSION['role_id'] == 1) : ?>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Password: activate to sort column ascending">Action</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch data baris per baris
                while ($row = $stmtJadwal->fetch()) {
                    function translateDayToIndonesian($day)
                    {
                        $englishDays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                        $indonesianDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

                        return str_replace($englishDays, $indonesianDays, $day);
                    }

                    $tanggal = date("l - j - Y", strtotime($row['haritanggal']));
                    $tanggal = translateDayToIndonesian($tanggal);

                    $waktu = date("g:i A", strtotime($row['waktu']));

                    // Tampilkan kolom "Lokasi Lapangan", "Hari dan Tanggal", dan "Waktu"
                    echo '<tr role="row" class="odd">';
                    echo '<td>' . $row['lokasi'] . '</td>';
                    echo '<td>' . $tanggal . '</td>';
                    echo '<td>' . $waktu . '</td>';

                    // Tampilkan tombol hapus hanya jika pengguna adalah admin (role_id == 1)
                    if ($_SESSION['role_id'] == 1) {
                        echo '<td>';
                        echo '<a class="btn btn-outline-danger"   onclick="confirmDelete(' . $row['id'] . ');"><i class="fas fa-trash"></i> Hapus</a>';
                        echo '</td>';
                    } 
                    echo '</tr>';
                }
                ?>
            </tbody>

        </table>
        <?php
        // Mengambil konfigurasi koneksi ke database dari file database.php di folder config CodeIgniter
        include(APPPATH . 'config/database.php');

        $host = $db['default']['hostname'];
        $dbname   = $db['default']['database'];
        $username = $db['default']['username'];
        $password = $db['default']['password'];

        $koneksi = mysqli_connect($host, $username, $password, $dbname);

        if (mysqli_connect_errno()) {
            die("Koneksi ke database gagal: " . mysqli_connect_error());
        }

        if (isset($_GET['hapus']) && $memberadmin['role_id'] == 1) {
            mysqli_query($koneksi, "DELETE FROM jadwalmainbola WHERE id='$_GET[hapus]'");
            echo "<p style='color: black; font-size:15px;'>Data Terhapus</p>";
            echo "<meta http-equiv=refresh content=2;URL='jadwal'>";
        }

        ?>
    </div>
</div>

<script>
    function confirmDelete(id) {
        if (confirm("Anda yakin ingin menghapus data ini?")) {
            window.location.href = "?hapus=" + id;
        } else {
            // Tidak melakukan apa-apa jika pengguna membatalkan
        }
    }
</script>