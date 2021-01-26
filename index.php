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

	error_reporting(0);
	
	$sorgu = $db_conn->query("select * from duyurular where durum = 'yeni'");
	$str = mysqli_fetch_assoc($sorgu);
	$baslik = $str["baslik"];
	$satir1= $str["satir1"];
	$satir2= $str["satir2"];
	$satir3= $str["satir3"];
	$satir4= $str["satir4"];
	$link = $str["link"];
	$linkyazi = $str["linkyazi"];
	
	?>
	
	<header>
	<div class="logo"><img alt="logoFoto" class="logoFoto" src="logo.png"/><div class="logoYazi">Kişisel Web Sitesi </div></div>
			<nav class="nav">
		<ul class="navLinkleri">
			<li><a class="navLink" href="misafir.php">MİSAFİR GİRİŞİ</a></li>
			<li><a class="navLink" href="kullaniciPHP.php">KULLANICI GİRİŞİ</a></li>
			<li><a class="navLink" href="yonetici.php">YÖNETİCİ GİRİŞİ</a></li>
			</ul>
		</nav>
		<nav class="kucukNav">
			<ul class="kucukNavLinkleri">
				<li><a href="misafir.php"><img alt="anaSayfaFoto" src="iletisim.png" class="anaSayfaFoto"></a></li>
				<li><a href="kullaniciPHP.php"><img alt="projelerimFoto" src="projelerim.png" class="projelerimFoto"></a></li>
				<li><a href="yonetici.php"><img alt="iletisimFoto" src="hakkimda.png" class="iletisimFoto"></a></li>
			</ul>
		</nav>
	</header>
	
	
	<orta>
	    <div class="slidershow">   <!-- Kaynak = https://www.youtube.com/watch?v=9Irz0c-6UGw-->
			<div class="slidershow2">	    <div class="slides">
			<input type="radio" name="r" id="r1" checked>
			<input type="radio" name="r" id="r2" >
			<input type="radio" name="r" id="r3" >
			<input type="radio" name="r" id="r4" >
			<input type="radio" name="r" id="r5" >
			<div class="slide s1">
			<img src="blender281_1.png" alt="">
			</div>
			<div class="slide s2">
			<img src="blender281_2.png" alt="">
			</div>
			<div class="slide s3">
			<img src="blender281_3.png" alt="">
			</div>
			<div class="slide s4">
			<img src="blender281_4.png" alt="">
			</div>
			<div class="slide s5">
			<img src="blender281_5.png" alt="">
			</div>
			</div></div>

			
			<div class="navigation">
				<label for="r1" class="bar"></label>
				<label for="r2" class="bar"></label>
				<label for="r3" class="bar"></label>
				<label for="r4" class="bar"></label>
				<label for="r5" class="bar"></label>
			
			</div>
		</div>
		<div class="haberYazi">
		<h1><?php echo $baslik?></h1>
			<p>
			 <?php echo $satir1?><br>
	         <?php echo $satir2?><br>
			 <?php echo $satir3?><br>
			 <?php echo $satir4?>	
			</p>
			<center><a href="<?php echo $link?>"><?php echo $linkyazi?></a></center>
		</div>
	</orta>
	
	
	<footer> 
		<div class="footerDiv"><a href="hakkimda.html">Kıvanç AKSOYLU</a></div>
		<div class="footerLogoar"><a href="https://www.instagram.com/kivancaksoylu/" target="_blank"><img src="instagramLogo.png" alt="instagram" class="instagram"></a></div> 
	</footer>
</body>
</html>
