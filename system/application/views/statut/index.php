<script language="javascript">
	function infoTransponder(id) {
		window.open("<?=site_url('statut/info/')?>/"+id, "Informations", config="height=340, width=650, toolbar=no, menubar=no, scrollbars=n, resizable=no, location=no, directories=no, status=no");
	}
</script>

<h2>Statuts</h2>
<div>
	<a href="<?=site_url('statut/startAll')?>"><img src="<?=base_url()?>/css/icon/server_start.png"/> D&eacute;marrer toutes les instances actives</a>&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="<?=site_url('statut/stopAll')?>"><img src="<?=base_url()?>/css/icon/server_stop.png"/> Arreter toutes les instances</a>
</div>
<br/>
<table class="table" cellspacing="0">
	<tr>
		<th>&nbsp;</th>
		<th>Transpondeur</th>
		<th>Statut</th>
		<th>Actions</th>
	</tr>
<? foreach ($tuners as $tuner): ?>
	<tr>
		<td><? if($tuner->is_active != 1) { echo "<img src='".base_url()."/css/icon/off.png'/>"; } else { echo "<img src='".base_url()."/css/icon/on.png'/>"; } ?></td>
		<td><?=$tuner->name?></td>
		<td><? if (check_status(strtolower($tuner->name))) { echo '<span style="color: green;">En service</span>'; } else { echo '<span style="color: red;">Hors service</span>'; }?></td>
		<td>
			<? if ($tuner->is_active == 1) {
				if (check_status(strtolower($tuner->name).'.conf')) {
					echo "<img src='".base_url()."/css/icon/start_.png'/>&nbsp;&nbsp;&nbsp;";
					echo "<a href='".site_url('statut/stop/'.$tuner->id)."'><img src='".base_url()."/css/icon/stop.png'/></a>&nbsp;&nbsp;&nbsp;";
					echo "<a href='#' onclick='javascript:infoTransponder(".$tuner->id.");'><img src='".base_url()."/css/icon/info.png'/></a>&nbsp;&nbsp;&nbsp;";
				}
				else {
					echo "<a href='".site_url('statut/start/'.$tuner->id)."'><img src='".base_url()."/css/icon/start.png'/></a>&nbsp;&nbsp;&nbsp;";
					echo "<img src='".base_url()."/css/icon/stop_.png'/>&nbsp;&nbsp;&nbsp;";
					echo "<img src='".base_url()."/css/icon/info_.png'/>&nbsp;&nbsp;&nbsp;";
				}
			}
			else {
				echo "<img src='".base_url()."/css/icon/start_.png'/>&nbsp;&nbsp;&nbsp;";
				echo "<img src='".base_url()."/css/icon/stop_.png'/>&nbsp;&nbsp;&nbsp;";
				echo "<img src='".base_url()."/css/icon/info_.png'/>&nbsp;&nbsp;&nbsp;";
				
			}?>
		</td>
	</tr>
<? endforeach; ?>
</table>