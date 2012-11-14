		
		<!-- Content --> 
		<div id="content">
			
			<div class="header">Gebruiker Aanmaken</div>
			
			<div class="lineheader"></div>
			
			<?if($aanmaken):?>
			<?if( $this -> members -> error):?>
			<?foreach( $this -> members -> errorData as $field => $error):?>
			<div class="rowred">
			
				<div class="left"><?=$error?></div>
			
			</div>
			<?endforeach?>
			<?else:?>
			<div class="rowgreen">
			
				<div class="left">De gebruiker is succesvol aangemaakt.</div>
			
			</div>
			<?endif;?>
			<?endif;?>
			
			<form action="<?=site_url('/gebruikers/aanmaken')?>" method="post">
			<div class="rowdark">
			
				<div class="left"><a href="#">Gebruikersnaam:</a></div>
				<div class="center"><input type="text" name="username" value="" /></div>
			
			</div>
			
			<div class="rowlight">
				
				<div class="left">Wachtwoord:</div>
				<div class="center"><input type="password" name="password" value="" /></div>
				
			</div>
			
			<div class="rowdark">
			
				<div class="left">Wachtwoord(herhalen)</div>
				<div class="center"><input type="password" name="password_check" value="" /></div>
			
			</div>
			
			<div class="rowlight">
				
				<div class="left">E-mail adres:</div>
				<div class="center"><input type="text" name="email_adress" value="" /></div>
				
			</div>
			
			<div class="lineheader"></div>
			
			<div class="header">
				
				<input type="submit" name="aanmaken" value="Gebruiker aanmaken" />
				
			</div>
			</form>
		</div>
	</body>
</html>

