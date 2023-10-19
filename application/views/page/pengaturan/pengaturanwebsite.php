<!-- Begin Page Content -->



<div style="padding:10px;" class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('Dashboard'); ?>" style="color: black;">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('Pengaturan'); ?>" style="color: black;">Pengaturan</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">
            <a href="<?= base_url('Pengaturan'); ?>" class="btn bg-secondary"><i class="fas fa-fw fa-arrow-left" style="color: #ffffff;"></i><span style="color: #ffffff; padding-left: 10px;">Kembali</span></a>

        </div>

        <div class="card-body">
            <?php
            // Mengambil konfigurasi koneksi ke database dari file database.php di folder config CodeIgniter
            include(APPPATH . 'config/database.php');

            $host = $db['default']['hostname'];
            $dbname   = $db['default']['database'];
            $username = $db['default']['username'];
            $password = $db['default']['password'];

            $koneksi = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

            // Fungsi untuk mengupdate pengaturan ke database
            function updatePengaturan($koneksi, $id, $nama_company, $telepon, $color1, $color2, $color3, $color4)
            {
                $stmt = $koneksi->prepare("UPDATE app_data SET nama_company = ?, telepon = ?, color1 = ?, color2 = ?, color3 = ?, color4 = ? WHERE id = ?");
                $stmt->execute([$nama_company, $telepon, $color1, $color2, $color3, $color4, $id]);
            }

            // Cek apakah form disubmit
            if (isset($_POST['submit'])) {
                // Ambil nilai dari form
                $id = 1; // Ganti dengan ID yang sesuai
                $nama_company = $_POST['nama_company'];
                $telepon = $_POST['telepon'];
                $color1 = $_POST['color1'];
                $color2 = $_POST['color2'];
                $color3 = $_POST['color3'];
                $color4 = $_POST['color4'];

                // Panggil fungsi untuk mengupdate pengaturan ke database
                updatePengaturan($koneksi, $id, $nama_company, $telepon, $color1, $color2, $color3, $color4);
                echo "<h3 style='font-family: 'Poppins', sans-serif;'>Perubahan berhasil di simpan.</h3>";
                echo "<meta http-equiv=refresh content=2;URL=/sekolah/Pengaturan>";
            }

            // Query SQL untuk mengambil data pengaturan dari tabel
            $query = "SELECT * FROM app_data WHERE id = 1"; // Ganti dengan ID yang sesuai
            $stmt = $koneksi->query($query);
            $row = $stmt->fetch();

            // Menutup koneksi ke database
            $koneksi = null;
            ?>
            <form method="post" action="">
                <div class="form-group">
                    <label for="nama_company">Nama Company</label>
                    <input type="text" name="nama_company" id="nama_company" class="form-control" value="<?= $row['nama_company']; ?>">
                </div>
                <div class="form-group">
                    <label for="telepon">Telepon</label>
                    <input type="text" name="telepon" id="telepon" class="form-control" value="<?= $row['telepon']; ?>">
                </div>
                <div class="form-group">
                    <label for="color1">Color Tabel Data Siswa</label>
                    <input type="color" name="color1" id="color1" class="form-control" value="<?= $row['color1']; ?>">
                </div>
                <div class="form-group">
                    <label for="color2">Color Tabel Data Transaksi</label>
                    <input type="color" name="color2" id="color2" class="form-control" value="<?= $row['color2']; ?>">
                </div>
                <div class="form-group">
                    <label for="color3">Color Tabel Data Buku Besar</label>
                    <input type="color" name="color3" id="color3" class="form-control" value="<?= $row['color3']; ?>">
                </div>
                <div class="form-group ">
                    <label for="color4">Color Tabel Data  Admin</label>
                    <input type="color" name="color4" id="color4" class="form-control" value="<?= $row['color4']; ?>">
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
        <div class="card-footer"></div>
    </div>
</div>