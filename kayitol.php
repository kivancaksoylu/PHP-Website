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
	<header>
	<div class="logo"><img alt="logoFoto" class="logoFoto" src="logo.png"/><div class="logoYazi">Kişisel Web Sitesi </div></div>
	
	</header>
	
	<?php 
	
	try{
	require_once 'baglan.php';
    } catch (Exception $ex) {
	$error=$ex->getMessage();
    }

	include 'fonksiyonlar.php';
	
	if($_POST['kayitButon'])
	{
		$username = $_POST['kullaniciad'];
		$password = $_POST['sifre'];
		$name = $_POST['ad'];
		$surname = $_POST['soyad'];
		$birthdate = $_POST['dt'];
		$cellno = $_POST['telno'];
		$emailadress = $_POST['email'];
		$ayni = FALSE;
		
		if($username&&$password&&$name&&$surname&&$birthdate&&$cellno&&$emailadress)
		{
			$sorgu = $db_conn->query("select * from kullanicilar where kullaniciAdi='$username'");
			while($row = mysqli_fetch_assoc($sorgu))
			{
				$db_username = $row["kullaniciAdi"];
				if($username == $db_username)
				{
					die("Girdiğiniz kullanıcı adı zaten mevcut, lütfen başka bir kullanııc adı deneyiniz.");
				}
			}
			    $yenisorgu= $db_conn->query("insert into kullanicilar (kullaniciAdi,sifre) values ('$username','$password')");
				$yenisorgu= $db_conn->query("insert into iletisim (kullaniciAdi,ad,soyad,dt,telefon,mail) values ('$username','$name','$surname','$birthdate','$cellno','$emailadress')");
				$yenisorgu= $db_conn->query("insert into izinler (kullaniciAdi,mesaj,eskiDuyurular,kisiselBilgi) values ('$username','aktif','aktif','aktif')");
			header("Location: index.php");
		}
		else
		{
			die("Lütfen Tüm Bilgileri Eksiksiz Doldurunuz.");
		}
	}
	
	?>
	
	<orta>
		<div class="iletisimSayfa">
		<div class="baslik"><center>Kayıt Ol</center></div>
	   <div class="iletisim">
		   
		<form action="kayitol.php" method="post">
		   <!-- mail gönderme kodunun kaynağı=https://www.w3schools.com/html/tryit.asp?filename=tryhtml_form_mail-->
			   
			<table>
			   <tr>
				   <th class="yazi">Kullanıcı Adı:</th>
				   <th><input type="text" class="input" name="kullaniciad"></th>
				</tr>
				<th class="yazi">Şifre:</th>
				   <th><input type="password" class="input" name="sifre"></th>
				</tr>
				<th class="yazi">Ad:</th>
				   <th><input type="text" class="input" name="ad"></th>
				</tr>
				<tr>
				<th class="yazi">Soyad:</th>
				   <th ><input type="text" class="input" name="soyad"></th>
				</tr>
				<tr>
				<th class="yazi">Doğum<br>Tarihi:</th>
				   <th><input type="date" class="input" name="dt"></th>
				</tr>
			   <tr>
			   <th class="yazi">Telefon:</th>
				   <th><input id="telNo" type="text" class="input" name="telno"></th>
				</tr>
			   <tr>
			<th class="yazi">Mail:</th>
				   <th><input type="email" class="input" name="email"></th>
				</tr>
			   <tr>
			   </table>
			<center><input type="submit" class="submit" name="kayitButon" value="KAYIT OL"></center>
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
