<?php
require_once __DIR__ . '/config.php';
function site_header(string $title = 'KostService'): void { ?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><meta name="theme-color" content="#075bd8"><title><?= e($title) ?> | KostService</title><link rel="stylesheet" href="style.css"></head><body>
<header class="top"><a class="logo" href="index.php"><span class="logo-icon">⌂</span><span><b>Kost<span>Service</span></b><small>Solusi Praktis untuk Semua Kebutuhan Anak Kos</small></span></a><button class="menu-toggle" onclick="document.querySelector('.nav').classList.toggle('open')">☰</button><nav class="nav"><a href="index.php">Beranda</a><a href="layanan.php">Layanan</a><a href="harga.php">Harga</a><a href="tentang.php">Tentang Kami</a><a href="kontak.php">Kontak</a><a class="nav-cta" href="pesan.php">Pesan Sekarang</a></nav></header>
<main>
<?php }
function site_footer(): void { ?>
</main><footer class="footer"><div><a class="logo light" href="index.php"><span class="logo-icon">⌂</span><span><b>Kost<span>Service</span></b><small>Solusi Praktis untuk Semua Kebutuhan Anak Kos</small></span></a><p>Solusi praktis untuk kamar kos yang lebih bersih, nyaman, dan terawat.</p></div><div><b>Navigasi</b><a href="layanan.php">Layanan</a><a href="harga.php">Harga</a><a href="tentang.php">Tentang Kami</a><a href="kontak.php">Kontak</a></div><div><b>Hubungi Kami</b><p>WhatsApp: 0821-1493-3545</p><a href="<?= e(wa_link('Halo KostService, saya ingin bertanya tentang layanan.')) ?>" target="_blank" rel="noopener">Chat WhatsApp →</a><a href="admin/login.php">Login Admin</a></div><small class="copyright">© <?= date('Y') ?> KostService. Semua Hak Dilindungi.</small></footer>
<script src="app.js"></script></body></html><?php }
