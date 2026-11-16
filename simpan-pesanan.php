<?php
require 'config.php'; verify_csrf();
if($_SERVER['REQUEST_METHOD']!=='POST'){header('Location: pesan.php');exit;}
$nama=trim($_POST['nama']??''); $tel=trim($_POST['telepon']??''); $alamat=trim($_POST['alamat']??''); $layanan=trim($_POST['layanan']??''); $tanggal=$_POST['tanggal']??''; $detail=trim($_POST['detail']??'');
$allowed=['Kost Cleaning','Kost Laundry','Kost Delivery','Kost Repair','Kost Care'];
if($nama===''||$tel===''||$alamat===''||!in_array($layanan,$allowed,true)||!preg_match('/^\d{4}-\d{2}-\d{2}$/',$tanggal)||$tanggal<date('Y-m-d')){header('Location: pesan.php?error=1');exit;}
try{
 $pdo=db(); $pdo->beginTransaction();
 $q=$pdo->prepare("SELECT id FROM customers WHERE phone=?");$q->execute([$tel]);$customer=$q->fetchColumn();
 if($customer){$pdo->prepare("UPDATE customers SET name=?,address=? WHERE id=?")->execute([$nama,$alamat,$customer]);$cid=(int)$customer;}
 else{$pdo->prepare("INSERT INTO customers(name,phone,address) VALUES(?,?,?)")->execute([$nama,$tel,$alamat]);$cid=(int)$pdo->lastInsertId();}
 $code='KS'.date('ymd').strtoupper(bin2hex(random_bytes(3)));
 $pdo->prepare("INSERT INTO orders(order_code,customer_id,service,service_date,details,status) VALUES(?,?,?,?,?,'Menunggu Konfirmasi')")->execute([$code,$cid,$layanan,$tanggal,$detail]);
 $pdo->commit();
 $_SESSION['last_order']=$code;
 header('Location: sukses.php?kode='.urlencode($code));exit;
}catch(Throwable $e){if(db()->inTransaction())db()->rollBack();http_response_code(500);exit('Pesanan belum dapat disimpan. Pastikan database sudah disiapkan.');}
