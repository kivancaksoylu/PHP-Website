<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<link rel="stylesheet" href="./Stil.css">
	<script type="text/javascript" >
		
	</script>
<title>Blog</title>
</head>

<body>
	<?php
	
	try{
	require_once 'baglan.php';
    } catch (Exception $ex) {
	$error=$ex->getMessage();
    }

	include 'fonksiyonlar.php';
	
	$sesusername = $_SESSION['sesusername'];
	$sesrutbe = $_SESSION['sesrutbe'];
	
	$sorgu = $db_conn->query("select kisiselBilgi from izinler where kullaniciAdi ='$sesusername'");
	$string = mysqli_fetch_assoc($sorgu);
	$izin = $string['kisiselBilgi'];
	if($izin == "aktif")
	{
	$yazi = "Kullanıcı Bilgileri";
	$butonStil = " ";
	$buton2Stil = "display: none;";
	}
	else if($izin == "deaktif")
	{
	$yazi = "İzniniz Kaldırıldı";
	$butonStil = "display: none;";
	$buton2Stil = " ";
	}
				
	if($_POST['sifreDegistir'])
	{
		
		$password = $_POST['eskiSifre'];
		$newPassword = $_POST['yeniSifre'];
		
		$sorgu=$db_conn->query("select sifre from kullanicilar where kullaniciAdi ='$sesusername'");
		$newstring = mysqli_fetch_assoc($sorgu);
		$truePassword = $newstring['sifre'];
		
		if($password == $truePassword)
		{
			$sorgu=$db_conn->query("update kullanicilar set sifre='$newPassword' where kullaniciAdi='$sesusername'");
		}
		else
		{
			die("Eski şifrenizi doğru girmediniz.");
		}
		
		header("Location: indexPHP.php");
		
	}
	if($_POST['geri'])
	{
		header("Location: indexPHP.php");
	}
	
	?>
	
	<header>
	<div class="logo"><img alt="logoFoto" class="logoFoto" src="logo.png"/><div class="logoYazi">Kişisel Web Sitesi </div></div>
			
	</header>
	
	
	<orta>
		<div class="iletisimSayfa">
		<div class="baslik"><center><?php echo $yazi ?></center></div>
	   <div class="iletisim">
		   
		<form action="sifreDegistir.php" method="post">
		   <!-- mail gönderme kodunun kaynağı=https://www.w3schools.com/html/tryit.asp?filename=tryhtml_form_mail-->
			   
			<table>
				<tr>
				<th class="yazi">Eski Şifre:</th>
				   <th><input type="password" class="input" name="eskiSifre" ></th>
				</tr>
			   <tr>
				<th class="yazi">Yeni Şifre:</th>
				   <th><input type="password" class="input" name="yeniSifre" ></th>
				</tr>
			
			   </table>
			<center><input type="submit" class="submit" value="ŞİFREYİ DEĞİŞTİR" name="sifreDegistir" style="<?php echo $butonStil?>" ><input type="submit" class="submit" value="ANASAYFA" name="geri" style="<?php echo $buton2Stil?>" ></center>
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
