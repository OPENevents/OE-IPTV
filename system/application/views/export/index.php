<h2>Export</h2>

<?=form_open('export/send')?>

<?php $i = 0; ?>
<?php foreach ($transponder as $item): ?>
<?php $i++; ?>
<b><a href="#" onclick="javascript:$('#export-<?=$i?>').toggle();">+ <?=strtolower($item->name).'.conf'?></a></b>
<input type="hidden" name="exportfile-<?=$i?>" value="<?=strtolower($item->name).'.conf'?>"/>
<textarea rows="20" cols="94" name="export-<?=$i?>" id="export-<?=$i?>" style="display: none;">
##########
# Export du <?=date('d-m-Y')?> via OE IP-TV
# <?=strtolower($item->name).'.conf'?> 
########## 

<?php foreach ($config as $conf):?>
<?=$conf->name?>=<?php if ($conf->name == "port_http"): echo ($conf->value+$item->num_card); else: echo $conf->value; endif; ?> 
<?php endforeach; ?>

##########
card=<?=$item->num_card?> 
freq=<?=$item->frequence_transponder?> 
<?php if ($item->polarite != null && $item->srate != null && $item->modulation != null): ?>
pol=<?=substr($item->polarite, 0, 1)?> 
srate=<?=$item->srate?> 
modulation=<?=$item->modulation?> 
coderate=<?=$item->coderate?> 
<?php if ($item->dvb_s2 == 1): ?>
delivery_system=DVBS2 
<?php endif; ?>
<?php if ($item->dvr == 1): ?>
dvr_thread=1 
dvr_buffer_size=160 
<?php endif; ?>
<?php endif;?>

<?php foreach ($chaine as $sitem): ?>
<?php if ($sitem->tuner_id == $item->id && $sitem->is_active == 1):?>
# <?=$sitem->name?> 
ip=<?=$sitem->ip_multicast?> 
name=<?=$sitem->name?> 
service_id=<?=$sitem->num_service?> 
pids=<?=$sitem->pid?> 

<?php endif; ?>
<?php endforeach; ?>
</textarea>
<br/><br/>
<?php endforeach; ?>
<input type="hidden" name="nb_file" value="<?=$i?>"/>
<br/><br/>
<input type="submit" value="Envoyer la configuration" />
<?=form_close()?>
