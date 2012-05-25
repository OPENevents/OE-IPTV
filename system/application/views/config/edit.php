<h2>Modifier un param&egrave;tre</h2>

<? if (isset($user_msg['status'])): ?>
	<div class="flashbox <?=$user_msg['status']?>">
		<? if ($user_msg['status'] == 'success' && $user_msg['type'] == 'form') echo "Le formulaire a &eacute;t&eacute; valid&eacute; avec succ&egrave;s.";?>
		<? if ($user_msg['status'] == 'error' && $user_msg['type'] == 'form') echo "Tous les champs du formulaire n'ont pas &eacute;t&eacute; remplis correctement.";?>
	</div>
<? endif; ?>



    <br/>
    <?=form_open('config/edit/'.$config->id.'/valid')?>
    <table class="form">
    	<tr>
    		<th>Param&egrave;tre</th>
    		<td><?=$config->name?></td>
    	</tr>
    	<tr>
    		<th>Valeur</th>
    		<td><input type="text" name="value" value="<?=$config->value?>" /></td>
    	</tr>
    	<tr>
    		<td colspan="2"><input type="submit" value="Valider"/></td>
    	</tr>
    </table>
    <?=form_close()?>

