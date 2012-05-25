<h2>Transpondeurs</h2>

<? if (isset($user_msg['status'])): ?>
	<div class="flashbox <?=$user_msg['status']?>">
		<? if ($user_msg['status'] == 'success' && $user_msg['type'] == 'form') echo "Le formulaire a &eacute;t&eacute; valid&eacute; avec succ&egrave;s.";?>
		<? if ($user_msg['status'] == 'error' && $user_msg['type'] == 'form') echo "Tous les champs du formulaire n'ont pas &eacute;t&eacute; remplis correctement.";?>
		<? if ($user_msg['status'] == 'success' && $user_msg['type'] == 'delete') echo "Le transpondeur a bien &eacute;t&eacute; supprim&eacute;.";?>
		<? if ($user_msg['status'] == 'error' && $user_msg['type'] == 'delete') echo "Erreur lors de la suppression du tuner.";?>
	</div>
<? endif; ?>


<fieldset>
    <legend>Ajouter un transpondeur</legend>
    <br/>
    <?=form_open('tuner/add')?>
    Nom : <input type="text" name="name" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Num carte : <input type="text" name="num_card" size="3" maxlength="3" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Fr&eacute;quence : <input type="text" name="frequence_transponder" size="8" maxlength="10" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Actif : <select name="is_active"><option value="0">Non</option><option value="1">Oui</option></select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Tuner Satellite : <input type="checkbox" id="DVBS" name="DVBS" onclick="javascript:$('.options').toggle();"/>
    <br /><br/>
    <div class="options">
	    Polarit&eacute; : <select name="polarite"><option value="Horizontal">Horizontal</option><option value="Vertical">Vertical</option></select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    Srate : <select name="srate"><option value="22000">22000</option><option value="27500">27500</option><option value="29900">29900</option></select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    Modulation : <select name="modulation"><option value="QPSK">QPSK</option><option value="8PSK">8PSK</option></select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    Coderate : <select name="coderate"><option value="auto">Auto</option><option value="none">None</option><option value="1/2">1/2</option><option value="2/3">2/3</option><option value="3/4">3/4</option><option value="4/5">4/5</option><option value="5/6">5/6</option><option value="6/7">6/7</option><option value="7/8">7/8</option><option value="8/9">8/9</option></select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    DVB-S2 <input type="checkbox" name="dvb_s2" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    DVR <input type="checkbox" name="dvr" />
   		<br/><br/>
    </div>
    <input type="submit" value="Valider"/>
    <?=form_close()?>
</fieldset>
<br/><br/>
	<table class="table" cellspacing="0">
		<tr>
			<th>&nbsp;</th>
			<th>Nom</th>
			<th>Num carte</th>
			<th>Fr&eacute;quence</th>
			<th>Infos</th>
			<th>Polarit&eacute;</th>
			<th>Srate</th>
			<th>Modulation</th>
			<th>Coderate</th>
			<th>Actions</th>
		</tr>
		<? foreach($all as $item): ?>
		<tr>
			<td><? if($item->is_active != 1) { echo "<img src='".base_url()."/css/icon/off.png'/>"; } else { echo "<img src='".base_url()."/css/icon/on.png'/>"; } ?></td>
			<td class="heavy"><?=$item->name?></td>
			<td><?=$item->num_card?></td>
			<td><?=$item->frequence_transponder?></td>
			<td>
				<?php 
				if ($item->polarite == null && $item->srate == null && $item->modulation == null) {
					echo " DVB-T ";
				}
				elseif ($item->dvb_s2 == 1) {
					echo " DVB-S2 ";
				}
				else {
					echo " DVB-S ";
				}
				if ($item->dvr == 1) {
					echo "- DVR ";
				}
				?>
			</td>
			<td><?=$item->polarite?>&nbsp;</td>
			<td><?=$item->srate?>&nbsp;</td>
			<td><?=$item->modulation?>&nbsp;</td>
			<td>
				<?php 
				if ($item->polarite != null && $item->srate != null && $item->modulation != null) {
					echo $item->coderate;
				}
				?>
				&nbsp;
			</td>
			<td>
				<a href="<?=site_url('tuner/view/'.$item->id)?>"><img src="<?=base_url()?>/css/icon/page.png" title="D&eacute;tails"/></a>&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="<?=site_url('tuner/edit/'.$item->id)?>"><img src="<?=base_url()?>/css/icon/pencil.png" title="Modifier"/></a>&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="<?=site_url('tuner/delete/'.$item->id)?>" onclick="return(confirm('Etes-vous sur de vouloir supprimer le transpondeur et toutes les chaines attach&eacute; ?'));"><img src="<?=base_url()?>/css/icon/cross.png" title="Supprimer"/></a>
			</td>
		</tr>	
		<? endforeach; ?>
	</table>
