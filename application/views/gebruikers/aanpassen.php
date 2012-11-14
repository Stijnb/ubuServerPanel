		<!-- Content --> 
		<div id="content">
			
			<div class="header">Gebruikers Lijst</div>
			
			<div class="lineheader"></div>
			
			<?if( $form == 'send'):?>
			<?if( $this -> members -> error ):?>
			<?foreach($this -> members -> errorData as $field => $value):?>
			<div class="rowred">

				<div class="left"><?=$value?></div>
			
			</div>
			<?endforeach?>
			<?else:?>
			<div class="rowgreen">

				<div class="left">De gebruiker is aangepast.</div>
			
			</div>
			<?endif?>
			<?endif?>
			<form action="<?=site_url('/gebruikers/aanpassen/'.$this -> members -> id)?>" method="post">
			<?if($query -> num_rows() > 0):?>
			<?foreach($this -> members -> changeUserConfig as $name => $dbName):?>
			<div class="row<?=$classCount++ % 2 ? 'dark' : 'light'?>">
			
				<?foreach($query -> result_array() as $row ):?>
				
				<div class="left"><?=$name?></div>	
				<div class="left"><input type="text" name="<?=$dbName?>" value="<?=$row[$dbName]?>" /></div>
				
				<?endforeach?>
			</div>
			<?endforeach?>
			<?else:?>
			<div class="rowred">

				<div class="left">Gebruiker bestaad niet</div>
			
			</div>
			<?endif?>
						
			<div class="lineheader"></div>
			
			<div class="header"><input type="submit" name="aanpassen" value="Aanpassen" /></div>
			
			</form>
		</div>