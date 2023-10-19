<div class="container-fluid">
    <div class="container">

        <main>

            <div style="margin-top: 2%;">
                <h2 style="text-align: center; font-family: 'Poppins', sans-serif; font-weight: 500;">Selamat Datang di Website KING FC</h2>
            </div>
            <!-- SLIDER KONTEN MAIN   -->
            <div id="slider" style="padding:10px;  margin-top: 20px;  background-size: cover; height: 400px; border-radius: 10px; transition: background-image 0.5s;">
            </div>




        </main>
    </div>
</div>


<script>
    // Daftar gambar yang akan digunakan dalam slider
    const images = [
        'assets/img/slider/sayaslider1.png',
        'assets/img/slider/sayaslider2.png',
        'assets/img/slider/sayaslider3.png',
        'assets/img/slider/sayaslider4.png',
    ];

    let currentIndex = 0;
    const slider = document.getElementById('slider');

    // Fungsi untuk mengganti gambar pada slider
    function changeSlide() {
        slider.style.backgroundImage = `url(${images[currentIndex]})`;

        // Ganti indeks ke gambar berikutnya
        currentIndex = (currentIndex + 1) % images.length;
    }

    // Panggil fungsi changeSlide() secara otomatis setiap beberapa detik
    setInterval(changeSlide, 3000); // Ganti gambar setiap 3 detik (3000 milidetik)

    // Panggil changeSlide() untuk gambar pertama kali
    changeSlide();
</script>