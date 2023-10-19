<!-- Begin Page Content -->

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
$queryMember = "SELECT id, username, nohp, alamat FROM memberadmin WHERE role_id = 2";
$stmtMember = $pdo->query($queryMember);

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
            <li class="breadcrumb-item active" aria-current="page">Member</li>
        </ol>
    </nav>
    <div>
        <h2 style="font-family: 'Poppins', sans-serif; font-weight: 500; text-align: center;">Data Member</h2>
    </div>
    <div style="padding:10px; margin-top: 2%">

        <table style="margin-top:1%;" class="table table-bordered table-striped table-hover tabza dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
            <thead>
                <tr class="" style="color:white; background-color: <?= $color ?>;" role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending" style="width: 21.3281px;">No</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Username: activate to sort column ascending">Nama Lengkap </th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Nomor Telepon</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Password: activate to sort column ascending">Alamat</th>
                    <?php if ($_SESSION['role_id'] == 1) : ?>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Password: activate to sort column ascending">Action</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch data baris per baris
                // Fetch data baris per baris
                $no = 1;
                while ($row = $stmtMember->fetch()) {
                    $id = $row['id'];

                    // Tampilkan kolom "Nama Lengkap", "Nomor Telepon", dan "Alamat"
                    echo '<tr role="row" class="odd">';
                    echo "<td>$no</td>";
                    echo '<td>' . $row['username'] . '</td>';
                    echo '<td>' . $row['nohp'] . '</td>';
                    echo '<td>' . $row['alamat'] . '</td>';

                    // Tampilkan tombol hapus hanya jika pengguna adalah admin (role_id == 1)
                    if ($_SESSION['role_id'] == 1) {
                        echo '<td>';
                        echo '<a class="btn btn-outline-danger" onclick="confirmDelete(' . $row['id'] . ');"><i class="fas fa-trash"></i> Hapus</a>';
                        echo '<a class="btn btn-outline-success" href="pengguna/ubah?id=' . $id . '" style="margin-left: 10px;"><i class="fas fa-user-edit"></i> Ubah</a>';
                        echo '</td>';
                    }
                    echo '</tr>';
                    $no++;
                }

                ?>
            </tbody>

        </table>

    </div>
</div>
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
    mysqli_query($koneksi, "DELETE FROM memberadmin WHERE id='$_GET[hapus]'");
    echo '<div class="alert alert-success">Member berhasil di hapus ✅</div>';
    echo "<meta http-equiv=refresh content=1;URL='/kingfc/pengguna'>";
}

?>
<script>
    function confirmDelete(id) {
        if (confirm("Anda yakin ingin menghapus data ini?")) {
            window.location.href = "?hapus=" + id;
        } else {
            // Tidak melakukan apa-apa jika pengguna membatalkan
        }
    }
</script>