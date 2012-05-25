<h2>Configuration</h2>

<? if (isset($user_msg['status'])): ?>
	<div class="flashbox <?=$user_msg['status']?>">
		<? if ($user_msg['status'] == 'success' && $user_msg['type'] == 'form') echo "La valeur du param&egrave;tre a &eacute;t&eacute; modifi&eacute;.";?>
		<? if ($user_msg['status'] == 'error' && $user_msg['type'] == 'form') echo "Le param&egrave;tre n'a pas pu &ecirc;tre modifi&eacute; correctement.";?>
	</div>
<? endif; ?>

	<table class="table" cellspacing="0">
		<tr>
			<th>Param&egrave;tre</th>
			<th>Valeur</th>
			<th>Action</th>
		</tr>
		<? foreach($all as $item): ?>
		<tr>
			<td><?=$item->name?></td>
			<td><?=$item->value?></td>
			<td><a href="<?=site_url('config/edit/'.$item->id)?>"><img src="<?=base_url()?>/css/icon/pencil.png" title="Modifier"/></a></td>
		</tr>	
		<? endforeach; ?>
	</table>