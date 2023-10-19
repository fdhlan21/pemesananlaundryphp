<!-- Begin Page Content -->
<div style="padding:10px;" class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('dashboard'); ?>" style="color: black;">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('pembukaan'); ?>" style="color: black;">Buku Besar</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Buku Besar</li>
        </ol>
    </nav>

    <div style="padding:10px">
        <h2 style="font-family:'Poppins', sans-serif">Tambah Buku Besar</h2>
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
            $dbname = $db['default']['database'];
            $username = $db['default']['username'];
            $password = $db['default']['password'];

            $koneksi = mysqli_connect($host, $username, $password, $dbname);
            if (!$koneksi) {
                die("Koneksi ke database gagal: " . mysqli_connect_error());
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nis = $_POST["nis"];
                $nama = $_POST["nama"];
                $tanggal = strtotime($_POST['tanggal']);
                $keterangan = $_POST["keterangan"];
                $jumlah = $_POST["jumlah"];
                $status = $_POST["status"];

                $query = "INSERT INTO bukubesar (nis, nama, tanggal, keterangan, jumlah, status) VALUES ('$nis', '$nama', '$tanggal', '$keterangan', '$jumlah', '$status')";
                $result = mysqli_query($koneksi, $query);

                if ($result) {
                    echo "<h3 style='font-family: 'Poppins', sans-serif;'>Buku Besar baru berhasil ditambahkan ✅</h3>";
                    echo "<meta http-equiv=refresh content=1;URL='/sekolah/pembukaan'>";
                } else {
                    echo "Gagal menambahkan Siswa ❌";
                }
            }



            // Menutup koneksi
            mysqli_close($koneksi);
            ?>

            <form method="POST" action="">

                <div class="form-group">
                    <label for="nis">NIS</label>
                    <select class="form-control" name="nis">
                        <?php foreach ($options as $option) { ?>
                            <option value="<?php echo $option['nis']; ?>"><?php echo $option['nis']; ?></option>
                        <?php } ?>

                    </select>
                </div>


                <div class="form-group">
                    <label for="nama">Nama</label>
                    <select class="form-control" name="nama">
                        <?php foreach ($options as $option) { ?>
                            <option value="<?php echo $option['nama']; ?>"><?php echo $option['nama']; ?></option>
                        <?php } ?>

                    </select>
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" required>

                </div>

                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <!-- Elemen input keterangan sebelumnya -->
                    <input type="number" name="jumlah" class="form-control" required>

                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="lunas" id="status">Lunas</option>
                        <option value="belum lunas" id="status">Belum Lunas</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-outline-success" style="font-family: 'Poppins', sans-serif; font-weight: 500;">Simpan</button>
            </form>
        </div>
    </div>
</div>