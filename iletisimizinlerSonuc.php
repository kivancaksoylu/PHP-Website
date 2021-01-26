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
	
	if($sesrutbe == "admin")
	{
		$iletisimYazi = "İletişim/İzinler";
		$iletisimLink = "iletisimizinler.php";
		$projeStil = "display: none;";
		$eklelinkyazi = "Yeni Duyuru Ekle";
		$eklelinklink = "duyuruekle.php";
		$eklelinkstyle = " ";
	}
	else if($sesrutbe == "kullanici")
	{
		$iletisimYazi = "İletişim/Profil";
		$iletisimLink = "iletisimPHP.php";
		$projeStil = " ";
		$eklelinkyazi = "Eski Duyuruları Gör";
		$eklelinklink = "eskiduyurular.php";
		$eklelinkstyle = " ";
	}
	else
	{
			$iletisimYazi = "İletişim";
		$iletisimLink = "iletisimPHP.php";
		$projeStil = " ";
		$eklelinkyazi = "Eski Duyuruları Gör";
		$eklelinklink = "eskiduyurular.php";
		$eklelinkstyle = "display: none;";
	}
	
	if($sesrutbe!="admin")
	{
		$sayfa = "display: none;";
		$yazi = "Buraya Giriş İzniniz Yoktur";
	}
	else
	{
		$sayfa = " ";
		$yazi = "İletişim/İzinler";
	}
	
    if($_POST['goruntuleM'])
	{
		$checkstil = "display: none;";
		$id = $_POST['gizli'];
		$sorgu = $db_conn->query("select * from misafiriletisim where id = '$id'");
		$str = mysqli_fetch_assoc($sorgu);
		$username = $str["kullaniciAdi"];
		$name = $str["ad"];
		$surname = $str["soyad"];
		$birthdate = $str["dt"];
		$cellno = $str["telefon"];
		$email = $str["mail"];
	}
	if($_POST['goruntuleK'])
	{
		$id = $_POST['gizli'];
		$sorgu = $db_conn->query("select * from kullanicilar where id = '$id'");
		$str = mysqli_fetch_assoc($sorgu);
		$username = $str["kullaniciAdi"];
		$sorgu = $db_conn->query("select * from iletisim where kullaniciAdi='$username'");
		$str = mysqli_fetch_assoc($sorgu);
		$name = $str["ad"];
		$surname = $str["soyad"];
		$birthdate = $str["dt"];
		$cellno = $str["telefon"];
		$email = $str["mail"];
		$sorgu = $db_conn->query("select * from izinler where kullaniciAdi = '$username'");
		$str = mysqli_fetch_assoc($sorgu);
		$mesajizin = $str["mesaj"];
		$eskiizin = $str["eskiDuyurular"];
		$kisiselizin = $str["kisiselBilgi"];	
		$checkstil = " ";
		$checkmesaj = " ";
		$checkgecmis = " ";
		$checkprofil = " ";
		if($mesajizin == "aktif"){$checkmesaj = "checked";}
		if($eskiizin == "aktif"){$checkgecmis = "checked";}
		if($kisiselizin == "aktif"){$checkprofil = "checked";}
	}
	if($_POST['gonder'])
	{
	    $usernamegonder = $_POST['kullaniciAd'];
		$izinmesaj = $_POST['mesajGonder'];
		$izinprofil = $_POST['profilAyar'];
		$izingecmis = $_POST['gecmisDuyurular'];
		$sorgu = $db_conn->query("update izinler set mesaj='deaktif',eskiDuyurular='deaktif',kisiselBilgi='deaktif' where kullaniciAdi = '$usernamegonder'");
		if($izinmesaj == "on"){$sorgu = $db_conn->query("update izinler set mesaj='aktif' where kullaniciAdi = '$usernamegonder'");}
		if($izinprofil == "on"){$sorgu = $db_conn->query("update izinler set kisiselBilgi='aktif' where kullaniciAdi = '$usernamegonder'");}
		if($izingecmis == "on"){$sorgu = $db_conn->query("update izinler set eskiDuyurular='aktif' where kullaniciAdi = '$usernamegonder'");}
		header("Location: indexPHP.php");
	}
	
	?>
	
	<header>
	<div class="logo"><img alt="logoFoto" class="logoFoto" src="logo.png"/><div class="logoYazi">Kişisel Web Sitesi </div></div>
			<nav class="nav">
		<ul class="navLinkleri">
			<li><a class="navLink" href="indexPHP.php">Anasayfa</a></li>
			<li style="<?php echo $projeStil?>"><a class="navLink" href="projePHP.php">Projelerim</a></li>
			<li><a class="navLink" href="<?php echo $iletisimLink ?>"><?php echo $iletisimYazi?></a></li>
			<li><a class="navLink" href="hakkimdaPHP.php">Hakkımda</a></li>
			<li><a class="navLink" href="cikis.php">Çıkış</a></li>
		    <li><a class="navLink" href="#">Kullandığım Programlar</a> <!-- Drop down list kodlarının tamamının alındığı yer = https://www.youtube.com/watch?v=rgUp302f_lY-->
			  <ul>
			      <li><a href="programlarPHP.php" target="_blank"><center>Blender</center></a></li>
				   <li><a href="programlarUnityPHP.php" target="_blank"><center>Unity</center></a></li>
				   <li><a href="programlarSubstancePHP.php" target="_blank"><center>Substance Painter</center></a></li>
			  </ul>
			</li>
			</ul>
		</nav>
		<nav class="kucukNav">
			<ul class="kucukNavLinkleri">
				<li><a href="indexPHP.php"><img alt="anaSayfaFoto" src="anaSayfa.png" class="anaSayfaFoto"></a></li>
				<li style="<?php echo $projeStil?>"><a href="projePHP.php"><img alt="projelerimFoto" src="projelerim.png" class="projelerimFoto"></a></li>
				<li><a href="<?php echo $iletisimLink ?>"><img alt="iletisimFoto" src="iletisim.png" class="iletisimFoto"></a></li>
				<li><a href="hakkimdaPHP.php"><img alt="hakkimdaFoto" src="hakkimda.png" class="hakkimdaFoto"></a></li>
				<li><a href="cikis.php"><img alt="hakkimdaFoto" src="cikis.png" class="hakkimdaFoto"></a></li>
				<li><a href="#"><img alt="programlarFoto" src="programlarK.png" class="programlarFoto"></a>
					  <ul>
			      <li><a href="programlarPHP.php" target="_blank"><img alt="blenderFoto" src="blenderLogo.png" class="blenderFoto"></a></li>
				   <li><a href="programlarUnityPHP.php" target="_blank"><img alt="unityFoto" src="unityLogo.png" class="unityFoto"></a></li>
				   <li><a href="programlarSubstancePHP.php" target="_blank"><img alt="substanceFoto" src="substanceLogo.png" class="substanceFoto"></a></li>
			  </ul>
				</li>
			</ul>
		</nav>
	</header>
	
	
	<orta>
		<div class="iletisimSayfa">
		<div class="baslik"><center><?php echo $yazi?></center></div>
	   <div class="iletisim">
		   
		<form action="iletisimizinlerSonuc.php" method="post" style="<?php echo $sayfa?>">
		   <!-- mail gönderme kodunun kaynağı=https://www.w3schools.com/html/tryit.asp?filename=tryhtml_form_mail-->
			   
			<table>
				<tr>
				<th class="yazi">Kullanıcı Adı:</th>
				   <th><input type="text" class="input" name="kullaniciAd" value="<?php echo $username?>" readonly></th>
				</tr>
			   <tr>
				<th class="yazi">Ad:</th>
				   <th><input type="text" class="input" name="ad" value="<?php echo $name?>" readonly></th>
				</tr>
				<tr>
				<th class="yazi">Soyad:</th>
				   <th ><input type="text" class="input" name="soyad" value="<?php echo $surname?>" readonly></th>
				</tr>
				<tr>
				<th class="yazi">Doğum<br>Tarihi:</th>
				   <th><input type="date" class="input" name="dt" value="<?php echo $birthdate?>" readonly></th>
				</tr>
			   <tr>
			   <th class="yazi">Telefon:</th>
				   <th><input id="telNo" type="text" class="input" name="telno" value="<?php echo $cellno?>" readonly></th>
				</tr>
			   <tr>
			<th class="yazi">Mail:</th>
				   <th><input type="email" class="input" name="mail" value="<?php echo $email?>" readonly></th>
				</tr>
			<tr style="<?php echo $checkstil?>" ><th class="yazi" colspan="2">Profil Ayarı İzni: <input type="checkbox" name="profilAyar" <?php echo $checkprofil?>> </th></tr>
				<tr style="<?php echo $checkstil?>"><th class="yazi" colspan="2">Mesaj Gönderme İzni: <input type="checkbox" name="mesajGonder" <?php echo $checkmesaj?>> </th></tr>
					<tr style="<?php echo $checkstil?>"><th class="yazi" colspan="2">Geçmiş Duyuruları Görebilme: <input type="checkbox" name="gecmisDuyurular" <?php echo $checkgecmis?>> </th></tr>
			   </table>
			<center><input type="submit" class="submit" value="TAMAMLA" name="gonder"></center>
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
