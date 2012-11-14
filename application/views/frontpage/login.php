<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		
 		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="description" content="Reflect Template" />
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
		
        <title>Ubuntu Server - Login Page</title>
        
        <link rel="stylesheet" href="<?=base_url('/css/style.css')?>" type="text/css" media="screen" />
	</head>
	<body id="loginbody">
		
		<div id="lcontainer">
			
			<h1>Inloggen</h1>
			
			<?if( !$inloggen):?>
			<?if(!$this -> members -> error):?>
			<div id="top_good">
				
				<p>U bent succesvol ingelogd.</p>
				<p><?=anchor('/frontpage/index/', 'Klik hier om verder te gaan.');?></p>
				
			</div>
			<?else:?>
			<div id="top_error">
				
				<p><?=$this -> members -> error_username?></p>
				<p><?=$this -> members -> error_password?></p>
				
			</div>
			<?endif;?>
			<?endif;?>
			<form action="<?=site_url('/frontpage/inloggen/');?>" method="post">
			<div id="login">
				
				<p>Gebruikersnaam:</p>
				<input type="text" name="username" value="" />
				<p>Wachtwoord:</p>
				<input type="password" name="password" value="" />
			
			</div>	
				
			<div id="bottom">
				
				<input type="submit" name="submit" class="input" value="Inloggen" />
				
			</div>
			
			</form>	
		</div>
	</body>
</html>