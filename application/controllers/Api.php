        <?php

        use Kreait\Firebase\Database\Query;

        defined('BASEPATH') or exit('No direct script access allowed');

        class Api extends CI_Controller
        {

            function register()
            {
            
                $data = json_decode(file_get_contents('php://input'), true);

            $username = $data['username'];
            $nomortelepon = $data['nomortelepon'];
            $password =    md5($data['password']);

                
            $SQL = "SELECT * FROM userandroid WHERE username='$username' AND nomortelepon='$nomortelepon'";
                $jumlah = $this->db->query($SQL)->num_rows();

                if ($jumlah > 0) {
                    $user = $this->db->query($SQL)->row_array();
                    echo json_encode(($user));
                    echo "USERNAME DAN NOMOR TELEPON SUDAH TERDAFTAR";
                } else {
                    $sql = [
                        'username' =>  $data['username'],
                        'nomortelepon' => $data['nomortelepon'],
                        'password' => md5($data['password']),
                    ];
                    $this->db->insert('userandroid',$sql);
                    if ($sql) {
                        echo 200;
                    } else {
                        echo 505;
                    }
                }
            }
            
            

            function login()
            {
                $data = json_decode(file_get_contents('php://input'), true);

                $nomortelepon = $data['nomortelepon'];
                $password = md5($data['password']);

                $sql = "SELECT * FROM userandroid WHERE nomortelepon='$nomortelepon' AND password='$password' AND password='$password'";

                // cek dulu
                $jumlah = $this->db->query($sql)->num_rows();

                if ($jumlah > 0) {
                    $user = $this->db->query($sql)->row_array();
                    echo json_encode(($user));
                } else {
                    echo 212;
                }
            }

            public function uploadprofile() {
                $data = json_decode(file_get_contents('php://input'), true);
                
                if ($data) {
                    $image_data = base64_decode($data['profile']); // Mengambil data gambar yang dikirim dalam format base64
            
                    // Mengekstrak ekstensi gambar (jpg atau png) berdasarkan tipe mime (opsional)
                    $image_type = $data['profile_mime'];

                    if ($image_type == 'image/jpeg' || $image_type == 'image/png') {
                    // Tipe MIME sesuai (JPG atau PNG), lanjutkan proses pengunggahan
                    } else {
                    // Tipe MIME tidak sesuai, tangani kesalahan
                    $response = array('error' => 'Tipe MIME tidak valid');
                    echo json_encode($response);
                    }

            
                    // Membuat nama file yang unik dengan ekstensi yang sesuai
                    $temp_image_path = 'path/assets/userprofileandroid/' . uniqid() . '.' . $file_extension;
            
                    file_put_contents($temp_image_path, $image_data);
            
                    // Simpan data gambar ke database
                    $insert_data = array(
                            'username' => $data['username'], // Ganti ini sesuai kebutuhan
                            'nomortelepon' => $data['nomortelepon'], // Ganti ini sesuai kebutuhan
                            'password' => $data['password'], // Ganti ini sesuai kebutuhan
                        'profile' => $image_data,
                        'profile_extension' => $file_extension, // Ekstensi gambar
                    );
            
                    // Simpan data gambar ke tabel di database
                    $this->db->insert('userandroid', $insert_data);
            
                    // Hapus gambar sementara (opsional)
                    unlink($temp_image_path);
            
                    // Beri respons ke klien (misalnya pesan sukses)
                    $response = array('message' => 'Gambar profil berhasil diupload');
                    echo json_encode($response);
                } else {
                    // Beri respons jika data tidak valid
                    $response = array('error' => 'Data tidak valid');
                    echo json_encode($response);
                }
            }
            
            
        }
