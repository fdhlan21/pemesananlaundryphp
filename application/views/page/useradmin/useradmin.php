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

// Query SQL untuk mengambil data dari tabel
$query = "SELECT * FROM app_data";
$stmt = $pdo->query($query);

// Fetch data baris per baris
while ($row = $stmt->fetch()) {
    // Ambil nilai kolom yang diinginkan
    $color = $row['color4'];

    // Lakukan sesuatu dengan nilai yang diambil
    // ...
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
            <li class="breadcrumb-item active" aria-current="page">Admin SPP</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header" style="display: flex; gap: 12px;">
            <a href="<?= base_url('dashboard'); ?>"><button type="button" class="btn btn-outline-secondary" style="text-decoration: none; font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: 500;">Kembali</button></a>
            <a href="<?= base_url('useradmin/add'); ?>"><button type="button" class="btn btn-outline-success" style="text-decoration: none; font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: 500;">Tambah</button></a>
        </div>

        <div class=" card-body">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-striped table-hover tabza dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                            <thead>
                                <tr class="" style="color:white; background-color: <?= $color ?>;" role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending" style="width: 21.3281px;">No</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Nama: activate to sort column ascending">Username</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Tempat Tinggal: activate to sort column ascending">Nama Lengkap</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Tempat Tinggal: activate to sort column ascending">Password</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Tempat Tinggal: activate to sort column ascending">Level</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Tempat Tinggal: activate to sort column ascending">Tanggal</th>
                                    <?php if ($admin['role_id'] == 1) { ?>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending">Action</th>
                                    <?php } ?>
                                </tr>
                            </thead>

                            <tbody>
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



                                $no = 1;
                                $query = "SELECT * FROM admin ORDER BY id ASC";
                                $result = mysqli_query($koneksi, $query);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row['id'];
                                    $username = $row['username'];
                                    $nama_lengkap = $row['nama_lengkap'];
                                    $password = $row['password'];
                                    $role_id = $row['role_id'];
                                    $timestamp = $row['date_created']; // Mengambil timestamp Unix dari database
                                    $tanggal = date(
                                        "d M Y",
                                        $timestamp
                                    ); // Mengonversi ke format yang sesuai



                                    echo "<tr>";
                                    echo "<td>$no</td>";
                                    echo "<td><p style='color: black; font-family:'Poppins', sans-serif;'>$username</p></td>";
                                    echo "<td  style='color: black; font-family:'Poppins', sans-serif;'>$nama_lengkap</td>";
                                    echo "<td  style='color: black; font-family:'Poppins', sans-serif;'>****</td>";
                                    echo "<td>";
                                    if ($row['role_id'] == 1) {
                                        echo "Admin";
                                    }
                                    echo "</td>";
                                    echo "<td><p style='color: black; font-family:'Poppins', sans-serif;'>$tanggal</p></td>";
                                    if ($admin['role_id'] == 1) {
                                        echo "<td>
                                            <a href=\"javascript:void(0);\" onclick=\"confirmDelete('$id');\" class='btn btn-outline-danger' style='margin-left: 10px;'><i class='fas fa-fw fa-trash'></i></a>
                                            <a href='useradmin/edit?id=$id' class='btn btn-outline-success' style='margin-left: 10px;'><i class='fas fa-user-edit'></i></a>
                                            <a href='useradmin/detail/?id=$id' class='btn btn-outline-primary' style='margin-left: 10px;'><i class='fas fa-info-circle'></i></a>
                                            </td>";
                                    }

                                    $no++;
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

                        if (isset($_GET['hapus']) && $admin['role_id'] == 1) {
                            mysqli_query($koneksi, "DELETE FROM transaksi WHERE id='$_GET[hapus]'");
                            echo "<p style='color: black; font-size:15px;'>Data Terhapus</p>";
                            echo "<meta http-equiv=refresh content=2;URL='transaksi'>";
                        }

                        ?>

                    </div>
                </div>
            </div>
        </div>
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