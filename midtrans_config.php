<?php
require_once 'vendor/autoload.php'; // pastikan path benar

\Midtrans\Config::$serverKey = 'SB-Mid-server-hKKCbFkFVSbkQZ6CAKsxUhT3';
\Midtrans\Config::$isProduction = false; // true jika production
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;
