<!-- Begin Page Content -->

<?php
include(APPPATH . 'config/database.php');

$host = $db['default']['hostname'];
$dbname   = $db['default']['database'];
$username = $db['default']['username'];
$password = $db['default']['password'];

$koneksi = mysqli_connect($host, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}


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
    $nama_company = $row['nama_company'];
    $telepon = $row['telepon'];

    // Lakukan sesuatu dengan nilai yang diambil
    // ...

    // Menutup koneksi ke database
    $pdo = null;
}
?>



<div style="padding:10px;" class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('Dashboard'); ?>" style="color: black;">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">
            <a href="<?= base_url('Dashboard'); ?>" class="btn bg-secondary"><i class="fas fa-fw fa-arrow-left" style="color: #ffffff;"></i><span style="color: #ffffff; padding-left: 10px;">Kembali</span></a>
            <a href="<?= base_url('Pengaturan/Pengaturanweb'); ?>" class="btn bg-info"><i class="fas  fa-fw fa-pencil-alt" style="color: #ffffff;"></i><span style="color: #ffffff; padding-left: 10px;"> Pengaturan</span></a>
        </div>


        <div class="card-body">
            <div class="form-group">
                <label>Nama Aplikasi</label>
                <p>
                    <strong>SPP</strong>
                </p>
            </div>
            <hr>
            <div class="form-group">
                <label>Nama Company</label>
                <p>
                    <strong><?= $nama_company ?></strong>
                </p>
            </div>
            <hr>
            <div>
                <label>Deksripsi Aplikasi</label>
                <p>
                    <strong>-</strong>
                </p>
            </div>
            <hr>
            <div class="form-group">
                <label>Telepon</label>
                <p>
                    <strong><?= $telepon ?></strong>
                </p>
            </div>
            <hr>
            <div class="form-group">
                <label>Warna Tabel</label>
                <center>
                    <div class="row col col-sm-12">
                        <?php
                        include(APPPATH . 'config/database.php');

                        $host = $db['default']['hostname'];
                        $dbname   = $db['default']['database'];
                        $username = $db['default']['username'];
                        $password = $db['default']['password'];

                        $koneksi = mysqli_connect($host, $username, $password, $dbname);

                        if (mysqli_connect_errno()) {
                            die("Koneksi ke database gagal: " . mysqli_connect_error());
                        }


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

                        // Ambil warna dari database berdasarkan ID dan nama kolom
                        $colorID = 1; // Ganti dengan ID yang sesuai
                        $columnNames = ['color1', 'color2', 'color3', 'color4']; // Ganti dengan nama kolom yang sesuai
                        $colors = [];

                        // Loop melalui setiap nama kolom dan ambil nilainya dari database
                        foreach ($columnNames as $columnName) {
                            $stmt = $pdo->prepare("SELECT $columnName FROM app_data WHERE id = ?");
                            $stmt->execute([$colorID]);
                            $color = $stmt->fetchColumn();
                            $colors[] = $color;
                        }

                        // Output elemen <div> dengan style background color sesuai data dari database
                        for ($i = 0; $i < count($columnNames); $i++) {
                            echo '<div class="color-box" id="color' . ($i + 1) . '" style="width:30px;margin:2%;height:30px;border-radius:15px; background-color: ' . $colors[$i] . ';"></div>';
                        }
                        ?>

                    </div>
                </center>
            </div>
            <hr>
        </div>
        <div class="card-footer"></div>

    </div>


</div>