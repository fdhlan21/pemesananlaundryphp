<div style="padding: 10px;" class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('dashboard'); ?>" style="color: black;">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('berita'); ?>" style="color: black;">Berita</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Berita</li>
        </ol>
    </nav>

    <div style="padding: 10px">
        <h2 style="font-family:'Poppins', sans-serif">Tambah Berita</h2>
    </div>
    <div class="card">
        <div class="card-header">
            <a href="<?= base_url('berita'); ?>">
                <button type="button" class="btn btn-outline-secondary" style="text-decoration: none; font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: 500;">
                    Kembali
                </button>
            </a>
        </div>
        <div class="card-body">
            <?php
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

            if (isset($_POST['submit'])) {
                $judul = $_POST['judul'];
                $deskripsi = $_POST['deskripsi'];

                $gambar = $_FILES['gambar']['name'];
                $gambar_tmp = $_FILES['gambar']['tmp_name'];
                $gambar_path = 'path/assets/berita/' . $gambar;

                if (move_uploaded_file($gambar_tmp, $gambar_path)) {
                    $query = "INSERT INTO berita (judul, deskripsi, gambar) VALUES (?, ?, ?)";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute([$judul, $deskripsi, $gambar]);

                    if ($stmt) {
                        echo "<h2> Data berhasil ditambahkan ✅</h2>";
                        echo "<meta http-equiv=refresh content=1;URL='/kingfc/berita'>";
                        echo "<br>";
                    } else {
                        echo '<div class="alert alert-danger">Terjadi kesalahan saat menambahkan data ❌</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger">Terjadi kesalahan saat mengunggah gambar ❌</div>';
                }
            }

            $pdo = null;
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