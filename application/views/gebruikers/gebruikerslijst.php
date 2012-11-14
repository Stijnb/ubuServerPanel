		
		<!-- Content --> 
		<div id="content">
			
			<div class="header">Gebruikers Lijst</div>
			
			<div class="lineheader"></div>
		
			<?if( $this -> members -> memberList() -> num_rows() > 0 ):?>
			<div class="header">
				
				<?foreach($this -> members -> memberListConfig as $name => $dbName):?>
				
					<?if($dbName == 'ID'):?>
						
						<div class="left" style="width: 40px"><?=$name?></div>
					
					<?else:?>
					
						<div class="left" style="width: 25%"><?=$name?></div>	
						
					<?endif?>
				
				<?endforeach;?>

			</div>
			
			<div class="lineheader"></div>
			
			<?foreach($this -> members -> memberList() -> result_array() as $row):?>
			
				<div class="row<?=$classCount++ % 2 ? 'dark' : 'light'?>">
					
					<?foreach($this -> members -> memberListConfig as $name => $dbName):?>
					
					<?if($dbName == 'ID'):?>
					
					<div class="left" style="width: 40px"><?=$row[$dbName]?></div>
					
					<?else:?>
					
					<div class="left" style="width: 25%"><?=$row[$dbName]?></div>
					
					<?endif?>
					<?endforeach?>
					
					<div class="center" style="width: 50px;">
						
						<a href="<?=site_url("/gebruikers/aanpassen/".$row['ID'])?>" ><img src="<?=base_url()?>images/icons/change.png" /></a>
						
					</div>
				
					<div class="center" style="width: 50px;">
						<a href="<?=site_url("/gebruikers/verwijderen")?>/<?=$row['ID']?>"><img src="<?=base_url()?>images/icons/delete.png" /></a>
							
					
					</div>
					
				</div>
				
			<?endforeach?>
			
			<?else:?>
			
			<div class="rowred">
			
				<div class="left">Er zijn geen gebruikers gevonden in de database</div>
			
			</div>
			
			<?endif?>
			
			<div class="lineheader"></div>
			
			<div class="header">
				
			</div>
		</div>
	</body>
</html>

