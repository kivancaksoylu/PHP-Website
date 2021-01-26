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
	
	
	if($_SESSION['sesrutbe']=="kullanici")
	{
		$sorgu = $db_conn->query("select * from iletisim where kullaniciAdi= '$sesusername'");
		$str = mysqli_fetch_assoc($sorgu);
		$kullaniciAdi = $str["kullaniciAdi"];
		$ad = $str["ad"];
		$soyad = $str["soyad"];
		$dogumT = $str["dt"];
		$telefon = $str["telefon"];
		$mail2 = $str["mail"];
	}
	else
	{
		$ad = "";
		$soyad = ""; 
		$dogumT = "";
		$telefon = "";
		$mail2 = "";
	}
			
	if($_POST['gonder'])
	{
		
		$username = $_POST['kullaniciAdi'];
		$name = $_POST['ad'];
		$surname = $_POST['soyad'];
		$birthdate=$_POST['dt'];
		$cellno=$_POST['telno'];
		$email = $_POST['mail'];
		
		$sorgu = $db_conn->query("select * from kullanicilar where kullaniciAdi='$username'");
			while($row = mysqli_fetch_assoc($sorgu))
			{
				$db_username = $row["kullaniciAdi"];
				if($username == $db_username && $username != $sesusername)
				{
					die("Girdiğiniz kullanıcı adı zaten mevcut, lütfen başka bir kullanııc adı deneyiniz.");
				}
			}
		
		$sorgu = $db_conn->query("update kullanicilar set kullaniciAdi = '$username' where kullaniciAdi = '$sesusername'");
		$sorgu = $db_conn->query("update mailler set kullaniciAdi = '$username' where kullaniciAdi = '$sesusername'");
		$sorgu = $db_conn->query("update izinler set kullaniciAdi = '$username' where kullaniciAdi = '$sesusername'");
		$sorgu = $db_conn->query("update iletisim set kullaniciAdi='$username', ad='$name', soyad='$surname', dt='$birthdate', telefon='$cellno', mail='$email' where kullaniciAdi = '$sesusername'");
		
		$_SESSION['sesusername'] = $username;
		header("Location: indexPHP.php");
		
	}
	if($_POST['sifreDegistir'])
	{
		header("Location: sifreDegistir.php");
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
		   
		<form action="profil.php" method="post">
		   <!-- mail gönderme kodunun kaynağı=https://www.w3schools.com/html/tryit.asp?filename=tryhtml_form_mail-->
			   
			<table>
				<tr>
				<th class="yazi">Kullanıcı Adı:</th>
				   <th><input type="text" class="input" name="kullaniciAdi" value="<?php echo $kullaniciAdi?>"></th>
				</tr>
			   <tr>
				<th class="yazi">Ad:</th>
				   <th><input type="text" class="input" name="ad" value="<?php echo $ad?>"></th>
				</tr>
				<tr>
				<th class="yazi">Soyad:</th>
				   <th ><input type="text" class="input" name="soyad" value="<?php echo $soyad?>"></th>
				</tr>
				<tr>
				<th class="yazi">Doğum<br>Tarihi:</th>
				   <th><input type="date" class="input" name="dt" value="<?php echo $dogumT?>"></th>
				</tr>
			   <tr>
			   <th class="yazi">Telefon:</th>
				   <th><input id="telNo" type="text" class="input" name="telno" value="<?php echo $telefon?>"></th>
				</tr>
			   <tr>
			<th class="yazi">Mail:</th>
				   <th><input type="email" class="input" name="mail" value="<?php echo $mail2?>"></th>
				</tr>
			   </table>
			<center><input type="submit" class="submit" value="KAYDET" name="gonder" style="<?php echo $butonStil?>"><input type="submit" class="submit" value="ŞİFRE DEĞİŞTİR" name="sifreDegistir" style="margin-left: 5px; <?php echo $butonStil?>" ><input type="submit" class="submit" value="ANASAYFA" name="geri" style="<?php echo $buton2Stil?>" ></center>
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
