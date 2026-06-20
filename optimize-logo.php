<?php

// Script sekali pakai untuk mengecilkan public/logo.png dari 445x445 ke 128x128.
// Ukuran ini cukup tajam untuk header retina 2x dan apple-touch-icon.

$src = __DIR__ . '/public/logo.png';

if (! extension_loaded('gd')) {
    fwrite(STDERR, "Ekstensi GD tidak aktif. Aktifkan di php.ini lalu coba lagi.\n");
    exit(1);
}

$image = imagecreatefrompng($src);
if (! $image) {
    fwrite(STDERR, "Gagal membaca {$src}\n");
    exit(1);
}

$size = 128;
$resized = imagecreatetruecolor($size, $size);
imagealphablending($resized, false);
imagesavealpha($resized, true);
imagefill($resized, 0, 0, imagecolorallocatealpha($resized, 0, 0, 0, 127));

imagecopyresampled($resized, $image, 0, 0, 0, 0, $size, $size, imagesx($image), imagesy($image));
imagepng($resized, $src, 9);

imagedestroy($image);
imagedestroy($resized);

echo 'Selesai. Ukuran baru: ' . round(filesize($src) / 1024, 1) . " KiB ({$size}x{$size})\n";
