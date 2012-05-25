<h2>Modifier un tuner</h2>

<? if (isset($user_msg['status'])): ?>
	<div class="flashbox <?=$user_msg['status']?>">
		<? if ($user_msg['status'] == 'success' && $user_msg['type'] == 'form') echo "Le formulaire a &eacute;t&eacute; valid&eacute; avec succ&egrave;s.";?>
		<? if ($user_msg['status'] == 'error' && $user_msg['type'] == 'form') echo "Tous les champs du formulaire n'ont pas &eacute;t&eacute; remplis correctement.";?>
	</div>
<? endif; ?>



    <br/>
    <?=form_open('chaine/edit/'.$chaine->id.'/valid')?>
    <table class="form">
    	<tr>
    		<th>Nom</th>
    		<td><input type="text" name="name" value="<?=$chaine->name?>" /></td>
    	</tr>
    	<tr>
    		<th>IP multicast</th>
    		<td><input type="text" name="ip_multicast" size="15" maxlength="15" value="<?=$chaine->ip_multicast?>" /></td>
    	</tr>
    	<tr>
    		<th>Num service</th>
    		<td><input type="text" name="num_service" size="5" maxlength="5" value="<?=$chaine->num_service?>" /></td>
    	</tr>
    	<tr>
    		<th>PIDs</th>
    		<td><input type="text" name="pid" value="<?=$chaine->pid?>" /></td>
    	</tr>
    	<tr>
    		<th>Transpondeur</th>
    		<td>
    			<select name="tuner_id">
    				<option 
value="<?=$chaine->tuner_id?>"><?=$tuners2[$chaine->tuner_id]?></option>
    				<option disabled="disabled">---</option>
					<? foreach ($tuners as $tuner): ?>
					<option value="<?=$tuner->id?>">(#<?=$tuner->id?>) <?=$tuner->name?></option>
					<? endforeach; ?>
				</select>
    		</td>
    	</tr>
    	<tr>
    		<th>Active</th>
    		<td>
    			<select name="is_active">
    				<option value="<?=$chaine->is_active?>"><? if ($chaine->is_active == "0") { echo "Non"; } else { echo "Oui"; }?></option>
    				<option disabled="disabled">---</option>
    				<option value="0">Non</option>
    				<option value="1">Oui</option>
    			</select>
    		</td>
    	</tr>
    	<tr>
    		<td colspan="2"><input type="submit" value="Valider"/></td>
    	</tr>
    </table>
    <?=form_close()?>

