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
	
	if($_POST['gonder'])
	{
	$baslik = $_POST["baslik"];
	$satir1= $_POST["satir1"];
	$satir2= $_POST["satir2"];
	$satir3= $_POST["satir3"];
	$satir4= $_POST["satir4"];
	$link = $_POST["link"];
	$linkyazi = $_POST["linkyazi"];
	$date = date('Y/m/d');	
	
		$sorgu = $db_conn->query("update duyurular set durum = 'eski' where durum = 'yeni'");
		
		$sorgu = $db_conn->query("insert into duyurular (durum,tarih,baslik,satir1,satir2,satir3,satir4,link,linkyazi) values ('yeni','$date','$baslik','$satir1','$satir2','$satir3','$satir4','$link','$linkyazi')");
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
		<div class="baslik"><center>Duyuru Ekle</center></div>
	   <div class="iletisim">
		   
		<form action="duyuruekle.php" method="post">
		   	   
			<table>
			   <tr>
				<th class="yazi">Başlık:</th>
				   <th><input type="text" class="input" name="baslik"  maxlength="30"></th>
				</tr>
				<tr>
				<th class="yazi">Satır 1:</th>
				   <th><input type="text" class="input" name="satir1"  maxlength="70"></th>
				</tr>
				<tr>
				<th class="yazi">Satır 2:</th>
				   <th><input type="text" class="input" name="satir2"  maxlength="70"></th>
				</tr>
				<tr>
				<th class="yazi">Satır 3:</th>
				   <th><input type="text" class="input" name="satir3"  maxlength="70"></th>
				</tr>
				<tr>
				<th class="yazi">Satır 4:</th>
				   <th><input type="text" class="input" name="satir4"  maxlength="70"></th>
				</tr>
				<tr>
				<th class="yazi">Link :</th>
				   <th><input type="text" class="input" name="link"  maxlength="150"></th>
				</tr>
				<tr>
				<th class="yazi">L. Yazı :</th>
				   <th><input type="text" class="input" name="linkyazi" maxlength="70"></th>
				</tr>
				
			   </table>
			<center><input type="submit" class="submit" value="EKLE" name="gonder" > </center>
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
