<?php
include(APPPATH . 'config/database.php');

$host = $db['default']['hostname'];
$dbname = $db['default']['database'];
$username = $db['default']['username'];
$password = $db['default']['password'];

$koneksi = mysqli_connect($host, $username, $password, $dbname);

if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

$sql = mysqli_query($koneksi, "SELECT * FROM admin WHERE id='$_GET[id]'");
$data = mysqli_fetch_array($sql);
?>


<!-- Begin Page Content -->
<div style="padding:10px;" class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('dashboard'); ?>" style="color: black;">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('useradmin'); ?>" style="color: black;">Admin SPP</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit Admin SPP</li>
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
            include(APPPATH . 'config/database.php');

            $host = $db['default']['hostname'];
            $dbname = $db['default']['database'];
            $username = $db['default']['username'];
            $password = $db['default']['password'];

            $koneksi = mysqli_connect($host, $username, $password, $dbname);

            if (!$koneksi) {
                die("Koneksi ke database gagal: " . mysqli_connect_error());
            }

            if (isset($_POST['submit'])) {
                // Mendapatkan data dari form
                $id = $_POST['id'];
                $username = $_POST['username'];
                $nama_lengkap = $_POST['nama_lengkap'];
                $role_id = $_POST['role_id'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                // Query update data
                $query = "UPDATE admin SET username='$username', nama_lengkap='$nama_lengkap', role_id='$role_id', password='$password' WHERE id=$id";
                $result = mysqli_query($koneksi, $query);

                // Cek hasil query
                if ($result) {
                    echo "<h3>Berhasil diubah!</h3>";
                    echo "<meta http-equiv=refresh content=1;URL='login'>";
                } else {
                    echo '<div class="alert alert-danger">Terjadi kesalahan saat memperbarui data.</div>';
                }

                // Tutup koneksi

            }
            ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control form-control-user" type="hidden" name="id" value="<?php echo $data['id'] ?>">
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $data['username'] ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password Baru</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo $data['nama_lengkap'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="role_id">Level</label>
                    <select class="form-control" id="role_id" name="role_id" required>
                        <option value="1" <?php echo $data['role_id'] == 1 ? 'selected' : ''; ?>>Admin</option>
                        <option value="2" <?php echo $data['role_id'] == 2 ? 'selected' : ''; ?>>User</option>
                    </select>
                </div>
                <div id="submit-container">
                    <button type="submit" name="submit" class="btn btn-primary loading">Simpan Perubahan</button>

                </div>
                <div id="checkmark" class="d-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M9 16.17l-3.88-3.88a.996.996 0 1 1 1.41-1.41L9 13.34l7.59-7.59a.996.996 0 1 1 1.41 1.41L9 16.17z" fill="rgba(40, 167, 69, 1)" />
                    </svg>
                    <span class="text-success">Data berhasil diubah!</span>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var btnSubmit = document.querySelector('[type="submit"].loading');
        btnSubmit.addEventListener('click', function() {
            this.classList.add('loading-active');
        });
    });
</script>