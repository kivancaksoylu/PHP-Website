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
	
	$gonderbutonsil = " ";
	$anasayfabutonstil = "display: none;";
	$izletisimizinyazi = "İletişim";
	
	$mail = new PHPMailer();
	
	$mail->isSMTP();
	$mail->SMTPKeepAlive = true;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'tls';
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;
	
	$mail->Username = "kisiselwebsitesika@gmail.com";
	$mail->Password = "webProje123";
	
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
	
	if($_SESSION['sesrutbe']=="kullanici")
	{
		$sorgu = $db_conn->query("select * from izinler where kullaniciAdi= '$sesusername'");
		$str = mysqli_fetch_assoc($sorgu);
		$izin = $str["mesaj"];
		if($izin == "deaktif")
		{
			$gonderbutonsil = "display: none;";
	        $anasayfabutonstil = " ";
			$izletisimizinyazi = "İzniniz Kaldırılmıştır";
		}
		
		$sorgu = $db_conn->query("select * from iletisim where kullaniciAdi= '$sesusername'");
		$str = mysqli_fetch_assoc($sorgu);
		$ad = $str["ad"];
		$soyad = $str["soyad"];
		$dogumT = $str["dt"];
		$telefon = $str["telefon"];
		$mail2 = $str["mail"];
		$mailmesaj = "Kullanici";
		$profilbutonstil = " ";
	}
	else
	{
		$profilbutonstil = "display: none;";
		$mailmesaj = "Misafir";
		$ad = "";
		$soyad = ""; 
		$dogumT = "";
		$telefon = "";
		$mail2 = "";
	}
	
	if($_POST['gonder'])
	{
		$name = $_POST['ad'];
		$surname = $_POST['soyad'];
		$birthdate=$_POST['dt'];
		$cellno=$_POST['telno'];
		$email = $_POST['mail'];
		$message = $_POST['mesaj'];
		$mail->setFrom("kisiselwebsitesika@gmail.com","WebSitesi");
		
		if($_SESSION['sesrutbe']=="misafir")
		{
			$sorgu=$db_conn->query("insert into misafirIletisim (kullaniciAdi,ad,soyad,dt,telefon,mail) values ('$sesusername','$name','$surname','$birthdate','$cellno','$email')");
		}
	
		$sorgu=$db_conn->query("insert into mailler (kullaniciTipi,kullaniciAdi,ad,soyad,dt,telefon,mail,mesaj) values ('$sesrutbe','$sesusername','$name','$surname','$birthdate','$cellno','$email','$message')");
		
		$mailString = 'Kullanici Tipi: '.$sesrutbe.', Kullanici Adi: '.$sesusername.', Ad: '.$name.', Soyad: '.$surname.', Dogum Tarihi: '.$birthdate.', TelNo: '.$cellno.', E-Mail Adresi: '.$email.',  Mesaj: '.$message;
		
		$mail->Subject = $mailmesaj;
		$mail->addAddress("aksoylukivanc@hotmail.com");
		$mail->Body = $mailString;
		
		if(!$mail->Send()){
             echo "Mailer Error: ".$mail->ErrorInfo;
             } 
			 else {
                header("Location: indexPHP.php");
             }
		
	}
	if($_POST['profil'])
	{
		header("Location: profil.php");
	}
	if($_POST['anasayfa'])
	{
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
		<div class="baslik"><center><?php echo $izletisimizinyazi ?></center></div>
	   <div class="iletisim">
		   
		<form action="iletisimPHP.php" method="post">
		   <!-- mail gönderme kodunun kaynağı=https://www.w3schools.com/html/tryit.asp?filename=tryhtml_form_mail-->
			   
			<table style="<?php echo $gonderbutonsil?>">
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
			   <tr>
			<th class="yazi">Mesaj:</th>
				   <th><textarea name="mesaj"></textarea></th>
				</tr>
				
			   </table>
			<center><input type="submit" class="submit" value="GÖNDER" name="gonder" style="<?php echo $gonderbutonsil?>"><input type="submit" class="submit" value="PROFİL" name="profil" style=" margin-right: 5px; <?php echo $profilbutonstil?>"><input type="submit" class="submit" value="ANASAYFA" name="anasayfa" style="<?php echo $anasayfabutonstil?>"></center>
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
