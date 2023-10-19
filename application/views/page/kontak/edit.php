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

$sql = mysqli_query($koneksi, "select * from kontak where id='$_GET[id]'");
$data = mysqli_fetch_array($sql);

mysqli_close($koneksi);
?>


<!-- Begin Page Content -->



<div style="padding: 10px;" class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('dashboard'); ?>" style="color: black;">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('kontak'); ?>" style="color: black;">Kontak</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit Kontak</li>
        </ol>
    </nav>

    <div style="padding:10px">
        <h2 style="font-family:'Poppins', sans-serif">Edit Kontak</h2>
    </div>

    <div class="card">
        <div class="card-header">
            <a href="<?= base_url('kontak'); ?>">
                <button type="button" class="btn btn-outline-secondary" style="text-decoration: none; font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: 500;">
                    Kembali
                </button> </a>
        </div>
        <div class="card-body">
            <?php
            // Mengambil konfigurasi koneksi ke database dari file database.php di folder config CodeIgniter
            include(APPPATH . 'config/database.php');

            $host = $db['default']['hostname'];
            $dbname = $db['default']['database'];
            $username = $db['default']['username'];
            $password = $db['default']['password'];

            $koneksi = mysqli_connect($host, $username, $password, $dbname);

            if (mysqli_connect_errno()) {
                die("Koneksi ke database gagal: " . mysqli_connect_error());
            }

            if (isset($_POST['submit'])) {
                // Mendapatkan data dari form
                $id = $_POST['id'];
                $nama = $_POST['nama'];
                $nohp = $_POST['nohp'];
                $alamat = $_POST['alamat'];

                // Query update data
                $query = "UPDATE kontak SET nama='$nama', nohp='$nohp', alamat='$alamat' WHERE id=$id";
                $result = mysqli_query($koneksi, $query);

                // Cek hasil query
                if ($result) {
                    echo "<h2> Data berhasil diubah ✅</h2>";
                    echo "<br>";
                    echo "<meta http-equiv=refresh content=1;URL='/kingfc/Kontak'>";
                } else {
                    echo '<div class="alert alert-danger">Terjadi kesalahan saat memperbarui data ❌</div>';
                }
            }

            // Tutup koneksi
            mysqli_close($koneksi);
            ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input class=" form-control form-control-user" type="hidden" id="id" name="id" value="<?php echo $data['id'] ?>">
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['nama'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="nohp">Nomor Telepon</label>
                    <input type="text" class="form-control" id="nohp" name="nohp" value="<?php echo $data['nohp'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $data['alamat'] ?>" required>
                </div>

                <button style="font-family: 'Poppins', sans-serif; font-size: 20px; font-weight:500" type="submit" name="submit" class="btn btn-outline-success">Simpan Perubahan</button>
                <div class="checkmark"></div>
            </form>
        </div>
    </div>
</div>