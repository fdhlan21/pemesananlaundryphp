<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <!-- Tambahkan link ke CSS eksternal untuk gaya tambahan -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        /* Gaya CSS tambahan */
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin-top: -50px;
        }

        .login-card {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .card {
            padding: 10px;
            width: 500px;
            margin-left: 50px;
            /* Atur jarak antara logo dan card di sini */
            margin-top: 20%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-container ">
            <!-- DIV UNTUK LOGO KING FC -->
            <div>
                <img src="../assets/img/icon/undraw_bola.png" alt="Logo King FC" height="250">
            </div>
            <div class="login-card animate__animated animate__fadeInRight">
                <div class="card">
                    <h2 style="font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: bold; text-align: center;">Register Page</h2>
                    <div class="card-body">
                        <form class="user" method="POST" action="<?= base_url('login/register'); ?>">
                            <div class="form-group">
                                <label style="font-family: 'Poppins', sans-serif;" for="username">
                                    <i class="fas fa-user" style="margin-right: 5px;"></i> Nama Lengkap
                                </label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Nama Lengkap...">
                                <small class="text-danger"><?= form_error('username'); ?></small>
                            </div>
                            <div class="form-group">
                                <label style="font-family: 'Poppins', sans-serif;" for="nohp">
                                    <i class="fas fa-phone-alt" style="margin-right: 5px;"></i> Nomor Telepon
                                </label>
                                <input type="number" class="form-control" id="nohp" name="nohp" placeholder="Masukkan Nomor Telepon...">
                                <small class="text-danger"><?= form_error('nohp'); ?></small>
                            </div>
                            <div class="form-group">
                                <label style="font-family: 'Poppins', sans-serif;" for="alamat">
                                    <i class="fas fa-map-marker-alt" style="margin-right: 5px;"></i> Alamat
                                </label>
                                <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat Lengkap..." style="height: 120px;"></textarea>
                                <small class="text-danger"><?= form_error('alamat'); ?></small>
                            </div>
                            <div class="form-group">
                                <label style="font-family: 'Poppins', sans-serif;" for="email">
                                    <i class="fas fa-at" style="margin-right: 5px;"></i> Email
                                </label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email...">
                                <small class="text-danger"><?= form_error('email'); ?></small>
                            </div>
                            <div class="form-group">
                                <label style="font-family: 'Poppins', sans-serif;" for="password">
                                    <i class="fas fa-unlock-alt" style="margin-right: 5px;"></i> Password
                                </label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Nama Lengkap...">
                                <small class="text-danger"><?= form_error('password'); ?></small>
                            </div>
                            <div class="form-group">
                                <div>
                                    <button style="font-family: 'Poppins', sans-serif;" class="btn btn-outline-success btn-block" type="submit">Daftar</button>
                                </div>
                                <div>
                                    <a href="<?= base_url('login'); ?>">
                                        <p style="font-family: 'Poppins', sans-serif; font-size: 12px; text-align: center; margin-top: 10px;">Sudah punya akun? Login</p>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>