<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<link rel="stylesheet" href="./Stil.css">
	<script type="text/javascript" src="./Script.js">
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
	
	$sesusername =$_SESSION['sesusername'];
	$sesrutbe =$_SESSION['sesrutbe'];
	
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
		$iletisimYazi = "İletişim";
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
	
	$sorgu = $db_conn->query("select * from izinler where kullaniciAdi= '$sesusername'");
		$str = mysqli_fetch_assoc($sorgu);
		$izin = $str["eskiDuyurular"];
	
		if($izin == "deaktif")
		{
			$izineski = " ";
			$izineskiyeni = "display: none;";
			$izletisimizinyazi = "Buraya Giriş İzniniz Kaldırılmıştır.";
		}
	else {
			$izineski = "display: none;";
			$izineskiyeni = " ";
			$izletisimizinyazi = " ";
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
		<div class="iletisimSayfa" style="<?php echo $izineski?>">
			<div class="baslik" style="<?php echo $izineski?>"><center><?php echo $izletisimizinyazi ?></center></div></div>
		
		 <div class="haberYazi" style="height: 400px; overflow-y:auto; <?php echo $izineskiyeni?>">
			
			<?php
            $sorgu = $db_conn->query("select * from duyurular where durum = 'eski'");
				while($str=$sorgu->fetch_assoc()){
					$baslik = $str["baslik"];
					$satir1 = $str["satir1"];
					$satir2 = $str["satir2"];
					$satir3 = $str["satir3"];
					$satir4 = $str["satir4"];
					$link = $str["link"];
					$linkyazi = $str["linkyazi"];
					$date = $str["tarih"];
					
				
	         ?>
		
		<h1><?php echo $baslik?></h1>
			<p>
			 <?php echo $satir1?><br>
	         <?php echo $satir2?><br>
			 <?php echo $satir3?><br>
			 <?php echo $satir4?>	
			</p>
			<center><a href="<?php echo $link?>"><?php echo $linkyazi?></a></center>
			<center><p style="margin-bottom: 20px">Duyurunun Yayınlandığı Tarih: <?php echo $date?></p></center>
			 
		
			<?php
				}
				 ?>
			
		</div>
	</orta>
	
	
	<footer> 
		<div class="footerDiv"><a href="hakkimda.html">Kıvanç AKSOYLU</a></div>
		<div class="footerLogoar"><a href="https://www.instagram.com/kivancaksoylu/" target="_blank"><img src="instagramLogo.png" alt="instagram" class="instagram"></a></div> 
	</footer>
</body>
</html>
