<h2>Chaines</h2>
<div class="no-print">
	<a href="javascript:window.print();"><img src="<?=base_url()?>/css/icon/print.png"/> Imprimer la page</a>&nbsp;&nbsp;&nbsp;&nbsp;
	<!-- <a href="#"><img src="<?=base_url()?>/css/icon/excel.png"/> Exporter au format CSV</a> -->
</div>
<br />
<!--
<?php if (isset($user_msg['status'])): ?>
	<div class="flashbox <?=$user_msg['status']?>">
		<?php if ($user_msg['status'] == 'success' && $user_msg['type'] == 'form') echo "Le formulaire a &eacute;t&eacute; valid&eacute; avec 
succ&egrave;s.";?>
		<?php if ($user_msg['status'] == 'error' && $user_msg['type'] == 'form') echo "Tous les champs du formulaire n'ont pas 
&eacute;t&eacute; remplis correctement.";?>
		<?php if ($user_msg['status'] == 'success' && $user_msg['type'] == 'delete') echo "La chaine a bien &eacute;t&eacute; 
supprim&eacute;.";?>
		<?php if ($user_msg['status'] == 'error' && $user_msg['type'] == 'delete') echo "Erreur lors de la suppression de la chaine.";?>
	</div>
<?php endif; ?>

<fieldset>
    <legend>Ajouter une chaine</legend>
    <br/>
    <?=form_open('chaine/add')?>
    Nom : <input type="text" name="name" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    IP Multicast : <input name="ip_multicast" type="text" maxlength="15" size="15"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Num service : <input type="text" name="num_service" size="5" maxlength="5" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <br /><br/>
    PIDs <input type="text" name="pid" size="30" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Transpondeur 
	<select name="tuner_id">
		<?php foreach ($tuners as $tuner): ?>
		<option value="<?=$tuner->id?>">(#<?=$tuner->id?>) <?=$tuner->name?></option>
		<?php endforeach; ?>
	</select>
    <br/><br/>
    <input type="submit" value="Valider"/>
    <?=form_close()?>
</fieldset>
<br/><br/>
-->
	<table class="table" cellspacing="0">
		<tr>
			<th>&nbsp;</th>
			<th>Nom</th>
			<th>IP multicast</th>
			<th>Num service</th>
			<th>PIDs</th>
			<th class="no-print">Actions</th>
		</tr>
		<?php $tuner = 0; ?>
		<?php foreach($all as $item): ?>
		<?php if ($tuner != $item->tuner_id): ?>
			<tr>
				<td class="title">
					<?php if($tuners2[$item->tuner_id]['is_active'] != 1) { echo "<img src='".base_url()."/css/icon/off.png'/>"; } 
else { echo "<img src='".base_url()."/css/icon/on.png'/>"; } ?>
				</td>
				<td class="title" colspan="5">
					<a href="<?=site_url('tuner/view/'.$item->tuner_id)?>"><?=$tuners2[$item->tuner_id]['name']?></a> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Num carte : <?=$tuners2[$item->tuner_id]['num_card']?> - Freq : 
<?=$tuners2[$item->tuner_id]['frequence_transponder']?>
				</td>
			</tr>
		<?php endif; ?>
		
		<tr>
			<td <?php if($tuners2[$item->tuner_id]['is_active'] != 1) echo 'class="inactive"';?>><img 
src="<?=base_url()?>css/img/chaines/<?=slug($item->name)?>.gif" width="30" /></td>
			<td <?php if($tuners2[$item->tuner_id]['is_active'] != 1) { echo 'class=" heavy inactive"'; } else { echo 'class="heavy"'; 
}?>><?=$item->name?></td>
			<td <?php if($tuners2[$item->tuner_id]['is_active'] != 1) echo 'class="inactive"';?>><?=$item->ip_multicast?></td>
			<td <?php if($tuners2[$item->tuner_id]['is_active'] != 1) echo 'class="inactive"';?>><?=$item->num_service?></td>
			<td <?php if($tuners2[$item->tuner_id]['is_active'] != 1) echo 'class="inactive"';?>><?=$item->pid?></td>
			<td <?php if($tuners2[$item->tuner_id]['is_active'] != 1) { echo 'class="inactive no-print"'; } else { echo 
'class="no-print"'; }?>>
				<a href="<?=site_url('chaine/edit/'.$item->id)?>"><img src="<?=base_url()?>/css/icon/pencil.png" 
title="Modifier"/></a>&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="<?=site_url('chaine/delete/'.$item->id)?>"><img src="<?=base_url()?>/css/icon/cross.png" 
title="Supprimer"/></a>
			</td>
		</tr>
		<?php $tuner = $item->tuner_id; ?>
		<?php endforeach; ?>
	</table>
