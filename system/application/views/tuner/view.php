<h2>D&eacute;tail du transpondeur <?=$tuner->name?></h2>

<table class="table-h" cellspacing="0" cellpadding="5">
	<tr>
		<th>Nom</th>
		<td><?=$tuner->name?></td>
		<th>Num carte</th>
		<td><?=$tuner->num_card?></td>
		<th>Fr&eacute;quence</th>
		<td><?=$tuner->frequence_transponder?></td>
	</tr>
	<tr>
		<th>Polarit&eacute;</th>
		<td><?=$tuner->polarite?></td>
		<th>Srate</th>
		<td><?=$tuner->srate?></td>
		<th>Modulation</th>
		<td><?=$tuner->modulation?></td>
	</tr>
	<tr>
		<th>DVB-S2</th>
		<td><?php if ($tuner->dvb_s2 == 1) { echo "oui"; } else { echo "non"; }?></td>
		<th>DVR</th>
		<td><?php if ($tuner->dvr == 1) { echo "oui"; } else { echo "non"; }?></td>
		<th>Coderate</th>
		<td><?php if ($tuner->polarite != null && $tuner->srate != null && $tuner->modulation != null) { echo $tuner->coderate; } ?></td>
	</tr>
</table>
<div style="text-align: right">
	<a href="<?=site_url('tuner/edit/'.$tuner->id)?>"><img src="<?=base_url()?>/css/icon/pencil.png" title="Modifier"/> Modifier</a>&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="<?=site_url('tuner/delete/'.$tuner->id)?>" onclick="return(confirm('Etes-vous sur de vouloir supprimer le transpondeur et toutes les chaines attach&eacute; ?'));"><img src="<?=base_url()?>/css/icon/cross.png" title="Supprimer"/> Supprimer</a>
</div>
<br/>
<h3>Chaines disponibles</h3>
<table class="table" cellspacing="0">
		<tr>
			<th>&nbsp;</th>
			<th>Nom</th>
			<th>IP multicast</th>
			<th>Num service</th>
			<th>PIDs</th>
			<th>Actions</th>
		</tr>
		<?=form_open('chaine/add')?>
		<tr>
			<td>&nbsp;<input type="hidden" name="tuner_id" value="<?=$tuner->id?>"/><input type="hidden" name="is_active" value="1"/></td>
			<td><input type="text" name="name"/></td>
			<td><input type="text" name="ip_multicast" maxlength="15" size="15"/></td>
			<td><input type="text" name="num_service" maxlength="5" size="5"/></td>
			<td><input type="text" name="pid"/></td>
			<td><input type="submit" value="Ajouter la chaine"/></td>
		</tr>
		<?=form_close()?>
		<?php foreach($chaine as $item): ?>
		<tr <?php if($item->is_active != 1) echo 'class="inactive"';?>>
			<td><img src="<?=base_url()?>css/img/chaines/<?=slug($item->name)?>.gif" width="30" /></td>
			<td class="heavy"><?=$item->name?></td>
			<td><?=$item->ip_multicast?></td>
			<td><?=$item->num_service?></td>
			<td><?=$item->pid?></td>
			<td> 
				<a href="<?=site_url('chaine/edit/'.$item->id)?>"><img src="<?=base_url()?>/css/icon/pencil.png" title="Modifier"/> Modifier</a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="<?=site_url('chaine/delete/'.$item->id)?>"><img src="<?=base_url()?>/css/icon/cross.png" title="Supprimer"/> Supprimer</a>
			</td>
		</tr>	
		<?php endforeach; ?>
	</table>
