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
    $color = $row['color3'];

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
            <li class="breadcrumb-item active" aria-current="page">Buku Besar</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header" style="display: flex; gap: 12px;">
            <a href="<?= base_url('dashboard'); ?>"><button type="button" class="btn btn-outline-secondary" style="text-decoration: none; font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: 500;">Kembali</button></a>
            <a href="<?= base_url('pembukaan/add'); ?>"><button type="button" class="btn btn-outline-success" style="text-decoration: none; font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: 500;">Tambah</button></a>
        </div>

        <div class=" card-body">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <form method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Cari..." name="q"">
                                <div class=" input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Cari</button>
                            </div>
                    </div>
                    </form>

                    <table class="table table-bordered table-striped table-hover tabza dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                        <thead>
                            <tr class="" style="color:white; background-color: <?= $color ?>;" role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending" style="width: 21.3281px;">No</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="NIS: activate to sort column ascending">NIS</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Nama: activate to sort column ascending">Nama</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Tanggal: activate to sort column ascending">Tanggal</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Keterangan: activate to sort column ascending">Keterangan</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Jumlah: activate to sort column ascending">Jumlah</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label=" Status: activate to sort column ascending">Status</th>
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


                            // Inisialisasi variabel pencarian
                            $keyword = "";

                            // Mengecek apakah terdapat data pencarian
                            if (isset($_GET['q']) && !empty($_GET['q'])) {
                                $keyword = $_GET['q'];

                                // Query SQL dengan kondisi pencarian
                                $query = "SELECT * FROM bukubesar WHERE
              nis LIKE '%$keyword%' OR
              nama LIKE '%$keyword%' OR
              tanggal LIKE '%$keyword%' OR
              keterangan LIKE '%$keyword%' OR
              jumlah LIKE '%$keyword%' OR
              status LIKE '%$keyword%'
              ORDER BY id ASC";
                            } else {
                                // Query SQL tanpa kondisi pencarian
                                $query = "SELECT * FROM bukubesar ORDER BY id ASC";
                            }
                            $no = 1;
                            $result = mysqli_query($koneksi, $query);


                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['id'];
                                $nis = $row['nis'];
                                $nama = $row['nama'];
                                $timestamp = $row['tanggal']; // Mengambil timestamp Unix dari database
                                $tanggal = date(
                                    "d M Y",
                                    $timestamp
                                ); // Mengonversi ke format yang sesuai
                                $keterangan = $row['keterangan'];
                                $jumlah = $row['jumlah'];
                                $status = $row['status'];




                                echo "<tr>";
                                echo "<td>$no</td>";
                                echo "<td><p style='color: black; font-family:'Poppins', sans-serif;'>$nis</p></td>";
                                echo "<td><p style='color: black; font-family:'Poppins', sans-serif;'>$nama</p></td>";
                                echo "<td  style='color: black; font-family:'Poppins', sans-serif;'>$tanggal</td>";
                                echo "<td style='display: flex; flex-direction: column; align-items: flex-start;'><p style='color: black; font-family: 'Poppins', sans-serif; margin: 0px'>$keterangan</p></td>";
                                echo "<td><p style='color: black; font-family:'Poppins', sans-serif;'>$jumlah</p></td>";
                                echo "<td><p style='color: black; font-family:'Poppins', sans-serif;'>$status</p></td>";
                                if ($admin['role_id'] == 1) {
                                    echo "<td>
                                        <a href=\"javascript:void(0);\" onclick=\"confirmDelete('$id');\" class='btn btn-outline-danger' style='margin-left: 10px;'><i class='fas fa-fw fa-trash'></i></a>
                                            <a href='pembukaan/edit?id=$id' class='btn btn-outline-success' style='margin-left: 10px;'><i class='fas fa-user-edit'></i></a>
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
                        mysqli_query($koneksi, "DELETE FROM bukubesar WHERE id='$_GET[hapus]'");
                        echo "<p style='color: black; font-size:15px;'>Data Terhapus</p>";
                        echo "<meta http-equiv=refresh content=2;URL='pembukaan'>";
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