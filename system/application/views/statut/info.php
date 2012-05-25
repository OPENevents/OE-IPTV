<? if (@$err == true): ?>
	<b>Aucune information disponible.</b>
	<? exit; ?>
<? endif; ?>
<h2><?=$transponder?></h2>
Actif depuis le <? foreach ($uptime as $item): echo date('d/m/Y h:i:s', (time() - $item->firstChild->nodeValue)); endforeach;?><br/>
Signal : <? foreach ($signal as $item): echo $item->firstChild->nodeValue; endforeach;?><br/>
Version : <? foreach ($version as $item): echo $item->firstChild->nodeValue; endforeach;?>
<br/><br/>

<table width="100%">
	<tr>
		<td></td>
	<? 
	foreach ($chaines as $item): 
		echo '<td align="center"><img src="'.base_url().'css/img/chaines/'.slug($item->firstChild->nodeValue).'.gif" width="80" alt="'.$item->firstChild->nodeValue.'" title="'.$item->firstChild->nodeValue.'" /></td>';
	endforeach;?>
	</tr>
	<tr>
		<td align="left">Nom</td>
	<?
	foreach ($chaines as $item):
		echo '<td align="center">'.$item->firstChild->nodeValue.'</td>';
	endforeach;	
	?>
	</tr>
	<tr>
		<td align="left">IP</td>
	<?
	foreach ($ip_multicast as $item):
		echo '<td align="center">'.$item->firstChild->nodeValue.'</td>';
	endforeach;	
	?>
	</tr>
	<tr>
		<td align="left">Port</td>
	<?
	foreach ($port_multicast as $item):
		echo '<td align="center">'.$item->firstChild->nodeValue.'</td>';
	endforeach;	
	?>
	</tr>
	<tr>
		<td align="left">Trafic</td>
	<?
	foreach ($traffic as $item):
		echo '<td align="center">'.$item->firstChild->nodeValue.'</td>';
	endforeach;	
	?>
	</tr>

</div>
</body>
</html>