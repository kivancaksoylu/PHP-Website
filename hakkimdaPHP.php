<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<link rel="stylesheet" href="./Stil.css">
    <script type="text/javascript" src="jsPDF/jsPDF-master/dist/jspdf.min.js"></script> <!-- pdf için bu iki kütüphane gereklidir kaynak= https://www.youtube.com/watch?v=0bSI9OgYcpQ-->
	<script type="text/javascript" src="jquery.js"></script>  
	<script type="text/javascript">	
		/*Düzenleme kodu*/
		/* https://www.youtube.com/watch?v=r-prr42brhI videosundan yardım alınmıştır*/
	  function duzenleFonk()
		{ 
			var gizli = document.getElementsByClassName("pdfFotoInsert");
			var gorunen = document.getElementsByClassName("pdfFotoBen");
			
			for(var i =0; i != gizli.length; i++)
			{
				gizli[i].style.display = "block";  /* Görünmeyen resmi göster*/
			}
			for(var i=0; i != gorunen.length; i++)
			{
				gorunen[i].style.display ="none";  /*Görünen resmi gizle*/
			}
			/*Editable yapma bölümü*/
			var edit = document.getElementsByClassName("pdfEdit");
			for(var i=0; i !=edit.length;i++)
			{
				edit[i].contentEditable = "true";
			}
			
		}
		/*Düzenleme kodu*/
		
		/*Pdf olarak kaydetme kodu*/
		/*Kodun tamamı burdan alınmıştır = https://www.youtube.com/watch?v=0bSI9OgYcpQ  */
        function pdfOlusturIndir()
		{
			var doc = new jsPDF();
			var ad = document.getElementById("pdfAd").innerHTML;
			var soyad = document.getElementById("pdfSoyad").innerHTML;
			var dt = document.getElementById("pdfYas").innerHTML;
			var numara = document.getElementById("pdfNumara").innerHTML;
			var email = document.getElementById("pdfEmail").innerHTML;
			var dy = document.getElementById("pdfDogumYeri").innerHTML;
			var ehliyet = document.getElementById("pdfEhliyet").innerHTML;
			var egitim = document.getElementById("pdfEgitim").innerHTML;
			var egitim2 = document.getElementById("pdfEgitim2").innerHTML;
		    var egitim3 = document.getElementById("pdfEgitim3").innerHTML;
			var egitim4 = document.getElementById("pdfEgitim4").innerHTML;
	  		var yazilim = document.getElementById("pdfYazilim").innerHTML;
	 		var yazilim2 = document.getElementById("pdfYazilim2").innerHTML;
			var yazilim3 = document.getElementById("pdfYazilim3").innerHTML;
			var adres = document.getElementById("pdfAdres").innerHTML;
			var adres2 = document.getElementById("pdfAdres2").innerHTML;
	        
			doc.text(10,20, ad);
			doc.text(10,30, soyad);
			doc.text(10,40, dt);
			doc.text(10,50, numara);
			doc.text(10,60, email);
			doc.text(10,70, dy);
			doc.text(10,80, ehliyet);
			doc.text(10,90, egitim);
		    doc.text(10,95, egitim2);
			doc.text(10,100, egitim3);
			doc.text(10,105, egitim4);
			doc.text(10,115, yazilim);
			doc.text(10,120, yazilim2);
		    doc.text(10,125, yazilim3);
			doc.text(10,135,  adres);
			doc.text(10,140, adres2);
			
			doc.save('documen.pdf');
		}
	    /*Pdf olarak kaydetme kodu*/
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
	
	if($_SESSION['sesrutbe'] == "admin")
	{
		$duzenlebuton = " ";
	}
	else { $duzenlebuton= "display: none; "; }
	
	if($_POST['duzenleAktif'])
	{
		$sorgu2 = $db_conn->query("select duzenle from hakkimda where id='1'");
		$str3 = mysqli_fetch_assoc($sorgu2);
	    $str4 = $str3["duzenle"];
		if($str4 == "deaktif")
		{
			$yeniSorgu = $db_conn->query("set sql_safe_updates = 0");
		    $yeniSorgu = $db_conn->query("update hakkimda set duzenle = 'aktif' where id ='1'");	
		}
		else
		{
			$yeniSorgu = $db_conn->query("set sql_safe_updates = 0");
		    $yeniSorgu = $db_conn->query("update hakkimda set duzenle = 'deaktif' where id ='1'");
		}
	}
	
	$sorgu = $db_conn->query("select duzenle from hakkimda where id='1'");
	$str = mysqli_fetch_assoc($sorgu);
	$str2 = $str["duzenle"];
	if($str2 == "deaktif"){$duzenle = "display: none;";}
	else{$duzenle = " ";}
	
	?>
	
	<div id="editor"></div>
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
		<div class="pdf">
		<div class="pdfAnaDiv" id="HTMLtoPDF">
			<div class="satir1"><div class="adSoyadYas">
			<div class="pdfEdit" contenteditable="false" id="pdfAd">Ad: Kivanc</div>
			 <div class="pdfEdit" contenteditable="false" id="pdfSoyad">Soyad: AKSOYLU</div>
			 <div class="pdfEdit" contenteditable="false" id="pdfYas">Dogum Tarihi: 14.10.1998</div>
				<div class="pdfEdit" contenteditable="false" id="pdfNumara">Numara: +905443757873</div>
				<div class="pdfEdit" contenteditable="false" id="pdfEmail">Email:aksoylukivanc@hotmail.com</div>
			</div>
			<div class="kisiFoto"><img src="insertPhoto.png" alt="" class="pdfFotoInsert"><img src="foto.jpg" alt="" class="pdfFotoBen"></div></div>
			<div class="satir2">
			<div class="pdfEdit" contenteditable="false" id="pdfDogumYeri">Dogum Yeri: Izmit</div>
				<div class="pdfEdit" contenteditable="false" id="pdfEhliyet">Ehliyet: B Sinifi</div>
				
			</div>
			<div class="satir3">
			<div class="pdfEdit" contenteditable="false" id="pdfEgitim">Egtim Bilgileri: </div>
				<div class="pdfEdit" id="pdfEgitim2" contenteditable="false"> 2017- : Kocaeli Universitesi</div>
				<div class="pdfEdit" contenteditable="false" id="pdfEgitim3"> 2012 - 2016: Yahyakaptan Anadolou Lisesi</div>
				<div class="pdfEdit" id="pdfEgitim4" contenteditable="false"> 2005 - 2012: Gazi Ilkogretim Okulu</div>
			</div>
			<div class="satir4">
			<div class="pdfEdit" contenteditable="false" id="pdfYazilim">Kullanabildigi Yazilimlar: </div>
				<div class="pdfEdit" contenteditable="false" id="pdfYazilim2" > Blender, Substance Painter, Unity,</div>
				<div class="pdfEdit" contenteditable="false" id="pdfYazilim3"> Microsoft Office, Android Studio</div>
			</div>
			<div class="satir5">
			<div class="pdfEdit" contenteditable="false" id="pdfAdres">Adres: Merkez Mah. Plevne Cad. </div>
				<div class="pdfEdit" contenteditable="false" id="pdfAdres2"> Degirmendere/Golcuk Kocaeli </div>
			</div>
		    </div>
		<center><div class="butonSatir"><form action="hakkimdaPHP.php" method="post"><input type="submit" name="duzenleAktif" value="Düzenle Aktif/İptal" style="<?php echo $duzenlebuton?>"></formn><input type="button" name="duzenle" value="Düzenle" style="<?php echo $duzenle?>" onClick="duzenleFonk()"> <input type="button" value="İndir" name="indir" id="indir" onClick="pdfOlusturIndir()"></div></center>
		</div>
	</orta>
	
	
	<footer> 
		<div class="footerDiv"><a href="hakkimda.html">Kıvanç AKSOYLU</a></div>
		<div class="footerLogoar"><a href="https://www.instagram.com/kivancaksoylu/" target="_blank"><img src="instagramLogo.png" alt="instagram" class="instagram"></a></div> 
	</footer>
</body>
</html>
