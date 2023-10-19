<!-- Sidebar -->


<div class="col col-sm-2" style="padding:20px;box-shadow: rgba(0, 0, 0, 0.35) 10px 0 10px -10px;">
    <div style="padding-top:20%">
        <!--logo brand -->
        <center>
            <i class="fas fa-fw fa-cubes" class="d-inline-block align-top" alt style="font-size: 50px; color: #202C60;"></i>
            <p style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-weight: 800; color: #202C60; ">ZAVASTOK</p>
        </center>

    </div>
    <ul class="navbar-nav">
        <!-- Divider -->

        <!--Dashboard -->
        <li class="nav-item" style="background-color:#1C75AE;color:white;border-radius:5px">
            <a class="nav-link" href="<?= base_url('admin'); ?>" style="background-color:#1C75AE;color:white;border-radius:5px">
                <i class="fas fa-fw fa-tachometer-alt" style="font-size: 20px; padding-left: 10px;"></i>
                <span style="font-size: 20px;font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;letter-spacing: 2px; text-align: center; padding-left: 20px;">Dashboard</span></a>
        </li>




        <!-- Data Pengguna-->
        <li class="nav-item" style="padding: 10px;">
            <a class="nav-link" href="<?= base_url('pengguna'); ?>">
                <i class="fas fa-fw fa-users" style="font-size: 20px;  color: #202C60;"></i>
                <span style="font-size: 20px;font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;letter-spacing: 2px; padding-left: 10px;  color: #202C60;">Pengguna</span></a>
        </li>



        <!-- Data Stok-->
        <li class="nav-item" style="padding: 10px;">
            <a class="nav-link" href="<?= base_url('stok'); ?>">
                <i class="fas fa-fw fa-layer-group" style="font-size: 20px;  color: #202C60;"></i>
                <span style="font-size: 20px;font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;letter-spacing: 2px; padding-left: 10px;  color: #202C60;">Stok</span></a>
        </li>



        <!-- Slider -->
        <li class="nav-item" style="padding: 10px;">
            <a class="nav-link" href="<?= base_url('slider'); ?>">
                <i class="fas fa-fw fa-sliders-h" style="font-size: 20px;  color: #202C60;"></i>
                <span style="font-size: 20px;font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;letter-spacing: 2px; padding-left: 10px;  color: #202C60;">Slider</span></a>
        </li>




        <!-- Pengaturan -->
        <li class="nav-item" style="padding: 10px;">
            <a class="nav-link" href="<?= base_url('pengaturan'); ?>">
                <i class="fas fa-fw fa-cog" style="font-size: 20px;  color: #202C60;"></i>
                <span style="font-size: 20px;font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;letter-spacing: 2px; padding-left: 10px;  color: #202C60;">Pengaturan</span></a>
        </li>


        <!-- User Admin-->
        <li class="nav-item" style="padding: 10px;">
            <a class="nav-link" href="<?= base_url('useradmin'); ?>">
                <i class="fas fa-fw fa-lock" style="font-size: 20px;  color: #202C60;"></i>
                <span style="font-size: 20px;font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;letter-spacing: 2px; padding-left: 10px;  color: #202C60;">User Admin</span></a>
        </li>
        <!-- Divider -->


    </ul>
</div>
<!-- End of Sidebar -->