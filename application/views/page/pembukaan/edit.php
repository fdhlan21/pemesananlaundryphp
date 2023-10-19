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

$sql = mysqli_query($koneksi, "select * from bukubesar where id='$_GET[id]'");
$data = mysqli_fetch_array($sql);

$tanggal = date('Y-m-d', ($data['tanggal']));


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
                <a href="<?= base_url('pengguna'); ?>" style="color: black;">Buku Besar</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit Buku Besar</li>
        </ol>
    </nav>

    <div style="padding:10px">
        <h2 style="font-family:'Poppins', sans-serif">Edit Buku Besar</h2>
    </div>

    <div class="card">
        <div class="card-header">
            <a href="<?= base_url('pembukaan'); ?>">
                <button type="button" class="btn btn-outline-secondary" style="text-decoration: none; font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: 500;">
                    Kembali
                </button> </a>
        </div>
        <div class="card-body">
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

            if (isset($_POST['submit'])) {
                // Mendapatkan data dari form
                $id = $_POST['id'];
                $nis = $_POST['nis'];
                $nama = $_POST['nama'];
                $tanggal = time();
                $keterangan = $_POST['keterangan'];
                $jumlah = $_POST['jumlah'];
                $status = $_POST['status'];

                // Query update data
                $query = "UPDATE siswa SET nis='$nis',  nama='$nama', tanggal='$tanggal', keterangan='$keterangan', jumlah='$jumlah', status='$status' WHERE id=$id";
                $result = mysqli_query($koneksi, $query);

                // Cek hasil query
                if ($result) {
                    echo "<h2> Data berhasil diubah ✅</h2>";
                    echo "<br>";
                    echo "<meta http-equiv=refresh content=1;URL='/sekolah/Pengguna'>";
                } else {
                    echo '<div class="alert alert-danger">Terjadi kesalahan saat memperbarui data ❌</div>';
                }
            }

            // Tutup koneksi
            mysqli_close($koneksi);
            ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label for="nis">NIS</label>
                    <input class=" form-control form-control-user" type="hidden" name="id" value="<?php echo $data['id'] ?>">
                    <input type="text" class="form-control" id="nis" name="nis" value="<?php echo $data['nis'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['nama'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $tanggal ?>" required>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?php echo $data['keterangan'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?php echo $data['jumlah'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="Lunas" id="status">Lunas</option>
                        <option value="Belum Lunas" id="status">Belum Lunas</option>
                    </select>
                </div>


                <button style="font-family: 'Poppins', sans-serif; font-size: 20px; font-weight:500" type="submit" name="submit" class="btn btn-outline-success">Simpan Perubahan</button>
                <div class="checkmark"></div>
            </form>
        </div>
    </div>
</div>