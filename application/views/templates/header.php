<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">



    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">





</head>

<body id="page-top bg-gradient"></body>

<!-- Page Wrapper -->
<div id="wrapper" class="">
    <div></div>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .bg-gradient {
            background-color: #ffff;
        }

        .row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            /* Mengatur elemen vertikal ke atas */
            margin: 10px;
        }

        .column {
            flex-basis: 30%;
            /* Atur lebar masing-masing kolom sesuai kebutuhan Anda */
        }

        #nomor {
            margin-left: 0px;
            font-family: 'Poppins', sans-serif;
        }

        #keterangan {
            font-family: 'Poppins', sans-serif;
        }

        #jumlah {
            margin-right: 0px;
            font-family: 'Poppins', sans-serif;
        }


        /* Atur tampilan kolom ketika lebar layar kurang dari 600px */
        @media (max-width: 600px) {
            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                display: block;
                width: 100%;
            }

            th {
                background-color: <?= $color ?>;
                color: white;
            }

            td {
                /* Tambahkan gaya sesuai keinginan Anda */
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
        }

        /* Tampilan layar dengan lebar maksimum 768px (handphone) */
        @media (max-width: 768px) {
            .responsive-image {
                width: 50%;
                margin-top: -5%;
                /* Ubah ukuran gambar sesuai dengan kebutuhan Anda */
            }
        }

        /* Tampilan layar dengan lebar lebih dari 768px (monitor) */
        @media (min-width: 769px) {
            .responsive-image {
                width: 30%;
                margin-top: -5%;
                /* Ubah ukuran gambar sesuai dengan kebutuhan Anda */
            }

            /* CSS untuk perangkat seluler */
            @media (max-width: 768px) {
                .breadcrumb {
                    font-size: 16px;
                }

                h2 {
                    font-size: 20px;
                }

                .card-header {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .btn {
                    font-size: 16px;
                    padding: 5px 10px;
                }
            }

            /* CSS untuk tampilan layar besar */
            @media (min-width: 769px) {
                /* Gaya CSS untuk tampilan monitor di sini */
            }

        }

        @media print {
            @page {
                size: A5;
                /* Set ukuran kertas ke A5 */
                margin: 0;
                /* Hilangkan margin */
            }

            body {
                margin: 0;
                /* Hilangkan margin pada body */
            }
        }

        .contact-card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card .card-img-top {
            width: auto;
            height: auto;
            object-fit: cover;
            /* Mengatur bagaimana gambar diatur dalam area yang telah ditentukan */
        }

/* Mengatur margin antara kartu */
        
    </style>