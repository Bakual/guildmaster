<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<form action="index.php" method="post" name="adminForm">
	<div id="editcell">
	<table class="adminheading">
		<tr>
			<th>
			Guildmaster Settings
			</th>
		</tr>
		</table>

		<div>
		In order to set a direct link to the heritage tracking page, create <b>Link - URL</b> and enter <b>index.php?option=com_guildmaster&action=heritage</b> as link.
		</div>

		<fieldset class="adminform">
			<legend><?php echo JText::_( 'Parameters' ); ?></legend>
			<table class="admintable">
			<tr>
				<td>
				<?php
				$conf_row= $this->items[0];
				// Conf options
				if ($conf_row) {
					foreach ($conf_row as $k => $v) {
						$txt[]= "$k=$v";
					}
				}

				// get params definitions
				$params= new JParameter($txt, JPATH_ADMINISTRATOR .'/components/com_guildmaster/guildmaster.xml');
				echo $params->render();
				?>
				</td>
			</tr>
			</table>
		</fieldset>
	</div>
	<input type="hidden" name="option" value="com_guildmaster" />
	<input type="hidden" name="task" value="" />
</form>
