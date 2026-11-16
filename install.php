<?php
require 'config.php';
$message='';$done=false;
if($_SERVER['REQUEST_METHOD']==='POST'){
 verify_csrf();$username=trim($_POST['username']??'');$password=$_POST['password']??'';
 if(strlen($username)<4||strlen($password)<10){$message='Username minimal 4 karakter dan password minimal 10 karakter.';}
 else{
  try{
   $server=new PDO('mysql:host='.DB_HOST.';charset=utf8mb4',DB_USER,DB_PASS,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
   $server->exec("CREATE DATABASE IF NOT EXISTS `".str_replace('`','',DB_NAME)."` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
   $pdo=db();
   $pdo->exec("CREATE TABLE IF NOT EXISTS admins(id INT AUTO_INCREMENT PRIMARY KEY,username VARCHAR(60) NOT NULL UNIQUE,password_hash VARCHAR(255) NOT NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP) ENGINE=InnoDB");
   $pdo->exec("CREATE TABLE IF NOT EXISTS customers(id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(100) NOT NULL,phone VARCHAR(20) NOT NULL UNIQUE,address VARCHAR(255) NOT NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP) ENGINE=InnoDB");
   $pdo->exec("CREATE TABLE IF NOT EXISTS orders(id INT AUTO_INCREMENT PRIMARY KEY,order_code VARCHAR(30) NOT NULL UNIQUE,customer_id INT NOT NULL,service VARCHAR(60) NOT NULL,service_date DATE NOT NULL,details TEXT NULL,status ENUM('Menunggu Konfirmasi','Dikonfirmasi','Sedang Dikerjakan','Selesai','Dibatalkan') NOT NULL DEFAULT 'Menunggu Konfirmasi',created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,CONSTRAINT fk_orders_customer FOREIGN KEY(customer_id) REFERENCES customers(id) ON DELETE RESTRICT) ENGINE=InnoDB");
   $count=(int)$pdo->query("SELECT COUNT(*) FROM admins")->fetchColumn();
   if($count===0){$st=$pdo->prepare("INSERT INTO admins(username,password_hash) VALUES(?,?)");$st->execute([$username,password_hash($password,PASSWORD_DEFAULT)]);$message='Instalasi berhasil. Akun admin berhasil dibuat.';$done=true;}
   else{$message='Database sudah memiliki akun admin. Silakan login.';$done=true;}
  }catch(Throwable $e){$message='Gagal membuat database. Periksa pengaturan MySQL di config.php dan pastikan MySQL aktif. Detail: '.e($e->getMessage());}
 }
}
?><!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Instalasi KostService</title><link rel="stylesheet" href="style.css"></head><body><div class="auth"><div class="panel"><h1>Instalasi KostService</h1><p>Langkah pertama untuk membuat database dan akun admin.</p><?php if($message): ?><div class="notice"><?= e($message) ?></div><?php endif; ?><?php if(!$done): ?><form method="post"><input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>"><div class="field"><label>Username admin</label><input name="username" required minlength="4"></div><div class="field"><label>Password admin (minimal 10 karakter)</label><input type="password" name="password" required minlength="10"></div><button class="btn">Buat Database & Admin</button></form><?php else: ?><a class="btn" href="admin/login.php">Lanjut ke Login Admin</a><?php endif; ?><p class="note">Setelah instalasi berhasil, hapus atau ubah nama file install.php demi keamanan.</p><p><a href="index.php">← Kembali ke website</a></p></div></div></body></html>
