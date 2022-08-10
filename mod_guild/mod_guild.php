<?php
/**
 * @package     GuildMaster
 * @subpackage  Module.Site
 * @author      Thomas Hunziker <admin@bakual.net>
 * @copyright   © 2022 - Thomas Hunziker, original idea by Stefan Reimer
 * @license     http://www.gnu.org/licenses/gpl.html
 **/

defined('_JEXEC') or die();

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;

require_once(JPATH_BASE . '/components/com_guildmaster/guild.guildmaster.class.php');
require_once(JPATH_BASE . '/components/com_guildmaster/guildmaster.parser.php');
require_once(JPATH_BASE . '/administrator/components/com_guildmaster/guildmaster.class.php');

$database = Factory::getDBO();

$config = new GuildMasterConf($database);
$config->load(1);

if (!$config->guild_id)
{
	Factory::getApplication()->enqueueMessage('Guild ID not set.<br>Please check configuration.');

	return;
}

$force_update = 0;

update_all($error, $config, $database, $force_update);

$guild = new GuildMasterGuild($database);
$guild->load($config->guild_id);

require ModuleHelper::getLayoutPath('mod_guild', $params->get('layout', 'default'));
