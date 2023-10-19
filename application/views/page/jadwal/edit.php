<!-- Begin Page Content -->



<div style="padding: 10px;" class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('dashboard'); ?>" style="color: black;">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('jadwal'); ?>" style="color: black;">Jadwal</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Jadwal</li>
        </ol>
    </nav>

    <div style="padding:10px">
        <h2 style="font-family:'Poppins', sans-serif">Tambah Jadwal</h2>
    </div>

    <div class="card">
        <div class="card-header">
            <a href="<?= base_url('jadwal'); ?>">
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
            if (!$koneksi) {
                die("Koneksi ke database gagal: " . mysqli_connect_error());
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $lokasi = $_POST["lokasi"];
                // Konversi haritanggal menjadi format yang sesuai untuk jenis data DATE
                $haritanggal = date("Y-m-d", strtotime($_POST["haritanggal"]));

                // Konversi waktu menjadi format yang sesuai untuk jenis data TIME
                $waktu = date("H:i:s", strtotime($_POST["waktu"]));
              


                $query = "INSERT INTO jadwalmainbola (lokasi, haritanggal, waktu) VALUES ('$lokasi', '$haritanggal', '$waktu')";
                $result = mysqli_query($koneksi, $query);

                if ($result) {
                    echo "<h3 style='font-family: 'Poppins', sans-serif;'>Jadwal baru berhasil ditambahkan ✅</h3>";
                    echo "<meta http-equiv=refresh content=1;URL='/kingfc/jadwal'>";
                } else {
                    echo "Terjadi Kesalahan❌";
                }
            }

            // Menutup koneksi
            mysqli_close($koneksi);
            ?>


            <form method="POST" action="">
                <div class="form-group">
                    <label for="lokasi">Lokasi Lapangan</label>
                    <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                </div>
                <div class="form-group">
                    <label for="haritanggal">Hari dan Tanggal</label>
                    <input type="date" class="form-control" id="haritanggal" name="haritanggal" required>
                </div>
                <div class="form-group">
                    <label for="waktu">Waktu</label>
                    <input type="time" class="form-control" id="waktu" name="waktu" required>
                </div>
                <button type="submit" class="btn btn-outline-success" style="font-family: 'Poppins', sans-serif; font-weight: 500;">Simpan Jadwal </button>
            </form>
        </div>
    </div>
</div>