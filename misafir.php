<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<link rel="stylesheet" href="./Stil.css">
	<script type="text/javascript" >
		
	</script>
<title>Blog</title>
</head>

	<!--login, beni hatirla, üye ol: https://www.youtube.com/watch?v=hdZuhlQ88e8&t=363s -->
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
	
	if($_POST['giris'])
	{
		$username= $_POST['ad'];
		
		if($username)
		{
			$sorgu = $db_conn->query("select * from misafiriletisim where kullaniciAdi='$username'");
			while($row = mysqli_fetch_assoc($sorgu))
			{
				$db_username = $row["kullaniciAdi"];
				if($username == $db_username)
				{
					die("Girdiğiniz misafir kullanıcı adı zaten mevcut, lütfen başka bir kullanııc adı deneyiniz.");
				}
			}
			
			$_SESSION['sesusername']=$username;
			$_SESSION['sesrutbe'] ="misafir";	
			header("Location: indexPHP.php");
			exit();
		}
		else
			die("Lutfen kullanıcı adı giriniz.");
		    
	}
	if($_POST['geri']){header("Location: index.php");}
	?>
	
	<orta>
		<div class="iletisimSayfa">
		<div class="baslik"><center></center></div>
	   <div class="iletisim">
		   
		<form action="misafir.php" method="post">
		   
			   
			<table>
			   <tr>
				<th class="yazi">Kullanıcı Adı:</th>
				   <th><input type="text" class="input" name="ad"></th>
				</tr>
			   </table>
			<center><input type="submit" class="submit" name="geri" value="GERİ" style="margin-right: 5px;"><input type="submit" class="submit" name="giris" value="GİRİŞ"></center>
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
