<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<link rel="stylesheet" href="./Stil.css">
	<script type="text/javascript" src="./Script.js">
	</script>
<title>Blog</title>
</head>

<body style="background-image: url('lilmohorror 2.png'); background-size: 120% 130%;">
	
		<?php
	
	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

	error_reporting(0);
	
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
	
	$mail = new PHPMailer();
	
	$mail->isSMTP();
	$mail->SMTPKeepAlive = true;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'tls';
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;
	
	$mail->Username = "arzukaymaz786@gmail.com";
	$mail->Password = "kasminokhali";
	
	if($_POST['gonder'])
	{
		$name = $_POST['ad'];
		$email = $_POST['mail'];
		$message = $_POST['mesaj'];
		
		$mail->setFrom("arzukaymaz786@gmail.com","MY AUTHOR WEBSITE");
		
		$mailString = 'Name/Surname: '.$sesusername.', E-Mail Adress: '.$email.',  Mesaj: '.$message;
		
		$mail->Subject = 'Author Query' ;
		$mail->addAddress("kaveellilmohun.author@gmail.com");
		$mail->Body = $mailString;
		
		if(!$mail->Send()){
             echo "Mailer Error: ".$mail->ErrorInfo;
             } 
			 else {
                header("Location: index.html");
             }
		
	}

	?>
	
	<header>
	<div class="logo"><div class="logoYazi">Kaveel Lilmohun  YA & NA AUTHOR</div></div>
			<nav class="nav">
		<ul class="navLinkleri">
			<li><a class="navLink" href="index.html">HOME</a></li>
			<li><a class="navLink" href="about.html">ABOUT</a></li>
			<li><a class="navLink" href="iletisim.html">BOOKS</a></li>
			<li><a class="navLink" href="iletisim.html">FUTURE PROJECTS</a></li>
			<li><a class="navLink" href="contactUs.php">CONTACT US</a></li>
		
			</ul>
		</nav>
		<nav class="kucukNav">
			<ul class="kucukNavLinkleri">
				<li><a href="index.html"><img alt="anaSayfaFoto" src="anaSayfa.png" class="anaSayfaFoto"></a></li>
				<li><a href="proje.html"><img alt="projelerimFoto" src="projelerim.png" class="projelerimFoto"></a></li>
				<li><a href="iletisim.html"><img alt="iletisimFoto" src="iletisim.png" class="iletisimFoto"></a></li>
				<li><a href="hakkimda.html"><img alt="hakkimdaFoto" src="hakkimda.png" class="hakkimdaFoto"></a></li>
				<li><a href="#"><img alt="programlarFoto" src="programlarK.png" class="programlarFoto"></a>
					  <ul>
			      <li><a href="programlar.html" target="_blank"><img alt="blenderFoto" src="blenderLogo.png" class="blenderFoto"></a></li>
				   <li><a href="programlarUnity.html" target="_blank"><img alt="unityFoto" src="unityLogo.png" class="unityFoto"></a></li>
				   <li><a href="programlarSubstance.html" target="_blank"><img alt="substanceFoto" src="substanceLogo.png" class="substanceFoto"></a></li>
			  </ul>
				</li>
			</ul>
		</nav>
	</header>
	
	
	<orta> 
		<div style="width: 100%;">
			<center><form action="contactUs.php" method="post">		   
			<table>
			   <tr>
				<th class="contactWriting" >Name and Surname: </th>
				   <th><input type="text" class="input" name="ad" ></th>
				</tr>
				<tr></tr>
				<tr>
			<th class="contactWriting">E-Mail Adress:</th>
				   <th><input type="email" class="input" name="mail" ></th>
				</tr>
				<tr></tr>
			   <tr>
			<th class="contactWriting">Message:</th>
				   <th><textarea class="input" name="mesaj"></textarea></th>
				</tr>
				<tr></tr>
			   </table>
			<center><input type="submit" class="sendButton" value="SEND" name="gonder" ></center>
			</form></center>
		
		</div>
	</orta>
	
</body>
</html>
