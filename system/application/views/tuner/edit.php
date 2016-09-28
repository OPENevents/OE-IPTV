<h2>Modifier un transpondeur</h2>


<?php if (isset($user_msg['status'])): ?>
	<div class="flashbox <?=$user_msg['status']?>">
		<?php if ($user_msg['status'] == 'success' && $user_msg['type'] == 'form') echo "Le formulaire a &eacute;t&eacute; valid&eacute; avec succ&egrave;s.";?>
		<?php if ($user_msg['status'] == 'error' && $user_msg['type'] == 'form') echo "Tous les champs du formulaire n'ont pas &eacute;t&eacute; remplis correctement.";?>
	</div>
<?php endif; ?>



    <br/>
    <?=form_open('tuner/edit/'.$tuner->id.'/valid')?>
    <table class="form">
    	<tr>
    		<th>Nom</th>
    		<td><input type="text" name="name" value="<?=$tuner->name?>" /></td>
    	</tr>
    	<tr>
    		<th>Num carte</th>
    		<td><input type="text" name="num_card" size="3" maxlength="3" value="<?=$tuner->num_card?>" /></td>
    	</tr>
    	<tr>
    		<th>Fr&eacute;quence</th>
    		<td><input type="text" name="frequence_transponder" size="8" maxlength="10" value="<?=$tuner->frequence_transponder?>" /></td>
    	</tr>
    	<tr>
    		<th>Actif</th>
    		<td>
    			<select name="is_active">
    				<option value="<?=$tuner->is_active?>"><?php if ($tuner->is_active == "0") { echo "Non"; } else { echo "Oui"; }?></option>
    				<option disabled="disabled">---</option>
    				<option value="0">Non</option>
    				<option value="1">Oui</option>
    			</select>
    		</td>
    	</tr>
    	<tr>
    		<th>Tuner Satellite</th>
    		<td><input type="checkbox" id="DVBS" name="DVBS" <?php if ($tuner->polarite != null) echo 'checked="checked"';?> onclick="javascript:$('.options').toggle();"/></td>
    	</tr>

    	<tr class="options">
    		<th>Polarit&eacute;</th>
    		<td>
    			<select name="polarite">
    				<option value="<?=$tuner->polarite?>"><?=$tuner->polarite?></option>
    				<option disabled="disabled">---</option>
    				<option value="Horizontal">Horizontal</option>
    				<option value="Vertical">Vertical</option>
    			</select>
    		</td>
    	</tr>
    	<tr class="options">
    		<th>Srate</th>
    		<td>
    			<select name="srate">
    				<option value="<?=$tuner->srate?>"><?=$tuner->srate?></option>
    				<option disabled="disabled">---</option>
    				<option value="22000">22000</option>
    				<option value="27500">27500</option>
				<option value="29900">29900</option>
    			</select>
    		</td>
    	</tr>
    	<tr class="options">
    		<th>Coderate</th>
    		<td>
    			<select name="coderate">
    				<option value="<?=$tuner->coderate?>"><?=$tuner->coderate?></option>
    				<option disabled="disabled">---</option>
    				<option value="auto">Auto</option>
    				<option value="none">None</option>
    				<option value="1/2">1/2</option>
    				<option value="2/3">2/3</option>
    				<option value="3/4">3/4</option>
    				<option value="4/5">4/5</option>
    				<option value="5/6">5/6</option>
    				<option value="6/7">6/7</option>
    				<option value="7/8">7/8</option>
    				<option value="8/9">8/9</option>
    			</select>
    		</td>
    	</tr>
    	<tr class="options">
    		<th>Modulation</th>
    		<td>
    			<select name="modulation">
    				<option value="<?=$tuner->modulation?>"><?=$tuner->modulation?></option>
    				<option disabled="disabled">---</option>
    				<option value="QPSK">QPSK</option>
    				<option value="8PSK">8PSK</option>
    			</select>
    		</td>
    	</tr>
    	<tr class="options">
    		<th>DVB-S2 <input type="checkbox" name="dvb_s2"  <?php if ($tuner->dvb_s2 == 1) echo 'checked="checked"';?>/></th>
    		<th>DVR <input type="checkbox" name="dvr"  <?php if ($tuner->dvr == 1) echo 'checked="checked"';?>/></th>
    	</tr>
    	<tr>
    		<td colspan="2"><input type="submit" value="Valider"/></td>
    	</tr>
    </table>
    <?=form_close()?>
    	
<script>
if ($('#DVBS').attr('checked') == true) {
	$('.options').toggle();
}
</script>
