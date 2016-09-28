<?php if (@$err == true): ?>
	<b>Aucune information disponible.</b>
	<?php exit; ?>
<?php endif; ?>
<h2><?=$transponder?></h2>
Actif depuis le <?php foreach ($uptime as $item): echo date('d/m/Y h:i:s', (time() - $item->firstChild->nodeValue)); endforeach;?><br/>
Signal : <?php foreach ($signal as $item): echo $item->firstChild->nodeValue; endforeach;?><br/>
Version : <?php foreach ($version as $item): echo $item->firstChild->nodeValue; endforeach;?>
<br/><br/>

<table width="100%">
	<tr>
		<td></td>
	<?php
	foreach ($chaines as $item): 
		echo '<td align="center"><img src="'.base_url().'css/img/chaines/'.slug($item->firstChild->nodeValue).'.gif" width="80" alt="'.$item->firstChild->nodeValue.'" title="'.$item->firstChild->nodeValue.'" /></td>';
	endforeach;?>
	</tr>
	<tr>
		<td align="left">Nom</td>
	<?php
	foreach ($chaines as $item):
		echo '<td align="center">'.$item->firstChild->nodeValue.'</td>';
	endforeach;	
	?>
	</tr>
	<tr>
		<td align="left">IP</td>
	<?php
	foreach ($ip_multicast as $item):
		echo '<td align="center">'.$item->firstChild->nodeValue.'</td>';
	endforeach;	
	?>
	</tr>
	<tr>
		<td align="left">Port</td>
	<?php
	foreach ($port_multicast as $item):
		echo '<td align="center">'.$item->firstChild->nodeValue.'</td>';
	endforeach;	
	?>
	</tr>
	<tr>
		<td align="left">Trafic</td>
	<?php
	foreach ($traffic as $item):
		echo '<td align="center">'.$item->firstChild->nodeValue.'</td>';
	endforeach;	
	?>
	</tr>

</div>
</body>
</html>
