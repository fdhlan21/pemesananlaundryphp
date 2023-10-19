<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['dompdf'] = array(
    'enabled' => true,
    'isHtml5ParserEnabled' => true,
    'isPhpEnabled' => true,
    'isRemoteEnabled' => true,
    'defaultFont' => 'Arial',
    'pdfBackend' => 'auto',
);
