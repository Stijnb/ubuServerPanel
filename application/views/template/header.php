<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="description" content="Reflect Template" />
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
		
        <title>Ubuntu Server - Index Page</title>
        
        <link rel="stylesheet" href="<?=base_url('/css/style.css');?>" type="text/css" media="screen" />
	</head>
	<body class="indexbody">
		
		<!-- Header Balk -->
		<div id="head">
			
			<!-- Header -->
			<div class="header">
				
				<img src="<?=base_url('images/icons/server.png');?>" alt="server" />
				<h3>Ubuntu Server</h3>
				
			</div>	
			
			<!-- Info User -->
			<div class="info">
				
				<p><b>Welkom,</b> <?=$this -> session -> userdata('Login_Username');?></p>
				
				<!-- Icons -->
				<div class="icons">
					
					<a href="#"><img src="<?=base_url('images/icons/home.png');?>" /></a>	
					
				</div>
				
				<div class="icons">
					
					<a href="#"><img src="<?=base_url('images/icons/folder.png');?>" /></a>
					
				</div>
				
				<div class="icons">
					
					<a href="#"><img src="<?=base_url('images/icons/monitor.png');?>" /></a>
					
				</div>
				
				<div class="icons">
					
					<a href="#"><img src="<?=base_url('images/icons/settings.png');?>" /></a>
					
				</div>
				
				<div class="icons">
					
					<a href="<?=site_url('frontpage/uitloggen');?>"><img src="<?=base_url('images/icons/logout.png');?>" /></a>
					
				</div>
				
			</div>
			
		</div>
		
		<!-- Sidebar -->
		<div id="sidebar">
			
			<!-- Gebruikers -->
			<div class="header">
				
				<img src="<?=base_url('images/icons/users.png');?>" />
				
				<h3>Gebruikers</h3>
				
			</div>
			
			<div class="linelight">
				
				<?=anchor('/gebruikers/index', 'Gebruikerslijst')?>
				
			</div>
			
			<div class="linedark">
				
				<?=anchor('/gebruikers/aanmaken', 'Aanmaken')?>
				
			</div>
			
			<!-- FTP Gebruikers -->
			<div class="header">
				
				<img src="<?=base_url('images/icons/remove.png');?>" />
				
				<h3>FTP Server</h3>
				
			</div>
			
			<div class="linelight">
				
				<a href="#">Gebruikerslijst</a>
				
			</div>
			
			<div class="linedark">
				
				<a href="#">Aanmaken</a>
				
			</div>
			
			<!-- Bestanden -->
			<div class="header">
				
				<img src="<?=base_url('images/icons/folder.png');?>" />
				
				<h3>Bestanden</h3>
				
			</div>
			
			<div class="linelight">
				
				<a href="#">Home Folder</a>
				
			</div>
			
			<div class="linedark">
				
				<a href="#">Muziek</a>
				
			</div>
			
			<div class="linelight">
				
				<a href="#">Foto's</a>
				
			</div>
			
			<div class="linedark">
				
				<a href="#">Zoeken...</a>
				
			</div>
			
			<!-- Instellingen -->
			<div class="header">
				
				<img src="<?=base_url('images/icons/settings.png');?>" />
				
				<h3>Instellingen</h3>
				
			</div>
			
			<div class="linelight">
				
				<a href="#">Apache Server</a>
				
			</div>
			
			<div class="linedark">
				
				<a href="#">Samba Server</a>
				
			</div>
			
			<!-- Monitor -->	
			<div class="header">
				
				<img src="<?=base_url('images/icons/monitor.png');?>" />
				
				<h3>Monitor</h3>
				
			</div>
			
			<div class="linelight">
				
				<a href="#">PHP Logs</a>
				
			</div>
			
			<div class="linedark">
				
				<a href="#">Apache logs</a>
				
			</div>
			
		</div>
		
		<!-- BIG ICONS -->
		<table class="full">
			
			<tr>
				<td class="bg1" onmouseover="this.style.backgroundColor = '#376eba';" onmouseout="this.style.backgroundColor = '#7aa6e3';">
					<a href="#"><img class="center" src="<?=base_url('images/front/monitor.png');?>" /></a>		
					Monitor
				</td>
				<td class="bg2" onmouseover="this.style.backgroundColor = '#376eba';" onmouseout="this.style.backgroundColor = '#adcefb';">
					<a href="#"><img class="center" src="<?=base_url('images/front/documents.png');?>" /></a>
					Bestanden
				</td>
				<td class="bg1" onmouseover="this.style.backgroundColor = '#376eba';" onmouseout="this.style.backgroundColor = '#7aa6e3';">
					<a href="http://vmserver.stijnbourdeaux.com:9091"><img class="center" src="<?=base_url('images/front/transmission.png');?>" /></a>
					Downloaden</td>	
				<td class="bg2" onmouseover="this.style.backgroundColor = '#376eba';" onmouseout="this.style.backgroundColor = '#adcefb';">
					<a href="#"><img class="center" src="<?=base_url('images/front/settings.png');?>" /></a>
					Instellingen</td>
			</tr>
			
		</table>