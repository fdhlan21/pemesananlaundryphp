<!-- Begin Page Content -->
<div style="padding:10px;" class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('dashboard'); ?>" style="color: black;">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('useradmin'); ?>" style="color: black;">Siswa</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Siswa</li>
        </ol>
    </nav>

    <div style="padding:10px">
        <h2 style="font-family:'Poppins', sans-serif">Menambah Siswa</h2>
    </div>
    <div class="card">
        <div class="card-header">
            <a href="<?= base_url('pengguna'); ?>">
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
                $judul = $_POST["judul"];
                $deskripsi = $_POST["deskripsi"];

                // Memeriksa apakah ada file yang diunggah
                if (isset($_FILES['gambar'])) {
                    $gambar = $_FILES['gambar']['name'];
                    $gambar_temp = $_FILES['gambar']['tmp_name'];

                    // Tentukan path untuk menyimpan gambar
                    $path = 'path/assets/berita' . $gambar;

                    // Pindahkan gambar ke path yang ditentukan
                    if (move_uploaded_file($gambar_temp, $path)) {
                        // Gambar berhasil diunggah, selanjutnya Anda bisa menyimpan data ke database
                        $query = "INSERT INTO berita (judul, deskripsi, gambar) VALUES ('$judul', '$deskripsi', '$path')";
                        $result = mysqli_query($koneksi, $query);

                        if ($result) {
                            echo "<h3 style='font-family: 'Poppins', sans-serif;'>Berita berhasil ditambahkan ✅</h3>";
                            echo "<meta http-equiv=refresh content=1;URL='/sekolah/berita'>";
                        } else {
                            echo "Gagal menambahkan Berita ❌";
                        }
                    } else {
                        echo "Gagal mengunggah gambar ❌";
                    }
                } else {
                    echo "Gambar tidak diunggah ❌";
                }
            }

            // Menutup koneksi
            mysqli_close($koneksi);
            ?>


            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" required>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                </div>

                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" class="form-control" id="gambar" name="gambar" required>
                </div>

                <button type="submit" name="submit" class="btn btn-outline-success">Simpan</button>
            </form>

        </div>
    </div>
</div>