<?php
/**
 * @package     GuildMaster
 * @subpackage  Module.Site
 * @author      Thomas Hunziker <admin@bakual.net>
 * @copyright   © 2022 - Thomas Hunziker, original idea by Stefan Reimer
 * @license     http://www.gnu.org/licenses/gpl.html
 **/

?>

<table>
	<tr>
		<th colspan="2">Wall of fame</th>
	</tr>

	<?php if ($params->get('genstats')) : ?>
		<tr>
			<td>Guild name:</td>
			<td>
				<a href="http://eq2players.station.sony.com/guilds/guild_profile.vm?guildId="<?php echo $guild->guild_id; ?>">
					<?php echo $guild->guild_name ?>
				</a>
			</td>
		</tr>
		<tr>
			<td>Server:</td>
			<td><?php echo $guild->server_name; ?></td>
		</tr>
		<tr>
			<td>Level:</td>
			<td><?php echo $guild->level; ?></td>
		</tr>
		<tr>
			<td>Status:</td>
			<td><?php echo $guild->points; ?></td>
		</tr>
		<tr>
			<td>Total characters:</td>
			<td><?php echo $guild->members; ?></td>
		</tr>
	<?php endif; ?>

	<?php if ($params->get('extstats')) : ?>
		<tr>
			<td>Created:</td>
			<td><?php echo date("d M y", strtotime($guild->created)); ?></td>
		</tr>
		<tr>
			<td>Kill vs. Death:</td>
			<td><?php echo $guild->kvd; ?></td>
		</tr>
		<tr>
			<td>Items disc. Server:</td>
			<td><?php echo $guild->item_disc_server; ?></td>
		</tr>
		<tr>
			<td>Items disc. World:</td>
			<td><?php echo $guild->item_disc_world; ?></td>
		</tr>
	<?php endif; ?>

	<?php if ($params->get('leaders')) : ?>
		//
		<tr>
			<td>Most Item Discoveries (Server):</td>
			<td><?php echo ((empty($guild->most_disc_server)) ? 'N/A' : $guild->most_disc_server); ?></td>
		</tr>
		//
		<tr>
			<td>Most Item Discoveries (World):</td>
			<td><?php echo ((empty($guild->most_disc_world)) ? 'N/A' : $guild->most_disc_world); ?></td>
		</tr>
		//
		<tr>
			<td>Most killed NPCs:</td>
			<td><?php echo $guild->most_killed_npcs; ?></td>
		</tr>
		//
		<tr>
			<td>Best Kill vs. Death ratio:</td>
			<td><?php echo $guild->best_kvd; ?></td>
		</tr>
		//
		<tr>
			<td>Most quest completed:</td>
			<td><?php echo $guild->most_quests; ?></td>
		</tr>
		<tr>
			<td>Highest Guild Status Contributor:</td>
			<td><?php echo $guild->most_points; ?></td>
		</tr>
		//
		<tr>
			<td>Highest Melee Hit:</td>
			<td><?php echo $guild->most_points; ?></td>
		</tr>
		//
		<tr>
			<td>Highest Magic Hit:</td>
			<td><?php echo $guild->most_points; ?></td>
		</tr>
	<?php endif; ?>

	<?php if ($params->get('current')) : ?>
		<tr>
			<td>Most Recent Member to Level:</td>
			<td><?php echo $guild->last_lvlup; ?></td>
		</tr>
		<tr>
			<td>Most Recent Member to Die:</td>
			<td><?php echo $guild->last_die; ?></td>
		</tr>
		<tr>
			<td>Most Recent Item discovered:</td>
			<td><?php echo $guild->most_recent_item; ?></td>
		</tr>
	<?php endif; ?>

	<?php if ($params->get('breakdown')) : ?>
		<tr>
			<td>Fighters:</td>
			<td><?php echo $guild->fighters; ?></td>
		</tr>
		<tr>
			<td>Priests:</td>
			<td><?php echo $guild->priests; ?></td>
		</tr>
		<tr>
			<td>Mages:</td>
			<td><?php echo $guild->mages; ?></td>
		</tr>
		<tr>
			<td>Scouts:</td>
			<td><?php echo $guild->scouts; ?></td>
		</tr>
	<?php endif; ?>
</table>
