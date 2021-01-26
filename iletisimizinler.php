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
	
	if($sesrutbe = "admin")
	{
		$izinYazi = "Kullanicilar/Misafirler";
		$izinStil = " ";
	}
	else
	{
		$izinYazi = "Buraya Giriş İzniniz Yoktur";
		$izinStil = "display: none;";
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
		<div class="baslik"><center><?php echo $izinYazi ?></center></div>
	   <div class="iletisim" style="<?php echo $izinStil ?>">
		   <div style=" max-height: 200px;  overflow-y: auto;"><table border="1" style="margin: 10px; text-align: center;" >
<thead style="color: #777777;">
<tr>
<th>ID</th><th>Kullanıcı Adı</th><th>İşlem</th>
</tr>
</thead>
<tbody style="color: #777777;">
<?php
$sorgu = $db_conn->query("SELECT * FROM kullanicilar");
while ($sonuc = $sorgu->fetch_assoc()) { 
$id = $sonuc['id'];
$ad = $sonuc['kullaniciAdi'];
?>
<tr>
<td><?php echo $id;?></td>
<td><?php echo $ad; ?></td>
	<form action="iletisimizinlerSonuc.php" method="post" name="form2" id="form2">
<td><input type="submit" name="goruntuleK" value="GÖRÜNTÜLE" id="<?php echo $id;?>"></td>
		<td style="border: none;display: none"><input type="hidden" name="gizli" value="<?php echo $id;?>"></td>
	</form>
	  
</tr>
<?php 
} 
?>
	<?php 
	if(isset($_POST['Sil']))
	{
		
		$key = $_POST['gizli'];
		$queryDelete = $db_conn->query("DELETE from bilgilerim where id = '$key' ");
		header("Refresh:0");
	}
	?>
</tr>
</tbody>
</table></div>
	
		
		
		<div style="max-height: 200px; overflow-y: auto;">	<table border="1" style="margin: 10px; text-align: center;" >
<thead style="color: #777777;">
<tr>
<th>ID</th><th>Misafir Adı</th><th>İşlem</th>
</tr>
</thead>
<tbody style="color: #777777;">
<?php
$sorgu = $db_conn->query("SELECT * FROM misafiriletisim");
while ($sonuc = $sorgu->fetch_assoc()) { 
$id = $sonuc['id'];
$ad = $sonuc['kullaniciAdi'];
?>
<tr>
<td><?php echo $id;?></td>
<td><?php echo $ad; ?></td>
	<form action="iletisimizinlerSonuc.php" method="post" name="form2" id="form2">
<td><input type="submit" name="goruntuleM" value="GÖRÜNTÜLE" id="<?php echo $id;?>"></td>
		<td style="border: none;display: none"><input type="hidden" name="gizli" value="<?php echo $id;?>"></td>
	</form>
	    
</tr>
<?php 
} 
?>
	<?php 
	if(isset($_POST['Sil']))
	{
		
		$key = $_POST['gizli'];
		$queryDelete = $db_conn->query("DELETE from bilgilerim where id = '$key' ");
		header("Refresh:0");
	}
	?>
</tr>
</tbody>
</table></div>
	
			</div>
		</div>
	</orta>
	
	
	<footer> 
		<div class="footerDiv"><a href="hakkimda.html">Kıvanç AKSOYLU</a></div>
		<div class="footerLogoar"><a href="https://www.instagram.com/kivancaksoylu/" target="_blank"><img src="instagramLogo.png" alt="instagram" class="instagram"></a></div> 
	</footer>
</body>
</html>
