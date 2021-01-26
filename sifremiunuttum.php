<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<link rel="stylesheet" href="./Stil.css">
	<script type="text/javascript" >
		
	</script>
<title>Blog</title>
</head>

	<!--login, beni hatirla, üye ol: https://www.youtube.com/watch?v=hdZuhlQ88e8&t=363s -->
<body>
	<header>
	<div class="logo"><img alt="logoFoto" class="logoFoto" src="logo.png"/><div class="logoYazi">Kişisel Web Sitesi </div></div>
	</header>
	
	<?php
	
	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
	
	try{
	require_once 'baglan.php';
    } catch (Exception $ex) {
	$error=$ex->getMessage();
    }

	include 'fonksiyonlar.php';
	
	$mail = new PHPMailer();
	
	$mail->isSMTP();
	$mail->SMTPKeepAlive = true;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'tls';
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;
	
	
	$mail->Username = "kisiselwebsitesika@gmail.com";
	$mail->Password = "webProje123";
	
	if($_POST['giris'])
	{
		$mail->setFrom("kisiselwebsitesika@gmail.com","Kıvanç");
		$username = $_POST['ad'];
		$yeniSifre= rand(1000,9999);
		
		if($username)
		{
			$sorgu = $db_conn->query("select mail from iletisim where kullaniciAdi = '$username'");
			$str= mysqli_fetch_assoc($sorgu);
			$str2 = $str["mail"];
			$mail->addAddress($str2);
			$mail->Subject = "Yeni Sifreniz";
			$mail->Body = $yeniSifre; 
			if(!$mail->Send()){
             echo "Mailer Error: ".$mail->ErrorInfo;
             } 
			 else {
				$yeniSorgu = $db_conn->query("update kullanicilar set sifre ='$yeniSifre' where kullaniciAdi='$username'");
                header("Location: index.php");
             }
		}
		else
		{
			die("Lütfen bir kullanıcı adı giriniz.");
		}
	}
	
	?>
	
	<orta>
		<div class="iletisimSayfa">
		<div class="baslik"><center></center></div>
	    <div class="iletisim">
		   
		<form action="sifremiunuttum.php" method="post">
		   
			   
			<table>
			   <tr>
				<th class="yazi">Kullanıcı Adı:</th>
				   <th><input type="text" class="input" name="ad"></th>
				</tr>
			   </table>
			<center><input type="submit" class="submit" name="giris" value="YENİ ŞİFRE GÖNDER"></center>
			</form>
			</div>
		</div>
	</orta>
	
	
	<footer> 
		<div class="footerDiv"><a href="hakkimda.html">Kıvanç AKSOYLU</a></div>
		<div class="footerLogoar"><a href="https://www.instagram.com/kivancaksoylu/" target="_blank"><img src="instagramLogo.png" alt="instagram" class="instagram"></a></div> 
	</footer>
</body>
</html>
