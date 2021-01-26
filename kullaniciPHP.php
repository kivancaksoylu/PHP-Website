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
		$password= $_POST['sifre'];
		$rememberme= $_POST['beniHatirla'];
		
		if($username&&$password)
		{
			$sorgu = $db_conn->query("select * from kullanicilar where kullaniciAdi='$username'");
			while($row = mysqli_fetch_assoc($sorgu))
			{
				$db_password = $row['sifre'];
				if($password == $db_password)
				{
					$loginok = TRUE;
				}
				else{$loginok = FALSE;}
				
				if($loginok == TRUE)
				{
					if($rememberme=="on")
					{
						setcookie("username",$username,"password",$password,time()+3600);
						$_SESSION['sesusername']=$username;
						$_SESSION['sesrutbe'] ="kullanici";
						
					}
					else if($rememberme="")
					{
						$_SESSION['sesusername']=$username;
						$_SESSION['sesrutbe'] ="kullanici";
					}	
					$_SESSION['sesusername']=$username;
						$_SESSION['sesrutbe'] ="kullanici";
					header("Location: iletisimPHP.php");
					exit();
				}
				else
				{die("Geçersiz kulanıcı adı/şifre.");}
			}
		}
		else
			die("Lutfen kullanıcı adı ve şifre giriniz.");
		    
	}
	else if($_POST['kayit'])
	{
		header("Location: kayitol.php");
		exit();
	}
	else if($_POST['unuttum'])
	{
		header("Location: sifremiunuttum.php");
		exit();
	}
	if($_POST['geri']){header("Location: index.php");}
	$name =$_COOKIE['username'];
	$passwor= $_COOKIE['password'];
	?>
	
	<orta>
		<div class="iletisimSayfa">
		<div class="baslik"><center></center></div>
	   <div class="iletisim">
		   
		<form action="kullaniciPHP.php" method="post">
		   
			   
			<table>
			   <tr>
				<th class="yazi">Kullanıcı Adı:</th>
				   <th><input type="text" class="input" name="ad" value="<?php echo $name;?>"></th>
				</tr>
				<tr>
				<th class="yazi">Şifre:</th>
				   <th ><input type="password" class="input" name="sifre" value="<?php echo $passwor;?>"></th>
				</tr>
				<tr><th class="yazi" colspan="2">Beni Hatırla: <input type="checkbox" name="beniHatirla"> <input type="submit" class="submit" name="unuttum" value="SİFREMİ UNUTTUM"></th>
				</tr>
			   </table>
			<center><input type="submit" class="submit" name="giris" value="UYE GIRISI"><input type="submit" class="submit" name="kayit" value="UYE KAYDI" style="margin-left: 5px"></center>
			<center><input type="submit" class="submit" name="geri" value="GERİ"></center>
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
