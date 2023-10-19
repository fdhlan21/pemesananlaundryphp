<!-- Begin Page Content -->
<div style="padding:10px;" class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('dashboard'); ?>" style="color: black;">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('useradmin'); ?>" style="color: black;">Admin</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Admin</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">
            <a href="<?= base_url('useradmin'); ?>" class="btn bg-secondary">
                <i class="fas fa-fw fa-arrow-left" style="color: #ffffff;"></i>
                <span style="color: #ffffff; padding-left: 10px;">Kembali</span>
            </a>
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
                $username = $_POST["username"];
                $password = $_POST["password"];
                $nama_lengkap = $_POST["nama_lengkap"];
                $role_id  = $_POST ["role_id"];
                $date_created = time();
                
                // Hash password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $query = "INSERT INTO admin (username, password, nama_lengkap, role_id, date_created) VALUES ('$username', '$hashed_password', '$nama_lengkap', '$role_id', '$date_created')";
                $result = mysqli_query($koneksi, $query);

                if ($result) {
                    echo "<h3 style='font-family: 'Poppins', sans-serif;'>Admin baru berhasil ditambahkan ✅</h3>";
                    echo "<meta http-equiv=refresh content=1;URL='/sekolah/login'>";
                } else {
                    echo "Gagal menambahkan admin.";
                }
            }

            // Menutup koneksi
            mysqli_close($koneksi);
            ?>


            <form method="POST" action="">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                </div>
                <div class="form-group">
                    <label for="role_id">Level</label>
                    <select class="form-control" id="role_id" name="role_id">
                        <option value="1">Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>